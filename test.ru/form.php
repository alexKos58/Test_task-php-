<?php
include ('includes/db.php')
?>
<!DOCTYPE html
<html>
<head>
  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class ="container">
	<div class="custom-head">Форма для добавления экзамена</div>
	<form action = "/post.php" method = "POST">
	<div class="form-group">
	<label for="disabledSelect" >Выберите предмет</label> 
	<select name="subject" id="disabledSelect" class="form-control"> 
		<?php 
		$result = mysqli_query($connection, "SELECT * From `subjects`");
		while(($subj = mysqli_fetch_assoc($result))) { 
			echo '<option >'.$subj['name'].'</option>'; 
			} 
		?> 
	</select> </div> <div class="form-group">
	<input type="date" class = "date" required name="date">
	<input type="time" class = "time" name="time" >
	<button type="submit" class="btn-primary">Добавить</button> </div> 
</body>
</html>





<style>
.custom-head{
	margin: 10px 0px 10px;
	font-size: 35px;
	font-weight: bold;
}

.form-group{
	font-size: 25px;
}

.form-control{
	font-size: 25px;

}

.btn-primary{
	font-size: 15px;
}

.date{
	font-size: 20px;
}

.time{
	font-size: 20px;
}


</style>