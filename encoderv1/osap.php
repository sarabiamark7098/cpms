
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> -->
</head>

<body>
    <div class="container-fluid" style="font-family: Arial;line-height: 1.5em; margin-left: 118px; padding-right: 110px; margin-top: 80px;">
        <br><br><br><br><br><br><br>
        <h1 class="text-center text-bold" style="font-size: 3em;">CERTIFICATION</h1>

        <br><br><br>
        <h4><?php echo date("F j, Y") ?></h4>

        <br><br>
        <h4><b>TO THE HEAD OF OFFICE</b></h4>
        <h4>Office of Special Assistance of the President</h4>
        <h4>Magallanes Street, Davao City</h4>
        <br><br> <br>
        <h4>Dear <b>Sir/Madam,</b></h4><br> 
        <?php if (strtolower($client['relation']) != "self") { ?>
            <h4 class="text-justify" style="line-height: 1.5em;">This is to certify that <b><?php echo strtoupper($name) ?></b> from <?php echo ucwords(strtolower($city[0])) ?>, received an assistance to this office through 
            <b>Guarantee Letter/Cash</b> for the <?php echo ucwords(strtolower($client_assistance[1]['type'])) ?> of <b><?php echo strtoupper($bname) ?></b>, amounting to <?php echo ucwords(strtolower($wordamount)) ?>
                (Php<?php echo $client_assistance[1]['amount'] ?>) processed on <?php echo date("F j, Y", strtotime($client['date_accomplished'])) ?>.</h4>
        <?php } else { ?>
            <h4 class="text-justify" style="line-height: 1.5em;">This is to certify that <b><?php echo strtoupper($name) ?></b> from <?php echo ucwords(strtolower($city[0])) ?>, received an assistance to this office through 
            <b>Guarantee Letter/Cash</b> for <?php echo ((strtolower($client['sex']) == 'male')?"his":"her") ?>  <?php echo ucwords(strtolower($client_assistance[1]['type'])) ?>, amounting to <?php echo ucwords(strtolower($wordamount)) ?>
                (Php<?php echo $client_assistance[1]['amount'] ?>) processed on <?php echo date("F j, Y", strtotime($client['date_accomplished'])) ?>.</h4>
        <?php } ?>
        <br>
        <h4>This certification is being issued upon the request of Mr/Ms. <?php echo ucwords(strtolower($osap['requested_by'])) ?>, for assistance to OSAP.</h4>
        <br>
        <h4>Thank you and more power</h4>
        <br><br><br>
        <h4>Very truly yours,</h4>


        <br><br><br><br>
        <h4><b><?php echo strtoupper($osap_data[0]) ?></b></h4>
        <h4><?php echo $osap_data[1] ?></h4>

        <br>
        <h4>
        <?php
            echo strtoupper($signature_osap_ini) ."/". ucwords(strtolower($encode[0]));
        ?>
        </h4>
    </div>


</body>

</html>