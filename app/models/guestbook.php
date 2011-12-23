<?php

class Guestbook extends AppModel {
    var $name = 'Guestbook';
    var $order = 'Guestbook.sort_order, Guestbook.created DESC';
}

?>
