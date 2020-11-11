<?php

session_start();

$mysqli = new mysqli('localhost','root','root','crud_youtube','8889') or die(mysqli_error($mysqli));
$id = '0';
$update = false;
$saleName ='';
$clientName ='';
$requirement ='';
$deadline ='';

echo $mysqli->connect_error;


if(isset($_POST['save'])){
     $saleName = $_POST['saleName'];
     $clientName =$_POST['clientName'];
     $requirement = $_POST['requirement'];
     $deadline = $_POST['deadline'];

     $mysqli->query("INSERT INTO data (saleName, clientName, requirement, deadline) VALUES('$saleName', '$clientName', '$requirement', '$deadline')") or
     die ($mysqli->error);

     $_SESSION['message'] = "Record has been saved!";
     $_SESSION['msg_type'] = "success";

     header("location: index.php");
}
if(isset($_GET['delete'])){
     $id = $_GET['delete'];
     $mysqli->query("DELETE FROM data WHERE id=$id") or  die ($mysqli->error());

     $_SESSION['message'] = "Record has been delete!";
     $_SESSION['msg_type'] = "danger";

     header("location: index.php");

}

if (isset($_GET['edit'])){
     $id = $_GET['edit'];
     $update = true;
     $result = $mysqli->query("SELECT * FROM Data WHERE id=$id") or die ($mysqli->error());
     if($result->num_rows){
          $row = $result->fetch_array();
          $saleName = $row['saleName'];
          $clientName =$row['clientName'];
          $requirement = $row['requirement'];
          $deadline = $row['deadline'];
     }
}
if(isset($_POST['update'])){
     $id = $_POST ['id'];
     $saleName = $_POST['saleName'];
     $clientName =$_POST['clientName'];
     $requirement = $_POST['requirement'];
     $deadline = $_POST['deadline'];

     $mysqli->query("UPDATE data SET saleName='$saleName', clientName='$clientName', requirement='$requirement', deadline='$deadline' WHERE id=$id") or die ($mysqli->error());
     $_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";

header("location: index.php"); 
}

?>