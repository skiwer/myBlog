<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sample Post</title>

    <!-- Bootstrap Core CSS -->
    <link href="/static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/static/css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/static/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='/static/css/font.css' rel='stylesheet' type='text/css'>
    <link href='/static/css/open-font.css' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="/static/showdown/dist/showdown.min.js"></script>
    <style>
        a {
            -webkit-tap-highlight-color: rgba(255, 0, 0, 0) !important;
        }
        
        #textInput {
            border-radius: 5px;
        }
        
        #preview {
            word-break: break-all;
            border-style: none;
            border-radius: 5px;
            background-color: rgb(240, 240, 240);
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo U('Index/index');?>">Skiwer</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo U('Index/index');?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo U('About/index');?>">About</a>
                    </li>
                    <?php if($isadmin == true): ?><li>
                            <a href="<?php echo U('Post/index');?>">Post</a>
                        </li><?php endif; ?>
                    <?php if(empty($nickname)): ?><li>
                            <a href="<?php echo U('Index/login');?>">Login</a>
                        </li>
                        <?php else: ?>
                        <li>
                            <a href="<?php echo U('Index/logout');?>">Logout</a>
                        </li><?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('/static/img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>Man must explore, and this is exploration at its greatest</h1>
                        <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                        <span class="meta">Posted by <a href="#">skiwer</a> on August 24, 2014</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">文章标题：</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="title" name="title" placeholder="请输入标题">
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-sm-2 control-label">标签：</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="tag" name="tag" placeholder="请输入标签">
            </div>
        </div>
        <div class="form-group">
            <label for="outline" class="col-sm-2 control-label">概要：</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="outline" name="outline" placeholder="请输入文章概要">
            </div>
        </div>
        <div class="form-group">
            <label for="textInput" class="col-sm-2 control-label">文章内容：</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-xs-6 col-md-5 col-sm-3">
                        <textarea id="textInput" name="content" oninput="update()" rows="20" cols="45"></textarea>
                    </div>
                    <div class="col-sm-offset-1 col-xs-6 col-md-5 col-sm-3" id="preview">
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-6">
                <button id="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="https://github.com/skiwer" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; skiwer.me 2017</p>
                </div>
            </div>
        </div>
    </footer>


    <script type="text/javascript">
        function update() {
            var text = document.getElementById("textInput").value;
            var converter = new showdown.Converter();
            var html = converter.makeHtml(text);
            document.getElementById("preview").innerHTML = html;
        }
    </script>

    <!-- jQuery -->
    <script src="/static/vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        $("#submit").click(function(e) {
            e.preventDefault();
            var title = $("#title").val();
            var tag = $("#tag").val();
            var outline = $("#outline").val();
            var content = $("#textInput").val();
            // console.log(title, tag, outline, content);
            // console.log("dsadasd");
            if (title == "") {
                alert("请输入标题！");
                return;
            } else if (tag == "") {
                alert("请输入标题！");
                return;
            } else if (outline == "") {
                alert("请输入标题！");
                return;
            } else if (content == "") {
                alert("请输入标题！");
                return;
            } else {

                var markdownData = $("#preview").html();
                var tmp = $("<textarea name='markdownContent'></textarea>");
                tmp.val(markdownData);
                console.log(tmp);
                console.log(markdownData);
                $("form").append(tmp);
                var formData = $("form").serialize();
                // console.log(formData);
                // return;
                $.ajax({
                    type: "POST",
                    url: '<?php echo U("Post/post");?>',
                    data: formData
                }).done(function(msg) {
                    if (msg) {
                        alert("发布成功！");
                        window.location.href = '<?php echo U("Index/index");?>';
                    } else {
                        alert("发布失败！");
                    }
                });
            }
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/static/js/jqBootstrapValidation.js"></script>
    <script src="/static/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/static/js/clean-blog.min.js"></script>

</body>

</html>