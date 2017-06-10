<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    if (isset($js)) {
        foreach ($js as $path) {
            echo '<script src="' . $path . '"></script>';
        }
    }

    if (isset($css)) {
        foreach ($css as $path) {
            echo '<link rel="stylesheet" href="' . $path . '">';
        }
    }

    if (isset($title)) {
        echo '<title>' . $title . '</title>';
    } else {
        echo '<title>Title Not Found</title>';
    } ?>
</head>
<body>

<style type="text/css">#hellopreloader > p {
        display: none;
    }

    #hellopreloader_preload {
        display: block;
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-width: 1000px;
        background: #1BBC9B url(http://hello-site.ru//main/images/preloads/oval.svg) center center no-repeat;
        background-size: 166px;
    }</style>
<div id="hellopreloader">
    <div id="hellopreloader_preload"></div>
    <p><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p></div>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");
    function fadeOutnojquery(el) {
        el.style.opacity = 1;
        var interhellopreloader = setInterval(function () {
            el.style.opacity = el.style.opacity - 0.05;
            if (el.style.opacity <= 0.05) {
                clearInterval(interhellopreloader);
                hellopreloader.style.display = "none";
            }
        }, 16);
    }
    window.onload = function () {
        setTimeout(function () {
            fadeOutnojquery(hellopreloader);
        }, 500);
    };</script>

<header>
    <div class="container">
        <div class="row">
            <nav role="navigation" class="navbar navbar-inverse">
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand">Замітки</a>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/messages/create">Створити</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/admin">Адмінка</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

<?php if (is_file(Q_PATH . '/application/views/' . $view . '.php')) {

    include Q_PATH . '/application/views/' . $view . '.php';

} else { ?>

    <div class="container page-block">
        <div class="alert alert-danger">
            <b>Помилка!</b> Файл виду <?= Q_PATH ?>/application/views/<b><?= $view ?>.php</b> відсутній на
            сервері!
        </div>
    </div>

<?php } ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 centered">&copy; Арендач Тарас 08.06.2017</div>
            <div class="col-md-4"></div>
        </div>
    </div>
</footer>
</body>
</html>