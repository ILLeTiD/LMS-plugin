<a href="<?= admin_url('post.php?post=' . $course . '&action=edit'); ?>" class="back-to-course-link hidden">
    <?= __('Back to course', 'lms-plugin'); ?>
</a>

<input type="hidden" name="course" value="<?= $course; ?>">

<div class="lms-slide-sections">
    <?php if ($content): ?>
        <?php $slideNumber = 1; ?>
        <?php foreach ($content as $i => $slide): ?>
            <?php include 'components/content.php' ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<a href="#" class="lms-add-slide-section-button js-add-slide-content">+ <?= __('Add content', 'lms-plugin'); ?></a>

