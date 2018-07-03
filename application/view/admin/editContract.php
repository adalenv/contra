            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <form method="POST" id="form" action="">
                        <div class="col-sm-12">
                            <div class="card ">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Dati Contrattuali</h4>
                                </div>
                                <div class="card-content">
                                    <div class="row"> 
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Stipula</label>
                                                <input type="text" autocomplete="off" value="<?=date('d-m-Y',strtotime($contract->date))?>" id="contract_date" name="date" class="form-control">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Stato</label>
                                                <select   class="form-control" required name="status" id="status">
                                                    <?php
                                                        $output=''; 
                                                        foreach ($statuses as $status) {
                                                            if ($contract->status==$status->status_id) {
                                                                $output.='<option selected="" value="'.$status->status_id.'" >'.$status->status_name.'</option>';
                                                            }else{
                                                                $output.='<option value="'.$status->status_id.'" >'.$status->status_name.'</option>';
                                                            }
                                                        }
                                                        echo $output;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="checkbox">
                                                <label class="control-label">                                             
                                                    <input type="checkbox" class="cb" <?=($contract->ugm_cb=='true')?'checked':'';?> value="<?=$contract->ugm_cb;?>" name="ugm_cb">Iniziative Promocionali  
                                                </label>
                                                <label class="control-label">
                                                    <input type="checkbox" class="cb" <?=($contract->analisi_cb=='true')?'checked':'';?> value="<?=$contract->analisi_cb;?>" name="analisi_cb">Analisi di Mercato       
                                                </label>                          
                                                <label class="control-label">            
                                                    <input type="checkbox" class="cb" <?=($contract->iniziative_cb=='true')?'checked':'';?> value="<?=$contract->iniziative_cb;?>" name="iniziative_cb">Iniziative Promocionali da terze parti 
                                                </label>  
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group label-floating is-focused">
                                                <label class="control-label">Supervisore</label>
                                                <!-- onchange="getOperators(this.value)" -->
                                                <select class="form-control"  required name="supervisor" id="supervisor">
                                                    <?php
                                                        $output=''; 
                                                        foreach ($supervisors as $supervisor) {
                                                            if ($contract->supervisor==$supervisor->user_id) {
                                                                $output.='<option selected="" value="'.$supervisor->user_id.'" >'.$supervisor->first_name.' '.$supervisor->last_name.'</option>';
                                                            }else{
                                                                $output.='<option value="'.$supervisor->user_id.'" >'.$supervisor->first_name.' '.$supervisor->last_name.'</option>';
                                                            }
                                                        }
                                                        echo $output;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group label-floating is-focused">
                                                <label class="control-label">Operatore</label>
                                                <select class="form-control" required name="operator" id="operator">
                                                   <?php
                                                        $output=''; 
                                                        foreach ($operators as $operator) {
                                                            if ($contract->operator==$operator->user_id) {
                                                                $output.='<option selected="" value="'.$operator->user_id.'" >'.$operator->first_name.' '.$operator->last_name.'</option>';
                                                            }else{
                                                                $output.='<option value="'.$operator->user_id.'" >'.$operator->first_name.' '.$operator->last_name.'</option>';
                                                            }
                                                        }
                                                        echo $output;
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Campagna</label>
                                                <select class="form-control" required name="campaign" id="campaign">
                                                    <?php
                                                        $output=''; 
                                                        foreach ($campaigns as $campaign) {
                                                            if ($contract->campaign==$campaign->campaign_id) {
                                                                $output.='<option selected="" value="'.$campaign->campaign_id.'" >'.$campaign->campaign_name.'</option>';
                                                            }else{
                                                                $output.='<option value="'.$campaign->campaign_id.'" >'.$campaign->campaign_name.'</option>';
                                                            }
                                                        }
                                                        echo $output;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Dati Anagrafici/Aziendali</h4>
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Cliente</label>
                                                <select class="form-control" id="client_type" name="client_type">
                                                    <option value="intestario">Intestario</option>
                                                    <option value="delega">Delega</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($contract->client_type=='delega'){ ?>
                                            <div class="col-sm-12" id="delegaif" style="border: 1px dotted #01bcd0;">
                                                <div id="delegaifc">
                                                     <div class="col-sm-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nome*</label>
                                                            <input type="text" autocomplete="off" value="<?=$contract->delega_first_name;?>" required name="delega_first_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Cognome*</label>
                                                            <input type="text" autocomplete="off" value="<?=$contract->delega_last_name;?>" required name="delega_last_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Codice Fiscale*</label>
                                                            <input type="text" autocomplete="off" value="<?=$contract->delega_vat_number;?>" required name="delega_vat_number" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-sm-12" id="delegaif" style="display:none;border: 1px dotted #01bcd0;">
                                                <div id="delegaifc"></div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-6">
                                            <label>Sesso:</label>
                                            <div class="checkbox">                                         
                                                <input type="radio" class="gender_cb" <?=($contract->gender=='male')?'checked':'';?>  value="male" name="gender" id="uomo_cb" checked="">&nbsp;Uomo 
                                                    &nbsp;&nbsp;&nbsp;
                                                <input type="radio" class="gender_cb" <?=($contract->gender=='female')?'checked':'';?>  value="female" name="gender" id="donna_cb">&nbsp;Donna                           
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Ragione Sociale</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->rag_sociale;?>" name="rag_sociale" class="form-control">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nome*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->first_name;?>" required name="first_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cognome*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->last_name;?>" required name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice Fiscale*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->vat_number;?>" required name="vat_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Partita Iva</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->partita_iva;?>" class="form-control" name="partita_iva">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data di Nascita*</label>
                                                <input type="text" autocomplete="off" value="<?=date('d-m-Y',strtotime($contract->birth_date))?>" required  id="birth_date" class="form-control" name="birth_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Luogo di Nascita*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->birth_nation;?>" required class="form-control" name="birth_nation">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provinca di Nascita*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->birth_municipality;?>" required  class="form-control" name="birth_municipality">
                                            </div>
                                        </div>
                                        <div class="col-sm-3"> 
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo di Documento*</label>
                                                <select class="form-control" id="document_type" name="document_type">
                                                    <option value="id_card">Carta Identita</option>
                                                    <option value="passport">Passporto</option>
                                                    <option value="patent">Patente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Numero di Documento*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->document_number;?>" required class="form-control" name="document_number">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Rilascio Documento*</label>
                                                <input type="text" autocomplete="off" value="<?=date('d-m-Y',strtotime($contract->document_date))?>" required id="document_date" class="form-control" name="document_date">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Scadenza Documento*</label>
                                                <input type="text" autocomplete="off" value="<?=date('d-m-Y',strtotime($contract->document_expiry))?>" id="document_expiry" name="document_expiry" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Luogo di rilascio*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->document_issue_place;?>"  id="document_issue_place" name="document_issue_place" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Dati Anagrafici/Aziendali</h4>
                                </div>
                                <div class="card-content">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Telefono*</label>
                                        <input type="text" autocomplete="off" value="<?=$contract->tel_number;?>" name="tel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Fax/Altro Numero</label>
                                        <input type="text" autocomplete="off" value="<?=$contract->alt_number;?>" name="alt_number" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare*</label>
                                        <input type="text" autocomplete="off" value="<?=$contract->cel_number;?>" name="cel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 2</label>
                                        <input type="text" autocomplete="off" value="<?=$contract->cel_number2;?>" name="cel_number2" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 3</label>
                                        <input type="text" autocomplete="off" value="<?=$contract->cel_number3;?>" name="cel_number3" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email*</label>
                                        <input type="email" value="<?=$contract->email;?>" name="email"  class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email alternativa</label>
                                        <input type="email" value="<?=$contract->alt_email;?>" name="alt_email" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Residenza/Sede legale</h4>
                                </div>
                                <div class="card-content">
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Toponimo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->toponimo;?>" required class="form-control" name="toponimo">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->address;?>" required class="form-control" name="address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->civico;?>" required class="form-control" name="civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Comune</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->price;?>" required class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Provincia*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->location;?>" required class="form-control" name="location">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cap*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->cap;?>" required class="form-control" name="cap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-sm-8">
                                        <h4 class="title">Ubicazione Fornitura</h4> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">                                         
                                            <input type="radio" <?=($contract->ubicazione_fornitura=='resident')?'checked':'';?>  value="resident" name="ubicazione_fornitura">&nbsp; Residente  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" <?=($contract->ubicazione_fornitura=='non_resident')?'checked':'';?>  value="non_resident" name="ubicazione_fornitura">&nbsp;Non Residente                           
                                        </div>
                                    </div>
                                </div>
                                <?php if ($contract->ubicazione_fornitura=='non_resident') { ?>
                                     <div class="card-content" id="ubicazioneif">
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Toponimo*</label>
                                                <input type="text" autocomplete="off" required="" value="<?=$contract->uf_toponimo;?>" class="form-control" name="uf_toponimo">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Indirizzo*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->uf_address;?>" required=""   class="form-control" name="uf_address">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Civico*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->uf_civico;?>" required=""  class="form-control" name="uf_civico">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->uf_price;?>" required=""  class="form-control" name="uf_price">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provincia*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->uf_location;?>" required=""  class="form-control" name="uf_location">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cap*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->uf_cap;?>" required=""  class="form-control" name="uf_cap">
                                            </div>
                                        </div>
                                    </div>
                                <?php } else{ ?>
                                    <div class="card-content" id="ubicazioneif"  style="display:none;" >
                                 
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-sm-6">
                                        <h4 class="title">Domicillazione documenti e fatture</h4> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">                                         
                                            <input type="radio" <?=($contract->domicillazione_documenti_fatture=='residenza')?'checked':'';?>  value="residenza" name="domicillazione_documenti_fatture" >&nbsp; Residenza/Sede Legale  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" <?=($contract->domicillazione_documenti_fatture=='ubicazione_fornitura')?'checked':'';?> value="ubicazione_fornitura" name="domicillazione_documenti_fatture">&nbsp;Ubicazione fornitura   
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" <?=($contract->domicillazione_documenti_fatture=='altro')?'checked':'';?> value="altro" name="domicillazione_documenti_fatture" >&nbsp;Altro                       
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content" id="domicillazioneif" >
                                    <?php if ($contract->domicillazione_documenti_fatture=='altro'): ?>
                                        <div class="card-content">
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Toponimo*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_toponimo;?>" required class="form-control" name="ddf_toponimo">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Indirizzo*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_address;?>" required class="form-control" name="ddf_address">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Civico*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_civico;?>" required class="form-control" name="ddf_civico">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_price;?>" required class="form-control" name="ddf_price">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provincia*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_location;?>" required  class="form-control" name="ddf_location">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cap*</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->ddf_cap;?>" required  class="form-control" name="ddf_cap">
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-sm-6">
                                        <h4 class="title">Contratto</h4> 
                                    </div>
                                </div>
                                 <div class="card-content">
                                    <div class="col-sm-8">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia contratto*</label>
                                            <select class="form-control" id="contract_type" name="contract_type">
                                                <option value="dual">Dual</option>
                                                <option value="luce">Luce</option>
                                                <option value="gas">Gas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Listino*</label>
                                            <select class="form-control" id="listino" name="listino">
                                                <option>FIX12 TS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($contract->contract_type=='dual'){ ?>
                            <div class="col-sm-12"  id="gasif">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Gas Naturale
                                        </h4> 
                                    </div>
                                     <div class="card-content"  id="gasifc">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="gas_request_type" name="gas_request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_pdr;?>" class="form-control" name="gas_pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="gas_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="gas_consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-12"  id="luceif">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Energia Electrica
                                        </h4> 
                                    </div>
                                     <div class="card-content" id="luceifc">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="luce_request_type" name="luce_request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">POD</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_pod;?>" class="form-control" name="luce_pod">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="luce_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Opzione Oraria</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_opzione_oraria;?>" class="form-control" name="luce_opzione_oraria">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Potenza</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_potenza;?>" class="form-control" name="luce_potenza">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tenzione</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_tensione;?>" class="form-control" name="luce_tensione">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="luce_consume_annuo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($contract->contract_type=='gas') { ?>
                            <div class="col-sm-12"  id="gasif">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Gas Naturale
                                        </h4> 
                                    </div>
                                     <div class="card-content" id="gasifc">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="gas_request_type" name="gas_request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_pdr;?>" class="form-control" name="gas_pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="gas_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="gas_consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="luceif" style="display:none">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Energia Electrica
                                        </h4> 
                                    </div>
                                     <div class="card-content"  id="luceifc">
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($contract->contract_type=='luce') { ?>
                            <div class="col-sm-12" id="luceif">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Energia Electrica
                                        </h4> 
                                    </div>
                                     <div class="card-content"  id="luceifc">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="luce_request_type" name="luce_request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">POD</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_pod;?>" class="form-control" name="luce_pod">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="luce_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Opzione Oraria</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_opzione_oraria;?>" class="form-control" name="luce_opzione_oraria">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Potenza</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_potenza;?>" class="form-control" name="luce_potenza">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tenzione</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_tensione;?>" class="form-control" name="luce_tensione">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="luce_consume_annuo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="gasif" style="display:none">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Gas Naturale
                                        </h4> 
                                    </div>
                                     <div class="card-content"  id="gasifc">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                         <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        <div class="checkbox">
                                            <label class="control-label">                                             
                                                <input type="checkbox" class="cb" <?=($contract->fature_via_email=='true')?'checked':'';?> value="<?=$contract->fature_via_email;?>"  name="fature_via_email">
                                            </label>
                                            Richiede l`invio della fatura via mail
                                        </div>
                                    </h4> 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header row" data-background-color="blue">
                                    <div class="col-sm-6">
                                        <h4 class="title">Modalita di pagamento</h4> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">                                         
                                            <input type="radio" <?=($contract->payment_type=='postal')?'checked':'';?> value="postal" name="payment_type">&nbsp; Bolletino Postale
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" <?=($contract->payment_type=='cc')?'checked':'';?> value="cc" name="payment_type">&nbsp;Addebido su Conto Corrente              
                                        </div>
                                    </div>
                                </div>
                                <?php if ($contract->payment_type=='cc') {?>
                                    <div class="card-content" id="paymentif">
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_code;?>" class="form-control" name="iban_code">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Intestario IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_accounthoder;?>" class="form-control" name="iban_accounthoder">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice ficsale Intestario IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_fiscal_code;?>" class="form-control" name="iban_fiscal_code">
                                            </div>
                                        </div>
                                    </div>
                               <?php } else { ?>
                                        <div class="card-content" id="paymentif">
                               <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                            Documents / Audio`s
                                    </h4> 
                                </div>
                                <div class="card-content">
                                    <div class="row" id="docs">
                                        <div class="col-sm-6 dz-parent">
                                            <div id="zdrop" class="fileuploader">
                                                <div id="upload-label" >
                                                    <span class="title">Drag your Documents here</span>
                                                    <span>Or click to select<span/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 dz-parent">
                                            <div id="adrop" class="fileuploader">
                                                <div id="upload-label2" >
                                                    <span class="title">Drag your Audio files here</span>
                                                    <span>Or click to select<span/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" >
                                        <div class="table-responsive table-sales"  style="
                                                            border-bottom: 1px #5bc0de dashed;
                                                            border-left: 1px #5bc0de dashed;
                                                            border-right: 1px #5bc0de dashed;">
                                            <table class="table">
                                                <tbody class="doc-container">
                                                    <tr>
                                                        <td>
                                                            No documents!
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="table-responsive table-sales"  style="
                                                            border-bottom: 1px #5bc0de dashed;
                                                            border-left: 1px #5bc0de dashed;
                                                            border-right: 1px #5bc0de dashed;">
                                            <table class="table">
                                                <tbody class="audio-container">
                                                    <tr>
                                                        <td>
                                                            No Audio!
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12">
                            <div class="card">
                                 <div class="card-content">
                                    <div class="col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Note:</label>
                                            <textarea class="form-control" name="note"><?=$contract->note;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="edit_contract" value="true">
                                        <a href="../" class="btn btn-info pull-left">Annulla</a>
                                        <a onclick="deleteContract(<?=$contract->contract_id;?>)" class="btn btn-danger pull-left">Delete</a>
                                        <button type="submit" class="submit-btn btn btn-warning  pull-right">Update</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      </form>
                    </div>
                </div>
            </div>
<script type="text/javascript">
$(document).ready(function(){
    $('[name="payment_type"]').change(function() {
        if ($(this).val()=='cc') {
            $('#paymentif').html(`<div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_code;?>" class="form-control" name="iban_code">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Intestario IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_accounthoder;?>" class="form-control" name="iban_accounthoder">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice ficsale Intestario IBAN</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->iban_fiscal_code;?>" class="form-control" name="iban_fiscal_code">
                                            </div>
                                        </div>`);
        } else{
            $('#paymentif').html('');
        }
    });
    $('[name="client_type"]').change(function(){
        if ($(this).val()=='delega') {
            $('#delegaif').show();
            $('#delegaifc').html(`<div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nome*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->delega_first_name;?>" required name="delega_first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cognome*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->delega_last_name;?>" required name="delega_last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice Fiscale*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->delega_vat_number;?>" required name="delega_vat_number" class="form-control">
                                        </div>
                                    </div>`);
        }else{
            $('#delegaif').hide();
            $('#delegaifc').html('');
        };

    });

    $('[name="ubicazione_fornitura"]').change(function(){
        console.log($(this).val());
        if ($(this).val()=='resident') {
            $('#ubicazioneif').html('');
            $('#ubicazioneif').hide()
        }else {
            $('#ubicazioneif').show();
            $('#ubicazioneif').html(`<div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Toponimo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->uf_toponimo;?>" required class="form-control" name="uf_toponimo">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->uf_address;?>" required class="form-control" name="uf_address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->uf_civico;?>" required class="form-control" name="uf_civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Comune</label>
                                            <input type="text" autocomplete="off"value="<?=$contract->uf_price;?>" required class="form-control" name="uf_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Provincia*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->uf_location;?>" required class="form-control" name="uf_location">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cap*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->uf_cap;?>" required class="form-control" name="uf_cap">
                                        </div>
                                    </div>`);
            $('#uf_toponimo').val('<?=$contract->uf_toponimo;?>') 
        }
    })
    $('[name="domicillazione_documenti_fatture"]').change(function(){
        console.log($(this).val());
        if ($(this).val()=='altro') {
            $('#domicillazioneif').show();
            $('#domicillazioneif').html(`  <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Toponimo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_toponimo;?>" required class="form-control" name="ddf_toponimo">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_address;?>" required class="form-control" name="ddf_address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_civico;?>" required class="form-control" name="ddf_civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Comune</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_price;?>" required class="form-control" name="ddf_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Provincia*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_location;?>" required class="form-control" name="ddf_location">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cap*</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->ddf_cap;?>" required class="form-control" name="ddf_cap">
                                        </div>
                                    </div>`);
            $('#ddf_toponimo').val('<?=$contract->ddf_toponimo;?>') 
        }else {
            $('#domicillazioneif').html('');
            $('#domicillazioneif').hide();
        }
    })
    $('[name="contract_type"]').change(function(){
        console.log($(this).val());
        if ($(this).val()=='dual') {
            $('#luceif').show();
            $('#luceifc').html(`<div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" id="luce_request_type" name="luce_request_type">
                                                <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">POD</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_pod;?>" class="form-control" name="luce_pod">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="luce_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opzione Oraria*</label>
                                            <select class="form-control"  id="luce_opzione_oraria" name="luce_opzione_oraria">
                                                <option>Opzione 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Potenza</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_potenza;?>" class="form-control" name="luce_potenza">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tensione</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_tensione;?>" class="form-control" name="luce_tensione">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consumo Annuo</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="luce_consume_annuo">
                                        </div>
                                    </div>`);
            $('#gasif').show();
            $('#gasifc').html(`<div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="gas_request_type" name="gas_request_type">
                                                    <option>Mercato Libero</option>
                                                    <option>Maggior Tutela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_pdr;?>" class="form-control" name="gas_pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="gas_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="gas_consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>`);
            $('#gas_request_type').val('<?=$contract->gas_request_type;?>');
            $('#luce_request_type').val('<?=$contract->luce_request_type;?>');

        }else if ($(this).val()=='luce') {
            $('#luceif').show();
            $('#luceifc').html(`<div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" id="luce_request_type" name="luce_request_type">
                                                <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">POD</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_pod;?>" class="form-control" name="luce_pod">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="luce_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opzione Oraria*</label>
                                            <select class="form-control"  id="luce_opzione_oraria" name="luce_opzione_oraria">
                                                <option>Opzione 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Potenza</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_potenza;?>" class="form-control" name="luce_potenza">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tensione</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_tensione;?>" class="form-control" name="luce_tensione">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consumo Annuo</label>
                                            <input type="text" autocomplete="off" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="luce_consume_annuo">
                                        </div>
                                    </div>`);
            $('#luce_request_type').val('<?=$contract->luce_request_type;?>');
            $('#gasif').hide();
            $('#gasifc').html('');
        }else if ($(this).val()=='gas') {
            $('#luceif').hide();
            $('#luceifc').html('');
            $('#gasif').show();
            $('#gasifc').html(`<div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select  class="form-control" id="gas_request_type" name="gas_request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_pdr;?>" class="form-control" name="gas_pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="gas_fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input  type="text" autocomplete="off" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="gas_consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input  type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>`);
            $('#gas_request_type').val('<?=$contract->gas_request_type;?>');
        }
    })
});

function deleteContract(contract_id) {
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
        $.ajax({
          url: '<?=URL;?>api/deleteContract/',
          type: 'POST',
          data:{contract_id:contract_id}
        })
        .done(function(data) {
            
            if (data=='success') {
                window.location.href='<?=URL;?>';
            }
            console.log(data);
        })
        .fail(function(err) {
            console.log(err);
        })
      } 
    })
}
// function getOperators(supervisor_id){
//     $.ajax({
//       url: '<?=URL;?>api/ApigetUsersBySupervisor/'+supervisor_id,
//       type: 'GET',
//       dataType: 'json',
//     })
//     .done(function(data) {
//         dataa=data;
//         $('#operator').html('');
//         $('#operator').focus();
//         for (var i=0;i<data.length;i++) {
//            $('#operator').append('<option value='+data[i].user_id+'>'+data[i].full_name+'</option>');
//         };

//     })
//     .fail(function(err) {
//         console.log(err);
//     })
// }


$(document).ready(function(){
    initDocUploader("#zdrop");
    initAudioUploader("#adrop");
    loadDocAndAudio();
    // getOperators($('#supervisor').val());
    $('.contractsNav').addClass('active');

    $('#form').on('submit',function(e){
        if (!validate()) {
            e.preventDefault();
        };
    });
});



    $('#contract_date').datetimepicker({
        format: 'DD-MM-YYYY',
     });
    $('#birth_date').datetimepicker({
        format: 'DD-MM-YYYY',
     });
    $('#document_date').datetimepicker({
        format: 'DD-MM-YYYY',
     });
    $('#document_expiry').datetimepicker({
        format: 'DD-MM-YYYY',
     });

$('.cb').on('click',function() {
    $(this).val($(this).val()=='false'?'true':'false');
});

$('#uf_toponimo').val('<?=$contract->uf_toponimo;?>') 
$('#ddf_toponimo').val('<?=$contract->ddf_toponimo;?>') 

$('#gas_request_type').val('<?=$contract->gas_request_type;?>');
$('#luce_request_type').val('<?=$contract->luce_request_type;?>');

$('#client_type').val('<?=$contract->client_type;?>');
$('#document_type').val('<?=$contract->document_type;?>');
$('#contract_type').val('<?=$contract->contract_type;?>');
$('#listino').val('<?=$contract->listino;?>');



function loadDocAndAudio() {
    $.ajax({//doc
        url: "<?=URL.$_SESSION['role']?>/getDocuments/<?=$contract->contract_id;?>",
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data) {
        if (data.length>0) {
            $('.doc-container').html('');
            $.each(data, function (i) {
                $('.doc-container').append('<tr><td><a href="<?=URL.$_SESSION['role']?>/getDocument/'+data[i].document_id+'">'+data[i].url+'</a></td><td><b onclick="deleteDocument('+data[i].document_id+',\''+data[i].url+'\')" style="color:red;cursor:pointer;">X</b></td></tr>');
            });
        }else {
            $('.doc-container').html('<tr><td>No documents!</td></tr>');
        }
    })
    .fail(function() {
          console.log("error");
    })  
    $.ajax({//audio
        url: "<?=URL.$_SESSION['role']?>/getAudios/<?=$contract->contract_id;?>",
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data) {
        if (data.length>0) {
            $('.audio-container').html('');
            console.log(data);
            $.each(data, function (i) {
                $('.audio-container').append('<tr><td><a target="_blank" href="<?=URL.$_SESSION['role']?>/getAudio/'+data[i].audio_id+'">'+data[i].url+'</a></td><td><b onclick="deleteAudio('+data[i].audio_id+',\''+data[i].url+'\')" style="color:red;cursor:pointer;">X</b></td></tr>');
            });
        }else {
            $('.audio-container').html('<tr><td>No Audio!</td></tr>');
        }
    })
    .fail(function() {
          console.log("error");
    })        
}

function deleteAudio(audio_id,url){
    swal({
      title:'Are you sure?',
      text: 'You won\'t be able to revert this!',
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#00bcd4',
      confirmButtonColor: '#f44336',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.value) {
            $.ajax({//document
                url: "<?=URL;?>/api/deleteAudio",
                type: 'POST',
                data:{audio_id:audio_id,url:url},
            })
            .done(function(data) {
                loadDocAndAudio();
            })
            .fail(function() {
                  console.log("error");
            }) 
      }
    })   
}

function deleteDocument(document_id,url){
    swal({
      title:'Are you sure?',
      text: 'You won\'t be able to revert this!',
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#00bcd4',
      confirmButtonColor: '#f44336',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.value) {
            $.ajax({//document
                url: "<?=URL;?>/api/deleteDocument",
                type: 'POST',
                data:{document_id:document_id,url:url},
            })
            .done(function(data) {
                loadDocAndAudio();
            })
            .fail(function() {
                  console.log("error");
            }) 
      }
    })
}

