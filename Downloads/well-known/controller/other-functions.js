//Leave Actions Approve
  $("#table").on('click', '.leave-approve', function(){  
      var select_id = $(this).attr("id");
      if(confirm("Are you sure you want to approve this leave?")) {
          $.ajax({
              url:"../controller/config.php",
              method:"POST",
              data:{approve_id:select_id},
              success:function(data) {                    
                  //location.reload(true);      
                  $table.bootstrapTable('refresh')                       
              }
          })
      } else {
          return false;
      }
  });

//Leave Actions Reject
  $("#table").on('click', '.leave-reject', function(){  
      var select_id = $(this).attr("id");
      if(confirm("Are you sure you want to reject this leave?")) {
          $.ajax({
              url:"../controller/config.php",
              method:"POST",
              data:{reject_id:select_id},
              success:function(data) {                    
                  //location.reload(true);      
                  $table.bootstrapTable('refresh')                       
              }
          })
      } else {
          return false;
      }
  });

// For Notice adding 
//1st Disabeling the outside click on the popup modal form
$(document).ready(function(){
    $(".btn-notice-add").click(function(){
        $("#myModal").modal({ backdrop: 'static', keyboard: false });
    });
});
//Now Adding the Notice 
$(document).ready(function() {
$('#butsave').on('click', function() {
$("#butsave").attr("disabled", "disabled");
var ndate = $('#ndate').val();
var ntitle = $('#ntitle').val();
var ntype = $('#ntype').val();
var ndes = $('#summernote').val();
var nuser = $('#nuser').val();
var notice_too = $('#notice-to').val();
notice_to = notice_too.toString();
if(ndate!="" && ntitle!="" && ntype!="" && ndes!="" && nuser!="" && notice_to!=""){
    $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            ndate: ndate,
            ntitle: ntitle,
            ntype: ntype,
            ndes: ndes,
            nuser: nuser,
            notice_to: notice_to             
        },
        cache: false,
        success: function(dataResult){                          
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                
                //$("#butsave").removeAttr("disabled");                
                $("#success").show();
                $('#success').html('Data added successfully !'); 
            }
            else if(dataResult.statusCode==201){
                alert("Error occured, add unique notice ! ");
                $("#butsave").removeAttr("disabled");
            }           
          }
    });
    }
    else{
        alert('Please fill all the fields !');
        $("#butsave").removeAttr("disabled");
    }
});
});

//Notice Delete
$("#table").on('click', '.notice-delete', function(){
    var nid = $(this).attr("id");
    if(confirm("Are you sure you want to delete this notice?")) {
        $.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{nid:nid},
            success:function(data) {   
                $table.bootstrapTable('refresh')                       
            }
        })
    } else {
        return false;
    }
}); 

//Notice Textarea Editior Render
$(document).ready(function() {
  $('#summernote').summernote(
    {
      tabsize: 6,
      height: 300
    });
});

//Bootstrap Multiple select checkbox in the form in Notice 
$(document).ready(function() {
  $('#notice-to').multiselect({
    includeSelectAllOption: true,
  });
});

//View Notice Model and Status for the (I agree to the notice button)
$(document).ready(function(){
  $('#table').on('click', '.notice-status', function() {
    var viewid = $(this).attr("id");
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{viewid:viewid},
            cache: false,
            dataType: "json",
            success:function(userData) {   
               // var userData=JSON.parse(data);
               var SView=(userData.statusCode);
               var valG=1;
               
               if(SView==valG)
               {
                $("#butt-agree").hide();
               }

              $('span.notice-date').text(userData.notice_date);  
              $('h2.modal-title').text(userData.notice_title);
              $('div.notice-body').html(userData.notice_desc);
              $('span.notice-writer').text(userData.notice_writer);
              //$('button').attr("id", userData.notice_id);
              $("input[id='notice_id']").val(userData.notice_id);
              $("input[id='all_emp']").val(userData.notice_status);
              $("#myModal").modal({ backdrop: 'static', keyboard: false });
              $("#myModal").modal();
            }
        })
    
  });
});

//View Notice Click, I agree to the notice button
$(document).ready(function(){
  //$('#modal-footer').on('click', '.butt-agree', function() {
  $('.butt-agree').on('click', function() {      
    var aggree_notice_id = $('#notice_id').val();
    var all_emp = $('#all_emp').val();
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{aggree_notice_id:aggree_notice_id,all_emp:all_emp},
            cache: false,
            dataType: "json",
            success:function(userData) { 
              $("#success").attr("style", "display:block;");
              $("#butt-agree").attr("style", "display:none;");
              $('#all_emp').val('');
              $('#notice_id').val('');
              $table.bootstrapTable('refresh');
            }
        })
    
  });
});

