            <div class="content" style="margin-top: 20px">
                <div class="container-fluid">
                    <div class="row">  
                        <form action="" method="GET" id="main_form">
                            <ul class="card nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                                <div class="row" style="margin-left:5px;margin-right:5px">
                                    <div class="col-md-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Type</label>
                                            <select class="form-control" name="contract_type" id="contract_type">
                                                <option value="%">All</option>
                                                <option value=gas>Gas</option>
                                                <option value="electricity">Electricity</option>
                                                <option value="dual">Dual</option>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Client Name</label>
                                            <input type="text" class="form-control" name="client_name" id="client_name">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value='%'>All statuses</option>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Operator</label>
                                            <select class="form-control" name="operator" id="operator">
                                                <option value='%'>All operators</option>
                                                <?php
                                                    $output=''; 
                                                    foreach ($users as $user) {
                                                        if ($user->role=='operator') {
                                                            $output.='<option value="'.$user->user_id.'" >'.$user->first_name.' '.$user->last_name.'</option>';
                                                        }
                                                    }
                                                    echo $output;
                                                ?>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:5px;margin-right:5px">
                                    <div class="col-md-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">ID</label>
                                            <input type="text" class="form-control" name="id" id="id">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Cancellation Reason</label>
                                            <select class="form-control" name="cancellation_reason" id="cancellation_reason">
                                                <option value="%">All reasons</option>
                                            </select>
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Location</label>
                                            <input type="text" class="form-control" name="location" id="Location">
                                        <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Date</label>
                                            <input type="text" class="form-control" name="date" id="date">
                                        <span class="material-input"></span></div>
                                    </div>
                                        <input class="page_val" type="hidden" name="page" value='<?php echo (isset($_GET['page'])?$_GET['page']:0)?>'>
                                    <div class="col-md-3">
                                        <center>
                                            <div class="form-group label-floating ">
                                                <input type="submit" name="" class="btn btn-info submit_btn">
                                                <a href="#" class="btn reset_btn">Reset</a>
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
                                        <h4 class="title">Contracts</h4>
                                         <p class="category"></p>
                                     </div>
                                    <div class="col-md-4">
                                        <div class="dataTables_paginate paging_full_numbers" style="float: right;" id="datatables_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item next" id="datatables_next">
                                                    <a onclick="$('.page_val').val(<?php if(isset($_GET['page'])){ if($_GET['page']<1){ } else { echo ($_GET['page']-1); } } else {  } ?>);"  aria-controls="datatables" href="#"  tabindex="0" class="page-link pagination_btn"  >< Previous</a>
                                                </li>
                                                <li class="paginate_button page-item last" id="datatables_last">
                                                    <a onclick="$('.page_val').val(<?=(int)(isset($_GET['page'])? $_GET['page']+1:1);?>);"  aria-controls="datatables" href="#"  tabindex="0" class="page-link pagination_btn"  >Next ></a>                                
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>Type</th>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Client Name</th>
                                            <th>Adress</th>
                                            <th>Location</th>
                                            <th>Operator</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($contracts as $contract) {
                                                    $output.='<tr>';
                                                                if ($contract->contract_type=='gas') {
                                                                    $output.='<td><i style="color:#3885e8" class="material-icons">local_gas_station</i></td>';
                                                                }elseif ($contract->contract_type=='electricity') {
                                                                    $output.='<td><i style="color:#ded00f" class="material-icons">battery_charging_full</i></td>';
                                                                }elseif ($contract->contract_type=='dual') {
                                                                    $output.='<td><i style="color:#e68013" class="material-icons">call_split</i></td>';
                                                                }
                                                                

                                                    $output.='<td>'.$contract->contract_id.'</td>
                                                                <td>'.(explode(' ',$contract->date)[0]).'</td>
                                                                <td><a href="viewContract/'.$contract->contract_id.'">'.$contract->first_name.' '.$contract->last_name.'</a></td>
                                                                <td>'.$contract->address.'</td>
                                                                <td>'.$contract->location.'</td>';
                                                                    foreach($users as $user) {
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


                    $(function() {

                        $('.reset_btn').on('click',function() {
                            $('#contract_type').val('%');
                            $('#operator').val('%');
                            $('#status').val('%');
                            $('#cancellation_reason').val('%');
                            $('#id').val('');
                            $('#Location').val('');
                            $('#client_name').val('');
                            document.forms[0].submit();
                        });

                        $('.contractsNav').addClass('active');

                        var contract_type='<?=(isset($_GET['contract_type'])?$_GET['contract_type']:'%')?>';
                        var operator='<?=(isset($_GET['operator'])?$_GET['operator']:'%')?>';
                        var status='<?=(isset($_GET['status'])?$_GET['status']:'%')?>';
                        var cancellation_reason='<?=(isset($_GET['cancellation_reason'])?$_GET['cancellation_reason']:'%')?>';

                        var id='<?=(isset($_GET['id'])?$_GET['id']:'')?>';
                        var Location='<?=(isset($_GET['location'])?$_GET['location']:'')?>';
                        var date='<?=(isset($_GET['date'])?$_GET['date']:'')?>';
                        var client_name='<?=(isset($_GET['client_name'])?$_GET['client_name']:'')?>';

                        $('#contract_type').val(contract_type);

                        $('#operator').val(operator);
                        $('#status').val(status);
                        $('#cancellation_reason').val(cancellation_reason);

                        $('#id').val(id);
                        $('#id').val()!=''? $('#id').parent().addClass('is-focused'):'';

                        $('#Location').val(Location);
                        $('#Location').val()!=''? $('#Location').parent().addClass('is-focused'):'';

                        $('#client_name').val(client_name);
                        $('#client_name').val()!=''? $('#client_name').parent().addClass('is-focused'):'';

                        $('.pagination_btn').on('click',function(e) {
                            e.preventDefault();
                            if ($('#contract_type').val()!=contract_type || $('#operator').val()!=operator || $('#status').val()!=status || $('#cancellation_reason').val()!=cancellation_reason || $('#id').val()!=id || $('#Location').val()!=Location || $('#date').val()!=date || $('#client_name').val()!=client_name) {
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