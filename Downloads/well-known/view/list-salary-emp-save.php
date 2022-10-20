<?php
header('Content-type: application/json; charset=utf-8');
session_start();
 require_once '../controller/config.php';

    //New data save
    if( isset($_POST['flname']) )
    {
    $emp_code=$_POST['flname'];
    $bsalary=$_POST['bsalary'];
    $allowance=$_POST['allowance'];
    $tax=$_POST['tax'];
    $pf=$_POST['pf'];
    $addtwork=$_POST['addtwork'];

    $sql = "INSERT INTO `wy_emp_salary`(`emp_code`, `basic_salary`, `allowance`, `tax`, `pf`, `twork`) 
    VALUES ('$emp_code','$bsalary','$allowance','$tax','$pf','$addtwork')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }

    //Delete
    if( isset($_POST['empId']) )
    {
        $delete_id=$_POST["empId"];
        $sql_del = "DELETE FROM wy_emp_salary WHERE `wy_emp_salary`.`emp_salary_id` = '$delete_id'"; 
        if (mysqli_query($con, $sql_del)) {
        echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }       
    }

    //Update select data
    if( isset($_POST['uempId']) )
    {
        $upselect_id=$_POST["uempId"];
        $sql_upselect = mysqli_query($con, "SELECT * from wy_emp_salary WHERE `wy_emp_salary`.`emp_salary_id` = '$upselect_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        echo json_encode($row);
    }    

    //Update
    if( isset($_POST['uid']) )
    {    
    $update_id=$_POST["uid"];
    $ubsalary=$_POST['ubsalary'];
    $uallowance=$_POST['uallowance'];
    $utax=$_POST['utax'];
    $upf=$_POST['upf'];
    $twork=$_POST['twork'];

    $sql_update = "UPDATE `wy_emp_salary` SET `twork` = '$twork', `basic_salary` = '$ubsalary', `tax` = '$utax', `pf` = '$upf', `allowance` = '$uallowance' WHERE `emp_salary_id` = '$update_id'";
    if (mysqli_query($con, $sql_update)) {
        echo json_encode(array("statusCode"=>2000));
    } 
    else {
        echo json_encode(array("statusCode"=>2001));
    }
    }
    mysqli_close($con);
?>