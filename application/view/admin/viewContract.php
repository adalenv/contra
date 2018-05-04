            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Check Contract</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Company (disabled)</label>
                                                    <input type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email address</label>
                                                    <input type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fist Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Adress</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">City</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Country</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Postal Code</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"> Note go here .</label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 dz-parent">
                                                <div id="zdrop" class="fileuploader">
                                                    <div id="upload-label" >
                                                        <span class="title">Drag your Documents here</span>
                                                        <span>Or click to select<span/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 dz-parent">
                                                <div id="adrop" class="fileuploader">
                                                    <div id="upload-label2" >
                                                        <span class="title">Drag your Audio files here</span>
                                                        <span>Or click to select<span/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <div class="table-responsive table-sales"  style="
                                                                    border-bottom: 1px #5bc0de dashed;
                                                                    border-left: 1px #5bc0de dashed;
                                                                    border-right: 1px #5bc0de dashed;">
                                                    <table class="table">
                                                        <tbody class="doc-container">
                                                            <tr>
                                                                <td>
                                                                    No documents!
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6" >
                                                <div class="table-responsive table-sales"  style="
                                                                    border-bottom: 1px #5bc0de dashed;
                                                                    border-left: 1px #5bc0de dashed;
                                                                    border-right: 1px #5bc0de dashed;">
                                                    <table class="table">
                                                        <tbody class="audio-container">
                                                            <tr>
                                                                <td>
                                                                    No Audio!
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="contract_id" id="contract_id" value="<?=$contract->contract_id;?>">
                                        <a type="submit" class="btn btn-warning pull-left">Edit Contract</a>
                                        <button type="submit" class="btn btn-info pull-right">Save Contract</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview collection of uploaded documents -->
            <div class="preview-container" style="display: none">
                <div class="header">
                    <span>Uploaded Files</span> 
                    <i id="controller" class="material-icons">keyboard_arrow_down</i>
                </div>
                <div class="collection card" id="previews">
                    <div class="collection-item clearhack valign-wrapper item-template" id="adrop-template"></div>
                    <div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">
                        <div class="left pv zdrop-info" data-dz-thumbnail>
                            <div>
                                <span data-dz-name></span> <span data-dz-size></span>
                            </div>
                            <div class="progress">
                                <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                            </div>
                            <div class="dz-error-message"><span data-dz-errormessage></span></div>
                        </div>

                        <div class="secondary-content actions">
                            <a href="#" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="material-icons white-text">clear</i></i></a>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">  
$(document).ready(function(){
    initDocUploader("#zdrop");
    initAudioUploader("#adrop");
    loadDocAndAudio();
    $('.contractsNav').addClass('active');
});
function loadDocAndAudio() {
    $.ajax({//doc
        url: "<?=URL.$_SESSION['role']?>/getDocuments/"+$('#contract_id').val(),
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data) {
        if (data.length>0) {
            $('.doc-container').html('');
            $.each(data, function (i) {
                $('.doc-container').append('<tr><td><a href="<?=URL.$_SESSION['role']?>/getDocument/'+data[i].document_id+'">'+data[i].url+'</a></td></tr>');
            });
        }else {
            $('.doc-container').html('<tr><td>No documents!</td></tr>');
        }
    })
    .fail(function() {
          console.log("error");
    })  
    $.ajax({//audio
        url: "<?=URL.$_SESSION['role']?>/getAudios/"+$('#contract_id').val(),
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data) {
        if (data.length>0) {
            $('.audio-container').html('');
            console.log(data);
            $.each(data, function (i) {
                $('.audio-container').append('<tr><td><audio controls><source src="<?=URL.$_SESSION['role']?>/getAudio/'+data[i].audio_id+'"></audio>');
            });
        }else {
            $('.audio-container').html('<tr><td>No Audio!</td></tr>');
        }
    })
    .fail(function() {
          console.log("error");
    })        
}
function initDocUploader(target) {
    var previewNode = document.querySelector("#zdrop-template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var zdrop = new Dropzone(target, {
        url: "<?=URL.$_SESSION['role']?>/uploadDocuments",
        previewTemplate: previewTemplate,
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: "#upload-label"
    });

    zdrop.on('dragenter', function () {
        $('.fileuploader').addClass("active");
    });

    zdrop.on('dragleave', function () {
        $('.fileuploader').removeClass("active");           
    });

    zdrop.on('drop', function () {
        $('.fileuploader').removeClass("active");   
    });

    zdrop.on('sending', function(file, xhr, formData){
        formData.append('contract_id', $('#contract_id').val());
    });
    zdrop.on("success", function(file, responseText) {
        loadDoc();
    });
} 
function initAudioUploader(target) {
    var previewNode = document.querySelector("#adrop-template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var adrop = new Dropzone(target, {
        url: "<?=URL.$_SESSION['role']?>/uploadAudios",
        previewTemplate: previewTemplate,
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: "#upload-label2",
        acceptedFiles:"audio/*"
    });

    adrop.on('dragenter', function () {
        $('.fileuploader').addClass("active");
    });

    adrop.on('dragleave', function () {
        $('.fileuploader').removeClass("active");           
    });

    adrop.on('drop', function () {
        $('.fileuploader').removeClass("active");   
    });

    adrop.on('sending', function(file, xhr, formData){
        formData.append('contract_id', $('#contract_id').val());
    });
    adrop.on("success", function(file, responseText) {
       loadDocAndAudio();
    });
}             
</script>

<style type="text/css">
    .fileuploader{
      position: relative;
      border: 1px #5bc0de dashed !important;
      background: white;
      width: 100%;
      border: 1px solid #e9e9e9;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }
    .fileuploader #upload-label{
      position: inherit !important;
      background: white;
      color: grey;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      padding: 16px;
      position: absolute;
      top: 45%;
      left: 0;
      right: 0;
      margin-right: auto;
      margin-left: auto;
      min-width: 20%;
      text-align: center;
      padding-top: 40px;
      transition: 0.8s all;
      -webkit-transition: 0.8s all;
      -moz-transition: 0.8s all;
      cursor: pointer;
    }
.fileuploader #upload-label2{
      position: inherit !important;
      background: white;
      color: grey;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      padding: 16px;
      position: absolute;
      top: 45%;
      left: 0;
      right: 0;
      margin-right: auto;
      margin-left: auto;
      min-width: 20%;
      text-align: center;
      padding-top: 40px;
      transition: 0.8s all;
      -webkit-transition: 0.8s all;
      -moz-transition: 0.8s all;
      cursor: pointer;
    }
    .fileuploader.active{
      background: #2196F3;
    }
    .fileuploader.active #upload-label{
      background: #fff;
      color: #2196F3;
    }
    .fileuploader #upload-label span.title{
      font-size: 1.1em;
      font-weight: bold;
      display: block;
    }
    .fileuploader.active #upload-label2{
      background: #fff;
      color: #2196F3;
    }
    .fileuploader #upload-label2 span.title{
      font-size: 1.1em;
      font-weight: bold;
      display: block;
    }

</style>