<?php

$course = \LmsPlugin\Models\Course::find(get_the_ID());
$isEnrolled = $course->hasParticipant(get_current_user_id());
$slides = $course->slides();

if (!is_user_logged_in() && $isEnrolled) {
    wp_redirect(home_url());
    exit;
}
get_header('course');
?>

    <section class="course" id="course" data-id="<?= $course->id; ?>" data-user-id="<?= get_current_user_id() ?>">
        <div class="course__wrapper">
            <div id="slides" class="slides">
                <?php
                foreach ($slides as $key => $slide) {
                    // print_r($slide);
                    if ($slide->slide_format == 'quiz') {
                        lms_get_template('template-parts/slide-quiz.php', ['slide' => $slide, 'slide_index' => $key]);
                    } elseif ($slide->slide_format == 'regular') {
                        lms_get_template('template-parts/slide-text.php', ['slide' => $slide, 'slide_index' => $key]);
                    }
                }
                ?>
            </div>
            <div class="slide-controls">
                <button class="slide-fullscreen">toggle fullscreen</button>
                <div class="slide-navigation">
                    <div class="nav-button">
                        <a href="#" class="prev" rel="prev">
                            <img src="<?php echo plugin_dir_url(__FILE__) ?>../assets/images/etp_arrow-left_over.png"
                                 alt"back"=""></a>
                    </div>
                    <div class="nav-button">
                        <a href="#" class="next" rel="next">
                            <img src="<?php echo plugin_dir_url(__FILE__) ?>../assets/images/etp_arrow-right_over.png"
                                 alt"forward"=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer('course');
