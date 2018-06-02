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
                                        <input id="month" onchange="window.location.href=this.value;" name="month" style="background: white;color:grey;" type="month">
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
                                                                <td><a class="user_name_l" href="../../viewUser/'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</a></td>
                                                                <td>'.$user->role.'</td>';
                                                    $output.='<td>'.$this->model->getWorkhours($user->user_id,$date).'</td>';
                                                    $output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" onclick="addHours('.$user->user_id.',\''.$user->first_name.' '.$user->last_name.'\')" ><i class="material-icons">access_time</i></a></center></td>
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

  <div class="modal fade" id="addHours" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="float: left;" id="u_name1"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-sm-6" style="margin-bottom: 36px;">
                <input style="col-sm-6" type="text" class="form-control" id="hoursToAdd" value="8"  placeholder="Enter Hours Number">
                <input type="hidden" id="h_user_id">
            </div>
            <div class="form-group col-sm-6" style="margin-bottom: 36px;">
                <input type="date" style="col-sm-6" value="" class="form-control" id="dateToAdd"  placeholder="Enter Month">
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="addHoursM()" class="btn btn-info">Add Hours</button>
        </div>
            </br>
            <table style="width: 100%" class="table table-bordered table-responsive table-striped ">
              <thead>
              </thead>
              <tbody class ="whtable"></tbody>
             </table>
        </div>
      </div>
    </div>
    <style type="text/css">
    .whtable>tr>td{
      padding: 0px !important;
      margin: 0px !important;
    }
    </style>
    <script type="text/javascript">
    <?php
        if ($date) {
          echo "$('#dateToAdd').val('".$date.'-'.date('d')."');";
        }else{
          echo "$('#dateToAdd').val('".date('Y-m-d')."');";
        }
    ?>

      $('#hoursToAdd').click(function(event) {
          $(this).val('');
      });
      function addHoursM(){
        if ($('#hoursToAdd').val()!='' ) {
          console.log('valid');
        } else {
          console.log('not valid');
          return;
        }
        $.ajax({
          url: '<?=URL?>api/addHours/',
          type: 'POST',
          //dataType: '',
          data:{
              user_id:$('#h_user_id').val(),
              hours:$('#hoursToAdd').val(),
              date:$('#dateToAdd').val(),
          },
        })
        .done(function(data) {
            $.ajax({
                url: '<?=URL?>api/getWorkhours/',
                type: 'POST',
                dataType:'json',
                data: {user_id: $('#h_user_id').val(),
                       date:$('#dateToAdd').val(),
                      },
              })
              .done(function(data) {
                d=data;
                console.log(data);
                      $('.whtable').html('');
                      for (var i = 0 ; i < data.length; i++) {
                        $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td></tr>`)
                      }
                       
              })
              .fail(function(err) {
                console.log(err);
              });
        })
        .fail(function(err) {
        })

        
      }</script>
  </div>



            <script type="text/javascript">
                  $('.usersNav').addClass('active');

                  $('#addHours').on('hidden.bs.modal',function(){
                    window.location.href='';
                  });

                function deleteHours(workhours_id){
                  $.ajax({
                      url: '<?=URL?>api/deleteHours/',
                      type: 'POST',
                      data: {workhours_id: workhours_id},
                    })
                    .done(function(data) {
                        $.ajax({
                            url: '<?=URL?>api/getWorkhours/',
                            type: 'POST',
                            dataType:'json',
                            data: {user_id: $('#h_user_id').val(),
                                   date:$('#dateToAdd').val(),
                                  },
                          })
                          .done(function(data) {
                            d=data;
                            console.log(data);
                                  $('.whtable').html('');
                                  for (var i = 0 ; i < data.length; i++) {
                                    $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td></tr>`)
                                  }
                                   
                          })
                          .fail(function(err) {
                            console.log(err);
                          });
                    })
                    .fail(function(err) {
                      console.log(err);
                    });
                }

                function addHours(user_id,user_name){
                  $('#u_name1').html(user_name);
                  $('#addHours').modal();
                  $('#h_user_id').val(user_id);

                  $.ajax({
                      url: '<?=URL?>api/getWorkhours/',
                      type: 'POST',
                      dataType:'json',
                      data: {user_id: user_id,
                             date:$('#dateToAdd').val(),
                            },
                    })
                    .done(function(data) {
                      d=data;
                      console.log(data);
                            $('.whtable').html('');
                            for (var i = 0 ; i < data.length; i++) {
                              $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td></tr>`)
                            }
                             
                    })
                    .fail(function(err) {
                      console.log(err);
                    });
                }
                    






                <?php 
                  if ($date) {
                    echo "$('#month').val('".$date."');";
                  }else{
                    echo "$('#month').val('".date('Y-m')."');";
                  }

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
