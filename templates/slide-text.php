<?php
$id = $slide->ID;
$template = $slide->slide_template;
$content = $slide->slide_content;
$title = $slide->post_title;
$displayHeader = $slide->slide_content_display;
$sectionsDisplay = $slide->slide_section_display;
$sectionsCount = count($content);

$optionsArray = ['slide' => $slide,
    'id' => $id,
    'template' => $template,
    'content' => $content,
    'title' => $title,
    'displayHeader' => $displayHeader,
    'sectionsCount' => $sectionsCount,
    'sectionsDisplay' => $sectionsDisplay
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