<?php
$formType = $slide->forms_type;
$answers = $slide->forms_answers;

array_walk($answers, function (&$item, $key) {
    $item['index'] = $key;
});

shuffle($answers);

$correctCount = array_reduce($answers, function ($acc, $item) {
    if (isset($item['correct']) && $item['correct'] == 'on') $acc++;
    return $acc;
}, 0); ?>


<h1>Form type <?= $formType ?></h1>
<form class="quiz-form quiz-form-<?= $formType ?> "
      id="quiz-from-<?= $slide->id; ?>"
      <?= $formType == 'options' ? 'data-answers-count="' . $correctCount . '"' : ''; ?>
      data-form-type="<?= $formType ?>"
      data-slide-form-id="<?= $slide->id; ?>">
    <?php if ($formType == 'options') :
        $optionsType = $correctCount > 1 ? 'checkbox' : 'radio'; ?>

        <?php foreach ($answers as $answer): ?>
            <label>
                <input type="<?= $optionsType ?>" data-index="<?= $answer['index'] ?>" value="<?= $answer['text'] ?>"
                       name="option[]">
                <?= $answer['text'] ?>
            </label>
        <?php endforeach; ?>
    <?php elseif ($formType == 'text_field'): ?>
        <label>
            <input type="text" name="text_field" placeholder="Answer">
        </label>
    <?php elseif ($formType == 'text_area'): ?>
        <textarea placeholder="Answer"></textarea>
    <?php endif; ?>
    <button class="check">Check your answer</button>
</form>

