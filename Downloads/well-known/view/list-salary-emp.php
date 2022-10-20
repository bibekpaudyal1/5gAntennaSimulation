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
                        <span class="h4_"><h4>Employee Lists</h4></span>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm btn-add" data-toggle="modal" data-target="#myModal">Add Employee</button>
			 	
				<table class="no-border-collapse" id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list-salary-emp-table.php',
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
           field: 'ecode',
           title: 'E ID',
           sortable: true,
           
       },{
           field: 'flname',
           title: 'Full Name',
           sortable: true,
           
       },{
           field: 'twork',
           title: 'Issued Working Hours',
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
           field: 'tax',
           title: 'Tax',
           sortable: true,
       },{
           field: 'pf',
           title: 'Provident Fund',
           sortable: true,
       },{
           field: 'update',
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
		
<!--Start Add Employee Modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Add Employee</h2>     
      </div>
    <div class="modal-body">
    <form id="fupForm" name="form1" method="post">
        <div class="form-group" >
            <label for="flname">Full Name:</label>
            <select name="flname" id="flname" class="form-control">
                <option value=''>-- Select Employee --</option>
            <?php
                //include_once '../Controller/config.php';
                $sqllist = mysqli_query($con, "SELECT * from wy_users ORDER BY emp_code DESC;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['first_name'];
                    $l = $rowList['last_name'];
                    $ecode = $rowList['emp_code'];
                    $fl = $f . ' ' . $l;                 
                 $ecode = $rowList['emp_code'];                
                 echo '<option value="' . $ecode . '">' . $fl . '</option>';
                }
            ?>                
               
            </select>
        </div>
        <div class="form-group">
            <label for="addtwork">Issued Working Hours:</label>
            <input type="text" class="form-control" id="addtwork" placeholder="Enter Issued Working Hours" name="addtwork">
        </div>         
        <div class="form-group">
            <label for="bsalary">Basic Salary:</label>
            <input type="text" class="form-control" id="bsalary" placeholder="Enter Basic Salary" name="bsalary">
        </div>
        <div class="form-group">
            <label for="allowance">Allowance:</label>
            <input type="text" class="form-control" id="allowance" placeholder="Enter Allowance" name="allowance">
        </div>        
        <div class="form-group">
            <label for="tax">Tax:</label>
            <input type="text" class="form-control" id="tax" placeholder="Enter Tax" name="tax">
        </div>
        <div class="form-group">
            <label for="pf">Provident Fund:</label>
            <input type="text" class="form-control" id="pf" placeholder="Enter Provident Fund" name="pf">
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
            //window.location.reload(true);
            $table.bootstrapTable('refresh')  
            $("#butsave").removeAttr("disabled");
            $("#success").attr("style", "display:none;");
            $('#flname ').val('');
            $('#fupForm').find('input:text').val(''); 
          });
        });
        </script>

      </form>
    </div>

  </div>
</div>
</div>
<!-- End of Add Employee Modal -->

<!--Start Update Employee Modal-->
<div id="edit-employee-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">     
        <h2 class="modal-title">Update Employee</h2>
      </div>
    <div class="modal-body">
    <form id="ffupForm" name="form1" method="post">
        <div class="form-group" >
            <label for="flname">Full Name:</label>
           <!--  For the uid -->
            <input type="text" id="uid" name="uid" hidden>
            <select name="uflname" id="uflname" class="form-control uflname" disabled>
                <option value=''>Select</option>
            <?php
                //include_once '../Controller/config.php';
                $sqllist = mysqli_query($con, "SELECT * from wy_employees ORDER BY emp_code DESC;")or die(mysqli_error($con));
               
                 while ($rowList = mysqli_fetch_array($sqllist)) {
                    $f = $rowList['first_name'];
                    $l = $rowList['last_name'];
                    $ecode = $rowList['emp_code'];
                    $fl = $f . ' ' . $l;                 
                 $ecode = $rowList['emp_code'];                
                 echo '<option value="' . $ecode . '">' . $fl . '</option>';
                }
            ?>                
               
            </select>         
        </div>
        <div class="form-group">
            <label for="twork">Issued Working Hours:</label>
            <input type="text" class="form-control" id="twork" placeholder="Enter Issued Working Hours" name="twork">
        </div>        
        <div class="form-group">
            <label for="bsalary">Basic Salary:</label>
            <input type="text" class="form-control" id="ubsalary" placeholder="Enter Basic Salary" name="ubsalary">
        </div>
        <div class="form-group">
            <label for="allowance">Allowance:</label>
            <input type="text" class="form-control" id="uallowance" placeholder="Enter Allowance" name="uallowance" value="1" >
        </div>        
        <div class="form-group">
            <label for="tax">Tax:</label>
            <input type="text" class="form-control" id="utax" placeholder="Enter Tax" name="utax" value="1">
        </div>
        <div class="form-group">
            <label for="pf">Provident Fund:</label>
            <input type="text" class="form-control" id="upf" placeholder="Enter Provident Fund" name="upf" value="1">
        </div>   

      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="usuccess" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <script>
            // Close Button for update data
        $(document).ready(function(){
          $("#close-me-update").click(function(){
            //window.location.reload(true);  
            $table.bootstrapTable('refresh')
            $("#butupdate").removeAttr("disabled");
            $("#usuccess").attr("style", "display:none;");
            $('#ffupForm').find('input:text').val('');            
          });
        });
        </script>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary" value="Update" id="butupdate">
        <button id="close-me-update" type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>

  </div>
