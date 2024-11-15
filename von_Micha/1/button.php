<?php 
//Überprüfen, ob SESSION Funktionalität aktiviert ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

if (isset($_SESSION['gewinnSymbol'])) {
    echo "GewinnSymbol: ";
    var_dump($_SESSION['gewinnSymbol']);
    var_dump($_SESSION['GameOver']);
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>TIC TAC TOE</h1>

<form action="verarbeiten.php" method="POST">
    <table>       
        <?php    
            // functions.php einmalig einbinden
            require_once('functions.php');  
            // TIC TAC TOE Spielinformationen anzeigen                          
            tictactoe();
        ?>
    </table>
  <input type="submit" name="reset" value="RESET">
</form>

</body>
</html>