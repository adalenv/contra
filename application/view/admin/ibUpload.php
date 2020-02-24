<title>Upload</title>
<div class="content" style="margin-top: 20px;">
    <div class="container-fluid">
        <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header" data-background-color="blue">
                          <h4 class="title">Upload to : <?php echo $ib->ib_name; ?></h4>
                      </div>
                      <div class="card-content">


  <script>
  function CSVImportGetHeaders()
{
    // Get our CSV file from upload
    var file = document.getElementById('file').files[0]

    // Instantiate a new FileReader
    var reader = new FileReader();

    // Read our file to an ArrayBuffer
    reader.readAsArrayBuffer(file);

    // Handler for onloadend event.  Triggered each time the reading operation is completed (success or failure)
    reader.onloadend = function (evt) {
        // Get the Array Buffer
        var data = evt.target.result;

        // Grab our byte length
        var byteLength = data.byteLength;

        // Convert to conventional array, so we can iterate though it
        var ui8a = new Uint8Array(data, 0);

        // Used to store each character that makes up CSV header
        var headerString = '';

        // Iterate through each character in our Array
        for (var i = 0; i < byteLength; i++) {
            // Get the character for the current iteration
            var char = String.fromCharCode(ui8a[i]);

            // Check if the char is a new line
            if (char.match(/[^\r\n]+/g) !== null) {

                // Not a new line so lets append it to our header string and keep processing
                headerString += char;
            } else {
                // We found a new line character, stop processing
                break;
            }
        }

        // Split our header string into an array
        //window.hh=headerString.split(',');
      //  return headerString.split(',');
      aa=headerString.split(',');
      //$('.first_named').html(``);
      // $(o).html("First Name");
      aa.forEach(function(k,i) {
          var o = new Option(k,i);
          o=o.outerHTML;
          $(".first_name").append(o);
          $(".last_name").append(o);
          $(".vat_number").append(o);
          $(".contract_type").append(o);
          $(".email").append(o);
          $(".rag_sociale").append(o);
          $(".document_number").append(o);
          $(".birth_date").append(o);
          $(".birth_nation").append(o);
          $(".date").append(o);
          $(".address").append(o);
          $(".civico").append(o);
          $(".cap").append(o);
          $(".location").append(o);
          $(".price").append(o);
          $(".tel_number").append(o);
          $(".cel_number").append(o);
          $(".fature_via_email").append(o);
          $(".note").append(o);
    //////luce
          $(".luce_fornitore_uscente").append(o);
          $(".luce_pod").append(o);
          $(".luce_potenza").append(o);
          $(".luce_consume_annuo").append(o);
    /////// gas
          $(".gas_fornitore_uscente").append(o);
          $(".gas_pdr").append(o);
          $(".gas_matricola").append(o);
          $(".gas_remi").append(o);
          $(".gas_consume_annuo").append(o);

          $(".payment_type").append(o);
          $(".iban_code").append(o);
        });
      //  console.log();
        //  debugger;

        // Convert entire ArrayBuffer to string --avoided so not all of ArrayBuffer would have to come into memory
        //var arrayToStream = String.fromCharCode.apply(null, new Uint8Array(data));
        // Splits on any new line characters and grabs first row, assuming it is headers
        //var firstLine = arrayToStream.match(/[^\r\n]+/g)[0];
        // Splits on a delimiter
        //var delimiterSplit = firstLine.split(',');
    };


}
</script>
<!-- <script src="jquery-3.2.1.min.js"></script> -->

    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                        <!-- <input type="hidden" name="list_id" value="<?php echo $list->list_id; ?>"/> -->

                    <br />
                </div>
                <table>
                  <tr>
                    <td>Campagna:</td>
                    <td>
                      <select class="campaign" name="campaign"><option>Empty</option>
                        <?php
                            $output='';
                            foreach ($campaigns as $campaign) {
                                $output.='<option value="'.$campaign->campaign_id.'" >'.$campaign->campaign_name.'</option>';
                            }
                            echo $output;
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>First Name*:</td>
                    <td><select class="first_name" name="first_name"><option value=""  >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td><select class="last_name" name="last_name"><option value=""  >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Codice Fiscale*:</td>
                    <td><select class="vat_number" name="vat_number"><option value=""  >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Tipo CNT:</td>
                    <td><select class="contract_type" name="contract_type"><option value=""  >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><select class="email" name="email"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Ragione Sociale:</td>
                    <td><select class="rag_sociale" name="rag_sociale"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Data di Nascita:</td>
                    <td><select class="document_number" name="document_number"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Data Di Nascita:</td>
                    <td><select class="birth_date" name="birth_date"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Luogo di Nascita:</td>
                    <td><select class="birth_nation" name="birth_nation"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Data Stipula:</td>
                    <td><select class="date" name="date"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Indirizzo:</td>
                    <td><select class="address" name="address"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Civico:</td>
                    <td><select class="civico" name="civico"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Cap:</td>
                    <td><select class="cap" name="cap"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Provincia:</td>
                    <td><select class="location" name="location"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Comune:</td>
                    <td><select class="price" name="price"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Telefono:</td>
                    <td><select class="tel_number" name="tel_number"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Cellulare:</td>
                    <td><select class="cel_number" name="cel_number"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Richiede l`invio della fatura via mail:</td>
                    <td><select class="fature_via_email" name="fature_via_email"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Note:</td>
                    <td><select class="payment_type" name="payment_type"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>IBAN:</td>
                    <td><select class="iban_code" name="iban_code"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Note:</td>
                    <td><select class="note" name="note"><option value="" >Empty</option></select></td>
                  </tr>


                  <!-- luce -->

                  <tr>
                    <td colspan="2"><center>Luce</center></td>
                  </tr>
                  <tr>
                    <td>Luce Fornitore Uscente:</td>
                    <td><select class="luce_fornitore_uscente" name="luce_fornitore_uscente"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>POD:</td>
                    <td><select class="luce_pod" name="luce_pod"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Potenza:</td>
                    <td><select class="luce_potenza" name="luce_potenza"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Luce Consumo:</td>
                    <td><select class="luce_consume_annuo" name="luce_consume_annuo"><option value="" >Empty</option></select></td>
                  </tr>

                  <!-- gas -->
                  <tr>
                    <td colspan="2"><center>Gas</center></td>
                  </tr>
                  <tr>
                    <td>Gas Fornitore Uscente:</td>
                    <td><select class="gas_fornitore_uscente" name="gas_fornitore_uscente"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>PDR:</td>
                    <td><select class="gas_pdr" name="gas_pdr"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Matricola:</td>
                    <td><select class="gas_matricola" name="gas_matricola"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Remi:</td>
                    <td><select class="gas_remi" name="gas_remi"><option value="" >Empty</option></select></td>
                  </tr>
                  <tr>
                    <td>Gas Consumo:</td>
                    <td><select class="gas_consume_annuo" name="gas_consume_annuo"><option value="" >Empty</option></select></td>
                  </tr>







                </table>


                <br>
                <button type="submit"  id="submit" name="import"
                    class="btn btn-info pull-right" value="">Import</button>
            </form>
            <script type="text/javascript">
            $(document).ready(function() {
              $("#file").change(function(){
                CSVImportGetHeaders();
             });

             $("#frmCSVImport").on('submit',function () {
               console.log('click');
              $("#response").attr("class", "");
                 $("#response").html("");
                 var fileType = ".csv";
                 var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
                 if (!regex.test($("#file").val().toLowerCase())) {
                      $("#response").addClass("error");
                      $("#response").addClass("display-block");
                      $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                     return false;
                 }
                 console.log('submit');
             });
            });

            </script>

        </div>
    </div>


</div></div></div></div></div>
<script type="text/javascript">
    $('.ibNav').addClass('active');

</script>

<style>

.outer-scontainer {
	/* background: #F0F0F0; */
	border: #e0dfdf 1px solid;
	padding: 20px;
	border-radius: 2px;
}

.input-row {
	margin-top: 0px;
	margin-bottom: 20px;
}


.outer-scontainer table {
	border-collapse: collapse;
	width: 100%;
}

.outer-scontainer th {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.outer-scontainer td {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
