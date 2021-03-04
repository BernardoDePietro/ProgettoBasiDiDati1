<?php
include ('config2.php');
session_start();

$flag = 0;

//INSERIMENTO DIPARTIMENTO (AMMINISTRATORE)
if ((isset($_GET['nome1']))&&(isset($_GET['via1']))&&(isset($_GET['cap1']))&&(isset($_GET['civ1'])))
{
    $nome1 = @$_GET['nome1'];
    $via1 = @$_GET['via1'];
    $cap1 = @$_GET['cap1'];
    $civ1 = @$_GET['civ1'];

    if(empty($nome1)) {
        echo "Errore: inserire il nome del dipartimento";
    } else {
        connetti();
        inserisciDipartimento(addslashes($nome1),addslashes($via1), addslashes($cap1), addslashes($civ1));
    }
    $flag = 1;
}

//INSERIMENTO EDIFICIO (AMMINISTRATORE)
if((isset($_GET['edificio']))&&(isset($_GET['dip']))) {
	$edificio = @$_GET['edificio'];
	$id_dip = @$_GET['dip'];

    if(empty($edificio)) {
        echo "Errore: inserire il nome dell'edificio";
    } else {
        connetti();
	    inserisciEdificio(addslashes($edificio), $id_dip);
    }
    $flag = 1;
}

//INSERIMENTO PIANO (AMMINISTRATORE)
if((isset($_GET['piano']))&&(isset($_GET['edificio']))) {
    $piano = @$_GET['piano'];
    $id_edificio = @$_GET['edificio'];

    if(empty($piano)) {
        echo "Errore: inserire il nome del piano";
    } else {
        connetti();
	    inserisciPiano(addslashes($piano), $id_edificio);
    }
    $flag = 1;
}

//INSERIMENTO LOCALE (AMMINISTRATORE)
if((isset($_GET['locale']))&&(isset($_GET['tipologia']))&&(isset($_GET['piano']))) {
    $locale = @$_GET['locale'];
    $id_piano = @$_GET['piano'];
    $id_tipologia = @$_GET['tipologia'];

    if(empty($locale)) {
        echo "Errore: inserire il nome del locale";
    } else {
        connetti();
        inserisciLocale(addslashes($locale), $id_piano, $id_tipologia);
    }
    $flag = 1;
}

//INSERIMENTO OGGETTO A MAGAZZINO (AMMINISTRATORE)
if((isset($_GET['oggetto']))&&(isset($_GET['modello']))&&(isset($_GET['quantita']))) {
    $oggetto = @$_GET['oggetto'];
    $id_modello = @$_GET['modello'];
    $quantita = @$_GET['quantita'];

    if(!empty($oggetto)) {
        connetti();
        for($i = 0; $i < $quantita; $i++) {
            inserisciOggetto(addslashes($oggetto), $id_modello);
            inserisciMagazzino(addslashes($oggetto));
            $id_magazzino = cerca_last_id_magazzino('magazzino');
            aggiorna_id_magazzino('oggetto', $id_magazzino);
        }

        echo "Nuovo oggetto inserito correttamente<br>";
            echo "<form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    } else {
        echo "Errore: inserire il nome dell'oggetto";
    }
    $flag = 1;
}

