<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>PHP CRUD</title>
  </head>

  <body>
  <?php require_once 'process.php'; ?>

  <?php
  if(isset($_SESSION['message'])):?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
        echo ($_SESSION['message']);
        unset($_SESSION['message']);
      ?>
  </div>
  <?php endif; ?>
  <div class="container">
  <?php 
  $mysqli = new mysqli('localhost','root','root','crud_youtube','8889') or die(mysqli_error($mysqli)); 
     $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    // pre_r($result);
  ?>
  <div class="row justify-content-center">
    <table class="table">
      <thead>
        <tr>
          <th>営業担当</th>
          <th>クライアント名</th>
          <th>要件定義</th>
          <th>締め切り</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
    <?php while ($row = $result->fetch_assoc()):?>
      <tr>
        <td><?php echo $row['saleName'];?></td>
        <td><?php echo $row['clientName'];?></td>
        <td><?php echo $row['requirement'];?></td>
        <td><?php echo $row['deadline'];?></td>
        <td>
          <a href="index.php?edit=<?php echo $row[id];?>"
            class="btn btn-info">編集</a>
          <a href="process.php?delete=<?php echo $row[id];?>"
          class="btn btn-danger">削除</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </table>
  </div>
  </div>
  <?php
  function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  } ?>
</div>
<div class="row justify-content-center">
  <form method="POST" action="process.php">
    <input type="hidden" name="id" value="<?php echo $id?>">
  <!-- sale -->
      <div class="form-group">
        <label for="saleName">営業担当</label>
        <input type="text" class="form-control" name="saleName" value="<?php echo $saleName; ?>" placeholder="enter your name">
      </div>
  <!-- client  -->
      <div class="form-group">
        <label for="clientName">クライアント名</label>
        <input type="text" class="form-control" name="clientName" value="<?php echo $clientName; ?>" placeholder="enter your client name">
      </div>
  <!-- Requirement -->
    <div class="form-group">
       <label for="requirement">要件定義</label> 
       <textarea class="form-control" cols="30" rows="10" name="requirement" value="<?php echo $requirement; ?>" placeholder="enter requirement"></textarea>
    </div>
<!-- deadline  --> 
    <div class="form-group"> 
       <label for="deadline">締め切り</label>
       <input type="date" class="form-control" name="deadline" value="<?php echo $deadline; ?>" placeholder="enter deadline">
   </div>
<!-- -->
  <div class="form-group" >
  <?php 
  if ($update == true):
  ?>
    <button type="submit" name="update" class="btn btn-info">Update</button>
  <?php else: ?>
    <button type="submit" name="save" class="btn btn-primary">Save</button>
  <?php endif; ?>
  </div>
  </form>
</div>
</body>
</html>