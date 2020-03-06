<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	$_SESSION['myid'] = $clientid;
	
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
	}
    $ToCondition = $user->reissue_client_history($clientid);
?>
<!DOCTYPE html>
<html>
	<head>
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>

	</head>
	<body>
	

    <div class="modal-c-tabs">

<!-- Nav tabs -->
<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#decline" role="tab"><i class="fa fa-info mr-1"></i> Client</a>
    </li>
    <?php if(!empty($ToCondition)){ ?>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#ViewHistory" role="tab"><i class="fa fa-history mr-1"></i> View Re-issue History</a>
    </li>
    <?php } ?>
</ul>

<!-- Tab panels -->
<div class="tab-content">
    <!--Panel 7-->
    <div class="tab-pane fade in show active" id="decline" role="tabpanel">

        <!--Body-->
        <div class="body">
            <div class="modal-body">
            <h5>Do you want to Proceed Re-issue Guarantee Letter?</h5>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="proceed" class="btn btn-primary btn-sm" onclick="reissuanceexpired(<?php echo $clientid ?>)">Proceed</button>
            </div> 
        </div>
    </div>
    <!--/.Panel 7-->

    <!--Panel 8-->
    <div class="tab-pane fade" id="ViewHistory" role="tabpanel">
              <!--Body-->
        <div class="body">
            <br>
            <div class="container">
                <div class="table-responsive-lg">
                <table class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                    <thead id="historythead">
                        <tr style="font-size: 15px" class="historytr">
                            <th class="text-center"style='font-size:14px;'>Reissue ID</th>
                            <th class="text-center"style='font-size:14px;'>Date Reissue</th>
                            <th class="text-center"style='font-size:14px;'>Date Entered</th>
                            
                        </tr>
                    </thead>
                    <tbody id="historytbody">
                    <?php
                        $history = $user->reissue_client_history($clientid);
                        if($history){
                            foreach($history as $index => $value){?>
                            <tr style="font-size: 15px" class="historytr">
                            <?php
                                echo '<td style="font-size:14px;">'. $value['reissue_id'] .'</td>';
                                echo '<td style="font-size:14px;">'. date('F j, Y g:i A',strtotime($value['date_reissue'])) .'</td>';
                                echo '<td style="font-size:14px;">'. date('F j, Y g:i A',strtotime($value['date_entered'])) .'</td>';
                                
                            }
                            ?></tr>
                            <?php 
                        } else {
                            echo '<tr style="font-size: 20px" class="historytr"><td></td>';
                            echo '<td class="text-danger text-center"> <h4>NO DATA</h4> </td>';
                            echo '<td></td>';
                            echo '<td></td></tr>';
                        }
                    ?>
                    </tbody>
                </table>
                    <div class="modal-footer">
                    <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Panel 8-->
    
</div>

</div>
</body>
<script>
    function reissuanceexpired(id){
        window.location.href = "reissuanceexpired.php?id="+ id +"&stat=0";
    }
</script>
</html>


