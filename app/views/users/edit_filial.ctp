
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>

<div id="top-header1">
   <?php

     echo $form->create('User', array(
        'action' => 'edit_filial',
        'id' => 'user-register-form'
     ));

     echo $this->element('edit_filial_box');

     echo $form->end();
   ?>
</div>
