<?php include_once('svg.php'); ?>

<div class="lsm-link-wrap right">
    <a href="#" class="js-print" >
        <svg class="icon icon-print"><use xlink:href="#icon-print"></use></svg>
        <?php if (isset($text)): ?>
            <?= $text; ?>
        <?php else: ?>
            <?= __('Print Report', 'lms-plugin'); ?>
        <?php endif; ?>
    </a>
</div>

