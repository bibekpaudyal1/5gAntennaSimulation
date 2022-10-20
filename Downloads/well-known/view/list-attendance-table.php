<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

$sqltran = mysqli_query($con, "SELECT a.attendance_id, a.attendance_date, a.emp_code, a.punch_in_time, a.punch_in_remark, a.punch_out_time, a.punch_out_remark, e.first_name AS fname, e.last_name AS lname FROM wy_daily_attendance a INNER JOIN wy_employees e ON a.emp_code = e.emp_code ORDER BY a.attendance_date DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {

//CALCULATING WORKING HOURS
if($rowList['punch_out_time']=='')
{    
$work='-';
}
else
{
$datetime1 = new DateTime($rowList['punch_in_time']);
$datetime2 = new DateTime($rowList['punch_out_time']);
$interval = $datetime1->diff($datetime2);
$work=$interval->format('%h Hrs | %i Min');    
}

if($rowList['punch_out_time']=='')
{    
$punch_out_time='-';
}
else
{
//Out Time in 12hours Clock
$p_o=$rowList['punch_out_time'];
$punch_out_time= date("h:i:s", strtotime($p_o));
}

 $name = array(
 'num' => $i,
 'edate'=> $rowList['attendance_date'],
 'aid'=> $rowList['attendance_id'],
 'eid'=> $rowList['emp_code'],
 'fname'=> $rowList['fname'] . ' ' . $rowList['lname'],
 'punch_in_time'=> $rowList['punch_in_time'],
 'punch_in_remark'=> $rowList['punch_in_remark'],
 'punch_out_time'=> $punch_out_time,
 'punch_out_remark'=> $rowList['punch_out_remark'],
 'working_hours'=> $work
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>