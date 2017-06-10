$(document).ready(function () {
    $('#send').click(function (event) {

        event.preventDefault();

        var captcha = validator({
            captcha: {
                rules: 'min:4|max:4',
                data: $('#captcha').val(),
                message: 'Заповніть провірочне число!',
            }
        });

        if (captcha !== true) {
            errorMessage(captcha);
            errorClose();
        } else {
            $.ajax({
                type: 'post',
                url: '/messages/checkCaptcha',
                data: {
                    captcha: $('#captcha').val()
                },
                success: function (answer) {
                    var response = JSON.parse(answer);
                    if (response.status == '0') {
                        $('.c-container img').remove();
                        $('.c-container').html('<img src="/messages/getCaptcha">');
                        errorMessage({
                            captcha: {
                                message: 'Ви ввели невірно провірочне число!'
                            }
                        });
                        errorClose();
                        return false;
                    }
                }
            });
        }

        var data = validator({
            name: {
                rules: 'required|min:2',
                data: $('#name').val(),
                message: 'Заповніть дане поле!'
            },
            email: {
                rules: 'email',
                data: $('#email').val(),
                message: 'Заповніть дане поле коректно!'
            },
            message: {
                rules: 'min:10',
                data: $('#message').val(),
                message: 'Заповніть дане поле!'
            }
        });

        if (data !== true) {
            errorMessage(data);
            errorClose();
        } else {
            $.ajax({
                type: 'post',
                url: '/messages/postCreate',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    site: $('#site').val(),
                    message: $('#message').val(),
                    captcha: $('#captcha').val()
                },
                success: function (answer) {
                    var response = JSON.parse(answer);
                    if (response.status == '1') {
                        window.location.href = '/';
                    } else {
                        miniPopUp('error');
                        closeMiniPopUp();
                        $('.c-container img').remove();
                        $('.c-container').html('<img src="/messages/getCaptcha">');
                    }
                }
            });
        }
    });
});