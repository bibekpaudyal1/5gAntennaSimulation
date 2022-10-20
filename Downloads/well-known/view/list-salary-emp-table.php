<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';
 
$sqltran = mysqli_query($con, "SELECT s.emp_salary_id, s.emp_code, s.basic_salary, s.allowance, s.tax, s.pf, s.twork, e.first_name AS fname, e.last_name AS lname FROM wy_emp_salary s INNER JOIN wy_users e ON s.emp_code = e.emp_code ORDER BY s.emp_salary_id DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $f = $rowList['fname'];
 $l = $rowList['lname'];
$fl = $f . ' ' . $l;
$pid = $rowList['emp_salary_id'];

 $name = array(
 'num' => $i,
 'ecode'=> $rowList['emp_code'],
  'bsalary'=> 'Rs. ' . number_format($rowList['basic_salary'], 2),
    'tax'=> 'Rs. ' . number_format($rowList['tax'], 2),
    'pf'=> 'Rs. ' . number_format($rowList['pf'], 2),
  'allowance'=> 'Rs. ' . number_format($rowList['allowance'], 2),
 'flname'=> $fl,
 'twork'=> $rowList['twork'],
 'update' => '<button type="button" name="update" id="'.$pid.'" class="btn btn-outline-warning btn-sm update">Update</button><button type="button" name="delete" id="'.$pid.'" class="btn btn-outline-danger btn-sm delete" >Delete</button>',
 // 'delete' => '<button type="button" name="delete" id="'.$pid.'" class="btn btn-outline-danger btn-xs delete" >Delete</button>'
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>