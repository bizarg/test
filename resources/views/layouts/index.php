<?php
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SERVER_HOST = "http://94.102.48.5:2222/CMD_PLUGINS/installatron";
        $_SERVER_USER = "bizarg";
        $_SERVER_PASS = "gYfSJHJatf";
        $_INSTALL_APPLICATION = "wordpress";
//        $_INSTALL_WHERE = "/home/bizarg/domains/installotron2.net/public_html/";
        $_INSTALL_WHERE = "http://www.installotron2.net/blog";

        // Create the query for the Installatron Install Automation API
        $query = $_SERVER_HOST."?api=json"
            ."&cmd=install"
            ."&application=".$_INSTALL_APPLICATION
            ."&url=".urlencode($_INSTALL_WHERE)
        ;
//        dump($query);
        // Send the query using CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".base64_encode($_SERVER_USER.":".$_SERVER_PASS) . "\n\r"));
        curl_setopt($curl, CURLOPT_URL, $query);
        $response = curl_exec($curl);
//        dd($response);
        // And we got a response. Check for errors.
        if ( $response === false )
        {
//            dd("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
//            error_log("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
            echo ("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
            return;
        }
        curl_close($curl);

        if ( strpos($response,"result") === false )
        {
//            dd("Installatron API Error: malformed response for `$query`: ".$response);
            error_log("Installatron API Error: malformed response for `$query`: ".$response);
            return;
        }

        // Response looks good. Parse it.
        $response = json_decode($response, true);

        if ( $response["result"] === false )
        {
//            dd("Installatron API Error: ".$response["message"]." (query: `$query`)");
            error_log("Installatron API Error: ".$response["message"]." (query: `$query`)");
            return;
        }

        // Output the final result!
        echo $response["message"];


    }

//    echo "<pre>";
//    echo $_SERVER['REQUEST_METHOD'];
//    echo "</pre>";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2"><h4>Domains</h4></div>
                <div class="col-md-2 col-md-offset-7">
                    <a class="btn btn-default" href="/" id="install">Install</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <form id="add_domains" class="form-horizontal" action="/" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name[]" value="">
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="form-group" id="button">
                    <div class="col-md-2 col-md-offset-8">
                        <a type="submit" class="btn btn-primary add">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
</div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>


        $(document).ready(function () {
//        var fields = 1;
//        addEventRemove();

            $('.add').on('click', function (e) {
                e.preventDefault();

                addFields();
            });

            $('#install').on('click', function(e){
                e.preventDefault();

                $('#add_domains').submit();
            });

            function addFields() {
                $('#button').before('            <div class="form-group">\
                <label class="col-md-2 control-label">Name</label>\
                <div class="col-md-6">\
                <input type="text" class="form-control" name="name[]" value="">\
                </div>\
                <div class="col-md-2">\
                <a class="btn btn-primary remove">\
                <span class="glyphicon glyphicon-minus"></span>\
                </a>\
                </div>\
                </div>')

                addEventRemove();
            }

            function addEventRemove(){
                $('.remove').on('click', function (e) {
                    e.preventDefault();
                    $(this).parent().parent().remove();
                });
            }

        });
    </script>
</body>
</html>