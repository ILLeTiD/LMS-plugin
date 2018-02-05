<?php
$id = $slide->ID;
$question = $slide->post_content;
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;
?>
<div class="slide slide-quiz" data-slide-id="<?= $id ?>" data-slide-index="<?= $slide_index ?>" data-type="quiz"
     data-quiz-type="<?= $type ?>"
     data-tolerance="<?= $tolerance ?>" data-hint="<?= $hint ?>">
    <h1>simple slide from theme quiz</h1>
    <h1>  <?php print_r($slide->post_title) ?></h1>
    <h3>question is : <?= $question ?></h3>

    <?php
    switch ($type) {
        case 'forms':
            lms_get_template('template-parts/quiz-parts/quiz-form.php', ['slide' => $slide]);
            break;
        case 'drag_and_drop':
            lms_get_template('template-parts/quiz-parts/quiz-dnd.php', ['slide' => $slide]);
            break;
        case 'puzzle':
            lms_get_template('template-parts/quiz-parts/quiz-puzzle.php', ['slide' => $slide]);
            break;
    }
    ?>
</div>