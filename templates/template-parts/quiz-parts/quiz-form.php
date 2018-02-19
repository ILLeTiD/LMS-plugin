<?php
$formType = $slide->forms_type;
$answers = $slide->forms_answers;

$userAnswer = isset($answersDB[0]) ? $answersDB[0] : null;

if ($userAnswer) {
    $decodedDBAnswers = json_decode($answersDB[0], true);
    foreach ($decodedDBAnswers as $answer) {
        $answers[$answer['index']]['checked'] = true;
    }
}

array_walk($answers, function (&$item, $key) {
    $item['index'] = $key;
});

shuffle($answers);

$correctCount = array_reduce($answers, function ($acc, $item) {
    if (isset($item['correct']) && $item['correct'] == 'on') $acc++;
    return $acc;
}, 0); ?>


<div class="lms-quiz__wrapper lms-quiz__wrapper--small">
    <form class="lms-quiz-form lms-quiz-form-<?= $formType ?>  <?= $isCorrect ? ' lms-quiz-passed' : '' ?>"
          id="lms-quiz-from-<?= $slide->id; ?>"

        <?= $formType == 'options' ? 'data-answers-count="' . $correctCount . '"' : ''; ?>
          data-form-type="<?= $formType ?>"
          data-slide-form-id="<?= $slide->id; ?>">
        <?php if ($formType == 'options') :
            $optionsType = $correctCount > 1 ? 'checkbox' : 'radio'; ?>

            <?php foreach ($answers as $answer): ?>
            <label class="lms-label-<?= $optionsType ?>">
                <?= $answer['text'] ?>
                <input type="<?= $optionsType ?>"
                       data-index="<?= $answer['index'] ?>" <?= isset($answer['checked']) && $answer['checked'] == true ? 'checked' : ''; ?>
                       value="<?= $answer['text'] ?>"
                       name="option[]">
                <span class="lms-checkmark"></span>
            </label>
        <?php endforeach; ?>
        <?php elseif ($formType == 'text_field'): ?>
            <label>
                <input type="text" name="text_field"
                       placeholder="Answer" <?= $userAnswer ? 'value="' . $userAnswer . '"' : ''; ?>>
            </label>
        <?php elseif ($formType == 'text_area'): ?>
            <textarea placeholder="Answer"><?= $userAnswer ? $userAnswer : ''; ?></textarea>
        <?php endif; ?>

        <button class="lms-check lms-quiz-check-button lms-quiz-check-button lms-quiz-form__check lms-button button">
            Check your answer
        </button>

    </form>
</div>