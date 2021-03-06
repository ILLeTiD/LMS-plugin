<?php
use LmsPlugin\Models\QuizResult;

$id = $slide->id;
$user_id = get_current_user_id();
$question = apply_filters('the_content', get_post_field('post_content', $id));
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;
$displayHeader = $slide->quiz_header_display;
$isPassed = $slide->passed;
$isLatest = $slide->latest;
$textColor = isset($slide->quiz_colors['text']) ? $slide->quiz_colors['text'] : '#fff';
$result = QuizResult::where('user_id', get_current_user_id())
    ->where('slide_id', intval($slide->ID));
$resultCollection = $result->get();
$resultCount = $result->count();
$isCorrect = false;
$answers = [];
if ($resultCount) {
    $isCorrect = true;
    $iterator = $resultCollection->getIterator();
    foreach ($iterator as $item) {
        $answers[] = $item->results;
    }
}
$randomId = uniqid('slide');
?>


<div class="lms-slide lms-slide-quiz lms-quiz <?= $isCorrect || $isPassed ? 'passed' : ''; ?>"
     id="<?= $randomId ?>"
     data-slide-id="<?= $id ?>"
     data-slide-index="<?= $slide_index ?>"
     data-type="quiz"
     data-icon-color="<?= $textColor ?>"
     data-passed="<?= $isPassed ? 'true' : 'false' ?>"
     data-latest="<?= $isLatest ?>"
     data-quiz-type="<?= $type ?>"
     data-tolerance="<?= $tolerance ?>" data-hint="<?= $hint ?>">

    <?php include 'template-parts/quiz-parts/quiz-slide-settings.php'; ?>

    <?php if ($displayHeader != 'hide') :
        lms_get_template('template-parts/quiz-parts/quiz-header.php', ['slide' => $slide, 'hint' => $hint]);
    endif; ?>


    <?php lms_get_template('template-parts/quiz-parts/quiz-question.php', ['question' => $question]); ?>

    <main class="lms-quiz-main">
        <?php
        switch ($type) {
            case 'forms':
                lms_get_template('template-parts/quiz-parts/quiz-form.php', ['slide' => $slide, 'passed' => $isPassed, 'isCorrect' => $isCorrect, 'answersDB' => $answers]);
                break;
            case 'drag_and_drop':
                if ($isPassed) {
                    lms_get_template('template-parts/quiz-parts/quiz-dnd-passed.php', ['slide' => $slide, 'passed' => $isPassed, 'isCorrect' => $isCorrect, 'answersDB' => $answers]);
                } else {
                    lms_get_template('template-parts/quiz-parts/quiz-dnd.php', ['slide' => $slide, 'passed' => $isPassed, 'isCorrect' => $isCorrect, 'answersDB' => $answers]);
                }
                break;
            case 'puzzle':
                lms_get_template('template-parts/quiz-parts/quiz-puzzle.php', ['slide' => $slide, 'passed' => $isPassed, 'isCorrect' => $isCorrect, 'answersDB' => $answers]);
                break;
        }
        ?>
    </main>
</div>