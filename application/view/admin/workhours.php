            <div class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-auto mr-auto text-center"></div>
                        <div class="col-md-6 ml-auto mr-auto text-center">
                            <ul style="max-width: fit-content;" class="card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                      <a class="nav-link" href="../../users" role="tablist">
                                          <i class="material-icons">person</i>
                                          Utenti
                                      </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../../createUser" role="tablist">
                                        <i class="material-icons">person_add</i>
                                        Creare un utente
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" role="tablist">
                                        <i class="material-icons">access_time</i>
                                        Ore di Lavoro</br>
                                        <input id="month"  name="month" style="background: white;color:grey;" type="text">
                                        <!-- onchange="window.location.href=this.value;" -->
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
                                    <h4 class="title">Ore di Lavoro</h4>
                                    <p class="category" style="cursor: pointer;" onclick="exportTableToCSV('Performanza_<?=$date;?>.csv')">Esporta</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Filter</label>
                                        <input type="text" id="inpu" onkeyup="filterTabl()" class="form-control">
                                    <span class="material-input"></span></div>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table" id="tabl">
                                        <thead class="text-info">
                                            <th>Nominativo</th>
                                            <th>Ruolo</th>
                                            <th>Contratti</th>
                                            <th>OK/Inserito</th>
                                            <th>Ore</th>
                                            <th>Performanza</th>
                                            <th><center>Azione</center></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $output='';
                                                foreach ($users as $user) {
                                                  if ($user->role=='supervisor') {
                                                    $contractsNumber1= (int)$this->model->getContractsNumberSupervisor($user->user_id,$date);
                                                    $contractsNumberOkInserito= (int)$this->model->getContractsNumberOkInseritoSupervisor($user->user_id,$date);
                                                  } else{
                                                    $contractsNumber1= (int)$this->model->getContractsNumber($user->user_id,$date);
                                                    $contractsNumberOkInserito= (int)$this->model->getContractsNumberOkInserito($user->user_id,$date);
                                                  }

                                                  $workhours1= (float)$this->model->getWorkhours($user->user_id,$date);
                                                    $output.='<tr>
                                                                <td><a class="user_name_l" href="../../viewUser/'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</a></td>
                                                                <td>'.$user->role.'</td>';
                                                    $output.='<td>'.$contractsNumber1.'</td>';
                                                    $output.='<td>'.$contractsNumberOkInserito.'</td>';
                                                    $output.='<td>'.$workhours1.'</td>';
                                                    $output.='<td>'.(round(@($contractsNumberOkInserito/$workhours1),3)).'</td>';
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
                <input style="col-sm-6" type="text" class="form-control" id="hoursToAdd" value="6"  placeholder="Inserire il numero di ore">
                <input type="hidden" id="h_user_id">
            </div>
            <div class="form-group col-sm-6" style="margin-bottom: 36px;">
                <input type="date" style="col-sm-6" value="" class="form-control" id="dateToAdd"  placeholder="Inserisci il mese">
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
	  <button type="button" onclick="addHoursM()" class="btn btn-info">Aggiungere ore</button>
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
        if(confirm("Are you sure?")){
          //console.log('po');
        } else {
          return;
        };
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
                        $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td><td><center><button type="button" onclick="deleteHours(`+data[i].workhours_id+`)" class="btn btn-danger btn-xs " name="options" id="option1">X</button></center></td></tr>`)
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
                    if(confirm("Are you sure?")){
                      //console.log('po');
                    } else {
                      return;
                    };
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
                                    $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td><td><center><button type="button" onclick="deleteHours(`+data[i].workhours_id+`)" class="btn btn-danger btn-xs " name="options" id="option1">X</button></center></td></tr>`)
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
                              $('.whtable').append(`<tr><td><center>`+data[i].hours+`</center></td><td><center>`+data[i].date+`</center></td><td><center><button type="button" onclick="deleteHours(`+data[i].workhours_id+`)" class="btn btn-danger btn-xs " name="options" id="option1">X</button></center></td></tr>`)
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
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length-1; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

function filterTabl() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inpu");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabl");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
