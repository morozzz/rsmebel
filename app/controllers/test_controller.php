<?php

class TestController extends AppController {
    var $name = 'Test';
    var $uses = array(

    );
    var $components = array(
        'SendEmail'
    );

    function index() {
//        echo $this->SendEmail->send2(
//                'zic@mail.ru',
//                'test',
//                '<div>fsdfsd</div>
//                <div>hgh
//                    <img alt="" src="/img/notes/imfdfsdfage-2.gif" style="width: 98px; height: 13px; " />
//                    fghfg
//                    <img alt="" src="/img/catalog/image-2903.jpg" style="width: 98px; height: 13px; " />
//                </div>');
        die;
    }
}

?>
