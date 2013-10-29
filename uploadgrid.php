<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 25/10/13
 * Time: 1:37 PM
 * To change this template use File | Settings | File Templates.
 */
$con = mysqli_connect("localhost", "root", "webonise6186", "imageGallery");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$albn = 'SELECT album_name, idalbum_collection FROM album_collection';
$res = mysqli_query($con, $albn);
if (!$res) {
    die('Could not get data: ' . mysql_error());
}
$a = array();
while ($albm = mysqli_fetch_array($res, MYSQL_ASSOC)) {
    $a[] = $albm;

}


?>
<?php include './header.php'; ?>



<body>
<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript" language="javascript">
    $(function () {
        $('#foo2').carouFredSel({
            auto:false,
            prev:'#prev2',
            next:'#next2',
            pagination:"#pager2",
            mousewheel:true,
            swipe:{
                onMouse:true,
                onTouch:true
            }
        });

    });

</script>

<br>
<br>



<div align="right">
    <a  value="View Album" href="././imageUpload.php"><h4 style="margin:0 5% 0 0;">View Album</h4></a>
</div>

<div class="list_carousel">
    <ul id="foo2">
        <?php
        foreach ($a as $key => $value) {
            $ar = $value['album_name'];
            $v = $value['idalbum_collection'];

            $imagec = 'SELECT image_name FROM image_collection where idalbum_collection="' . $v . '"';
            $result = mysqli_query($con, $imagec) or die("not res selected");
            if (mysqli_num_rows($result) != 0) {
                while ($albm = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                    $img = $albm['image_name'];
                    $pathInfo = pathinfo($img);
                    $imgName = $pathInfo['filename'];

                }
                $viewalb = $ar . "view";
                $editalb = $ar . "editBtn";
                $deletealb = $ar . "delete";

                ?>
                <li>
                    <img name='<?php echo $img;?>' id='<?php echo $img?>'
                         src='upload/<?php echo $ar; ?>/tmb/<?php echo $img;?>'
                         onclick='opengallery(this, "<?php echo $v;?>","<?php echo $ar; ?>")'/>
                    <label style='color:#000000' id='<?php echo $main[$i];?>'><?php echo $ar;?></label>
                    <input type='button' class="view" value='view' id='<?php echo $viewalb;?>'
                           onclick='viewalbumNm(this, "<?php echo $v;?>","<?php echo $ar; ?> ");'/>
                    <input type='button' value='edit' id='<?php echo $editalb; ?>'
                           onclick='showhide(this,"<?php echo $ar; ?> ");'/>
                    <input type='button' value='delete' id='<?php echo $deletealb; ?>'
                           onclick='deletealbumNm(this,"<?php echo $v;?>","<?php echo $ar; ?> ");'/>
                    <br/><br/>

                    <div id="<?php echo $ar . 'hide'; ?>" style="display:none" class="span3">
                        <input type="text" id="<?php echo $ar . "edit"; ?>" class="span2" name="editalbum"/>
                        <input type="button" id="update" value="update"
                               onclick='editalbumNm(this, "<?php echo $v;?>","<?php echo $ar; ?> ");'/>
                    </div>
                </li>


                <?php
            }
        }
        mysqli_close($con);
        ?>
    </ul>
    <div class="clearfix"></div>
    <a id="prev2" class="prev" href="#"><img src='../images/prev.png' name='prev' /></a>
    <a id="next2" class="next" href="#"><img src='../images/next.png' name='next' /></a>

    <div id="pager2" class="pager"></div>
</div>
</br>

<div id='all' class='list_carousel2'>

</div>


<div id="main" role="main">


</div>
<aside>


</body>
</html>
<script>
    function showhide(e, ar) {
        var a = ar.trim() + 'hide';

        var op = document.getElementById(a);
        op.style.display = "inline";


    }
</script>

