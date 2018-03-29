<input type="hidden" name="slide_weight" value="<?= $weight; ?>">
<input type="hidden" name="slide_index" value="<?= $index; ?>">
<input type="hidden" name="course_id" value="<?= $course_id; ?>">
<input type="hidden" name="slide_real_link" value="<?= get_permalink($course_id); ?>#slide<?= $index; ?>">

<div class="lms-field">
    <div class="lms-field__title">
        <?= __('Template', 'lms-plugin'); ?>
    </div>

    <div class="lms-field__value">
        <select name="slide_template">
            <?php foreach ($slideTemplateOptions as $value => $name): ?>
                <option value="<?= $value; ?>" <?= selected($post->slide_template, $value); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>

        <span class="field__help"><?= __('Choose template to change layout of the slide.'); ?></span>
    </div>
</div>

<div class="lms-field">
    <div class="lms-field__title">
        <?= __('Section Display', 'lms-plugin'); ?>
    </div>

    <div class="lms-field__value">
        <select name="slide_section_display">
            <?php foreach ($slideSectionDisplayOptions as $value => $name): ?>
                <option value="<?= $value; ?>" <?= selected($post->slide_section_display, $value); ?>>
                    <?= __($name, 'lms-plugin'); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <span class="field__help"><?= __('All section will be visible at once as default', 'lms-plugin'); ?></span>
    </div>
</div>

<div class="lms-field">
    <div class="lms-field__title">
        <?= __('Display Header', 'lms-plugin'); ?>
    </div>
    <div class="lms-field__value">
        <select name="slide_content_display">
            <?php foreach ($slideDisplayHeaderOptions as $value => $name): ?>
                <option value="<?= $value; ?>" <?= selected($post->slide_content_display, $value); ?>><?= __($name, 'lms-plugin'); ?></option>
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
                   name="slide_colors[background]"
                   value="<?= array_get($colors, 'background', '#4990E2'); ?>"
            >
            <?= __('Background', 'lms-plugin'); ?>
        </label>

        <label class="lms-color-picker-wrap">
            <input type="color"
                   name="slide_colors[text]"
                   value="<?= array_get($colors, 'text', '#FFFFFF'); ?>"
            >
            <?= __('Text', 'lms-plugin'); ?>
        </label>

        <label class="lms-color-picker-wrap">
            <input type="color"
                   name="slide_colors[header_background]"
                   value="<?= array_get($colors, 'header_background', '#4990E2'); ?>"
            >
            <?= __('Header Background', 'lms-plugin'); ?>
        </label>

        <label class="lms-color-picker-wrap">
            <input type="color"
                   name="slide_colors[header]"
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
            'name' => 'slide_background',
            'image' => array_get($background, 'image'),
            'thumbnail' => array_get($background, 'thumbnail')
        ]); ?>
    </div>
</div>

