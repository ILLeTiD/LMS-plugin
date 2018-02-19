<?php

$bgColor = isset($slide->quiz_colors['background']) ? $slide->quiz_colors['background'] : null;
$headerColor = isset($slide->quiz_colors['header']) ? $slide->quiz_colors['header'] : null;
$textColor = isset($slide->quiz_colors['text']) ? $slide->quiz_colors['text'] : null;
$bgImage =  isset($slide->quiz_background['image']) ? $slide->quiz_background['image'] : null;
//$customCss = isset($slide['slide_custom_css']) ? $slide['custom_css'] : null;

?>
<style>
    #<?= $randomId?> {
        color:<?= $textColor ?>;
        background-color:<?= $bgColor ?>;
        background-image:url(<?= $bgImage ?>);
        background-size:cover;
    <?= $customCss; ?>
    }

    #<?= $randomId?>
</style>
