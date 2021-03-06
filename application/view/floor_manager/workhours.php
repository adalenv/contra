<script src="<?php echo URL; ?>assets/js/chartist-plugin-legend.js"></script>
<style media="screen">
.ct-legend {
	 position: relative;
	 z-index: 10;
}
 .ct-legend li {
	 position: relative;
	 padding-left: 23px;
	 margin-bottom: 3px;
}
 .ct-legend li:before {
	 width: 12px;
	 height: 12px;
	 position: absolute;
	 left: 0;
	 content: '';
	 border: 3px solid transparent;
	 border-radius: 2px;
}
 .ct-legend li.inactive:before {
	 background: transparent;
}
 .ct-legend.ct-legend-inside {
	 position: absolute;
	 top: 0;
	 right: 0;
}
 .ct-legend .ct-series-0:before {
	 background-color: #00bcd4;
	 border-color: #00bcd4;
}
 .ct-legend .ct-series-1:before {
	 background-color: #f44336;
	 border-color: #f44336;
}
 .ct-legend .ct-series-2:before {
	 background-color: #ff9800;
	 border-color: #ff9800;
}
 .ct-legend .ct-series-3:before {
	 background-color: #9c27b0;
	 border-color: #9c27b0;
}
 .ct-legend .ct-series-4:before {
	 background-color: #4caf50;
	 border-color: #4caf50;
}
 .ct-legend .ct-series-5:before {
	 background-color: #9c9b99;
	 border-color: #9c9b99;
}
 .ct-legend .ct-series-6:before {
	 background-color: #9e44;
	 border-color: #9e44;
}
 .ct-legend .ct-series-7:before {
	 background-color: #dd4b39;
	 border-color: #dd4b39;
}
 .ct-legend .ct-series-8:before {
	 background-color: #35465c;
	 border-color: #35465c;
}
 .ct-legend .ct-series-9:before {
	 background-color: #e52d27;
	 border-color: #e52d27;
}
 .ct-legend .ct-series-10:before {
	 background-color: #55acee;
	 border-color: #55acee;
}
 .ct-legend .ct-series-11:before {
	 background-color: #cc2127;
	 border-color: #cc2127;
}
 .ct-legend .ct-series-12:before {
	 background-color: #1769ff;
	 border-color: #1769ff;
}
 .ct-legend .ct-series-13:before {
	 background-color: #6188e2;
	 border-color: #6188e2;
}
 .ct-legend .ct-series-14:before {
	 background-color: #a748ca;
	 border-color: #a748ca;
}


</style>
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="../../createUser" role="tablist">
                            <i class="material-icons">person_add</i>
                            Creare un utente
                        </a>
                    </li> -->
                    <li class="nav-item active">
                        <a class="nav-link" role="tablist">
                            <i class="material-icons">access_time</i>
                            Ore di Lavoro</br>
                            <input id="month" onchange="window.location.href=this.value;" name="month" style="background: white;color:grey;" type="month">
                        </a>
                    </li>
										<li class="nav-item">
                        <a class="nav-link" href="../workhours_/<?=date('Y-m');?>" role="tablist">
                            <i class="material-icons">access_time</i>
                            Stats</br>
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
                                <th>Ore</th>
                                <th><center>Azione</center></th>
                            </thead>
                            <tbody>
                                <?php
                                    $output='';
                                    foreach ($users as $user) {

                                        $workhours1= (float)$this->model->getWorkhours($user->user_id,$date);
                                        $output.='<tr>
                                                    <td><a class="user_name_l" href="../../viewUser/'.$user->user_id.'">'.$user->first_name.' '.$user->last_name.'</a></td>
                                                    <td>'.$user->role.'</td>';
                                        $output.='<td>'.$workhours1.'</td>';

                                        $output.='<td><center><a type="button" rel="tooltip" class="btn btn-info user_l" onclick="addHours('.$user->user_id.',\''.$user->first_name.' '.$user->last_name.'\')" ><i class="material-icons">access_time</i></a>';
                                        if ($user->role=='supervisor') {
                                          $output.='<a type="button" rel="tooltip" class="btn btn-info user_l" onclick="showStats('.$user->user_id.',\''.$user->first_name.' '.$user->last_name.'\')" ><i class="material-icons">pie_chart</i></a>';
                                        }
                                        $output.='</center></td></tr>';

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
<div class="modal fade" id="show_stats" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="float: left;" id="u_name2"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card card-chart">

                  <div class="card-body">
                    <div id="chartPreferences" class="ct-chart"></div>
                  <div class="card-footer">

                  </div>
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



    function showStats(user_id,user_name){
      $('#u_name2').html(user_name);

			$.ajax({
          url: '<?=URL?>api/showStats/'+user_id+'/<?=$date;?>',
          type: 'POST',
           dataType:'json',
          // data: {user_id: user_id,
          //        date:$('#dateToAdd').val(),
          //       },
        })
        .done(function(data) {
					console.log(data);
					keys=data.map(value => Object.keys(value)[0]);
					values=data.map(value => Object.values(value)[0]);

					keys.forEach(function(part, index) {
						this[index] = this[index]+' | '+values[index];
					}, keys); // use arr as this

					var dataPreferences = {
		          labels: keys,
		          series: values
		      };

		      var optionsPreferences = {
		          height: '230px',
		          width:'100%',

		          showLabel: false,
		            plugins: [
		                Chartist.plugins.legend()
		            ],
		          fullWidth: true,
		              chartPadding: {
		                  right: 40
		              }
		      };

		      var responsiveOptions = [
					    ['screen and (min-width: 640px)', {
					      chartPadding: 30,
					      labelOffset: 100,
					      labelDirection: 'explode',
					      labelInterpolationFnc: function(value) {
					        return value;
					      }
					    }],
					    ['screen and (min-width: 1024px)', {
					      labelOffset: 80,
					      chartPadding: 20
					    }]
					  ];

		      $('#show_stats').modal();

		      Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences,responsiveOptions);
        })
        .fail(function(err) {
          console.log(err);
        });
			}




    $(document).ready(function() {
      $('#show_stats').on('shown.bs.modal', function() {
          document.querySelector("#chartPreferences").__chartist__.update();
      });
    });





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
