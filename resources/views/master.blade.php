
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Social media feed">
    <meta name="author" content="d1am0ndback">

    <title>Social media feed</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
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
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Recent social media posts</h1>
                <div class="row">
                    @foreach($feeds as $index => $feed)
                    <div class="col-md-4 col-xs-12">

                        <p class="lead">{{ $feed['social_network'] }} - {{ $feed['pretty_time'] }}</p>

                        <ul class="list-unstyled">
                            <li class="lead">{{ $feed['user'] }}</li>
                            <li>{{ $feed['message'] }}</li>
                            <li><a href="{{ $feed['url'] }}">See this post</a></li>
                        </ul>
                    </div>
                    @if($index % 3 == 2)
                    <div class="clearfix"></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</body>

</html>