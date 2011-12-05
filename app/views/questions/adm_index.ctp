<?php
    echo $html->div('table-caption', 'Список сообщений пользователей');

    echo $form->create('Question', array(
        'action' => 'delete',
        'id' => 'question-edit-form'
    ));

    echo "<table class=\"data-table tree-table\" id=\"question-list-table\">";
    echo "<thead>";
    if ($cur_role_id == 3) {
            echo $html->tableHeaders(array(
                $html->div('questions_data', ''),
                $html->div('questions_data', 'Дата'),
                $html->div('questions_data', 'Сообщение'),
                $html->div('questions_data', 'Имя пользователя'),
                $html->div('questions_data', 'Телефон'),
                $html->div('questions_data', 'Е-mail'),
                $html->div('questions_data', 'Срочность'),
                $html->div('questions_data', 'Статус'),
                '',''
            ));
            echo "</thead>";

            echo "<tbody>";
            foreach($questions as $question) {

                if ($question['Question']['q_status'] == 0) {

                    echo $html->tableCells(array(
                        "<input type='checkbox' name='data[QuestionChk][".$question['Question']['id']."]' class='chb-special-select'>",
                        $question[0]['stamp'],
                        $question['Question']['question_body'],
                        $question['Question']['user_name'],
                        $question['Question']['phone'],
                        $question['Question']['email'],
                        $question['Question']['urgent'],
                        $question['Question']['q_status_name'],

                        $html->div('action',
                                $html->link('Ответ по E-mail',
                                   array(
                                    'controller' => 'questions',
                                    'action' => 'answer_send/'.$question['Question']['id']."/".$question['Question']['email']
                                ))
                        ),
                        $html->div('action',
                                $html->link('Ответ по телефону', array(
                                    'controller' => 'questions',
                                    'action' => 'change_status/'.$question['Question']['id']."/2"
                                ))
                        )
                        ));
                }
                else {
                    echo $html->tableCells(array(
                        "<input type='checkbox' name='data[QuestionChk][".$question['Question']['id']."]' class='chb-special-select'>",
                        $question[0]['stamp'],
                        $question['Question']['question_body'],
                        $question['Question']['user_name'],
                        $question['Question']['phone'],
                        $question['Question']['email'],
                        $question['Question']['urgent'],
                        $question['Question']['q_status_name'],
                        '', ''));
                }
            }
            echo "</tbody>";
            echo "</table>";

            echo "</fieldset>";

            echo $form->submit('Удалить');
    }
    else {
        echo $html->tableHeaders(array(
            $html->div('questions_data', 'Дата'),
            $html->div('questions_data', 'Сообщение'),
            $html->div('questions_data', 'Имя пользователя'),
            $html->div('questions_data', 'Телефон'),
            $html->div('questions_data', 'Е-mail'),
            $html->div('questions_data', 'Срочность'),
            $html->div('questions_data', 'Статус'),
            '',''
        ));
        echo "</thead>";

        echo "<tbody>";
        foreach($questions as $question) {

            if ($question['Question']['q_status'] == 0) {

                echo $html->tableCells(array(
                    $question[0]['stamp'],
                    $question['Question']['question_body'],
                    $question['Question']['user_name'],
                    $question['Question']['phone'],
                    $question['Question']['email'],
                    $question['Question']['urgent'],
                    $question['Question']['q_status_name'],

                    $html->div('action',
                            $html->link('Ответ по E-mail',
                               array(
                                'controller' => 'questions',
                                'action' => 'answer_send/'.$question['Question']['id']."/".$question['Question']['email']
                            ))
                    ),
                    $html->div('action',
                            $html->link('Ответ по телефону', array(
                                'controller' => 'questions',
                                'action' => 'change_status/'.$question['Question']['id']."/2"
                            ))
                    )
                    ));
            }
            else {
                echo $html->tableCells(array(
                    $question[0]['stamp'],
                    $question['Question']['question_body'],
                    $question['Question']['user_name'],
                    $question['Question']['phone'],
                    $question['Question']['email'],
                    $question['Question']['urgent'],
                    $question['Question']['q_status_name'],
                    '', ''));
            }
        }
        echo "</tbody>";
        echo "</table>";

        echo "</fieldset>";
    }
    echo $form->end();

?>


