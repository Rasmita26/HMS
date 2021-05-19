<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="icon" type="image/png" href="/img/icons/login-img3.ico"/>
	<link rel="manifest" href="/manifest.json">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.min.js"></script>
	<title>Login Page</title>
	</head>
	<body>	
	<button style="border-radius:25px;" class="btn-success btn-block btn ad2hs-prompt">Install App</button>
	</body>
</html>
<script type="text/javascript">

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
