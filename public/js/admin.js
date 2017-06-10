$(document).ready(function () {

    var getOrder = $_GET('order') !== false ? $_GET('order') : 'desc';
    var order = getOrder == 'desc' ? 'order=asc' : 'order=desc';

    var page = $_GET('page') !== false ? '&page=' + $_GET('page') : '';

    $('#name_sort').click(function () {
        window.location.href = '?' + order + '&by=name' + page;
    });

    $('#email_sort').click(function () {
        window.location.href = '?' + order + '&by=email' + page;
    });

    $('#date_sort').click(function () {
        window.location.href = '?' + order + '&by=date' + page;
    });

    /**
     * Відправка форми авторизації
     */

    $('#sendForm').click(function (event) {
        event.preventDefault();
        var data = {};
        data.login = $('#login').val();
        data.password = $('#password').val();

        $.ajax({
            type: 'post',
            url: '/auth',
            data: data,
            success: function (answer) {
                var response = JSON.parse(answer);
                if (response.status == 1) {
                    miniPopUp('success');
                    setTimeout(function () {
                        window.location.href = "/admin";
                    }, 1000);
                } else {
                    miniPopUp('error');
                    closeMiniPopUp();
                }
            }
        });
    });

    $('.delete').click(function () {
        var conf = confirm('Дійсно видалити?');
        var row = this;
        if (conf === true) {
            $.ajax({
                type: 'post',
                url: '/admin/messageDelete',
                data: {id: $(this).attr('data-toggle')},
                success: function (answer) {
                    var response = JSON.parse(answer);
                    if (response['status'] == "1") {
                        $(row).parents('tr').remove();
                        miniPopUp('success');
                    } else {
                        miniPopUp('error');
                    }
                    closeMiniPopUp();
                }


            });
        }
    });

    $('.edit').click(function () {
        var id = $(this).attr('data-toggle');
        $.ajax({
            type: 'post',
            url: '/admin/getEditForm',
            data: {id: id},
            success: function (answer) {
                $('#modal').html(answer);
                mOpen();
            }
        });
    });

    $('body').on('click', '#submit', function (event) {

        event.preventDefault();
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
                url: '/admin/saveChanges',
                data: {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                    site: $('#site').val(),
                    message: $('#message').val(),
                },
                success: function (answer) {
                    var response = JSON.parse(answer);
                    if (response.status == '1')
                        miniPopUp('success');
                    else
                        miniPopUp('error');
                    closeMiniPopUp();
                }
            });
        }
    });

    $('body').on('click', '#overlay', function () {
        mClose();
    });
    $('body').on('click', '#modal_close', function () {
        mClose();
    });
});

