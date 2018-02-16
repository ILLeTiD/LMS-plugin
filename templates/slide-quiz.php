<?php
use LmsPlugin\Models\QuizResult;

$id = $slide->ID;
$user_id = get_current_user_id();
$question = $slide->post_content;
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;


$result = QuizResult::where('user_id', get_current_user_id())
    ->where('slide_id', intval($slide->ID));
$resultCollection = $result->get();
$resultCount = $result->count();
$passed = false;
$answers = [];
if ($resultCount) {
    $passed = true;
    $iterator = $resultCollection->getIterator();
    foreach ($iterator as $item) {
        $answers[] = $item->results;
    }
}

?>
<div class="slide slide-quiz quiz <?= $passed ? 'passed' : ''; ?>" data-slide-id="<?= $id ?>"
     data-slide-index="<?= $slide_index ?>"
     data-type="quiz"
     data-quiz-type="<?= $type ?>"
     data-tolerance="<?= $tolerance ?>" data-hint="<?= $hint ?>">

    <?php lms_get_template('template-parts/quiz-parts/quiz-header.php', ['slide' => $slide, 'hint' => $hint]); ?>

    <?php lms_get_template('template-parts/quiz-parts/quiz-question.php', ['question' => $question]); ?>

    <main class="quiz-main">
        <?php
        switch ($type) {
            case 'forms':
                lms_get_template('template-parts/quiz-parts/quiz-form.php', ['slide' => $slide, 'passed' => $passed, 'answersDB' => $answers]);
                break;
            case 'drag_and_drop':
                lms_get_template('template-parts/quiz-parts/quiz-dnd.php', ['slide' => $slide, 'passed' => $passed, 'answersDB' => $answers]);
                break;
            case 'puzzle':
                lms_get_template('template-parts/quiz-parts/quiz-puzzle.php', ['slide' => $slide, 'passed' => $passed, 'answersDB' => $answers]);
                break;
        }
        ?>
    </main>
</div>