<?php
try
{
    mysql_connect('127.0.0.1','root','321321');
    // other code you want to execute
}catch(Exception $e){
    print_r($e);
}
?>