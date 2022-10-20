<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

//Notice to filter 
$c_user = '%' . $_SESSION['userf'] . '%';
$sqltran = mysqli_query($con, "SELECT n.notice_id, n.emp_code, n.notice_title, n.notice_type, n.notice_desc, n.generate_date, n.notice_to, n.notice_status, e.first_name AS fname, e.last_name AS lname FROM wy_notice n INNER JOIN wy_employees e ON n.emp_code = e.emp_code WHERE n.notice_to LIKE '$c_user' ORDER BY n.notice_id DESC")or die(mysqli_error($con));
 $arrVal = array();
 $Notice_View_Status='';

 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $f = $rowList['fname'];
 $l = $rowList['lname'];
 $row_id = $rowList['notice_id'];
//First and Last Name
$fl = $f . ' ' . $l;
$notice_title = $rowList['notice_title'];
//Filter Date 
$published_date = $rowList['generate_date'];
$today_date =strftime('%F');

$date1=date_create($published_date);
$date2=date_create($today_date);
$diff=date_diff($date1,$date2);
$total_days = $diff->format("%R%a");

if($total_days >2)
{$ntitle_badge = $notice_title;}
else
{$ntitle_badge = $notice_title . ' <span class="badge badge-info">Latest</span>';}

//Notice To + Status
$a = $rowList['notice_to'];
$b = $rowList['notice_status'];
$unique_words = '<span class="badge badge-warning notice-to-color">' . show_unique_strings($a, $b) . '</span> ';
$show_similar_strings = '<span class="badge badge-success notice-to-color">' . show_similar_strings($a, $b) . '</span>';

//Combine Notice View
$notice_to_filterted = $unique_words . $show_similar_strings;

//Notice Status 0 = Not agree, 1 = Agree
if (strpos(show_similar_strings($a, $b), $_SESSION['userf']) !== false) {
    $Notice_View_Status = 1;
}
else
{
  $Notice_View_Status = 0;  
}

//Notice ID
 $row_id = $rowList['notice_id'];

 $name = array(
 'num' => $i,
 'ndate'=> $rowList['generate_date'],
 'ntitle'=> $ntitle_badge, 
 'ntype'=> $rowList['notice_type'],
 'ndesc'=> $rowList['notice_desc'],
 'notice_to'=> $notice_to_filterted, 
 'flname'=> $fl,
'view'=> '<button type="button" name="delete" id="'.$row_id.'" class="btn btn-outline-primary btn-sm notice-view notice-status">View Notice</button>',
'view_notice_status'=> $Notice_View_Status
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