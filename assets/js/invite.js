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

        $('.js-invite').on('click', function () {
            var roles = $('.lms-invite-roles');
            var formData = new FormData();

            formData.append('foo', 'bar');

            if (roles.hasClass('open')) {
                $('.lms-checkbox-role:checked').each(function (i, element) {
                    formData.append('roles[]', element.value);
                });
            } else {
                $('.lms-checkbox-user:checked').each(function (i, element) {
                    formData.append('users[]', element.value);
                });
            }

            // Send XHR request.

            // Reload the page and show message.
            window.location.href += 'd';
        });

    });
})(jQuery);
