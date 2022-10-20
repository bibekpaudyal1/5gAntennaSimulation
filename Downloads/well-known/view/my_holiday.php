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
		<div class="h4_"><h3>My Holiday</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">
			 	<div class="box">
			 	<span class="h4_"><h4>Holiday Lists</h4></span>
                <table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list_holiday_table.php',
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
           field: 'hdate',
           title: 'Date',
           sortable: true,
           
       },{
           field: 'namedate',
           title: 'Day',
           sortable: true,
       },{
           field: 'htitle',
           title: 'Title',
           sortable: true,
       },{
           field: 'hdesc',
           title: 'Description',
           sortable: true,
       },{
           field: 'sstatus',
           title: 'Special Status',
           sortable: true,
       }
         ],
 
   });
 
</script>
		</div>
			</div>
		</div>	
		</div>
</div><!-- content close -->
	<?php
    require_once 'footer.php';
    ?>	
	</div><!-- wrapper close -->

</body>
</html>