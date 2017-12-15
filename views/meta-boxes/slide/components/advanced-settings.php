<div class="slide-content__advance-settings hidden">

    <!-- Color theme -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Color Theme', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <select name="slide_content[<?= $i; ?>][color_theme]">
                <?php foreach ($slideThemeOptions as $value => $name): ?>
                    <option value="<?= $value; ?>" <?= selected($slide['color_theme'], $value); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="advanced-settings__description">
                <?= __('Inverts the colors of the background and text.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

    <!-- Image with -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Image width', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <input type="text" name="slide_content[<?= $i; ?>][image_width]" value="<?= $slide['image_width']; ?>">
            <div class="advanced-settings__description">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

    <!-- Image alignment -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Image alignment', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <select name="slide_content[<?= $i; ?>][image_alignment]">
                <?php foreach ($imageAlignmentOptions as $value => $name): ?>
                    <option value="<?= $value; ?>" <?= selected($slide['image_alignment'], $value); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="advanced-settings__description">
                <?= __('Center alignment as default.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

    <!-- Image padding -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Image padding', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <input type="text" name="slide_content[<?= $i; ?>][image_padding]" value="<?= $slide['image_padding']; ?>">
            <div class="advanced-settings__description">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

    <!-- Link -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Link', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <input type="text" name="slide_content[<?= $i; ?>][link]" placeholder="<?= __('Enter url', 'lms-plugin'); ?>" value="<?= $slide['link']; ?>">
            <select name="slide_content[<?= $i; ?>][link_target]">
                <?php foreach ($linkTargetOptions as $value => $name): ?>
                    <option value="<?= $value; ?>" <?= selected($slide['link_target'], $value); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="advanced-settings__description">
                <?= __('New Tab is default.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Custom CSS', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <textarea name="slide_content[<?= $i; ?>][custom_css]"><?= $slide['custom_css']; ?></textarea>
            <div class="advanced-settings__description">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>

</div>
