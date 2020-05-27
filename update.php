<?php
include "config.php";
include "header.php";

$connection = new PDO($dsn, $user, $psw, $options);

$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
        $lng = isset($_POST['lng']) ? $_POST['lng'] : '';
        $desc = isset($_POST['description']) ? $_POST['description'] : '';
        $added = isset($_POST['added']) ? $_POST['added'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $connection->prepare('UPDATE markers.markers SET id = ?, name = ?, lat = ?, lng
         = ?, description = ?, added = ? WHERE id = ?');
        $stmt->execute([$id, $name, $lat, $lng, $desc, $added, $_GET['id']]);
        $msg = 'Edukalt uuendatud!';
    }
    // Get the contact from the contacts table
    $stmt = $connection->prepare('SELECT * FROM markers.markers WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        exit('Selle ID-ga markerit ei ole!11!!!!!!11!!!');
    }
} else {
    exit('No ID specified!');
}

?>
<div class="container ">
    <div class="row">
        <div class="card-header">
            <h2>Uuenda andmeid #<?= $row['id'] ?></h2>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="update.php?id=<?= $row['id'] ?>" method="post">
                <div class="form-group">
                    <input type="text" name="id" class="form-control" placeholder="13" value="<?= $row['id'] ?>" id="id">
                </div>
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Koha nimi" value="<?= $row['name'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Laiuskraad" value="<?= $row['lat'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="lng" id="lng" class="form-control" placeholder="Pikkuskraad" value="<?= $row['lng'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Kirjeldus" value="<?= $row['description'] ?>">
                </div>
                <div class="form-group">
                    <input type="datetime-local" name="added" value="<?= date('Y-m-d\TH:i', strtotime($row['added'])) ?>" id="added">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-info">Sisesta koht</button>
                </div>
            </form>
            <?php if ($msg) : ?>
                <p><?= $msg ?></p>
            <?php endif; ?>

        </div>
        <div class="col-md-2"></div>

    </div>
</div>