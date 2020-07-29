<?php
if (isset($_GET['message'])){
    echo "Платеж завершился неудачей. Ошибка: " . $_GET['message'];
}else{
    echo "Платеж завершился неудачей.";
}