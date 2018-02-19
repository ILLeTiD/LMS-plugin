<header class="lms-quiz__header">
    <div class="lms-quiz__wrapper">
        <h1 class="lms-quiz__title"><?php echo get_the_title($slide->id); ?></h1>
        <?php lms_get_template('template-parts/quiz-parts/quiz-hint.php', ['hint' => $hint]); ?>
    </div>
</header>