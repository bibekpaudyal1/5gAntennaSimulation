<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../Controller/config.php';
 
$sqltran = mysqli_query($con, "SELECT l.leave_id, l.emp_code, l.leave_dates, l.leave_type, l.apply_date, l.leave_status, l.leave_message, e.first_name AS fname, e.last_name AS lname FROM wy_leaves l INNER JOIN wy_employees e ON l.emp_code = e.emp_code ORDER BY l.leave_id DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {

 $f = $rowList['fname'];
 $l = $rowList['lname'];
$fl = $f . ' ' . $l;

 $name = array(
 'num' => $i,
 'lid'=> $rowList['leave_id'],
 'eid'=> $rowList['emp_code'], 
 'ldate'=> $rowList['leave_dates'],
 'ltype'=> $rowList['leave_type'],
 'ladate'=> $rowList['apply_date'],
 'lmsg'=> $rowList['leave_message'],
 'flname'=> $fl,
 'lstatus'=> ucfirst($rowList['leave_status'])
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>