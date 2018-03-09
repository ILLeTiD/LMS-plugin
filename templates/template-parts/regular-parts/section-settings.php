<?php
$isFirst = isset($index) && $index == 1 ? 'active' : '';
$text = isset($block['text']) ? $block['text'] : null;
$thumbnail = isset($block['thumbnail']) ? $block['thumbnail'] : null;
$image = isset($block['image']) ? $block['image'] : null;
$audio = isset($block['audio']) ? $block['audio'] : null;
$audioIsLoop = isset($block['loop']) ? $block['loop'] : null;
$videoType = isset($block['video_type']) ? $block['video_type'] : null;
$videoEmbed = isset($block['embed_video']) ? $block['embed_video'] : null;
$videoMedia = isset($block['video_media']) ? $block['video_media'] : null;
$videoHideControls = isset($block['hide_controls']) ? $block['hide_controls'] : null;
$videoAutoplay = isset($block['video_autoplay']) ? $block['video_autoplay'] : null;
$link = isset($block['link']) ? $block['link'] : null;
$linkTarget = isset($block['link_target']) ? $block['link_target'] : null;


$linkedTo = isset($block['connect_to']) && $block['connect_to'] ? intval($block['connect_to']) + 1 : null;
$useArrow = array_get($block, 'arrow');
$arrowClass = '';

if ($linkedTo && $useArrow) {
    $arrowClass = ' lms-grid-block-arrow lms-grid-block-arrow-to-' . $linkedTo;
}

$useColors = array_get($block, 'use_section_colors', false);
$bgC = isset($block['colors']['background']) ? $block['colors']['background'] : null;
$headerC = isset($block['colors']['header']) ? $block['colors']['header'] : null;
$textC = isset($block['colors']['text']) ? $block['colors']['text'] : null;
$isBg = isset($block['image_as_background']) ? !!$block['image_as_background'] : false;
$backgroundStyle = $isBg && $image ? $image : null;
$customCss = isset($block['custom_css']) ? $block['custom_css'] : null;
$randomId = uniqid('slide');
$innerWidth = isset($block['image_width']) ? $block['image_width'] : null;
$innerPadding = isset($block['image_padding']) ? $block['image_padding'] : null;
$contentAlign = isset($block['image_alignment']) ? $block['image_alignment'] : 'center center';
$alignItems = '';
$justifyContent = '';
switch ($contentAlign) {
    case 'center center':
        $alignItems = 'center';
        $justifyContent = 'center';
        break;
    case 'top center':
        $alignItems = 'flex-start';
        $justifyContent = 'center';
        break;
    case 'bottom center':
        $alignItems = 'flex-end';
        $justifyContent = 'center';
        break;
    case 'center left':
        $alignItems = 'center';
        $justifyContent = 'flex-start';
        break;
    case 'top left':
        $alignItems = 'flex-start';
        $justifyContent = 'flex-start';
        break;
    case 'bottom left':
        $alignItems = 'flex-end';
        $justifyContent = 'flex-start';
        break;
    case 'center right':
        $alignItems = 'center';
        $justifyContent = 'flex-end';
        break;
    case 'top right':
        $alignItems = 'flex-start';
        $justifyContent = 'flex-end';
        break;
    case 'bottom right':
        $alignItems = 'flex-end';
        $justifyContent = 'flex-end';
        break;
}

ob_start();
?>
color:<?= $textC ?>;
background-color:<?= $bgC ?>;
border-color:<?= $bgC ?>!important;
<?php $colorStyles = ob_get_clean();
?>
<style>
    #<?= $randomId?> {
    <?= $useColors? $colorStyles : ''; ?>
        display: flex;
        justify-content:<?= $justifyContent ?>;
        align-items:<?=  $alignItems?>;
        <?= $customCss; ?>
    }

    @media screen and (max-width: 1024px) {
        .lms-grid-block:nth-of-type(<?= $linkedTo; ?>) {
            order: <?= $index*10 +1 ?> !important;
        }
    }

    #<?= $randomId?>  .lms-grid-block__wrapper {
        padding: <?=$innerPadding ?>;
        width: <?=  $innerWidth?>;
    }

    #<?= $randomId?> h1,
    #<?= $randomId?> h2,
    #<?= $randomId?> h3,
    #<?= $randomId?> h4,
    #<?= $randomId?> h5,
    #<?= $randomId?> h6 {
        color: <?= $headerC ?>;
    }
</style>