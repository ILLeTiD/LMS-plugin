<div class="drag-drop-wrap">
    <table class="wp-list-table widefat striped lms-drag-and-drop-objects">
        <thead>
        <tr>
            <th class="column-title"></th>
            <th><?= __('Content', 'lms-plugin'); ?></th>
            <th class="column-type"><?= __('Type', 'lms-plugin'); ?></th>
            <th class="column-width"><?= __('Width', 'lms-plugin'); ?></th>
            <th class="column-drop-zone"><?= __('Drop Zone', 'lms-plugin'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < 3; $i++): ?>
            <tr>
                <td class="muted">
                    <?= __('Object', 'lms-plugin'); ?> <?= $i + 1; ?>
                </td>
                <td>
                    <div class="lms-drag-and-drop__content lms-drag-and-drop__content_text <?= array_get($objects, "{$i}.type") == 'image' ? 'hidden' : ''; ?>">
                        <input type="text"
                               name="drag_and_drop[objects][<?= $i; ?>][text]"
                               value="<?= array_get($objects, "{$i}.text"); ?>"
                        >
                    </div>
                    <div class="lms-drag-and-drop__content lms-drag-and-drop__content_image <?= array_get($objects, "{$i}.type", 'text') == 'text' ? 'hidden' : ''; ?>">
                        <?php component('components.image', [
                            'name' => "drag_and_drop[objects][{$i}]",
                            'image' => array_get($objects, "{$i}.image"),
                            'thumbnail' => array_get($objects, "{$i}.thumbnail")
                        ]); ?>
                    </div>
                </td>

                <td>
                    <select name="drag_and_drop[objects][<?= $i; ?>][type]"
                            class="js-change-dnd-type"
                    >
                        <option value="text"
                                <?= selected(array_get($objects, "{$i}.type"), 'text'); ?>
                        ><?= __('Text', 'lms-plugin'); ?></option>
                        <option value="image"
                                <?= selected(array_get($objects, "{$i}.type"), 'image'); ?>
                        ><?= __('Image', 'lms-plugin'); ?></option>
                    </select>
                </td>

                <td>
                    <input type="number"
                           name="drag_and_drop[objects][<?= $i; ?>][width]"
                           value="<?= array_get($objects, "{$i}.width"); ?>"
                           min="30"
                           max="100"
                           placeholder="<?= __('Width (%)', 'lms-plugin'); ?>"
                    >
                </td>

                <td>
                    <input type="text"
                           name="drag_and_drop[objects][<?= $i; ?>][drop_zone]"
                           value="<?= array_get($objects, "{$i}.drop_zone"); ?>"
                    >
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>
