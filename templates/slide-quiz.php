<?php
use LmsPlugin\Models\QuizResult;

$id = $slide->ID;
$user_id = get_current_user_id();
$question = $slide->post_content;
$type = $slide->quiz_type;
$tolerance = $slide->quiz_tolerance;
$hint = $slide->quiz_hint;
$isPassed = $slide->passed;
$isLatest = $slide->latest;

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

?>

<div class="lms-slide lms-slide-quiz lms-quiz <?= $isCorrect ? 'passed' : ''; ?>"
     data-slide-id="<?= $id ?>"
     data-slide-index="<?= $slide_index ?>"
     data-type="quiz"
     data-passed="<?= $isPassed ?>"
     data-latest="<?= $isLatest ?>"
     data-quiz-type="<?= $type ?>"
     data-tolerance="<?= $tolerance ?>" data-hint="<?= $hint ?>">

    <?php lms_get_template('template-parts/quiz-parts/quiz-header.php', ['slide' => $slide, 'hint' => $hint]); ?>

    <?php lms_get_template('template-parts/quiz-parts/quiz-question.php', ['question' => $question]); ?>

    <main class="lms-quiz-main">
        <?php
        switch ($type) {
            case 'forms':
                lms_get_template('template-parts/quiz-parts/quiz-form.php', ['slide' => $slide, 'passed' => $isPassed,'isCorrect'=>$isCorrect, 'answersDB' => $answers]);
                break;
            case 'drag_and_drop':
                lms_get_template('template-parts/quiz-parts/quiz-dnd.php', ['slide' => $slide, 'passed' => $isPassed,'isCorrect'=>$isCorrect, 'answersDB' => $answers]);
                break;
            case 'puzzle':
                lms_get_template('template-parts/quiz-parts/quiz-puzzle.php', ['slide' => $slide, 'passed' => $isPassed,'isCorrect'=>$isCorrect, 'answersDB' => $answers]);
                break;
        }
        ?>
    </main>
</div>