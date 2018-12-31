<?php
class RunHelper {
	
	/**
	 * Get result set from DB
	 */
	public static function retrieveArray($mysqli, $query) {
		$result = $mysqli->query($query);
	    $i = 0;
		while ($current = $result->fetch_array()) {
			$array[$i] = $current;
			$i++;
		}
		//
		if (isset($array)) {
			return $array;
		} else {
			return null;
		}
	}
	
	/**
	 * Get one row from DB
	 */
	public static function retrieveRow($mysqli, $query) {
		$result = $mysqli->query($query." LIMIT 1");
	    $row = $result->fetch_array();
		//
		if (isset($row)) {
			return $row;
		} else {
			return null;
		}
	}
	
	/**
	 * Used in run statistics page
	 * Elaborates average running speed from time in [HH:]mm:ss.x string format and covered distance in meters
     */
	public static function getAVGSpeed($time, $length) {
		// 1. parse time info
		$time_in_seconds = 0;
		$time_chunks = explode(":", $time);	// split [HH:]mm:ss:x string
		// sum chunks
		if (count($time_chunks)==4) { // time contains hours...
			if ($time_chunks[3]>=5) { // round miliseconds
				$time_in_seconds = 1;
			}
			$time_in_seconds += $time_chunks[2];
			$time_in_seconds += $time_chunks[1] * 60;
			$time_in_seconds += $time_chunks[0] * 3600;
		} else { // time only consists from mins and secs...
			if ($time_chunks[2]>=5) { // round miliseconds
				$time_in_seconds = 1;
			}
			$time_in_seconds += $time_chunks[1];
			$time_in_seconds += $time_chunks[0] * 60;
		}
		
		// 2. elaborate avg speed from time and length
		$speed_ms = $length / $time_in_seconds;
		$result = round($speed_ms * 3.6, 3);
		// check if there are really 2 digits before and 3 digits after ".", if not, add (for formating reasons)
		$result_chunks = explode(".", $result);
		if (strlen($result_chunks[0])<2) {
			$result = "0".$result;
		}
		if (strlen($result_chunks[1])<2) {
			$result .= "00";
		} elseif (strlen($result_chunks[1])<3) {
			$result .= "0";
		}
		
		return $result;
	}
	
	/**
	 * Used in run statistics page
	 * Counts 2 times in [HH:]mm:ss.ms string format
     */
	public static function sumTimes($time1, $time2) {
		$time_chunks_1 = explode(":", $time1);	// split [HH:]mm:ss.x string
		if (count($time_chunks_1)<4) { // normalize to 4 pcs format if needed
			$time_chunks_1[3] = $time_chunks_1[2];
			$time_chunks_1[2] = $time_chunks_1[1];
			$time_chunks_1[1] = $time_chunks_1[0];
			$time_chunks_1[0] = "00";
		}
		$time_chunks_2 = explode(":", $time2);	// split [HH:]mm:ss.x string
		if (count($time_chunks_2)<4) { // normalize to 4 pcs format if needed
			$time_chunks_2[3] = $time_chunks_2[2];
			$time_chunks_2[2] = $time_chunks_2[1];
			$time_chunks_2[1] = $time_chunks_2[0];
			$time_chunks_2[0] = "00";
		}
		// count together
		// miliseconds
		$output[3] = $time_chunks_1[3] + $time_chunks_2[3];
		if ($output[3] > 9) {
			$temp = 1;
		} else {
			$temp = 0;
		}
		$output[3] = $output[3] % 10;
		// seconds
		$output[2] = $time_chunks_1[2] + $time_chunks_2[2] + $temp;
		$temp = floor($output[2] / 60);
		$output[2] = $output[2] % 60;
		if ($output[2]<10) {
			$output[2] = "0" . $output[2];
		}
		// minutes
		$output[1] = $time_chunks_1[1] + $time_chunks_2[1] + $temp;
		$temp = floor($output[1] / 60);
		$output[1] = $output[1] % 60;
		if ($output[1]<10) {
			$output[1] = "0" . $output[1];
		}
		// hours
		$output[0] = $time_chunks_1[0] + $time_chunks_2[0] + $temp;
		//
		return $output[0].":".$output[1].":".$output[2].":".$output[3];
	}
}
?>