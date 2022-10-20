<?php
require_once 'header.php';
?>

<body>
	<div class="wrapper">
		
		<?php 
		require_once 'topnav.php';
		?>
<div id="content">						
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