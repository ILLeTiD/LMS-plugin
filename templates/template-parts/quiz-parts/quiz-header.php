<header class="quiz__header">
    <div class="quiz__wrapper">
        <h1 class="quiz__title"><?php print_r($slide->post_title) ?></h1>

        <?php lms_get_template('template-parts/quiz-parts/quiz-hint.php', ['hint' => $hint]); ?>
    </div>
</header>