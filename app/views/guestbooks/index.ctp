<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div class="div-guestbook-add div-form">
        <h2>Добавить сообщение</h2>
        <?php
        echo $form->create('Guestbook', array(
            'action' => 'add',
            'id' => 'form-guestbook'
        ));
        echo $form->input('name', array('label' => 'Имя','id'=>'input-guestbook-name'));
        echo $form->input('city', array('label' => 'Город','id'=>'input-guestbook-city'));
        echo $form->input('email', array('label' => 'E-mail','id'=>'input-guestbook-email'));
        echo $form->input('phone', array('label' => 'Телефон','id'=>'input-guestbook-phone'));
        echo $form->input('text', array('label' => 'Текст сообщения','id'=>'input-guestbook-text'));
        echo $form->submit('Отправить');
        echo $form->end();
        ?>
    </div>
    <div class="div-guestbooks">
    <h1>Гостевая книга</h1>
    <?php echo $this->element('paginate');?>
        <?php foreach($guestbooks as $guestbook) { ?>
        <div class="div-guestbook">
            <?php
            echo $html->div('div-guestbook-stamp', $guestbook['Guestbook']['created']);
            echo $html->div('div-guestbook-name', "{$guestbook['Guestbook']['name']} написал:");
            echo $html->div('div-guestbook-text', $guestbook['Guestbook']['text']);
            ?>
        </div>
        <?php } ?>
    </div>
</div>
