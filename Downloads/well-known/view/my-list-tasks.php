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


		<div class="h4_"><h3>My Tasks</h3></div>
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
       url: 'my-list-tasks-table.php',
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
           sortable: false,
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
            <select id="reference" class="form-control">
                <option value=''>-- Select Project Name --</option>
            <?php
                $sqllist = mysqli_query($con, "SELECT DISTINCT(project_name) FROM wy_project ORDER BY project_name ASC;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['project_name'];                              
                 echo '<option value="' . $f . '">' . $f . '</option>';
                }
            ?>  
            </select>                
        </div>        
        <div class="form-group" >
            <label>Task:</label>
            <select id="title" class="form-control task-handover">
                <option value='Today'>Today</option>   
                <option value='Tomorrow'>Tomorrow</option> 
                <option value='Complete'>Complete</option>
                <option value='Routine'>Routine</option>
                <option value='Hand Over'>Hand Over</option>          
            </select>
        </div>
        <div class="form-group hand_over_to_dept" hidden>
            <label>Hand Over Department:</label>
            <select id="hand_over_to_dept" class="form-control">
                <option value=''>-- Select Department --</option>
            <?php
                $sqllist = mysqli_query($con, "SELECT DISTINCT(department) FROM wy_users ORDER BY department DESC;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['department'];                              
                 echo '<option value="' . $f . '">' . $f . '</option>';
                }
            ?>  
            </select>
        </div>          
        <div class="form-group hand_over_to" hidden>
            <label>Hand Over To:</label>
            <select id="hand_over_to" class="form-control"></select>
        </div>        
        <div class="form-group">
            <label>Task Name:</label>
            <input type="text" class="form-control" id="title_desc" placeholder="Enter Task Name">
        </div>   
        <div class="form-group">
            <label>Phase:</label>
            <select id="phase" class="form-control">
                <option value=''>-- Select Phase --</option>
            <?php
                $sqllist = mysqli_query($con, "SELECT DISTINCT(phase_name) FROM wy_phases ORDER BY phase_name ASC;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['phase_name'];                              
                 echo '<option value="' . $f . '">' . $f . '</option>';
                }
            ?>  
            </select>  
        </div>
        <div class="form-group">
            <label>Progress:</label>
            <input type="number" class="form-control" id="progress" placeholder="Enter Progress in percentage %">
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

<!--Start Veiw Comment Modal-->
<div id="mycommentmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Task Title</h2>
      </div>
    <div class="modal-body">
        <div class="mynotice-date-writer">
            <h6 class="float-left">Date: <span class="notice-date"></span></h6>
            <h6 class="float-right"><span class="notice-writer"></span></h6>
        </div>
        <div class="notice-body">Comment Message </div>
        
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success-t-c-i" style="display:none;">
         You have sucessfully agreed the comment !
        </div>

      <div class="modal-footer">
        <form id="fupForm-c-i" name="form1" method="post">
            <input type="text" class="form-control" id="task_id" value="" hidden>
            <input type="button" name="butt-agree" class="btn btn-outline-primary btn-sm butt-agree comment-agree" id="comment-agree" value="I agree to this Comment">
            <button id="c-i-c" type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>

  </div>
</div>
</div>
<!-- End of View Comment Modal -->

<!--Start Veiw Task Modal-->
<div id="mytaskmodalview" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="task-title">Task Title</h2>
      </div>
    <div class="modal-body">
        <div class="mynotice-date-writer">
            <h6 class="float-left">Date: <span class="notice-date"></span></h6>
            <h6 class="float-right"><span class="task_writer">Task Writer</span></h6>
        </div>
        <div class="">
            <p class="notice-body float-left">Comment Message </p>
            <p class="float-right"><span class="comment_writer">Comment Writer</span></p>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal" id="close-me">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End of View Task Modal -->
<?php
require_once 'footer.php';
?>
</body>
</html>