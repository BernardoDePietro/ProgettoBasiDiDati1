<?php
include('config2.php');
session_start();
            
if (isset($_SESSION['session_id'])) {
    $ruolo = @$_SESSION['ruolo'];
    if($ruolo == 'docente') {
        $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
        $session_id = htmlspecialchars($_SESSION['session_id']);   
        $id_ufficio = $_SESSION['ufficio'];
    } else {
        header("Location: area-riservata.html");
    }
} else {
    header("Location: index.html");
}
?>

<html>
<head>
    <title>Docente</title>
    <link rel="stylesheet" type="text/css" href="css/style-studente.css?ts=<?=time()?>&quot">
</head>
<body>
    <div id="header-bar">
        <?php $flag = @$_GET['operazione']; ?>
        <form id="form-menu" method="get" action='docente.php'>
            <input type='submit' value='Trova Locale' name='operazione' >
            <input type='submit' value='Oggetti Ufficio' name='operazione'>
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
            <h1>Pannello<br>del docente</h1>
            <p>In questo pannello troverai tutte le operazioni<br>che ogni docente può effettuare.</p><br>
            <form method="get" action="docente.php">
                <input type="submit" value="Trova Locale" name="operazione">
                <input type="submit" value="Oggetti Ufficio" name="operazione">
            </form>
        </center>
        </div>';
    }
    ?>
    <center>
    <?php
        switch($flag) {
            case 'Trova Locale':
                echo '<h2>Trova Locale</h2>';

                $locale = @$_POST['locale'];
                echo '<form class="form-locale" method="post" action="docente.php?operazione=Trova+Locale">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome del locale"><br>';
                echo '<input id="button-style" type="submit" value="Cerca locale"></form>';

                $result = joinLocale($locale);
                if(!empty($result)) {
                    echo '<br>';
                    echo '<table id="table-result">
                        <tr>
                            <th>Tipologia</th>
                            <th>Locale</th>
                            <th>Piano</th>
                            <th>Edificio</th>
                            <th>Dipartimento</th>
                        </tr>';
                    while($row = $result->fetch_row()) {
                        echo '<tr>
                                <td>'.$row[5].'</td>
                                <td>'.$row[1].'</td>
                                <td>'.$row[2].'</td>
                                <td>'.$row[3].'</td>
                                <td>'.$row[4].'</td>
                             </tr>';                             
                    }
                    echo '</table>';
                }

            break;

            case 'Oggetti Ufficio':
                echo '<h2>Visualizza gli oggetti del tuo ufficio</h2>';
                $result = joinOggettiLocale($id_ufficio);
                if(!empty($result)) {
                    echo '<table id="table-result">
                        <tr>
                            <th>#</th>
                            <th>Oggetto</th>
                            <th>Modello</th>
                        </tr>';
                    $i = 1;
                    while($row = $result->fetch_row()) {
                        echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$row[0].'</td>
                                <td>'.$row[2].'</td>
                             </tr>';
                        $i++;                             
                    }
                    echo '</table>';
                }
            break;
        }
    ?>
    </center>
</body>
</html>