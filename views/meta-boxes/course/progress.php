<?php if ($course->participants()->count()): ?>
    <div class="lsm-progress">
        <div class="lsm-progress-list">
            <ul>
                <?php foreach ($progress as $status => $item): ?>
                    <li class="lsm-progress-elem lsm-<?= str_replace('_', '-', $item['status']); ?>">
                        <?= $statuses[$item['status']]; ?>:
                        <?= $item['percent']; ?>% /
                        <?= $item['number']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="lsm-progress-line">
            <?php foreach ($progress as $status => $item): ?>
                <div class="lsm-progress-line-point lsm-line-<?= str_replace('_', '-', $item['status']); ?>"
                     style="width: <?= $item['percent']; ?>%;"
                >
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="lsm-link-wrap right">
        <a href="#"><i class="fa fa-print" aria-hidden="true"></i> Print report</a>
    </div>
<?php else: ?>
    <p>No progress</p>
<?php endif; ?>
