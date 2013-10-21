<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="imageupload.js"></script>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="jcobb-basic-jquery-slider-8ffe118/bjqs.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="jcobb-basic-jquery-slider-8ffe118/demo.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="jcobb-basic-jquery-slider-8ffe118/js/bjqs-1.3.min.js"></script>

</head>
<body>


<form enctype="multipart/form-data" id="myform">

    <header style="background: linear-gradient(45deg, #020031 0%, #6D3353 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);">
        <div class="span3"><img class="img-circle" src="upload/Album2/images2.jpg"/></div>
        <div class="container">
            <h2 style="color:#ffffff">Multiple image upload</h2>

            <p class="lead text-info">This site uploads multiple images from user at a time and save that images to the
                album name provided by user.and also creates it's thumbnails.</p>

        </div>
    </header>

    <hr>


    <div class="row">
        <div class="span4 table-bordered" style="height:500px;overflow-y:auto;overflow-x:hidden;">
            <ul class="nav nav-list">
                <li class="nav-header"><h4>Album List</h4></li>
                <?php

                $dir = "upload/";

// Open a directory, and read its contents
                if (is_dir($dir)) {
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            if ($file != "." && $file != "..") {
                                $dirFiles[] = $file;
                            }

                        }
                        closedir($dh);
                    }
                }

                sort($dirFiles);
                for ($k = 0; $k < count($dirFiles); $k++) {
                    $path = "upload/" . $dirFiles[$k];
                    $var = $dirFiles[$k];
                    echo "<li><a href='#' onclick='imgclick(this);'  title='$dirFiles[$k]' name='$dirFiles[$k]' id='$dirFiles[$k]'>$dirFiles[$k]</a></li>";

                }

                ?>
            </ul>
        </div>

        <div class="span5 offset1">


            <label>Album Name:</label>

            <div class="control-group">
                <div class="controls">
                    <input type="text" name="unm" id="unm" placeholder="Album Name"/>


                </div>
                <div class="control-group">
                    <div class="controls">

                        <span class="btn btn-file">Upload <input class="offset" type="file" accept="image/*" multiple
                                                                 name="img[]" id="image"/></span>
                    </div>

                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Upload" class="upload"/>
                    </div>

                </div>
                <div class="control-group">
                    <div class="controls">
                        <progress class="progress progress-info progress-striped"
                                  style="margin-bottom: 9px;"></progress>
                    </div>

                </div>
                <div id="content_here_please">

                </div>
            </div>


</form>

<!--<div id="al" class="span12">

</div>-->






</body>
</html>
