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
                                                        <label class="control-label"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 dz-parent">
                                                <div id="zdrop" class="fileuploader ">
                                                    <div id="upload-label" >
                                                        <span class="title">Drag your Documents here</span>
                                                        <span>Or click to select<span/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 dz-parent">
                                                <div id="zdrop" class="fileuploader ">
                                                    <div id="upload-label" >
                                                        <span class="title">Drag your Audio files here</span>
                                                        <span>Or click to select<span/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
            <div class="preview-container">
                <div class="header">
                    <span>Uploaded Files</span> 
                    <i id="controller" class="material-icons">keyboard_arrow_down</i>
                </div>
                <div class="collection card" id="previews">
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
                            <a href="#!" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="material-icons white-text">clear</i></i></a>
                        </div>
                    </div>
                </div>
            </div>



            <script type="text/javascript">
                $('.contractsNav').addClass('active');
                $(document).ready(function(){

                initFileUploader("#zdrop");

                function initFileUploader(target) {
                    var previewNode = document.querySelector("#zdrop-template");
                    previewNode.id = "";
                    var previewTemplate = previewNode.parentNode.innerHTML;
                    previewNode.parentNode.removeChild(previewNode);


                    var zdrop = new Dropzone(target, {
                        url: "<?=URL.$_SESSION['role']?>/uploadDocuments",
                       // maxFilesize:20,
                        previewTemplate: previewTemplate,
                        autoQueue: true,
                        previewsContainer: "#previews",
                        clickable: "#upload-label"
                    });

                    zdrop.on("addedfile", function(file) { 
                        $('.preview-container').css('visibility', 'visible');
                    });

                    zdrop.on("totaluploadprogress", function (progress) {
                        var progr = document.querySelector(".progress .determinate");
                        if (progr === undefined || progr === null)
                            return;

                        progr.style.width = progress + "%";
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
                    
                    var toggle = true;
                    /* Preview controller of hide / show */
                    $('#controller').click(function() {
                        if(toggle){
                            $('#previews').css('visibility', 'hidden');
                            $('#controller').html("keyboard_arrow_up");
                            $('#previews').css('height', '0px');
                            toggle = false;
                        }else{
                            $('#previews').css('visibility', 'visible');
                            $('#controller').html("keyboard_arrow_down");
                            $('#previews').css('height', 'initial');
                            toggle = true;
                        }
                    });
                }

            });

                
            </script>














            <style type="text/css">
.fileuploader{
  position: relative;
  background: white;
  width: 100%;
  border: 1px solid #e9e9e9;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}
.fileuploader #upload-label{
  position: inherit !important;
  background: #5bc0de;
  color: #fff;
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
.fileuploader #upload-label i{
  text-align: center;
  display: block;
  background: white;
  color: #2196F3;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  border-radius: 100%;
  width: 80px;
  height: 80px;
  font-size: 60px;
  padding-top: 10px;
  position: absolute;
  top: -50px;
  left: 0;
  right: 0;
  margin-right: auto;
  margin-left: auto;
}
/** Preview of collections of uploaded documents **/
.preview-container{
  position: fixed;
  right: 10px;
  bottom: 0px;
  width: 300px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  visibility: hidden;
}
.preview-container #previews{
  max-height: 400px;
  overflow: auto; 
}
.preview-container #previews .zdrop-info{
  width: 88%;
  margin-right: 2%;
}
.preview-container #previews.collection{
  margin: 0;
}
.preview-container #previews.collection .actions a{
  width: 1.5em;
  height: 1.5em;
  line-height: 1;
}
.preview-container #previews.collection .actions a i{
  font-size: 1em;
  line-height: 1.6;
}
.preview-container #previews.collection .dz-error-message{
  font-size: 0.8em;
  margin-top: -12px;
  color: #F44336;
}
.preview-container .header{
  background: #2196F3;
  color: #fff;
  padding: 8px;
}
.preview-container .header i{
  float: right;
  cursor: pointer;
}
            </style>