            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>
                        <div class="col-md-6 ml-auto mr-auto text-center">
                            <ul style="max-width: fit-content;" class="max-width: fit-content; card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                      <a class="nav-link" href="createIB" role="tablist">
                                          <i class="material-icons">add</i>
                                          Create IB
                                      </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title"></font></a><div>IBs</div></h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $output='';
                                                foreach ($ibs as $ib) {

                                                    $output.='<tr>
                                                                <td>'.$ib->ib_id.'</td>
                                                                <td><a href="../admin/contracts?ib='.$ib->ib_id.'">'.$ib->ib_name.'</a></td>';

                                                   		$output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" href="'.URL.$_SESSION['role'].'/ibUpload/'.$ib->ib_id.'" ><i class="material-icons">cloud_upload</i></a></center></td></tr>';
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
                $('.ibNav').addClass('active');
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



                    if (isset($_SESSION['update_statuses'])) {
                        if ($_SESSION['update_statuses']=='success') { ?>//if edit success
                            $.notify({
                              icon: "done",
                              message: "Status Updated!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['update_statuses']=='fail'){ ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "Staus update failed!"

                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['update_statuses']);
                    }

                ?>
            </script>
