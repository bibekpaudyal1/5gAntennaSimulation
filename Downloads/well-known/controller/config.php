<?php

require ('name_supply.php');

// MySQL Database Details
define('DB_SERVER', 	'localhost');
define('DB_USER', 		'dea2045_v2');
define('DB_PASSWORD', '[=L)p9OfrH?}');
define('DB_NAME', 		'dea2045_v2');
define('DB_PREFIX', 	'wy_');

ini_set("display_errors", 0);

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

date_default_timezone_set("Asia/Kathmandu");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if ( mysqli_connect_errno() ) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

session_start();

// login Page
if(isset($_POST['do_login']))
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $select_data = mysqli_query($con, "SELECT * from wy_users WHERE emp_code='$email' AND emp_password='$pass';")or die(mysqli_error($con));
  if($row=mysqli_fetch_array($select_data))
  {
    $_SESSION['email']=$row['email'];
    $_SESSION['user']=$row['emp_code'];

    $sfn=$row['first_name'] . ' ' . $row['last_name'];
    $_SESSION['userf']= $sfn;
    echo "success";
  }
  else
  {
    echo "fail";
  }
  exit();
}
// Login Page Ended

//For the leave approve
if( isset($_POST['approve_id']) )
    {
      $select_id=$_POST["approve_id"];
        $sql_update = "UPDATE `wy_leaves` SET `leave_status` = 'approve' WHERE `leave_id` = '$select_id'";
        if (mysqli_query($con, $sql_update)) {
            echo json_encode(array("statusCode"=>2000));
        } 
        else {
            echo json_encode(array("statusCode"=>2001));
        }
    } 
//For the leave reject
if( isset($_POST['reject_id']) )
    {
      $select_id=$_POST["reject_id"];
        $sql_update = "UPDATE `wy_leaves` SET `leave_status` = 'reject' WHERE `leave_id` = '$select_id'";
        if (mysqli_query($con, $sql_update)) {
            echo json_encode(array("statusCode"=>2000));
        } 
        else {
            echo json_encode(array("statusCode"=>2001));
        }
    } 

//Notice Add
    if( isset($_POST['ntitle']) )
    {
    $ndate=$_POST['ndate'];
    $ntitle=$_POST['ntitle'];
    $ntype=$_POST['ntype'];
    $ndes=$_POST['ndes'];
    $nuser=$_POST['nuser'];
    $notice_to=$_POST['notice_to'];

    $sql = "INSERT INTO `wy_notice`(`notice_title`, `notice_type`, `notice_desc`, `emp_code`, `notice_to`, `notice_status`) 
    VALUES ('$ntitle','$ntype','$ndes','$nuser','$notice_to','')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }

//Notice Delete
if( isset($_POST['nid']) )
    {
        $delete_id=$_POST["nid"];
        $sql_del = "DELETE FROM wy_notice WHERE `wy_notice`.`notice_id` = '$delete_id'"; 
        if (mysqli_query($con, $sql_del)) {
        echo json_encode(array("statusCode"=>300));
        } 
        else {
            echo json_encode(array("statusCode"=>301));
        }       
    }

