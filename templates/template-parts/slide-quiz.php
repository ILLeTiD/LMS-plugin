<?php
$id = $slide->ID;
$question = $slide->post_content;
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;
?>
<div class="slide slide-quiz quiz" data-slide-id="<?= $id ?>" data-slide-index="<?= $slide_index ?>" data-type="quiz"
     data-quiz-type="<?= $type ?>"
     data-tolerance="<?= $tolerance ?>" data-hint="<?= $hint ?>">

    <header class="quiz__header">
        <div class="quiz__wrapper">
            <h1 class="quiz__title"><?php print_r($slide->post_title) ?></h1>
            <a href="#" class="quiz__hint">
                <img src="" alt="question mark">
            </a>
        </div>
    </header>
    <div class="quiz__question">
        <div class="quiz__wrapper">
            <h3>question is :</h3>
            <?= $question ?>
        </div>
    </div>
    <main class="quiz-main">

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

    </main>
</div>