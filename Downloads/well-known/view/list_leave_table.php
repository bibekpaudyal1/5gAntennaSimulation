<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';
 
$sqltran = mysqli_query($con, "SELECT l.leave_id, l.emp_code, l.leave_dates, l.leave_type, l.apply_date, l.leave_status, l.leave_message, e.first_name AS fname, e.last_name AS lname FROM wy_leaves l INNER JOIN wy_users e ON l.emp_code = e.emp_code ORDER BY l.leave_id DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $approve = 'approve';
 $reject = 'reject';
 $pending = 'pending';

 //For total Leave Count 
 $sqltran_count = mysqli_query($con, "SELECT COUNT(leave_id) AS total_tasks FROM wy_leaves")or die(mysqli_error($con));
  $rowListCount=mysqli_fetch_assoc($sqltran_count);
        $TotalCount = $rowListCount['total_tasks'];
//End for the Total Leave Count

$i=$TotalCount;

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
 $name = array(
 'num' => $i,
 'eid'=> $rowList['emp_code'], 
 'ldate'=> $rowList['leave_dates'],
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