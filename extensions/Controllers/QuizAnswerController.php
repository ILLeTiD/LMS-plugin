<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\Slide;
use LmsPlugin\Models\QuizResult;
use LmsPlugin\Models\Course;

class QuizAnswerController extends Controller
{
    public function getAllCourseAnswers()
    {
        $courseId = $_REQUEST['course_id'];
        if (!$courseId) wp_send_json(['error' => 'Error! Please provide course id']);
        $course = Course::find($courseId);
        $slides = $course->slides();
        $questions = $slides->filter(function ($i) {
            return $i->slide_format == 'quiz' && $i->quiz_type == 'forms';
        });

        $formattedQuestions = array_map(function ($i) {

            return [
                'question' => $i->post_content,
                'id' => $i->ID,
                'type' => $i->quiz_type,
                'tolerance' => $i->quiz_tolerance,
                'form_type' => $i->forms_type,
                'answers' => $i->forms_answers
            ];
        }, $questions);

        wp_send_json(['questions' => $formattedQuestions]);
    }

    public function getSlideAnswers($slide_id)
    {
        $slide = Slide::find($slide_id);
        $answers = $slide->forms_answers;

        return $answers;
    }

    public function checkOptionsAnswer()
    {
        $course_id = $_POST['course_id'];
        $user_id = $_POST['user_id'];
        $slide_id = $_POST['slide_id'];
        $userAnswer = $_POST['indexes'];
        $answers = $this->getSlideAnswers($slide_id);

        $checkedAnswers = array_map(function ($i) use ($answers) {
            $index = $i['index'];
            $isCorrect = isset($answers[$index]['correct']);
            $i['correct'] = $isCorrect;
            return $i;
        }, $userAnswer);


        $QuizModel = new  QuizResult(['user_id' => $user_id, 'course_id' => $course_id,
            'slide_id' => $slide_id,
            'results' => json_encode($checkedAnswers)]);
        $result = QuizResult::where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->where('slide_id', $slide_id);
        $resultCount = $result->count();

        if ($resultCount > 0) {
            $QuizModel->update();
        } else {
            $QuizModel->insert();
        }

        wp_send_json(['slide' => $slide_id, 'slideans' => $answers, 'checkedAnswers' => $checkedAnswers, 'post' => $_POST]);
    }

    public function checkTextAnswer()
    {
        $trim = function ($str) {
            return trim(strtolower(preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $str)));
        };

        $course_id = $_POST['course_id'];
        $user_id = $_POST['user_id'];
        $slide_id = $_POST['slide_id'];
        $userAnswer = $_POST['user_answer'][0];
        $userAnswerText = $userAnswer['text'];
        $answers = $this->getSlideAnswers($slide_id);
        $correctAnswers = array_filter($answers, function ($i) {
            return isset($i['correct']);
        });

        $sanitizedUserAnswer = $trim($userAnswerText);

        //if we decide make text question with multiple answers check if user answer in array of correct answers
        $isCorrect = array_reduce($correctAnswers, function ($acc, $item) use ($sanitizedUserAnswer, $trim) {
            if ($trim($item['text']) == $sanitizedUserAnswer) $acc = true;
            return $acc;
        }, false);

        if ($isCorrect) {
            $result = QuizResult::where('user_id', $user_id)
                ->where('course_id', intval($course_id))
                ->where('slide_id', intval($slide_id));
            $resultCount = $result->count();

            $QuizModel = new  QuizResult(['user_id' => $user_id, 'course_id' => $course_id, 'slide_id' => $slide_id, 'results' => $userAnswerText]);

            if ($resultCount > 0) {
                $QuizModel->update();
            } else {
                $QuizModel->insert();
            }

        }

        wp_send_json(['slide' => $sanitizedUserAnswer, 'isCorrect' => $isCorrect, 'checkedAnswers' => $correctAnswers, 'post' => $_POST]);
    }
}