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

    <link href='/static/css/show.css' rel='stylesheet' type='text/css'>
    <!-- Custom Fonts -->
    <link href="/static/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='/static/css/font.css' rel='stylesheet' type='text/css'>
    <link href='/static/css/open-font.css' rel='stylesheet' type='text/css'>
    <style>
        #content {
            font-family: 'Microsoft YaHei';
            letter-spacing: 1px;
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
    <header class="intro-header" style="background-image: url('/static/img/garrhet-sampson-1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?php echo ($detail["title"]); ?></h1>
                        <!--<h2 class="subheading"><?php echo ($detail["outline"]); ?></h2>-->
                        <span class="meta">Posted by <a href="#">Skiwer</a> on <?php echo ($detail["date"]); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h1 id="title"><?php echo ($detail["title"]); ?></h1>
                    <div class="info">
                        <span class="date"><?php echo ($detail["date"]); ?></span>
                        <span class="tag">分类：<?php echo ($detail["tag"]); ?></span>
                        <span class="like">阅读(<span class="view-number"><?php echo ($detail["view_number"]); ?></span>)</span>
                        <span class="like">赞(<?php echo ($detail["like_number"]); ?>)</span>
                        <span class="comment">评论(<span class="comment-number"><?php echo ($detail["comment_number"]); ?></span>)</span>
                    </div>
                    <div id="content"><?php echo ($detail["content"]); ?></div>
                </div>
            </div>
        </div>
    </article>


    <article>
        <div class="container">
            <div class="row" id="com">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h1 id="Ctitle">评论<span id="Cnumber"><?php echo ($detail["comment_number"]); ?></span></h1>
                    <hr>
                    <div class="box">
                        <div class="head">
                            <?php if(empty($nickname)): ?><img src="/static/img/dabai.jpg" alt="figure" />
                                <?php else: ?>
                                <img src="<?php echo ($figure); ?>" alt="figure" /><?php endif; ?>
                        </div>
                        <div class="cmt">
                            <textarea onfocus="javascript:checkLog()" id="main-comment" placeholder="你的评论可以一针见血" name="comment" class="comment" cols="100%" rows="3" tabindex="1"></textarea>
                            <div class="sbm" id="main-submit">
                                <button type="button" onclick="mainCommentSubmit()" class="btn btn-default btn-xs submit">提交评论</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" id="postComments">
                    <?php if(is_array($comments)): $key = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><div class="commentList">
                            <div class="cmt-main">
                                <span class="seq"><?php echo count($comments)-$key+1;?>楼</span>
                                <div class="head">
                                    <img src="<?php echo ($value['figure_url']); ?>" alt="figure" />
                                </div>
                                <div class="cmt-content"><?php echo ($value["comment"]); ?></div>
                                <div class="cmt-meta">
                                    <span class="main-user"><?php echo ($value["u_nickname"]); ?></span>
                                    <span class="main-date"><?php echo ($value["date"]); ?></span>
                                    <span class="main-post-cmt" id="main-<?php echo ($value['id']); ?>" onclick="javascript:showMainFrame(this)">回复</span>
                                </div>

                            </div>
                            <?php if(!empty($value['subComments'])): ?><div class="cmt-children">
                                    <?php if(is_array($value['subComments'])): $k = 0; $__LIST__ = $value['subComments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="cmt-child">
                                            <hr>
                                            <div class="child-head">
                                                <img src="<?php echo ($v['figure_from']); ?>" alt="figure" />
                                            </div>
                                            <div class="child-content"><?php echo ($v["comment"]); ?></div>
                                            <div class="child-meta">
                                                <span class="answerby"><?php echo ($v["u_nickname_from"]); ?></span>
                                                <span>回复</span>
                                                <span class="answerto"><?php echo ($v["u_nickname_to"]); ?></span>
                                                <span class="child-date"><?php echo ($v["date"]); ?></span>
                                                <?php if($v['is_from_main'] == 1): ?><span class="child-post-cmt" id="frommain-<?php echo ($v['id']); ?>" onclick="javascript:showSubFrame(this)">回复</span>
                                                    <?php else: ?>
                                                    <span class="child-post-cmt" id="fromsub-<?php echo ($v['id']); ?>" onclick="javascript:showSubFrame(this)">回复</span><?php endif; ?>

                                            </div>

                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div><?php endif; ?>
                            <hr>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>





                </div>
            </div>
        </div>
    </article>


    <div class="rollbar" style="display: block;">
        <ul>
            <li>
                <a href="#com">
                    <i class="fa fa-comments"></i>
                </a>
                <h6>去评论<i></i></h6>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-angle-up"></i>
                </a>
                <h6>去顶部<i></i></h6>
            </li>
        </ul>
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
                    <p class="copyright text-muted">Copyright &copy; skiwer.me</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/static/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var root = "";
        var logurl = "<?php echo U('Index/hasloged');?>";
        var loginurl = "<?php echo U('Index/login');?>";
        var mainUrl = "<?php echo U('ShowArticle/maincomment');?>";
        var subUrl = "<?php echo U('ShowArticle/subcomment');?>";
        var articleId = "<?php echo ($detail['id']); ?>";
        var viewurl = "<?php echo U('ShowArticle/addpageview');?>";
    </script>
    <script src="/static/js/show.js"></script>
    <!-- Contact Form JavaScript -->
    <script src="/static/js/jqBootstrapValidation.js"></script>
    <script src="/static/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/static/js/clean-blog.min.js"></script>

</body>

</html>