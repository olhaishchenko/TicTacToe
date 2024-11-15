<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['Spielzug'])){
    $_SESSION['Spielzug'] = 1;
}

if (!isset($_SESSION['Gewinner'])){
    $_SESSION['Gewinner'] = 0;
}
   

function symbolWechseln(){
    if (($_SESSION['Spielzug'] % 2) == 0) {
        $_SESSION['Symbol'] = 'O';
    }else{
        $_SESSION['Symbol'] = 'X';
        }
    $_SESSION['Spielzug']++;
    return $_SESSION['Symbol'];
    }


function endSpiel(){
    for ($i=0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            $hilfebut='b'.$i.$j;
            if (!isset($_SESSION[$hilfebut])){
                $_SESSION[$hilfebut.'_disabled'] = "disabled";
            }
        }
    }
}

function gewinnerUberprufung(){
    for ($i=0; $i<3; $i++){
        if (isset($_SESSION['b'.$i.'0']) && isset($_SESSION['b'.$i.'1']) && isset($_SESSION['b'.$i.'2'])){
            if ($_SESSION['b'.$i.'0'] == $_SESSION['b'.$i.'1'] && $_SESSION['b'.$i.'1'] == $_SESSION['b'.$i.'2'] && $_SESSION['b'.$i.'1'] != ''){
                $_SESSION['Gewinner'] = 1;
                return true;
            }
        }
        if (isset($_SESSION['b0'.$i]) && isset($_SESSION['b1'.$i]) && isset($_SESSION['b2'.$i])){
            if ($_SESSION['b0'.$i] == $_SESSION['b1'.$i] && $_SESSION['b1'.$i] == $_SESSION['b2'.$i] && $_SESSION['b1'.$i] != ''){
                $_SESSION['Gewinner'] = 1;
                return true;
            }
        }
    }  
   
    if (isset($_SESSION['b00']) && isset($_SESSION['b11']) && isset($_SESSION['b22'])){
        if ($_SESSION['b00'] == $_SESSION['b11'] && $_SESSION['b11'] == $_SESSION['b22'] && $_SESSION['b11'] != ''){
            $_SESSION['Gewinner'] = 1;
            return true;
        }
    }elseif (isset($_SESSION['b20']) && isset($_SESSION['b11']) && isset($_SESSION['b02'])){
        if ($_SESSION['b20'] == $_SESSION['b11'] && $_SESSION['b11'] == $_SESSION['b02'] && $_SESSION['b11'] != ''){
            $_SESSION['Gewinner'] = 1;
            return true;
        }
        
    }

    if($_SESSION['Spielzug'] == 10){
        $_SESSION['Gewinner'] = 2;
        return true;
    }
    return false;
}

for ($i=0; $i<3; $i++){
    for($j=0; $j<3; $j++){
        $hilfebut='b'.$i.$j;
        if (isset($_POST[$hilfebut])){
            $_SESSION[$hilfebut] = symbolWechseln();
            $_SESSION[$hilfebut.'_disabled'] = "disabled";
            if (gewinnerUberprufung() && $_SESSION['Gewinner'] != 2){
                $_SESSION['Gewinner'] = $_SESSION['Symbol'].' hat gewonnen';
                endSpiel();
                //Warum bruchen wir hier?
                header('Location: buttons.php');
                // und hier?
                exit();
            }
            if(gewinnerUberprufung() && $_SESSION['Gewinner'] == 2){
                $_SESSION['Gewinner'] = 'Unentschieden';
                // echo $_SESSION['Gewinner'];
                // header('Location: buttons.php');
                // exit();
            }
            header('Location: buttons.php');
            // exit();
        } elseif (isset($_POST['Reset'])){
            session_unset(); //Session loswerden
            // session_destroy();
            // session_start();
        
            session_regenerate_id(true);
            header('Location: buttons.php');
            // exit();
        }
    }
}
?>