//Click to active menu
$(document).ready(function () {
        var url = window.location;
    // Will only work if string in href matches with location
        $('ul.side-nav a[href="' + url + '"]').parent().addClass('active');
        
    // Will also work for relative and absolute hrefs
        $('ul.side-nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active show');
    //show sub-menu space
        $('ul.side-nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().addClass('show');      
    });

// Loading Please Wait
$(window).on('load', function(){
    $('#cover').fadeOut(1000);
})

//Task Delete
$("#table").on('click', '.task-delete', function(){
    var taskid = $(this).attr("id");
    if(confirm("Are you sure you want to delete this task?")) {
        $.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{taskid:taskid},
            success:function(data) {   
                $table.bootstrapTable('refresh')                       
            }
        })
    } else {
        return false;
    }
}); 

//Now Adding the Task 
$(document).ready(function() {
$('#task-butsave').on('click', function() {
$("#task-butsave").attr("disabled", "disabled");
var task_title = $('#title').val();
var title_desc = $('#title_desc').val();
var phase = $('#phase').val();
var writer = $('#writer').val();
var status = $('#status').val();
var progress = $('#progress').val() + '%';
var reference = $('#reference').val();
var issue = $('#issue').val();
var issue_des = $('#issue_des').val();
if(task_title!="" && phase!="" && writer!="" && status!="" && progress!="" && reference!="" && issue!="" && title_desc!=""){
    $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            task_title: task_title,
            phase: phase,
            writer: writer,
            status: status,
            progress: progress,
            reference: reference,
            issue: issue,
            title_desc: title_desc            
        },
        cache: false,
        success: function(dataResult){                          
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                
                //$("#butsave").removeAttr("disabled");                
                $("#success").show();
                $('#success').html('Data added successfully !'); 
            }
            else if(dataResult.statusCode==201){
                alert("Error occured, add unique task ! ");
                $("#butsave").removeAttr("disabled");
            }           
          }
    });
    }
    else{
        alert('Please fill all the fields !');
        $("#butsave").removeAttr("disabled");
    }
});
});

// Task Close Button for adding data and clearing data
        $(document).ready(function(){
          $("#task-close-me").click(function(){
            $table.bootstrapTable('refresh')  
            $("#task-butsave").removeAttr("disabled");
            $("#success").attr("style", "display:none;");
            $('#fupForm')[0].reset();
          });
        });

//For the Task hand over Department and then Person
$(".task-handover").change(function(){ // change function of listbox
    if($('.task-handover').val()=='Hand Over'){
    //$("#b1").prop('disabled',false); 
       $(".hand_over_to_dept").removeAttr("hidden");
    }
    else
    {
      $(".hand_over_to_dept").attr("hidden", "");
      $(".hand_over_to").attr("hidden", "");
      $("#hand_over_to").empty();
    }
});

$("#hand_over_to_dept").change(function(){
       $(".hand_over_to").removeAttr("hidden");
       $("#hand_over_to").empty();

       var dept_name = $('#hand_over_to_dept').val();
       $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            dept_name: dept_name
        },
        cache: false,
        success: function(name){                          
            //var selectValues = name;
            var selectValues = JSON.parse(name);
            //alert(name);
            //console.info(name);
            //alert(dataResult.name);
            //$("#dept_name").attr("value", dataResult.statusCode); 
            $("input[id='try']").val(selectValues);
            
            //$(new Option(selectValues, 'val')).appendTo('#hand_over_to');
            var options = $('#hand_over_to').get(0).options;
            $.each(selectValues, function(key, value) {
                    options[options.length] = new Option(value, value);
            });

          }
    });
});

//View Comment Model and Status for the (I agree to the comment button)
$(document).ready(function(){
  $('#table').on('click', '.task-comment', function() {
    var mytaskcommentid = $(this).attr("id");
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{mytaskcommentid:mytaskcommentid},
            cache: false,
            dataType: "json",
            success:function(userData) {   
               // var userData=JSON.parse(data);
               var SView=(userData.comment_status);
               var valG=1;
               
               if(SView==valG)
               {
                $("#butt-agree").hide();
               }

              $('span.notice-date').text(userData.date);  
              $('h2.modal-title').text(userData.title_desc);
              $('div.notice-body').html(userData.task_comment);
              $('span.notice-writer').text(userData.comment_admin);
              $("input[id='task_id']").val(userData.task_id);
              $("#mycommentmodal").modal({ backdrop: 'static', keyboard: false });
              $("#mycommentmodal").modal();
            }
        })
    
  });
});

