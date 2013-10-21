<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <script>
			$(document).ready(function () { 
				$('body').on('click', '.upload', function(){
				
					var form = new FormData($('#myform')[0]);
					
				
					$.ajax({
					    url: 'image_send.php',
					    type: 'POST',
					    xhr: function() {
					        var myXhr = $.ajaxSettings.xhr();
					        if(myXhr.upload){
					            myXhr.upload.addEventListener('progress',progress, false);
					        }
					        return myXhr;
					    },
						
					    success: function (res) {
							$('#content_here_please').html(res);
						},
					
					    data: form,
					    cache: false,
					    contentType: false,
					    processData: false
					});
				});
			});	
			
			
			function progress(e){
			    if(e.lengthComputable){
		
			        $('progress').attr({value:e.loaded,max:e.total});
			    }
			}
		</script>

</head>
<body>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>

		<form enctype="multipart/form-data" id="myform">

            <div class="hero-unit">
                <h1>Multiple image upload</h1>

                <p>This site uploads multiple images from user at a time and save that images to the album name provided by user.and also creates it's thumbnails.</p>

                <a href="imageUpload.php" class="btn btn-large btn-success">Get Started</a>
            </div>
            <div class="row">
            <div class="span9"></div>

            </div>



            <label>Album Name:</label><input type="text" name="unm" id="unm" />
			<br>
			<input type="file" accept="image/*" multiple name="img[]" id="image" /> 
			<br>
			<input type="button" value="Upload images" class="upload" />
		</form>
		<progress value="0" max="100"></progress>
		<hr>
		<div id="content_here_please">
	
	    </div>
	     
			 <h2>Album List</h2>
	        <?php
	      
	        $dir = "upload/";

			// Open a directory, and read its contents
			if (is_dir($dir))
			{  
			  if ($dh = opendir($dir))
			  {
				while (($file = readdir($dh)) !== false)
				{
					if ($file != "." && $file != "..") 
					{
						$dirFiles[] = $file;  
					}
				
				}
				closedir($dh);
			  }
			}
			
			 	sort($dirFiles);  
				for($k=0;$k<count($dirFiles);$k++)
				{  $path="upload/".$dirFiles[$k];
					
					echo "<li><a href='$path'  title='$dirFiles[$k]' onclick='loadImg();'>$dirFiles[$k]</a></li>";
					
					//it is not working
				}
	         ?>


<div id="banner-slide">

    <!-- start Basic Jquery Slider -->
    <ul class="bjqs">
        <li><a href=""><img src="img/banner01.jpg" title="Automatically generated caption"></a></li>
        <li><img src="img/banner02.jpg" title="Automatically generated caption"></li>
        <li><img src="img/banner03.jpg" title="Automatically generated caption"></li>
    </ul>
    <!-- end Basic jQuery Slider -->

</div>
<!-- End outer wrapper -->

<!-- attach the plug-in to the slider parent element and adjust the settings as required -->
<script class="secret-source">
    jQuery(document).ready(function($) {

        $('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true
        });

    });
</script>




	</body>
</html>

