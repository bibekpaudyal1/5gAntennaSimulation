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
        ?>
		<div class="h4_"><h3>Notice</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">
			 	<div class="box">
			 	<span class="h4_"><h4>Notice Lists</h4></span>
                <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm btn-notice-add" data-toggle="modal" data-target="#myModal">Add Notice</button>
				<table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list_notice_table.php',
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
           field: 'ndesc',
           title: 'Message',
           sortable: true,
       },{
           field: 'notice_to',
           title: 'Notice to',
           sortable: true,
       },{
           field: 'delete',
           title: 'Setting',
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

<!--Start Add Notice Modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Add Notice</h2>     
      </div>
    <div class="modal-body">
    <form id="fupForm" name="form1" method="post">
        <div class="form-group">
            <label for="addtwork">Notice Title:</label>
            <input type="text" class="form-control" id="ntitle" placeholder="Enter Notice Title">
        </div>      
        <div class="form-group" >
            <label>Notice Category:</label>
            <select id="ntype" class="form-control">
                <option value=''>-- Select Notice Category --</option>
                <option value='Event'>Notice</option>   
                <option value='Safety'>Safety Notice</option> 
                <option value='Saving'>Saving Notice</option>   
                <option value='Saving'>Press Conference</option>          
            </select>
        </div>
        <div class="form-group" >
            <label for="notic">Notify Person:</label>
            <select id="notice-to" class="form-control" multiple="multiple">
            <?php
                //include_once '../controller/config.php';
                $sqllist = mysqli_query($con, "SELECT * from wy_users ORDER BY first_name;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['first_name'];
                    $l = $rowList['last_name'];
                    $ecode = $rowList['emp_code'];
                    $fl = $f . ' ' . $l;                 
                    $ecode = $rowList['emp_code'];                
                 // echo '<option value="' . $ecode . '">' . $fl . '</option>';
                 echo '<option value="' . $fl . '">' . $fl . '</option>';
                }
            ?>    
            </select>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea class="form-control" id="summernote" placeholder="Enter Notice Description" name="editordata"></textarea>
        </div>
        <div class="form-group">
            <!-- Hidden input fields for publisher --> 
            <input type="text" class="form-control" id="nuser" value="<?php echo $_SESSION['user']; ?>" hidden>
        </div>        
        
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary btn-sm" value="Save" id="butsave">
        <button id="close-me" type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

      <script>
            // Close Button for adding data
        $(document).ready(function(){
          $("#close-me").click(function(){
            $table.bootstrapTable('refresh')  
            $("#butsave").removeAttr("disabled");
            $("#success").attr("style", "display:none;");
            $('#ntype').val('');
            $('#ntitle').val('');
            $('div.note-editable').html('');
            $('span.multiselect-selected-text').html('None selected');
            $('input[type=checkbox]').prop('checked', false);
          });
        });
        </script>

      </form>
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