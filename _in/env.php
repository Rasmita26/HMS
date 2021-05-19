<?php
error_reporting(0);

function _connect(){

	// $HOST='localhost';
	// $USERNAME='id12558649_bhavi';
	// $PASSWORD='pass1234';
	// $DBNAME='id12558649_hms';

	$HOST='localhost';
	$USERNAME='root';
	$PASSWORD='';
	$DBNAME='hms';
	return mysqli_connect($HOST,$USERNAME,$PASSWORD,$DBNAME);
}

function _close($con){
	mysqli_close($con);
}
?>