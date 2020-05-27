<?php

include "config.php";
include "header.php";

$connection = new PDO($dsn, $user, $psw, $options);
$msg = '';

// Check that the contact ID exists
if (isset($_GET['id'])) {
  // Select the record that is going to be deleted
  $stmt = $connection->prepare('SELECT * FROM markers.markers WHERE id = ?');
  $stmt->execute([$_GET['id']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$row) {
    exit('Selle ID-ga markerit ei ole!11!!!!!!11!!!');
  }
  // Make sure the user confirms beore deletion
  if (isset($_GET['confirm'])) {
    if ($_GET['confirm'] == 'yes') {
      // User clicked the "Yes" button, delete record
      $stmt = $connection->prepare('DELETE FROM markers.markers WHERE id = ?');
      $stmt->execute([$_GET['id']]);
      $msg = 'Kustutasin andmed baasist !1!!1!1!!!!!';
    } else {
      // User clicked the "No" button, redirect them back to the read page
      header('Location: reade.php');
      exit;
    }
  }
} else {
  exit('ID on täpsustamatta!1!1!');
}
?>
<div class="conatainer">
  <div class="content delete">
    <h2>Kustuta #<?= $row['id'] ?></h2>
    <?php if ($msg) : ?>
      <p><?= $msg ?></p>
    <?php else : ?>
      <p>Kas sa oled kindel, et soovid kustutada #<?= $row['id'] ?>?</p>
      <div class="yesno">
        <a href="delete.php?id=<?= $row['id'] ?>&confirm=yes" class="btn btn-outline-success">JAH!</a>
        <a href="delete.php?id=<?= $row['id'] ?>&confirm=no" class="btn btn-outline-success">EI!</a>
      </div>
    <?php endif; ?>
  </div>

</div>

<?php include "footer.php"; ?>