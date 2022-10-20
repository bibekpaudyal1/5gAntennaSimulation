<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../Controller/config.php';
 

 function secondsToWords($seconds) {
    /*** number of days ***/
    $days = (int)($seconds / 86400);
    /*** if more than one day ***/
    $plural = $days > 1 ? 'days' : 'day';
    /*** number of hours ***/
    $hours = (int)(($seconds - ($days * 86400)) / 3600);
    /*** number of mins ***/
    $mins = (int)(($seconds - $days * 86400 - $hours * 3600) / 60);
    /*** number of seconds ***/
    $secs = (int)($seconds - ($days * 86400) - ($hours * 3600) - ($mins * 60));
    /*** return the string ***/
    //return sprintf("%d $plural, %d hours, %d min, %d sec", $hours, $mins);
    return sprintf("%d hours, %d min", $hours, $mins);
}

$sqltran = mysqli_query($con, "SELECT a.attendance_id, a.attendance_date, a.emp_code, e.first_name AS fname, e.last_name AS lname, GROUP_CONCAT(CONCAT_WS(',', a.action_name, a.action_time, a.emp_desc)) AS data, GROUP_CONCAT(CONCAT_WS(',', a.action_time)) AS atime FROM wy_attendance a INNER JOIN wy_employees e ON a.emp_code = e.emp_code GROUP BY a.attendance_date, a.emp_code ORDER BY a.attendance_date ASC;")or die(mysqli_error($con));
 $arrVal = array();
 
 $i=1;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $name = array(
 'num' => $i,
 'edate'=> $rowList['attendance_date'],
 'aid'=> $rowList['attendance_id'],
 'eid'=> $rowList['emp_code'],
 'fname'=> $rowList['fname'],
 'lname'=> $rowList['lname']
 //'etime'=> $rowList['action_times'],
 //'eaction'=> $rowList['action_names'],
 //'edesc'=> $rowList['data']
 );
 
$string = explode(', ', $rowList['data']);
$result = array(); # or your existing array
foreach($string as $chunk){
        $to_array = new stdClass();
        list($to_array->punchin, $to_array->punchintime, $to_array->punchinmsg, $to_array->punchout, $to_array->punchouttime, $to_array->punchoutmsg) = explode(',', $chunk);
        $to_arrayy = json_decode(json_encode($to_array), true);
        //$result[] = $to_arrayy;
}



//Total Time Taken
 $tstring = explode(',', $rowList['atime']);
 //$tstring = $rowList['atime'];
 $first = $tstring[0];
$second = $tstring[1];
if (is_null($second)) {
       $ttstring = 0;      
    }

else
{
    $end = strtotime($second);


    $start = strtotime($first);
    //$end = strtotime($second);
    $seconds = ($end - $start);
    $ss = abs($seconds);

    /*** show the words ***/
    $ttstring = secondsToWords($ss);
    
}

//echo json_encode($ttstring);
 
$ttarray = array(
    "timetaken" => "$ttstring"
);


$aa = (array_merge($name, $to_arrayy, $ttarray));
 array_push($arrVal, $aa);
 $i++;

}

echo json_encode($arrVal); 
 
mysqli_close($con);
?>