$(function(){
    $(".delete_btn").click(function(){
        var delete_huh = confirm("Are you sure that you want to delete this photo?");
        if(delete_huh){
            var loc = location.pathname + location.search + "&delete=true";
            var failurefunc = function(){
                alert("Delete failed. Please try again later");
            }
            try{
                console.info(loc);
                $.ajax({
                    type:"POST",
                    url: loc,
                    success:function(data){
                        var $data = $($.parseHTML(data));
                        var $resp = $("#response", $data);
                        var resp = JSON.parse($resp.text());
                        if (resp.success){
                            location.href="/viewPhotos.php?gameid=" + resp.game_id;
                            window.thisWasATriumph = true;
                        }
                    },
                    failure: failurefunc,
                    complete: function(jqxhr, status) {
                        if (!window.thisWasATriumph){
                            failurefunc();
                        }
                    }
                });
            } catch (e){
                failurefunc();
            }
        }
    });
});