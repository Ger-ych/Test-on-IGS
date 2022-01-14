<?php

// Connect to MySQL. It is necessary to enter the correct data in production
$link = mysqli_connect('localhost', 'root', '', 'testigs');

// Kill the process on unsuccessful connection to MySQL
if(mysqli_connect_errno()) {
    echo 'Ошибка в подключении к БД MySQL ('.mysqli_connect_errno().'): '. mysqli_connect_error();
    exit();
}
