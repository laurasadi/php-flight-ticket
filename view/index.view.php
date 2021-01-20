<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="view/css/bootstrap.css"
    <title></title>
</head>
<body>

<div class="container">
<?php $validacija = [];

if (isset($_POST['send'])): ?>
    <?php if (!preg_match('/^([3-6]\d{10})$/', $_POST['asmenskodas'])): ?>
        <?php $validacija[] = "Asmens kodas netinkamas"; ?>
        <div class="alert alert-danger" role="alert"><?=$validacija ?></div>
    <?php endif ?>

    <?php if (!preg_match('/\w{1,100}$/', $_POST['vardas'])): ?>
        <?php $validacija[] = "Vardas negali būti ilgesnis negu 100 simbolių"; ?>
        <div class="alert alert-danger" role="alert"><?=$validacija ?></div>
    <?php endif ?>

    <?php if (!preg_match('/\w{1,100}$/', $_POST['pavarde'])): ?>
        <?php $validacija[] = "Pavardė negali būti ilgesnis negu 100 simbolių"; ?>
        <div class="alert alert-danger" role="alert"><?=$validacija ?></div>
    <?php endif ?>

    <?php if (empty($_POST['pastaba']) & !preg_match('/\w{1,500}$/', $_POST['pastaba'])): ?>
        <?php $validacija[] = "Netinkamas pastabos simbolių skaičius"; ?>
        <div class="alert alert-danger" role="alert"><?=$validacija ?></div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($_POST['send']) & empty($validacija)): ?>
    <div class="row">
        <div class="col-sm-12"><h4>Bilietas</h4></div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="row"> Skrydžio nr. <?= $_POST['flight']; ?></div>
            <div class="row">Iš kur: <?= $_POST['from']; ?></div>
            <div class="row">Į kur: <?= $_POST['to']; ?></div>
        </div>
        <div class="col-sm">
            <div class="row"> Vardas: <?= $_POST['vardas']; ?></div>
            <div class="row"> Pavardė: <?= $_POST['pavarde']; ?></div>
            <div class="row">Asmens kodas: <?= $_POST['asmenskodas']; ?></div>
        </div>
        <div class="col-sm">
            <div class="row">Kaina: <?= $_POST['kaina']; ?></div>
            <div class="row">Bagažo kiekis kg:</div>
            <?php $svoris = $_POST['bagazas'];
            $kaina = $_POST['kaina'];
            if ($svoris > 20):?>
                <div class="row">30.00</div>
            <?php else: ?>
                <div class="row">0.00</div>
            <?php endif; ?>
            <div class="row">Bendra suma:</div>
            <?php if ($svoris > 20): ?>
                <div class="row"><?= $kaina + 30 ?></div>
            <?php else: ?>
                <div class="row"><?= $kaina; ?></div>
            <?php endif; ?>
            <div class="row">Pastabos: <?= $_POST['pastaba']; ?></div>
        </div>
    </div>
    </div>

<?php else: ?>

<div class="container">
    <form>
        <div class="form-group">
            <label for="flight">Skrydžio nr.</label>
            <select name="flight" class="form-control">
                <option selected disabled>Pasirinkite skrydzio nr</option>
                <?php foreach ($flight as $numeris): ?>
                    <option value="<?= $numeris; ?>"><?= $numeris; ?></option>
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
            <select class="form-control" id="exampleFormControlSelect2" name="from">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($from as $kur): ?>
                    <option value="<?= $kur ?>"><?= $kur; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ikur">Į kur?</label>
            <select class="form-control" id="exampleFormControlSelect3" name="to">
                <option selected disabled>Pasirinkite</option>
                <?php foreach ($to as $ten): ?>
                    <option value="<?= $ten ?>"><?= $ten; ?></option>
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
                <?php foreach ($bagazas as $kg): ?>
                    <option value="<?= $kg ?>"><?= $kg; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Pastabos</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="pastaba" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="send">Suformuoti</button>
    </form>
</div>
    <?php endif; ?>


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

