<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

$writer = $_SESSION['user']; 
$sqltran = mysqli_query($con, "SELECT n.notice_id, n.emp_code, n.notice_title, n.notice_type, n.notice_desc, n.generate_date, n.notice_to, n.notice_status, e.first_name AS fname, e.last_name AS lname FROM wy_notice n INNER JOIN wy_employees e ON n.emp_code = e.emp_code WHERE n.emp_code = '$writer' ORDER BY n.notice_id DESC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $f = $rowList['fname'];
 $l = $rowList['lname'];
 $row_id = $rowList['notice_id'];

$fl = $f . ' ' . $l;

//Notice To
//$notice_to = $rowList['notice_to'];
//$notice_to_filterted = '<span class="badge bg-warning">' . str_replace(',', '</span> <span class="badge bg-warning">', $notice_to) . '</span>';
//Notice To + Status
$a = $rowList['notice_to'];
$b = $rowList['notice_status'];
$unique_words = '<span class="badge badge-warning notice-to-color">' . show_unique_strings($a, $b) . '</span> ';
$show_similar_strings = '<span class="badge badge-success notice-to-color">' . show_similar_strings($a, $b) . '</span>';

//Combine Notice View
$notice_to_filterted = $unique_words . $show_similar_strings;

 $name = array(
 'num' => $i,
 'ndate'=> $rowList['generate_date'],
 'ntitle'=> $rowList['notice_title'], 
 'ntype'=> $rowList['notice_type'],
 'ndesc'=> $rowList['notice_desc'], 
 'notice_to'=> $notice_to_filterted, 
 'flname'=> $fl,
 'delete'=> '<button type="button" name="delete" id="'.$row_id.'" class="btn btn-outline-danger btn-sm notice-delete">Delete</button>'
 );
 
 array_push($arrVal, $name);
 $i++;
}

echo json_encode($arrVal); 

 function show_unique_strings($a, $b) {
  $aArray = explode(",",$a);
  $bArray = explode(",",$b);
  $intersect = array_intersect($aArray, $bArray);
  return implode('</span> <span class="badge badge-warning notice-to-color">', array_merge(array_diff($aArray, $intersect), array_diff($bArray, $intersect)));
}

function show_similar_strings($a, $b) {
  $aArray = explode(",",$a);
  $bArray = explode(",",$b);
  $intersect = array_intersect($aArray, $bArray);
    return implode('</span> <span class="badge badge-success notice-to-color">', $intersect);
}
 
mysqli_close($con);
?>