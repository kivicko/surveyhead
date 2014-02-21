<html>
<body style="background-color:#eee;">

<?php
ini_set('session.bug_compat_42', 0);
ini_set('session.bug_compat_warn', 0);
ini_set('session.use_trans_sid', 0); //bişeybieşy.com&PHPSESSID=3458u3489534 yazılmasını kapatır
ini_set('session.use_only_cookies', 1); //sadece o cookie benim makinamda varsa o sessionun kullanılmasına izin verir.
ini_set('session.cookie_lifetime', 31536000); // (= 60 * 60 * 24 * 365) session cookieleri browserda 1 yıl geçerli olur.
// changed for web server
ini_set('session.save_path', "/tmp");
//ini_set('session.save_path', "/var/www/sessions/surveyhead/");
ini_set('iconv.internal_encoding', 'UTF-8');
date_default_timezone_set("Europe/Istanbul");

error_reporting(E_ALL);
ini_set('display_errors', '1');

	include "../class/db/mysqlConnect.php";
	include "../class/controller.php";
	include "../class/layout.php";

$getStart = new controller();
$getStart->run();
			
			
?>

</body>
</html>