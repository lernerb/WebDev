<?php


require_once '../includes/qqFileUploader.php';

$uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array("jpeg", "jpg", "png", "gif", "bmp");

// Specify max file size in bytes. (10 MB)
$uploader->sizeLimit = 15 * 1024 * 1024;

// Specify the input name set in the javascript.
$uploader->inputName = 'qqfile';

// If you want to use resume feature for uploader, specify the folder to save parts.
//$uploader->chunksFolder = 'chunks';

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
//$result = $uploader->handleUpload('');

// To save the upload with a specified name, set the second parameter.
$result = $uploader->handleUpload('../uploads', uniqid());

// To return a name used for uploaded file you can use the following line.
$result['uploadName'] = $uploader->getUploadName();

header("Content-Type: text/plain");
echo json_encode($result);
