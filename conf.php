<?php
error_reporting(0);
session_start();
$main = 0;
$isbanned = false;

$serverSalt = "YoUrHaSH!";
$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"] ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];

/*if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) || preg_match('/Trident/i',$_SERVER['HTTP_USER_AGENT'])) {
	$main_msg = "<br><b>Spineworld is not available on internet explorer.</b><br>
<br>
<b>Please download Palemoon to continue visiting spineworld, You can download it at <u><a href=https://www.palemoon.org/palemoon-win32.shtml>Palemoon x32</a></u><br><br>And make sure to install shockwave <u><a href=https://fpdownload.macromedia.com/get/shockwave/default/english/win95nt/latest/Shockwave_Installer_Full.exe>Shockwave</a></u>.</b><br>
<br>
Please check back again using Palemoon.";
	include "../../tempdown/index.php";
	exit;
}

if($main == 1) {
	$main_msg = "<br>Spineworld is not available right now.<br>
<br>
<b>We are performing maintenance and upgrades in our services.</b><br>
<br>
Please check back later.";
	include "../../tempdown/index.php";
	exit;
}*/
try {
$db = new PDO('mysql:host=localhost;dbname=database_name', 'user_name','password',array(PDO::ATTR_TIMEOUT => "1",PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
	$main_msg = "Migoland is not available right now.<br><br><b>There is some trouble with the database.</b><br><br>Please check back later.";
	include "../../tempdown/index.php";
	exit;
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$ban_parm = array('ip' => $_SERVER['REMOTE_ADDR']);
	$ban_query = $db->prepare("SELECT * FROM bans WHERE ip = :ip LIMIT 1");
	$ban_query->execute($ban_parm);
	$ban_result = $ban_query->fetch(PDO::FETCH_ASSOC);
	if($ban_result['ip'] == $_SERVER['REMOTE_ADDR']) {
		//echo "<center>You have been ip banned by " . $ban_result['banby'] . "</center>";
		//exit;
		$isbanned = true;
	} 

$login = 0;
if(substr($_SESSION['username'],0,3) == "ga.") {
	$login = 1;

} else {
if(isset($_GET['JSESSIONID'])) {
	$_GET['JSESSIONID'] = explode("?", $_GET['JSESSIONID'])[0];
	$login_parm = array('sessionCode' => $_GET['JSESSIONID']);
	$login_query = $db->prepare("SELECT
        * 
    FROM
        ((SELECT
            * 
        FROM
            players 
        WHERE
            players.sessionCode = :sessionCode LIMIT 1) 
    UNION
    DISTINCT (SELECT
        * 
    FROM
        players 
    WHERE
        players.sessionCode = :sessionCode LIMIT 1)
) AS union1 LIMIT 1");
	$login_query->execute($login_parm);
	$login_result = $login_query->fetch(PDO::FETCH_ASSOC);
	if(strcasecmp($login_result['sessionCode'],$_GET['JSESSIONID']) == 0) {
		$update_parm = array('sessionCode' => $_SESSION['sessionCode'], 'ip' => $_SERVER['REMOTE_ADDR'], 'hostname' => gethostbyaddr($_SERVER['REMOTE_ADDR']));
		$update_query = $db->prepare("UPDATE players SET ip = :ip, hostname = :hostname WHERE sessionCode = :sessionCode LIMIT 1");
		$update_query->execute($update_parm);
		$login = 1;
	} else {
		$login = 0;
	}
}elseif(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['passhash'])) {
	$login_parm = array('user' => $_SESSION['username'], 'pass' => $_SESSION['password'], 'passhash' => $_SESSION['passhash']);
	$login_query = $db->prepare("SELECT
        * 
    FROM
        ((SELECT
            * 
        FROM
            players 
        WHERE
            players.username = :user 
            AND players.password = :passhash LIMIT 1) 
    UNION
    DISTINCT (SELECT
        * 
    FROM
        players 
    WHERE
        players.username = :user 
        AND players.password = :pass LIMIT 1)
) AS union1 LIMIT 1");
	$login_query->execute($login_parm);
	$login_result = $login_query->fetch(PDO::FETCH_ASSOC);
	if(strcasecmp($login_result['username'],$_SESSION['username']) == 0) {
		if(strcasecmp($login_result['password'], $_SESSION['password']) == 0) {
			$updatehash_parm = array('user' => $_SESSION['username'], 'passhash' => $_SESSION['passhash'] );
			$updatehash_query = $db->prepare("UPDATE players SET password = :passhash WHERE username = :user LIMIT 1");
			$updatehash_query->execute($updatehash_parm);
		}
		$update_parm = array('user' => $_SESSION['username'], 'ip' => $_SERVER['REMOTE_ADDR'], 'hostname' => gethostbyaddr($_SERVER['REMOTE_ADDR']));
		$update_query = $db->prepare("UPDATE players SET ip = :ip, hostname = :hostname WHERE username = :user LIMIT 1");
		$update_query->execute($update_parm);
		$login = 1;
	} else {
		$login = 0;
	}
}
}
?>