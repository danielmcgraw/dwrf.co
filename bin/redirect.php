<?php 
function get_url($ext) {
	$index = any_to_dec($ext);
	$conn = mysql_connect("dwrf.db.5920177.hostedresource.com", "dwrf", "DraS_9fa");
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("dwrf", $conn);
	
	$referer = $_SERVER['HTTP_REFERER'];
	$remote_addr = $_SERVER['REMOTE_ADDR'];
	mysql_query("INSERT INTO urlstats (urlmap_id, referer, remote_ip) VALUES ($index, '$referer', '$remote_addr')");
	
	$result = mysql_query("SELECT url FROM urlmap where id = $index") or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	if ($row == null) {
		header('Location: http://dwrf.co');
	} elseif (mysql_num_rows($result) > 0) {
		$url = 'http://'. $row['url'];
		//Comment out the following line for testing.
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $url");
	} else {
		header('Location: http://dwrf.co');
	}
	
	mysql_close($conn);
	
}

function any_to_dec($num, $base=62, $char_map=false ) {
    if (!$base ) {
        $base = strlen($char_map);
    } else if (!$char_map) {
        $char_map = substr( "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 0, $base);
    }
    $out = 0;
    $len = strlen($num) - 1;
    for ($i = 0; $i <= $len; $i++ ) {
        $out = $out + strpos($char_map, substr($num, $i, 1)) * pow($base, $len - $i);
    }
    return $out;
}

if (isset($_GET['ext'])) {
	$ext = $_GET['ext'];
	get_url($ext);
} else {
	header('Location: http://dwrf.co');
}
?>