</div>
        
</div>
<!-- End of Update Employee Modal -->

<!--For the Add Salary Form-->
<script>
$(document).ready(function() {
$('#butsave').on('click', function() {
$("#butsave").attr("disabled", "disabled");
var flname = $('#flname').val();
var bsalary = $('#bsalary').val();
var allowance = $('#allowance').val();
var tax = $('#tax').val();
var pf = $('#pf').val();
var addtwork = $('#addtwork').val();
if(flname!="" && bsalary!="" && allowance!="" && tax!="" && pf!="" && addtwork!=""){
    $.ajax({
        url: "list-salary-emp-save.php",
        type: "POST",
        data: {
            flname: flname,
            bsalary: bsalary,
            allowance: allowance,
            tax: tax,
            pf: pf,
            addtwork: addtwork             
        },
        cache: false,
        success: function(dataResult){                            
            //var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                
                //$("#butsave").removeAttr("disabled");                
                $("#success").show();
                $('#success').html('Data added successfully !');   
            }
            else if(dataResult.statusCode==201){
                alert("Error occured, add unique employee ! ");
                $("#butsave").removeAttr("disabled");
            }
            
        }
    });
    }
    else{
        alert('Please fill all the field !');
        $("#butsave").removeAttr("disabled");
    }
});
});

//Delete
$("#table").on('click', '.delete', function(){
    var empId = $(this).attr("id");     
    var action = "empDelete";
    if(confirm("Are you sure you want to delete this employee?")) {
        $.ajax({
            url:"list-salary-emp-save.php",
            method:"POST",
            data:{empId:empId, action:action},
            success:function(data) {                    
                //location.reload(true);      
                $table.bootstrapTable('refresh')                       
            }
        })
    } else {
        return false;
    }
}); 

//Update Model Open
$(document).ready(function(){
  $('#table').on('click', '.update', function() {
    var uempId = $(this).attr("id");
    var opmodel =$.ajax({
            url:"list-salary-emp-save.php",
            method:"POST",
            data:{uempId:uempId},
            cache: false,
            success:function(userData) {   
               // var userData=JSON.parse(data);  
                  $("input[name='uid']").val(userData.emp_salary_id);
                  //Will change with checkbox state
                  $(`.uflname option[value=${userData.emp_code}]`).prop('selected', true);                  
                  $("input[name='ubsalary']").val(userData.basic_salary);
                  $("input[name='uallowance']").val(userData.allowance);
                  $("input[name='utax']").val(userData.tax);
                  $("input[name='upf']").val(userData.pf);
                  $("input[name='twork']").val(userData.twork);

                $("#edit-employee-modal").modal();

            }
        })
    
  });
});

//Update
$(document).ready(function() {
$('#butupdate').on('click', function() {
//$("#butsave").attr("disabled", "disabled");

var uid = $('#uid').val();
var uflname = $('#uflname').val();
var ubsalary = $('#ubsalary').val();
var uallowance = $('#uallowance').val();
var utax = $('#utax').val();
var upf = $('#upf').val();
var twork = $('#twork').val();
if(uflname!="" && ubsalary!="" && uallowance!="" && utax!="" && upf!="" && twork!=""){
    $.ajax({
        url: "list-salary-emp-save.php",
        type: "POST",
        data: {
            uid: uid,
            uflname: uflname,
            ubsalary: ubsalary,
            uallowance: uallowance,
            utax: utax,
            upf: upf,
            twork: twork             
        },
        cache: false,
        success: function(dataResult){                            
            //var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==2000){                
                $("#butupdate").attr("disabled", "disabled");                
                $("#usuccess").show();
                $('#usuccess').html('Data updated successfully !');   
            }
            else if(dataResult.statusCode==2001){
                alert("Error occured ! ");
                $("#butupdate").removeAttr("disabled");
            }
            
        }
    });
    }
    else{
        alert('Please fill all the field !');
        $("#butupdate").removeAttr("disabled");
    }
});
});

// Modal click outside disabled for update data
$(document).ready(function(){
    $(".update").click(function(){
        $("#edit-employee-modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});

// Modal click outside disabled for Adding data
$(document).ready(function(){
    $(".btn-add").click(function(){
        $("#myModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
</script>
<?php
require_once 'footer.php';
?>
</body>
</html>