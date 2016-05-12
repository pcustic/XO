<?php


class KriKru{
	protected $ploca, $prviIgrac, $drugiIgrac, $gameOver;
	protected $errorMsg,$naRedu,$pobjednik;

	function __construct(){
		$this->prviIgrac = false;
		$this->drugiIgrac = false;

		$this->ploca = array();
		for($i=0;$i<9;$i++)
			$this->ploca[$i]="?";
		
		$this->naRedu = 1;

		$this->gameOver = false;
		$this->errorMsg = false;
		$this->pobjednik = false;
	}

	function ispisiPocetnuFormu(){
		//ispis forme za unos imena

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Igra XO - Dobrodošli!</title>
			<link rel="stylesheet" type="text/css" href="still.css">
		</head>
		<body>
			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>">
				<div id="unos">
					<h1>Dobrodošli u igru XO!</h1>
					Unesite ime prvog igrača: 
					<input type="text" name="prviIgrac" />
					<br/><br/>
					Unesite ime drugog igrača:
					<input type="text" name="drugiIgrac" />
					<br/>
					<button type="submit">Pošalji!</button>
				</div>
			</form>

			<?php if( $this->errorMsg !== false ) echo '<p class="greska">Greška: ' . htmlentities( $this->errorMsg ) . '</p>'; ?>
		</body>
		</html>

		<?php
	}

	function get_imeIgraca(){
		// Je li već definirano ime igrača?
		if( ($this->prviIgrac !== false) && ($this->drugiIgrac !== false))
			return true;

		if( isset( $_POST['prviIgrac'] ) ){
			// Šalje nam se ime igrača. Provjeri da li se sastoji samo od slova.
			if( !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['prviIgrac'] ) ){
				// Nije dobro ime. Dakle nemamo ime prvog igrača.
				$this->errorMsg = 'Ime igrača treba imati između 1 i 20 slova.';
				return false;
			}
		}
		else
			return false;


