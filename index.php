<?php 
// $base='../../../';
session_start();
if (isset($_SESSION['mobile']) && isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role']) ) {
		header("Location: admin/index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/grid.min.css">
    <link rel="icon" type="image/png" href="/img/icons/login-img3.ico"/>
	<link rel="manifest" href="/manifest.json">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <title>Hospital Managment System</title>
    <style>
    input[type="text"],input[type="password"]{
        border-radius: 0px;
        border-bottom:1px solid blue;
    }
    .btn{
        border-radius: 0px;
    }
    
    </style>
</head>
<body>
    <div class="container">
        <br>      
        <br>      
            <div class="col-sm-3"></div>
            <div class="col-sm-5" style="-webkit-box-shadow: 3px 3px 5px 6px #ccc;-moz-box-shadow:3px 3px 5px 6px #ccc;box-shadow:3px 3px 5px 6px #ccc;">
            <center>
            <img src="/img/login-img.png" style="width:270px;height:270px;">
            <br>
            <p><b><i>Service of the people is the service of God.</i></b></p>
            </center>
                    <hr style="margin:8px;">
                      <label style="margin-top:5px;">Enter Mobile No:</label><input type="text" id="inp-mobile" class="form-control" placeholder="Mobile No">
                      <label style="margin-top:5px;">Enter Password:</label><input type="password" id="inp-password" class="form-control" placeholder="Password">
                      <button style="margin-top:10px;" id="btn-submit" class="btn btn-block btn-primary" onclick="submit()">Submit</button>
                      
                      <br>
                      <button style="border-radius:25px;" class="btn-success btn-block btn ad2hs-prompt">Install App</button>
            </div>
        </div>
    </div>

<script>
$('#inp-password').keypress(function (e) {
	if (e.which == 13) {
        submit();
	}
});

function submit(e){
  var mobile = $('#inp-mobile').val().trim(), password = $('#inp-password').val().trim(), valid=true;
  
  if(mobile==''){
      valid=valid*false;
      $('#inp-mobile').css('border-bottom','1px solid red');
  }else{
    valid=valid*true;
    $('#inp-mobile').css('border-bottom','1px solid green');
  }
  if(password==''){
    valid=valid*false;
      $('#inp-password').css('border-bottom','1px solid red');
  }else{
    valid=valid*true;
    $('#inp-password').css('border-bottom','1px solid green');
  }
  if(valid){
    $('#btn-submit').hide();
	$.ajax({
		type: "POST",
		data: "mobile=" + mobile + "&password=" + password,
		url: '_api/login.php',
		success: function (res) {
			if (res.status == 'success') {
				$('#btn-submit').show();
				window.location.replace('/index.php?timstamp='+Math.floor(Math.random() * 1000000));
			} else {
				$('#btn-submit').show();
			}
		}
	});
  }
}


if ('serviceWorker' in navigator) {
	console.log('CLIENT: service worker registration in progress.');
	navigator.serviceWorker.register('/sw.js').then(function () {
		console.log('CLIENT: service worker registration complete.');
	}, function () {
		console.log('CLIENT: service worker registration failure.');
	});
} else {
	console.log('CLIENT: service worker is not supported.');
}

var deferredPrompt;

window.addEventListener('beforeinstallprompt', function (e) {
	// Prevent Chrome 67 and earlier from automatically showing the prompt
	e.preventDefault();
	// Stash the event so it can be triggered later.
	deferredPrompt = e;

	showAddToHomeScreen();

});

function showAddToHomeScreen() {
	var a2hsBtn = document.querySelector(".ad2hs-prompt");
	a2hsBtn.style.display = "block";
	a2hsBtn.addEventListener("click", addToHomeScreen);
}

function addToHomeScreen() {
	var a2hsBtn = document.querySelector(".ad2hs-prompt"); // hide our user interface that shows our A2HS button
	a2hsBtn.style.display = 'none'; // Show the prompt
	deferredPrompt.prompt(); // Wait for the user to respond to the prompt
	deferredPrompt.userChoice
		.then(function (choiceResult) {

			if (choiceResult.outcome === 'accepted') {
				console.log('User accepted the A2HS prompt');
			} else {
				console.log('User dismissed the A2HS prompt');
			}

			deferredPrompt = null;

		});
}


</script>

</body>
</html>

