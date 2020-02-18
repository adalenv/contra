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
          console.log(k);
          var o = new Option(k,i);
          $(".first_name").append(o);
      });
      aa.forEach(function(k,i) {
          console.log(k);
          var o = new Option(k,i);
          $(".last_name").append(o);
      });
      aa.forEach(function(k,i) {
          console.log(k);
          var o = new Option(k,i);
          $(".vat_number").append(o);
      });
      aa.forEach(function(k,i) {
          console.log(k);
          var o = new Option(k,i);
          $(".contract_type").append(o);
      });
      aa.forEach(function(k,i) {
          console.log(k);
          var o = new Option(k,i);
          $(".email").append(o);
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
