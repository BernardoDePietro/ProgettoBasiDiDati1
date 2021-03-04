<?php
session_start();
include ('config2.php');

if(isset($_SESSION['session_id'])) {
	header('Location: amministrazione.php');
	exit;
}

if(isset($_POST['login'])) {
	$email = $_POST['email'] ?? '';
	$password = $_POST['pass'] ?? '';

	if(empty($email) || empty($password)) {
        $msg = 'Inserisci email e password %s';
    } else {
        $check = autenticazione($email);

        $user = $check->fetch_assoc();
        $pwd = $user['Password'];

        if(!$user || !(md5($password) == $pwd)) {
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();

            $ruolo = @$_POST['Ruolo'] ?? '';
            if($ruolo == "direttore") {
                $location = 'Location: amministrazione.php';
                $_SESSION['session_user'] = $user['Matricola'];
                $_SESSION['ruolo'] = $ruolo;
            } else if($ruolo == "studente") {
                $location = 'Location: studente.php';
                $_SESSION['session_user'] = $user['Matricola'];
                $_SESSION['ruolo'] = $ruolo;
            } else if($ruolo == "personale") {
                $location = 'Location: personale.php';
                $_SESSION['session_user'] = $user['Matricola'];
                $_SESSION['ruolo'] = $ruolo;
            } else if($ruolo == "docente") {
                $location = 'Location: docente.php';
                $_SESSION['session_user'] = $user['Matricola'];
                $_SESSION['ruolo'] = $ruolo;
                $ufficio = $user['ID_Locale'];
                $_SESSION['ufficio'] = $ufficio;
            } else if($ruolo == "fornitore") {
                $location = 'Location: fornitore.php';
                $_SESSION['session_user'] = $user['ID_Fornitore'];
                $_SESSION['ruolo'] = $ruolo;
            } else {
                $location = 'Location: index.html';
            }
            
            header($location);
            exit;
        }
    }
    printf($msg, '<a href="index.html">torna indietro</a>');
}
?>