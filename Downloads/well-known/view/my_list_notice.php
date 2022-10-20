<?php
require_once 'header.php';
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		
		<?php 
        require_once 'sidenav.php';
        ?>

    <div id="content">						
    	<?php 
            require_once 'topnav.php';
        error_reporting(E_ALL);
ini_set('display_errors', 1);
        ?>


		<div class="h4_"><h3>My Notice</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">
			 	<div class="box">
			 	<span class="h4_"><h4>Notice Lists</h4></span>                        
				<table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'my_list_notice_table.php',
       search: true,
       showFooter: false,
       pagination: true,
       buttonsClass: 'primary',
       minimumCountColumns: 6,
       columns: [{
           field: 'num',
           title: 'S.N',
           sortable: true,
       },{
           field: 'ntype',
           title: 'Category',
           sortable: true,
           
       },{
           field: 'ntitle',
           title: 'Title',
           sortable: true,
           
       },{
           field: 'flname',
           title: 'Writer',
           sortable: true,
       },{
           field: 'ndate',
           title: 'Date',
           sortable: true,
           
       },{
           field: 'notice_to',
           title: 'Notice to',
           sortable: true,
       },{
           field: 'view',
           title: 'Settings',
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
	
</div><!-- wrapper close -->

<script>

</script>
<!--Start Veiw Notice Modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Notice Title</h2>
      </div>
    <div class="modal-body">
        <div class="mynotice-date-writer">
            <h6 class="float-left">Date: <span class="notice-date"></span></h6>
            <h6 class="float-right"><span class="notice-writer"></span></h6>
        </div>
        <div class="notice-body">Notice Message </div>
        
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         You have sucessfully agreed with the notice !
        </div>

      <div class="modal-footer">
        <form id="fupForm" name="form1" method="post">
            <input type="text" class="form-control" id="all_emp" value="" hidden>
            <input type="text" class="form-control" id="notice_id" value="" hidden>
            <input type="button" name="butt-agree" class="btn btn-outline-primary btn-sm butt-agree" id="butt-agree" value="I agree to this Notice">
        </form>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal" id="close-me">Close</button>
      </div>

      <script>
            // Close Button for adding data
        $(document).ready(function(){
          $("#close-me").click(function(){
            $("#butsave").removeAttr("disabled");
            $("#success").attr("style", "display:none;");
            $('#ntype').val('');
            $('#ntitle').val('');
            $('div.note-editable').html('');
            $('span.multiselect-selected-text').html('None selected');
            $('input[type=checkbox]').prop('checked', false);
            $("#butt-agree").attr("style", "display:inline;");
          });
        });
        </script>

    </div>

  </div>
</div>
</div>
<!-- End of Add Notice Modal -->


<?php
require_once 'footer.php';
?>
</body>
</html>