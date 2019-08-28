            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>
                        <div class="col-md-6 ml-auto mr-auto text-center">
                            <ul style="max-width: fit-content;" class="card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                      <a class="nav-link" href="../../users" role="tablist">
                                          <i class="material-icons">person</i>
                                          Users
                                      </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" role="tablist">
                                        <i class="material-icons">access_time</i>
                                        Show Workhours</br>
                                        <input id="month"  name="month" style="background: white;color:grey;" type="text">
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
                                    <h4 class="title">Workhours</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Full Name</th>
                                            <th>Role</th>
                                            <th>Hours</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $output='';
                                                foreach ($users as $user) {
                                                    $output.='<tr>
                                                                <td><a class="user_name_l" href="../viewUser/'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</a></td>
                                                                <td>'.$user->role.'</td>';
                                                    $output.='<td>'.$this->model->SupervisorgetWorkhours($user->user_id,$date).'</td>';
                                                    $output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" href="'.URL.$_SESSION['role'].'/addWorkhours/'.$user->user_id.'" ><i class="material-icons">access_time</i></a></center></td>
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
                $('.usersNav').addClass('active');


                                <?php
                                  if ($date) {
                                    echo "$('#month').val('".$date."');";
                                  }else{
                                    echo "$('#month').val('".date('Y-m')."-01--".date('Y-m')."-31');";
                                  }
                                 ?>
                                date=$('#month').val();
                                var start =date.split('--')[0];
                                var end = date.split('--')[1];
                                if (date!='') {
                                    var start =date.split('--')[0];
                                    var end = date.split('--')[1];
                                    $('#month').daterangepicker({
                                        startDate: start,
                                        endDate: end,
                                        locale: {
                                          format: 'YYYY-MM-DD'
                                        },
                                        ranges: {
                                           'Today': [moment(), moment()],
                                           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                           'This Month': [moment().startOf('month'), moment().endOf('month')],
                                           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                           'This Year': [moment().startOf('year'), moment().endOf('year')],
                                           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                                           'All Time': ['1999-01-01',moment()]
                                        }
                                    }, function(start, end, label) {
                                      window.location.href=start.format('YYYY-MM-DD')+ '--'+end.format('YYYY-MM-DD');
                                    });
                                }else{
                                    $('#month').daterangepicker({
                                        locale: {
                                            format: 'YYYY-MM-DD'
                                        },
                                        ranges: {
                                           'Today': [moment(), moment()],
                                           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                           'This Month': [moment().startOf('month'), moment().endOf('month')],
                                           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                           'This Year': [moment().startOf('year'), moment().endOf('year')],
                                           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                                           'All Time': ['1999-01-01',moment()]
                                        }
                                    }, function(start, end, label) {
                                        window.location.href=start.format('YYYY-MM-DD')+ '--'+end.format('YYYY-MM-DD');
                                      }).val('');
                                }

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
