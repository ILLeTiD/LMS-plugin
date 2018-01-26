<?php

get_header('course');
$course = \LmsPlugin\Models\Course::find(get_the_ID());
$slides = $course->slides();
?>

    <section class="course" id="course">
        <div class="course__wrapper">
            <div id="slides" class="slides">
                <?php
                foreach ($slides as $slide) {
                    if ($slide->slide_format == 'quiz') {
                        lms_get_template('slide-quiz.php', ['slide' => $slide]);
                    } elseif ($slide->slide_format == 'regular') {
                        lms_get_template('slide-text.php', ['slide' => $slide]);
                    }
                }
                ?>
            </div>
            <div class="slide-controls">
                <button class="slide-fullscreen">toggle fullscreen</button>
                <div class="slide-navigation">
                    <div class="nav-button">
                        <a href="#" class="prev" rel="prev">
                            <img src="http://localhost/fishy-lms/wp-content/uploads/2018/01/etp_arrow-left_over.png"
                                 alt"back"=""></a>
                    </div>
                    <div class="nav-button">
                        <a href="#" class="next" rel="next">
                            <img src="http://localhost/fishy-lms/wp-content/uploads/2018/01/etp_arrow-right_over.png"
                                 alt"forward"=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer('course');
