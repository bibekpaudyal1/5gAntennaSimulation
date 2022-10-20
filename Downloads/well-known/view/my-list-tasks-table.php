<?php 
//Convert to .JSON type
 header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

//Notice to filter 
$c_user = $_SESSION['user'];
$sqltran = mysqli_query($con, "SELECT n.task_id, n.task_writer, n.task_title, n.comment_status, n.task_phase, n.task_status, n.date, n.task_progress, n.ref_needed, n.issue_recorded, n.title_desc, e.department, e.designation, e.first_name AS fname, e.last_name AS lname FROM wy_tasks n INNER JOIN wy_users e ON n.task_writer = e.emp_code WHERE n.task_writer='$c_user' ORDER BY n.task_id DESC")or die(mysqli_error($con));
 $arrVal = array();

//For total Task Count 
 $sqltran_count = mysqli_query($con, "SELECT COUNT(task_id) AS total_tasks FROM wy_tasks WHERE task_writer='$c_user'")or die(mysqli_error($con));
  $rowListCount=mysqli_fetch_assoc($sqltran_count);
        $TotalCount = $rowListCount['total_tasks'];
//End for the Total Task Count

 $i=$TotalCount;
 while ($rowList = mysqli_fetch_array($sqltran)) {
 
 $f = $rowList['fname'];
 $l = $rowList['lname'];
 $row_id = $rowList['task_id'];
//First and Last Name
$fl = $f . ' ' . $l;

//Status Color
if($rowList['task_status']=='Pending')
{
  $task_status = '<span class="badge badge-dark">Pending</span>';
}
elseif($rowList['task_status']=='In Progress')
{
  $task_status = '<span class="badge badge-primary">In Progress</span>';
}
elseif($rowList['task_status']=='Complete')
{
  $task_status = '<span class="badge badge-success">Complete</span>';
}

//Task Color
if($rowList['task_title']=='Today')
{
  $task_title = '<span class="badge badge-primary">Today</span>';
}
elseif($rowList['task_title']=='Tomorrow')
{
  $task_title = '<span class="badge badge-warning">Tomorrow</span>';
}
elseif($rowList['task_title']=='Complete')
{
  $task_title = '<span class="badge badge-success">Complete</span>';
}
elseif($rowList['task_title']=='Hand Over')
{
  $task_title = '<span class="badge badge-dark">Hand Over</span>';
}
elseif($rowList['task_title']=='Routine')
{
  $task_title = '<span class="badge badge-info">Routine</span>';
}

//Issue Color
if($rowList['issue_recorded']=='No')
{
  $issue_recorded = '<span class="badge badge-primary">No</span>';
}
elseif($rowList['issue_recorded']=='Yes')
{
  $issue_recorded = '<span class="badge badge-danger">Yes</span>';
}

//Comment Status
if($rowList['comment_status']=='1')
{
  $comment = '<button type="button" name="delete" id="'.$row_id.'" class="btn btn-outline-danger btn-sm task-delete">Delete</button> <button type="button" name="comment" id="'.$row_id.'" class="btn btn-outline-primary btn-sm task-comment">Comment</button> <button type="button" name="view-task" id="'.$row_id.'" class="btn btn-outline-primary btn-sm view-task">View</button>';
} 
else 
{
  $comment = '<button type="button" name="delete" id="'.$row_id.'" class="btn btn-outline-danger btn-sm task-delete">Delete</button> <button type="button" name="comment" id="'.$row_id.'" class="btn btn-outline-primary btn-sm task-comment" hidden>Comment</button> <button type="button" name="view-task" id="'.$row_id.'" class="btn btn-outline-primary btn-sm view-task">View</button>';
}

//Comment alert on Task Name
if($rowList['comment_status']=='1')
{
  $comment_alert = '<span class="badge badge-info">Comment</span>';
} 
else 
{
  $comment_alert = '';
}
 $name = array(
 'num' => $i,
 'date'=> $rowList['date'],
 'department'=> $rowList['department'],
 'title_desc'=> $rowList['title_desc'] . ' ' . $comment_alert,
 'task_title'=> $task_title,
 'flname'=> $fl,
 'task_phase'=> $rowList['task_phase'],
 'task_status'=> $task_status,
 'task_progress'=> $rowList['task_progress'],
 'ref_needed'=> $rowList['ref_needed'],
 'issue_recorded'=> $issue_recorded,
 'view'=> $comment
 );
 
 array_push($arrVal, $name);
 $i--;
}

echo json_encode($arrVal);

mysqli_close($con);
?>