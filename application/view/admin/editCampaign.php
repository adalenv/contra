            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title"><?=$campaign->campaign_name;?></h4>
                                    <p class="category">Edit Campaign</p>
                                </div>
                                <div class="card-content">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Campaign Name</label>
                                                    <input type="text" name="campaign_name" value="<?=$campaign->campaign_name;?>" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Description</label>
                                                    <input type="text" name="campaign_description" value="<?=$campaign->campaign_description;?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="edit_campaign">
                                        <a onclick="deleteCampaign(<?=$campaign->campaign_id;?>)" class="btn btn-danger pull-left">Delete</a>
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
                $('.campaignNav').addClass('active');
                function deleteCampaign(campaign_id) {
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
                        window.location.href='?deleteCampaign=true';
                      }
                    })
                }
            </script>