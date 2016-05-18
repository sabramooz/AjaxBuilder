<?php

if(isset($_POST["f_name"])) {

    echo "POST : <br>";
    var_dump($_POST);

    echo "GET : <br>";
    var_dump($_GET);

}

if(isset($_GET["getTime"])){

    echo date("Y/m/d - h:i:s",time());

}