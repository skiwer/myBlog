$(".like-number").click(function() {
    var id = $(this).parents(".post-preview").attr("id");
    var likeBtn = $(this);
    $.ajax({
        type: "POST",
        url: likeurl,
        dataType: "json",
        data: "id=" + id,
    }).done(function(data) {
        data = JSON.parse(data);
        if (!data.loged) {
            window.location.href = logurl;
        } else if (data.liked) {
            //赞个数减1
            likeBtn.find(".glyphicon").attr("class", "glyphicon glyphicon-heart-empty");
            likeBtn.find(".like-total").html(data.number);
            console.log(likeBtn.find(".likeNumber").html());
        } else {
            //赞个数加1
            likeBtn.find(".glyphicon").attr("class", "glyphicon glyphicon-heart");
            likeBtn.find(".like-total").html(data.number);
        }
    });
});