<span id="modal_close">X</span>
<form role="form" class="addForm" id="form">
    <input type="hidden" value="<?= $message['id']; ?>" id="id">
    <div class="form-group name">
        <label for="name">Імя</label>
        <input type="text" id="name" class="form-control" value="<?= $message['name']; ?>">
        <div class="help-block"></div>
    </div>
    <hr>
    <div class="form-group email">
        <label for="email">Електронна пошта</label>
        <input type="email" id="email" class="form-control"  value="<?= $message['email']; ?>">
        <div class="help-block"></div>
    </div>
    <hr>
    <div class="form-group site">
        <label for="site">Сайт</label>
        <input type="text" id="site" class="form-control" value="<?= $message['site']; ?>">
        <div class="help-block"></div>
    </div>
    <hr>
    <div class="form-group message">
        <label for="message">Повідомлення</label>
        <textarea id="message" class="form-control"> <?= $message['message']; ?></textarea>
        <div class="help-block"></div>
    </div>
    <hr>
    <div class="form-group">
        <button id="submit" class="btn btn-success">Зберегти</button>
    </div>

</form>


