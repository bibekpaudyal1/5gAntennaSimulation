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
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm btn-salary-add" data-toggle="modal" data-target="#myModal">Add Salary</button><br>
		 	
				<table id="table" data-show-columns="true">
                    <div class="table-view"></div>
				</table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">
 
 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list_salary_table.php',
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
       },{
           field: 'delete',
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
				
<!-- Modal Add Salary -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-ml">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Add Salary</h2>      
      </div>
      <div class="modal-body">
        <form id="fupForm" name="form1" method="post">
        <div class="form-group" >
            <label for="flname">Full Name:</label>
            <select name="flname" id="flname" class="form-control">
                <option value=''>-- Select Employee --</option>
            <?php
                //include_once '../Controller/config.php';
                $sqllist = mysqli_query($con, "SELECT t1.emp_salary_id, t1.emp_code, t1.basic_salary, t1.tax, t1.pf, t1.allowance, t2.first_name, t2.last_name FROM wy_emp_salary t1 INNER JOIN wy_users t2 ON t1.emp_code = t2.emp_code ORDER BY t2.first_name;")or die(mysqli_error($con));
               
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

        <div class="form-group" >
            <label for="month">Month:</label>
            <select name="month" id="month" class="form-control">
                <option value=''>-- Select Month --</option>
                <option value='Janaury'>Janaury</option>
                <option value='February'>February</option>
                <option value='March'>March</option>
                <option value='April'>April</option>
                <option value='May'>May</option>
                <option value='June'>June</option>
                <option value='July'>July</option>
                <option value='August'>August</option>
                <option value='September'>September</option>
                <option value='October'>October</option>
                <option value='November'>November</option>
                <option value='December'>December</option>            
            </select>
        </div>        
        <div class="form-group">
            <label for="twork">Issued Working Hours:</label>
            <input type="text" class="form-control" id="twork" placeholder="Select Employee" name="twork" disabled>
        </div>
        <div class="form-group">
            <label for="cwork">Current Working Hours:</label>
            <input type="text" class="form-control" id="cwork" placeholder="Enter Current Working Hours" name="cwork" required>
        </div>
        <div class="form-group">
            <label for="bsalary">Basic Salary:</label>
            <input type="text" class="form-control" id="bsalary" placeholder="Select Employee" name="bsalary" disabled>
        </div>
        <div class="form-group">
            <label for="allowance">Allowance:</label>
            <input type="text" class="form-control" id="allowance" placeholder="Select Employee" name="allowance" disabled>
        </div>
        <div class="form-group">
            <label for="bonus">Bonus:</label>
            <input type="text" class="form-control" id="bonus" placeholder="Enter Bonus" name="bonus">
        </div>
        <div class="form-group">
            <label for="tax">Tax:</label>
            <input type="text" class="form-control" id="tax" placeholder="Select Employee" name="tax">
        </div>
        <div class="form-group">
            <label for="pf">Provident Fund:</label>
            <input type="text" class="form-control" id="pf" placeholder="Select Employee" name="pf" disabled>
        </div>
        <div class="form-group">
            <label for="ts">Total Salary:</label>
            <input type="text" class="form-control" id="ts" placeholder="Enter Bonus to calculate" name="ts" disabled>
        </div>
      </div>
      
      <!--Alert-->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

      <div class="modal-footer">
        <input type="button" name="save" class="btn btn-outline-primary btn-sm" value="Save" id="butsave">
        <button type="button" id="btn-salary-add-close" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>

  </div>
</div>

<!--For the salary pdf Started-->
    <div class="modal fade" id="pdfprint" tabindex="-1" role="dialog" aria-labelledby="pdfprintLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pdfprintLabel">Print Preview</h5>            
        </div>
        <div class="modal-body" id="pdf-body">
            <div>
                <div>
                    <span class="float-left" style="width: 350px;">
                        <img style="width:60%;" src="<?php echo system_url; ?>others/images/cmy-logo.png" class="img-fluid" alt="Responsive image">
                    </span>
                    <span class="float-right">
                        <h5 class="text-center font-weight-bold">
                            CRUPEE SOFTWARE DEVELOPMENT PVT. LTD. <br>	    
                            BHAKTA MARGA-4, BALUWATAR KATHMANDU
                        </h5>
                    </span>
                </div>
                <div class="float-left">
                    <br><br>
                    <h5>Employee name : Renu Thapa Magar</h5>				
                    <h5>Designationa : Receiptonist</h5>				
                    <h5>Month and Year : April, 2022</h5>	
                    <br>
                </div>			
            </div>
            <font size="3">
            <table class="table table-bordered" width="50%"> 
                <colgroup>
                    <col width="18%">
                        <col width="13%">
                            <col width="10%">
                                <col width="15%">
                                    <col width="10%">
                </colgroup>       
                <thead >
                <tr>
                    <th>Earnings</th>
                    <th>Working Hr</th>
                    <th>Rs.</th>
                    <th>Deduction</th>
                    <th>Rs.</th>
                </tr>	
                </thead>	
                <tbody>	
                    <tr> 
                        <td>&nbsp;Basic &amp; hr</td>                       
                        <td>&nbsp;184 hr</td>
                        <td>30,000</td>
                        <td>&nbsp;Provident fund</td>
                        <td>1,500&nbsp;</td>
                    </tr>                    
                    <tr>
                        <td>&nbsp;Leave with out pay</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Half leave</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Leave with pay</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Worked hr</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Food allowance</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;5,000</td>
                        <td>&nbsp;Loan</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;OT</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;T.D.S</td>
                        <td>&nbsp;370</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Fuel</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;2,000</td>
                        <td>Insurance</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Safety Manager</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Saving Manager</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;Total deduction</td>
                        <td>&nbsp;1,870</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Total Addition</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;37,000</td>
                        <td>&nbsp;<b>NET Salary</b></td>
                        <td>&nbsp;35,130</td>
                    </tr>
                <tbody>
            </table>
            </font>
        </div>
        <div id="editor"></div>
        <div class="modal-footer">
            <button type="button" id="cmd" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>            
        </div>
        </div>
    </div>
    </div>
    </div>
<!--For the salary pdf Ended-->

<!--For the salary form Started-->
<script>
$(document).ready(function() {
$('#butsave').on('click', function() {
//$("#butsave").attr("disabled", "disabled");
var flname = $('#flname').val();
var month = $('#month').val();
var twork = $('#twork').val();
var cwork = $('#cwork').val();
var bsalary = $('#bsalary').val();
var allowance = $('#allowance').val();
var bonus = $('#bonus').val();
var tax = $('#tax').val();
var pf = $('#pf').val();
var ts = $('#ts').val();
if(flname!="" && month!="" && bsalary!="" && allowance!="" && bonus!="" && tax!="" && pf!="" && ts!="" && twork!="" && cwork!=""){
    $.ajax({
        url: "list_salary_save.php",
        type: "POST",
        data: {
            flname: flname,
            month: month,
            twork: twork,
            cwork: cwork,
            bsalary: bsalary,
            allowance: allowance,
            bonus: bonus,
            tax: tax,
            pf: pf,
            ts: ts              
        },
        cache: false,
        success: function(dataResult){
            //var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
                $("#butsave").attr("disabled", "disabled");                
                $("#success").show();
                $('#success').html('Data added successfully !');                      
            }
            else if(dataResult.statusCode==201){
                alert("Duplicate entry, please try again.");
            }           
        }
    });
    }
    else{
        alert('Please fill all the fields !');
    }
});
});

