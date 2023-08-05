<?php

define('db_user', 'gradili');
define('db_pswd', 'grad7725@');
define('db_host', 'localhost');
define('db_name', 'gmy_d_web_i_sit_li');

try{
    $dbcon = new mysqli(db_host, db_user, db_pswd, db_name);
    mysqli_set_charset($dbcon, 'utf8');

} catch (Exception $e) {
    echo "System is updating please try later";
} catch (Error $e){
    echo "System is updating please try later";
}
// echo "Database connected<br>";
?>
