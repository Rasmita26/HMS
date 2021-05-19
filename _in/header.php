<?php
// $base='../../../';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['mobile']) && !isset($_SESSION['username']) && !isset($_SESSION['id']) && !isset($_SESSION['role'])) {
  header('Location: /index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="<?php echo $base; ?>images/icons/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo $base; ?>images/icons/favicon.ico" type="image/x-icon">
<meta http-equiv="origin-trial" content="AnoDA+qQ4mkZcH6VKHVcDBgoI5OiYDlFRD5YQLt2N3KQkUw5VrFDW09D28SExEr/bfpeDawmd8w9V4LEjjNopQkAAABheyJvcmlnaW4iOiJodHRwczovL3NldmFydGgubmV0OjQ0MyIsImZlYXR1cmUiOiJCYWRnaW5nVjIiLCJleHBpcnkiOjE1Nzk3NjE3MTAsImlzU3ViZG9tYWluIjp0cnVlfQ==">
<meta name="google-signin-client_id" content="235388521493-hnd66k17vqimasavmn6drqhsfum3uae2.apps.googleusercontent.com">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<script src="https://apis.google.com/js/api:client.js"></script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="<?php echo $base; ?>css/bootstrap.min.css">
    <script src="<?php echo $base; ?>js/jquery.min.js"></script>
    <script src="<?php echo $base; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $base; ?>js/list.min.js"></script>
    <script src="<?php echo $base; ?>js/alart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:700, 600,500,400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $base; ?>css/grid.min.css">
  <link rel="stylesheet" href="<?php echo $base; ?>css/select2.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.js"></script>
   
	<style>
	     .marginlefting {
   margin-left: 60px !important;
 }
 
 .displaynone {
   display: none !important;
 }
 
 .displayblock {
   display: block !important;
 }
 
 .sidebar .item i {
   font-size: 24px;
   margin-top: -5px !important;
 }
 
 .logo {
   height: 48px !important;
   padding: 10px !important;
 }
 
 .logo img {
   /* width: 100% !important; */
   height: 38px !important;
 }
 
 .title.item {
   padding: .92857143em 1.14285714em !important;
 }
 
 .main-content {
    margin-top: 0;
    height: 100%;
    overflow: scroll;
}

 .main-content .title {
    background-color: #7051E1;
    border-bottom: 1px solid #b8bec9;
    font-family: 'Hawaii 5-0', sans-serif;
    padding: 10px 20px;
    font-weight: 700;
    color: #FFF;
    font-size: 18px;
}
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Source Sans Pro', sans-serif;
    background-color: #d5dae5;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.table-list td,
.table-list th {
    border: 1px solid #ddd;
    padding: 1px !important;
    font-size: 13px;
}

.table-list td {
    padding-top: 10px !important;
}

.table-list tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table-list th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    background-color: #16a085;
    color: white;
}

 .dropdown .menu .header {
   padding-top: 3.9px!important;
   padding-bottom: 3.9px!important;
 }
	@media only screen and (max-width: 600px) {
  #searchviews {
    display: none;
  }
  .marginlefting {
   margin-left: 0px !important;
 }
 
}
.g-signin2{
  width: 100%;
  margin:8px;
}

.g-signin2 > div{
  margin: 0 auto;
  border-radius:50px;
}
	</style>
	<!-- <script src="<?php echo $base; ?>js/fwork.js"></script> -->

<?php 
if($_SESSION['role']=='admin'){ echo '<style>.update{ background-color: #002e6e;width: 70px;color:white;font-weight:400; display:show; } .insert{ display:show; }</style>'; }
if($_SESSION['role']=='user'){ echo '<style>.update{ background-color: #002e6e;width: 70px;color:white;font-weight:400; display:show; } .insert{ display:show; }</style>'; }
if($_SESSION['role']=='superviosor'){ echo '<style>.update{ background-color: #002e6e;width: 70px;color:white;font-weight:400; display:show; } .insert{ display:show; }</style>'; }
if($_SESSION['role']=='viewonly'){ echo '<style>.update{ background-color: #002e6e;width: 70px;color:white;font-weight:400; display:none; } .insert{ display:none; }</style>'; }
?>

    <title>Admin Dashboard</title>
	</head>
	<body>
    <input type="hidden" id="inp-session-id" value="<?php echo $_SESSION['id']; ?>">
