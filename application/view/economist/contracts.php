            <div class="content" style="margin-top: 20px">
                <div class="container-fluid"> 
                    <div class="row">   
                        <form action="" method="GET" id="main_form">
                            <ul class="card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <div class="row" style="margin-left:5px;margin-right:5px">
                                    <div class="col-md-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia contratto</label>
                                            <select class="form-control" name="contract_type" id="contract_type">
                                                <option value="%">Tutti</option>
                                                <option value="gas">Gas</option>
                                                <option value="luce">Luce</option>
                                                <option value="dual">Dual</option>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Nominativo</label>
                                            <input type="text" class="form-control" name="client_name" id="client_name">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Stato Pratica</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value='%'>Tutti</option>
                                                <?php
                                                    $output=''; 
                                                    foreach ($statuses as $status) {
                                                        $output.='<option value="'.$status->status_id.'" >'.$status->status_name.'</option>';
                                                    }
                                                    echo $output;
                                                ?>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Operatore</label>
                                            <select class="form-control" name="operator" id="operator">
                                                <option value='%'>Tutti</option>
                                                <?php
                                                    $output=''; 
                                                    foreach ($operators as $operator) {
                                                        $output.='<option value="'.$operator->user_id.'" >'.$operator->first_name.' '.$operator->last_name.'</option>';
                                                    }
                                                    echo $output;
                                                ?>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Supervisore</label>
                                            <select class="form-control" name="supervisor" id="supervisor">
                                                <option value='%'>Tutti</option>
                                                <?php
                                                    $output=''; 
                                                    foreach ($supervisors as $supervisor) {
                                                        $output.='<option value="'.$supervisor->user_id.'" >'.$supervisor->first_name.' '.$supervisor->last_name.'</option>';
                                                    }
                                                    echo $output;
                                                ?>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:5px;margin-right:5px">
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Campagna</label>
                                            <select class="form-control" name="campaign" id="campaign">
                                                <option value='%'>Tutti</option>
                                                <?php
                                                    $output=''; 
                                                    foreach ($campaigns as $campaign) {
                                                        $output.='<option value="'.$campaign->campaign_id.'" >'.$campaign->campaign_name.'</option>';
                                                    }
                                                    echo $output;
                                                ?>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Codice Fiscale</label>
                                            <input type="text" class="form-control" name="codice_fiscale" id="codice_fiscale">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Cellulare</label>
                                            <input type="text" class="form-control" name="phone" id="phone">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Data</label>
                                            <input type="text" class="form-control" name="date" id="date">
                                        <span class="material-input"></span></div>
                                    </div>
                                        <input class="page_val" id="page_val" type="hidden" name="page" value='<?php echo (isset($_GET['page'])?$_GET['page']:0)?>'>
                                    <div class="col-md-4">
                                        <center>
                                            <div class="form-group label-floating ">
                                                <input type="submit" name="" value="Ricerca" class="btn btn-info submit_btn">
                                                <a href="#" class="btn reset_btn">Ripristina</a>
                                            <span class="material-input"></span></div>
                                        </center>
                                    </div>
                                </div>
                            </ul>
                        </form>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-md-8">
                                        <div class="card-icon">
                                            <i class="material-icons">assignment</i>
                                          </div>
                                        <h4 class="title">Contratti</h4>
                                         <p class="category"><a style="cursor:pointer;" onclick="exportContracts()">Esporta in Excel</a></p>
                                     </div>
                                    <div class="col-md-4">
                                        <div class="dataTables_paginate paging_full_numbers" style="float: right;" id="datatables_paginate">
