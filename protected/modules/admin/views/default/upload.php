<!DOCTYPE html>

<html>
    <head>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.css" rel="stylesheet" media="screen">
    </head>
<body>
    <input id="inputGET" value="<?php echo $_GET['data']; ?>" hidden />
    <div >
        <form id="uploadForm" action="/admin/default/uploadInfo" method="post" enctype="multipart/form-data" >
            <input  type="file" name="image" id="image" style="float:left;padding-top:5px;color:grey;"/>
            <button id="submitForm" class="btn btn-danger btn-sm" type="submit" value="Submit" style="float:left;font-weight:700"/>Upload</button>
        </form>
    </div><br><br>
    <div style="background-color: #D0D0D0;height:4px;">
        <div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height:4px;">
        </div>
    </div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" language="javascript" >

$( document ).ready(function() {
    $("#uploadForm").submit(function(e) {
       uploadFile();
       e.preventDefault();
    });
    
    function uploadFile() {
        $("#submitForm").attr('disabled', 'disabled').removeClass('btn-danger').addClass('btn-default');
        var cid = $("#modalCID", window.parent.document).val();
        var user_id = $("#inputGET").val();
        var fd = new FormData();
        fd.append("image", document.getElementById('image').files[0]);
        fd.append("name_cid", cid);
        fd.append("user_id", user_id);
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.addEventListener("error", uploadFailed, false);
        xhr.addEventListener("abort", uploadCanceled, false);
        xhr.open("POST", "/admin/default/uploadInfo");
        xhr.send(fd);
    }

    function uploadProgress(evt) {
      if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
        $('#progress').css('width', percentComplete.toString()+'%');
      }
      else {
        document.getElementById('progressNumber').innerHTML = 'unable to compute';
      }
    }

    function uploadComplete(evt) {
      /* This event is raised when the server send back a response */
      $("#submitForm").html('Upload success').attr('disabled', false).removeClass('btn-default').addClass('btn-danger');
    }

    function uploadFailed(evt) {
      alert("There was an error attempting to upload the file.");
    }

    function uploadCanceled(evt) {
      alert("The upload has been canceled by the user or the browser dropped the connection.");
    }
});
</script>
</body>


</html>