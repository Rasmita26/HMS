<?php 
  $base='../';
  include($base.'_in/header.php');
?>
<style>
#mainform{
width:960px;
margin:20px auto;
padding-top:20px;
font-family: 'Fauna One', serif;
display:block;
}
h2{
margin-left: 65px;
text-shadow:1px 0px 3px gray;
}
h3{
font-size:18px;
text-align:center;
text-shadow:1px 0px 3px gray;
}
#onclick{
padding:3px;
color:green;
cursor:pointer;
padding:5px 5px 5px 15px;
width:70px;
color:white;
background-color:#123456;
box-shadow:1px 1px 5px grey;
border-radius:3px;
}
b{
font-size:18px;
text-shadow:1px 0px 3px gray;
}
#popup{
padding-top:80px;
}
.form{
border-radius:2px;
padding:20px 30px;
box-shadow:0 0 15px;
font-size:14px;
font-weight:bold;
width:350px;
margin:20px 250px 0 35px;
float:left;
}
input{
width:100%;
height:35px;
margin-top:5px;
border:1px solid #999;
border-radius:3px;
padding:5px;
}
input[type=button]{
background-color:#123456;
border:1px solid white;
font-family: 'Fauna One', serif;
font-Weight:bold;
font-size:18px;
color:white;
width:49%;
}
textarea{
width:100%;
height:80px;
margin-top:5px;
border-radius:3px;
padding:5px;
resize:none;
}
#contactdiv{
opacity:0.92;
position: absolute;
top: 0px;
left: 0px;
height: 100%;
width: 100%;
background: #000;
display: none;
}
#app{
width:350px;
margin:0px;
background-color:white;
font-family: 'Fauna One', serif;
position: relative;
border: 5px solid rgb(90, 158, 181);
}
.img{
float: right;
margin-top: -35px;
margin-right: -37px;
}
#app{
left: 50%;
top: 50%;
margin-left:-210px;
margin-top:-255px;
}

<div class="main-content">
			<div class="title">Dashboard</div>
            <br>
            <br>
<div class="row">
<div class="col-sm-3"></div>


<div id="mainform">
<div class="form" id="popup">
<p id="onclick">Popup</p> </div>
<div id="appdiv">
<form class="form" action="#" id="contact">

<h3>Appointment Form</h3>
<hr/><br/>
<label>Patient Name: <span>*</span></label>
<br/>
<input type="text" id="name" placeholder=" Patient Name"/><br/>
<br/>

<label>Dr.Name: <span>*</span></label>
<br/>
<input type="text" id="dname" placeholder=" Doctor Name"/><br/>
<br/>

<label>Date: <span>*</span></label>
<br/>
<input type="date" id="date" placeholder=" Date"/><br/>
<br/>


<label>Time: <span>*</span></label>
<br/>
<input type="time" id="time" placeholder=" Time"/><br/>
<br/>


<label>Disease:</label>
<br/>
<textarea id="disease" placeholder="Message......."></textarea><br/>
<br/>
<input type="button" id="add" value="Add"/>

<br/>
</form>
</div>


</div>
</div>
</div>
<script>
$(document).ready(function() {
setTimeout(popup, 3000);
function popup() {
$("#logindiv").css("display", "block");
}

$("#onclick").click(function() {
$("#contactdiv").css("display", "block");
});

// Contact form popup send-button click event.
$("#add").click(function() {
var name = $("#name").val();
var dname = $("#dname").val();
var disease = $("#disease").val();
var date = $("#date").val();
var time = $("#time").val();

});
</script>


<?php 
  include($base.'_in/footer.php');
?>