function initAudioUploader(target) {
    var previewNode = document.querySelector("#adrop-template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var adrop = new Dropzone(target, {
        url: "<?=URL.$_SESSION['role']?>/uploadAudios",
        previewTemplate: previewTemplate,
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: "#upload-label2",
        acceptedFiles:"audio/*"
    });

    adrop.on('dragenter', function () {
        $('.fileuploader').addClass("active");
    });

    adrop.on('dragleave', function () {
        $('.fileuploader').removeClass("active");           
    });

    adrop.on('drop', function () {
        $('.fileuploader').removeClass("active");   
    });

    adrop.on('sending', function(file, xhr, formData){
        formData.append('contract_id',"<?=$contract->contract_id;?>");
        formData.append('client_name',"<?=$contract->first_name.' '.$contract->last_name;?>");
    });
    adrop.on("success", function(file, responseText) {
       loadDocAndAudio();
    });
}
function initDocUploader(target) {
    var previewNode = document.querySelector("#zdrop-template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var zdrop = new Dropzone(target, {
        url: "<?=URL.$_SESSION['role']?>/uploadDocuments",
        previewTemplate: previewTemplate,
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: "#upload-label"
    });

    zdrop.on('dragenter', function () {
        $('.fileuploader').addClass("active");
    });

    zdrop.on('dragleave', function () {
        $('.fileuploader').removeClass("active");           
    });

    zdrop.on('drop', function () {
        $('.fileuploader').removeClass("active");   
    });

    zdrop.on('sending', function(file, xhr, formData){
        formData.append('contract_id',"<?=$contract->contract_id;?>");
        formData.append('client_name',"<?=$contract->first_name.' '.$contract->last_name;?>");
    });
    zdrop.on("success", function(file, responseText) {
        loadDocAndAudio();
    });
} 


