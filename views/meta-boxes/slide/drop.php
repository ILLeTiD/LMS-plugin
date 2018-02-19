<div class="drag-drop-wrap">
    <table class="wp-list-table widefat striped lms-drag-and-drop-objects">
        <thead>
        <tr>
            <th class="column-title"></th>
            <th><?= __('Content', 'lms-plugin'); ?></th>
            <th class="column-type"><?= __('Type', 'lms-plugin'); ?></th>
            <th class="column-width"><?= __('Width', 'lms-plugin'); ?></th>
            <th class="column-drop-zone"></th>
        </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <td>
                        <?= __('Drop Zone', 'lms-plugin'); ?> <?= $i + 1; ?>
                    </td>
                    <td>
                        <div class="lms-drag-and-drop__content lms-drag-and-drop__content_text <?= array_get($drop_zones, "{$i}.type") == 'image' ? 'hidden' : ''; ?>">
                            <input type="text"
                                   name="drag_and_drop[drop_zones][<?= $i; ?>][text]"
                                   value="<?= array_get($drop_zones, "{$i}.text"); ?>"
                            >
                        </div>
                        <div class="lms-drag-and-drop__content lms-drag-and-drop__content_image <?= array_get($drop_zones, "{$i}.type", 'text') == 'text' ? 'hidden' : ''; ?>">
                            <?php component('components.image', [
                                'name' => "drag_and_drop[drop_zones][{$i}]",
                                'image' => array_get($drop_zones, "{$i}.image"),
                                'thumbnail' => array_get($drop_zones, "{$i}.thumbnail")
                            ]); ?>
                        </div>
                    </td>

                    <td>
                        <select name="drag_and_drop[drop_zones][<?= $i; ?>][type]"
                                class="js-change-dnd-type"
                        >
                            <option value="text"
                                    <?= selected(array_get($drop_zones, "{$i}.type"), 'text'); ?>
                            ><?= __('Text', 'lms-plugin'); ?></option>
                            <option value="image"
                                    <?= selected(array_get($drop_zones, "{$i}.type"), 'image'); ?>
                            ><?= __('Image', 'lms-plugin'); ?></option>
                        </select>
                    </td>

                    <td>
                        <input type="text"
                               name="drag_and_drop[drop_zones][<?= $i; ?>][width]"
                               value="<?= array_get($drop_zones, "{$i}.width"); ?>"
                               placeholder="<?= __('Width (px or %)', 'lms-plugin'); ?>"
                        >
                    </td>

                    <td></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
