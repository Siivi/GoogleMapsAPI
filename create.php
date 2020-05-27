<?php
require 'config.php';

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $user, $psw, $options);

        $new_marker = array(
            "name" => $_POST['name'],
            "lat" => $_POST['lat'],
            "lng" => $_POST['lng'],
            "description" => $_POST['description']
        );
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "markers.markers",
            implode(", ", array_keys($new_marker)),
            ":" . implode(", :", array_keys($new_marker))
        );
        $stmt = $connection->prepare($sql);
        $stmt->execute($new_marker);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


?>
<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Loo marker</h2>
        </div>
        <div class="card-body">
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Koha nimi">
                </div>
                <div class="form-group">
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Laiuskraad">
                </div>
                <div class="form-group">
                    <input type="text" name="lng" id="lng" class="form-control" placeholder="Pikkuskraad">
                </div>
                <div class="form-group">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Kirjeldus">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Sisesta koht</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>