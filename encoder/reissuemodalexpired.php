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
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center"style='font-size:14px;'>Previous<br>Type 1 Amount</th>
                            <th class="text-center"style='font-size:14px;'>Previous<br>Type 2 Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody id="historytbody">
                    <?php
                        $history = $user->reissue_client_history($clientid);
                        if($history){
                            foreach($history as $index => $value){?>
                            <tr style="font-size: 15px" class="historytr">
                            <?php
                                echo '<td style="font-size:14px;">'. date('F j, Y g:i A',strtotime($value['date_accomplished'])) .'</td>';
                                echo '<td>'. $value['status'] .'</td>';
                                if(!empty($value['amount1'])){
                                echo '<td class="text-center"> Php '. $value['amount1'] .'</td>';
                                }else{
                                    echo '<td></td>';
                                }
                                if(!empty($value['amount2'])){
                                    echo '<td class="text-center"> Php '. $value['amount2'] .'</td>';
                                }else{
                                    echo '<td></td>';
                                }
                            }
                            ?></tr>
                            <?php 
                        } else {
                            echo '<tr style="font-size: 20px" class="historytr"><td></td>';
                            echo '<td></td>';
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


