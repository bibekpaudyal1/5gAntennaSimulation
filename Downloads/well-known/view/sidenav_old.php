<nav id="sidebar">
    <div class="sidebar-header">
            <h3>Office  System</h3>
            <strong>OMS</strong>
    </div>

        <ul class="list-unstyled components side-nav">
                <li>
                    <a href="#mySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle down-icon"><i class="fa fa-user-circle"></i> <span> My Dashboard</span></a>
                    <ul class="collapse list-unstyled" id="mySubmenu">
                        <li>
                            <a href="<?php echo system_url; ?>view/view-profile.php">My Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo system_url; ?>view/my_list_notice.php">My Notice</a>
                        </li>
                        <li>
                            <a href="<?php echo system_url; ?>view/my-list-tasks.php">My Tasks</a>
                        </li>
                        <li>
                            <a href="<?php echo system_url; ?>view/view-resignation.php">My Job Description</a>
                        </li> 
                        <li>
                            <a href="<?php echo system_url; ?>view/list-leave.php">My Attendance</a>
                        </li>
                        <li>
                            <a href="<?php echo system_url; ?>view/list-leave.php">My Leaves</a>
                        </li>  
                        <li>
                            <a href="<?php echo system_url; ?>view/view-resignation.php">My Resignation</a>
                        </li> 
                        <li>
                            <a href="<?php echo system_url; ?>view/list-leave.php">My Holidays</a>
                        </li>  
                        <li>
                            <a href="<?php echo system_url; ?>view/list-leave.php">My Salary Slips</a>
                        </li>                      
                    </ul>
                </li>
<?php
//For the Task Hand Over, Detp Name Selected
    
    $user=$_SESSION['user'];
    $arrVal = array();
    $sql_person = mysqli_query($con, "SELECT user_type FROM wy_users WHERE `emp_code` = '$user'");
    $arrVal = array();
    while ($rowList = mysqli_fetch_array($sql_person)) {
      //--$arrVal = $rowList;
      $type = $rowList['wy_users'];
    }
if($type==1)
    
?>
                <li>
                    <a href="<?php echo system_url; ?>view/list_leave.php">
                        <i class="fa fa-sign-out"></i> <span> Leave </span>
                    </a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle down-icon"><i class="fa-solid fa-coins"></i> <span> Salary </span></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="<?php echo system_url; ?>view/list-salary-emp.php"> Employee Lists</a>
                        </li>
                        <li>
                            <a href="<?php echo system_url; ?>view/list_salary.php"> Salary Lists</a>
                        </li>                        
                    </ul>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/list_notice.php">
                        <i class="fa-solid fa-flag-checkered"></i> <span> Notice </span>
                    </a>
                </li>               
                <li>
                    <a href="<?php echo system_url; ?>view/list_holiday.php">
                        <i class="fa-solid fa-calendar-check"></i> <span> Holiday </span>
                    </a>
                </li>                            
               <li>
                    <a href="<?php echo system_url; ?>view/admin_home.php">
                        <i class="fa fa-calendar"></i> <span> Attendance </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/list-tasks.php">
                        <i class="fa fa-tasks"></i> <span> Tasks </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/admin_home.php">
                        <i class="fa fa-address-card" aria-hidden="true"></i> <span> Employee </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/admin_home.php">
                        <i class="fa fa-users" aria-hidden="true"></i> <span> Meeting </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/admin_home.php">
                        <i class="fa fa-folder-open" aria-hidden="true"></i> <span> Document </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>view/admin_home.php">
                        <i class="fa fa-external-link-square" aria-hidden="true"></i> <span> Request </span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<php echo system_url; ?>View/list_absent.php">
                        <i class="fa-solid fa-coins"></i> <span> Absent </span>
                    </a>
                </li>     -->       
        </ul>
</nav><!-- side bar close -->
