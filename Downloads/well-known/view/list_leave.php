<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['email'])) {
    header('Location: auth/login.php');
    exit;
}
require_once '../controller/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Leave - <?php echo system_name;?></title>
    <!--Icon-->
    <link rel = "icon" href = "<?php echo system_url; ?>others/images/icon.png" type = "image/x-icon">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="<?php echo system_url; ?>css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
        <!-- Functions -->
    <script src="<?php echo system_url; ?>controller/functions.js"></script>
</head>

<body>    
    <div class="wrapper">      
        
        <?php 
        require_once 'sidenav.php';
        ?>

<div id="content">  
    <?php 
        require_once 'topnav.php';
    ?>

        <div class="h4_"><h3>Leave</h3></div>
        <div class="bg_">
            <div class="row">           
             <div class="col-md-12">
                <div class="box">
                <span class="h4_"><h4>Employee Leave</h4></span>
                <table id="table" data-show-columns="true">
                    <div class="table-view"></div>
                </table>
<!--Creating jQuery Script for Search, Pagination and More-->
<script type="text/javascript">

 var $table = $('#table');
      $table.bootstrapTable({
       url: 'list_leave_table.php',
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
           field: 'eid',
           title: 'E ID',
           sortable: true,
           
       },{
           field: 'flname',
           title: 'Full Name',
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
       },{
           field: 'actions',
           title: 'Actions',
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
        
        <footer class="main-footer">
            <!-- jQuery Custom Scroller CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="../controller/other-functions.js"></script>
        </footer>

    </div><!-- wrapper close -->
</body>
</html>