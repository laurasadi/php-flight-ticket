<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css"
    <title></title>
</head>
<body>

<?php
$validacija = [];
if (isset($_POST['submit'])) {
    if (!isset($_POST['skrydzionr'])) {
        $validacija[] = "Pažymėkite skrydžio numerį";
    }
    if (!preg_match('/^([3-6]\d{10})$/',
        trim(htmlspecialchars($_POST['asmenskodas'])))) {
        $validacija[] = "Asmens kodas netinkamas";
    } else {
        $_POST['asmenskodas'] = trim(htmlspecialchars( $_POST['asmenskodas']));
    }
    if (!preg_match('/\w{1,100}$/',
        trim(htmlspecialchars($_POST['vardas'])))) {
        $validacija[] = "Vardas negali būti ilgesnis negu 100 simbolių";
    } else {
        $_POST['vardas'] = trim(htmlspecialchars( $_POST['vardas']));
    }
    if (!preg_match('/\w{1,100}$/',
        trim(htmlspecialchars($_POST['pavarde'])))) {
        $validacija[] = "Pavardė negali būti ilgesnė nei 100 simbolių";
    } else {
        $_POST['pavarde'] = trim(htmlspecialchars( $_POST['pavarde']));
    }
    if (!isset($_POST['iskur'])) {
        $validacija[] = "Pažymėkite iš kur vyks skrydis";

    }
    if (!isset($_POST['ikur'])) {
        $validacija[] = "Pažymėkite į kur vyks skrydis";

    }
    if (!isset($_POST['bagazas'])) {
        $validacija[] = "Pažymėkite bagažo svorį";
    }
    if (!preg_match('/\w{1,500}$/',
        trim(htmlspecialchars($_POST['pastaba'])))) {
        $validacija[] = "Netinkamas pastabos simbolių skaičius";
    } else {
        $_POST['pastaba'] = trim(htmlspecialchars($_POST['pastaba']));
    }
}

?>

<?php if($validacija) :?>
    <div class="klaidos">
        <ul>
            <?php foreach($validacija as $klaida) :?>
                <li><?=$klaida;?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>



<div class="container">
    <form>
        <div class="form-group">
            <label for="skrydzionr">Skrydžio nr.</label>
            <select class="form-control" id="exampleFormControlSelect1" name="skrydzionr">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($flight_num as $numeris): ?>
                    <option value=""><?=$numeris;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="asmenskodas">Asmens Kodas</label>
            <input type="number" class="form-control" id="asmenskodas" name="asmenskodas">
        </div>
        <div class="form-group">
            <label for="vardas">Vardas</label>
            <input type="text" class="form-control" id="vardas" name="vardas">
        </div>
        <div class="form-group">
            <label for="pavarde">Pavardė</label>
            <input type="text" class="form-control" id="pavarde" name="pavarde">
        </div>
        <div class="form-group">
            <label for="iskur">Iš kur?</label>
            <select class="form-control" id="exampleFormControlSelect2" name="iskur">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($from as $kur): ?>
                    <option value="<?=$kur?>"><?=$kur;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ikur">Į kur?</label>
            <select class="form-control" id="exampleFormControlSelect3" name="ikur">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($to as $ten): ?>
                    <option value="<?=$ten?>"><?=$ten;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="kaina">Kaina</label>
            <input type="number" class="form-control" id="kaina" name="kaina">
        </div>
        <div class="form-group">
            <label for="bagazas">Bagažas</label>
            <select class="form-control" id="exampleFormControlSelect4" name="bagazas">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($luggage as $kg): ?>
                    <option value="<?= $kg ?>"><?= $kg; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Pastabos</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="pastaba" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Suformuoti</button>
        <?php if (isset($_POST["submit"]) && !$validacija):?>

            <?php $numeris = $_POST['skrydzionr'];
            $asmenskodas1 = $_POST['asmenskodas'];
            $vardas = $_POST['vardas'];
            $pavarde = $_POST['pavarde'];
            $ten = $_POST['ikur'];
            $kur =  $_POST['iskur'];
            $kg = intval($_POST['bagazas']);
            $pastaba = $_POST['pastaba'];

            $kaina = intval($_POST['kaina']);
            if ($kg >= 20) {
                $price = $kaina + 30;
            } else {$price=$kaina;}
            ?>
        <?php endif;?>

    </form>
</div>


            <div class="body">
                <div class = "container ticket">
                    <div class = "row">
                        <div class = "col-sm-12">Bilieto informacija</div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm">
                            <div class = "row">Jūsų skrydžio numeris: <?=$numeris?></div>
                            <div class = "row">Kryptis pirmyn: <?=$kur?></div>
                            <div class = "row">Kryptis atgal: <?=$ten?></div>
                        </div>
                        <div class = "col-sm">
                            <div class = "row">Keleivio vardas: <?=$vardas?></div>
                            <div class = "row">Keleivio pavardė: <?=$pavarde?></div>
                            <div class = "row">Keleivio asmens kodas: <?=$asmenskodas1?></div>
                        </div>
                        <div class = "col-sm">
                            <div class = "row">Skrydzio perziura</div>
                            <div class = "row">Skrydžio kaina: <?=$kaina?></div>
                            <div class = "row">Bagažo kiekis: <?=$kg?>kg</div>
                            <div class = "row">Bendra bilieto kaina: <?=$price?></div>
                        </div>
                    </div>
                    <div class = "row">Pastabos: <?=$pastaba?></div>
                </div>
            </div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>

