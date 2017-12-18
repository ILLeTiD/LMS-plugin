(function ($) {
    var slideFormats = {
        regular: [
            '#lms_slide_settings_meta_box',
            '#lms_slide_content_meta_box'
        ],
        quiz: [
            '#lms_slide_quiz_meta_box',
            '#lms_slide_forms_meta_box',
            '#lms_slide_drag_and_drop_meta_box',
            '#lms_slide_puzzle_meta_box'
        ]
    };

    var setSlideFormat = function (format) {
        var inactive = (format === 'regular') ? 'quiz' : 'regular';

        $(slideFormats[format].join(',')).removeClass('hidden');
        $(slideFormats[inactive].join(',')).addClass('hidden');
    };

    window.send_to_editor_default = window.send_to_editor;

    $(function () {
        var backToCourseLink = $('.back-to-course-link');

        $('h1.wp-heading-inline').after(backToCourseLink.show());

        $('#slide-template').find('input, textarea, select').each(function (i, field) {
            field.disabled = true;
        });

        setSlideFormat($('input[name=slide_format]:checked').val());

        $('input[name=slide_format]').on('change', function () {
            setSlideFormat($(this).val());
        });
    });

    $('.js-set-slide-image').click(function () {
        var $button = $(this),
            originAttachment = wp.media.editor.send.attachment;

        wp.media.editor.send.attachment = function (props, attachment) {
            var $wrapper = $button.siblings('.js-slide-image'),
                $thumbnail = $wrapper.find('.js-slide-image-thumbnail'),
                $slideThumbnail = $button.siblings('input[type=hidden].slide-thumbnail'),
                $slideImage = $button.siblings('input[type=hidden].slide-image');

            $button.hide();
            $thumbnail.attr('src', attachment.sizes.slide_thumbnail.url);
            $slideThumbnail.val(attachment.sizes.slide_thumbnail.url);
            $slideImage.val(attachment.url);
            $wrapper.show();

            wp.media.editor.send.attachment = originAttachment;
        };

        wp.media.editor.open();

        return false;
    });

    $('.js-update-slide-image').click(function (e) {
        var $button = $(this),
            originAttachment = wp.media.editor.send.attachment;

        e.preventDefault();

        wp.media.editor.send.attachment = function (props, attachment) {
            var $thumbnail = $button.find('.js-slide-image-thumbnail'),
                $image = $button.parent().siblings('input[type=hidden]');

            $thumbnail.attr('src', attachment.sizes.slide_thumbnail.url);
            $thumbnail.val(attachment.sizes.slide_thumbnail.url);
            $image.val(attachment.url);

            wp.media.editor.send.attachment = originAttachment;
        };

        wp.media.editor.open('#slide_image');

        return false;

    });

    $('.js-remove-slide-image').click(function (e) {
        var slideImage = $(this).parent().parent();


        slideImage.hide();
        slideImage.siblings('.js-set-slide-image').show();
        slideImage.siblings('input[type=hidden]').val('');
        slideImage.find('input[type=checkbox]').removeAttr('checked');

        e.preventDefault();
    });

    $('.js-add-slide-content').click(function (e) {
        e.preventDefault();

        var lastSlide = $('.slides > div').last(),
            newSlide = $('#slide-template').clone(true),
            slideNumberElement = newSlide.find('.slide-number'),
            lastSlideNumber = parseInt(lastSlide.find('.slide-number').text()),
            lastSlideIndex = lastSlideNumber - 1,
            newSlideIndex = lastSlideIndex + 1;

        slideNumberElement.text(lastSlideNumber + 1);

        newSlide.attr('id', 'slide-' + newSlideIndex);

        newSlide.find('input, textarea, select').each(function (i, element) {
            element.name = element.name.replace('[]', '[' + newSlideIndex + ']');
            element.disabled = false;
        });

        newSlide.insertAfter(lastSlide);
        newSlide.show();

    });

    $('.js-advanced-settings').on('click', function (e) {
        var advancedSettings = $(this).parent().siblings('.slide-content__advance-settings');

        advancedSettings.toggleClass('hidden');

        e.preventDefault();
    });

})(jQuery);
