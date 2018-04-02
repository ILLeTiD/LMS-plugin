;
(function ($) {
    var SuccessPopup = function () {
        function SuccessPopup(element, text) {
            var that = this;

            this.element = $(element);
            this.element.find('.lms-success-popup__title').text(text);

            this.element.find('.js-close').on('click', function () {
                window.location.reload();
            });
        }

        SuccessPopup.prototype.show = function () {
            this.element.fadeIn();
        };

        SuccessPopup.prototype.close = function () {
            this.element.fadeOut();
        };

        return SuccessPopup;
    }();

    var ConfirmPopup = function () {
        function ConfirmPopup(element) {
            var that = this;

            this.element = $(element);
            this.arguments = {};
            this.message = '';

            this.element.find('.js-confirm').on('click', function () {
                that.confirm();
            });

            this.element.find('.js-cancel').on('click', function () {
                that.close();
            });
        }

        ConfirmPopup.prototype.show = function () {
            this.element.find('h3').text(this.message);
            this.element.fadeIn();
        };

        ConfirmPopup.prototype.close = function () {
            this.element.fadeOut();
        };

        ConfirmPopup.prototype.confirm = function () {
            var popup = this;

            $.ajax({
                method: 'POST',
                url: this.url,
                data: this.arguments 
            }).done(function (response) {
                var successPopup = new SuccessPopup('.lms-success-popup', response.message);
                popup.close();
                successPopup.show();
            });
        };

        return ConfirmPopup;
    }();

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

        $('input[name=search]').on('keypress', function (event) {
            if (13 == event.which) {
                $('.js-search-user').click();

                event.preventDefault();
            }
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

        $('.js-participant-action').on('click', function (event) {
            var button = $(this),
                confirmPopup = new ConfirmPopup('.lms-confirm-popup');

            confirmPopup.url = button.attr('href');
            confirmPopup.arguments = {
                enrollment: button.data('enrollment'),
            };
            confirmPopup.message = button.data('confirm-message');
            confirmPopup.show();

            event.preventDefault();
        });

    });
})(jQuery);
