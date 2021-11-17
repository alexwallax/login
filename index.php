<?php

    //para da acesso a págian index.php apenas quem tiver acesso
    session_start();

    //$_SESSIOn variavel glogal que guarda os dados de sessão
    if(isset($_SESSION['id']) && empty($_SESSION['id']) == false) {
        

        header("Location: page.php");
        //header("Location: index.php");


    } else {
        header("Location: login.php"); //redirecionar para página de login.php
    }



?>