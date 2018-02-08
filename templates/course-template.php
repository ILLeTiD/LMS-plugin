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

    <section class="course unloaded" id="course" data-id="<?= $course->id; ?>"
             data-user-id="<?= get_current_user_id() ?>">
        <div class="dank-ass-loader" id="course-loader">
            <div class="row">
                <div class="arrow up outer outer-18"></div>
                <div class="arrow down outer outer-17"></div>
                <div class="arrow up outer outer-16"></div>
                <div class="arrow down outer outer-15"></div>
                <div class="arrow up outer outer-14"></div>
            </div>
            <div class="row">
                <div class="arrow up outer outer-1"></div>
                <div class="arrow down outer outer-2"></div>
                <div class="arrow up inner inner-6"></div>
                <div class="arrow down inner inner-5"></div>
                <div class="arrow up inner inner-4"></div>
                <div class="arrow down outer outer-13"></div>
                <div class="arrow up outer outer-12"></div>
            </div>
            <div class="row">
                <div class="arrow down outer outer-3"></div>
                <div class="arrow up outer outer-4"></div>
                <div class="arrow down inner inner-1"></div>
                <div class="arrow up inner inner-2"></div>
                <div class="arrow down inner inner-3"></div>
                <div class="arrow up outer outer-11"></div>
                <div class="arrow down outer outer-10"></div>
            </div>
            <div class="row">
                <div class="arrow down outer outer-5"></div>
                <div class="arrow up outer outer-6"></div>
                <div class="arrow down outer outer-7"></div>
                <div class="arrow up outer outer-8"></div>
                <div class="arrow down outer outer-9"></div>
            </div>
        </div>
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

            <div class="course-controls">
                <div class="course-progress">

                </div>
                <div class="slide-controls">
                    <button class="slide-control-fullscreen slide-fullscreen">toggle fullscreen</button>
                    <div class="slide-control-audio">
                        <audio src="" id="slide-control-player"
                               class="lms-audio"></audio>
                    </div>
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
        </div>
    </section>
<?php get_footer('course');
