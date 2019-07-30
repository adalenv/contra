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
                                                    <input type="text" required name="username" value="<?=$user->username;?>" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" required name="password" value="<?=$user->password;?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" required name="first_name" value="<?=$user->first_name;?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" required name="last_name" value="<?=$user->last_name;?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Active</label>
                                                    
                                                    <select class="form-control" required name="active" id="active">
                                                        <?php 
                                                            if ($user->active=='yes') {?>
                                                                <option selected value="yes">Yes</option>
                                                                <option value="no">No</option>  
                                                        <?php } else { ?>
                                                                <option value="yes">Yes</option>
                                                                <option selected value="no">No</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Role</label>
                                                    <select onchange="getSupervisors(this.value)" required  name="role" class="form-control selectRole">
                                                        <option value="operator">Operator</option>
                                                        <option value="supervisor">Supervisor</option>
                                                        <option value="floor_manager">Floor Manager</option>
                                                        <option value="economist">Economist</option>
                                                        <option value="backoffice">Backoffice</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if ($user->role=='operator') {?>
                                                <div class="col-md-6" id="supervisorif">
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
                                            <?php } else { ?>
                                                <div class="col-md-6" id="supervisorif">
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="edit_user">
                                        <a onclick="deleteUser(<?=$user->user_id;?>)" class="btn btn-danger pull-left">Delete</a>
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
                  function deleteUser(user_id) {
                    swal({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      type: 'warning',
                      showCancelButton: true,
                      cancelButtonColor: '#00bcd4',
                      confirmButtonColor: '#f44336',
                      confirmButtonText: 'Delete'
                    }).then((result) => {
                      if (result.value) {
                        window.location.href='?deleteUser=true';
                      } 
                    })
                  }

function getSupervisors(v){
    if (v=='operator') {
        $.ajax({
          url: '<?=URL;?>api/getSupervisors/',
          type: 'POST',
          dataType: 'json',
        })
        .done(function(data) {
            dataa=data;
            $('#supervisorif').html(`<div class="form-group label-floating">
                                        <label class="control-label">Supervisor</label>
                                        <select  id="supervisor" required name="supervisor" class="form-control">
                                            <option value=''></option>
                                        </select>
                                    </div>`);
            $('#supervisor').focus();
            for (var i=0;i<data.length;i++) {
               $('#supervisor').append('<option value='+data[i].user_id+'>'+data[i].full_name+'</option>');
            };
            $('#supervisorif').show();
        })
        .fail(function(err) {
            console.log(err);
        })
    }else{
        $('#supervisorif').html('');
        $('#supervisorif').hide();
    }

}

            </script>