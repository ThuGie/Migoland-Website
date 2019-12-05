<?php 
if(!isset($_GET['method'])) exit;
include "../conf.php";
if($_GET['method'] == "getprices") {
	echo '<getPrices name="United States" currency="USD" price1="5.95" price2="14.95" price3="24.95" priceT="5.95"/>';
}elseif ($_GET['method'] == "createguest") {
	//gender(1(female),2(male)), ap(roomtheme/appearance(13?)),chk=hash?? md5(affiliate/referrer/appearance/gender
	$_SESSION['username'] = "ga." . mt_rand(1000,9999);
	setcookie("PHPSESSID", session_id(), time()+3600, "/");
	echo "ok";
} elseif($_GET['method'] == "getavatar" and $login == 1) {
	$hash = mt_rand(1000,9999);
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$country = geoip_country_name_by_name($hostname);
	if($country == "Netherlands") {
		$country_code = 157;
	} else { 
		$country_code = 1;
	}
	$hash_parm = array('user' => $login_result['username'], 'hash' => $hash, 'hostname' => $hostname, 'country' => $country, 'country_code' => $country_code);
	$hash_query = $db->prepare("UPDATE players SET loginHash = :hash, cash=10000, hostname = :hostname, country = :country, country_code = :country_code WHERE username = :user LIMIT 1");
	$hash_query->execute($hash_parm);
	echo "<getAvatar>
<nsid>" . $login_result['username'] . "" . $hash . "</nsid>
<gender>" . $login_result['gender'] . "</gender>
<dclog>1</dclog>
<sl><s id='196' ip='server-iphere' hn='Cloud One' sc='0'/></sl>

</getAvatar>";

}
//83.84.77.178
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
