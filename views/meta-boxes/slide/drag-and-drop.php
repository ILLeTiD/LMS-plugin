<div class="drag-drop-wrap">
    <table class="wp-list-table widefat striped lms-drag-and-drop-objects">
        <thead>
        <tr>
            <th class="column-title"></th>
            <th><?= __('Content', 'lms-plugin'); ?></th>
            <th class="column-type"><?= __('Type', 'lms-plugin'); ?></th>
            <th class="column-padding"><?= __('Padding', 'lms-plugin'); ?></th>
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
                    <div class="lms-drag-and-drop__content lms-drag-and-drop__content_image <?= array_get($objects, "{$i}.type") == 'text' ? 'hidden' : ''; ?>">
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
                    <input type="text"
                           name="drag_and_drop[objects][<?= $i; ?>][padding]"
                           value="<?= array_get($objects, "{$i}.padding"); ?>"
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

    <table class="wp-list-table widefat striped lms-drag-and-drop-objects">
        <tbody>
            <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <td class="column-title muted">
                        <?= __('Drop Zone', 'lms-plugin'); ?> <?= $i + 1; ?>
                    </td>
                    <td>
                        <div class="lms-drag-and-drop__content lms-drag-and-drop__content_text <?= array_get($drop_zones, "{$i}.type") == 'image' ? 'hidden' : ''; ?>">
                            <input type="text"
                                   name="drag_and_drop[drop_zones][<?= $i; ?>][text]"
                                   value="<?= array_get($drop_zones, "{$i}.text"); ?>"
                            >
                        </div>
                        <div class="lms-drag-and-drop__content lms-drag-and-drop__content_image <?= array_get($drop_zones, "{$i}.type") == 'text' ? 'hidden' : ''; ?>">
                            <?php component('components.image', [
                                'name' => "drag_and_drop[drop_zones][{$i}]",
                                'image' => array_get($drop_zones, "{$i}.image"),
                                'thumbnail' => array_get($drop_zones, "{$i}.thumbnail")
                            ]); ?>
                        </div>
                    </td>

                    <td class="column-type">
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

                    <td class="column-padding">
                        <input type="text"
                               name="drag_and_drop[drop_zones][<?= $i; ?>][padding]"
                               value="<?= array_get($drop_zones, "{$i}.padding"); ?>"
                        >
                    </td>

                    <td class="column-drop-zone"></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
