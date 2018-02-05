<?php

namespace LmsPlugin\Controllers;


use LmsPlugin\Models\Slide;
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

    public function checkOptionsAnswer()
    {
        $slide_id = $_POST['slide_id'];
        $userAnswer = $_POST['indexes'];
        $slide = Slide::find($slide_id);
        $answers = $slide->forms_answers;
        $checkedAnswers = array_map(function ($i) use ($answers) {
            $index = $i['index'];
            $isCorrect = isset($answers[$index]['correct']);
            $i['correct'] = $isCorrect;
            return $i;
        }, $userAnswer);
//        d($userAnswer);
//        d($answers);
//        d($checkedAnswers);

        wp_send_json(['slide' => $slide_id, 'slideans' => $answers, 'checkedAnswers' => $checkedAnswers, 'post' => $_POST]);
    }
}