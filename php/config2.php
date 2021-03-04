<?php
$servername = "localhost";
$username = "root";
$pass = "nuovapassword";
$dbname = "my_depietroprogetto";
$conn;

function connetti() {
    global $servername;
    global $username;
    global $pass;
    global $dbname;
    global $conn;
    // Create connection
    $conn = new mysqli($servername, $username, $pass, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function inserisciDipartimento($dip, $via, $cap, $civico) {
    global $conn;
    
    $sql = "INSERT INTO dipartimento (ID_Uni, Nome, Via, Cap, Civico) VALUES ('2','$dip', '$via', '$cap', '$civico')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuovo dipartimento inserito correttamente<br>
            <form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function inserisciLocale($locale, $id_piano, $id_tipologia) {
    global $conn;

    $sql = "INSERT INTO locale (ID_Piano, ID_Tipologia, Nome) VALUES ('$id_piano', '$id_tipologia', '$locale')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuovo locale inserito correttamente<br>
            <form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function cercaModello() {
    connetti();
    global $conn;

    $sql = "SELECT * FROM modello";

    $result = $conn->query($sql);
    return $result;
}

function inserisciOggetto($oggetto, $id_modello) {
    global $conn;

    $sql = "INSERT INTO oggetto (ID_Modello, Nome) VALUE ('$id_modello', '$oggetto')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function inserisciModello($modello) {
    global $conn;

    $sql = "INSERT INTO modello (Modello) VALUE ('$modello')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuovo modello inserito correttamente<br>";
        echo "<form action='amministrazione.php'>
            <input type='submit' value='Ritorna indietro'/>
        </form>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<form action='amministrazione.php'>
            <input type='submit' value='Ritorna indietro'/>
        </form>";
    }
}

function inserisciEdificio($edificio, $id_dip) {
    global $conn;

    $sql = "INSERT INTO edificio (ID_Dip, Nome) VALUE ('$id_dip', '$edificio')";

    if($conn->query($sql) === TRUE) {
        echo "Edificio inserito correttamente <br>";
        echo "<form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function cercaDipartimento() {
    connetti();
    global $conn;

    $sql = "SELECT * FROM dipartimento";

    $result = $conn->query($sql);
    return $result;
}

function cercaEdificio($id_dip) {
    connetti();
    global $conn;

    $sql = "SELECT * FROM edificio WHERE ID_Dip = '$id_dip'";

    $result = $conn->query($sql);
    return $result;
} 

function inserisciPiano($piano, $id_edificio) {
    global $conn;

    $sql = "INSERT INTO piano (ID_Edificio, Nome) VALUE ('$id_edificio', '$piano')";

    if($conn->query($sql) === TRUE) {
        echo "Piano inserito correttamente<br>";
        echo "<form action='amministrazione.php'>
                <input type='submit' value='Ritorna indietro'/>
            </form>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function cercaPiano($id_edificio) {
    connetti();
    global $conn;

    $sql = "SELECT * FROM piano WHERE ID_Edificio = '$id_edificio'";

    $result = $conn->query($sql);
    return $result;
} 

function cercaTipologia() {
    connetti();
    global $conn;

    $sql = "SELECT * FROM tipologia";
    $result = $conn->query($sql);
    return $result;
}

function autenticazione($email) {
    connetti();
    global $conn;

    //Query su direttore
    $sql = "SELECT * FROM direttore WHERE Email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $_POST['Ruolo'] = 'direttore';
        return $result;
    }

    //Query su studente
    $sql = "SELECT * FROM studente WHERE Email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $_POST['Ruolo'] = 'studente';
        return $result;
    }

    //Query su personale
    $sql = "SELECT * FROM personale WHERE Email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $_POST['Ruolo'] = 'personale';
        return $result;
    }

    //Query su docente
    $sql = "SELECT * FROM docente WHERE Email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $_POST['Ruolo'] = 'docente';
        return $result;
    }

    //Query su fornitore
    $sql = "SELECT * FROM fornitore WHERE Email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $_POST['Ruolo'] = 'fornitore';
        return $result;
    }
}

function controlloMatricola($matricola, $ruolo) {
    connetti();
    global $conn;

    $sql = "SELECT * FROM direttore WHERE Matricola = '$matricola'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

function cerca_last_id_magazzino($tabella) {
    global $conn;

    $sql = "SELECT ID_Magazzino FROM $tabella ORDER BY ID_Magazzino DESC Limit 1";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['ID_Magazzino'];
}

function cerca_last_id_ordine($tabella) {
    global $conn;

    $sql = "SELECT ID_Ordine FROM $tabella ORDER BY ID_Ordine DESC Limit 1";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['ID_Ordine'];
}

function aggiorna_id_magazzino($tabella, $id_magazzino) {
    global $conn;

    $sql = "UPDATE $tabella SET ID_Magazzino='$id_magazzino' ORDER BY ID_Oggetto DESC Limit 1";

    if($conn->query($sql) === TRUE) {
        //id    
    }
}

function aggiorna_id_ordine($tabella, $id_ordine) {
    global $conn;

    $sql = "UPDATE $tabella SET ID_Ordine='$id_ordine' ORDER BY ID_Oggetto DESC Limit 1";

    if($conn->query($sql) === TRUE) {
        return true; 
    } else {
        return false;
    }
}

function joinLocale($locale) {
    connetti();
    global $conn;

    $sql = "SELECT locale.ID_Locale, locale.Nome, piano.Nome, edificio.Nome, dipartimento.Nome, tipologia.Tipo
    FROM locale
    INNER JOIN piano ON locale.ID_Piano = piano.ID_Piano
    INNER JOIN edificio ON piano.ID_Edificio = edificio.ID_Edificio
    INNER JOIN dipartimento ON edificio.ID_Dip = dipartimento.ID_Dip 
    INNER JOIN tipologia ON tipologia.ID_Tipologia = locale.ID_Tipologia
    WHERE locale.Nome LIKE '%$locale%'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        return $result;
    }
}

function joinDocente($cognome) {
    connetti();
    global $conn;

    $sql = "SELECT docente.Nome, docente.Cognome, locale.Nome, piano.Nome, edificio.Nome, dipartimento.Nome
    FROM docente
    INNER JOIN locale ON docente.ID_Locale = locale.ID_Locale 
    INNER JOIN piano ON locale.ID_Piano = piano.ID_Piano
    INNER JOIN edificio ON piano.ID_Edificio = edificio.ID_Edificio
    INNER JOIN dipartimento ON edificio.ID_Dip = dipartimento.ID_Dip
    WHERE docente.Cognome = '$cognome'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        return $result;
    }
}

