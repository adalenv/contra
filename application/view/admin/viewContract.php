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
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Stipula</label>
                                                <input disabled="" type="date" value="<?=$contract->date;?>" id="contract_date" name="date" class="form-control">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Operator</label>
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
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label class="control-label">                                             
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->ugm_cb=='true')?'checked':'';?> value="<?=$contract->ugm_cb;?>" name="ugm_cb">Iniziative Promocionali UGM  
                                                </label>
                                                <label class="control-label">
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->analisi_cb=='true')?'checked':'';?> value="<?=$contract->analisi_cb;?>" name="analisi_cb">Analisi di Mercato       
                                                </label>                          
                                                <label class="control-label">            
                                                    <input disabled="" type="checkbox" class="cb" <?=($contract->iniziative_cb=='true')?'checked':'';?> value="<?=$contract->iniziative_cb;?>" name="iniziative_cb">Iniziative Promocionali Terze Parti 
                                                </label>  
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
                                                <label class="control-label">Tipo Cliente</label>
                                                <select disabled="" class="form-control" id="client_type" name="client_type">
                                                    <option value="personal">Persona Fisica</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
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
                                                <input disabled="" type="date" value="<?=$contract->birth_date;?>" required  id="birth_date" class="form-control" name="birth_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nazione di Nascita*</label>
                                                <input disabled="" type="text" value="<?=$contract->birth_nation;?>" required class="form-control" name="birth_nation">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune di Nascita*</label>
                                                <input disabled="" type="text" value="<?=$contract->birth_municipality;?>" required  class="form-control" name="birth_municipality">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo di Documento*</label>
                                                <select disabled="" class="form-control" id="document_type" name="document_type">
                                                    <option value="id_card">Carta Identita</option>
                                                    <option value="passport">Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Numero di Documento*</label>
                                                <input disabled="" type="text" value="<?=$contract->document_number;?>" required class="form-control" name="document_number">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Rilascio Documento*</label>
                                                <input disabled="" type="date" value="<?=$contract->document_date;?>" required id="document_date" class="form-control" name="document_date">
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
                                            <select disabled="" class="form-control" id="toponimo" name="toponimo">
                                                <option value="via">Via</option>
                                                <option>Other</option>
                                            </select>
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
                                            <input disabled="" type="number" value="<?=$contract->civico;?>" required class="form-control" name="civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Preso</label>
                                            <input disabled="" type="text" value="<?=$contract->price;?>" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Locallita*</label>
                                            <input disabled="" type="text" value="<?=$contract->location;?>" required class="form-control" name="location">
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
                                 <div class="card-content">
                                    <div class="col-sm-8">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia contratto*</label>
                                            <select disabled="" class="form-control" id="contract_type" name="contract_type">
                                                <option value="dual">Dual</option>
                                                <option value="electricity">Luce</option>
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

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        <div class="checkbox">
                                            <label class="control-label">                                             
                                                <input disabled="" type="checkbox" class="cb" <?=($contract->richiede_gas_naturale=='true')?'checked':'';?> value="<?=$contract->richiede_gas_naturale;?>" name="richiede_gas_naturale">
                                            </label>
                                            Richiede la fornitura di Gas Naturale
                                        </div>
                                    </h4> 
                                </div>
                                 <div class="card-content">
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select disabled="" class="form-control" id="request_type" name="request_type">
                                                <option>SW1 - SWITCH</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input disabled="" type="text" value="<?=$contract->pdr;?>" class="form-control" name="pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input disabled="" type="text" value="<?=$contract->fornitore_uscente;?>" class="form-control" name="fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input disabled="" type="text" value="<?=$contract->consume_annuo;?>" class="form-control" name="consume_annuo">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            Tipologia Uso*</br>
                                            <label class="control-label">                                             
                                                <input disabled="" type="checkbox" class="cb" <?=($contract->tipo_riscaldamento=='true')?'checked':'';?> value="<?=$contract->tipo_riscaldamento;?>" name="tipo_riscaldamento">Riscaldamento
                                            </label>
                                            <label class="control-label">
                                                <input disabled="" type="checkbox" class="cb" <?=($contract->tipo_cottura_acqua=='true')?'checked':'';?> value="<?=$contract->tipo_cottura_acqua;?>" name="tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
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
                                            <label class="control-label">                                             
                                                <input disabled="" type="checkbox" class="cb" <?=($contract->fature_via_email=='true')?'checked':'';?> value="<?=$contract->fature_via_email;?>"  name="fature_via_email">
                                            </label>
                                            Richiede l`invio della fatura via mail
                                        </div>
                                    </h4> 
                                </div>
                                 <div class="card-content">
                                    <div class="col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizio e-mail </label>
                                            <input disabled="" type="email" class="form-control">
                                        </div>
                                    </div>
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
                                            <input disabled="" type="radio" <?=($contract->payment_type=='postal')?'checked':'';?> value="postal" name="payment_type">&nbsp; Bolletino postare
                                                    &nbsp;&nbsp;&nbsp;
                                            <input disabled="" type="radio" <?=($contract->payment_type=='cc')?'checked':'';?> value="cc" name="payment_type">&nbsp;Addebido su CC-payment                 
                                        </div>
                                    </div>
                                </div>
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
                                        <a href="../" class="btn btn-info pull-left">Back</a>
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

                // $('#contract_date').val(new Date().toJSON().split('T')[0]);
                // $('#birth_date').val(   new Date().toJSON().split('T')[0]);
                // $('#document_date').val(new Date().toJSON().split('T')[0]);

                //$('.cb').val('false')
                $('.cb').on('click',function() {
                    $(this).val($(this).val()=='false'?'true':'false');
                });
                $('#client_type').val('<?=$contract->client_type;?>');
                $('#document_type').val('<?=$contract->document_type;?>');
                $('#toponimo').val('<?=$contract->toponimo;?>');
                $('#contract_type').val('<?=$contract->contract_type;?>');
                $('#listino').val('<?=$contract->listino;?>');
                $('#request_type').val('<?=$contract->request_type;?>');

            </script>