<!--                                             <ul class="pagination">
                                                <li class="paginate_button page-item next" id="datatables_next">
                                                    <a onclick="$('.page_val').val(<?php if(isset($_GET['page'])){ if($_GET['page']<1){ } else { echo ($_GET['page']-1); } } else {  } ?>);"  aria-controls="datatables" href="#"  tabindex="0" class="page-link pagination_btn"  >< Precedente</a>
                                                </li>
                                                <li class="paginate_button page-item last" id="datatables_last">
                                                    <a onclick="$('.page_val').val(<?=(int)(isset($_GET['page'])? $_GET['page']+1:1);?>);"  aria-controls="datatables" href="#"  tabindex="0" class="page-link pagination_btn"  >Successivo ></a>                                
                                                </li>
                                            </ul> -->
                                            <?php if (isset($_GET['page'])) {
                                                $page=(int)$_GET['page'];
                                                if ($page==0) {
                                                    $page=1;
                                                }
                                            }else{
                                                $page=1;
                                            } ?>
                                            <script type="text/javascript">
                                                $page=<?=$page?>;
                                            </script>   

                                              <ul class="pagination" style="cursor:pointer;">
                                                <?php if ($page>1) { ?>
                                                    <li class="page-item">
                                                      <a class="page-link" onclick="$('.page_val').val($page-1)" aria-label="Precedentes">
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Precedente</span>
                                                      </a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" onclick="$('.page_val').val($page-1)"><?=$page-1;?></a></li>
                                                <?php } ?>
                                                <li class="page-item active"><a class="page-link" onclick="$('.page_val').val($page)"><?=$page ;?></a></li>
                                                <?php if ($page<$pages-1) { ?>
                                                    <li class="page-item"><a class="page-link" onclick="$('.page_val').val($page+1)"><?=$page+1;?></a></li>
                                                    <li class="page-item">
                                                      <a class="page-link" onclick="$('.page_val').val($page+1)" aria-label="Successivo">
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only"></span>
                                                      </a>
                                                    </li>
                                                <?php } ?>
                                              </ul>
                                              Totale: <?=($pages==0?1:$pages-1);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>Tipo</th>
                                            <th>Nominativo</th>
                                            <th>Stato</th>
                                            <th>Campagna</th>
                                            <th>Operatore</th>
                                            <th>Data</th>
                                            <th>Note</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($contracts as $contract) {

                                                    $output.='<tr class="tdColor'.$contract->status.'">';
                                                                if ($contract->contract_type=='gas') {
                                                                    $output.='<td>Gas</td>';
                                                                }elseif ($contract->contract_type=='luce') {
                                                                    $output.='<td>Luce</td>';
                                                                }else {
                                                                    $output.='<td>Dual</td>';
                                                                }
                                                    $output.='<td><a href="viewContract/'.$contract->contract_id.'">'.$contract->first_name.' '.$contract->last_name.'</a></td>';
                                                    
                                                     $output.='<td><select class="ss'.$contract->contract_id.' statusColor'.$contract->status.'"  id="status_select">';
                                                                foreach ($statuses as $key => $status) {
                                                                    if ($status->status_id==$contract->status) {
                                                                        $output.='<option class="oldstatus'.$contract->contract_id.'" value="'.$status->status_id.'" selected="">'.$status->status_name.'</option>';
                                                                    }  // else{
                                                                    //      $output.='<option value="'.$status->status_id.'">'.$status->status_name.'</option>';
                                                                    // }
                                                                }
                                                    $output.='</select></td>';
                                                                foreach ($campaigns as $key => $campaign) {
                                                                    if ($campaign->campaign_id==$contract->campaign) {
                                                                        $campaign1=$campaign->campaign_name;
                                                                        break;
                                                                    }
                                                                }
                                                    $output.='<td>'.$campaign1.'</td>';

                                                                    foreach($operators as $user) {
                                                                        if ($contract->operator == $user->user_id) {
                                                                            $operator = $user;
                                                                            break;
                                                                        }
                                                                    }
                                                                    if (isset($operator)) {
                                                                        $output.='<td><a href="viewUser/'.$operator->user_id.'">'.$operator->first_name.' '.$operator->last_name.'</td>';
                                                                    } else {
                                                                        $output.= '<td></td>';
                                                                    }
                                                    $note=(strlen($contract->note)>20)?substr($contract->note, 0,20).'...':$contract->note;
                                                    $output.='<td>'.date('d-m-Y',strtotime($contract->date)).'</td>
                                                               <td title="'.$contract->note.'">'.$note.'</td>';
                                                    $output.='</tr>';
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
            
            <script type="text/javascript">

function exportContracts() {
    window.location.href+='&export=true';
}
// function editContractStatus(contract_id,status_id){
//     swal({
//       title: 'Are you sure?',
//       text: "",
//       type: 'warning',
//       showCancelButton: true,
//       cancelButtonColor: '#777',
//       confirmButtonColor: '#00bcd4',
//       confirmButtonText: 'Change'
//     }).then((result) => {
//       if (result.value) {
//         $.ajax({
//             url: '<?=URL?>api/editContractStatus/',
//             type: 'POST',
//             data: {contract_id:contract_id,
//                    status_id:status_id,
//                   },
//           })
//           .done(function(data) {
//             $('.ss'+contract_id).removeClass('statusColor'+$('.oldstatus'+contract_id).val()).addClass('statusColor'+status_id).parent().parent().removeClass('tdColor'+$('.oldstatus'+contract_id).val()).addClass('tdColor'+status_id);
//           })
//           .fail(function(err) {
//             console.log(err);
//           });
//       }else{
//         $($('.ss'+contract_id)).val($('.oldstatus'+contract_id).val());
//       }
//     })
// }
// function editContractCampaign(contract_id,campaign_id){
//     console.log(contract_id,campaign_id);
//     $.ajax({
//         url: '<?=URL?>api/editContractCampaign/',
//         type: 'POST',
//         data: {contract_id:contract_id,
//                campaign_id:campaign_id,
//               },
//       })
//       .done(function(data) {
//         //console.log(data.responseText);      
//       })
//       .fail(function(err) {
//         console.log(err);
//       });
// }

                    $(function() {

                        $('.reset_btn').on('click',function() {
                            $('#contract_type').val('%');
                            $('#operator').val('%');
                            $('#status').val('%');
                            $('#campaign').val('%');
                            $('#supervisor').val('%');
                            $('#codice_fiscale').val('');
                            $('#id').val('');
                            $('#phone').val('');
                            $('#client_name').val('');
                            $('#date').val('');
                            $('#page_val').val(0);
                            document.forms[0].submit();
                        });



                        <?php 
                            if (isset($_SESSION['contract_exist'])) {
                                if ($_SESSION['contract_exist']=='true') { ?> //if fail
                                    $.notify({
                                      icon: "error_outline",
                                      message: "Contract exist!"
                                    },{
                                      type: 'danger',
                                      timer: 300,
                                      placement: {
                                          from: 'top',
                                          align: 'right'
                                      }
                                    });
                            <?php }
                                  unset($_SESSION['contract_exist']);
                            }
                        ?>

                        <?php 
                            if (isset($_SESSION['create_contract'])) {
                                if ($_SESSION['create_contract']=='fail') { ?> //if fail
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
                                  unset($_SESSION['create_contract']);
                            }
                        ?>

                        $('.contractsNav').addClass('active');

                        var contract_type='<?=(isset($_GET['contract_type'])?$_GET['contract_type']:'%')?>';
                        var operator='<?=(isset($_GET['operator'])?$_GET['operator']:'%')?>';
                        var status='<?=(isset($_GET['status'])?$_GET['status']:'%')?>';
                        var campaign='<?=(isset($_GET['campaign'])?$_GET['campaign']:'%')?>';
                        var supervisor='<?=(isset($_GET['supervisor'])?$_GET['supervisor']:'%')?>';

                        var codice_fiscale='<?=(isset($_GET['codice_fiscale'])?$_GET['codice_fiscale']:'')?>';
                        // var id='<?=(isset($_GET['id'])?$_GET['id']:'')?>';
                        var phone='<?=(isset($_GET['phone'])?$_GET['phone']:'')?>';
                        var date='<?=(isset($_GET['date'])?$_GET['date']:'')?>';
                        var client_name='<?=(isset($_GET['client_name'])?$_GET['client_name']:'')?>';

                        $('#contract_type').val(contract_type);

                        $('#operator').val(operator);
                        $('#status').val(status);

                        $('#campaign').val(campaign);
                        $('#supervisor').val(supervisor);
                        

                        // $('#id').val(id);
                        // $('#id').val()!=''? $('#id').parent().addClass('is-focused'):'';

                        $('#phone').val(phone);
                        $('#phone').val()!=''? $('#phone').parent().addClass('is-focused'):'';

                        $('#client_name').val(client_name);
                        $('#client_name').val()!=''? $('#client_name').parent().addClass('is-focused'):'';

                        $('#codice_fiscale').val(codice_fiscale);
                        $('#codice_fiscale').val()!=''? $('#codice_fiscale').parent().addClass('is-focused'):'';

                        $('.page-item').on('click',function(e) {
                            e.preventDefault();
                            //|| $('#id').val()!=id 
                            if ($('#contract_type').val()!=contract_type || $('#operator').val()!=operator || $('#status').val()!=status || $('#campaign').val()!=campaign || $('#codice_fiscale').val()!=codice_fiscale || $('#phone').val()!=phone || $('#date').val()!=date || $('#client_name').val()!=client_name) {
                                $('.page_val').val(0);   
                            }
                            document.forms[0].submit();
                        });
                        $(".submit_btn" ).on('click',function(e) {
                            e.preventDefault();
                            $('.page_val').val(0);
                            document.forms[0].submit();
                        }); 
                        if (date!='') {
                            var start =date.split('-')[0]; 
                            var end = date.split('-')[1]; 
                            $('#date').daterangepicker({
                                startDate: start,
                                endDate: end,
                                locale: {
                                  format: 'YYYY/MM/DD'
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
                                   'All Time': ['1999/01/01',moment()]
                                }
                            });
                        }else{
                            $('#date').daterangepicker({
                                locale: {
                                    format: 'YYYY/MM/DD'
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
                                   'All Time': ['1999/01/01',moment()]
                                }
                            }).val('');
                        }
                    });
            </script>
<style>

    .tdColor1{/*pending*/
        border-left: 2px solid #ff9800;
        border-right: 2px solid #ff9800;
    }
    .statusColor1{
        border: 1px solid #ff9800;
    }

    .tdColor2{/*ok*/
        border-left: 2px solid #4caf50;
        border-right: 2px solid #4caf50;
    }
    .statusColor2{
        border: 1px solid #4caf50;
    }

    .tdColor3{/*ko*/
        border-left: 2px solid #f44336;
        border-right: 2px solid #f44336;
    }
    .statusColor3{
        border: 1px solid #f44336;
    }
    .tdColor4{/*inserito*/
        border-left: 2px solid #337ab7;
        border-right: 2px solid #337ab7;
    }
    .statusColor4{
        border: 1px solid #337ab7;
    }

    .tdColor5{/*da contatare*/
        border-left: 2px solid #8a6d3b;
        border-right: 2px solid #8a6d3b;
    }
    .statusColor5{
        border: 1px solid #8a6d3b;
    }

    .tdColor6{/*switch*/
        border-left: 2px solid #9c27b0;
        border-right: 2px solid #9c27b0;
    }
    .statusColor6{
        border: 1px solid #9c27b0;
    }

    .tdColor7{/*storni*/
        border-left: 2px solid #00bcd4;
        border-right: 2px solid #00bcd4;
    }
    .statusColor7{
        border: 1px solid #00bcd4;
    }
</style>


