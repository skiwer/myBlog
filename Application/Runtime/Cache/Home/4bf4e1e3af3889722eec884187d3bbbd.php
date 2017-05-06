<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About</title>

    <!-- Bootstrap Core CSS -->
    <link href="/static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/static/css/clean-blog.min.css" rel="stylesheet">

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
        a {
            -webkit-tap-highlight-color: rgba(255, 0, 0, 0) !important;
        }
        
        .container p,
        .container li {
            font-family: 'Microsoft YaHei';
            letter-spacing: 1px;
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
    <header class="intro-header" style="background-image: url('/static/img/luca-1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>About</h1>
                        <hr class="small">
                        <span class="subheading">Live well,love lots,and laugh often.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <h3>关于我</h3>
                <p>Hey，欢迎来到我的博客，我是巫志旺，华南理工大学软件学院大三学生一枚(可惜已不是鲜肉...)， 坐标广州。
                </p>

                <p>
                    <ul>
                        <li>喜欢音乐，只叹没有一副好嗓子，那就跟着打节拍吧
                        </li>
                        <li>喜欢电影，感受不一样的人生，获得人生的感悟
                        </li>
                        <li>喜欢爬山，不只因为登顶时的神情气爽，还有沿途的风景
                        </li>
                        <li>喜欢新颖的技术，主要学习方向为web开发，前端开发小白
                        </li>
                    </ul>
                </p>
                <h3>关于我的博客</h3>
                <p>先说说skiwer，其实也没有什么特定的意义，只是想取个英文名，取自sky，暂且认为是“想要飞在天空的男人吧”。其实早就有了自己写个博客的想法，只是没有想好它到底该长什么样，直到遇到了clean-blog，觉得这界面很清爽，就按着这个主题自己改了。后台用的tp框架，部署起来有点坑，不过还好各种翻文档，好歹解决了。目前功能还在完善中，最主要的目的还是记录学习过程中遇到的问题，和大家做个分享，还请大家多指教~
                </p>
                <h3>联系我</h3>
                <p>大家有什么问题、意见之类的可以联系我啦，欢迎一起探讨，这是我的邮箱skiwer.me@gmail.com</p>
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

    <!-- Contact Form JavaScript -->
    <script src="/static/js/jqBootstrapValidation.js"></script>
    <script src="/static/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/static/js/clean-blog.min.js"></script>

</body>

</html>