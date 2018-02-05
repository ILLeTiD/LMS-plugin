<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\Slide;

class QuizAnswerController extends Controller
{
    public function checkOptionsAnswer()
    {
        $slide_id = $_POST['slide_id'];
        $userAnswer = $_POST['answers'];

        $slide = Slide::find($slide_id);
        $questions = $slide->forms_answers;
        $rightAnswers = array_filter($questions, function ($e) {
            return isset($e['correct']);
        });

        $arr4 = array_merge( $questions, $userAnswer );
        dd($arr4);
//        function checkValue($value, $key) use($rightAnswers)
//        {
//            $value['text'];
//        }
//
//        array_walk($userAnswer, 'checkValue');
//        $checkedAnswers = array_map(function ($e) use ($rightAnswers){
//            $text = $e['text'];
//            return array_search($text, $rightAnswers);
//        },$userAnswer);
//dd($checkedAnswers);

//        dd($userAnswer);
//        dd($answers);

        wp_send_json(['answers' => $answers, 'post' => $_POST]);
    }
}