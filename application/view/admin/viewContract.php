            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <form method="POST" action="">
                        <div class="col-sm-12">
                            <div class="card ">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Dati Contrattuali</h4>
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating bmd-form-group is-filled">
                                                <label class="control-label">Data Stipula</label>
                                                <input  type="text" disabled="" value="<?=date('d-m-Y',strtotime($contract->date))?>" id="contract_date" name="date" class="form-control">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Stato</label>
                                                <select disabled="" class="form-control" required name="status" id="status">
                                                    <option selected="" value='<?=$contract->status_id;?>'><?=$contract->status_name;?></option>
                                                </select>
                                            </div>
                                            <div class="checkbox">
                                                <label class="control-label">                                             
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->ugm_cb=='true')?'checked':'';?> value="<?=$contract->ugm_cb;?>" name="ugm_cb">Iniziative Promocionali  
                                                </label>
                                                <label class="control-label">
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->analisi_cb=='true')?'checked':'';?> value="<?=$contract->analisi_cb;?>" name="analisi_cb">Analisi di Mercato       
                                                </label>                          
                                                <label class="control-label">            
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->iniziative_cb=='true')?'checked':'';?> value="<?=$contract->iniziative_cb;?>" name="iniziative_cb">Iniziative Promocionali da terze parti 
                                                </label>  
                                            </div>
            
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Supervisore</label>
                                                <select disabled="" class="form-control" required name="supervisor" id="supervisor">
                                                    <option value=''></option>
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
                                            <div class="form-group label-floating">
                                                <label class="control-label">Operatore</label>
                                                <select disabled="" class="form-control" required name="operator" id="operator">
                                                    <option value=''></option>
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
                                                <label class="control-label">Campaigna</label>
                                                <select disabled="" class="form-control" required name="campaign" id="campaign">
                                                    <option value=''></option>
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
                                                <select disabled="" class="form-control" id="client_type" name="client_type">
                                                    <option value="intestario">Intestario</option>
                                                    <option value="delega">Delega</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($contract->client_type=='delega'): ?>
                                            <div class="col-sm-12" id="delegaif" style="border: 1px dotted #01bcd0;">
                                                <div class="col-sm-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nome*</label>
                                                        <input type="text" disabled="" value="<?=$contract->delega_first_name;?>" name="delega_first_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Cognome*</label>
                                                        <input type="text" disabled="" value="<?=$contract->delega_last_name;?>" name="delega_last_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Codice Fiscale*</label>
                                                        <input type="text" disabled="" value="<?=$contract->delega_vat_number;?>" name="delega_vat_number" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <div class="col-sm-6">
                                            <label>Sesso:</label>
                                            <div class="checkbox">                                         
                                                <input disabled="" type="radio" class="gender_cb" <?=($contract->gender=='male')?'checked':'';?>  value="male" name="gender" id="uomo_cb" checked="">&nbsp;Uomo 
                                                    &nbsp;&nbsp;&nbsp;
                                                <input disabled="" type="radio" class="gender_cb" <?=($contract->gender=='female')?'checked':'';?>  value="female" name="gender" id="donna_cb">&nbsp;Donna                           
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Ragione Sociale</label>
                                                <input disabled="" type="text" value="<?=$contract->rag_sociale;?>" name="rag_sociale" class="form-control">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nome*</label>
                                                <input disabled="" type="text" value="<?=$contract->first_name;?>" required name="first_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cognome*</label>
                                                <input disabled="" type="text" value="<?=$contract->last_name;?>" required name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice Fiscale*</label>
                                                <input disabled="" type="text" value="<?=$contract->vat_number;?>" required name="vat_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Partita Iva</label>
                                                <input disabled="" type="text" value="<?=$contract->partita_iva;?>" class="form-control" name="partita_iva">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data di Nascita*</label>
                                                <input disabled="" type="text" value="<?=date('d-m-Y',strtotime($contract->birth_date))?>" required  id="birth_date" class="form-control" name="birth_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Luogo di Nascita*</label>
                                                <input disabled="" type="text" value="<?=$contract->birth_nation;?>" required class="form-control" name="birth_nation">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provinca di Nascita*</label>
                                                <input disabled="" type="text" value="<?=$contract->birth_municipality;?>" required  class="form-control" name="birth_municipality">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo di Documento*</label>
                                                <select disabled="" class="form-control" id="document_type" name="document_type">
                                                    <option value="id_card">Carta Identita</option>
                                                    <option value="passport">Passporto</option>
                                                    <option value="patent">Patente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Numero di Documento*</label>
                                                <input disabled="" type="text" value="<?=$contract->document_number;?>" required class="form-control" name="document_number">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Rilascio Documento*</label>
                                                <input disabled="" type="text" value="<?=date('d-m-Y',strtotime($contract->document_date))?>" required id="document_date" class="form-control" name="document_date">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Scadenza Documento*</label>
                                                <input type="text" disabled="" value="<?=date('d-m-Y',strtotime($contract->document_expiry))?>" id="document_expiry" name="document_expiry" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Luogo di rilascio*</label>
                                                <input type="text" autocomplete="off" readonly="" value="<?=$contract->document_issue_place;?>"  id="document_issue_place" name="document_issue_place" class="form-control">
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
                                        <input disabled="" type="text" value="<?=$contract->tel_number;?>" name="tel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Fax/Altro Numero</label>
                                        <input disabled="" type="text" value="<?=$contract->alt_number;?>" name="alt_number" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare*</label>
                                        <input disabled="" type="text" value="<?=$contract->cel_number;?>" name="cel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 2</label>
                                        <input disabled="" type="text" value="<?=$contract->cel_number2;?>" name="cel_number2" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 3</label>
                                        <input disabled="" type="text" value="<?=$contract->cel_number3;?>" name="cel_number3" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email*</label>
                                        <input disabled="" type="email" value="<?=$contract->email;?>" name="email" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email alternativa</label>
                                        <input disabled="" type="email" value="<?=$contract->alt_email;?>" name="alt_email" class="form-control">
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
                                            <input disabled="" type="text" value="<?=$contract->toponimo;?>" class="form-control" id="toponimo" name="toponimo">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input disabled="" type="text" value="<?=$contract->address;?>" required class="form-control" name="address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input disabled="" type="text" value="<?=$contract->civico;?>" required class="form-control" name="civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Comune</label>
                                            <input disabled="" type="text" value="<?=$contract->price;?>" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Provincia*</label>
                                            <input disabled="" type="text" value="<?=$contract->location;?>" required class="form-control" name="location">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cap*</label>
                                            <input disabled="" type="text" value="<?=$contract->cap;?>" required class="form-control" name="cap">
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
                                            <input disabled="" type="radio" <?=($contract->ubicazione_fornitura=='resident')?'checked':'';?>  value="resident" name="ubicazione_fornitura">&nbsp; Residente  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input disabled="" type="radio" <?=($contract->ubicazione_fornitura=='non_resident')?'checked':'';?>  value="non_resident" name="ubicazione_fornitura">&nbsp;Non Residente                           
                                        </div>
                                    </div>
                                </div>
                                <?php if ($contract->ubicazione_fornitura=='non_resident'): ?>
                                     <div class="card-content">
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Toponimo*</label>
                                                <input type="text" value="<?=$contract->uf_toponimo;?>"  class="form-control" name="uf_toponimo">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Indirizzo*</label>
                                                <input type="text" value="<?=$contract->uf_address;?>"  class="form-control" name="uf_address">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Civico*</label>
                                                <input type="text" value="<?=$contract->uf_civico;?>"  class="form-control" name="uf_civico">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune</label>
                                                <input type="text" value="<?=$contract->uf_price;?>" class="form-control" name="uf_price">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provincia*</label>
                                                <input type="text" value="<?=$contract->uf_location;?>"  class="form-control" name="uf_location">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cap*</label>
                                                <input disabled="" type="text" value="<?=$contract->uf_cap;?>" required class="form-control" name="uf_cap">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
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
                                            <input disabled="" type="radio" <?=($contract->domicillazione_documenti_fatture=='residenza')?'checked':'';?>  value="residenza" name="domicillazione_documenti_fatture" >&nbsp; Residenza/Sede Legale  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input disabled="" type="radio" <?=($contract->domicillazione_documenti_fatture=='ubicazione_fornitura')?'checked':'';?> value="ubicazione_fornitura" name="domicillazione_documenti_fatture">&nbsp;Ubicazione fornitura   
                                                    &nbsp;&nbsp;&nbsp;
                                            <input disabled="" type="radio" <?=($contract->domicillazione_documenti_fatture=='altro')?'checked':'';?> value="altro" name="domicillazione_documenti_fatture" >&nbsp;Altro                       
                                        </div>
                                    </div>
                                </div>
                                <?php if ($contract->domicillazione_documenti_fatture=='altro'): ?>
                                     <div class="card-content">
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Toponimo*</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_toponimo;?>"  class="form-control" name="ddf_toponimo">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Indirizzo*</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_address;?>"  class="form-control" name="ddf_address">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Civico*</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_civico;?>"  class="form-control" name="ddf_civico">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_price;?>" class="form-control" name="ddf_price">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Provincia*</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_location;?>"  class="form-control" name="ddf_location">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cap*</label>
                                                <input disabled="" type="text" value="<?=$contract->ddf_cap;?>" required class="form-control" name="ddf_cap">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
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
                                            <select disabled="" class="form-control" id="contract_type" name="contract_type">
                                                <option value="dual">Dual</option>
                                                <option value="luce">Luce</option>
                                                <option value="gas">Gas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Listino*</label>
                                            <select disabled="" class="form-control" id="listino" name="listino">
                                                <option>FIX12 TS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($contract->contract_type=='dual'){ ?>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Gas Naturale
                                        </h4> 
                                    </div>
                                     <div class="card-content">
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select disabled="" class="form-control" id="gas_request_type" name="request_type">
                                                    <option>Mercato Libero</option>
                                                    <option>Maggior Tutela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_pdr;?>" class="form-control" name="pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="consume_annuo">
                                            </div> 
                                        </div>
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input  disabled=""  type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input  disabled=""  type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Energia Electrica
                                        </h4> 
                                    </div>
                                     <div class="card-content">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select disabled="" class="form-control" id="luce_request_type" name="request_type">
                                                    <option>Mercato Libero</option>
                                                    <option>Maggior Tutela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">POD</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_pod;?>" class="form-control" name="pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Opzione Oraria</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_opzione_oraria;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Potenza</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_potenza;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tenzione</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_tensione;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($contract->contract_type=='gas') { ?>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Gas Naturale
                                        </h4> 
                                    </div>
                                     <div class="card-content">
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select disabled="" class="form-control" id="gas_request_type" name="request_type">
                                                    <option>Mercato Libero</option>
                                                <option>Maggior Tutela</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">PDR</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_pdr;?>" class="form-control" name="pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_fornitore_uscente;?>" class="form-control" name="fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input disabled="" type="text" value="<?=$contract->gas_consume_annuo;?>" class="form-control" name="consume_annuo">
                                            </div> 
                                        </div>
                                          <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remi</label>
                                                <input  disabled=""  type="text" autocomplete="off" value="<?=$contract->gas_remi;?>" class="form-control" name="gas_remi">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Matricola</label>
                                                <input  disabled=""  type="text" autocomplete="off" value="<?=$contract->gas_matricola;?>" class="form-control" name="gas_matricola">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                Tipologia Uso*</br>
                                                <label class="control-label">                                             
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->gas_tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->gas_tipo_riscaldamento;?>" name="gas_tipo_riscaldamento">Riscaldamento
                                                </label>
                                                <label class="control-label">
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->gas_tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->gas_tipo_cottura_acqua;?>" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                                </label>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($contract->contract_type=='luce') { ?>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title">
                                            <div class="checkbox">
                                                Richiede la fornitura di Energia Electrica
                                        </h4> 
                                    </div>
                                     <div class="card-content">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipologia Richiesta</label>
                                                <select disabled="" class="form-control" id="luce_request_type" name="request_type">
                                                    <option>Mercato Libero</option>
                                                    <option>Maggior Tutela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">POD</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_pod;?>" class="form-control" name="pdr">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fornitore Uscente</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_fornitore_uscente;?>" class="form-control" name="fornitore_uscente">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Opzione Oraria</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_opzione_oraria;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Potenza</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_potenza;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tenzione</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_tensione;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Consumo Annuo</label>
                                                <input disabled="" type="text" value="<?=$contract->luce_consume_annuo;?>" class="form-control" name="consume_annuo">
                                            </div>
                                        </div>
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
                                                <input disabled="" type="checkbox" class="cb" <?=($contract->fature_via_email=='true')?'checked':'';?> value="<?=$contract->fature_via_email;?>"  name="fature_via_email">
                                            </label>
                                            Richiede l`invio della fatura via mail
                                        </div>
                                    </h4> 
                                </div>
                                <?php if ($contract->fature_via_email=='true'){ ?>
                                    <div class="card-content">
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email</label>
                                                <input disabled="" type="text" value="<?=$contract->email;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
                                            <input disabled="" type="radio" <?=($contract->payment_type=='postal')?'checked':'';?> value="postal" name="payment_type">&nbsp; Bolletino Postale
                                                    &nbsp;&nbsp;&nbsp;
                                            <input disabled="" type="radio" <?=($contract->payment_type=='cc')?'checked':'';?> value="cc" name="payment_type">&nbsp;Addebido su Conto Corrente                 
                                        </div>
                                    </div>
                                </div>
                            <?php if ($contract->payment_type=='cc') { ?>
                                 <div class="card-content">
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice IBAN</label>
                                            <input disabled="" type="text" value="<?=$contract->iban_code;?>" class="form-control" name="iban_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Intestario IBAN</label>
                                            <input disabled="" type="text" value="<?=$contract->iban_accounthoder;?>" class="form-control" name="iban_accounthoder">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice ficsale Intestario IBAN</label>
                                            <input disabled="" type="text" value="<?=$contract->iban_fiscal_code;?>" class="form-control" name="iban_fiscal_code">
                                        </div>
                                    </div>
                                </div>
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
                                            <textarea disabled=""  class="form-control" name="note"><?=$contract->note;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="../" class="btn btn-info pull-left">Back</a>
                                        <a onclick="openChangelog()" class="btn btn-info pull-left">Changelog</a>
                                        <a  href="../editContract/<?=$contract->contract_id;?>" class="btn btn-warning pull-right">Edit</a>
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

                $('.contractsNav').addClass('active');

                loadDocAndAudio();

                $('#contract_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:new Date(),
                 });
                $('#birth_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:new Date(),
                 });
                $('#document_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:new Date(),
                 });
                $('#document_expiry').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:new Date(),
                 });
                
                //$('.cb').val('false')
                $('.cb').on('click',function() {
                    $(this).val($(this).val()=='false'?'true':'false');
                });
                $('#client_type').val('<?=$contract->client_type;?>');
                $('#document_type').val('<?=$contract->document_type;?>');
                $('#toponimo').val('<?=$contract->toponimo;?>');
                $('#contract_type').val('<?=$contract->contract_type;?>');
                $('#listino').val('<?=$contract->listino;?>');
                $('#gas_request_type').val('<?=$contract->gas_request_type;?>');
                $('#luce_request_type').val('<?=$contract->luce_request_type;?>');
                $('#ddf_toponimo').val('<?=$contract->ddf_toponimo;?>')
                $('#uf_toponimo').val('<?=$contract->uf_toponimo;?>')
                <?php 
                    if (isset($_SESSION['create_contract'])) {
                        if ($_SESSION['create_contract']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "Contract Created!"
                            },{
                              type: 'success',
                              timer: 300,
                              placement: {
                                  from: 'top',
                                  align: 'right'
                              }
                            });

                        <?php } 

                        unset($_SESSION['create_contract']);
                    } 

                    if (isset($_SESSION['edit_contract'])) {
                        if ($_SESSION['edit_contract']=='success') { ?>//if edit success 
                            $.notify({
                              icon: "done",
                              message: "Contract Updated!"
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
                        
                        unset($_SESSION['edit_contract']);
                    } 
                ?>

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
                $('.doc-container').append('<tr><td><a href="<?=URL.$_SESSION['role']?>/getDocument/'+data[i].document_id+'">'+data[i].url+'</a></td></tr>');
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
                $('.audio-container').append('<tr><td><a target="_blank" href="<?=URL.$_SESSION['role']?>/getAudio/'+data[i].audio_id+'">'+data[i].url+'</a></td><td><a href="<?=URL.$_SESSION['role']?>/getAudio/'+data[i].audio_id+'" download="'+data[i].url+'" >↓</a></td></tr>');
            });
        }else {
            $('.audio-container').html('<tr><td>No Audio!</td></tr>');
        }
    })
    .fail(function() {
          console.log("error");
    })        
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

  <div class="modal fade" id="open_log" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style=" width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;" role="document">
      <div class="modal-content" style=" height: auto;
  min-height: 100%;
  border-radius: 0;">
        <div class="modal-header">
          <h5 class="modal-title" style="float: left;" >Changes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <table class="table table-striped table-bordered table-responsive">
              <?php
                $output=''; 
                foreach ($changelog as $log) {
                        $useri= $this->model->getUser($log['user_id']);
                        $useri=$useri->first_name." ".$useri->last_name;
                        $output.="<tr>";
                            $output.="<td>".$log['date']."</td><td>".$useri."</td>";
                            $output.="<td>";
                            $diff=explode("|",$log['diff']);
                            foreach ($diff as $d) {
                                $output.=$d."</br>";
                            }
                            $output.="</td>";
                        $output.="</tr>";
                    }
                echo $output;
            ?>
        </table>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    function openChangelog(){
        $('#open_log').modal();
    }
</script>