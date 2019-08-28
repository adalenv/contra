            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Stats</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Nominativo</th>
                                            <th>Opened</th>
                                            <th>OK</th>
                                            <th>KO</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($users as $user) {
                                                   
                                                    $output.='<tr>
                                                                <td><a class="user_name_l" href="viewUser/'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</a></td>
                                                                <td>'.$this->model->getStats($user->user_id,date('Y-m-d', time())).'</td>
                                                                <td>'.$this->model->getStatsOk($user->user_id,date('Y-m-d', time())).'</td>
                                                                <td>'.$this->model->getStatsKo($user->user_id,date('Y-m-d', time())).'</td>
                                                            </tr>';
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
                $('.statsNav').addClass('active');
                <?php 
                    if (isset($_SESSION['edit_user'])) {
                        if ($_SESSION['edit_user']=='success') { ?>//if edit success 
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

                        <?php } elseif($_SESSION['edit_user']=='fail') { ?> //if fail
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
                        unset($_SESSION['edit_user']);
                    }

                    if (isset($_SESSION['delete_user'])) {
                        if ($_SESSION['delete_user']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "User Deleted!"

                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['delete_user']=='fail') { ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "User deletion failed!"
                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['delete_user']);
                    }

                    if (isset($_SESSION['create_user'])) {
                        if ($_SESSION['create_user']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "New user created!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } elseif($_SESSION['create_user']=='fail'){ ?> //if fail
                            $.notify({
                              icon: "error_outline",
                              message: "User creation failed!"

                            },{
                              type: 'danger',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });
                        <?php }
                        unset($_SESSION['create_user']);
                    }
                ?>
            </script>