//INSERIMENTO NUOVO ORDINE OGGETTO (AMMINISTRAZIONE)
if((isset($_GET['oggetto1']))&&(isset($_GET['modello1']))&&(isset($_GET['quantita1']))) {
    $matricola = @$_SESSION['matricola'];
    $oggetto = @$_GET['oggetto1'];
    $quantita = @$_GET['quantita1'];
    $id_modello = @$_GET['modello1'];

    connetti();
    for($i = 0; $i < $quantita; $i++) {
        inserisciOrdine(addslashes($oggetto), $matricola);
        inserisciOggetto(addslashes($oggetto), $id_modello);
        $id_ordine = cerca_last_id_ordine('ordine');
        if(aggiorna_id_ordine('oggetto', $id_ordine)) {
            $stato = true;
        }
    }
    if($stato == true) {
        echo "Ordine effettuato correttamente<br>";
            echo "<form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    } else {
        echo "Errore nella creazione dell'ordine<br>";
            echo "<form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    }
    $flag = 1;
}

//INSERIMENTO NUOVO MODELLO OGGETTO (AMMINISTRATORE)
if(isset($_GET['nuovo-modello'])) {
    $modello = @$_GET['nuovo-modello'];

    connetti();
    inserisciModello($modello);
    $flag = 1;
}


//INSERIMENTO A INVENTARIO LOCALE (AMMINISTRATORE)
if((isset($_SESSION['locale2']))&&(isset($_GET['oggetto-selezionato']))) {
    $id_locale = @$_SESSION['locale2'];
    $id_magazzino = isset($_GET['oggetto-selezionato']) ? $_GET['oggetto-selezionato'] : array();
    connetti();
    foreach($id_magazzino as $oggetto) {
        if(aggiornaOggettoLocale($oggetto, $id_locale)) {
            if(eliminaOggettoMagazzino($oggetto)) {
                echo 'Oggetti inseriti correttamente';
                echo "<form action='amministrazione.php'>
                        <input type='submit' value='Ritorna indietro'/>
                    </form>";
            }
        }
    }
    $flag = 1;
}

//INSERIMENTO A INVENTARIO LOCALE (PERSONALE)
if((isset($_GET['id_locale']))&&(isset($_GET['oggetto-selezionato']))) {
    $id_locale = @$_GET['id_locale'];
    $id_magazzino = isset($_GET['oggetto-selezionato']) ? $_GET['oggetto-selezionato'] : array();

    connetti();
    foreach($id_magazzino as $oggetto) {
        if(aggiornaOggettoLocale($oggetto, $id_locale)) {
            if(eliminaOggettoMagazzino($oggetto)) {
                $stato = 1;
            } else {
            	$stato = 0;
            }
        }
    }
    if($stato == 1) {
    	echo 'Oggetti inseriti correttamente';
                echo "<form action='personale.php'>
                        <input type='submit' value='Ritorna indietro'/>
                    </form>";
    }
    $flag = 1;
}

//ELIMINAZIONE DI UN OGGETTO DALL'INVENTARIO LOCALE (PERSONALE)
if(isset($_GET['eliminare-oggetto'])) {
    $id_oggetto = @$_GET['eliminare-oggetto'];

    connetti();
    $id_magazzino = cerca_id_magazzino($id_oggetto);
    eliminaOggettoMagazzino($id_magazzino);
    eliminaOggetto($id_oggetto);
    $flag = 1;
}

//AGGIORNA STATO ORDINE OGGETTO (FORNITORE)
if((isset($_GET['ordine']))&&(isset($_SESSION['id_fornitore']))) {
    $id_fornitore = @$_SESSION['id_fornitore'];
    $ordine = isset($_GET['ordine']) ? $_GET['ordine'] : array();
    connetti();
    foreach($ordine as $id_ordine) {
        if(prendiInCaricoOggetti($id_fornitore, $id_ordine) == true) {
            $stato = true;
        } else {
            $stato = false;
        }
    }

    if($stato == true) {
        echo "Ordine preso in carico<br>";
        echo "<form action='fornitore.php'>
            <input type='submit' value='Ritorna indietro'/>
        </form>";
    }
    $flag = 1;
}

//INSERIMENTO ORDINE COMPLETATO (FORNITORE)
if(isset($_GET['ordine1'])&&(isset($_SESSION['id_fornitore1']))) {
    $id_fornitore = @$_SESSION['id_fornitore1'];
    $ordine = isset($_GET['ordine1']) ? $_GET['ordine1'] : array();

    connetti();
    foreach($ordine as $id_ordine) {
        $oggetto = cercaOggettoOrdine($id_ordine);
        $id_oggetto = cerca_id_oggetto_ordine($id_ordine);
        if(eliminaOrdine($id_ordine) === true) {
            if(inserisciMagazzino($oggetto) === true) {
                $id_magazzino = cerca_last_id_magazzino('magazzino');
                if(aggiorna_id_magazzino_oggetto($id_oggetto, $id_magazzino) === true) {
                    $stato = 1;
                } 
            }
        } 
    }
    if($stato = 1) {
        echo 'Stato ordine aggiornato correttamente';
        echo "<form action='fornitore.php'>
            <input type='submit' value='Ritorna indietro'/>
            </form>";
    }
    $flag = 1;
}

if($flag == 0) {
    echo "Errore durante l'operazione<br>";
    echo '<button onclick="goBack()">Go Back</button>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>';
}
?>
