<?php
include('config2.php');
session_start();
            
if (isset($_SESSION['session_id'])) {
    $ruolo = @$_SESSION['ruolo'];
    if($ruolo == 'studente') {
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
    <title>STUDENTE</title>
    <link rel="stylesheet" type="text/css" href="css/style-studente.css?ts=<?=time()?>&quot">
</head>
<body>
    <div id="header-bar">
        <?php $flag = @$_GET['operazione']; ?>
        <form id="form-menu" method="get" action='studente.php'>
            <input type='submit' value='Trova Locale' name='operazione' >
            <input type='submit' value='Trova ufficio docente' name='operazione'>
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
            <h1>Pannello dello studente</h1>
            <p>In questo pannello troverai tutte le operazioni<br>disponibili per ogni studente.</p><br>
            <form method="get" action="studente.php">
                <input type="submit" value="Trova Locale" name="operazione">
                <input type="submit" value="Trova ufficio docente" name="operazione">
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
                echo '<form class="form-locale" method="post" action="studente.php?operazione=Trova+Locale">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome del locale"><br>';
                echo '<input id="button-style" type="submit" value="Cerca locale"></form>';

                $result = joinLocale($locale);
                if(!empty($result)) {
                    echo '<br><hr><br>';
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

            case 'Trova ufficio docente':
                echo '<h2>Trova ufficio docente</h2>';

                $cognome = @$_POST['cognome'];
                echo '<form class="form-locale" method="post" action="studente.php?operazione=Trova+ufficio+docente">';
                echo '<input id="insert-locale" type="text" name="cognome" placeholder="Inserisci il cognome del docente"><br>';
                echo '<input id="button-style" type="submit" value="Cerca ufficio"></form>';

                $result = joinDocente($cognome);
                if(!empty($result)) {
                    echo '<br><hr><br>';
                    echo '<table id="table-result">
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Locale</th>
                            <th>Piano</th>
                            <th>Edificio</th>
                            <th>Dipartimento</th>
                        </tr>';
                    while($row = $result->fetch_row()) {
                        echo '<tr>
                                <td>'.$row[0].'</td>
                                <td>'.$row[1].'</td>
                                <td>'.$row[2].'</td>
                                <td>'.$row[3].'</td>
                                <td>'.$row[4].'</td>
                                <td>'.$row[5].'</td>
                             </tr>';                             
                    }
                    echo '</table>';
                }
            break;
        }
    ?>
    </center>
</body>
</html>
