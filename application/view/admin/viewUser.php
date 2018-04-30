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
                                        <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item next" id="datatables_next">
                                                    <a href="#" aria-controls="datatables"  tabindex="0" class="page-link">< Previous</a>
                                                </li>
                                                <li class="paginate_button page-item last" id="datatables_last">
                                                    <a href="#" aria-controls="datatables"  tabindex="0" class="page-link">Next ></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
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
                                                    $output.='<tr>
                                                                <td>'.$contract->contract_id.'</td>
                                                                <td>'.$contract->date.'</td>
                                                                <td>'.$contract->first_name.' '.$contract->last_name.'</td>
                                                                <td>'.$contract->address.'</td>
                                                                <td>'.$contract->location.'</td>
                                                                <td>'.$contract->operator.'</td>
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