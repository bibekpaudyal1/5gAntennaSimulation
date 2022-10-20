<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';
$select_id=$_SESSION['user']; 
$sqltran = mysqli_query($con, "SELECT l.leave_id, l.emp_code, l.leave_dates, l.leave_type, l.apply_date, l.leave_status, l.leave_message, e.first_name AS fname, e.last_name AS lname FROM wy_leaves l INNER JOIN wy_employees e ON l.emp_code = e.emp_code WHERE l.emp_code='$select_id' ORDER BY l.leave_dates DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $approve = 'approve';
 $reject = 'reject';
 $pending = 'pending';
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {

$lid = $rowList['leave_id'];
$f = $rowList['fname'];
$l = $rowList['lname'];
$fl = $f . ' ' . $l;

$l_s = $rowList['leave_status'];
if($rowList['leave_status'] == $approve)
{
    $f_s = '<span class="badge badge-success">' . $approve . '</span>';
}
elseif($rowList['leave_status'] == $reject)
{
    $f_s = '<span class="badge badge-danger">' . $reject . '</span>';
}
elseif($rowList['leave_status'] == $pending)
{
    $f_s = '<span class="badge badge-warning">' . $pending . '</span>';
}

//Leave Dates in badges
$c_date=str_replace('/', '-', $rowList['leave_dates']);
$d_date = '<span class="badge badge-primary leave-apply-date">' . str_replace(',', '</span> <span class="badge badge-primary leave-apply-date">', $c_date) . '</span>';
$app_dates=$d_date;
 $name = array(
 'num' => $i,
 'eid'=> $rowList['emp_code'], 
 'ldate'=> $app_dates,
 'ltype'=> $rowList['leave_type'],
 'ladate'=> $rowList['apply_date'],
 'lmsg'=> $rowList['leave_message'],
 'flname'=> $fl,
 'lstatus'=> ucfirst($f_s),
 'actions'=> '<button type="button" id="'.$lid.'" class="btn btn-success btn-sm leave-approve"><i class="fa fa-check"></i></button> 
              <button type="button" id="'.$lid.'" class="btn btn-danger btn-sm leave-reject"><i class="fa fa-close"></i></button>'
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>