<a href="<?php echo $html->url('/diler');?>">к списку заявок от поставщиков</a>
<h1>Заявка от поставщика от <?php echo $diler_info['DilerInfo']['stamp'];?></h1>
<div class="div-diler">
    <div class="div-diler-label">
        ФИО
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['fio']);?>
    </div>
    <div class="div-diler-label">
        Должность
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['workpost']);?>
    </div>
    <div class="div-diler-label">
        E-mail
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['email']);?>
    </div>
    <div class="div-diler-label">
        Телефон
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['phone']);?>
    </div>
    <div class="div-diler-label">
        Факс
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['fax']);?>
    </div>
    <div class="div-diler-label">
        Название компании
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['company_name']);?>
    </div>
    <div class="div-diler-label">
        Город
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['city']);?>
    </div>
    <div class="div-diler-label">
        Дата заявки
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['stamp']);?>
    </div>
    <div class="div-diler-label">
        Сообщение
    </div>
    <div class="div-diler-data">
        <?php echo htmlspecialchars($diler_info['DilerInfo']['note']);?>
    </div>
</div>