<div class="ui sidebar vertical left menu overlay" style="-webkit-transition-duration: 0.1s; overflow: visible !important;">

  <div class="item logo">
    <img src="/img/login-img.png" /><img src="/img/login-img.png" style="display: none" /> 
    <span class="uisessionname"> <?php echo $_SESSION['username']; ?></span>
  </div>
  <div class="ui accordion" >
    <a class="item" href="/admin/patient/index.php">Patient Registration </a>
  
    <a class="item" href="<?php echo $base; ?>admin/bedmaster/index.php"> Bed Allotment </a>
    <a class="item" href="/admin/popup.php"> CRM </a>
    <div class="title item">
      <i class="dropdown icon"></i> Master</div>
    <div class="content">
	  				<a class="item" href="<?php echo $base; ?>admin/master/emp-master/index.php">Employee Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/docter-master/index.php">Docter Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/medicine-master/index.php">Medicine Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/sms-master/index.php">Ambulance Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/room-master/index.php">Room Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/rate-master/index.php">Rate Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/supplier-master/index.php">Supplier Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/salary-master/index.php">Salary Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/login-master/index.php">Login Master</a>
          

    </div>
    <a href="<?php echo $base; ?>admin/Billing/index.php" class="item">Stock</a>
    <a href="<?php echo $base; ?>admin/purchase/index.php" class="item">Purchase</a>

			<a href="<?php echo $base; ?>admin/process/index.php" class="item">Process</a>
      <a href="<?php echo $base; ?>admin/surgery/index.php" class="item">Surgery</a>
		<a href="<?php echo $base; ?>admin/Report/index.php" class="item">Report</a>
    <a class="item" href="<?php echo $base; ?>admin/master/setting/index.php" >Settings</a>
    <a class="item" href="javascript:void(0)" onclick="logout()">Logout</a>
    <div class="title item">
    <input type="text" class="form-control"  id="inp-history-caseno" placeholder="Register No." style="margin: 4px;">
    <button class="btn btn-sm btn-primary btn-block" id="btn-history-search" style="margin: 4px;">Search</button>
    </div>

 
  </div>
  <div class="ui dropdown item displaynone"><z>Patient Registration</z><i class="icon demo-icon wpforms icon-wpforms"></i>
    
    <div class="menu">
      <a class="item" href="/admin/patient/index.php">Patient Registration</a>
    </div>
  </div>
 <div class="ui dropdown item displaynone"><z>Bed Allotment</z><i class="bed icon"></i>
    
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/bedmaster/index.php">Bed Allotment</a>
    </div>
  </div>
  
  <div class="ui dropdown item displaynone"><z>CRM</z><i class="icon demo-icon wpforms icon-wpforms"></i>
    
    <div class="menu">
      <a class="item" href="/admin/popup.php">CRM</a>
    </div>
  </div>

  
  


  <div class="ui dropdown item displaynone">
    <z>Master</z>
    <i class="icon demo-icon world icon-globe"></i>

    <div class="menu">
      <div class="header">
      Master
      </div>
      <div class="ui divider"></div>
      <a class="item" href="<?php echo $base; ?>admin/master/emp-master/index.php">Employee Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/docter-master/index.php">Docter Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/medicine-master/index.php">Medicine Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/sms-master/index.php">Ambulance Master</a>
					<a class="item" href="<?php echo $base; ?>admin/master/room-master/index.php">Room Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/rate-master/index.php">Rate Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/supplier-master/index.php">Supplier Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/salary-master/index.php">Salary Master</a>
          <a class="item" href="<?php echo $base; ?>admin/master/login-master/index.php">Login Master</a>

			 </div>
			 
  </div>

  
  <div class="ui dropdown item displaynone"><z>Billing</z><i class="plus square icon"></i>
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/Billing/index.php" >Billing</a>
    </div>
  </div>

  <div class="ui dropdown item displaynone"><z>Purchase</z><i class="file alternate outline icon"></i>
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/purchase/index.php" >Purchase</a>
    </div>
  </div>
   

  <div class="ui dropdown item displaynone"><z>Process</z><i class="icon demo-icon icon-params server"></i>
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/process/index.php" >Process</a>
    </div>
  </div>

  <div class="ui dropdown item displaynone"><z>Surgery</z><i class="cut icon"></i>
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/surgery/index.php" >Surgery</a>
    </div>
  </div>

 


  
  <div class="ui dropdown item displaynone">
    <z>Reports</z>
    <i class="icon demo-icon chart pie icon"></i>

    <div class="menu">
      <div class="header">
     Reports
      </div>
      <div class="ui divider"></div>
      <a class="item" href="<?php echo $base; ?>admin/report/patient_report/index.php">Patient Report</a>
					<a class="item" href="<?php echo $base; ?>admin/report/doctor_report/index.php">Docter Report</a>
					<a class="item" href="<?php echo $base; ?>admin/report/appointment_report/index.php">Appointment Report</a>
					<a class="item" href="<?php echo $base; ?>admin/report/room_report/index.php">Room Report</a>
					<a class="item" href="<?php echo $base; ?>admin/report/med_report/index.php">Medicine Report</a>
          <a class="item" href="<?php echo $base; ?>admin/report/surgery_report/index.php">Surgery Report</a>
          <a class="item" href="<?php echo $base; ?>admin/master/salary-master/report.php">Salary Report</a>
         <a class="item" href="<?php echo $base; ?>admin/purchase/reports.php">Purchase Report</a>
         
			 </div>
			 
  </div>
 

  <div class="ui dropdown item displaynone"><z>Settings</z><i class="icon demo-icon eraser"></i>
    <div class="menu">
      <a class="item" href="<?php echo $base; ?>admin/master/setting/index.php">Settings</a>
    </div>
  </div>

  <div class="ui dropdown item displaynone"><z>Logout</z><i class="icon demo-icon power off icon"></i>
    <div class="menu">
      <a class="item" href="javascript:void(0)" onclick="logout()">Logout</a>
    </div>
  </div>

