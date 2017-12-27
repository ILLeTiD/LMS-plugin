<div class="slide-content__advance-settings hidden">

    <!-- Color theme -->
    <div class="field">
        <div class="field__title"><?= __('Color Theme', 'lms-plugin'); ?></div>
        <div class="field__value">
            <select name="slide_content[<?= $i; ?>][color_theme]">
                <?php foreach ($slideThemeOptions as $value => $name): ?>
                    <option value="<?= $value; ?>"
                            <?= selected(array_get($slide, 'color_theme'), $value); ?>
                    >
                        <?= __($name, 'lms-plugin'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="field__help">
                <?= __('Inverts the colors of the background and text.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Image with -->
    <div class="field">
        <div class="field__title"><?= __('Image width', 'lms-plugin'); ?></div>
        <div class="field_value">
            <input type="text"
                   name="slide_content[<?= $i; ?>][image_width]"
                   value="<?= array_get($slide, 'image_width'); ?>"
            >
            <span class="field__help">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Image alignment -->
    <div class="field">
        <div class="field__title"><?= __('Image alignment', 'lms-plugin'); ?></div>
        <div class="field__value">
            <select name="slide_content[<?= $i; ?>][image_alignment]">
                <?php foreach ($imageAlignmentOptions as $value => $name): ?>
                    <option value="<?= $value; ?>"
                            <?= selected(array_get($slide, 'image_alignment'), $value); ?>
                    >
                        <?= __($name, 'lms-plugin'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="field__help">
                <?= __('Center alignment as default.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Image padding -->
    <div class="field">
        <div class="field__title"><?= __('Image padding', 'lms-plugin'); ?></div>
        <div class="field__value">
            <input type="text"
                   name="slide_content[<?= $i; ?>][image_padding]"
                   value="<?= array_get($slide, 'image_padding'); ?>"
            >
            <span class="field__help">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Link -->
    <div class="field">
        <div class="field__title"><?= __('Link', 'lms-plugin'); ?></div>
        <div class="field__value">
            <input type="text"
                   name="slide_content[<?= $i; ?>][link]"
                   placeholder="<?= __('Enter url', 'lms-plugin'); ?>"
                   value="<?= array_get($slide, 'link'); ?>"
            >
            <select name="slide_content[<?= $i; ?>][link_target]">
                <?php foreach ($linkTargetOptions as $value => $name): ?>
                    <option value="<?= $value; ?>"
                            <?= selected(array_get($slide, 'link_target'), $value); ?>
                    >
                        <?= __($name, 'lms-plugin'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="field__help">
                <?= __('New Tab is default.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Custom CSS -->
    <div class="field">
        <div class="field__title"><?= __('Custom CSS', 'lms-plugin'); ?></div>
        <div class="field__value">
            <textarea name="slide_content[<?= $i; ?>][custom_css]"><?= array_get($slide, 'custom_css'); ?></textarea>
            <span class="field__help">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

</div>
