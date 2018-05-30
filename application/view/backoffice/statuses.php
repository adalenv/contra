            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Users</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($statuses as $status) {
                                                   
                                                    $output.='<tr>
                                                                <td>'.$status->status_name.'</td>
                                                                <td>'.$status->status_description.'</td>';
                                                    if ($status->status_name!='NEW' && $status->status_name!='Ok' && $status->status_name!='Pending') {
                                                   		$output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" href="'.URL.$_SESSION['role'].'/editStatus/'.$status->status_id.'" ><i class="material-icons">edit</i></a></center></td></tr>';
                                                    }else $output.='<td></td></tr>';
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
                $('.statusNav').addClass('active');
                <?php 
                    if (isset($_SESSION['edit_status'])) {
                        if ($_SESSION['edit_status']=='success') { ?>//if edit success 
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

                        <?php } elseif($_SESSION['edit_status']=='fail') { ?> //if fail
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
                        unset($_SESSION['edit_status']);
                    }

                    if (isset($_SESSION['delete_status'])) {
                        if ($_SESSION['delete_status']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "Status Deleted!"

                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['delete_status']=='fail') { ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "Status deletion failed!"
                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['delete_status']);
                    }

                    if (isset($_SESSION['create_status'])) {
                        if ($_SESSION['create_status']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "New Status created!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['create_status']=='fail'){ ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "Status creation failed!"

                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['create_status']);
                    }
                ?>
            </script>