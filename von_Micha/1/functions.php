<?php
// Überprüfen, ob SESSION Funktionalität aktiviert ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//======================================================================
// TIC TAC TOE Spiel-Funktionen
//======================================================================

/***** FUNKTION: Symbolwechsel
 * Funktionalität: 
 * Spielzug gerade (Symbol: O) oder ungerade (Symbol: X)
 * Bsp.: Spielzug 1 % 2 = REST vorhanden    => X
 * Bsp.: Spielzug 2 % 2 = KEIN REST         => O
********************************************************/
function setzeSymbol($spielzug) {

    if (fmod($spielzug, 2) == 0){
        // Setze den Wert der Session-Variable auf 'O' WEIL -> GERADE, Kein Rest
        $symbol = 'O';
    }else{
        $symbol = 'X';   
    } 
    // Spielzugzähler erhöhen -> 2 -> 3 -> 4 etc.
    $_SESSION['Spielzug']++;

    return $symbol;
}

/***** FUNKTION: RESET / SPIEL NEUSTARTEN 
 * Funktionalität: 
 * Session Informationen zurücksetzen
 * Neue Session ID erzeugen
*****************************************/
function tictactoeReset() {

    // Lösche und zerstöre die Session und starte sie neu
    session_unset();

    // Session-ID zerstören und neu generieren
    session_regenerate_id(true);
}

/***** FUNKTION: schaltflaecheBetaetigt 
 * Funktionalität: 
 * Welche Schaltfläche wurde betätigt
 * zugehörige SESSION-Schlüsselstellen erzeugen
***********************************************/
function schaltflaecheBetaetigt() {

    // Spielfeld 3x3  
    $maxZeilen = 2;
    $maxSpalten = 2;

    // 1. FOR-Schleife | Aufgabe: 3 Zeilen erzeugen
    for ($zeile=0; $zeile <= $maxZeilen; $zeile++) { 

        // 2. FOR-Schleife | Aufgabe: 3 Spalten , 3 Schaltflächen
        for ($spalte=0; $spalte <= $maxSpalten; $spalte++) { 

            // Zeichenkette für die Schlüsselstelle des $_POST Arrays erzeugen  
            $post_key = "b".$zeile.$spalte."";
                
            // Überprüfen, welche Schaltfläche betätigt wurde
            if (isset($_POST[$post_key])) {
                    
                // Symbolwert ermitteln und 
                // zugehörige SESSION-Schlüsselstelle für die betätigte Schaltfläche erzeugen
                require_once('functions.php');
                $_SESSION[$post_key] = setzeSymbol($_SESSION['Spielzug']);
                    
                // Zeichenkette für Schaltfläche deaktivieren vorbereiten und
                // zugehörige DISABLE SESSION-Schlüsselstelle für die betätigte Schaltfläche erzeugen
                $disablePostkey = "button_".$post_key."_disabled";
                $_SESSION[$disablePostkey] = "disabled";
            }
        }
    }
}

/***** FUNKTION: tictactoe 
 * Funktionalität: 
 * TIC TAC TOE Spielfeld 3x3 und 
 * Spielinformationen erzeugen
********************************/
function tictactoe() {

    $maxZeilen = 2;
    $maxSpalten = 2;
    // 1. FOR-Schleife | Aufgabe: 3 Zeilen erzeugen
    for ($zeile=0; $zeile <= $maxZeilen; $zeile++) { 
        echo "<tr>";
        // 2. FOR-Schleife | Aufgabe: 3 Spalten , 3 Schaltflächen
        for ($spalte=0; $spalte <= $maxSpalten; $spalte++) { 
            echo "<td>";
            $session_key_symbol = "b".$zeile.$spalte."";
            $session_key_disable_button = "button_".$session_key_symbol."_disabled";
            echo "<button type='input' name='b".$zeile.$spalte."'";
                if(isset($_SESSION[$session_key_disable_button])) {echo $_SESSION[$session_key_disable_button];}
            echo ">";
                if(isset($_SESSION[$session_key_symbol])) {echo $_SESSION[$session_key_symbol];}
            echo "</button>";
            echo "</td>";
        }                   
        echo "</tr>";
    }
}

/***** FUNKTION: zurueckZumSpielfeld 
 * Funktionalität: 
 * Zurück zur Spielansicht
********************************/
function zurueckZumSpielfeld() {
    
    return header("Location: button.php");
}
?>