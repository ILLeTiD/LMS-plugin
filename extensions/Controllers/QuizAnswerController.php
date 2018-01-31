<?php

namespace LmsPlugin\Controllers;


use LmsPlugin\Models\Slide;

class QuizAnswerController extends Controller
{
    public function checkOptionsAnswer()
    {
     $slide_id = $_REQUEST['slide_id'];
     $userAnswer = json_decode($_REQUEST['user_answer'],true);

     $slide = Slide::find($slide_id);
     $answers = $slide->forms_answers;
     dd($answers);

        wp_send_json(['slide'=>$slide]);
    }
}