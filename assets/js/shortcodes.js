(function() {
    tinymce.create('tinymce.plugins.lms', {
        init : function(editor, url) {
            editor.addButton('previous_slide', {
                title : 'Previous Slide',
                cmd : 'previous_slide',
                image : url + '/../images/shortcodes/prev-slide.png'
            });

            editor.addCommand('previous_slide', function () {
                var shortcode = '[button action="prev" value="Previous Slide"]';

                editor.execCommand('mceInsertContent', false, shortcode);
            });

            editor.addButton('next_slide', {
                title : 'Next Slide',
                cmd : 'next_slide',
                image : url + '/../images/shortcodes/next-slide.png'
            });

            editor.addCommand('next_slide', function () {
                var shortcode = '[button action="next" value="Next Slide"]';

                editor.execCommand('mceInsertContent', false, shortcode);
            });

            editor.addButton('courses', {
                title : 'Back to Courses',
                cmd : 'courses',
                image : url + '/../images/shortcodes/back.png'
            });

            editor.addCommand('courses', function () {
                var shortcode = '[button action="courses" value="Back to Courses"]';

                editor.execCommand('mceInsertContent', false, shortcode);
            });

            editor.addButton('restart', {
                title : 'Restart course',
                cmd : 'restart',
                image : url + '/../images/shortcodes/restart.png'
            });

            editor.addCommand('restart', function () {
                var shortcode = '[button action="restart" value="Restart the Course"]';

                editor.execCommand('mceInsertContent', false, shortcode);
            });
        }
    });

    // Register plugin
    tinymce.PluginManager.add('wplms', tinymce.plugins.lms);
})();