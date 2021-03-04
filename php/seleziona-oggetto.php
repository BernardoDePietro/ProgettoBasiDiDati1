<?php
include('config2.php');
session_start();
            
if (isset($_SESSION['session_id'])) {
    $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
    $session_id = htmlspecialchars($_SESSION['session_id']);
} else {
    header("Location: index.html");
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style-admin.css?ts=<?=time()?>&quot">
</head>
<body>
    <center>
    <h2>Seleziona l'oggetto da utilizzare per il locale</h2>
    <?php
        $result = joinOggettiMagazzino();
        $locale = $_GET['locale-selezionato'];  
        $_SESSION['locale2'] = $locale;

        echo '<form method="get" action="aggiungi.php">';
        if(!empty($result)) {
            echo '<table id="table-result">
                <tr>
                    <th>Seleziona</th>
                    <th>Oggetto</th>
                    <th>Modello</th>
                </tr>';
            while($row = $result->fetch_row()) {
                echo '<tr>
                        <td><input type="checkbox" name="oggetto-selezionato[]" value="'.$row[3].'"></td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[2].'</td>
                        </tr>';                             
            }
            echo '</table><br>';
            echo '<input type="submit" value="Inserisci oggetti"></form>';
        }
    ?>
    </center>
</body>
</html>