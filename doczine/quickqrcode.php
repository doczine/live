<?php
/*
Plugin Name: Quick QR Code! PHP 
Plugin URI: http://www.codeoncall.com
Description: Automatically creates a QR Code for every page of your website. Download it with the click of a button. 
Author: Jerry Gonzalez
Version: 1
Author URI: http://www.codeoncall.com
Copyright 2013 Quick QR Code! PHP (email : jerry@codeoncall.com)
*/

//Generate QR Code
	function quickqrcode($width,$show) {
			
		$url = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
		$height = $width;
		$url    = urlencode($url);
		$image  = '<div style="text-align:right;"><img src="http://chart.apis.google.com/chart?chs='.$width.'x'.$height.'&cht=qr&chl='.$url.'" title="'.urldecode($url).'" />';
		
		if($show=="yes" && isset($password)){
		
			if($_POST['qrcodepassword'] != $password){
				
				$image .= '<form method="post">';
				$image .= '<input type="text" size="8" name="qrcodepassword" />';
				$image .= '<input type="submit" value="Password" />';
				$image .= '</form>';
		
			}
		/*
			if($_POST['qrcodepassword'] == $password){
				$image .= '<form method="post">';
				$image .= '<select name="qqrcodesize">';
				$image .= '<option value="100">100px</option>';
				$image .= '<option value="150">150px</option>';
				$image .= '<option value="200">200px</option>';
				$image .= '<option value="250">250px</option>';
				$image .= '<option value="300">300px</option>';
				$image .= '<option value="350">350px</option>';
				$image .= '<option value="400">400px</option>';
				$image .= '<option value="450">450px</option>';
				$image .= '<option value="500">500px</option>';
				$image .= '</select>';
				$image .= '<input type="submit" name="quickqrcodephpdownload" value="Download" />';
				$image .= '</form>';
				$image .= '<br />';		
			}
		*/
		
		}
		
		/*
		if($show=="yes" && !isset($password)){
		
				$image .= '<form method="post">';
				$image .= '<select name="qqrcodesize">';
				$image .= '<option value="100">100px</option>';
				$image .= '<option value="150">150px</option>';
				$image .= '<option value="200">200px</option>';
				$image .= '<option value="250">250px</option>';
				$image .= '<option value="300">300px</option>';
				$image .= '<option value="350">350px</option>';
				$image .= '<option value="400">400px</option>';
				$image .= '<option value="450">450px</option>';
				$image .= '<option value="500">500px</option>';
				$image .= '</select>';
				$image .= '<input type="submit" name="quickqrcodephpdownload" value="Download" />';
				$image .= '</form>';
				$image .= '<br />';		
		
		}		
		*/
	
		$image .= '</div>';
		
		return $image;
		
	}			
		
//Download Function
/*
	if($_POST['quickqrcodephpdownload']) {

		$page = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
		$page = urlencode($page);
		$width=$_POST["qqrcodesize"];
		$height = $width;
		$theurl = 'http://chart.apis.google.com/chart?chs='.$width.'x'.$height.'&cht=qr&chl='.$page;
		quickQRCodePHPDownload($theurl);
	}
*/
	function quickQRCodePHPDownload($url){

		$file_handler = fopen('quickqrcode.png', 'w');
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_FILE, $file_handler);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_exec($curl);
		curl_close($curl);
		fclose($file_handler);
		forceDownloadQuickQRCodePHP();	
	}

	function forceDownloadQuickQRCodePHP() {
	   	$file  = 'quickqrcode.png';
	   	$file_name = $file;

	   	if(is_file($file_name)) {

	      	// required for IE
	      	if(ini_get('zlib.output_compression')) {
	           ini_set('zlib.output_compression', 'Off');
	      	}
	      	header('Pragma: public');   // required
	      	header('Expires: 0');       // no cache
	      	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	      	header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
	      	header('Cache-Control: private',false);
	      	header('Content-Type: IMAGE/PNG');
	      	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	      	header('Content-Transfer-Encoding: binary');
	      	header('Content-Length: '.filesize($file_name));    // provide file size
	      	header('Connection: close');
	      	readfile($file_name);
	      	exit();
		}
	}

?>