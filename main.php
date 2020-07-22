<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Kalkulator superbrutto</title>
    <meta name="description" content="Używanie PDO - zapis do bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Kalkulator superbrutto</h1>
        </header>

        <main>
            <article>
                <form method="post" action="calculate.php">
					<label>Wybierz rodzaj umowy
					<br>
                    <select id="umowa" name="umowa">
					<option selected="selected">Rodzaj umowy</option>
					<option value="1">Umowa o dzieło</option>
					<option value="2">Umowa zlecenie</option>
					<option value="3">Umowa o pracę</option>
					</select>
					<br>
					<br>
					Masz poniżej 26 roku życia: 
					<input type="checkbox" name="wiek">
					<br>
					<br>
					Czy twoja umowa zlecenie jest oskładkowana?
					<input type="checkbox" name="skladki">
					<br>
					<br>
					Czy twoja umowa zlecenie dotyczy dzieł sztuki, programów lub inny własności niematerialnych lub praw wymienionych w art. 22 ust. 9 pkt 3 ustawy o pdof.
					<input type="checkbox" name="prawaAutorskie">
					<br>
					<br>
                    </label>
                    <label>Podaj wartość netto swojej pensji
                    <input type="input" name="netto">
                    </label>
					<br>
					<br>
					<lable>lub podaj wartość brutto swojej pensji
					<input type="input" name="brutto">
					</lable>
					<br>
					<br>
                    <input type="submit" value="Oblicz">
                </form>
            </article>
        </main>

    </div>
</body>
</html>