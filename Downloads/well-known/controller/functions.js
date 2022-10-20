// login page
function do_login()
{
 var email=$("#username").val();
 var pass=$("#password").val();
 if(email!=="" && pass!=="")
 {
  $("#loading_spinner").css({"display":"block"});
  $.ajax
  ({
  type:'post',
  url:'../../controller/config.php',
  data:{
   do_login:"do_login",
   email:email,
   password:pass
  },
  success:function(response) {
  if(response=="success")
  {
    window.location.href="../my_list_notice.php";    
  }
  else
  {
    $("#loading_spinner").css({"display":"none"});
    alert("Wrong Details");
  }
  }
  });
 }

 else
 {
  alert("Please Fill All The Details");
 }

 return false;
}
//Login Page ended

//Sidebar
 $(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
         theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function () {
        // open or close navbar
        $('#sidebar').toggleClass('active');
        // sidebar left 100px
        $('#content').toggleClass('minus-active');
        // close dropdowns
        $('.collapse.in').toggleClass('in');
        // and also adjust aria-expanded attributes we use for the open/closed arrows
        // in our CSS
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

});

