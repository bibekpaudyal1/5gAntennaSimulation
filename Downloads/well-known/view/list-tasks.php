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


		<div class="h4_"><h3>Tasks</h3></div>
		<div class="bg_">
			<div class="row">			
			 <div class="col-md-12">
			 	<div class="box">
			 	<span class="h4_"><h4>Task Lists</h4></span>
                <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm btn-notice-add" data-toggle="modal" data-target="#myModal">Add Task</button>                            
				<table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list-tasks-table.php',
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
           field: 'department',
           title: 'Department',
           sortable: true,
       },{
           field: 'flname',
           title: 'Name',
           sortable: true,
       },{
           field: 'task_title',
           title: 'Task',
           sortable: true,
           
       },{
           field: 'date',
           title: 'Date',
           sortable: true,
           
       },{
           field: 'ref_needed',
           title: 'Project Name',
           sortable: true,
       },{
           field: 'title_desc',
           title: 'Task Name',
           sortable: true,
           
       },{
           field: 'task_phase',
           title: 'Phase',
           sortable: true,
           
       },{
           field: 'task_progress',
           title: 'Progress',
           sortable: true,
       },{
           field: 'issue_recorded',
           title: 'Issue',
           sortable: true,
       },{
           field: 'task_status',
           title: 'Status',
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

<!--Start Add Task Modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Add Task</h2>     
      </div>
    <div class="modal-body">
    <form id="fupForm" name="form1" method="post">
        <div class="form-group">
            <label>Project Name:</label>
            <input type="text" class="form-control" id="reference" placeholder="Enter Project Name">
        </div>        
        <div class="form-group" >
            <label>Task:</label>
            <select id="title" class="form-control">
                <option value='Today'>Today</option>   
                <option value='Tomorrow'>Tomorrow</option> 
                <option value='Complete'>Complete</option>
                <option value='Routine'>Routine</option>
                <option value='Hand Over'>Hand Over</option>          
            </select>
        </div>

        <div class="form-group">
            <label>Task Description:</label>
            <input type="text" class="form-control" id="title_desc" placeholder="Enter Task Description">
        </div>   
        <div class="form-group">
            <label>Phase:</label>
            <input type="text" class="form-control" id="phase" placeholder="Enter Phase">
        </div>
        <div class="form-group">
            <label>Progress:</label>
            <input type="text" class="form-control" id="progress" placeholder="Enter Progress">
        </div>
        <div class="form-group" >
            <label>Status:</label>
            <select id="status" class="form-control">
                <option value='Pending'>Pending</option>   
                <option value='In Progress'>In Progress</option> 
                <option value='Complete'>Complete</option>         
            </select>
        </div>
        <div class="form-group" >
            <label>Issue:</label>
            <select id="issue" class="form-control">
                <option value='No'>No</option>   
                <option value='Yes'>Yes</option>         
            </select>
        </div>
        <div class="form-group">
            <!-- Hidden input fields for writer --> 
            <input type="text" class="form-control" id="writer" value="<?php echo $_SESSION['user']; ?>" hidden>
        </div>        
        
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary btn-sm" value="Save" id="task-butsave">
        <button id="task-close-me" type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>

  </div>
</div>
</div>
<!-- End of Add Task Modal -->

<!--Start Add Task Modal-->
<div id="task_comment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Add Comment</h2>     
      </div>
    <div class="modal-body">
    <form id="fupForm2" name="form2" method="post">
        <div class="form-group">
            <label>Comment:</label>
            <textarea class="form-control" id="t-comm" rows="3"></textarea>
            <input type="text" id="comm-id" hidden>
        </div> 
       
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success-t-c" style="display:none;">
        </div>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary btn-sm" value="Save" id="t-c-btn-s">
        <button id="task-comclose" type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>

  </div>
</div>
</div>
<!-- End of Add Comment in Task Modal -->
<?php
require_once 'footer.php';
?>
</body>
</html>