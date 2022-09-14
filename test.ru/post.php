<?php
include('includes/db.php');

$date= date("Y-m-d H:i:s",strtotime($_POST['date'].' '.$_POST['time'].':00'));
echo $date;
$name = $_POST['subject'];
$title = mysqli_query($connection, "SELECT `id` FROM `subjects` WHERE `name` = '".$name."'");
$subj = mysqli_fetch_assoc($title);
$id_subject = $subj['id'];


$sql = mysqli_query($connection, "INSERT INTO `Schedule` (`id_subject`, `date`) VALUES ('" . $id_subject . "', '".$date."')");
if ($sql) {
    echo '<p>Данные успешно добавлены в таблицу.</p>';
  } 
  else {
    echo '<p>Произошла ошибка: ' . mysqli_error($connection) . '</p>';
  }

?>