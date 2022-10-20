<?php
require_once 'header.php';
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php require_once 'sidenav.php';?>
        <div id="content">						
        	<?php require_once 'topnav.php';?>
    		<div class="h4_"><h3>My Profile</h3></div>
    		<div class="bg_">
    			<div class="row">			
    			     <div class="col-md-12">
                        <div class="box">
    			 	       <span class="h4_"><h4>Personal Information</h4></span>
                            <section class="content">
                            <div class="row">
                
                            <div class="col-lg-7">
                                <div class="box shadow-lg p-3 mb-5 bg-body rounded bod">
                                    <div class="box-header">
                                        <h5 class="box-title">Edit Profile Details</h5>
                                    </div>
                                    <div class="box-body leftmar">
                                        <form method="POST" data-toggle="validator" id="profile-form" novalidate="true">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="first_name"><strong>First Name </strong></label>
                                                        <input type="text" class="form-control" name="1" id="first_name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="last_name"><strong>Last Name </strong></label>
                                                        <input type="text" class="form-control" name="2" id="last_name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="dob"><strong>Date of Birth (MM/DD/YYYY)</strong> </label>
                                                        <input type="text" class="form-control datepicker" name="3" id="dob"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="gender"><strong>Gender</strong> </label>
                                                        <select class="form-control" name="34" id="34" required>
                                                            <option value="">Please make a choice</option>
                                                            <option value="Male">
                                                                Male
                                                            </option>
                                                            <option value="Female">
                                                                Female
                                                            </option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="address"><strong>Address </strong></label>
                                                        <input type="text" class="form-control" name="4" id="address"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="city"><strong>City</strong></label>
                                                        <input type="text" class="form-control" name="5" id="city" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="state"><strong>State </strong></label>
                                                        <input type="text" class="form-control" name="6" id="state" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="country"><strong>Country</strong> </label>
                                                        <input type="text" class="form-control" name="7" id="country"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="merital_status"> <strong>Merital Status</strong></label>
                                                        <input type="text" class="form-control" name="8"
                                                            id="merital_status" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="nationality"><strong>Nationality </strong></label>
                                                        <input type="text" class="form-control" name="9" id="nationality"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="email"><strong>Email </strong></label>
                                                        <input type="email" class="form-control" name="10" id="email"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="mobile"><strong>Mobile </strong></label>
                                                        <input type="text" class="form-control" name="11" id="mobile"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="telephone"><strong>Telephone</strong></label>
                                                        <input type="text" class="form-control" name="12" id="telephone">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="identity_doc"><strong>Identity Document</strong></label>
                                                        <select class="form-control" name="13" id="13">
                                                            <option value="">Please make a choice</option>
                                                            <option value="Voter Id">Voter Id</option>
                                                            <option value="Citizenship">Citizenship</option>
                                                            <option value="Driving License">Driving License</option>
                                                            <option value="Passport">Passport</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="identity_no"><strong>Identity No</strong></label>
                                                        <input type="text" class="form-control" name="14" id="identity_no"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="emp_type"><strong>Employment Type</strong></label>
                                                        <select class="form-control" name="15" id="15">
                                                            <option value="Part time">Part time</option>
                                                            <option value="Intern">Intern</option>
                                                            <option value="Holiday worker">Holiday worker</option>
                                                            <option value="Full Time">Full Time</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="joining_date"><strong>Join Date (MM/DD/YYYY)</strong></label>
                                                        <input type="text" class="form-control datepicker" name="16"
                                                            id="joining_date" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="blood_group"><strong>Blood group</strong></label>
                                                        <input type="text" class="form-control" name="17" id="blood_group"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="designation"><strong>Designation</strong></label>
                                                        <input type="text" class="form-control" name="18" id="designation"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="department"><strong>Department</strong></label>
                                                        <input type="text" class="form-control" name="19" id="department" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="pan_no"><strong>PAN No.</strong></label>
                                                        <input type="text" class="form-control" name="20" id="pan_no" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="bank_name"><strong>Bank Name</strong></label>
                                                        <input type="text" class="form-control" name="21" id="bank_name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="account_no"><strong>Bank A/C No.</strong></label>
                                                        <input type="text" class="form-control" name="22" id="account_no" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="pf_account"><strong>PF A/C No.</strong></label>
                                                        <input type="text" class="form-control" name="24" id="pf_account" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- <button type="submit" class="btn btn-primary ">Submit</button> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="box shadow-lg p-3 mb-5 bg-body rounded">
                                    <div class="box-header">
                                        <h5 class="box-title">Change Password</h5>
                                    </div>
                                    <div class="box-body">
                                        <form method="POST" id="password-form">
                                            <div class="form-group">
                                                <label for="old_password"><strong>Existing Password: </strong></label>
                                                <input type="password" class="form-control" name="old_password" id="old_password"
                                                    required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password"><strong>New Password:</strong> </label>
                                                <input type="password" class="form-control" name="new_password" id="new_password"
                                                    required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_conf"><strong>Confirm Password:</strong> </label>
                                                <input type="password" class="form-control" name="password_again" id="password_again"
                                                    required>
                                            </div>
                                            <!--Alert-->
                                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                                             <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            </div>
                                            <div class="form-group">
                                                <input type="button" name="save" class="btn btn-primary btn-sm" value="Submit" id="bt_change_pass">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>   

                        </div>
    			    </div>
    		    </div>	
    		</div>
        </div><!-- content close -->
    </div><!-- wrapper close -->
<?php require_once 'footer.php';?>
</body>
</html>