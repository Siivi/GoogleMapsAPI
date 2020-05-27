<?php
require "header.php";
require "config.php";
//require "delete.php";
//require "edit.php";


/*if(isset($_GET['delete']))
{
    $connection = new PDO($dsn, $user, $psw, $options);

    $sql = "DELETE * FROM markers.markers WHERE id= :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt = $_GET['id'];
    $stmt->execute();

    echo $stmt->rowCount() . "rida kustutatud";
    unset($stmt);

} */
try {
    $connection = new PDO($dsn, $user, $psw, $options);
  
    $sql = "SELECT * FROM markers.markers";
  
    $stmt = $connection->prepare($sql);
    $stmt->execute();
  
    $result = $stmt->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

         
    
    
      
   /* $result = $stmt->fetchAll();
    } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }*/
?>
<div class="conatainer">
    <div class="row">

        <h2 class="">Salvestatud kohad</h2>
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Koht</th>
                    <th>Laiuskraad</th>
                    <th>Pikkuskraad</th>
                    <th>Kirjeldus</th>
                    <th>Lisatud</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <?php
                    foreach ($result as $row) :
                    ?>  
                        <td><?php echo escape($row['id']); ?></td>
                        <td><?php echo escape($row['name']);?></td>
                        <td><?php echo escape($row['lat']); ?></td>
                        <td><?php echo escape($row['lng']); ?></td>
                        <td><?php echo escape($row['description']); ?></td>
                        <td><?php echo escape($row['added']); ?></td>
                        <td><a href="update.php?id=<?=$row['id'] ?>" name="edit" class="btn btn-outline-success">Uuenda</a></td>
                        <td><a href="delete.php?id=<?=$row['id'] ?>" name="delete" class="btn btn-outline-danger">Kustuta</a></td>

                </tr>
            <?php endforeach; ?>
            </table>

        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php 


include "footer.php"; 

?>