<?php



define('UPLOAD_DIR', 'C:\\xampp\htdocs\upload\files');
//define('UPLOAD_DIR', '/var/uploaded_files/');

//https://www.etutorialspoint.com/index.php/187-php-file-upload-mime-type-validation-with-error-handler
define('MAXSIZE', 7340032); // allow max 7 MB




$ALLOWED_FILEEXT = array('pdf', 'doc', 'docx', 'txt');
$ALLOWED_MIME = array('application/pdf', 
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain','image/jpeg', 'text/x-c++');

function allowedfile($tempfile, $destpath) {
	global $ALLOWED_FILEEXT, $ALLOWED_MIME;
	$file_ext = pathinfo($destpath, PATHINFO_EXTENSION);
	$file_mime = mime_content_type($tempfile);
	$valid_extn = in_array($file_ext, $ALLOWED_FILEEXT);
	$valid_mime = in_array($file_mime, $ALLOWED_MIME);
	$allowed_file = $valid_extn && $valid_mime;
	return $allowed_file;
}			

function handleUpload() {
	$temp = $_FILES['file']['tmp_name'];
	$filename = basename($_FILES['file']['name']);
	$file_dest = UPLOAD_DIR. $filename;
	$is_uploaded = is_uploaded_file($temp);
	$valid_size = $_FILES['file']['size'] <= MAXSIZE && $_FILES['file']['size'] >= 0;

	if ($is_uploaded && $valid_size && allowedfile($temp, $file_dest)) {
	if(move_uploaded_file($temp, $file_dest)) {
	$response = 'The file uploaded successfully!';
	} else {
	$response = 'The file could not be uploaded.';
	}
	} else {
	$response = 'Error: uploaded file size or type is not valid.';
	}
	return $response;
}		

// Handle Error

function get_mime_type($file) {
	$mtype = false;
	if (function_exists('finfo_open')) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mtype = finfo_file($finfo, $file);
		finfo_close($finfo);
	} elseif (function_exists('mime_content_type')) {
		$mtype = mime_content_type($file);
	} 
	return $mtype;
}

if (!empty($_FILES)) {

echo "<pre>";
print_r($_FILES);

echo get_mime_type($_FILES['file']['tmp_name']);
exit();
	
$file = $request->$_FILES('FILE_NAME_IN_REQUEST');
$mimeType = $file->getClientmimeType();

echo $mimeType;
exit();
 echo $error = $_FILES['file']['error'];
 switch($error) {
  case UPLOAD_ERR_OK:
   $response = handleUpload();
   break;

  case UPLOAD_ERR_INI_SIZE:
   $response = 'Error: file size exceeds the allowed.';
   break;

  case UPLOAD_ERR_PARTIAL:
   $response = 'Error: file was only partially uploaded.';
   break;

  case UPLOAD_ERR_NO_FILE:
   $response = 'Error: no file have been uploaded.';
   break;

  case UPLOAD_ERR_NO_TMP_DIR:
   $response = 'Error: missing temp directory.';
   break;

  case UPLOAD_ERR_CANT_WRITE:
   $response = 'Error: Failed to write file';
   break;

  case UPLOAD_ERR_EXTENSION:
   $response = 'Error: A PHP extension stopped the file upload.';
   break;

  default:
   $response = 'An unexpected error occurred; the file could not be uploaded.';
   break;
}
} else {
  $response = 'Error: Form is not uploaded.';
}
echo $response;
?>
<html>
<head>
	<title>PHP File Upload MIME Type Validation</title>
</head>
<body>
<form action='#' method="post" enctype="multipart/form-data">
	<input type="file" name="file" />
	<input type="Submit" value="Submit" />
</form>
</body>
</html>