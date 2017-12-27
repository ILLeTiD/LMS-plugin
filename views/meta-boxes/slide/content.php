<a href="<?= admin_url('post.php?post=' . $course . '&action=edit'); ?>" class="back-to-course-link hidden">
    <?= __('Back to course', 'lms-plugin'); ?>
</a>

<input type="hidden" name="course" value="<?= $course; ?>">

<div class="slides">
    <div class="slide-content-template hidden">
        <?php $slide = []; ?>
        <?php include 'components/content.php' ?>
    </div>

    <?php if ($content): ?>
        <?php foreach ($content as $i => $slide): ?>
            <?php include 'components/content.php' ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<a href="#" class="js-add-slide-content">+ <?= __('Add content', 'lms-plugin'); ?></a>
