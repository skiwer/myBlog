$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: viewurl,
        data: "id=" + articleId,
        dataType: "json"
    }).done(function(status) {
        status = JSON.parse(status);
        if (status.isOk) {
            $(".view-number").html(status.viewNumber);
        }
    });
});

//评论框获得焦点触发事件
function checkLog() {
    $.ajax({
        type: "GET",
        url: logurl,
        async: false
    }).done(function(status) {
        if (!status) {
            window.location.href = loginurl;
        }
    });
}


//主评论提交触发事件
function mainCommentSubmit() {
    $.ajax({
        type: "GET",
        url: logurl,
        async: false
    }).done(function(status) {
        if (!status) {
            window.location.href = loginurl;
        } else {
            var val = $("#main-comment").val().trim();
            var postdata = { "comment": val, "id": articleId };

            if (val == "") {
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: mainUrl,
                    data: postdata,
                    dataType: "json"
                }).done(function(status) {
                    status = JSON.parse(status);
                    if (!status.isOk) {
                        login();
                    } else {
                        addMainComment(status.figureurl, status.nickname, status.time, status.comment, status.seq, status.id);
                        addCommentNumber(status.number);
                        $("#main-comment").val("");
                    }
                });
            }
        }
    });
}

//子评论提交触发事件
function subCommentSubmit(element) {
    //动态添加的评论框提交按钮点击触发事件
    var main = $(element);
    var value = $(".cmt-children").find(".comment").val();
    if (value.trim() == "") {
        return;
    } else {
        var id = main.attr('id');
        $.ajax({
            type: "POST",
            url: subUrl,
            data: { "id": id, "comment": value.trim(), "articleid": articleId },
            dataType: "json",
        }).done(function(status) {
            status = JSON.parse(status);
            if (!status.isOk) {
                window.location.href = loginurl;
            } else {
                addSubComment(status.u_nickname_from, status.u_nickname_to, status.figure_from, status.time, status.comment, status.is_from_main, status.id, main);
                addCommentNumber(status.number);
            }

        });
    }
}



//在页面添加发布的主评论
function addMainComment(figureurl, nickname, time, comment, sequence, id) {
    var html = `<div class="commentList">
                    <div class="cmt-main">
                                <span class="seq">` + sequence + `楼</span>
                                <div class="head">
                                    <img src="` + figureurl + `" alt="figure" />
                                </div>
                                <div class="cmt-content">` + comment + `</div>
                                <div class="cmt-meta">
                                    <span class="main-user">` + nickname + `</span>
                                    <span class="main-date">` + time + `</span>
                                    <span class="main-post-cmt" onclick="showMainFrame(this)" id="main-` + id + `">回复</span>
                                </div>

                    </div>
                    <hr>
                </div>`;
    $("#postComments").prepend(html);
}

//在页面中添加发布的子评论
function addSubComment(nickname_from, nickname_to, figure, time, comment, is_from_main, id, element) {
    var html;
    //回复自主评论
    if (is_from_main == 1) {
        html = `<div class="cmt-child">
                <hr>
                <div class="child-head">
                    <img src="` + figure + `" alt="figure" />
                </div>
                <div class="child-content">` + comment + `</div>
                <div class="child-meta">
                    <span class="answerby">` + nickname_from + `</span>
                    <span>回复</span>
                    <span class="answerto">` + nickname_to + `</span>
                    <span class="child-date">` + time + `</span>
                    <span class="child-post-cmt" onclick="showSubFrame(this)" id="frommain-` + id + `">回复</span>
                </div>
                </div>`;
        element.parents(".cmt-children").append(html);
        $("#postComments").find(".box").remove();
    } else {
        //回复自子评论
        html = `<div class="cmt-child">
                <hr>
                <div class="child-head">
                    <img src="` + figure + `" alt="figure" />
                </div>
                <div class="child-content">` + comment + `</div>
                <div class="child-meta">
                    <span class="answerby">` + nickname_from + `</span>
                    <span>回复</span>
                    <span class="answerto">` + nickname_to + `</span>
                    <span class="child-date">` + time + `</span>
                    <span class="child-post-cmt" onclick="showSubFrame(this)" id="fromsub-` + id + `">回复</span>
                </div>
                </div>`;
        element.parents(".cmt-children").append(html);
        $("#postComments").find(".box").remove();

    }

}