</div>
<div class="pusher">
  <div class="ui menu asd borderless" style="border-radius: 0!important; border: 0; margin-left: 260px; -webkit-transition-duration: 0.1s;">
    <a class="item openbtn">
      <i class="icon content"></i>
    </a>
    <div class="right menu">
     
      <!-- <div class="item">
        <div class="ui primary button">Sign Up</div>
      </div> -->
    </div>
  </div>
</div>

<script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  $(".ui.sidebar").toggleClass("very thin icon");
}else{
  $(".ui.sidebar").toggleClass("very thin icon visible");
}
     
     $(".asd").toggleClass("marginlefting");
     $(".sidebar z").toggleClass("displaynone");
     $(".ui.accordion").toggleClass("displaynone");
     $(".ui.dropdown.item").toggleClass("displayblock");
     $('.uisessionname').toggle();
     $(".logo").find('img').toggle();

 $(".openbtn").on("click", function() {
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  $(".ui.sidebar").toggleClass("very thin icon visible");
}else{
  $(".ui.sidebar").toggleClass("very thin icon");
}
   $(".asd").toggleClass("marginlefting");
   $(".sidebar z").toggleClass("displaynone");
   $(".ui.accordion").toggleClass("displaynone");
   $(".ui.dropdown.item").toggleClass("displayblock");
   $('.uisessionname').toggle();
   $(".logo").find('img').toggle();
   

 })
 $(".ui.dropdown").dropdown({
   allowCategorySelection: true,
   transition: "fade up",
   context: 'sidebar',
   on: "hover"
 });

 $('.ui.accordion').accordion({
   selector: {

   }
 });


 $(document).ready(function () {
   // setTimeout( function(){
        var sidebarlen=$('.sidebar').width();
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 
}else{
  $('.main-content').css('padding-left',sidebarlen+5);
}
 	  
		 $('.main-content').css('background','#eee');
 //   },50);
});

    
    function logout(){
				window.location.href = '/_api/logout.php';
    }
    
</script>
