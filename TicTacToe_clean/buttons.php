<?php
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
// var_dump($_SESSION);
echo S_SESSION['winCombo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        table {
            margin-top: 20px;
        }
        table td {
            padding: 5px;
        }
        button {
            width: 100px;
            height: 100px;
            font-size: 24px;
            background-color: #fff;
            border: 2px solid #000;
            cursor: pointer;
        }
        button.winner {
            background-color: #00ff00;
        }
        .message {
            margin-top: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <form action="test_verarbeiten_gewinner.php" method="POST">
        <table>
        <?php
        $maxZeilen = 3;
        $maxSpalten = 3;
        for ($zeile=0; $zeile<=$maxZeilen - 1; $zeile++){
            echo "<tr>";
            for ($spalte=0; $spalte<=$maxSpalten - 1; $spalte++){
                $hilfebut = 'b'.$zeile.$spalte;

                echo "<td>";

                    $disabled = '';
                    if (isset($_SESSION[$hilfebut.'_disabled'])){
                        $disabled = $_SESSION[$hilfebut.'_disabled'];
                    }
                    $class = '';
                    if (isset($_SESSION['winCombo']) && in_array($hilfebut, $_SESSION['winCombo'])) {
                        $class = 'winner';
                    }

                    echo "<button type='submit', name='$hilfebut', $disabled class='$class'>";
                    if (isset($_SESSION[$hilfebut])) {
                        echo $_SESSION[$hilfebut];
                    }
                    echo "</button>";
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
        </table>
        <br></br>

        <!-- <button type="submit" name="Gewinner">
            <?php
                if (isset($_SESSION['Gewinner'])) {
                    if ($_SESSION['Gewinner'] != 0){
                        echo $_SESSION['Gewinner'];
                    }  
                }
            ?>
        </button> -->
        <div class="message">
            <?php
            if (isset($_SESSION['Gewinner'])) {
                if ($_SESSION['Gewinner'] != 0){
                    echo $_SESSION['Gewinner'];
                }  
            }
            ?>
        </div>
        <button type="submit" name="Reset">RESET</button>
    </form>
</body>
</html>