//增加评论数
function addCommentNumber(number) {
    $(".info").find(".comment-number").html(number);
    $("#Cnumber").html(number);
}

//主评论弹出框
function showMainFrame(element) {
    var main = $(element);
    $.ajax({
        type: "GET",
        url: logurl,
        async: false
    }).done(function(status) {
        if (!status) {
            window.location.href = loginurl;
        } else {
            var figure = status;
            var cmtlist = main.parents(".commentList");
            var l = cmtlist.find(".cmt-children").length;
            if (l == 0) {
                //当前回复无子回复
                $(".cmt-children").find(".box").remove();
                var html;
                html = `<div class="cmt-children">
                                    <div class="box">
                                    <hr>
                                            <div class="head">
                                                <img src="` + figure + `" alt="figure" />
                                            </div>
                                            <div class="cmt">
                                                <textarea onfocus="javascript:checkLog()" placeholder="你的评论可以一针见血" name="comment" class="comment" cols="100%" rows="3" tabindex="1"></textarea>
                                                <div class="sbm">
                                                    <button type="button" id="` + main.attr('id') + `" onclick="subCommentSubmit(this)" class="btn btn-default btn-xs submit">提交评论</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>`;
                cmtlist.find(".cmt-main").after(html);

            } else {
                var first = cmtlist.find(".cmt-children").children("div:first-child");
                if (first.hasClass('box')) {
                    if (cmtlist.find(".cmt-child").length == 0) {
                        cmtlist.find(".cmt-children").remove();
                    } else {
                        first.remove();
                    }
                } else {
                    $(".cmt-children").find(".box").remove();
                    var html;
                    html = `<div class="box">
                                        <hr>
                                            <div class="head">
                                                <img src="` + figure + `" alt="figure" />
                                            </div>
                                            <div class="cmt">
                                                <textarea onfocus="javascript:checkLog()" placeholder="你的评论可以一针见血" name="comment" class="comment" cols="100%" rows="3" tabindex="1"></textarea>
                                                <div class="sbm">
                                                    <button type="button" id="` + main.attr('id') + `"onclick="subCommentSubmit(this)" class="btn btn-default btn-xs submit">提交评论</button>
                                                </div>
                                            </div>
                                    </div>`;
                    var cmt = cmtlist.find(".cmt-children");
                    cmt.prepend(html);
                }
            }
        }
    });
}

//子评论弹出框
function showSubFrame(element) {
    var child = $(element);
    $.ajax({
        type: "GET",
        url: logurl,
        async: false
    }).done(function(status) {
        if (!status) {
            window.location.href = loginurl;
        } else {
            var figure = status;
            var cmtlist = child.parents(".commentList");
            var next = child.parents(".cmt-child").next();
            if (next.hasClass("box")) {
                next.remove();
            } else {
                $(".cmt-children").find(".box").remove();
                var html;
                html = `<div class="box">
                            <hr>
                            <div class="head">
                                <img src="` + figure + `" alt="figure" />
                            </div>
                            <div class="cmt">
                                <textarea onfocus="javascript:checkLog()" placeholder="你的评论可以一针见血" name="comment" class="comment" cols="100%" rows="3" tabindex="1"></textarea>
                                <div class="sbm">
                                    <button type="button" id="` + child.attr('id') + `" onclick="subCommentSubmit(this)" class="btn btn-default btn-xs submit">提交评论</button>
                                </div>
                            </div>
                        </div>`;
                var cmt = child.parents(".cmt-child");
                cmt.after(html);
            }
        }
    });
}

$(window).scroll(function() {
    $(".rollbar").css("display", "block");
    setTimeout(function() {
        $(".rollbar").css("display", "none");
    }, 2000);
});