function miniPopUp(type) {
    if (type == 'success') {
        $('body').append('<div class="popup"><div class="success"><span class="glyphicon glyphicon-ok ok"></span><span class="text">Виконано!</span></div></div>');
    } else if (type == 'error') {
        $('body').append('<div class="popup"><div class="error"><span class="glyphicon glyphicon glyphicon-remove x"></span><span class="text">Щось пішло не так!</span></div></div>');
    }
}
function closeMiniPopUp() {
    setTimeout(function () {
        $('.popup').remove();
    }, 5000);
}
function errorMessage(data) {
    for (var err in data) {
        $('.' + err + ' .help-block').html(data[err].message);
        $('.' + err).addClass('has-error');
    }
}


function mOpen() {
    $('#overlay').fadeIn(400,
        function () {
            $('#modal')
                .css('display', 'block')
                .animate({opacity: 1}, 200);
        });
}

function mClose() {
    $('#modal')
        .animate({opacity: 0}, 200, function () {
                $(this).css('display', 'none').html('');
                $('#overlay').fadeOut(400);
            }
        );
}

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function errorClose() {
    $('.form-group').click(function () {
        $(this).removeClass('has-error');
        $('.help-block', this).html('');
    });
}
function $_GET(key) {
    var s = window.location.search;
    s = s.match(new RegExp(key + '=([^&=]+)'));
    return s ? s[1] : false;
}

