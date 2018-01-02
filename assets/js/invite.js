;
(function ($) {

    function showInvitePopup() {
        var regex = new RegExp('&invite$');

        if (regex.exec(window.location.href)) {
            $('.js-invite-popup-button').trigger('click');
        }
    }

    $(function () {

        showInvitePopup();

        $('body').on('change', 'input[type=checkbox]', function () {
            var checkboxes = $('.' + $(this).data('class'));

            checkboxes.prop('checked', !checkboxes.prop('checked'));
        });

        $('input[name=search]').on('keyup', function () {
            $('.js-not-found').addClass('hidden');
        });

        $('.js-search-user').on('click', function () {
            var search = $('input[name=search]').val();

            if (! search) {
                return false;
            }

            $('.search__result').load(ajaxurl, {
                action: 'search_user',
                search: search
            }, function (response) {
                if (! response.length) {
                    $('.js-not-found').removeClass('hidden');
                } else {
                    $('.lms-invite-search').toggleClass('hidden');
                }
            });
        });

        $('.js-invite-form').on('submit', function (e) {
            var form = $(this),
                action = $('.lms-invite-roles').hasClass('open') ? '_by_role_name' : '_by_user_id',
                url = form.attr('action') + action;

            $.ajax({
                method: form.attr('method'),
                url: url,
                data: form.serialize()
            }).done(function (response) {
                // Reload the page and show message.
                window.location.href += 'd';
            });

            e.preventDefault();
        });

    });
})(jQuery);
