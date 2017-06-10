<div class="title">Менеджер заміток</div>
<div class="page-block container">

    <div id="modal" style="z-index: 4;"></div>
    <div id="overlay"></div>

    <table class="table table-bordered">
        <tr>
            <td>ІД</td>
            <td><span class="text-primary" id="name_sort" style="cursor: pointer;">Імя</span></td>
            <td><span class="text-primary" id="email_sort" style="cursor: pointer;">Е-Мейл</span></td>
            <td>Сайт</td>
            <td>Замітка</td>
            <td><span class="text-primary" id="date_sort" style="cursor: pointer;">Дата</span></td>
            <td>IP</td>
            <td>Браузер</td>
            <td>Дія</td>
        </tr>
        <?php if (isset($messages) && !empty($messages) && is_array($messages)) { ?>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= $message['id']; ?></td>
                    <td><?= $message['name']; ?></td>
                    <td><?= $message['email']; ?></td>
                    <td><?= $message['site']; ?></td>
                    <td><?= $message['message']; ?></td>
                    <td><?= $message['date']; ?></td>
                    <td><?= $message['ip']; ?></td>
                    <td><?= $message['browser']; ?></td>
                    <td width="69px;">
                        <button data-toggle="<?= $message['id']; ?>" class="btn btn-xs btn-primary edit"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button data-toggle="<?= $message['id']; ?>" class="btn btn-xs btn-danger delete"><span class="glyphicon glyphicon-remove"></span></button>
                    </td>
                </tr>
            <? endforeach;
        } else { ?>
            <tr>
                <td colspan="9" class="centered">Нажаль тут порожньо! :-(</td>
            </tr>
        <?php } ?>
    </table>
    <div class="centered">
        <?php if (isset($paginate))
            include(Q_PATH . '/application/core/components/paginate/get.php'); ?>
    </div>
</div>
</div>