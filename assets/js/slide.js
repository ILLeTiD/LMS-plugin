var lms = {
    editor: {
        settings: {
            tinymce: {
                plugins: 'charmap, colorpicker, hr, lists, paste, tabfocus, textcolor, fullscreen, wordpress, wpautoresize, wpeditimage, wpemoji, wpgallery, wplink, wptextpattern, wplms',
                toolbar1: 'formatselect bold italic bullist numlist blockquote alignleft aligncenter alignright link wp_more wp_adv dfw previous_slide next_slide courses restart',
                toolbar2: 'strikethrough hr forecolor pastetext removeformat charmap outdent indent undo redo wp_help'
            },
            quicktags: true
        },

        create: function (id) {
            wp.editor.initialize(id, this.settings);
        },

        remove: function (id) {
            wp.editor.remove(id);
        },

        refresh: function (id) {
            this.remove(id);
            this.create(id);
        }
    }
};

(function ($) {
    var slideFormats = {
        regular: [
            '#lms_slide_settings_meta_box',
            '#lms_slide_content_meta_box'
        ],
        quiz: [
            '#lms_slide_quiz_meta_box',
            '#lms_slide_forms_meta_box',
            '#lms_slide_drag_meta_box',
            '#lms_slide_drop_meta_box',
            '#lms_slide_puzzle_meta_box'
        ]
    };

    var quizTypes = {
        forms: '#lms_slide_forms_meta_box',
        drag_and_drop: '#lms_slide_drag_meta_box, #lms_slide_drop_meta_box',
        puzzle: '#lms_slide_puzzle_meta_box'
    };

    function setQuizType(type) {
        $(Object.values(quizTypes).join(',')).hide();
        $(quizTypes[type]).show();
    }

    function setSlideFormat(format) {
        var inactive = (format === 'regular') ? 'quiz' : 'regular';

        $(slideFormats[format].join(',')).show();
        $(slideFormats[inactive].join(',')).hide();

        if (format === 'quiz') {
            setQuizType($('.js-choose-quiz-type').val());
        }
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

        $('.js-choose-quiz-type').on('change', function () {
            var activeQuizType = $(this).val();

            $(Object.values(quizTypes).join(',')).hide();
            $(quizTypes[activeQuizType]).show('hidden');
        });

        $('.js-set-slide-image').on('click', function () {
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

        $('.js-add-slide-content').on('click', function (e) {
            e.preventDefault();

            var container = $('.lms-slide-sections');
            sections = container.find('.lms-slide-section');
            newSectionIndex = sections.length;

            $.get(ajaxurl, {
                action: 'new_slide_section',
                section_id: newSectionIndex
            }, function (response) {
                container.append(response);

                lms.editor.create('section_text_' + newSectionIndex);
            });

        });

        $('.lms-slide-sections').on('click', '.js-advanced-settings', function (e) {
            var advancedSettings = $(this).parent().parent().siblings('.slide-content__advance-settings');

            advancedSettings.toggleClass('hidden');

            e.preventDefault();
        });

        $('#lms_slide_content_meta_box').on('click', '.js-remove-slide-section', function (event) {
            var button = $(this),
                section = button.parent();

            $('.js-delete-confirmation__yes').data('section', section.data('section'));

            $('.lms-delete-confirmation').fadeIn();
        });

        $('#lms_slide_content_meta_box').on('mousedown', '.js-sortable-handle', function (event) {
            $(this).parent().parent().find('.lms-advanced-settings').addClass('hidden');
        });

        $('.js-delete-confirmation__yes').on('click', function () {
            var button = $(this),
                sectionId = button.data('section'),
                section = $('#slide-section-' + sectionId);

            lms.editor.remove('section_text_' + button.data('section'));

            section.remove();

            // Remove others section connections with this section.
            $('.js-connected-to option[value=' + sectionId + ']').remove();

            $('.lms-delete-confirmation').fadeOut();
        });

        $('.js-delete-confirmation__no').on('click', function () {
            $('.lms-delete-confirmation').fadeOut();
        });

        var sections = $('.lms-slide-section');

        sections.each(function (i) {
            lms.editor.create('section_text_' + i);
        });

        $('.lms-slide-sections').sortable({
            handle: '.js-sortable-handle',
            stop: function (event, ui) {
                lms.editor.refresh('section_text_' + ui.item.data('section'));

                $('.lms-slide-sections').find('.slide-number').each(function (i, item) {
                    $(item).text(i + 1);
                });

                $('.lms-slide-section').each(function (i, section) {
                    var $section = $(section),
                        oldSectionId = $section.data('section'),
                        newSectionId = parseInt($section.find('.slide-number').text()) - 1;

                    $('.js-connected-to option[value=' + oldSectionId + ']:selected').parent().val(newSectionId);
                });
            }
        });

        $('.lms-slide-video-type').each(function (i) {
            if ($(this).is(':checked')) {
                $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--gallery').hide();
                $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--embed').show();
            } else {
                $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--gallery').show();
                $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--embed').hide();
            }
        });
        $(document).on('change', '.lms-slide-video-type', function (e) {
            $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--gallery').toggle();
            $(this).closest('.lms-advanced-settings').find('.lms-slide-video-type--embed').toggle();
        });

        $(document).on('click', '.js-add-section-video', function () {
            var $button = $(this),
                $buttonHolder = $button.parent(),
                $video = $buttonHolder.siblings('video'),
                $input = $video.siblings('input[type=hidden]'),
                $removeButton = $video.siblings('a'),
                originAttachment = wp.media.editor.send.attachment;

            wp.media.editor.send.attachment = function (props, attachment) {
                $buttonHolder.addClass('hidden');
                $video.find('source').prop('src', attachment.url);
                $video.find('source').prop('type', attachment.mime);
                $video.removeClass('hidden');
                $input.val(attachment.url);
                $removeButton.removeClass('hidden');
                wp.media.editor.send.attachment = originAttachment;
            };

            wp.media.editor.open();

            return false;
        });
        $('.lms-slide-sections').on('click', '.js-remove-section-video', function (event) {
            var $removeButton = $(this),
                $buttonHolder = $removeButton.siblings('div'),
                $player = $removeButton.siblings('video'),
                $input = $removeButton.siblings('input[type=hidden]');

            $buttonHolder.removeClass('hidden');

            $player.find('source').attr('src', '');
            $player.find('source').attr('type', '');

            $player.addClass('hidden');
            $removeButton.addClass(('hidden'));

            $input.val('');

            event.preventDefault();
        });


        $(document).on('click', '.js-add-section-audio', function () {
            var $button = $(this),
                $buttonHolder = $button.parent(),
                $audio = $buttonHolder.siblings('audio'),
                $input = $audio.siblings('input[type=hidden]'),
                $removeButton = $audio.siblings('a'),
                originAttachment = wp.media.editor.send.attachment;

            wp.media.editor.send.attachment = function (props, attachment) {
                $buttonHolder.addClass('hidden');

                $audio.attr('src', attachment.url);
                $audio.removeClass('hidden');

                $input.val(attachment.url);

                $removeButton.removeClass('hidden');

                wp.media.editor.send.attachment = originAttachment;
            };

            wp.media.editor.open();

            return false;
        });

        $('.lms-slide-sections').on('click', '.js-remove-section-audio', function (event) {
            var $removeButton = $(this),
                $buttonHolder = $removeButton.siblings('div'),
                $player = $removeButton.siblings('audio'),
                $input = $removeButton.siblings('input[type=hidden]');

            $buttonHolder.removeClass('hidden');

            $player.attr('src', '');

            $player.addClass('hidden');
            $removeButton.addClass(('hidden'));

            $input.val('');

            event.preventDefault();
        });

        // Fix add new slide link href.
        (function () {
            var $button = $('a.page-title-action'),
                href = $button.attr('href') || '',
                course = $('input[name=course]').val();

            if (href.endsWith('post_type=slide')) {
                $button.attr('href', href + '&course=' + course);
            }
        })();

        $('.js-change-dnd-type').on('change', function () {
            var select = $(this),
                type = select.val(),
                row = select.parent().parent();

            row.find('.lms-drag-and-drop__content').hide();
            row.find('.lms-drag-and-drop__content_' + type).show();
        });

        $('.lms-section-color-trigger').each(function (i) {
            if ($(this).is(':checked')) {
                $(this).closest('label').siblings('.lms-color-picker-wrap').show();
            } else {
                $(this).closest('label').siblings('.lms-color-picker-wrap').hide();
            }
        });
        $('.lms-slide-sections').on('change', '.lms-section-color-trigger', function (e) {
            $(this).closest('label').siblings('.lms-color-picker-wrap').toggle();
        });

    });


})(jQuery);
