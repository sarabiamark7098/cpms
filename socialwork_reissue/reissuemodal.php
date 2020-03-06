<?php
include('../php/class.user.php');
$user = new User();

	$transid = $_GET['id'];
	$_SESSION['myid'] = $transid;
	
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }
    $ToConditiongis = $user->gis_client_history($transid);
    $ToConditionlast = $user->last_client_history($transid);

?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
    <script type="text/javascript">
        function reissuance(id){
            // console.log(id);
            window.location.href = "socialwork/gis.php?id="+ id +"&stat=0";
        }
    </script>
    <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#decline" role="tab"><i class="fa fa-info mr-1"></i> Client</a>
            </li>
            <?php if(!empty($ToConditiongis) || !empty($ToConditionlast)){ ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ViewHistory" role="tab"><i class="fa fa-history mr-1"></i> View Update History</a>
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
                        <div class="row">
                            <div class="col-5">
                                <input class="form-control" type="text" name="transid" id="transid" value="<?php echo $transid?>">
                                <label for="transid">Transaction ID</label>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-6">
                                <h5>Do you want to Proceed on Update Client?</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button id="proceed" class="btn btn-primary btn-sm" onclick="reissuance('<?php echo $transid ?>')">Proceed</button>
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
                                <th>Entity</th>
                                <th class="text-center"style='font-size:14px;'>Previous Data</th>
                                <th class="text-center"style='font-size:14px;'>Current Data</th>
                                <th>Updated by</th>
                            </tr>
                        </thead>
                        <tbody id="historytbody">
                        <?php
                            $history = $user->gis_client_history($transid);
                            if($history){
                                foreach($history as $index => $value){?>
                                <tr style="font-size: 15px" class="historytr">
								<?php
                                    echo '<td style="font-size:14px;">'.$value['gis_changedon'].'</td>';
                                    echo '<td>'.$value['gis_entity'].'</td>';
                                    echo '<td class="text-center">'.(!empty($value['gis_previous'])?$value['gis_previous']:"None").'</td>';
                                    echo '<td class="text-center">'.(!empty($value['gis_current'])?$value['gis_current']:"Removed").'</td>';
                                    echo '<td>'.(!empty($value['gis_changed_by'])?$user->getupdateby($value['gis_changed_by']):'').'</td>';
                                }
                                ?></tr>
                                <?php 
                            } else {
                                echo '<tr style="font-size: 20px" class="historytr"><td></td>';
                                echo '<td></td>';
                                echo '<td</td>';
                                echo '<td></td>';
                                echo '</tr>';
                            }
                            $history = $user->last_client_history($transid);
                            if($history){
                                foreach($history as $index => $value){?>
                                <tr style="font-size: 15px" class="historytr">
                                <?php
                                    echo '<td style="font-size:14px;">'.$value['last_changedon'].'</td>';
                                    echo '<td>'.$value['last_entity'].'</td>';
                                    echo '<td class="text-center">'.(!empty($value['last_previous'])?$value['last_previous']:"None").'</td>';
                                    echo '<td class="text-center">'.(!empty($value['last_current'])?$value['last_current']:"Removed").'</td>';
                                    echo '<td>'.(!empty($value['last_changed_by'])?$user->getupdateby($value['last_changed_by']):'').'</td>';
                                }
                                ?></tr>
                                <?php 
                            } else {
                                echo '<tr style="font-size: 20px" class="historytr"><td></td>';
                                echo '<td></td>';
                                echo '<td</td>';
                                echo '<td></td>';
                                echo '</tr>';
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
</html>