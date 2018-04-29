            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Users</h4>
                                    <p class="category">Create new user</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-info">
                                            <th>Full Name</th>
                                            <th>Role</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dakota Rice</td>
                                                <td>Administrator</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/1' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Minerva Hooper</td>
                                                <td>Backoffice</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/2' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Dakota Rice</td>
                                                <td>Administrator</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/1' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Minerva Hooper</td>
                                                <td>Backoffice</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/2' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Dakota Rice</td>
                                                <td>Administrator</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/1' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Minerva Hooper</td>
                                                <td>Backoffice</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/2' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Dakota Rice</td>
                                                <td>Administrator</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/1' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>
                                            <tr>
                                                <td>Minerva Hooper</td>
                                                <td>Backoffice</td>
                                                <td><center><a href="<?=URL.$_SESSION['role'].'/editUser/2' ;?>" class="btn btn-warning">Edit</a></center></td>
                                            </tr>

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