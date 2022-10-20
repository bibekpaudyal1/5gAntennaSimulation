<?php
header('Content-type: application/json; charset=utf-8');
 require_once '../controller/config.php';

 //save
    if( isset($_POST['flname']) )
    {
    $emp_code=$_POST['flname'];
    $month=$_POST['month'];
    $bsalary=$_POST['bsalary'];
    $allowance=$_POST['allowance'];
    $bonus=$_POST['bonus'];
    $tax=$_POST['tax'];
    $pf=$_POST['pf'];
    $ts=$_POST['ts'];
    $twork=$_POST['twork'];
    $cwork=$_POST['cwork'];

    $sql = "INSERT INTO `wy_salaries`( `emp_code`, `pay_month`, `net_salary`, `allowance`, `bonus`, `tax`, `pf`, `pay_amount`, `twork`, `cwork`) 
    VALUES ('$emp_code','$month','$bsalary','$allowance','$bonus','$tax','$pf','$ts', '$twork', '$cwork')";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }
}

    //Delete salary
    if( isset($_POST['empId']) )
    {
        $delete_id=$_POST["empId"];
        $sql_del = "DELETE FROM wy_salaries WHERE `wy_salaries`.`salary_id` = '$delete_id'"; 
        if (mysqli_query($con, $sql_del)) {
        echo json_encode(array("statusCode"=>300));
        } 
        else {
            echo json_encode(array("statusCode"=>301));
        }       
    }

    //Update field after the select
    if( isset($_POST['getempId']) )
    {
        $upselect_id=$_POST["getempId"];
        $sql_upselect = mysqli_query($con, "SELECT * from wy_emp_salary WHERE `wy_emp_salary`.`emp_code` = '$upselect_id';")or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($sql_upselect);
        echo json_encode($row);
    }  

    mysqli_close($con);
?>