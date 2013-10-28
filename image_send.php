<?php

$con = mysqli_connect("localhost", "root", "webonise6186", "imageGallery");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$thegoodstuf = '';

if (isset($_POST['unm'])) {
    $albn = 'SELECT idalbum_collection FROM album_collection where album_name="' . $_POST['unm'] . '"';
    $var = mysqli_query($con, $albn);

    if (mysqli_num_rows($var) == 0) {
        $sql = "INSERT INTO album_collection(album_name,creation_date)VALUES('$_POST[unm]',NOW())";
        if (!mysqli_query($con, $sql)) {
            die('Error While Creating Table: ' . mysqli_error($con));
        }

    }


    for ($i = 0; $i < count($_FILES["img"]["name"]); $i++) {

        $imagec = 'SELECT idalbum_collection FROM album_collection where album_name="' . $_POST['unm'] . '"';
        $result = mysqli_query($con, $imagec) or die("not res selected");

        $name = $_FILES["img"]["name"][$i];
        $temp_nm = $_FILES["img"]["tmp_name"][$i];

        $pathInfo = pathinfo($name);
        $fnm = $pathInfo['filename'];

        while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            $sqlimg1 = 'INSERT INTO image_collection(idalbum_collection,image_name)VALUES("' . $row[0] . '","' . $name . '")' or die("not inserted");
            mysqli_query($con, $sqlimg1);
        }


        if (file_exists("upload/" . $_POST['unm'])) {

            copy($_FILES["img"]["tmp_name"][$i], "upload/" . $_POST['unm'] . "/" . $_FILES["img"]["name"][$i]) or die("copy not done");


            if (!file_exists("upload/" . $_POST['unm'] . "/tmb")) {
                mkdir("upload/" . $_POST['unm'] . "/tmb/", 0777, true);
            }
            $image = new Imagick($temp_nm);
            $image->thumbnailImage(90, 90);
            $image->writeImages("upload/" . $_POST['unm'] . "/tmb/" . $name, true);

            $imgNm = $_POST['unm'] . "/tmb/" . $name;

        } else {
            $oldumask = umask(0);

            mkdir("upload/" . $_POST['unm'], 0777, true);
            umask($oldumask);

            copy($_FILES["img"]["tmp_name"][$i], "upload/" . $_POST['unm'] . "/" . $_FILES["img"]["name"][$i])or die("copy not done");

            $oldumask = umask(0);
            $num = trim($_POST['unm']);
            mkdir("upload/" . $_POST['unm'] . "/tmb/", 0777, true);
            umask($oldumask);
            $image = new Imagick($temp_nm);
            $image->thumbnailImage(90, 90);
            $image->writeImages("upload/" . $num . "/tmb/" . $name, true);
            $imgNm = $num . "/tmb/" . $name;

        }

        $thegoodstuf .= "<img src='upload/$imgNm' title='$name' />";

    }


} else {
    echo "please specify album name";
}

echo $thegoodstuf;

mysqli_close($con);

?>
