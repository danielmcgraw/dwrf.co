<?php
	$conn = mysql_connect("dwrf.db.5920177.hostedresource.com", "dwrf", "DraS_9fa");
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("dwrf", $conn);
	
	$drop_urlmap = "DROP TABLE urlmap";
	$res1 = mysql_query($drop_urlmap);
	if ($res1 == 1) {
		echo "deleted urlmap...<br>";
	} else {
		echo mysql_error();
	}
	
	$create_urlmap = "CREATE TABLE urlmap (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, url VARCHAR(1024) NOT NULL, ip VARCHAR(15), timestamp TIMESTAMP DEFAULT NOW())";
	$res2 = mysql_query($create_urlmap);
	if ($res2 == 1) {
		echo "created urlmap...<br>";
	} else {
		echo mysql_error();
	}
	
	$drop_urlstats = "DROP TABLE urlstats";
	$res3 = mysql_query($drop_urlstats);
	if ($res3 == 1) {
		echo "deleted urlstats...<br>";
	} else {
		echo mysql_error();
	}
	
	$create_urlstats = "CREATE TABLE urlstats (urlmap_id INT NOT NULL, referer varchar(1024), remote_ip varchar(15), timestamp TIMESTAMP DEFAULT NOW(), PRIMARY KEY (urlmap_id, timestamp), FOREIGN KEY (urlmap_id)REFERENCES urlmap(id))";
	$res4 = mysql_query($create_urlstats);
	if ($res4 == 1) {
		echo "deleted urlmap...<br>";
	} else {
		echo mysql_error();
	}
		
	mysql_close($conn);
?>