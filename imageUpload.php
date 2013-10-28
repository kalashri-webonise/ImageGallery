<?php include_once './header.php'; ?>
<body>


<form enctype="multipart/form-data" id="myform">

    <header style="background: linear-gradient(45deg, #020031 0%, #6D3353 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);">
        <div class="span3"><img class="img-circle" src="img_gallery.jpg"/></div>
        <div class="container">
            <h2 style="color:#ffffff">Image Gallery</h2>

            <p class="lead text-info">This site uploads multiple images from user at a time and save that images to the
                album name provided by user.and also creates it's thumbnails.</p>

        </div>
    </header>

    <h3 class="btn-info" align="center">Upload images</h3>
  <div class="span5" width="200px" height="300px">
<img class="span5" src="Gallery.jpg"/>
  </div>
    <div class="span5 offset2">


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
                    <input type="button" value="Upload" class="upload" id="uploadImg"/>
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
            <div class="control-group">
                <div class="controls">
                    <input type="button" value="View Album" class="btn btn-info" onclick="showAlbum();"/>
                </div>

            </div>
        </div>
        <script type="text/javascript">
            function showAlbum() {

                location.href = "./uploadgrid.php";


            }
        </script>



<div id="al" class="span12">


</div>
</form>
</body>
</html>