//I agree to the comment button
$(document).ready(function(){
  $('.comment-agree').on('click', function() {      
    var aggree_task_id = $('#task_id').val();    
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{aggree_task_id:aggree_task_id},
            cache: false,
            dataType: "json",
            success:function(userData) { 
              $("#success_comment").attr("style", "display:block;");              
              $("#comment-agree").attr("style", "display:none;");
              $('#task_id').val('');
              $table.bootstrapTable('refresh');
            }
        })
    
  });
});

//View Task Model and hand Over Person if any
$(document).ready(function(){
  $('#table').on('click', '.view-task', function() {
    var mytaskviewid = $(this).attr("id");
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{mytaskviewid:mytaskviewid},
            cache: false,
            dataType: "json",
            success:function(userData) {

              $('span.notice-date').text(userData.date);  
              $('h2.task-title').text(userData.title_desc);
              $('div.notice-body').html(userData.task_comment);
              $('span.task_writer').text(userData.task_writer);
              $("input[id='task_id']").val(userData.task_id);
              $("#mytaskmodalview").modal({ backdrop: 'static', keyboard: false });
              $("#mytaskmodalview").modal();
            }
        })
    
  });
});

//If Clicked My Profile Navigation Menu
$(document).ready(function(){
  var url = window.location;
  if(url=="https://office.crupeesoft.com/view/profile.php") {
    var get_my_profile = 1;    
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{get_my_profile:get_my_profile},
            cache: false,
            dataType: "json",
            success:function(userData) { 
              $("input[name='1']").val(userData.first_name);
              $("input[name='2']").val(userData.last_name);
              $("input[name='3']").val(userData.dob);
              //$("input[name='2']").val(userData.gender);
              $("input[name='4']").val(userData.address);
              $("input[name='5']").val(userData.city);
              $("input[name='6']").val(userData.state);
              $("input[name='7']").val(userData.country);
              $("input[name='8']").val(userData.merital_status);
              $("input[name='9']").val(userData.nationality);
              $("input[name='10']").val(userData.email);
              $("input[name='11']").val(userData.mobile);
              $("input[name='12']").val(userData.telephone);
              $("#13").val(userData.identity_doc);
              $("#34").val(userData.gender);
              $("#15").val(userData.emp_type);
              $("input[name='14']").val(userData.identity_no);
              $("input[name='16']").val(userData.joining_date);
              $("input[name='17']").val(userData.blood_group);
              $("input[name='18']").val(userData.designation);
              $("input[name='19']").val(userData.department);
              $("input[name='20']").val(userData.pan_no);
              $("input[name='21']").val(userData.bank_name);
              $("input[name='22']").val(userData.account_no);
              $("input[name='24']").val(userData.pf_account);
            }
        })
    
  };
});

//If Clicked My Job Description Navigation Menu
$(document).ready(function(){
  var url = window.location;
  if(url=="https://office.crupeesoft.com/view/view-job.php") {
    var get_my_profile = 1;    
    var opmodel =$.ajax({
            url:"../controller/config.php",
            method:"POST",
            data:{get_my_profile:get_my_profile},
            cache: false,
            dataType: "json",
            success:function(userData) {
              $('div.emp-desc').html(userData.job_desc);
              $('h4.designation').html(userData.designation);
            }
        })
    
  };
});

//Punch In
$('#btn-punch-in').on('click', function() {  
      var punch_in_remark = $('#punch-in-re').val();
      var punch_in_action = 1;
      if(confirm("Are you sure you want to Punch In?")) {
          $.ajax({
              url:"../controller/config.php",
              method:"POST",
              data:{punch_in_remark:punch_in_remark, punch_in_action:punch_in_action},
              success:function(data) {
                  // $table.bootstrapTable('refresh');
                  // $('#punch-in-re').val('');
                  location.reload(true);                      
              }
          })
      } else {
          return false;
      }
});

//Punch Out
$('#btn-punch-out').on('click', function() {  
      var punch_out_remark = $('#punch-out-re').val();
      var punch_out_action = 1;
      if(confirm("Are you sure you want to Punch Out?")) {
          $.ajax({
              url:"../controller/config.php",
              method:"POST",
              data:{punch_out_remark:punch_out_remark, punch_out_action:punch_out_action},
              success:function(data) {
                  // $table.bootstrapTable('refresh');
                  // $('#punch-out-re').val('');
                  location.reload(true);                      
              }
          })
      } else {
          return false;
      }
});

