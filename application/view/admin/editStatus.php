            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title"><?=$status->status_name;?></h4>
                                    <p class="category">Edit Status</p>
                                </div>
                                <div class="card-content">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Status Name</label>
                                                    <input type="text" name="status_name" value="<?=$status->status_name;?>" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Description</label>
                                                    <input type="text" name="status_description" value="<?=$status->status_description;?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="edit_status">
                                        <a onclick="deleteStatus(<?=$status->status_id;?>)" class="btn btn-danger pull-left">Delete</a>
                                        <button type="submit" class="btn btn-info pull-right">Save Changes</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('.statusNav').addClass('active');
                function deleteStatus(status_id) {
                    swal({
                      title:'Are you sure?',
                      text: 'You won\'t be able to revert this!',
                      type: 'warning',
                      showCancelButton: true,
                      cancelButtonColor: '#00bcd4',
                      confirmButtonColor: '#f44336',
                      confirmButtonText: 'Delete'
                    }).then((result) => {
                      if (result.value) {
                        window.location.href='?deleteStatus=true';
                      }
                    })
                }
            </script>