function getOperators(supervisor_id){
    $.ajax({
      url: '<?=URL;?>api/ApigetUsersBySupervisor/'+supervisor_id,
      type: 'GET',
      dataType: 'json',
    })
    .done(function(data) {
        dataa=data;
        $('#operator').html('');
        for (var i=0;i<data.length;i++) {
            if (data[i].user_id=="<?=$contract->operator?>") {
                $('#operator').focus();
                $('#operator').append('<option selected value='+data[i].user_id+'>'+data[i].full_name+'</option>');
            }else{
                $('#operator').append('<option value='+data[i].user_id+'>'+data[i].full_name+'</option>');
            }
           
        };

    })
    .fail(function(err) {
        console.log(err);
    })
}

function validate(){
    var valid=true;
    if (typeof($('[name="gas_pdr"]').val())!='undefined') {
        if ($('[name="gas_pdr"]').val().length!=14) {
            $.notify({
              icon: "done",
              message: "PDR must have 14 characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="gas_pdr"]').focus();
            valid=false;
        };
    };
    if (typeof($('[name="luce_pod"]').val())!='undefined') {
        if ($('[name="luce_request_type"]').val()=='Maggior Tutela') {
            if ($('[name="luce_pod"]').val().length!=15) {
                $.notify({
                  icon: "done",
                  message: "POD must have 15 characters!"
                },{
                  type: 'danger',
                  timer: 300,
                  placement: {
                      from: 'top',
                      align: 'right'
                  }
                });
                $('[name="luce_pod"]').focus();
                valid=false;
            };
        } else{
        if ($('[name="luce_pod"]').val().length!=14) {
            $.notify({
              icon: "done",
              message: "POD must have 14 characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="luce_pod"]').focus();
            valid=false;
        };
        }

    };

    if (typeof($('[name="iban_code"]').val())!='undefined') {
        if ($('[name="iban_code"]').val().length!=27) {
            $.notify({
              icon: "done",
              message: "IBAN must have 27 characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="iban_code"]').focus();
            valid=false;
        };
    };
    if (typeof($('[name="luce_potenza"]').val())!='undefined') {
        if ($('[name="luce_potenza"]').val().length>3) {
            $.notify({
              icon: "done",
              message: "Potenza must have 3 or less characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="luce_potenza"]').focus();
            valid=false;
        };
    };

    if (typeof($('[name="luce_tensione"]').val())!='undefined') {
        if ($('[name="luce_tensione"]').val().length>3) {
            $.notify({
              icon: "done",
              message: "Tensione must have 3 or less characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="luce_tensione"]').focus();
            valid=false;
        };
    };
    if (typeof($('[name="cel_number"]').val())!='undefined') {
        var a=Number($('[name="cel_number"]').val());
        if ($('[name="cel_number"]').val().length< 10 || $('[name="cel_number"]').val().length>13 || !a) {
            $.notify({
              icon: "done",
              message: "Invalid phone number!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="cel_number"]').focus();
            valid=false;
        };
    };

    if (typeof($('[name="tel_number"]').val())!='undefined') {
        var a=Number($('[name="tel_number"]').val());
        ee=a;
        
        if ($('[name="tel_number"]').val().length< 10 || $('[name="tel_number"]').val().length>13 || !a) {
            $.notify({
              icon: "done",
              message: "Invalid phone number!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="tel_number"]').focus();
            valid=false;
        };
    };
    $('input[type=text]').val (function () {
        return this.value.toUpperCase();
    });
    return valid;
}

</script>


<style type="text/css">
    .fileuploader{
      position: relative;
      border: 1px #5bc0de dashed !important;
      background: white;
      width: 100%;
      border: 1px solid #e9e9e9;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }
    .fileuploader #upload-label{
      position: inherit !important;
      background: white;
      color: grey;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      padding: 16px;
      position: absolute;
      top: 45%;
      left: 0;
      right: 0;
      margin-right: auto;
      margin-left: auto;
      min-width: 20%;
      text-align: center;
      padding-top: 40px;
      transition: 0.8s all;
      -webkit-transition: 0.8s all;
      -moz-transition: 0.8s all;
      cursor: pointer;
    }
.fileuploader #upload-label2{
      position: inherit !important;
      background: white;
      color: grey;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      padding: 16px;
      position: absolute;
      top: 45%;
      left: 0;
      right: 0;
      margin-right: auto;
      margin-left: auto;
      min-width: 20%;
      text-align: center;
      padding-top: 40px;
      transition: 0.8s all;
      -webkit-transition: 0.8s all;
      -moz-transition: 0.8s all;
      cursor: pointer;
    }
    .fileuploader.active{
      background: #2196F3;
    }
    .fileuploader.active #upload-label{
      background: #fff;
      color: #2196F3;
    }
    .fileuploader #upload-label span.title{
      font-size: 1.1em;
      font-weight: bold;
      display: block;
    }
    .fileuploader.active #upload-label2{
      background: #fff;
      color: #2196F3;
    }
    .fileuploader #upload-label2 span.title{
      font-size: 1.1em;
      font-weight: bold;
      display: block;
    }

</style>

            <!-- Preview collection of uploaded documents -->
            <div class="preview-container" style="display: none">
                <div class="header">
                    <span>Uploaded Files</span> 
                    <i id="controller" class="material-icons">keyboard_arrow_down</i>
                </div>
                <div class="collection card" id="previews">
                    <div class="collection-item clearhack valign-wrapper item-template" id="adrop-template"></div>
                    <div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">
                        <div class="left pv zdrop-info" data-dz-thumbnail>
                            <div>
                                <span data-dz-name></span> <span data-dz-size></span>
                            </div>
                            <div class="progress">
                                <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                            </div>
                            <div class="dz-error-message"><span data-dz-errormessage></span></div>
                        </div>

                        <div class="secondary-content actions">
                            <a href="#" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="material-icons white-text">clear</i></i></a>
                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">
	$("input[type='text']").keyup(function () {
    	this.value = this.value.toLocaleUpperCase();
	});
</script>