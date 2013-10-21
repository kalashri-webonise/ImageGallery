<?php

   
    $succeed = 0;
    $error = 0;
    $thegoodstuf = ''; 
 
	if(isset($_POST['unm']))
	{    

		for($i=0;$i<count($_FILES["img"]["name"]);$i++) 
		{

				$name = $_FILES["img"]["name"][$i];  
				$temp_nm=$_FILES["img"]["tmp_name"][$i];
			  
				
				$pathInfo = pathinfo($name);
				$fnm=$pathInfo['filename'];
			
		   if(file_exists("upload/".$_POST['unm']))
			{
				 copy($_FILES["img"]["tmp_name"][$i],"./upload/".$_POST['unm']."/". $_FILES["img"]["name"][$i]);
			  
			     	 mkdir("upload/".$_POST['unm']."/tmb/",0777,true);
					$image = new Imagick($temp_nm);
					$image->thumbnailImage(90, 90);
					$image->writeImages("upload/".$_POST['unm']."/tmb/".$fnm, true);
		   
					$imgNm=$_POST['unm']."/tmb/".$fnm;
		   
			}
		  else
			{  
				mkdir("upload/".$_POST['unm'],0777,true);
				copy($_FILES["img"]["tmp_name"][$i],"./upload/".$_POST['unm']."/". $_FILES["img"]["name"][$i]);
			
				 mkdir("upload/".$_POST['unm']."/tmb/",0777,true);
					$image = new Imagick($temp_nm);
					$image->thumbnailImage(90, 90);
					$image->writeImages("upload/".$_POST['unm']."/tmb/".$fnm, true);
					$imgNm=$_POST['unm']."/tmb/".$fnm;
			  
			}
		
				$thegoodstuf .= "<img src='./upload/$imgNm' title='$name' />";
	   
		}

}
else
{
  echo "please specify album name";	
}

    echo $thegoodstuf;
   

?>