//Delete
$("#table").on('click', '.delete', function(){
    var empId = $(this).attr("id");     
    var action = "empDelete";
    if(confirm("Are you sure you want to delete this salary?")) {
        $.ajax({
            url:"list_salary_save.php",
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

// Close Button for adding data
$(document).ready(function(){
    $("#btn-salary-add-close").click(function(){
        //window.location.reload(true);
         $table.bootstrapTable('refresh')  
        $("#butsave").removeAttr("disabled");
        $("#success").attr("style", "display:none;");
        $('#flname ').val(''); 
        $('#fupForm').find('input:text').val('');
    });
});

//On Change fill the form    
$('#flname').change(function(){
            //var empId = $(this).attr("flname");
            var getempId = $(this).find(':selected').attr('value');
            var opmodel =$.ajax({
            url:"list_salary_save.php",
            method:"POST",
            data:{getempId:getempId},
            cache: false,
            success:function(userData) {   
               // var userData=JSON.parse(data);  
                  //Will change with select option
                  $('#fupForm').find('input:text').val('');                      
                  $("input[name='bsalary']").val(userData.basic_salary);
                  $("input[name='allowance']").val(userData.allowance);
                  $("input[name='tax']").val(userData.tax);
                  $("input[name='pf']").val(userData.pf);
                  $("input[name='twork']").val(userData.twork);                  
            }
            })
        });

        //On Change bonous show total     
        $(document).ready(function(){
        $('#bonus').change(function(){
            alert("Total Salary will be calculated");
            var total = 0;                
            var a = parseInt($("input[name='bsalary']").val());
            var b = parseInt($("input[name='allowance']").val());
            var c = parseInt($("input[name='bonus']").val());
            var d = parseInt($("input[name='tax']").val());
            var e = parseInt($("input[name='pf']").val());
            

            //Earned Salary
            var f = parseInt($("input[name='twork']").val());
            var g = parseInt($("input[name='cwork']").val());
            var es = 0;
            es += g * (a/f);

            //Total Salary
            total +=  es+b+c-d-e;
            //Print Total 
            $("input[name='ts']").val(total);           
        });
        });

        //On Change cwork show total     
        $(document).ready(function(){
        $('#cwork').change(function(){
            alert("Total Salary will be calculated");
            var total = 0;                
            var a = parseInt($("input[name='bsalary']").val());
            var b = parseInt($("input[name='allowance']").val());
            var c = parseInt($("input[name='bonus']").val());
            var d = parseInt($("input[name='tax']").val());
            var e = parseInt($("input[name='pf']").val());
            

            //Earned Salary
            var f = parseInt($("input[name='twork']").val());
            var g = parseInt($("input[name='cwork']").val());
            var es = 0;
            es += g * (a/f);

            //Total Salary
            total +=  es+b+c-d-e;
            //Print Total 
            if (total<0){
            total = 0;
            }
            $("input[name='ts']").val(total);            
        });
        });

        $('#flname').change(function(){
            //var empId = $(this).attr("flname");
            var getempId = $(this).find(':selected').attr('value');
            var opmodel =$.ajax({
            url:"list_salary_save.php",
            method:"POST",
            data:{getempId:getempId},
            cache: false,
            success:function(userData) {   
               // var userData=JSON.parse(data);  
                  //Will change with select option
                  $('#fupForm').find('input:text').val('');                      
                  $("input[name='bsalary']").val(userData.basic_salary);
                  $("input[name='allowance']").val(userData.allowance);
                  $("input[name='tax']").val(userData.tax);
                  $("input[name='pf']").val(userData.pf);
                  $("input[name='twork']").val(userData.twork);                  
            }
            })
        });

//PDF maker
$('#cmd').click(function () {
    // var pdf = new jsPDF('p', 'pt', 'letter');
    // // source can be HTML-formatted string, or a reference
    // // to an actual DOM element from which the text will be scraped.
    // source = $('#pdf-body')[0];

    // // we support special element handlers. Register them with jQuery-style 
    // // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // // There is no support for any other type of selectors 
    // // (class, of compound) at this time.
    // specialElementHandlers = {
    //     // element with id of "bypass" - jQuery style selector
    //     '#bypassme': function (element, renderer) {
    //         // true = "handled elsewhere, bypass text extraction"
    //         return true
    //     }
    // };
    // margins = {
    //     top: 30,
    //     bottom: 60,
    //     left: 55,
    //     width: 522
    // };
    // // all coords and widths are in jsPDF instance's declared units
    // // 'inches' in this case
    // pdf.fromHTML(
    // source, // HTML string or DOM elem ref.
    // margins.left, // x coord
    // margins.top, { // y coord
    //     'width': margins.width, // max width of content on PDF
    //     'elementHandlers': specialElementHandlers
    // },

    // function (dispose) {
    //     // dispose: object with X, Y of the last line add to the PDF 
    //     //          this allow the insertion of new lines after html
    //     pdf.save('Test.pdf');
    // }, margins);
    $("#pdf-body").printThis();
});	      
</script>
<?php
require_once 'footer.php';
?>
</body>
</html>