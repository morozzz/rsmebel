<?php
    foreach($users as $user) {
        echo $user['User']['username']." - ".$user['ClientInfo']['name']."<br>";
    }
?>