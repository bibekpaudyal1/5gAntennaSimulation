<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';
 
$sqltran = mysqli_query($con, "SELECT * from wy_holidays ORDER BY holiday_date ASC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $nameholi = strtotime($rowList['holiday_date']);

$namedate = date('l', $nameholi);
 $name = array(
 'num' => $i,
 'hdate'=> $rowList['holiday_date'],
 'namedate'=> $namedate,
 'htitle'=> ucfirst($rowList['holiday_title']), 
 'hdesc'=> ucfirst($rowList['holiday_desc']),
 'sstatus'=> $rowList['special_status']
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>
