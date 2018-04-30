            <div class="content">
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
                                            <th>Full Name</th>
                                            <th>Role</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($users as $user) {
                                                   
                                                    $output.='<tr>
                                                                <td>'.$user->first_name.' '.$user->last_name.'</td>
                                                                <td>'.$user->role.'</td>
                                                                <td><center><a href="'.URL.$_SESSION['role'].'/editUser/'.$user->user_id.'" class="btn btn-warning">Edit</a></center></td>
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
                    if (isset($_GET['edit_user'])) {
                        if ($_GET['edit_user']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "border_color",
                              message: "Changes saved!"

                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } else { ?> //if fail
                            $.notify({
                              icon: "border_color",
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
                    }
                ?>
            </script>