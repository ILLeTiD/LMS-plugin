<?php
$formType = $slide->forms_type;
$answers = $slide->forms_answers;
shuffle($answers);
$correctCount = array_reduce($answers, function ($acc, $item) {
    if (isset($item['correct']) && $item['correct'] == 'on') $acc++;
    return $acc;
}, 0); ?>


<h1>Form type <?= $formType ?></h1>
<?php if ($formType == 'options') :
    $optionsType = 'radio';
    if ($correctCount > 1) {
        $optionsType = 'checkbox';
    } ?>

    <?php foreach ($answers as $answer): ?>
    <label>
        <input type="<?= $optionsType ?>" value="<?= $answer['text'] ?>" name="option">
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