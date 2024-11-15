<?php
//Überprüfen, ob SESSION Funktionalität aktiviert ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Startwert Setzen
if(!isset($_SESSION['Spielzug'])){
    
    // Startwert / Spielzug 1
    $_SESSION['Spielzug'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Schaltfläche RESET gewählt
    if (isset($_POST['reset'])) {

        // functions.php einmalig einbinden 
        require_once('functions.php');
        // Spiel Neustarten
        tictactoeReset();
        // Neue Zieladresse: button.php
        zurueckZumSpielfeld();  
    }
    // TIC TAC TOE Schaltfläche gewählt
    else{ 

        // functions.php einmalig einbinden 
        require_once('functions.php');
        // Schaltflächen Symbol erzeugen
        // Schaltfläche deaktivieren
        schaltflaecheBetaetigt();
        // Neue Zieladresse: button.php
        zurueckZumSpielfeld();
    }
} 
?>