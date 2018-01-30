<?php
$text = isset($block['text']) ? $block['text'] : null;
$thumbnail = isset($block['thumbnail']) ? $block['thumbnail'] : null;
$image = isset($block['image']) ? $block['image'] : null;
$link =  isset($block['link']) ? $block['link'] : null;
$linkTarget =  isset($block['link_target']) ? $block['link_target'] : null;

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
?>

<style>
    #<?= $randomId?>
    {
        color:<?= $textC ?>;
        background-color:<?= $bgC ?>;
        display: flex;
        justify-content: <?= $justifyContent ?>;
        align-items:<?=  $alignItems?>;
    }
    #<?= $randomId?> .grid-block__wrapper {
        padding: <?=$innerPadding ?>;
        width: <?=  $innerWidth?>;
    }

    #<?= $randomId?> h1,
    #<?= $randomId?> h2,
    #<?= $randomId?> h3,
    #<?= $randomId?> h4,
    #<?= $randomId?> h5,
    #<?= $randomId?> h6
                     {
                         color:<?= $headerC ?>;
                     }
</style>
<?php

?>
<?php if ( $link ) : ?>
    <a href="<?= $link ?>" target="<?= $linkTarget ?>"
       class="grid-block grid-block--link" id="<?= $randomId; ?>"
         style="background-image: url( <?= $backgroundStyle ? $backgroundStyle : '' ?>);
                 background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <div class="grid-block__wrapper">
            <?php if ($image && !$isBg) : ?>
                <img src="<?= $image ?>" class="grid-block__image">
            <?php elseif ($text) : ?>
                <div class="grid-block__text">
                    <?= $text ?>
                </div>
            <?php endif; ?>
        </div>
    </a>
<?php else: ?>
    <div class="grid-block" id="<?= $randomId; ?>"
         style="background-image: url( <?= $backgroundStyle ? $backgroundStyle : '' ?>);
                 background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <div class="grid-block__wrapper">
            <?php if ($image && !$isBg) : ?>
                <img src="<?= $image ?>" class="grid-block__image">
            <?php elseif ($text) : ?>
                <div class="grid-block__text">
                    <?= $text ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>