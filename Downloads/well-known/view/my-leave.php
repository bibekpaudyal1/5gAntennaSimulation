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

        <div class="h4_"><h3>My Leave</h3></div>
        <div class="bg_">
            <div class="row">           
             <div class="col-md-12">
                <div class="box">
                <span class="h4_"><h4>Leave List</h4></span>
                    <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm btn-leave-add" data-toggle="modal" data-target="#myModal">Apply Leave</button>
                <table id="table" data-show-columns="true">
                    <div class="table-view"></div>
                </table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">

 var $table = $('#table');
      $table.bootstrapTable({
       url: 'my-leave-table.php',
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
           field: 'ltype',
           title: 'Leave Type',
           sortable: true,
       },{
           field: 'ldate',
           title: 'Apply Date',
           sortable: true,
       },{
           field: 'lmsg',
           title: 'Message',
           sortable: true,
       },{
           field: 'lstatus',
           title: 'Status',
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
        <h2 class="modal-title">Add Leave</h2>     
      </div>
    <div class="modal-body">
    <form id="fupForm" name="form1" method="post">
        <div class="form-group" >
            <label>Leave Type:</label>
            <select id="l_type" class="form-control">
                <?php
                $sqllist = mysqli_query($con, "SELECT DISTINCT(leave_type_name) FROM wy_leave_type ORDER BY leave_type_name ASC;")or die(mysqli_error($con));
                 while ($rowList = mysqli_fetch_array($sqllist)) {
               
                    $f = $rowList['leave_type_name'];                              
                 echo '<option value="' . $f . '">' . $f . '</option>';
                }
            ?>          
            </select>
        </div>
        <div class="form-group">
            <label for="addtwork">Leave Dates (MM/DD/YYYY):</label>
            <input type="text" class="form-control date" id="l_date" placeholder="Select Dates">            
        </div>
        <div class="form-group">
            <label>Leave Message:</label>
            <textarea class="form-control" id="l_msg" placeholder="Enter Leave Description"></textarea>
        </div>
             
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary btn-sm" value="Apply for Leave" id="butsave_leave">
        <button id="close_me_leave" type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
</div>
<!-- End of Add Notice Modal -->    
<?php require_once 'footer.php';?> 
</body>
</html>