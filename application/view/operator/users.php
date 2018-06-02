            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>    
                        <div class="col-md-6 ml-auto mr-auto text-center">
                            <ul style="max-width: fit-content;" class="max-width: fit-content; card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item active">
                                      <a class="nav-link" href="" role="tablist">
                                          <i class="material-icons">person</i>
                                          Users
                                      </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="users/workhours/<?=date('Y-m');?>" role="tablist">
                                        <i class="material-icons">access_time</i>
                                        Show Workhours
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
                                    <h4 class="title">Users</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Full Name</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($users as $user) {
                                                   
                                                    $output.='<tr>
                                                                <td><a class="user_name_l" href="'.URL.$_SESSION['role'].'/contracts?operator='.$user->user_id.'#o">'.$user->first_name.' '.$user->last_name.'</a></td>
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
            </script>