<?php
// created by Wei Wei
include_once 'DBConn.php';

$ref0 = "YF@G^%^&*C"; // check the ref number
$encrpt1 = "albertaedmontonG*^(HUIJIP";


if ($_POST['ref'] === $ref0) {
	// auth successed

	
 	foreach ($_POST as $key => $value) {
		$value = mysqli_escape_string($value);
	}
	

	$password = md5($_POST['password'].$encrpt1);


	$query = 'select * from libadmin where username = "'.$_POST['username'].'"';
	
	if(!$res = DBConn::getConnection()->query($query)){
		die('There was an error running the query [' . $query->error . ']');
	}

	$row = $res->fetch_assoc();
	if ($row == null) {
		setcookie("alertlog", "Username doesn't exit.", time()+3);
		echo "<script language=javascript>location.href='admin.php'</script>";
	}else{
		if ($password == $row['password']) {
			session_start();
			$_SESSION['adminid'] = $row['id'];
			echo "Login successfully. Jump to the main page for administrators.";
			echo "<script language=javascript>location.href='adminmng.php'</script>";
		}else{
			echo "Password is wrong.";
		}
	}

 } else{
 	// auth failed
 	setcookie("alertlog", "Reference is wrong, please retry", time()+3);
	echo "<script language=javascript>location.href='admin.php'</script>";
 }

//setcookie("alertlog", "Log in failed, please retry", time()+10);
//echo "<script language=javascript>location.href='admin.php'</script>";
?>