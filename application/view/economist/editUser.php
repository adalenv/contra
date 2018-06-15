            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title"><?=$user->first_name.' '.$user->last_name;?></h4>
                                    <p class="category">Edit User</p>
                                </div>
                                <div class="card-content">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="username" value="<?=$user->username;?>" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" name="password" value="<?=$user->password;?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" name="first_name" value="<?=$user->first_name;?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" name="last_name" value="<?=$user->last_name;?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Role</label>
                                                    <select name="role" class="form-control selectRole">
                                                        <option value="operator">Operator</option>
                                                        <option value="supervisor">Supervisor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if ($user->role=='operator') {?>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Supervisor</label>
                                                        <select class="form-control" required name="supervisor" id="supervisor">
                                                            <?php
                                                                $output=''; 
                                                                foreach ($supervisors as $supervisor) {
                                                                    if ($user->supervisor==$supervisor->user_id) {
                                                                        $output.='<option selected="" value="'.$supervisor->user_id.'" >'.$supervisor->first_name.' '.$supervisor->last_name.'</option>';
                                                                    }else{
                                                                        $output.='<option value="'.$supervisor->user_id.'" >'.$supervisor->first_name.' '.$supervisor->last_name.'</option>';
                                                                    }
                                                                }
                                                                echo $output;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="edit_user">
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
                $('.usersNav').addClass('active');
                $('.selectRole').val('<?=$user->role;?>');
            </script>