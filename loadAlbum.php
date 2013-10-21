<?php
//echo $_GET['imageNm'];
if(isset($_GET['imageNm']))
{
$dir = "upload/".$_GET['imageNm'];


// Open a directory, and read its contents
if (is_dir($dir))
{
    if ($dh = opendir($dir))
    {
        while (($file = readdir($dh)) !== false)
        {
            if ($file != "." && $file != ".." && $file!="tmb")
            {
                $dirFiles[] = $file;
            }

        }
        closedir($dh);
    }
}

sort($dirFiles);
    $dirImg=json_encode($dirFiles);
    print_r($dirImg);
}
?>