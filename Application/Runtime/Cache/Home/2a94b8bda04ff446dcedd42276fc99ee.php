<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="/static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/static/css/clean-blog.css" rel="stylesheet">
    <link href="/static/css/home.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/static/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='/static/css/font.css' rel='stylesheet' type='text/css'>
    <link href='/static/css/open-font.css' rel='stylesheet' type='text/css'>

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
    <header class="intro-header" style="background-image: url('/static/img/bright-1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Skiwer's Blog</h1>
                        <hr class="small">
                        <span class="subheading">Time is a bird for ever on the wing. </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div id="main" class="col-lg-8 col-md-8">
                <?php if(is_array($outlines)): $k = 0; $__LIST__ = $outlines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="post-preview" id="<?php echo ($v["id"]); ?>">
                        <div class="post-img">
                            <a href="<?php echo U('ShowArticle/show','id='.$v['id']);?>"><img src="/static/img/dabai.jpg" /></a>
                        </div>
                        <div class="post-main-content">
                            <header class="post-title">
                                <h2>

                                    <a href="<?php echo U('ShowArticle/show','id='.$v['id']);?>"><?php echo ($v["title"]); ?></a>
                                    <a class="post-tag"><?php echo ($v["tag"]); ?></a>
                                </h2>
                            </header>
                            <div class="post-outline"><?php echo ($v["outline"]); ?></div>

                        </div>
                        <div class="post-interact">
                            <a class="date" href="<?php echo U('ShowArticle/show','id='.$v['id']);?>"><i class="glyphicon glyphicon-time"></i><span><?php echo ($v["date"]); ?></span></a>
                            <a class="post-user"><i	class="glyphicon glyphicon-user"></i><span>skiwer</span></a>
                            <a class="view-number"><i class="glyphicon glyphicon-eye-open"></i><span>阅读</span><span class="view-total"><?php echo ($v["view_number"]); ?></span></a>
                            <a class="like-number">
                                <?php if($v['liked'] == true): ?><i class="glyphicon glyphicon-heart"></i>
                                    <?php else: ?><i class="glyphicon glyphicon-heart-empty"></i><?php endif; ?><span>赞</span><span class="like-total"><?php echo ($v["like_number"]); ?></span></span>
                            </a>
                            <a class="comment-number" id="<?php echo ($v["id"]); ?>"><i class="glyphicon glyphicon-comment"></i><span>评论</span><span class="comment-total"><?php echo ($v["comment_number"]); ?></span></a>
                            <a class="view-detail" href="<?php echo U('ShowArticle/show','id='.$v['id']);?>"><span>阅读全文</span><i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>

                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div id="aside" class="col-lg-4 col-md-4">
                <div id="tags">
                    <h4 class="tags-title">标签</h4>
                    <ul class="all-tags">
                        <?php if(is_array($tags)): $k = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li><a><?php echo ($v); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>




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

    <!-- jQuery -->
    <script src="/static/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        var likeurl = "<?php echo U('Index/like');?>";
        var logurl = "<?php echo U('Index/login');?>";
        var logedurl = "<?php echo U('Index/hasloged');?>";
        $(".comment-number").click(function() {
            var id = $(this).attr("id");
            var url = "<?php echo U('showArticle/show');?>?id=" + id;
            $.ajax({
                type: "GET",
                url: logedurl
            }).done(function(status) {
                if (!status) {
                    window.location.href = logurl;
                } else {
                    window.location.href = url + '#com';
                }
            });
        });
    </script>
    <script src="/static/js/home.js"></script>
    <!-- Contact Form JavaScript -->
    <script src="/static/js/jqBootstrapValidation.js"></script>
    <script src="/static/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/static/js/clean-blog.min.js"></script>

</body>

</html>