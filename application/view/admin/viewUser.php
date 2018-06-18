            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-md-8">
                                        <h4 class="title">Contracts</h4>
                                         <p class="category">Operator</p>
                                     </div>
                                    <div class="col-md-4">
                                        <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate" style="float: right;">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item next" id="datatables_next">
                                                    <a href="<?php if(isset($_GET['page'])){ if($_GET['page']<1){ } else { echo'?page='.($_GET['page']-1); } } else {  } ?>" aria-controls="datatables"  tabindex="0" class="page-link"  >< Previous</a>
                                                </li>
                                                <li class="paginate_button page-item last" id="datatables_last">
                                                    <a href="?page=<?=(int)(isset($_GET['page'])? $_GET['page']+1:1);?>" aria-controls="datatables"  tabindex="0" class="page-link">Next ></a>
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
                                            <th>Address</th>
                                            <th>Location</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $output='';
                                                foreach ($contracts as $contract) {
                                                    $output.='<tr>';
                                                                if ($contract->contract_type=='gas') {
                                                                    $output.='<td>Gas</td>';
                                                                }elseif ($contract->contract_type=='luce') {
                                                                    $output.='<td>Luce</td>';
                                                                }elseif ($contract->contract_type=='dual') {
                                                                    $output.='<td>Dual</td>';
                                                                }
                                                                
                                                    $output.='<td>'.$contract->contract_id.'</td>
                                                                <td>'.$contract->date.'</td>
                                                                <td>'.$contract->first_name.' '.$contract->last_name.'</td>
                                                                <td>'.$contract->address.'</td>
                                                                <td>'.$contract->location.'</td>';
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
            </div>
            <script type="text/javascript">
                $('.usersNav').addClass('active');
            </script>