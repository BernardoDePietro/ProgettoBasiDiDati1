<div id="content">
<?php
include('config2.php');
echo '<link rel="stylesheet" type="text/css" href="css/style-admin.css?ts=<?=time()?>&quot">';
session_start();

if (isset($_SESSION['session_id'])) {
	$ruolo = @$_SESSION['ruolo'];
	if($ruolo == "direttore") {
		$session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
		$session_id = htmlspecialchars($_SESSION['session_id']);
		
		printf("Matricola: <b>%s</b>", $session_user);
		echo "<br>";
		echo '<a href="logout.php">Logout</a>';
	} else {
		header("Location: area-riservata.html");
	}
} else {
	header("Location: index.html");
}

$flag=@$_GET['caso'];
echo "<center><form class='form-operazioni' method='get' action='amministrazione.php'>
	<h1>Pannello Amministrativo</h1>
    Seleziona l'operazione da compiere:<br><br>
	<select name='caso'>
		<option>Operazione...</option>
    	<option>Aggiungi piano</option>
    	<option>Aggiungi dipartimento</option>
   	 	<option>Aggiungi locale</option>
		<option>Aggiungi edificio</option>
		<option>Aggiungi oggetto a magazzino</option>
		<option>Crea nuovo ordine di oggetti</ordine>
    	<option>Aggiungi a inventario locale</option>
		<option>Aggiungi nuovo modello</option>
		<option>Visualizza ordini in sospeso</option>
	</select>
    <br><input type='submit' value='Vai'>
    </form>
	</center>
	<br>
";

