<header class="lms-quiz__header">
    <div class="lms-quiz__wrapper">
        <h2 class="lms-quiz__title"><?php echo get_the_title($slide->id); ?></h2>
        <?php lms_get_template('template-parts/quiz-parts/quiz-hint.php', ['hint' => $hint]); ?>
    </div>
</header>