//Apply Leave Disabeling the outside click on the popup modal form
$(document).ready(function(){
    $(".btn-leave-add").click(function(){
        $("#myModal").modal({ backdrop: 'static', keyboard: false });
    });
});

//Leave Apply Select Multi Date 
$('.date').datepicker({
  multidate: true,
  format: 'dd-mm-yyyy'
});

//Adding My Leaves 
$(document).ready(function() {
$('#butsave_leave').on('click', function() {
$("#butsave_leave").attr("disabled", "disabled");
var l_type = $('#l_type').val();
var l_date = $('#l_date').val();
var l_msg = $('#l_msg').val();
if(l_type!="" && l_date!="" && l_msg!=""){
    $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            l_type: l_type,
            l_date: l_date,
            l_msg: l_msg            
        },
        cache: false,
        success: function(dataResult){                          
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                
                //$("#butsave").removeAttr("disabled");                
                $("#success").show();
                $('#success').html('Data added successfully !'); 
            }
            else if(dataResult.statusCode==201){
                alert("Error occured, add unique notice ! ");
                $("#butsave").removeAttr("disabled");
            }           
          }
    });
    }
    else{
        alert('Please fill all the fields !');
        $("#butsave_leave").removeAttr("disabled");
    }
});
});
//Adding My Leaves Close Button function
        $(document).ready(function(){
          $("#close_me_leave").click(function(){
            $table.bootstrapTable('refresh')  
            $("#butsave_leave").removeAttr("disabled");
            $("#success").attr("style", "display:none;");
            $('#l_date').val('');
          });
        });
//Change My Password
$(document).ready(function() {
$('#bt_change_pass').on('click', function() {
$("#bt_change_pass").attr("disabled", "disabled");
var old_password = $('#old_password').val();
var new_password = $('#new_password').val();
var password_again = $('#password_again').val();
if(old_password!="" && new_password!="" && password_again!="" && new_password==password_again){
    $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            old_password: old_password,
            new_password: new_password          
        },
        cache: false,
        success: function(dataResult){                          
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                    
                $("#success").show();
                $('#success').html('Password changed successfully. Loging Out in 2 seconds.'); 
                //window.location.href="https://office.crupeesoft.com/view/auth/logout.php";
                setTimeout(function() {window.location.href = "https://office.crupeesoft.com/view/auth/logout.php"}, 2000);
            }
            else if(dataResult.statusCode==201){
                alert("Error occured! ");
                $("#bt_change_pass").removeAttr("disabled");
            }           
          }
    });
    }
    else{
        alert('Please fill all the fields correctly!');
        $("#bt_change_pass").removeAttr("disabled");
    }
});
});  

// Salary Lists Menu Modal click outside disabled
$(document).ready(function(){
    $(".btn-salary-add").click(function(){
        $("#myModal").modal({ backdrop: 'static', keyboard: false });
    });
}); 

//Task Comment Modal Open
$(document).ready(function(){
  $('#table').on('click', '.task_comm', function() {
    $("#task_comment").modal({ backdrop: 'static', keyboard: false });
    var task_comm_id = $(this).attr("id");
    $("input[id='comm-id']").val(task_comm_id);
    $("#task_comment").modal();
  });
});

//Task Comment Save by Admin
$(document).ready(function() {
  $("#t-c-btn-s").click(function(){
    $("#t-c-btn-s").attr("disabled", "disabled");
      var task_comm_id = $('#comm-id').val();
      var task_comment = $('#t-comm').val();
    if(task_comment!==""){
    $.ajax({
        url: "../controller/config.php",
        type: "POST",
        data: {
            task_comm_id:task_comm_id,
            task_comment:task_comment          
        },
        cache: false,
        success: function(dataResult){                          
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){                  
                $("#success-t-c").show();
                $('#success-t-c').html('Comment Added successfully.');
            }
            else if(dataResult.statusCode==201){
                alert("Error occured! ");
                $("#t-c-btn-s").removeAttr("disabled");
            }           
          }
    });
    }
    else{
        alert('Please fill the comment!');
        $("#t-c-btn-s").removeAttr("disabled");
    }
});
});

// Task Comment Add Close Button clearing data
        $(document).ready(function(){
          $("#task-comclose").click(function(){
            $("#t-c-btn-s").removeAttr("disabled");
            $("#success-t-c").attr("style", "display:none;");
            $('#fupForm2')[0].reset();
            $table.bootstrapTable('refresh');  
          });
        }); 