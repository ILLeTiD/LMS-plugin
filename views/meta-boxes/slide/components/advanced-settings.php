<div class="lms-advanced-settings slide-content__advance-settings hidden">

    <!-- Color theme -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title">
                <?= __('Colors', 'lms-plugin'); ?>
            </h4>
        </div>
        <div class="col-10">
            <label class="">
                <input type="checkbox"
                       name="slide_content[<?= $i; ?>][use_section_colors]"
                       class="lms-section-color-trigger"
                       value="1"
                    <?= checked(array_get($slide, 'use_section_colors')); ?>
                >
                <?= __('Customize colors?', 'lms-plugin'); ?>
            </label>
            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="slide_content[<?= $i; ?>][colors][background]"
                       value="<?= array_get($slide, 'colors.background', '#4990E2'); ?>"
                >
                <?= __('Background', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="slide_content[<?= $i; ?>][colors][text]"
                       value="<?= array_get($slide, 'colors.text', '#FFFFFF'); ?>"
                >
                <?= __('Text', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="slide_content[<?= $i; ?>][colors][header_background]"
                       value="<?= array_get($slide, 'colors.header_background', '#4990E2'); ?>"
                >
                <?= __('Header Background', 'lms-plugin'); ?>
            </label>

            <label class="lms-color-picker-wrap">
                <input type="color"
                       name="slide_content[<?= $i; ?>][colors][header]"
                       value="<?= array_get($slide, 'colors.header', '#F1F1F1'); ?>"
                >
                <?= __('Header', 'lms-plugin'); ?>
            </label>

        </div>
    </div>

    <!-- Image with -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Width', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-2">
            <input type="text"
                   name="slide_content[<?= $i; ?>][image_width]"
                   value="<?= array_get($slide, 'image_width', '100%'); ?>"
            >
        </div>
        <div class="col-4">
            <span class="field__help">
                <?= __('Width of the content container. Use px or %.', 'lms-plugin'); ?>
            </span>
        </div>
        <div class="col-4">
            <label class="field__help">
                <input type="checkbox"
                       name="slide_content[<?= $i; ?>][image_as_background]"
                       value="1"
                    <?= checked(array_get($slide, 'image_as_background')); ?>
                >
                <?= __('Image as background', 'lms-plugin'); ?>
            </label>
        </div>
    </div>

    <!-- Image padding -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Padding', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-10">
            <input type="text"
                   name="slide_content[<?= $i; ?>][image_padding]"
                   value="<?= array_get($slide, 'image_padding'); ?>"
            >
            <span class="field__help">
                <?= __('Use px or %.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Image alignment -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Alignment', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-10">
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
                <?= __('Center, center alignment as default.', 'lms-plugin'); ?>
            </span>
        </div>
    </div>

    <!-- Connect to -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Connect to', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-7">
            <select name="slide_content[<?= $i; ?>][connect_to]" class="js-connected-to">
                <option value="">
                    <?= __('None', 'lms-plugin'); ?>
                </option>
                <?php foreach ($connectedToOptions as $value => $label): ?>
                    <?php if ($value == $i) continue; ?>
                    <option value="<?= $value; ?>"
                        <?= selected($value, array_get($slide, 'connect_to')); ?>>
                        <?= $label; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="field__help">
                <?= __('This will override the ordering in mobile view and keep the connected section on top or below this section', 'lms-plugin'); ?>
            </span>
        </div>
        <div class="col-3">
            <label class="field__help">
                <input type="checkbox"
                       name="slide_content[<?= $i; ?>][arrow]"
                       value="1"
                    <?= checked(array_get($slide, 'arrow')); ?>
                >
                <?= __('Arrow', 'lms-plugin'); ?>
            </label>
        </div>
    </div>

    <!-- Link -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Link', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-8">
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
        </div>
        <div class="col-2">
            <?= __('New Tab is default.', 'lms-plugin'); ?>
        </div>
    </div>

    <!-- Embed Video -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Embed Video', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-8">
            <textarea name="slide_content[<?= $i; ?>][embed_video]"
                      rows="5"><?= array_get($slide, 'embed_video'); ?></textarea>
        </div>
        <div class="col-2">
            <?= __('Embed video player from Youtube or Vimeo', 'lms-plugin'); ?>
            <div class="lms-slide-advanced-settings__hide-controls">
                <label>
                    <input type="checkbox"
                           name="slide_content[<?= $i; ?>][hide_controls]"
                           value="1"
                        <?= checked(array_get($slide, 'hide_controls')); ?>
                    >
                    <?= __('Hide Controls', 'lms-plugin'); ?>
                </label>
            </div>
        </div>
    </div>

    <hr>

    <!-- Audio File -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Audio file', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-10">
            <div class="wp-media-buttons <?= array_get($slide, 'audio') ? 'hidden' : ''; ?>">
                <button type="button"
                        id="insert-media-button"
                        class="button insert-media add_media js-add-section-audio"
                        data-editor="content">
                    <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
                </button>
            </div>

            <audio controls
                   src="<?= array_get($slide, 'audio'); ?>"
                   class="<?= array_get($slide, 'audio') ? '' : 'hidden'; ?>"
            >
                <?= __('Your browser does not support the audio element.', 'lms-plugin'); ?>
            </audio>

            <a href="#"
               class="js-remove-section-audio <?= array_get($slide, 'audio') ? '' : 'hidden'; ?>"
            >
                <?= __('Remove audio', 'lms-plugin'); ?>
            </a>

            <input type="hidden"
                   name="slide_content[<?= $i; ?>][audio]"
                   class="section-audio" value="<?= array_get($slide, 'audio'); ?>"
            >
        </div>
    </div>

    <!-- Playing options -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Playing options', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-7">
            <select name="slide_content[<?= $i; ?>][playing_options]">
                <option value="">
                    <?= __('None', 'lms-plugin'); ?>
                </option>
            </select>
            <span class="field__help">
                <?= __('This setting affected by the "Section Display" setting in Slide Settings', 'lms-plugin'); ?>
            </span>
        </div>
        <div class="col-3">
            <label class="field__help">
                <input type="checkbox"
                       name="slide_content[<?= $i; ?>][loop]"
                       value="1"
                    <?= checked(array_get($slide, 'loop')); ?>
                >
                <?= __('Loop', 'lms-plugin'); ?>
            </label>
        </div>
    </div>

    <hr>

    <!-- Custom CSS -->
    <div class="row">
        <div class="col-2">
            <h4 class="field__title"><?= __('Custom CSS', 'lms-plugin'); ?></h4>
        </div>
        <div class="col-8">
            <textarea name="slide_content[<?= $i; ?>][custom_css]"
                      rows="5"><?= array_get($slide, 'custom_css'); ?></textarea>
        </div>
        <div class="col-2">
            <?= __('This CSS overrides the Slide Custom CSS', 'lms-plugin'); ?>
        </div>
    </div>

    <div class="field">
    </div>

</div>
