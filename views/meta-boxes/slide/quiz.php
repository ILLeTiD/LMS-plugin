<div class="lms-quiz-wrap">
    <!-- Type -->
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Type', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <select name="quiz_type" class="lms-quiz-type js-choose-quiz-type">
                <?php foreach ($quizTypeOptions as $type => $name): ?>
                    <option value="<?= $type; ?>" <?= selected($post->quiz_type, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Tolerance -->
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Tolerance', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <select name="quiz_tolerance" class="lms-quiz-tolerance">
                <?php foreach ($quizToleranceOptions as $type => $name): ?>
                    <option value="<?= $type; ?>" <?= selected($post->quiz_tolerance, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>
            <span class="field__help">
                <?= __('If strict is set all the answers has to be answered correctly, if flexible is set at least on answer has to be correct and if loose is set any choice will pass.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Hint -->
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Hint', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <input type="text" name="quiz_hint" class="lms-quiz-hint" value="<?= $post->quiz_hint; ?>">
        </div>
    </div>
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Display Header', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <select name="quiz_header_display">
                <?php foreach ($slideDisplayHeaderOptions as $value => $name): ?>
                    <option value="<?= $value; ?>" <?= selected($post->quiz_header_display, $value); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>

            <span class="field__help"><?= __('All content will be visible at once as default.', 'lms-plugin'); ?></span>
        </div>
    </div>
    <!-- Color theme -->
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Colors', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="quiz_colors[background]"
                       value="<?= array_get($colors, 'background', '#4990E2'); ?>"
                >
                <?= __('Background', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="quiz_colors[text]"
                       value="<?= array_get($colors, 'text', '#FFFFFF'); ?>"
                >
                <?= __('Text', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="quiz_colors[header_background]"
                       value="<?= array_get($colors, 'header_background', '#4990E2'); ?>"
                >
                <?= __('Header Background', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="quiz_colors[header]"
                       value="<?= array_get($colors, 'header', '#F1F1F1'); ?>"
                >
                <?= __('Header', 'lms-plugin'); ?>
            </label>
        </div>
    </div>

    <!-- Background image -->
    <div class="lms-field">
        <div class="lms-field__title">
            <?= __('Backg. image', 'lms-plugin'); ?>
        </div>
        <div class="lms-field__value">
            <?php component('components.image', [
                'name' => 'quiz_background',
                'image' => array_get($background, 'image'),
                'thumbnail' => array_get($background, 'thumbnail')
            ]); ?>
        </div>
    </div>
</div>
