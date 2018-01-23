<a href="<?= admin_url('post.php?post=' . $course . '&action=edit'); ?>" class="back-to-course-link hidden">
    <?= __('Back to course', 'lms-plugin'); ?>
</a>

<input type="hidden" name="course" value="<?= $course; ?>">

<div class="lms-slide-sections">
    <?php if ($content): ?>
        <?php $i = 0; ?>
        <?php foreach ($content as $slide): ?>
            <?php include 'components/content.php' ?>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<a href="#" class="lms-add-slide-section-button js-add-slide-content">+ <?= __('Add content', 'lms-plugin'); ?></a>

<div class="lms-delete-confirmation hidden">
    <p><?= __('Are you sure you want to delete this section?', 'lms-plugin'); ?></p>
    <button type="button" class="js-delete-confirmation__yes"><?= __('Yes', 'lms-plugin'); ?></button>
    <button type="button" class="js-delete-confirmation__no"><?= __('No', 'lms-plugin'); ?></button>
</div>


