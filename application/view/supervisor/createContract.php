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
                                                <input disabled="" type="date" id="contract_date" name="date" class="form-control">
                                            </div>
                                        
                                            <div class="checkbox">
                                                <label class="control-label">                                             
                                                    <input type="checkbox" class="cb" value="false" name="ugm_cb">Iniziative Promocionali UGM  
                                                </label>
                                                <label class="control-label">
                                                    <input type="checkbox" class="cb" value="false" name="analisi_cb">Analisi di Mercato       
                                                </label>                          
                                                <label class="control-label">            
                                                    <input type="checkbox" class="cb" value="false" name="iniziative_cb">Iniziative Promocionali Terze Parti 
                                                </label>  
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Operator</label>
                                                <select class="form-control"  required name="operator" id="operator">
                                                    <option value=''></option>
                                                    <?php
                                                        $output=''; 
                                                        foreach ($operators as $operator) {
                                                            $output.='<option value="'.$operator->user_id.'" >'.$operator->first_name.' '.$operator->last_name.'</option>';
                                                        }
                                                        echo $output;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Campaign</label>
                                                <select class="form-control" required name="campaign" id="campaign">
                                                    <option value=''></option>
                                                    <?php
                                                        $output=''; 
                                                        foreach ($campaigns as $campaign) {
                                                            $output.='<option value="'.$campaign->campaign_id.'" >'.$campaign->campaign_name.'</option>';
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
                                                <label class="control-label">Tipo Cliente</label>
                                                <select class="form-control" name="client_type">
                                                    <option value="personal">Persona Fisica</option>
                                                    <option value="intestario">Intestario</option>
                                                    <option value="delega">Delega</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" id="delegaif" style="display:none;border: 1px dotted #01bcd0;">
                                            <div id="delegaifc"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Sesso:</label>
                                            <div class="checkbox">                                         
                                                <input type="radio" class="gender_cb" value="male" name="gender" id="uomo_cb" checked="">&nbsp;Uomo 
                                                    &nbsp;&nbsp;&nbsp;
                                                <input type="radio" class="gender_cb" value="female" name="gender" id="donna_cb">&nbsp;Donna                           
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Ragione Sociale</label>
                                                <input type="text" name="rag_sociale" class="form-control">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nome*</label>
                                                <input type="text" required name="first_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cognome*</label>
                                                <input type="text" required name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Codice Fiscale*</label>
                                                <input type="text" required name="vat_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Partita Iva</label>
                                                <input type="text" class="form-control" name="partita_iva">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data di Nascita*</label>
                                                <input type="date" required  id="birth_date" class="form-control" name="birth_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nazione di Nascita*</label>
                                                <input type="text" required class="form-control" name="birth_nation">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comune di Nascita*</label>
                                                <input type="text" required class="form-control" name="birth_municipality">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo di Documento*</label>
                                                <select class="form-control" name="document_type">
                                                    <option value="id_card">Carta Identita</option>
                                                    <option value="passport">Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Numero di Documento*</label>
                                                <input type="text" required class="form-control" name="document_number">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Data Rilascio Documento*</label>
                                                <input type="date" required id="document_date" class="form-control" name="document_date">
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
                                        <input type="text" name="tel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Fax/Altro Numero</label>
                                        <input type="text" name="alt_number" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare*</label>
                                        <input type="text" name="cel_number" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 2</label>
                                        <input type="text" name="cel_number2" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare 3</label>
                                        <input type="text" name="cel_number3" class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email*</label>
                                        <input type="email" name="email" required class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email alternativa</label>
                                        <input type="email" name="alt_email" class="form-control">
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
                                            <select class="form-control" name="toponimo">
                                                <option value="via">Via</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" required class="form-control" name="address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" required class="form-control" name="civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Preso</label>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Locallita*</label>
                                            <input type="text" required class="form-control" name="location">
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
                                            <input type="radio"  value="resident" name="ubicazione_fornitura"  checked="">&nbsp; Residente  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="non_resident" name="ubicazione_fornitura" >&nbsp;Non Residente                           
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content" id="ubicazioneif" style="display:none;">

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
                                            <input type="radio" class="" value="residenza" name="domicillazione_documenti_fatture" checked="">&nbsp; Residenza/Sede Legale  
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="" value="ubicazione_fornitura" name="domicillazione_documenti_fatture" id="">&nbsp;Ubicazione fornitura   
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="" value="altro" name="domicillazione_documenti_fatture" >&nbsp;Altro                       
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content" id="domicillazioneif"  style="display:none;" >
                                 
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
                                            <select class="form-control" name="contract_type">
                                                <option value="dual">Dual</option>
                                                <option value="luce">Luce</option>
                                                <option value="gas">Gas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Listino*</label>
                                            <select class="form-control" name="listino">
                                                <option>FIX12 TS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" id="gasif">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        Richiede la fornitura di Gas Naturale
                                    </h4> 
                                </div>
                                 <div class="card-content" id="gasifc">
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" id="gas_request_type" name="gas_request_type">
                                                <option>SW1 - SWITCH</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="gas_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="gas_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="gas_consume_annuo">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Remi</label>
                                            <input type="text" class="form-control" name="gas_remi">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Matricola</label>
                                            <input type="text" class="form-control" name="gas_matricola">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            Tipologia Uso*</br>
                                            <label class="control-label">                                             
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_riscaldamento">Riscaldamento
                                            </label>
                                            <label class="control-label">
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                            </label>                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" id="luceif">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        Richiede la fornitura di energia electtrica
                                    </h4> 
                                </div>
                                 <div class="card-content" id="luceifc">
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" name="luce_request_type">
                                                <option>A01 - ATTTIVAZIONE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="luce_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="luce_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opzione Oraria*</label>
                                            <select class="form-control" name="luce_opzione_oraria">
                                                <option>Opzione 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Potenza</label>
                                            <input type="text" class="form-control" name="luce_potenza">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tensione</label>
                                            <input type="text" class="form-control" name="luce_tensione">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="luce_consume_annuo">
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
                                                <input type="checkbox" class="cb" value="false" name="fature_via_email">
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
                                            <input type="radio" class="" value="postal" name="payment_type" id="" checked="">&nbsp; Bolletino postare
                                                    &nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="" value="cc" name="payment_type" id="">&nbsp;Addebido su CC-payment                 
                                        </div>
                                    </div>
                                </div>
                                 <div class="card-content">
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice IBAN</label>
                                            <input type="text" class="form-control" name="iban_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Intestario IBAN</label>
                                            <input type="text" class="form-control" name="iban_accounthoder">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice ficsale Intestario IBAN</label>
                                            <input type="text" class="form-control" name="iban_fiscal_code">
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
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="create_contract" value="true">
                                        <a href="../" class="btn btn-warning pull-left">Cancel</a>
                                        <button type="submit" class="submit-btn btn btn-info pull-right">Registra</button>
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
$(window).ready(function(){
    $('#form').on('submit',function(e){
        if (!validate()) {
            e.preventDefault();
        };
    });
    $('[name="client_type"]').change(function(){
        if ($(this).val()=='delega') {
            $('#delegaif').show();
            $('#delegaifc').html(`<div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nome*</label>
                                            <input type="text" required name="delega_first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cognome*</label>
                                            <input type="text" required name="delega_last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Codice Fiscale*</label>
                                            <input type="text" required name="delega_vat_number" class="form-control">
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
                                            <select class="form-control" name="uf_toponimo">
                                                <option value="via">Via</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" required class="form-control" name="uf_address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" required class="form-control" name="uf_civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Preso</label>
                                            <input type="text" class="form-control" name="uf_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Locallita*</label>
                                            <input type="text" required class="form-control" name="uf_location">
                                        </div>
                                    </div>`); 
        }
    })
    $('[name="domicillazione_documenti_fatture"]').change(function(){
        console.log($(this).val());
        if ($(this).val()=='altro') {
            $('#domicillazioneif').show();
            $('#domicillazioneif').html(`  <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Toponimo*</label>
                                            <select class="form-control" name="ddf_toponimo">
                                                <option value="via">Via</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Indirizzo*</label>
                                            <input type="text" required class="form-control" name="ddf_address">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Civico*</label>
                                            <input type="text" required class="form-control" name="ddf_civico">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Preso</label>
                                            <input type="text" class="form-control" name="ddf_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Locallita*</label>
                                            <input type="text" required class="form-control" name="ddf_location">
                                        </div>
                                    </div>`);
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
                                            <select class="form-control" name="luce_request_type">
                                                <option>A01 - ATTTIVAZIONE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="luce_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="luce_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opzione Oraria*</label>
                                            <select class="form-control" name="luce_opzione_oraria">
                                                <option>Opzione 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Potenza</label>
                                            <input type="text" class="form-control" name="luce_potenza">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tensione</label>
                                            <input type="text" class="form-control" name="luce_tensione">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="luce_consume_annuo">
                                        </div>
                                    </div>`);
            $('#gasif').show();
            $('#gasifc').html(`                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" id="gas_request_type" name="gas_request_type">
                                                <option>SW1 - SWITCH</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="gas_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="gas_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="gas_consume_annuo">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Remi</label>
                                            <input type="text" class="form-control" name="gas_remi">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Matricola</label>
                                            <input type="text" class="form-control" name="gas_matricola">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            Tipologia Uso*</br>
                                            <label class="control-label">                                             
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_riscaldamento">Riscaldamento
                                            </label>
                                            <label class="control-label">
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                            </label>                           
                                        </div>
                                    </div>`);
        }else if ($(this).val()=='luce') {
            $('#luceif').show();
            $('#luceifc').html(`<div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" name="luce_request_type">
                                                <option>A01 - ATTTIVAZIONE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="luce_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="luce_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opzione Oraria*</label>
                                            <select class="form-control" name="luce_opzione_oraria">
                                                <option>Opzione 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Potenza</label>
                                            <input type="text" class="form-control" name="luce_potenza">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tensione</label>
                                            <input type="text" class="form-control" name="luce_tensione">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="luce_consume_annuo">
                                        </div>
                                    </div>`);
            $('#gasif').hide();
            $('#gasifc').html('');
        }else if ($(this).val()=='gas') {
            $('#luceif').hide();
            $('#luceifc').html('');
            $('#gasif').show();
            $('#gasifc').html(`div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tipologia Richiesta</label>
                                            <select class="form-control" id="gas_request_type" name="gas_request_type">
                                                <option>SW1 - SWITCH</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">PDR</label>
                                            <input type="text" class="form-control" name="gas_pdr">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fornitore Uscente</label>
                                            <input type="text" class="form-control" name="gas_fornitore_uscente">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Consume Annuo</label>
                                            <input type="text" class="form-control" name="gas_consume_annuo">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Remi</label>
                                            <input type="text" class="form-control" name="gas_remi">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Matricola</label>
                                            <input type="text" class="form-control" name="gas_matricola">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            Tipologia Uso*</br>
                                            <label class="control-label">                                             
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_riscaldamento">Riscaldamento
                                            </label>
                                            <label class="control-label">
                                                <input type="checkbox" class="cb" value="false" name="gas_tipo_cottura_acqua">Cottura cibi/Acqua calda sanitaria      
                                            </label>                           
                                        </div>
                                    </div>`);
        }
    })
});
                $('.createContractNav').addClass('active');

                $('#contract_date').val(new Date().toJSON().split('T')[0]);
                $('#birth_date').val(   new Date().toJSON().split('T')[0]);
                $('#document_date').val(new Date().toJSON().split('T')[0]);

                $('.cb').val('false')
                $('.cb').on('click',function() {
                    $(this).val($(this).val()=='false'?'true':'false');
                });

function getOperators(supervisor_id){
    $.ajax({
      url: '<?=URL;?>api/ApigetUsersBySupervisor/'+supervisor_id,
      type: 'GET',
      dataType: 'json',
    })
    .done(function(data) {
        dataa=data;
        $('#operator').html('');
        $('#operator').focus();
        for (var i=0;i<data.length;i++) {
           $('#operator').append('<option value='+data[i].user_id+'>'+data[i].full_name+'</option>');
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
              message: "Gas PDR must have 14 characters!"
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
    if (typeof($('[name="luce_pdr"]').val())!='undefined') {
        if ($('[name="luce_pdr"]').val().length!=14) {
            $.notify({
              icon: "done",
              message: "Luce PDR must have 14 characters!"
            },{
              type: 'danger',
              timer: 300,
              placement: {
                  from: 'top',
                  align: 'right'
              }
            });
            $('[name="luce_pdr"]').focus();
            valid=false;
        };
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

    return valid;
}
</script>