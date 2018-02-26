<?php
$id = $slide->id;
$template = $slide->slide_template;
$content = $slide->slide_content;
$title = get_the_title($id);
$displayHeader = $slide->slide_content_display;
$sectionsDisplay = $slide->slide_section_display;
$sectionsCount = count($content);
$isPassed = !!$slide->passed;
$isLatest = $slide->latest;

$optionsArray = ['slide' => $slide,
    'id' => $id,
    'template' => $template,
    'content' => $content,
    'title' => $title,
    'slide_index' => $slide_index,
    'displayHeader' => $displayHeader,
    'sectionsCount' => $sectionsCount,
    'sectionsDisplay' => $sectionsDisplay,
    'isPassed' => $isPassed,
    'isLatest' => $isLatest
];

?>
<?php
switch ($template) {
    case 'dynamic':
        lms_get_template('slide-templates/slide-dynamic.php', $optionsArray);
        break;
    case 'full-width':
        lms_get_template('slide-templates/slide-full-width.php', $optionsArray);
        break;
    default:
        lms_get_template('slide-templates/slide-dynamic.php', $optionsArray);
        break;
}
?>