?>
</div>
<?php
echo '<center>';
switch($flag) {
    case 'Aggiungi dipartimento':
        echo "<h2 class='title-operazione'> Aggiungi dipartimento </h2>";
        {
            echo "<form method='get' action='aggiungi.php'>
                <b class='form-label'>Nome</b><br><input class='form-input' type='text' name='nome1'> <br>
                <b class='form-label'>Via</b><br><input class='form-input' type='text' name='via1'> <br>
                <b class='form-label'>Cap</b><br><input class='form-input' type='text' name='cap1'> <br>
                <b class='form-label'>Civico</b><br><input class='form-input' type='text' name='civ1'> <br>";
            echo "<input class='submit-style' type='submit' value='Aggiungi a universita'></form>";
        }
        break;

    case 'Aggiungi oggetto a magazzino':
        echo "<h2> Aggiungi oggetto a magazzino</h2>";
        {
        	echo "<form method='get' action='aggiungi.php'>
				<b>Nome oggetto</b><br><input class='form-input type='text' name='oggetto'><br><br>";
				
				//Visualizza modelli
				$modelli = cercaModello();
				echo "<b>Tipologia</b><br><select class='select-style' name='modello'>";
				while ($row = $modelli->fetch_assoc()) {
					echo "<option value='".$row['ID_Modello']."'>" .$row['Modello']. "</option>";
				}
				echo "</select><br><br>";

				echo "<b>Quantita</b><br><select class='select-style' name='quantita'>";
				for($i = 1; $i < 21; $i++) {
					echo '<option>' .$i. '</option>';
				}
				echo '</select><br><br>';
            echo "<input class='submit-style' type='submit' value='Aggiungi oggetto'></form>";
		}
		break;

	case 'Aggiungi edificio': 
		echo "<h2>Aggiungi edificio</h2>";
		{
			echo "<form method='get' action='aggiungi.php'>
				<b class='form-label'>Nome edificio</b><br><input class='form-input' type='text' name='edificio'><br><br>";
				$dipartimenti = cercaDipartimento();
				echo "<b>Dipartimento</b><br>";
				echo "<select class='select-style' name='dip'>";
				while ($row = $dipartimenti->fetch_assoc()) {
					echo "<option value='".$row['ID_Dip']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br>";
			echo "<input class='submit-style' type='submit' value='Aggiungi edificio'></form>";
		}
		break;

	case 'Aggiungi piano':
		echo "<h2>Aggiungi piano</h2>";
		{
			$dipartimenti = cercaDipartimento();
			$flag_dip = @$_POST['dip'];
			if(empty($flag_dip)) {
				echo "<form method='post' action='amministrazione.php?caso=Aggiungi+piano'>";
				echo "<b>Dipartimento</b><br><select class='select-style' name='dip'>";
				while ($row = $dipartimenti->fetch_assoc()) {
					echo "<option value='".$row['ID_Dip']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br>";
				echo "<input class='submit-style' type='submit' value='vedi edifici'></form>";
			}

			if(!empty($flag_dip)) {
				$edifici = cercaEdificio($flag_dip);
				echo "<form method='get' action='aggiungi.php'>";
				echo "<b>Edificio</b><br><select class='select-style' name='edificio'>";
				while ($row = $edifici->fetch_assoc()) {
					echo "<option value='".$row['ID_Edificio']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br><br>";
				
				echo "<br><b class='form-label'>Nome piano</b><br><input class='form-input' type='text' name='piano'>
				<br><input class='submit-style' type='submit' value='inserisci piano'></form>";
			}
		}
		break;

	case 'Aggiungi locale':
		echo "<h2>Aggiungi locale</h2>";
		{
			$flag_dip = @$_POST['dip'];
			$flag_edificio = @$_POST['edificio'];
			
			//Visualizza dipartimenti 
			$dipartimenti = cercaDipartimento();
			if(empty($flag_dip) && empty($flag_edificio)) {
				echo "<form method='post' action='amministrazione.php?caso=Aggiungi+locale'>";
				echo "<b>Dipartimento </b><br>";
				echo "<select class='select-style' name='dip'>";
				while ($row = $dipartimenti->fetch_assoc()) {
					echo "<option value='".$row['ID_Dip']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br>";
				echo "<input class='submit-style' type='submit' value='vedi edifici'></form>";
			}

			//Visualizza edifici
			$edifici = cercaEdificio($flag_dip);
			if(!empty($flag_dip) && empty($flag_edificio)) {
				echo "<form method='post' action='amministrazione.php?caso=Aggiungi+locale'>";
				echo "<b>Edificio </b><br><select class='select-style' name='edificio'>";
				while ($row = $edifici->fetch_assoc()) {
					echo "<option value='".$row['ID_Edificio']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br>";
				echo "<input class='submit-style' type='submit' value='vedi piani'></form>";
			}

			//Visualizza piani
			if(empty($flag_dip) && !empty($flag_edificio)) {
				echo "<form method='get' action='aggiungi.php'>";
				$piani = cercaPiano($flag_edificio);
				echo "<b>Piano </b><br><select class='select-style' name='piano'>";
				while ($row = $piani->fetch_assoc()) {
					echo "<option value='".$row['ID_Piano']."'>" .$row['Nome']. "</option>";
				}
				echo "</select><br><br>";

				//Visualizza tipologia
				$tipologie = cercaTipologia();
				echo "<b>Tipologia</b><br><select class='select-style' name='tipologia'>";
				while ($row = $tipologie->fetch_assoc()) {
					echo "<option value='".$row['ID_Tipologia']."'>" .$row['Tipo']. "</option>";
				}
				echo "</select><br>";

				echo "<br><b class='form-label'>Nome Locale</b><br><input class='form-input' type='text' name='locale'><br>
					<input class='submit-style' type='submit' value='inserisci locale'></form>";
			}
		}
		break;

	case 'Aggiungi a inventario locale':
		echo "<h2>Aggiungi oggetto all'inventario del locale</h2>";
		
		$locale = @$_POST['locale'];
		if(empty($locale)) {
			echo '<form class="form-locale" method="post" action="amministrazione.php?caso=Aggiungi+a+inventario+locale">';
			echo '<input class="form-input" type="text" name="locale" placeholder=" Inserisci il nome del locale"><br>';
			echo '<input class="submit-style" type="submit" value="Cerca locale"></form>';
		}

		if(!empty($locale)) {
			$result = joinLocale($locale);
			echo '<form class="form-locale" method="get" action="seleziona-oggetto.php">';
			echo '<b>Dipartimento - Edificio - Locale</b><br><select class="select-style" name="locale-selezionato">';
				while($row = $result->fetch_row()) {
					echo '<option value="'.$row[0].'">'.$row[4].' - '.$row[3].' - '.$row[1].'</option>';
				}
			echo '</select><br>';
			echo "<input class='submit-style' type='submit' value='seleziona locale'></form>";
		}
	break;

	case 'Crea nuovo ordine di oggetti': 
		echo '<h2>Creazione Ordine</h2>';
		{
			echo "<form method='get' action='aggiungi.php'>";
			
			$_SESSION['matricola'] = $session_user;

			$oggetto = @$_GET['oggetto'];
			echo "<b>Oggetto</b><br><input class='form-input' type='text' name='oggetto1'><br>";

			//Visualizza i modelli
			$modelli = cercaModello();
			echo '<b>Modello</b><br><select class="select-style" name="modello1">';
			while($row = $modelli->fetch_assoc()) {
				echo '<option value="'.$row['ID_Modello'].'">'.$row['Modello'].'</option>';
			}
			echo '</select><br><br>';
			echo '<input class="select-style" type="number" name="quantita1" step="1" min="1"><br><br>';
			echo "<input class='submit-style' type='submit' value='Crea ordine'></form>";
		}
	break;

	case 'Aggiungi nuovo modello':
		echo '<h2>Aggiungi nuovo modello oggetto</h2>';
		{
			echo "<form method='get' action='aggiungi.php'>";
			echo "<b>Modello</b><br><input class='form-input' type='text' name='nuovo-modello'><br>";
			echo "<input class='submit-style' type='submit' value='Inserisci modello'>";
		}	
	break;

	case 'Visualizza ordini in sospeso':
		echo '<h2>Visualizzazione degli ordini effettuati</h2>';
		$ordini = cercaOrdiniAdmin($session_user);
		if($ordini != false) {
			echo '<table id="table-result">
				<tr>
					<th>ID Ordine</th>
					<th>Direttore</th>
					<th>Oggetto</th>
					<th>Stato</th>
				</tr>';
			while($row = $ordini->fetch_row()) {
				$stato = $row[4];
				if($stato == 0) {
					$msg = "non preso in carico";
				} else {
					$msg = "preso in carico";
				}
				echo '<tr>
						<td>'.$row[0].'</td>
						<td>'.$row[1].'</td>
						<td>'.$row[3].'</td>
						<td>'.$msg.'</td>
					 </tr>';                             
			}
			echo '</table>';
		}
}
echo "</center>";
?>