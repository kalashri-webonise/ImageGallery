/**
 * Created with JetBrains PhpStorm.
 * User: webonise
 * Date: 18/10/13
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
    $('body').on('click', '.upload', function () {

        if (document.getElementById("unm").value == null || document.getElementById("unm").value == '') {
            alert("Please enter album name");
            exit;
        }
        if (document.getElementById("image").value == null || document.getElementById("image").value == '') {
            alert("Please choose image to upload");
            exit;

        }

        var form = new FormData($('#myform')[0]);
     //   document.getElementById("album").innerHTML = null;

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
  if($('#al').length>0)
  {

    $('#album').remove();
     uploadimg(ea);
  }
    else
  {
      uploadimg(ea);
  }
}

function uploadimg(ea)
{

    var imgNm = ea.id;
    document.getElementById("content_here_please").innerHTML = null;



    $.ajax({
        url:'loadAlbum.php',
        success:function (data) {
            console.log(data);

            $('#al').append("<div id='album'>");
            $("#album").append("<div id='banner-slide'><ul class='bjqs' id='lol'>");
            $.each(data, function (key, value) {
                var url = "upload/" + imgNm + "/" + value;
                $("#lol").append("<li><img id='value' style='margin: 0 0 0 5px;' src=' "+ url +" '/></li>");

            });
            $("#album").append("</ul></div>");

            $('#banner-slide').bjqs({
                animtype      : 'slide',
                height        : 320,
                width         : 620,
                responsive    : true,
                randomstart   : true
            });
        },
        data:{imageNm:ea.id
        },
        cache:false,
        dataType:'json'
    });




}


