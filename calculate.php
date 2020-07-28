<?php
	session_start();
	
	if(isset($_POST['netto'])) 	{
		$netto = $_POST['netto'];
		$_SESSION['$m_netto'] = $netto;
	}
	else $netto = 0;
	
	if(isset($_POST['brutto'])) {
		$brutto = $_POST['brutto'];
		$_SESSION['$m_brutto'] = $brutto;
	}
	else $brutto = 0;
	
	if(isset($_POST['umowa'])) {
		$umowa = $_POST['umowa'];
		if($umowa == 1) {
			if(isset($_POST['wiek'])) {
				$pit = 0;
			}
			else {
				if($brutto<=200) {
					$pit=$brutto*0.18;
					$netto = $brutto - $pit;
					$sumapit = $pit;			
				}
				else {
					if(isset($_POST['prawaAutorskie'])) {
						$kosztup = $brutto/2; //koszt uzyskania przychodu
					}
					else {
						$kosztup = $brutto/5;
					}
						
					if(($brutto - $kosztup)<=85528) {
						$pit = (($brutto - $kosztup)*0.17)-(525.12/12);
					}
					if(85528<($brutto - $kosztup) && ($brutto - $kosztup)<=127000) {
						$pit = (($brutto - $kosztup)*0.32)-(525.12 - 525.12*(($brutto - $kosztup) - 85528)/41742);
					}
					if(($brutto - $kosztup)>127000) {
						$pit = (($brutto - $kosztup)*0.32);
					}
				}
			}
			$netto = $brutto - $pit  /*f*/;
			$sumapit = $pit;
		}
		if($umowa == 2) {
			if(isset($_POST['skladki'])) {
				$p_ub_emeryt = $brutto*0.0976; //ubezpieczenie emerytalne
				$p_ub_rentowe = $brutto*0.015; //ubezpieczenie rentowe
				$p_ub_chorobowe = $brutto*0.0245; //ubezpieczenie chorobowe
			}
			else {
				$p_ub_emeryt = 0; //ubezpieczenie emerytalne
				$p_ub_rentowe = 0; //ubezpieczenie rentowe
				$p_ub_chorobowe = 0; //ubezpieczenie chorobowe
			}
			$suma_skladek = $p_ub_emeryt + $p_ub_rentowe + $p_ub_chorobowe;
			$p_ub_zdrowotne = ($brutto - $suma_skladek)*0.09;

			if(isset($_POST['wiek'])) {
				$pit = 0;
			}
			else {
				if(isset($_POST['prawaAutorskie'])) {
					$kosztup = ($brutto - $suma_skladek)/2; //koszt uzyskania przychodu
				}
				else {
					$kosztup = ($brutto - $suma_skladek)/5;
				}
					
				if(($brutto - $suma_skladek - $kosztup)<=85528) {
					$pit = (($brutto - $suma_skladek - $kosztup)*0.17)-(525.12/12);
				}
				if(85528<($brutto - $suma_skladek - $kosztup) && ($brutto - $suma_skladek - $kosztup)<=127000) {
					$pit = (($brutto - $suma_skladek - $kosztup)*0.32)-(525.12 - 525.12*(($brutto - $suma_skladek - $kosztup) - 85528)/41742);
				}
				if(($brutto - $suma_skladek - $kosztup)>127000) {
					$pit = (($brutto - $suma_skladek - $kosztup)*0.32);
				}
			}
			$netto = $brutto - $suma_skladek - (($brutto - $suma_skladek)*0.09) /*e*/ - ($pit - ($brutto - $suma_skladek)*0.0775) /*f*/;
			$sumapit = $pit - ($brutto - $suma_skladek)*0.0775;
		}
		if($umowa == 3) {
		//koszty pracodawcy
		$pd_ub_emeryt = $brutto*0.0976; //ubezpieczenie emerytalne
		$pd_ub_rentowe = $brutto*0.065; //ubezpieczenie rentowe
		$pd_ub_wypadkowe = $brutto*0.0167; //ubezpieczenie wypadkowe
		$pd_Fun_Pracy = $brutto*0.0245; //Fundusz Pracy
		$pd_FGSP = $brutto*0.001; //Fundusz Gwarantowanych Świadczeń Pracowniczych
		
		//superbrutto
		$superbrutto = $brutto + ($pd_ub_emeryt + $pd_ub_rentowe + $pd_ub_wypadkowe + $pd_Fun_Pracy + $pd_FGSP);
		
		//koszty pracownika
		$p_ub_emeryt = $brutto*0.0976; //ubezpieczenie emerytalne
		$p_ub_rentowe = $brutto*0.015; //ubezpieczenie rentowe
		$p_ub_chorobowe = $brutto*0.0245; //ubezpieczenie chorobowe
		$suma_skladek = $p_ub_emeryt + $p_ub_rentowe + $p_ub_chorobowe; //c
		$p_ub_zdrowotne = ($brutto - $suma_skladek)*0.09; //ubezpieczenie zdrowotne //e
		if(isset($_POST['wiek'])) {
			$pit = 0;
		}
		else {
            if(($brutto - $suma_skladek - 250)<=85528) {
                $pit = (($brutto - $suma_skladek - 250)*0.17)-(525.12/12);
            }
            if(85528<($brutto - $suma_skladek - 250) && ($brutto - $suma_skladek - 250)<=127000) {
                $pit = (($brutto - $suma_skladek - 250)*0.32)-(525.12 - 525.12*(($brutto - $suma_skladek - 250) - 85528)/41742);
            }
            if(($brutto - $suma_skladek - 250)>127000) {
                $pit = (($brutto - $suma_skladek - 250)*0.32);
            }
		}
		$netto = $brutto/*a*/ - $suma_skladek/*c*/ - (($brutto - $suma_skladek)*0.09) /*e*/ - ($pit - ($brutto - $suma_skladek)*0.0775) /*f*/;
		$sumapit = $pit - ($brutto - $suma_skladek)*0.0775;
		}
	}
	if(!isset($_POST['umowa'])) {
		$umowa = 0;
	}
	/*
	if($netto==0 && $brutto==0 || $umowa == 0)
	{
		header('Location: index.php');
		exit();
	}
	*/
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Kalkulator superbrutto</title>
    <meta name="description" content="Używanie PDO - zapis do bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="src/scss/main.scss">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Kalkulator Superbrutto</h1>
        </header>

        <main>
            <article>
                <form>
					<?php
						if(isset($superbrutto)) {
							echo "superbrutto: ".$superbrutto;
							echo "<br>";
						}
						if(isset($pd_ub_emeryt)) {
							echo "ubezpieczenie emerytalne: ".$pd_ub_emeryt;
							echo "<br>";
						}
						if(isset($pd_ub_rentowe)) {
                            echo "ubezpieczenie rentowe: ".$pd_ub_rentowe;
                            echo "<br>";
						}
						if(isset($pd_ub_wypadkowe)) {
                            echo "ubezpieczenie wypadkowe: ".$pd_ub_wypadkowe;
                            echo "<br>";
						}
						if(isset($pd_Fun_Pracy)) {
                            echo "fundusz pracy: ".$pd_Fun_Pracy;
                            echo "<br>";
						}
						if(isset($pd_FGSP)) {
                            echo "FGŚP: ".$pd_FGSP;
                            echo "<br>";
						}
						if(isset($brutto)) {
                            echo "brutto: ".$brutto;
                            echo "<br>";
						}
						if(isset($p_ub_emeryt)) {
                            echo "ubezpieczenie emerytalne: ".$p_ub_emeryt;
                            echo "<br>";
						}
						if(isset($p_ub_rentowe)) {
                            echo "ubezpieczenie rentowe: ".$p_ub_rentowe;
                            echo "<br>";
						}
						if(isset($p_ub_chorobowe)) {
                            echo "ubezpieczenie chorobowe: ".$p_ub_chorobowe;
                            echo "<br>";
						}
						if(isset($suma_skladek)) {
                            echo "suma składek: ".$suma_skladek;
                            echo "<br>";
						}
						if(isset($p_ub_zdrowotne)) {
                            echo "ubezpieczenie zdrowotne: ".$p_ub_zdrowotne;
                            echo "<br>";
						}
						if(isset($sumapit)) {
                            echo "zaliczka na pit: ".$sumapit;
                            echo "<br>";
						}
						if(isset($netto)) {
                            echo "netto: ".$netto;
						}
					?>
					<br>
					<a href="main.php">Wróć do początku</a>
                </form>
            </article>
        </main>
    </div>
</body>
</html>

