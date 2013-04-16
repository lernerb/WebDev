<?php
header('Content-type: text/javascript');

if(preg_match('/(.*localhost.*)|(.*dev.*)/', $_SERVER['HTTP_HOST'])){
    include("../fineuploader/jquery.fineuploader-3.4.1.js");
}else{
    include("../fineuploader/jquery.fineuploader-3.4.1.min.js");
}

?>
$(function(){
    $("#upload").fineUploader({
        request:{
            endpoint: '/includes/upload.php'
        }
    });

});