<?php
include('config2.php');
session_start();
            
if (isset($_SESSION['session_id'])) {
    $ruolo = @$_SESSION['ruolo'];
    if($ruolo == "fornitore") {
        $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
        $session_id = htmlspecialchars($_SESSION['session_id']);
    } else {
        header("Location: area-riservata.html");
    }
} else {
    header("Location: index.html");
}
?>

<html>
<head>
    <title>FORNITORE</title>
    <link rel="stylesheet" type="text/css" href="css/style-fornitore.css?ts=<?=time()?>&quot">
</head>
<body>
    <div id="header-bar">
        <?php $flag = @$_GET['operazione']; ?>
        <form id="form-menu" method="get" action='fornitore.php'>
            <input type='submit' value='Prendi incarico' name='operazione' >
            <input type='submit' value='Completa incarico' name='operazione'>
        </form>
        <a href="logout.php">Logout</a>
    </div>
    <div id="image">
        <img src="img/unime-bianco-nero.png"/>
    </div> 
    <?php
    if(empty($flag)) {
        echo '<div id="background">
        <center>
            <h1>Pannello fornitori</h1>
            <p>In questo pannello troverai tutte le operazioni<br>che il fornitore può effettuare.</p><br>
            <form method="get" action="fornitore.php">
                <input type="submit" value="Prendi incarico" name="operazione">
                <input type="submit" value="Completa incarico" name="operazione">
            </form>
        </center>
        </div>';
    }
    ?>
    <center>
    <?php
        switch($flag) {
            case 'Prendi incarico':
                echo '<h2>Prendi un incarico di oggetti</h2>';
                $ordini = cercaOrdine();
                if($ordini != false) {
                    echo '<form method="get" action="aggiungi.php">';
                    $_SESSION['id_fornitore'] = $session_user;
                    if(!empty($ordini)) {
                        echo '<table id="table-result">
                            <tr>
                                <th>Seleziona</th>
                                <th>ID Ordine</th>
                                <th>Oggetto</th>
                                <th>Dipartimento</th>
                            </tr>';
                        while($row = $ordini->fetch_row()) {
                            echo '<tr>
                                    <td><input type="checkbox" name="ordine[]" value="'.$row[0].'"></td>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                </tr>';                             
                        }
                        echo '</table><br>';
                        echo '<input class="submit-style" type="submit" value="Corferma incarico"></form>';
                    }
                } else {
                    echo "<h4>Nessun incarico possibile</h4>";
                }
                
            break;
            
            case 'Completa incarico':
                echo '<h2>Completa incarico</h2>';
                $ordini = cercaOrdineFornitore($session_user);

                if($ordini != false) {
                    echo '<form method="get" action="aggiungi.php">';
                    $_SESSION['id_fornitore1'] = $session_user;
                    if(!empty($ordini)) {
                        echo '<table id="table-result">
                            <tr>
                                <th>Seleziona</th>
                                <th>ID Ordine</th>
                                <th>Oggetto</th>
                                <th>Dipartimento</th>
                            </tr>';
                        while($row = $ordini->fetch_row()) {
                            echo '<tr>
                                    <td><input type="checkbox" name="ordine1[]" value="'.$row[0].'"></td>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                </tr>';                             
                        }
                        echo '</table><br>';
                        echo '<input class="submit-style" type="submit" value="Completa incarico"></form>';
                    }
                } else {
                    echo "<h4>Nessun oggetto preso in carico</h4>";
                }
            break;

        }
    ?>
    </center>

</body>
</html>