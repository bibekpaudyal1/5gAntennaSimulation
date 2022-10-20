<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

$my_id=$_SESSION['user']; 
$sqltran = mysqli_query($con, "SELECT s.salary_id, s.emp_code, s.generate_date, s.pay_amount, s.deduction_total, s.net_salary, s.pay_month, s.allowance, s.bonus, s.tax, s.pf, s.twork, s.cwork, e.first_name AS fname, e.last_name AS lname FROM wy_salaries s INNER JOIN wy_employees e ON s.emp_code = e.emp_code WHERE s.emp_code='$my_id' ORDER BY s.salary_id DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $f = $rowList['fname'];
 $l = $rowList['lname'];
$fl = $f . ' ' . $l;
$pid = $rowList['salary_id'];
$dd = $rowList['generate_date'];
$ddate = date('Y-m-d', strtotime($dd));

 $name = array(
 'num' => $i,
 'ecode'=> $rowList['emp_code'],
'date'=> '<div style="min-width:75px;">' . $ddate . '</div>',
'smonth'=> $rowList['pay_month'],
 'allowance'=> 'Rs. ' . number_format($rowList['allowance'], 2), 
 'bonus'=> 'Rs. ' . number_format($rowList['bonus'], 2),
 'bsalary'=> 'Rs. ' . number_format($rowList['net_salary'], 2),
  'tax'=> '<div style="min-width:70px;">Rs. ' . number_format($rowList['tax'], 2) . '</div>',
'pf'=> 'Rs. ' . number_format($rowList['pf'], 2),
'ts'=> 'Rs. ' . number_format($rowList['pay_amount'], 2),
 'flname'=> '<div style="min-width:125px;">' . $fl . '</div>',
 'twork'=> $rowList['twork'],
 'cwork'=> $rowList['cwork'],
 'delete' => '<div style="min-width:170px;"><button type="button" data-toggle="modal" data-target="#pdfprint" name="view" id="'.$pid.'" class="btn btn-outline-primary btn-sm view" >View</button> <button type="button" name="delete" id="'.$pid.'" class="btn btn-outline-danger btn-sm delete" >Delete</button></div>'

);
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>