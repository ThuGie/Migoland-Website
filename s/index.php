<?php 
	/* Make sure cache is freshly gotten and not stored. */
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	/* Make sure a new session is start if none is already setup. */
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	/* method should always be set otherwise exit. */
	if(!isset($_GET['method'])) exit;
	/* include configuration file for database access and login validation. */
	include "../conf.php";
	/* Check if user is authenticated and guest check - TODO */
	if($_GET['method'] == "checkauth") { //accountType(guest,has_paid,free,subscribing
		if($login == 1) {
			if(substr($_SESSION['username'],0,3) == "ga.") { // setup guest system in database! TODO
				echo '<checkAuth username="' . $_SESSION['username'] . '" guid="test" email="" country="" accountType="subscribing" timeLeft="100" receivenewsletter="false" hasValidIP="true" supplier="" payPalCancelUrl="" inGameMoney="0" nextPay="5" nextPayDay="5" shouldRenew="false" mustPickHouse="false" mustPay="false"/>';
			} else { //add guid, accountType?, newsletter and other missing information! TODO
				echo '<checkAuth username="' . $login_result['username'] . '" guid="test" email="' . $login_result['email'] . '" country="' . $login_result['country'] . '" accountType="subscribing" timeLeft="100" receivenewsletter="false" hasValidIP="true" supplier="" payPalCancelUrl="" inGameMoney="' . $login_result['cash'] . '" nextPay="5" nextPayDay="5" shouldRenew="false" mustPickHouse="false" mustPay="false"/>';
			}
		} else {
			echo '<checkauth><error>not loggedin</error></checkauth>';
		}
		/* Check for login if everything is fine also add support for launcher - TODO */
	} elseif ($_GET['method'] == "login") { //Remove paintext password support alltogether, if plaintext user required to reset password! TODO
		$login_parm = array('user' => $_GET['username'], 'pass' => $_GET['password'], 'passHash' => md5($_GET['password'] . $serverSalt));
		$login_query = $db->prepare("SELECT * FROM players WHERE username = :user AND password = :pass or username = :user AND password = :passHash LIMIT 1");
		$login_query->execute($login_parm);
		$login_result = $login_query->fetch(PDO::FETCH_ASSOC);
		if(strcasecmp($login_result['username'],$_GET['username']) == 0) {
			$_SESSION['username'] = $login_result['username'];
			$_SESSION['passhash'] = md5($_GET['password'] . $serverSalt);
			$_SESSION['password'] = $_GET['password'];
			setcookie("PHPSESSID", session_id(), time()+3600, "/");
			if($_GET['launcher'] == "v1") { //Perhaps seperate launcher file to keep everything clean? TODO
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
		/* If user requests play send iframe with right dcr information in our case it has launcher redirect. */
	} elseif ($_GET['method'] == "play") {
		echo " <iframe src='http://websitehost.ext/dcr.php' width='100%' height='100%' frameBorder='0'></iframe> ";
	/* logout just empty all session information perhaps see if a proper reply is needed. */
	} elseif ($_GET['method'] == "logout") {
		unset($_SESSION['username']);
		unset($_SESSION['passhash']);
		unset($_SESSION['password']);
	/* updateaccount could be for more but right now just for password reset. */
	} elseif ($_GET['method'] == "updateaccount") {
		$_SESSION['passhash'] = md5($_GET['password'] . $serverSalt);
		$updatepass_parm = array('email' => $_GET['email'], 'passhash' => $_SESSION['passhash'] );
		$updatepass_query = $db->prepare("UPDATE players SET password = :passhash WHERE email = :email LIMIT 1");
		$updatepass_query->execute($updatepass_parm);
	/* getfaq needs swf decompile to get proper syntax. */
	} elseif ($_GET['method'] == "getfaq") {
		echo "dfafsdafsdgh";
	/* getWebPageContents forgot what needed it but again need to figure out proper syntax. */
	} elseif ($_GET['method'] == "getWebPageContents") {
		echo "some contents!";
	}
//cancelsubscription, deleteaccount
?>