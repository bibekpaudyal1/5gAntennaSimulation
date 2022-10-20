<?php
require_once 'header.php';
?>

<body>
	<div class="wrapper">
		
		<?php 
		require_once 'sidenav.php';
		?>

<div id="content">
    <?php 
        require_once 'topnav.php';
    ?>

	<div class="h4_"><h3>Salary</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">                
			 	<div class="box">
                        <span class="h4_"><h4>Salary Lists</h4></span>
				<table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'my-salary-table.php',
       search: true,
       pagination: true,
       buttonsClass: 'primary',
       showFooter: false,
       showRefresh: true,
       minimumCountColumns: 6,
       columns: [{
           field: 'num',
           title: '#',
           sortable: true,
       },{
           field: 'date',
           title: 'Date',
           sortable: true,
           
       },{
           field: 'ecode',
           title: 'E ID',
           sortable: true,
           
       },{
           field: 'flname',
           title: 'Full Name',
           sortable: true,
           
       },{
           field: 'smonth',
           title: 'Month',
           sortable: true,
           
       },{
           field: 'twork',
           title: 'Issued Working Hours',
           sortable: true,
           
       },{
           field: 'cwork',
           title: 'Attended Hours',
           sortable: true,
           
       },{
           field: 'bsalary',
           title: 'Basic Salary',
           sortable: true,
           
       },{
           field: 'allowance',
           title: 'Allowance',
           sortable: true,
       },{
           field: 'bonus',
           title: 'Bonus',
           sortable: true,
       },{
           field: 'tax',
           title: 'Tax',
           sortable: true,
       },{
           field: 'pf',
           title: 'Provident Fund',
           sortable: true,
       },{
           field: 'ts',
           title: 'Total Salary',
           sortable: true,
       }
       // ,{
       //     field: 'delete',
       //     title: 'Settings',
       //     sortable: false,
       // }
         ],
 
   });
 
</script>

		</div>
			</div>
		</div>	
		</div>
    </div><!-- content close -->

</div><!-- wrapper close -->

<?php
require_once 'footer.php';
?>
</body>
</html>