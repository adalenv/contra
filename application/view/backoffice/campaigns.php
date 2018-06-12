            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Campagna</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Campagna</th>
                                            <th>Descrizione</th>
                                           <!--  <th><center>Azione</center></th> -->
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($campaigns as $campaign) {
                                                   
                                                    $output.='<tr>
                                                                <td>'.$campaign->campaign_name.'</td>
                                                                <td>'.$campaign->campaign_description.'</td>';
                                                    // if ($campaign->campaign_name!='NEW') {
                                                   	// 	$output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" href="'.URL.$_SESSION['role'].'/editCampaign/'.$campaign->campaign_id.'" ><i class="material-icons">edit</i></a></center></td></tr>';
                                                    // }else $output.='<td></td></tr>';
                                                }
                                                echo $output;
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('.campaignNav').addClass('active');
                <?php 
                    if (isset($_SESSION['edit_campaign'])) {
                        if ($_SESSION['edit_campaign']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "Changes saved!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['edit_campaign']=='fail') { ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "An error occurred!"
                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['edit_campaign']);
                    }

                    if (isset($_SESSION['delete_campaign'])) {
                        if ($_SESSION['delete_campaign']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "Campaign Deleted!"

                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['delete_campaign']=='fail') { ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "Campaign deletion failed!"
                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['delete_campaign']);
                    }

                    if (isset($_SESSION['create_campaign'])) {
                        if ($_SESSION['create_campaign']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "New Campaign created!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['create_campaign']=='fail'){ ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "Campaign creation failed!"

                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['create_campaign']);
                    }
                ?>
            </script>
