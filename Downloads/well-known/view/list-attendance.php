<?php
require_once 'header.php';
?>

<body>
	<div class="wrapper">
        <?php require_once 'sidenav.php';?>
        <div id="content">                      
            <?php require_once 'topnav.php';?>	
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
       url: 'list-attendance-table.php',
       search: true,
       pagination: true,
       buttonsClass: 'primary',
       showFooter: false,
       minimumCountColumns: 6,
       columns: [{
           field: 'num',
           title: '#',
           sortable: true,
       },{
           field: 'edate',
           title: 'Date',
           sortable: true,
           
       },{
           field: 'eid',
           title: 'E ID',
           sortable: true,
       },{
           field: 'fname',
           title: 'Full Name',
           sortable: true,
       },{
           field: 'punch_in_time',
           title: 'Punch-In',
           sortable: true,
       },{
           field: 'punch_in_remark',
           title: 'Punch-In Remark',
           sortable: true,
       },{
           field: 'punch_out_time',
           title: 'Punch-Out',
           sortable: true,
       },{
           field: 'punch_out_remark',
           title: 'Punch-Out Remark',
           sortable: true,
       },{
           field: 'working_hours',
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
		
	</div>
<?php require_once 'footer.php';?>
</body>
</html>