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

    var AcceptPopup = function () {
        function AcceptPopup(element) {
            var that = this;

            this.element = $(element);
            this.error = this.element.find('.lms-accept-popup__error');
            this.user = 0;

            this.element.find('select').on('change', function () {
                that.role = $(this).val();
                that.error.hide();
            });

            this.element.find('.js-accept').on('click', function () {
                that.accept();
            });

            this.element.find('.js-cancel').on('click', function () {
                that.close();
            });
        }

        AcceptPopup.prototype.show = function () {
            this.element.fadeIn();
        };

        AcceptPopup.prototype.close = function () {
            this.element.fadeOut();
        };

        AcceptPopup.prototype.accept = function () {
            var popup = this;

            $.ajax({
                method: 'POST',
                url: ajaxurl + '?action=accept_user',
                data: {
                    user: this.user,
                    role: this.role
                }
            }).done(function (response) {
                if (response.status === 'error') {
                    popup.error.text(response.message);
                    popup.error.show();
                } else {
                    var successPopup = new SuccessPopup('.lms-success-popup', response.message);
                    popup.close();
                    successPopup.show();
                }
            });
        };

        return AcceptPopup;
    }();

    var DenyPopup = function () {
        function DenyPopup(element) {
            var that = this;

            this.element = $(element);
            this.user = 0;

            this.element.find('.js-deny').on('click', function () {
                that.deny();
            });

            this.element.find('.js-cancel').on('click', function () {
                that.close();
            });
        }

        DenyPopup.prototype.show = function () {
            this.element.fadeIn();
        };

        DenyPopup.prototype.close = function () {
            this.element.fadeOut();
        };

        DenyPopup.prototype.deny = function () {
            var popup = this;

            $.ajax({
                method: 'POST',
                url: ajaxurl + '?action=deny_user',
                data: {
                    user: this.user,
                    role: this.role
                }
            }).done(function (response) {
                var successPopup = new SuccessPopup('.lms-success-popup', response.message);
                popup.close();
                successPopup.show();
            });
        };

        return DenyPopup;
    }();

    var InvitePopup = function () {
        function InvitePopup(element) {
            var that = this;

            this.element = $(element);
            this.error = this.element.find('.lms-invite-popup__error');

            this.element.find('select').on('change', function () {
                that.role = $(this).val();
                that.error.hide();
            });

            this.element.find('textarea').on('change', function () {
                that.emails = $(this).val();
                that.error.hide();
            });

            this.element.find('.js-invite').on('click', function () {
                that.invite();
            });
        }

        InvitePopup.prototype.show = function () {
            this.element.fadeIn();
        };

        InvitePopup.prototype.close = function () {
            this.element.fadeOut();
        };

        InvitePopup.prototype.invite = function () {
            var popup = this;

            $.ajax({
                method: 'POST',
                url: ajaxurl + '?action=invite_user',
                data: {
                    role: this.role,
                    emails: this.emails
                }
            }).done(function (response) {
                if (response.status === 'error') {
                    console.log(popup.error);
                    popup.error.text(response.message);
                    popup.error.show();
                } else {
                    var successPopup = new SuccessPopup('.lms-success-popup', response.message);
                    popup.close();
                    successPopup.show();
                }
            });
        };

        return InvitePopup;
    }();

    $(function () {
        var invitePopup = new InvitePopup('.lms-invite-popup'),
            acceptPopup = new AcceptPopup('.lms-accept-popup'),
            denyPopup = new DenyPopup('.lms-deny-popup');

        $('.js-invite-user').on('click', function (event) {
            invitePopup.show();

            event.preventDefault();
        });

        $('.js-accept-user').on('click', function (event) {
            acceptPopup.user = $(this).data('user');
            acceptPopup.show();

            event.preventDefault();
        });

        $('.js-deny-user').on('click', function (event) {
            denyPopup.user = $(this).data('user');
            denyPopup.show();

            event.preventDefault();
        });
    });
})(jQuery);