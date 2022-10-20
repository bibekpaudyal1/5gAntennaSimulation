<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: user_login.php');
	exit;
}
require_once '../Controller/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Attendance - <?php echo system_name;?></title>
    <!--Icon-->
        <link rel = "icon" href = "<?php echo system_url; ?>Template/images/icon.png" 
        type = "image/x-icon">
    <!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="<?php echo system_url; ?>Template/style.css">

    <link rel="stylesheet" href="<?php echo system_url; ?>Template/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo system_url; ?>Template/dist/css/skins/_all-skins.min.css">


</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		
		<?php 
		require_once 'topnav.php';
		?>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>          
                <li class="active">
                    <a href="<?php echo system_url; ?>View/admin_home.php">
                        <i class="fa fa-calendar"></i> <span>Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>View/list_leave.php">
                        <i class="fa fa-sign-out"></i> <span>Leave Management</span>
                    </a>
                </li>           
                <li>
                    <a href="<?php echo system_url; ?>View/list_holiday.php">
                        <i class="fa-solid fa-calendar-check"></i> <span>Holiday Management</span>
                    </a>
                </li>
                    <li>
                    <a href="<?php echo system_url; ?>View/list_notice.php">
                        <i class="fa-solid fa-flag-checkered"></i> <span>Notice Management</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>View/list_salary.php">
                        <i class="fa-solid fa-coins"></i></i> <span>Salary Management</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo system_url; ?>View/list_absent.php">
                        <i class="fa-solid fa-coins"></i></i> <span>Absent Management</span>
                    </a>
                </li>           
        </ul>
    </section>
</aside>

<div class="content-wrapper">						
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    

		<div class="h4_"><h3>Attendance</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">
			 	<div class="box">
			 	<span class="h4_"><h4>Employee Attendance</h4></span>
				<table id="table"	data-show-columns="true">
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'admin_home_table.php',
       search: true,
       pagination: true,
       buttonsClass: 'primary',
       showFooter: true,
       minimumCountColumns: 6,
       columns: [{
           field: 'num',
           title: '#',
           sortable: true,
       },{
           field: 'edate',
           title: 'Date',
           sortable: true,
           
       },//{
           //field: 'aid',
           //title: 'A-ID',
           //sortable: true,           
       //},
       {
           field: 'eid',
           title: 'E ID',
           sortable: true,
       },{
           field: 'fname',
           title: 'First Name',
           sortable: true,
       },{
           field: 'lname',
           title: 'Last Name',
           sortable: true,
       },{
           field: 'punchintime',
           title: 'Punch-In (AM)',
           sortable: true,
       },{
           field: 'punchinmsg',
           title: 'Punch-In Message',
           sortable: true,
       },{
           field: 'punchouttime',
           title: 'Punch-Out (PM)',
           sortable: true,
       },{
           field: 'punchoutmsg',
           title: 'Punch-Out Message',
           sortable: true,
       },{
           field: 'timetaken',
           title: 'Work Hours',
           sortable: true,
       }
         ],
 
   });
 
</script>
		</div>
			</div>
		</div>	
		</div>
</div>
		
		<footer class="main-footer">

		</footer>
	</div>

</body>
</html>