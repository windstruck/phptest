<?php 

// สำหรับเซฟรูปที่ถูก crop แล้วลงโฟเดอร์เก็บรูป
if ($_POST['chCrop']=="ok"){
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;
		$imgName = $_POST['imgname'];

		$src = "images/".$imgName;
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		$targ_w,$targ_h,$_POST['w'],$_POST['h']);

// 		header('Content-type: image/jpeg');
// 		imagejpeg($dst_r,null,$jpeg_quality);
		imagejpeg($dst_r,"images/".time().'_'.$imgName,$jpeg_quality);

		// Free up memory
		imagedestroy($dst_r);
// 		exit;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="demo_files/main.css" type="text/css" />
  <link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

  $(function(){

    $('#cropimg').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }


</style>

</head>
 
<body>

<!-- form upload รูปต้นฉบับ -->
<form action="upload.php" method="post" enctype="multipart/form-data">
 
<label for="file">เลือกรูป:</label>
<input type="file" name="fileUpload"  />
<br />
<input type="submit" name="submit" value="Submit" />
<input type="hidden" name="ch" value="ok"  />
</form> 
 
 
<?PHP

// สำหรับ upload รูปต้นฉบับลงโฟเดอร์เก็บรูป

$br = '<br />';
 if($_POST['ch']=="ok")
 
 {
$_FILES["fileUpload"]["tmp_name"];
 
	 $images = $_FILES["fileUpload"]["tmp_name"]; 
	 $typeupload =($_FILES["fileUpload"]["type"] );
	 $nameimages = $_FILES["fileUpload"]["name"]; 
     copy($_FILES["fileUpload"]["tmp_name"],"images/".$nameimages); 
 
 	
 }
 
 // Debug data
 echo 'images : '.$images.$br;
 echo 'typeupload : '.$typeupload.$br;
 echo 'nameimages : '.$nameimages.$br;
?>
<!-- รูปต้นฉบับ -->
<img src="images/<?=$nameimages?>" id="cropimg" />

<!-- form สำหรับ crop รูป -->
<form action="upload.php" method="post" onsubmit="return checkCoords();">
	<input type="hidden" id="x" name="x" />
	<input type="hidden" id="y" name="y" />
	<input type="hidden" id="w" name="w" />
	<input type="hidden" id="h" name="h" />
	<input type="hidden" name="chCrop" value="ok"  />
	<input type="hidden" name="imgname" value="<?=$nameimages?>"  />
	<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
</form>

<!-- รูปที่ถูก crop เรียบร้อยแล้ว -->
<img src="images/<?= time().'_'.$imgName ?>" />

<?php 

?>
</body>
</html>