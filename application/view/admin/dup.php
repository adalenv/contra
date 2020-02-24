            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>

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
                                    <table class="table table-hover">
                                        <thead>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Client Name</th>
                                            <th>Status</th>
                                            <th>IB</th>

                                        </thead>
                                        <tbody>
                                            <?php
                                                $output='';
                                                foreach ($contracts as $contract) {
                                                    $output.='<tr class="tdColor'.$contract->status.'">';
                                                                if ($contract->contract_type=='gas') {
                                                                    $output.='<td>Gas</td>';
                                                                }elseif ($contract->contract_type=='luce') {
                                                                    $output.='<td>Luce</td>';
                                                                }else {
                                                                    $output.='<td>Dual</td>';
                                                                }
                                                     $output.='<td>'.date('d-m-Y',strtotime($contract->date)).'</td>
                                                                <td><a href="'.URL."admin/viewContract/".$contract->contract_id.'">'.$contract->first_name.' '.$contract->last_name.'</a></td>';
                                                                foreach ($statuses as $key => $status) {
                                                                    if ($status->status_id==$contract->status) {
                                                                        $status1=$status->status_name;
                                                                        break;
                                                                    }
                                                                }
                                                    $output.='<td>'.$status1.'</td>';

                                                    foreach ($ibs as $key => $ib) {
                                                        if ($ib->ib_id==$contract->ib) {
                                                            $ib1=$ib->ib_name;
                                                            break;
                                                        }else{
                                                          $ib1="";
                                                        }
                                                    }
                                                    $output.='<td>'.$ib1.'</td>';

                                                    $output.='</tr>';
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
