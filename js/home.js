$(document).ready(function(){
    $(".toast#show").toast("show");
    toastList.forEach(toast => toast.show()); 
    let start = 0;
    const offset = 5;
    $(".articles article").hide();
    showArticles(start, offset);

    $("#next").click(function(){
        start+= offset;
        $(".articles article").hide();
        showArticles(start, offset);
        if($(".articles article:visible").length == 0) {
            start-= offset;
            showArticles(start, offset);
        }
    });

    $("#prev").click(function(){
        if(start - offset >= 0) {
            start-= offset;
            $(".articles article").hide();
            showArticles(start, offset);
        }
    });
});

function showArticles(start, offset) {
    $(".articles article").each(function(e) {
        if (e>=start && e < start+offset) {
            $(this).show();
        }
    });
}