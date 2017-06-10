<div class="title">Нова замітка</div>
<div class="container page-block">
    <form action="" role="form">

        <div class="form-group name">
            <label for="name"><span class="text-danger">*</span> Імя</label>
            <input type="text" id="name" class="form-control">
            <div class="help-block"></div>
        </div>
        <hr>
        <div class="form-group email">
            <label for="email"><span class="text-danger">*</span> Електронна пошта</label>
            <input type="email" id="email" class="form-control">
            <div class="help-block"></div>
        </div>
        <hr>
        <div class="form-group site">
            <label for="site">Сайт</label>
            <input type="text" id="site" class="form-control">
            <div class="help-block"></div>
        </div>
        <hr>
        <div class="form-group message">
            <label for="message"><span class="text-danger">*</span> Текст замітки</label>
            <textarea name="message" id="message" class="form-control"></textarea>
            <div class="help-block"></div>
        </div>
        <hr>
        <div class="form-group captcha">
            <label for="captcha"><span class="text-danger">*</span> Провірочне число</label>
            <div class="c-container">
                <img src="/messages/getCaptcha" alt="">
            </div>
            <br>
            <input type="text" id="captcha" class="form-control">
            <div class="help-block"></div>
        </div>
        <hr>
        <div class="form-group">
            <button id="send" class="btn btn-primary">Надіслати</button>
            <div class="help-block"></div>
        </div>

    </form>
</div>