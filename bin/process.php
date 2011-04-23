<div id='message'>
	<h2>
		<?php	
			function map_url($url) {
				$conn = mysql_connect("dwrf.db.5920177.hostedresource.com", "dwrf", "DraS_9fa");
				if(!$conn) {
					die('Could not connect: ' . mysql_error());
				}
					
				mysql_select_db("dwrf", $conn);	
			
				$index = is_mapped($url, $conn);
				if($index == null) {
					$remote_addr = $_SERVER['REMOTE_ADDR'];
					mysql_query("INSERT INTO urlmap (url, ip) VALUES ('$url', '$remote_addr')");
					$index = mysql_insert_id();
				}
				
				mysql_close($conn);
	
				$ret_str = "http://dwrf.co/" . dec_to_any($index);
				return $ret_str;
			}

			function is_mapped($url, $conn) {
				$result = mysql_query("SELECT id FROM urlmap WHERE url = '$url'");
				$row = mysql_fetch_array($result);
				return $row['id'];
			}

			function dec_to_any($num, $base=62, $char_map=false) {
				if(!$base) {
					$base = strlen($char_map);
				} else if(!$char_map) {
					$char_map = substr('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', 0, $base);
				}
				$out = '';
				for($i = floor(log10($num) / log10($base)); $i >= 0; $i--) {
					$tmp = floor($num / pow($base, $i));
					$out = $out . substr($char_map, $tmp, 1);
					$num = $num - ($tmp * pow($base, $i));
				}
				return $out;
			}
	  
			$res = map_url($_POST['url']);
	  
			echo $res;
		?>
	</h2>
</div>