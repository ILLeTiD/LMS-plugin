<div>
    <label>
        <input type="radio" name="slide_format" value="regular" checked>
        <?= __('Regular', 'lms-plugin'); ?>
    </label>

    <br>

    <label>
        <input type="radio" name="slide_format" value="quiz" <?= checked($format, 'quiz'); ?>>
        <?= __('Quiz', 'lms-plugin'); ?>
    </label>
</div>
