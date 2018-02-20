<?php
//lms_get_template('course-header.php');
lms_get_template('course-parts/course-settings.php');

$activity = \LmsPlugin\Models\Activity::where('user_id', get_current_user_id())
    ->where('course_id', $course->id)
    ->where('name', 'finished')
    ->orderBy(['date' => 'DESC'])
    ->get();
$ids = [];

foreach ($activity as $item) {
    $ids[] = $item->slide->id;
}
foreach ($slides as $key => $slide) {
    $index = array_search($slide->ID, $ids, true);

    $slide->dbindex = $index;
    if ($index !== false) {
        $slide->passed = true;
        if ($index === 0) {
            $slide->latest = true;
        } else {
            $slide->latest = false;
        }
    } else {
        $slide->passed = false;
    }
}
?>

<section class="lms-course unloaded"
         id="lms-course"
         data-id="<?= $course->id; ?>"
         data-user-id="<?= get_current_user_id() ?>">
    <?php
    lms_get_template('template-parts/course-preloader.php');
    ?>
    <div class="lms-course__wrapper">
        <div id="lms-slides" class="lms-slides">
            <?php
            foreach ($slides as $key => $slide) {
                if ($slide->slide_format == 'quiz') {
                    lms_get_template('slide-quiz.php', ['slide' => $slide, 'slide_index' => $key]);
                } elseif ($slide->slide_format == 'regular') {
                    lms_get_template('slide-text.php', ['slide' => $slide, 'slide_index' => $key]);
                }
            }
            ?>
        </div>
        <?php
        lms_get_template('template-parts/course-controls.php');
        ?>
    </div>
</section>
