<?php include_once './header.php'; ?>
<body>


<form enctype="multipart/form-data" id="myform">



    <h3 class="btn-info" align="center">Upload images</h3>
  <div class="span5" width="200px" height="300px">
<img class="span5" src="images/Gallery.jpg"/>
  </div>

        <div align="right">
           <a  value="View Album" href="./uploadgrid.php"><h4 style="margin:0 5% 0 0;">View Album</h4></a>
        </div>

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
                    <input type="button" value="Upload" class="upload btn btn-info" id="uploadImg"/>
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



<div id="al" class="span12">


</div>
</form>
</body>
</html>