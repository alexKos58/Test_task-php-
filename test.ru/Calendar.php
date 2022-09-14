<?php
include('includes/db.php');
class Calendar 
{
	public static function  getMonth($month, $year)
	{
		$months = array(        
			1  => 'Январь',
			2  => 'Февраль',
			3  => 'Март',
			4  => 'Апрель',
			5  => 'Май',
			6  => 'Июнь',
			7  => 'Июль',
			8  => 'Август',
			9  => 'Сентябрь',
			10 => 'Октябрь',
			11 => 'Ноябрь',
			12 => 'Декабрь'
		);
 
		$month = intval($month);
		$string = '
        	<div class="calendar">
			<div class="calendar-head">' . $months[$month] . ' ' . $year . ' г.</div>
			<table>
				<tr>
					<th>Пн</th>
					<th>Вт</th>
					<th>Ср</th>
					<th>Чт</th>
					<th>Пт</th>
					<th>Сб</th>
					<th>Вс</th>
				</tr>';
 
		$weekday = date('N', mktime(0, 0, 0, $month, 1, $year));
		$weekday--;
 
		$string.= '<tr>';
 
		for ($x = 0; $x < $weekday; $x++) {
			$string.= '<td></td>';
		}
 
		$count = 0;		
		$days_of_month = date('t', mktime(0, 0, 0, $month, 1, $year));
	
		for ($day = 1; $day <= $days_of_month; $day++) {
			if (date('j.n.Y') == $day . '.' . $month . '.' . $year) {
				$class = 'today';
			} elseif (time() > strtotime($day . '.' . $month . '.' . $year)) {
				$class = 'last';
			} else {
				$class = '';
			}
			
			
			$string.= '<td class="calendar-day ' . $class . '"><a class="calendar-day ' . $class . '" href="exams.php?day=' . $day .'&month=' . $month .'&year=' . $year . '">' . $day . '</a>	</td>';
 
			if ($weekday == 6) {
				$string.= '</tr>';
				if (($count + 1) != $days_of_month) {
					$string.= '<tr>';
				}
				$weekday = -1;
			}
 
			$weekday++; 
			$count++;
		}
 
		$string .= '</tr></table></div>';
		return $string;
	}

}
echo Calendar::getMonth(date('n'), date('Y'));
?>

<style>
    .calendar {
	display: inline-block;
	margin: 50px 550px 40px;
	width: 400px;
	vertical-align: top;
	font: 16px/1.8 Tahoma, sans-serif;
}

.calendar-head {
	text-align: center;
	padding: 10px;
	font-weight: 700;
	font-size: 30px;
}

.calendar table {
	width: 100%;
}

.calendar th {
	font-size: 25px;
	padding: 6px 7px;
	text-align: center;
	color: #888;
	font-weight: normal;
}

.calendar td {
	font-size: 25px;
	padding: 6px 5px;
	text-align: center;
	border:6px solid #ddd;
}

.calendar tr th:nth-child(6), .calendar tr th:nth-child(7)  {
	color: #e65a5a !important;
}	

.calendar tr td:nth-child(6), .calendar tr td:nth-child(7){
	color: #e65a5a !important;
}	

.calendar-day.last {
	color: #495057;
}	
.calendar-day.today {
	background: grey;
	font-weight: bold;
	color: black;
}

.calendar-day{
	color: black;
}
a{
	text-decoration: none !important;
}

</style>
