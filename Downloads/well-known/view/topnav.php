<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">               
            <button type="button" id="sidebarCollapse" class="btn btn-sm btn-outline-primary">
                <i class="fa-solid fa-bars"></i>         
            </button>

            <form id="fupForm" name="form-nv" method="post">
                <div class="input-group float-right">
                    <?php
                        $p_i_o=$_SESSION['user'];
                        $t=time();
                        $p_i_date= date("Y-m-d",$t);
                        $sql_p_i = mysqli_query($con, "SELECT * from wy_daily_attendance WHERE emp_code = '$p_i_o' AND attendance_date='$p_i_date';")or die(mysqli_error($con));                        
                         //Row Count
                          $rowcount=mysqli_num_rows($sql_p_i);
                          
                          if($rowcount!=0)
                            {
                                $row=mysqli_fetch_assoc($sql_p_i);
                                if($row['punch_out_time']!='')
                                {
                                    echo'';
                                }
                                else
                                {
                                echo'<input type="text" id="punch-out-re" name="punch-out-re" class="form-control attendance-comment" placeholder="Comment (if any)" value="Good Bye">
                                <input type="button" id="btn-punch-out" name="btn-punch-out" class="btn btn-primary btn-sm attendance" value="Punch Out">';
                                }
                            }
                            else
                            {
                                echo'
                                <input type="text" id="punch-in-re" name="punch-in-re" class="form-control attendance-comment" placeholder="Comment (if any)" value="Good Morning">
                                <input type="button" id="btn-punch-in" name="btn-punch-in" class="btn btn-primary btn-sm attendance" value="Punch In">';                                
                            }
                    ?>
                </div>
            </form> 
            <a href="<?php echo system_url; ?>view/auth/logout.php/" class="btn btn-primary float-right btn-sm">Logout</a>
        </div>
    </nav>