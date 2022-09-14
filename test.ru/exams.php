<?php
include('includes/db.php');
$date_today = date('Y-m-d',strtotime(date('Y').'-'.date('n').'-'.$_GET['day']));
$date_next = date('Y-m-d', strtotime('+1 day', strtotime($date_today)));
?>

<html>
<head>
<title>Расписание Экзаменов</title>
<div class="exam-head">Расписание на <?php echo $date_today?> </div>
<!-- Bootstrap CSS (jsDelivr CDN) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Bootstrap Bundle JS (jsDelivr CDN) -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
    <body>
        <div class="chart"> 
            <table class="calendar-tb w-75 ">
                <tr class="calendar-head">
                <th class="calendar-head1">Время экзамена</th>
                <th class="calendar-head2">Название предмета</th>
                <th class="calendar-head3">Список специальностей, абитуриенты которых должны прийти на экзамен</th>
                </tr>
<?php 
    $result = mysqli_query($connection, "SELECT SQL_CALC_FOUND_ROWS Sch.date, sub.name, spec.code FROM Schedule AS Sch
        INNER JOIN subjects AS sub ON Sch.id_subject = sub.id
        INNER JOIN subjects_to_speciality AS sts ON sub.id = sts.id_subject
        INNER JOIN specialities AS spec ON sts.id_speciality = spec.id
        WHERE Sch.date BETWEEN '$date_today' AND '$date_next'
        ORDER BY Sch.date ASC
        LIMIT 0, 10");
    $sub_t = 'NULL';
    while ($exit = mysqli_fetch_assoc($result)){
            if($exit['name'] != $sub_t)
        {
                echo'</td>'.'</tr>';
                $sub_t = $exit['name'];
                echo '<td>'.date('H:i', strtotime($exit['date'])).'</td>';
                echo '<td>'.$exit['name'].'</td>';
                echo '<td>'.$exit['code'];
        }
        else
        {
                echo ' / '.$exit['code'];
        }
    }   

?> 
            </table>
        </div>
    </body>
</html>

<style>
.calendar-tb{
	margin: 20px 50px 20px;
	width: 400px;
	vertical-align: top;
}
th{
    border:2px inset grey;
    font-size: 18px;
}

td{
    font-size: 18px;
    border:2px inset grey;
}

.exam-head{
    margin: 20px 250px 2px;
	font-weight: 700;
	font-size: 30px;
}
</style>