<?php
$question = $slide->post_content;
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;
?>
<div class="slide slide-quiz" data-type="quiz"
     data-toleance="<?= $tolerance ?>" data-hint="<?= $hint ?>">
    <h1>simple slide from theme quiz</h1>
    <h1>  <?php print_r($slide->post_title) ?></h1>
    <h3>question is : <?= $question ?></h3>
    <!--    <h2>Question is : --><? //= $question ?><!--</h2>-->
    <!--    <h3>quiz type is --><? //= $type ?><!--</h3>-->
    <!--    --><?php //lms_get_template('/quiz-parts/quiz-form.php', ['slide' => $slide]); ?>
    <!--    <pre>-->
    <!---->
    <!--            --><?php //print_r($slide->slide_format) ?>
    <!--            </pre>-->
    <!--    <pre> --><?php //print_r($slide->slide_content_display) ?><!-- </pre>-->
    <!--    <pre> --><?php //print_r($slide->slide_content) ?>
    <!--    </pre>-->
</div>