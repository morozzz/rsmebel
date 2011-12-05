<?php

class Question extends AppModel {
    var $name = 'Question';

    var $validate = array(

        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Неверный адрес электронной почты',
                'last' => true
            )
         ),
        'question_body' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Введите текст сообщения',
                'last' => true
            )
         )
    );


}

?>