		if( isset( $_POST['drugiIgrac'] ) ){
			// Šalje nam se ime igrača. Provjeri da li se sastoji samo od slova.
			if( !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['drugiIgrac'] ) ){
				// Nije dobro ime. Dakle nemamo ime prvog igrača.
				$this->errorMsg = 'Ime igrača treba imati između 1 i 20 slova.';
				return false;
			}
		}
		else
			return false;

		$this->prviIgrac = $_POST['prviIgrac'];
		$this->drugiIgrac = $_POST['drugiIgrac'];
		return true;
	}


	function ispisiFormuZaIgru(){

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Igra XO!</title>
			<link rel="stylesheet" type="text/css" href="still.css">
		</head>
		<body>
			
			<h1>Dobrodošli u igru XO!</h1>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="0" />
				<button type="submit" class="polje"><?php echo $this->ploca[0] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="1" />
				<button type="submit" class="polje"><?php echo $this->ploca[1] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="2" />
				<button type="submit" class="polje"><?php echo $this->ploca[2] ?></button>
			</form>

			<br/>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>">
				
				<input type="hidden" name="3" />
				<button type="submit" class="polje"><?php echo $this->ploca[3] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="4" />
				<button type="submit" class="polje"><?php echo $this->ploca[4] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="5" />
				<button type="submit" class="polje"><?php echo $this->ploca[5] ?></button>
			</form>

			<br/>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="6" />
				<button type="submit" class="polje"><?php echo $this->ploca[6] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="7" />
				<button type="submit" class="polje"><?php echo $this->ploca[7] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="8" />
				<button type="submit" class="polje"><?php echo $this->ploca[8] ?></button>
			</form>

			<p>Na redu je <?php if($this->naRedu == 1) 
				echo $this->prviIgrac . " (igrač o).";
				else echo $this->drugiIgrac . " (igrač x)."; ?> </p>

			<?php if( $this->errorMsg !== false ) echo '<p class="greska">Greška: ' . htmlentities( $this->errorMsg ) . '</p>'; ?>

			
			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				<input type="hidden" name="resetiraj" />
				<button type="submit">Resetiraj igru!</button>
			</form>
		</body>
		</html>

		<?php
	}

	
	function ispisiCestitku(){

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Igra XO!</title>
			<link rel="stylesheet" type="text/css" href="still.css">
		</head>
		<body>
			
			<h1>Dobrodošli u igru XO!</h1>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="0" />
				<button type="submit" <?php if(isset($_SESSION['0'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?>> <?php echo $this->ploca[0]; ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="1" />
				<button type="submit"<?php if(isset($_SESSION['1'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[1] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="2" />
				<button type="submit" <?php if(isset($_SESSION['2'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[2] ?></button>
			</form>

			<br/>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>">
				
				<input type="hidden" name="3" />
				<button type="submit"  <?php if(isset($_SESSION['3'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[3] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="4" />
				<button type="submit" <?php if(isset($_SESSION['4'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[4] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="5" />
				<button type="submit"  <?php if(isset($_SESSION['5'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?>> <?php echo $this->ploca[5] ?></button>
			</form>

			<br/>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="6" />
				<button type="submit"  <?php if(isset($_SESSION['6'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[6] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="7" />
				<button type="submit"  <?php if(isset($_SESSION['7'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[7] ?></button>
			</form>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				
				<input type="hidden" name="8" />
				<button type="submit"  <?php if(isset($_SESSION['8'])) echo 'class="polje pob"'; else echo 'class="polje"'; ?> ><?php echo $this->ploca[8] ?></button>
			</form>

			<?php 
				if($this->pobjednik === false)
					echo "<p>Neodlučeno!</p>";
				else if($this->pobjednik === 'o')
					echo '<p class="win">Čestitamo! Pobjednik je ' . $this->prviIgrac . " (igrac o)!</p>";
				else
					echo '<p class="win">Čestitamo! Pobjednik je ' . $this->drugiIgrac . " (igrac x)!</p>";
			?>

			<form method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF']); ?>" >
				<input type="hidden" name="resetiraj" />
				<button type="submit">Resetiraj igru!</button>
			</form>
		</body>
		</html>

		<?php

	}

	
	function isGameOver(){
		return $this->gameOver;
	}

	
	function obradiPokusaj(){
		//vraca false ako je pokusaj bio pogresan ili igra nije gotova,vraca true ako je igra gotova
		$zastavica = false;
		for($i=0;$i<9;$i++){
			if(isset($_POST[(string)$i])){
				$zastavica = true;
				if($this->ploca[$i] !== "?"){
					$this->errorMsg = "To polje je već iskorišteno!";
					return false;
				}
				else{
					if($this->naRedu === 1){
						$this->ploca[$i] = "o";
						$this->naRedu = 2;
					}
					else{
						$this->ploca[$i] = "x";
						$this->naRedu = 1;
					}
					break;
				}
			}
		}

		if($zastavica === false){
			return false;
		}
		//provjeravamo ima li pobjednika po stupcima
		if(($this->ploca[0] === $this->ploca[3]) &&  ($this->ploca[0] === $this->ploca[6])){
			if($this->ploca[0] !== '?' && $this->ploca[3] !== '?' && $this->ploca[6] !== '?'){
				if($this->ploca[0] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['0']=" pob";
				$_SESSION['3']=" pob";
				$_SESSION['6']=" pob";
				return true;
			}
		}

		if(($this->ploca[1] === $this->ploca[4]) &&  ($this->ploca[1] === $this->ploca[7])){
			if($this->ploca[1] !== '?' && $this->ploca[4] !== '?' && $this->ploca[7] !== '?'){
				if($this->ploca[1] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['1']=" pob";
				$_SESSION['4']=" pob";
				$_SESSION['7']=" pob";
				return true;
			}
		}


		if(($this->ploca[2] === $this->ploca[5]) &&  ($this->ploca[2] === $this->ploca[8])){
			if($this->ploca[2] !== '?' && $this->ploca[5] !== '?' && $this->ploca[8] !== '?'){
				if($this->ploca[2] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['2']=" pob";
				$_SESSION['5']=" pob";
				$_SESSION['8']=" pob";
				return true;
			}
		}

		//provjeravamo po retcima
		if(($this->ploca[0] === $this->ploca[1]) &&  ($this->ploca[0] === $this->ploca[2])){
			if($this->ploca[0] !== '?' && $this->ploca[1] !== '?' && $this->ploca[2] !== '?'){
				if($this->ploca[0] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['0']=" pob";
				$_SESSION['1']=" pob";
				$_SESSION['2']=" pob";
				return true;
			}
		}

		if(($this->ploca[3] === $this->ploca[4]) &&  ($this->ploca[3] === $this->ploca[5])){
			if($this->ploca[3] !== '?' && $this->ploca[4] !== '?' && $this->ploca[5] !== '?'){
				if($this->ploca[3] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['3']=" pob";
				$_SESSION['4']=" pob";
				$_SESSION['5']=" pob";
				return true;
			}
		}


		if(($this->ploca[6] === $this->ploca[7]) &&  ($this->ploca[6] === $this->ploca[8])){
			if($this->ploca[6] !== '?' && $this->ploca[7] !== '?' && $this->ploca[8] !== '?'){
				if($this->ploca[6] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['6']=" pob";
				$_SESSION['7']=" pob";
				$_SESSION['8']=" pob";
				return true;
			}
		}

		//na dijagonalama
		if(($this->ploca[0] === $this->ploca[4]) &&  ($this->ploca[0] === $this->ploca[8])){
			if($this->ploca[0] !== '?' && $this->ploca[4] !== '?' && $this->ploca[8] !== '?'){
				if($this->ploca[0] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['0']=" pob";
				$_SESSION['4']=" pob";
				$_SESSION['8']=" pob";
				return true;
			}
		}

		if(($this->ploca[2] === $this->ploca[4]) &&  ($this->ploca[2] === $this->ploca[6])){
			if($this->ploca[2] !== '?' && $this->ploca[4] !== '?' && $this->ploca[6] !== '?'){
				if($this->ploca[2] === 'o')
					$this->pobjednik = 'o';
				else
					$this->pobjednik = 'x';
				$_SESSION['2']=" pob";
				$_SESSION['4']=" pob";
				$_SESSION['6']=" pob";
				return true;
			}
		}
		
		for($i=0;$i<9;$i++)
			if($this->ploca[$i] === '?')
				return false;

		//sve je iskoristeno a nitko nije pobjedio
		return true;

	}


	function run(){
		//funkcija obavlja jedan potez u igri
		$this->errorMsg = false;

		if($this->get_imeIgraca() === false){
			//ako nemamo igraca ispisi pocetnu formu
			$this->ispisiPocetnuFormu();
			return;
		}

		$kraj = $this->obradiPokusaj();

		if($kraj === true){
			//ako je netko pobjedio ispisi cestitku
			$this->ispisiCestitku();
			$this->gameOver = true;
		}
		else{
			$this->ispisiFormuZaIgru();
		}

	}


};


session_start();

if(isset($_POST['resetiraj'])){
	session_unset();
	session_destroy();
}

if( !isset( $_SESSION['igra'] ) ){
	// Ako igra još nije započela, stvori novi objekt tipa PogodiBroj i spremi ga u $_SESSION
	$igra = new KriKru();
	$_SESSION['igra'] = $igra;
}
else{
	// Ako je igra već ranije započela, dohvati ju iz $_SESSION-a	
	$igra = $_SESSION['igra'];
}

//odigraj jedan korak u igri
$igra->run();

if($igra->isGameOver()){
	session_unset();
	session_destroy();
}
else{
	//igra jos nije gotova
	$_SESSION['igra'] = $igra;
}


?>