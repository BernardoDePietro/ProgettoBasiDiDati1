<?php
include('config2.php');
session_start();
            
if (isset($_SESSION['session_id'])) {
    $ruolo = @$_SESSION['ruolo'];
    if($ruolo == "personale") {
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
    <title>PERSONALE</title>
    <link rel="stylesheet" type="text/css" href="css/style-personale.css?ts=<?=time()?>&quot">
</head>
<body>
    <div id="header-bar">
        <?php $flag = @$_GET['operazione']; ?>
        <form id="form-menu" method="get" action='personale.php'>
            <input type='submit' value='Trova Locale' name='operazione' >
            <input type='submit' value='Oggetti Locale' name='operazione'>
            <input type='submit' value='Inserisci oggetto' name='operazione'>
            <input type='submit' value='Elimina oggetto' name='operazione'>
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
            <h1>Pannello del personale<br>universitario</h1>
            <p>In questo pannello troverai tutte le operazioni<br>che ogni componente del personale può effettuare.</p><br>
            <form method="get" action="personale.php">
                <input type="submit" value="Trova Locale" name="operazione">
                <input type="submit" value="Oggetti Locale" name="operazione">
                <input type="submit" value="Inserisci oggetto" name="operazione">
                <input type="submit" value="Elimina oggetto" name="operazione">
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
                echo '<form class="form-locale" method="post" action="personale.php?operazione=Trova+Locale">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome/numero del locale"><br>';
                echo '<input class="submit-style" type="submit" value="Cerca locale"></form>';

                $result = joinLocale($locale);
                if(!empty($result)) {
                    echo '<br><br>';
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

            case 'Oggetti Locale': {
                echo '<h2>Visualizza gli oggetti presenti in un locale</h2>';

                $locale = @$_POST['locale'];
                echo '<form class="form-locale" method="post" action="personale.php?operazione=Oggetti+Locale">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome/numero del locale"><br>';
                echo '<input class="submit-style" type="submit" value="Cerca locale"></form>';
                
                $id_locale = @$_POST['id_locale'];

                if(!empty($locale)) {
                    $result = joinLocale($locale);
                    echo '<form class="form-locale" method="post" action="personale.php?operazione=Oggetti+Locale">';
                    echo '<br><br><b>Seleziona locale</b><br><select class="select-style" name="id_locale">';
                    while($row = $result->fetch_row()) {
                        echo '<option value="'.$row[0].'">'.$row[4].' - '.$row[3].' - '.$row[1].'</option>';
                    }
                    echo '</select><br>';
                    echo '<input class="submit-style" type="submit" value="Visualizza oggetti"></form><br><br>';
                }

                if(!empty($id_locale)) {
                    $result = joinOggettiLocale($id_locale);
                    if(!empty($result)) {
                        echo '<br><br>';
                        echo '<table id="table-result">
                            <tr>
                                <th>#</th>
                                <th>ID Oggetto</th>
                                <th>Oggetto</th>
                                <th>Modello</th>
                            </tr>';
                        $i = 1;
                        while($row = $result->fetch_row()) {
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[2].'</td>
                                </tr>';                 
                            $i++;            
                        }
                        echo '</table>';
                    }
                }
            }
            break;

            case 'Inserisci oggetto':
                echo '<h2>Inserisci oggetto a un locale</h2>';

                $locale = @$_POST['locale'];
                echo '<form class="form-locale" method="post" action="personale.php?operazione=Inserisci+oggetto">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome/numero del locale"><br>';
                echo '<input class="submit-style" type="submit" value="Cerca locale"></form>';

                if(!empty($locale)) {
                    $result = joinLocale($locale);
                    echo '<form class="form-locale" method="get" action="aggiungi.php"';
                    echo '<br><br><b>Dipartimento - Edificio - Locale</b><br><select class="select-style" name="id_locale">';
                    while($row = $result->fetch_row()) {
                        echo '<option value="'.$row[0].'">'.$row[4].' - '.$row[3].' - '.$row[1].'</option>';
                    }
                    echo '</select><br>';
                    $result = joinOggettiMagazzino();
                    echo '<form method="get" action="aggiungi.php">';
                    echo '<input class="submit-style" type="submit" value="Inserisci oggetti">';

                    echo '<h3>Seleziona gli oggetti che vuoi inserire nel locale</h3>';
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
                        echo '</form>';
                    }
                }
            break; 

            case 'Elimina oggetto':
                echo '<h2>Elimina oggetto da un locale</h2>';
                
                $locale = @$_POST['locale'];
                echo '<form class="form-locale" method="post" action="personale.php?operazione=Elimina+oggetto">';
                echo '<input id="insert-locale" type="text" name="locale" placeholder="Inserisci il nome/numero del locale"><br>';
                echo '<input class="submit-style" type="submit" value="Cerca locale"></form>';

                $id_locale = @$_POST['id_locale'];
                if(!empty($locale)) {
                    $result = joinLocale($locale);
                    echo '<form class="form-locale" method="post" action="personale.php?operazione=Elimina+oggetto"';
                    echo '<br><br><b>Seleziona locale</b><br><select class="select-style" name="id_locale">';
                    while($row = $result->fetch_row()) {
                        echo '<option value="'.$row[0].'">'.$row[4].' - '.$row[3].' - '.$row[1].'</option>';
                    }
                    echo '</select><br>';
                    echo '<input class="submit-style" type="submit" value="Seleziona locale"></form>';
                }

                if(empty($locale)&&(!empty($id_locale))) {
                    $oggetti = joinOggettiLocale($id_locale);
                    echo '<form class="form-locale" method="get" action="aggiungi.php"';
                    echo '<br><b>Seleziona oggetto</b><br><select class="select-style" name="eliminare-oggetto">';
                    while($row = $oggetti->fetch_assoc()) {
                        echo '<option value="'.$row['ID_Oggetto'].'">'.$row['Nome'].'</option>';
                    }
                    echo '</select><br>';
                    echo '<input class="submit-style" type="submit" value="Elimina oggetto"></form>';
                }
            break;
        }
    ?>
</body>
</html>