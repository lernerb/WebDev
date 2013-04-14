$(function() { 
	$("#gamesList").select2(); 

	$(".loginBtn").click(function(){
		var fullPath = location.href.toString(),
			serverUrl = location.origin.toString();
		var path = fullPath.substring( serverUrl.length );
		window.location.href="/login.php?login&back=" + path;
	});
    $(".logoutBtn").click(function(){
        var fullPath = location.href.toString(),
            serverUrl = location.origin.toString();
        var path = fullPath.substring( serverUrl.length );
        window.location.href="/login.php?logout&back=/";
    });

});
