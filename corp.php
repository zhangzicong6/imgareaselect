<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/png"))){
			    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			    echo "Type: " . $_FILES["file"]["type"] . "<br />";
			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

			      move_uploaded_file($_FILES["file"]["tmp_name"],
			      "upload/" . $_FILES["file"]["name"]);
			      echo "Stored in: " . "upload/" .  $_FILES["file"]["name"];

					$src = 'upload/'.$_FILES["file"]["name"];
					if($_FILES["file"]["type"]== "image/jpeg"||$_FILES["file"]["type"] == "image/pjpeg"){
						$img_r = imagecreatefromjpeg($src);
					}else if($_FILES["file"]["type"] == "image/png"){
						$img_r = imagecreatefrompng($src);
					}else if($_FILES["file"]["type"] == "image/gif"){
						$img_r = imagecreatefromgif($src);
					}
					
					$dst_r = ImageCreateTrueColor($_POST['w'],$_POST['h'] );

					imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
					$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);

					header('Content-type: image/jpeg');

					imagejpeg($dst_r,"upload/get".$_FILES["file"]["name"]);

	  }else{
	  echo "Invalid file";
	  }


	exit;
}