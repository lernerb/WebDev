<?php
header('Content-type: text/javascript');

if(preg_match('/(.*localhost.*)|(.*dev.*)/', $_SERVER['HTTP_HOST'])){
	include("./jquery/jquery-1.9.1.js");
	include("./select2/select2-release-3.2/select2.js");
	include("./global.js");
}else{
	include("./jquery/jquery-1.9.1.min.js");
	include("./select2/select2-release-3.2/select2.min.js");
	include("./global.js");
}