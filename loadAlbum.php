<?php

$con = mysqli_connect("localhost", "root", "webonise6186", "imageGallery");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//echo $_GET['imageNm'];
if (isset($_GET['imageNm'])) {
    $dir = "upload/" . $_GET['imageNm'];


// Open a directory, and read its contents
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != ".." && $file != "tmb") {
                    $dirFiles[] = $file;
                }

            }
            closedir($dh);
        }
    }

    sort($dirFiles);
    $dirImg = json_encode($dirFiles);
    print_r($dirImg);
}


if (isset($_POST['view']) && isset($_POST['alid']) && isset($_POST['albnm'])) {
    $idnm = $_POST['alid'];
    $del = 'DELETE FROM image_collection WHERE idalbum_collection ="' . $idnm . '"';
    $resultimg = mysqli_query($con, $del) or die("not img selected");
    if (!$resultimg) {
        print_r("images not deleter");
    }
    $imagec = 'DELETE FROM album_collection WHERE idalbum_collection ="' . $idnm . '"';
    $result = mysqli_query($con, $imagec) or die("not res selected");
    if (!$result) {
        print_r("album not deleter");
    }


    $dir = "upload/" . trim($_POST['albnm']) . "/";

    if (is_dir($dir)) {

        foreach (scandir($dir) as $item) {
            if ($item != "." && $item != ".." && $item != "tmb") {
                unlink($dir . $item);
            } else if ($item == "tmb") {
                foreach (scandir($dir . "tmb/") as $i) {
                    if ($item != "." && $item != "..") {
                        unlink($dir . "tmb/" . $i);
                    }
                }
                rmdir($dir . "tmb");
            }
        }
        rmdir($dir);
    }
}


if (isset($_POST['idedit']) && isset($_POST['albumid']) && isset($_POST['albumnm']) && isset($_POST['updatedName'])) {
    if ($_POST['updatedName'] != null || $_POST['updatedName'] != '') {
        $up = 'UPDATE album_collection SET album_name ="' . $_POST['updatedName'] . '" WHERE idalbum_collection="' . $_POST['albumid'] . '"';
        $resultimg = mysqli_query($con, $up) or die("not img selected");
        if (!$resultimg) {
            print_r("images not updated");
        } else {
            echo "album name is updated";
        }


        chmod("upload/", 0777);
        rename("upload/" . trim($_POST['albumnm']), "upload/" . trim($_POST['updatedName'])) or die("not editing");

    } else {
        echo"Please specify album name to  update";
    }
}

if (isset($_POST['albumIdView'])) {
    $view = 'SELECT image_name FROM image_collection WHERE idalbum_collection ="' . $_POST['albumIdView'] . '"';
    $resultView = mysqli_query($con, $view) or die("not img selected");
    if (!$resultView) {
        print_r("images not selected");
    }
    while ($albmV[] = mysqli_fetch_array($resultView, MYSQL_NUM)) {
        $viewImg = $albmV;

    }
    $v = json_encode($viewImg);
    print_r($v);
}


if (isset($_POST['imNm']) && isset($_POST['imgalid']) && isset($_POST['nm'])) {
    $delim = 'DELETE FROM image_collection WHERE idalbum_collection =' . $_POST['imgalid'] . ' AND image_name="' . $_POST['imNm'] . '"';
    $resultdimg = mysqli_query($con, $delim) or die("img not deleted");
    if (!$resultdimg) {
        print_r("images not deleted");
    }
    $dir = "upload/" . trim($_POST['nm']) . "/";

    if (is_dir($dir)) {

        foreach (scandir($dir) as $it) {
            if ($it != "." && $it != ".." && $it != "tmb") {
                if ($it == $_POST['imNm']) {
                    unlink($dir . $it) or die("not deleted");
                }
            } else if ($it == "tmb") {
                foreach (scandir($dir . "tmb/") as $l) {
                    if ($it != "." && $it != "..") {
                        if ($l == $_POST['imNm']) {
                            unlink($dir . "tmb/" . $l);
                        }
                    }
                }

            }
        }

    }


}

if (isset($_POST['albumIdV'])) {
    $viewI = 'SELECT image_name FROM image_collection WHERE idalbum_collection ="' . $_POST['albumIdV'] . '"';
    $resView = mysqli_query($con, $viewI) or die("not img selected");
    if (!$resView) {
        print_r("images not selected");
    }
    while ($alb[] = mysqli_fetch_array($resView, MYSQL_NUM)) {
        $viewI = $alb;

    }
    $vI = json_encode($viewI);
    print_r($vI);
}

mysql_close($con);
?>