//For Single Notice View
    if( isset($_POST['noticeId']) )
    {
        $upselect_id=$_POST["noticeId"];
        $sql_upselect = mysqli_query($con, "SELECT n.notice_id, n.emp_code, n.notice_title, n.notice_type, n.notice_desc, n.generate_date, n.notice_to, n.notice_status, e.first_name AS fname, e.last_name AS lname FROM wy_notice n INNER JOIN wy_employees e ON n.emp_code = e.emp_code WHERE n.notice_id = '$upselect_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        echo json_encode($row);
    } 


//For Single Notice View
    if(isset($_POST['viewid']) )
    {
        $upselect_id=$_POST["viewid"];
        $c_user = '%' . $_SESSION['userf'] . '%';

        $sqltran = mysqli_query($con, "SELECT n.notice_id, n.emp_code, n.notice_title, n.notice_type, n.notice_desc, n.generate_date, n.notice_to, n.notice_status, e.first_name AS fname, e.last_name AS lname FROM wy_notice n INNER JOIN wy_employees e ON n.emp_code = e.emp_code WHERE n.notice_id='$upselect_id' AND n.notice_to LIKE '$c_user' ORDER BY n.notice_id DESC;")or die(mysqli_error($con));
        $Notice_View_Status='';
        $fn = $_SESSION['userf'];
    //while ($rowList = mysqli_fetch_array($sqltran)) { 
        $rowList=mysqli_fetch_assoc($sqltran);

        $f = $rowList['fname'];
        $l = $rowList['lname'];
        $notice_writer = $f . ' ' . $l;

        $a = $rowList['notice_to'];
        $b = $rowList['notice_status'];
        $notice_title=$rowList['notice_title'];
        $notice_date=$rowList['generate_date'];
        $notice_desc=$rowList['notice_desc'];
        $notice_id=$rowList['notice_id'];
        $notice_status=$rowList['notice_status'];

         //   Notice Status 0 = Not agree, 1 = Agree
        $aArray = explode(",",$a);
        $bArray = explode(",",$b);
        $intersect = array_intersect($aArray, $bArray);
        $odata = implode(',', $intersect);

        $aArray = explode(",",$odata);
        $bArray = explode(",",$fn);
        $intersect2 = array_intersect($aArray, $bArray);
        $data = implode(',', $intersect2);

          if ($data !== '') {
            $Notice_View_Status = 1;
          }
          else
          {
            $Notice_View_Status = 0;  
          }

echo json_encode(array("statusCode"=>$Notice_View_Status,"notice_title"=>$notice_title,"notice_date"=>$notice_date,"notice_desc"=>$notice_desc,"notice_writer"=>$notice_writer,"notice_id"=>$notice_id,"notice_status"=>$notice_status));
    }

//Notice Agree Button 
if(isset($_POST['aggree_notice_id']) )
{
   $agree_id=$_POST["aggree_notice_id"];
   $otherEMP = $_POST["all_emp"];
   $aggreeEMP = $otherEMP . ',' . $_SESSION['userf'];
   $sql_update = "UPDATE `wy_notice` SET `notice_status` = '$aggreeEMP' WHERE `notice_id` = '$agree_id'";
        if (mysqli_query($con, $sql_update)) {
            echo json_encode(array("statusCode"=>2000));
        } 
        else {
            echo json_encode(array("statusCode"=>2001));
        }
}

//Task Delete
if( isset($_POST['taskid']) )
    {
        $delete_id=$_POST["taskid"];
        $sql_del = "DELETE FROM wy_tasks WHERE `wy_tasks`.`task_id` = '$delete_id'"; 
        if (mysqli_query($con, $sql_del)) {
        echo json_encode(array("statusCode"=>300));
        } 
        else {
            echo json_encode(array("statusCode"=>301));
        }       
    }

//Task Add
    if( isset($_POST['task_title']) )
    {
    $title=$_POST['task_title'];
    $title_desc=$_POST['title_desc'];
    $phase=$_POST['phase'];
    $writer=$_POST['writer'];
    $status=$_POST['status'];
    $progress=$_POST['progress'];
    $reference=$_POST['reference'];
    $issue=$_POST['issue'];

    $sql = "INSERT INTO `wy_tasks`(`task_writer`,`task_title`, `task_phase`, `task_status`, `task_progress`, `ref_needed`, `issue_recorded`, `title_desc`) 
    VALUES ('$writer','$title','$phase','$status','$progress','$reference','$issue','$title_desc')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }

//For the Task Hand Over, Detp Name Selected
if( isset($_POST['dept_name']) )
  {
    $dept_name=$_POST['dept_name'];
    $arrVal = array();
    $sql_person = mysqli_query($con, "SELECT * FROM wy_users WHERE `department` = '$dept_name'");
    $arrVal = array();
    while ($rowList = mysqli_fetch_array($sql_person)) {
      //--$arrVal = $rowList;
      $f = $rowList['first_name'];
      $l = $rowList['last_name'];
      $dept = $f . ' ' . $l;
      //$dept = $rowList['first_name'];
      array_push($arrVal, $dept);
    }
    echo json_encode($arrVal);
  }

//For Single Comment View
    if( isset($_POST['mytaskcommentid']) )
    {
        $select_id=$_POST["mytaskcommentid"];
        $sql_upselect = mysqli_query($con, "SELECT * from wy_tasks WHERE task_id = '$select_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        echo json_encode($row);
    } 

//Task Comment agree button
if(isset($_POST['aggree_task_id']) )
{
   $agree_id=$_POST["aggree_task_id"];
   $sql_update = "UPDATE `wy_tasks` SET `comment_status` = '0' WHERE `task_id` = '$agree_id'";
        if (mysqli_query($con, $sql_update)) {
            echo json_encode(array("statusCode"=>2000));
        } 
        else {
            echo json_encode(array("statusCode"=>2001));
        }
}

//For Single Task View
    if( isset($_POST['mytaskviewid']) )
    {
        $select_id=$_POST["mytaskviewid"];
        $sql_upselect = mysqli_query($con, "SELECT * from wy_tasks WHERE task_id = '$select_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        $add=0;
        echo json_encode($row);
    } 

//For My Profile View
    if( isset($_POST['get_my_profile']) )
    {
        $select_id=$_SESSION['user'];
        $sql_upselect = mysqli_query($con, "SELECT * from wy_users WHERE emp_code = '$select_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        echo json_encode($row);
    } 

//Punch In
    if( isset($_POST['punch_in_action']) )
    {
        $emp_code=$_SESSION['user'];
        $punch_in_remark=$_POST["punch_in_remark"];
        $t=time();
        $attendance_date= date("Y-m-d",$t);
        $punch_in_time= date("H:i:s",$t);
        $sql = "INSERT INTO `wy_daily_attendance`(`emp_code`,`attendance_date`, `punch_in_time`, `punch_in_remark`) 
    VALUES ('$emp_code','$attendance_date','$punch_in_time','$punch_in_remark')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }

//Punch Out
    if( isset($_POST['punch_out_action']) )
    {
        $emp_code=$_SESSION['user'];
        $punch_out_remark=$_POST["punch_out_remark"];
        $t=time();
        $attendance_date= date("Y-m-d",$t);
        $punch_out_time= date("H:i:s",$t);
        $sql = "UPDATE `wy_daily_attendance` SET `punch_out_time` = '$punch_out_time', `punch_out_remark` = '$punch_out_remark' WHERE `attendance_date` = '$attendance_date' AND `emp_code` = '$emp_code'";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }

//Adding My Leaves 
    if(isset($_POST['l_type']))
    {
    $l_type=$_POST['l_type'];
    $l_date=$_POST['l_date'];
    $l_msg=$_POST['l_msg'];
    $emp_code=$_SESSION['user'];
    $sql = "INSERT INTO `wy_leaves`(`emp_code`, `leave_dates`, `leave_message`, `leave_type`, `leave_status`, `leave_subject`) VALUES ('$emp_code','$l_date','$l_msg','$l_type','pending','')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    } 

//Change My Password
    if( isset($_POST['old_password']) )
    {
        $emp_code=$_SESSION['user'];
        $old_password=$_POST["old_password"];
        $new_password=$_POST["new_password"];
        //Password Change Date for future
        // $t=time();
        // $attendance_date= date("Y-m-d",$t);
        //$punch_out_time= date("H:i:s",$t);
        //Need to check if the old password is correct or not
        $sql = "UPDATE `wy_users` SET `emp_password` = '$new_password' WHERE `emp_code` = '$emp_code'";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    } 

//Task Comment Save by Admin
    if( isset($_POST['task_comment']) )
    {
        $emp_code=$_SESSION['userf'];
        $task_comment=$_POST["task_comment"];
        $task_comm_id=$_POST["task_comm_id"];
        
        $sql = "UPDATE `wy_tasks` SET `task_comment` = '$task_comment', `comment_status` = '1', `comment_admin` = '$emp_code' WHERE `task_id` = '$task_comm_id'";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    } 
?>