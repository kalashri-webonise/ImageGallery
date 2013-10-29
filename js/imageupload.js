/**
 * Created with JetBrains PhpStorm.
 * User: webonise
 * Date: 18/10/13
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
    $('#uploadImg').on('click', function () {

        if (document.getElementById("unm").value == null || document.getElementById("unm").value == '') {
            alert("Please enter album name");
            return false;

        }
        if (document.getElementById("image").value == null || document.getElementById("image").value == '') {
            alert("Please choose image to upload");
            return false;

        }

        var form = new FormData($('#myform')[0]);
        document.getElementById("al").innerHTML = null;

        $.ajax({
            url:'image_send.php',
            type:'POST',
            xhr:function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progress, false);
                }
                return myXhr;
            },

            success:function (res) {
                $('#content_here_please').html(res);
            },

            data:form,
            cache:false,
            contentType:false,
            processData:false
        });
    });
});


function progress(e) {
    if (e.lengthComputable) {

        $('progress').attr({value:e.loaded, max:e.total});
    }
}


function imgclick(ea) {
    if ($('#al').length > 0) {

        $('#album').remove();
        uploadimg(ea);
    }
    else {
        uploadimg(ea);
    }
}

function uploadimg(ea) {

    var imgNm = ea.id;
    document.getElementById("content_here_please").innerHTML = null;




}

function deletealbumNm(im, alb, albnm) {
    var albumId = alb;
    var albname = albnm;
    var viewid = im.id;
    var status = confirm("Are you sure you want to delete Album ?");
    if (status == true) {

        $.ajax({
            type:"POST",
            url:"loadAlbum.php",
            success:function (data) {
                alert("Album is deleted successfully");
                location.reload();
            },
            data:{view:viewid, alid:albumId, albnm:albname},

            cache:false
        });
    }
}

function editalbumNm(im, alb, albnm) {
    var albumId = alb;
    var albname = albnm;
    var viewid = im.id;

    var a = albnm.trim() + 'edit';
    var updateAlbumNm = document.getElementById(a).value;
    var editstring = a.trim();
    $.ajax({
        type:"POST",
        url:"loadAlbum.php",
        success:function (data) {
            alert(data);
            location.reload();
        },
        data:{idedit:viewid, albumid:albumId, albumnm:albname, updatedName:updateAlbumNm},

        cache:false
    });
}

$( ".view" ).on( "click",viewalbumNm);
function viewalbumNm(im, albId, albnm) {
    var albumView = albId;
    if ($('#main').length > 0) {
        $('#section').remove();
    }

    if ($('#all').length > 0) {
        $('#all').find('div').first().remove();
        $('#foo3').remove();
        $('#cl').remove();
        $('#prev3').remove();
        $('#next3').remove();
        $('#pager3').remove();
        $('#lbl').remove();

    }
    $.ajax({
        type:"POST",
        url:"loadAlbum.php",
        success:function (data) {
            //  console.log(data);
            $("#all").append("<header style='background: linear-gradient(45deg, #020031 0%, #6D3353 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);'><label align='left' id='lbl'><h3 style='color:#ffffff' align='center'>Album Name :"+albnm+"</h3></label></header>");
            $('#all').append("<ul id='foo3' style='width:500px;'>");

            $.each(data, function (key, value) {
                var ur = albnm.trim();
                var url = "upload/" + ur + "/tmb/" + value;
                var val = 'deleteImg' + value;

                $("#foo3").append("<li><img id='" + val + "' style='margin: 0 0 0 5px;' src=' " + url + " '/><label style='color:#000000;'>" + value + "</label><br/><input id='" + value + "' name='" + albnm + "'  value='Delete'  onclick='deleteImg(this," + albumView + ");' type='button'/></li>");


            });
            $("#all").append("<div class='clearfix' id='cl'></div><a id='prev3' class='prev' href='#'><img src='../images/prev.png' name='prev' /></a><a id='next3' class='next' href='#'><img src='../images/next.png' name='next' /></a><div id='pager3' class='pager'></div>");

            $('#foo3').carouFredSel({
                auto:false,
                prev:'#prev3',
                next:'#next3',
                pagination:"#pager3",
                mousewheel:true,
                swipe:{
                    onMouse:true,
                    onTouch:true
                }
            });
        },
        data:{albumIdView:albumView},
        dataType:'json',
        cache:false
    });

    //   viewa(im, albId, albnm);




}


function deleteImg(ek, idalImg) {
    var alimgid = ek.id;
    var ekname = ek.name;
    var alname = ekname.trim();
    var status = confirm("Are you sure you want to delete Image ?");
    if (status == true) {

        $.ajax({
            type:"POST",
            url:"loadAlbum.php",
            success:function (data) {
                alert("Image is deleted successfully");
                location.reload();

            },
            data:{imNm:alimgid, imgalid:idalImg, nm:alname},

            cache:false
        });
    }
}


function opengallery(im,imid,alb) {
    if ($('#main').length > 0) {

        $('#section').remove();
        opengall(im,imid,alb);


    }
    else {
        opengall(im,imid,alb);
    }
    if ($('#all').length > 0) {
        $('#all').find('div').first().remove();
        $('#foo3').remove();
        $('#cl').remove();
        $('#prev3').remove();
        $('#next3').remove();
        $('#pager3').remove();
        $('#lbl').remove();
        $('body').removeChild('#all');
        opengall(im,imid,alb);
    }
    else {
        opengall(im,imid,alb);
    }
}

function opengall(im,imid,alb)
{
    $.ajax({
        type:"POST",
        url:"loadAlbum.php",
        success:function (data) {
            console.log(data);

            $('#main').append("<section class='slider' id='section' style='width:500px;'><div class='flexslider'  style='width:500px;margin-left:500px;'><ul class='slides' id='sli'>");
            $.each(data, function (key, value) {
                var url = "upload/" + alb + "/" + value;
                var urtmb="upload/"+alb+"/tmb/"+value;
                $('#sli').append("<li data-thumb='"+urtmb+"'><img src='"+url+"' /></li>");


            });
            $('#main').append("</ul></div></section>");

            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });

        },
        data:{albumIdV:imid},
        dataType:'json',
        cache:false
    });
}