function inserisciOrdine($oggetto, $matricola) {
    global $conn;

    $sql = "INSERT INTO ordine (Mat_Direttore, Oggetto) VALUE ('$matricola', '$oggetto')";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function inserisciMagazzino($oggetto) {
    global $conn;

    $sql = "INSERT INTO magazzino (Nome) VALUE ('$oggetto')";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function cercaMagazzino() {
    connetti();
    global $conn;

    $sql = "SELECT * FROM magazzino";

    $result = $conn->query($sql);
    return $result;
}

function joinOggettiMagazzino() {
    connetti();
    global $conn;

    $sql = "SELECT oggetto.ID_Oggetto, oggetto.Nome, modello.Modello, magazzino.ID_Magazzino 
    FROM oggetto 
    INNER JOIN modello ON modello.ID_Modello = oggetto.ID_Modello 
    INNER JOIN magazzino ON magazzino.ID_Magazzino = oggetto.ID_Magazzino 
    ORDER BY ID_Oggetto ASC";

    $result = $conn->query($sql);
    return $result;
}

function aggiornaOggettoLocale($id_magazzino, $id_locale) {
    global $conn;

    $sql = "UPDATE oggetto SET ID_Locale='$id_locale' WHERE ID_Magazzino='$id_magazzino'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

}

function eliminaOggettoMagazzino($id_magazzino) {
    global $conn;

    $sql = "DELETE FROM magazzino WHERE ID_Magazzino = '$id_magazzino'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function joinOggettiLocale($id_locale) {
    connetti();
    global $conn;

    $sql = "SELECT oggetto.Nome, oggetto.ID_Oggetto, modello.Modello
    FROM oggetto
    INNER JOIN modello ON oggetto.ID_Modello = modello.ID_Modello
    WHERE oggetto.ID_Locale = '$id_locale'";

    $result = $conn->query($sql);
    return $result;
}

function eliminaOggetto($id_oggetto) {
    global $conn;

    $sql = "DELETE FROM oggetto WHERE ID_Oggetto = '$id_oggetto'";

    if($conn->query($sql) === TRUE) {
        echo 'Eliminazione oggetto riuscita';
        echo "<form action='personale.php'>
                    <input type='submit' value='Ritorna indietro'/>
                </form>";
    }
}

function cerca_id_magazzino($id_oggetto) {
    global $conn;

    $sql = "SELECT ID_Magazzino FROM oggetto WHERE ID_Oggetto = '$id_oggetto'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ID_Magazzino'];
    }
    return $result;
}

function cercaOrdine() {
    connetti();
    global $conn;

    $sql = "SELECT ordine.ID_Ordine, ordine.Oggetto, dipartimento.Nome
    FROM ordine
    INNER JOIN direttore ON direttore.Matricola = ordine.Mat_Direttore
    INNER JOIN dipartimento ON dipartimento.ID_Dip = direttore.ID_Dip
    WHERE Stato = '0'";

    $result = $conn->query($sql);
    return $result;
}

function prendiIncaricoOggetti($id_fornitore, $id_ordine) {
    global $conn;

    $sql = "UPDATE ordine SET ID_Fornitore = '$id_fornitore', Stato='1' WHERE ID_Ordine = '$id_ordine'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
} 

function cercaOrdineFornitore($id_fornitore) {
    connetti();
    global $conn;

    $sql = "SELECT ordine.ID_Ordine, ordine.Oggetto, dipartimento.Nome
    FROM ordine
    INNER JOIN direttore ON direttore.Matricola = ordine.Mat_Direttore
    INNER JOIN dipartimento ON dipartimento.ID_Dip = direttore.ID_Dip
    WHERE Stato = '1' && ID_Fornitore = '$id_fornitore'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function cercaOggettoOrdine($id_ordine) {
    global $conn;

    $sql = "SELECT Oggetto FROM ordine WHERE ID_Ordine = '$id_ordine'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Oggetto'];
    }
}

function eliminaOrdine($id_ordine) {
    global $conn;

    $sql = "DELETE FROM ordine WHERE ID_Ordine = '$id_ordine'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function aggiorna_id_magazzino_oggetto($id_oggetto, $id_magazzino) {
    global $conn;

    $sql = "UPDATE oggetto SET ID_Magazzino = '$id_magazzino' WHERE ID_Oggetto = '$id_oggetto'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function cerca_id_oggetto_ordine($id_ordine) {
    global $conn;

    $sql = "SELECT ID_Oggetto FROM oggetto WHERE ID_Ordine = '$id_ordine'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ID_Oggetto'];
    }
}

function cercaOrdiniAdmin($matricola) {
    connetti();
    global $conn;

    $sql = "SELECT * FROM ordine WHERE Mat_Direttore = '$matricola'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}
?>