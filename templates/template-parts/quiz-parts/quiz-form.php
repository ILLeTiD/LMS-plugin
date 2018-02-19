<?php
$formType = $slide->forms_type;
$answers = $slide->forms_answers;

$userAnswer = isset($answersDB[0]) ? $answersDB[0] : null;
$decodedDBAnswers = json_decode($answersDB[0], true);
if ($decodedDBAnswers) :
    foreach ($decodedDBAnswers as $answer) {
        $answers[$answer['index']]['checked'] = true;
    }
endif;
array_walk($answers, function (&$item, $key) {
    $item['index'] = $key;
});

shuffle($answers);


$correctCount = array_reduce($answers, function ($acc, $item) {
    if (isset($item['correct']) && $item['correct'] == 'on') $acc++;
    return $acc;
}, 0); ?>

<div class="quiz__wrapper quiz__wrapper--small">
    <form class="quiz-form quiz-form-<?= $formType ?>  <?= $isCorrect ? ' quiz-passed' : '' ?>"
          id="quiz-from-<?= $slide->id; ?>"
        <?= $formType == 'options' ? 'data-answers-count="' . $correctCount . '"' : ''; ?>
          data-form-type="<?= $formType ?>"
          data-slide-form-id="<?= $slide->id; ?>">
        <?php if ($formType == 'options') :
            $optionsType = $correctCount > 1 ? 'checkbox' : 'radio'; ?>

            <?php foreach ($answers as $answer): ?>
            <label class="label-<?= $optionsType ?>">
                <?= $answer['text'] ?>
                <input type="<?= $optionsType ?>"
                       data-index="<?= $answer['index'] ?>" <?= isset($answer['checked']) && $answer['checked'] == true ? 'checked' : ''; ?>
                       value="<?= $answer['text'] ?>"
                       name="option[]">
                <span class="checkmark"></span>
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
        <button class="check quiz-check-button quiz-form__check button">Check your answer</button>
    </form>
</div>