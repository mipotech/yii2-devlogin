<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?=Yii::$app->name?></title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

        <style>
        body {background-color: #f1f3f3;}
        #content {width: 500px;}
        .panel-body {padding: 50px;}
        #login-form {padding: 0 30px;}
        .col-lg-offset-1.col-lg-11 {width: 100%; margin: 0px; text-align: center;}
        .btn-primary { width: 50%; font-size: 16px; font-weight: 700; }

        @media (max-width: 500px) {
            #content {width: 100%;}
            .panel-body {padding: 20px;}
        }
        </style>

        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="icon" href="/favicon.ico" />
    </head>

    <body>
        <?=$content?>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
