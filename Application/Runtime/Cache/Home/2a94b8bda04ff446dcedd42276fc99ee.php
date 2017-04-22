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
    <style>
        #main .tag {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
            color: #333333;
            padding: 5px 5px;
            border: none;
        }
        
        #main .tag:hover,
        #main .tag:active,
        #main .tag:focus {
            color: #fff;
            background-color: #8080c8;
            border-radius: 2px;
        }
        
        .view,
        .like,
        .comment {
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }
        
        .view>span,
        .like>span,
        .comment>span {
            text-decoration: none;
            color: #333333;
            font-size: 15px;
            margin-left: 6px;
        }
        
        .like:hover .glyphicon-heart-empty {
            font-size: 18px;
        }
        
        .comment:hover .glyphicon-comment {
            font-size: 18px;
        }
    </style>
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
                    <li>
                        <a href="<?php echo U('Post/index');?>">Post</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Contact/index');?>">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('/static/img/home-bg.jpg')">
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

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div id="main" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if(is_array($outlines)): $k = 0; $__LIST__ = $outlines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="post-preview">
                        <a href="<?php echo U('ShowArticle/show','id='.$v['id']);?>">
                            <h2 class="post-title">
                                <?php echo ($v["title"]); ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?php echo ($v["outline"]); ?>
                            </h3>
                        </a>
                        <button type="button" class="btn btn-default btn-xs tag">
	                        <span class="glyphicon glyphicon-tags"></span> <?php echo ($v["tag"]); ?>
                        </button>
                        <p class="post-meta">Posted by <a href="#">Skiwer</a> on <?php echo ($v["date"]); ?></p>
                        <div>
                            <a class="view diabled"><span class="glyphicon glyphicon-eye-open"></span><span class="viewNumber">200<span></a>
                            <a class="like"><span class="glyphicon glyphicon-heart-empty"></span><span class="likeNumber">2</a>
                            <a class="comment"><span class="glyphicon glyphicon-comment"></span><span class="commentNumber">2</a>
                        </div>
                    </div>
                    <hr><?php endforeach; endif; else: echo "" ;endif; ?>


                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/static/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/static/js/jqBootstrapValidation.js"></script>
    <script src="/static/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/static/js/clean-blog.min.js"></script>

</body>

</html>