<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_GET['method'])) exit;
include "../conf.php";
if($_GET['method'] == "checkauth") { //accountType(guest,has_paid,free,subscribing
	if($login == 1) {
		if(substr($_SESSION['username'],0,3) == "ga.") {
			echo '<checkAuth username="' . $_SESSION['username'] . '" guid="test" email="" country="" accountType="subscribing" timeLeft="100" receivenewsletter="false" hasValidIP="true" supplier="" payPalCancelUrl="" inGameMoney="0" nextPay="5" nextPayDay="5" shouldRenew="false" mustPickHouse="false" mustPay="false"/>';
		} else {
			echo '<checkAuth username="' . $login_result['username'] . '" guid="test" email="' . $login_result['email'] . '" country="' . $login_result['country'] . '" accountType="subscribing" timeLeft="100" receivenewsletter="false" hasValidIP="true" supplier="" payPalCancelUrl="" inGameMoney="' . $login_result['cash'] . '" nextPay="5" nextPayDay="5" shouldRenew="false" mustPickHouse="false" mustPay="false"/>';
		}
	} else {
		echo '<checkauth><error>not loggedin</error></checkauth>';
	}
} elseif ($_GET['method'] == "login") {
	$login_parm = array('user' => $_GET['username'], 'pass' => $_GET['password'], 'passHash' => md5($_GET['password'] . $serverSalt));
	$login_query = $db->prepare("SELECT * FROM players WHERE username = :user AND password = :pass or username = :user AND password = :passHash LIMIT 1");
	$login_query->execute($login_parm);
	$login_result = $login_query->fetch(PDO::FETCH_ASSOC);
	if(strcasecmp($login_result['username'],$_GET['username']) == 0) {
		$_SESSION['username'] = $login_result['username'];
		$_SESSION['passhash'] = md5($_GET['password'] . $serverSalt);
		$_SESSION['password'] = $_GET['password'];
		setcookie("PHPSESSID", session_id(), time()+3600, "/");
		if($_GET['launcher'] == "v1") {
			$sessionCode = md5(session_id() + $login_result['username'] + time());
			$updateses_parm = array('sessionCode' => $sessionCode, 'username' => $login_result['username'] );
			$updateses_query = $db->prepare("UPDATE players SET sessionCode = :sessionCode WHERE username = :username LIMIT 1");
			$updateses_query->execute($updateses_parm);
			echo "ok-" . $sessionCode;
		} else {
			echo "ok";
		}
	} else {
		echo '<checkauth><error>Wrong username or password</error></checkauth>';
	}
} elseif ($_GET['method'] == "play") {
	echo " <iframe src='http://websitehost.ext/dcr.php' width='100%' height='100%' frameBorder='0'></iframe> ";
} elseif ($_GET['method'] == "logout") {
	unset($_SESSION['username']);
	unset($_SESSION['passhash']);
	unset($_SESSION['password']);
} elseif ($_GET['method'] == "updateaccount") {
	$_SESSION['passhash'] = md5($_GET['password'] . $serverSalt);
	$updatepass_parm = array('email' => $_GET['email'], 'passhash' => $_SESSION['passhash'] );
	$updatepass_query = $db->prepare("UPDATE players SET password = :passhash WHERE email = :email LIMIT 1");
	$updatepass_query->execute($updatepass_parm);
} elseif ($_GET['method'] == "getfaq") {
	echo "dfafsdafsdgh";
} elseif ($_GET['method'] == "getWebPageContents") {
	echo "some contents!";
}
//cancelsubscription, deleteaccount
?>