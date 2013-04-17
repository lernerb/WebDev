<?php
header('Content-type: text/javascript');

if(preg_match('/(.*localhost.*)|(.*dev.*)/', $_SERVER['HTTP_HOST'])){
    include("../fineuploader/jquery.fineuploader-3.4.1.js");
    include("../jquery.validate/1.11.0.js");
}else{
    include("../fineuploader/jquery.fineuploader-3.4.1.min.js");
    include("../jquery.validate/1.11.0.min.js");
}

?>
$(function(){
    $("#upload").fineUploader({
        request:{
            endpoint: '/includes/upload.php'
        },
        multiple: false,
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png', 'bmp'],
            sizeLimit: 15 * 1024 * 1024
        },
    })
    .on('complete', function(event, id, name, responseJSON){
        showStepTwo(responseJSON.uploadName);
    });

    var showStepTwo = function(photoId){
        $("#step1").hide();

        var img = $("#photo_img").attr("src", "/uploads/" + photoId);

        $("#photo_info #photo_unique_id").attr("value", photoId);

        $("#step2").show();
    }

    $("#photo_info").validate();

    $("#photo_game_id").select2();

    if (hasErrors && photo_id){
        showStepTwo(photo_id);
    }

});