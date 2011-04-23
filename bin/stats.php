<?php
	if (isset($_GET['ext'])) {
		$ext = $_GET['ext'];
		$id = any_to_dec($ext);
	} else {
		header('Location: http://dwrf.co');
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
?>
<html>
	<body>
		<?php			
			$conn = mysql_connect("dwrf.db.5920177.hostedresource.com", "dwrf", "DraS_9fa");
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}
	
			mysql_select_db("dwrf", $conn);
			
			echo "URL Stats <br>";
			$res = mysql_query("SELECT * FROM urlstats where urlmap_id = $id");
			while($row = mysql_fetch_array($res)) {
				echo "id " . $row['urlmap_id'] . "<br>";
				echo "referer " . $row['referer'] . "<br>";
				echo "remote ip " . $row['remote_ip'] . "<br>";
				echo "timestamp " . $row['timestamp'] . "<br>";
				echo "<br />";
			}
	
			mysql_close($conn);
		?> 
	</body>
</html>