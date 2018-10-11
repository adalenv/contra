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

            </script>