<?php
include('../php/class.user.php');
$user = new User();
?>
<?php

	$transid = $_GET['id'];
	$clientid = $user->getClient_id($transid); //id sa client
  $getClient = $user->get_data_of_the_decline_client($transid);
	foreach($getClient as $index => $value){
		$_SESSION['clientid'] = $value['client_id'];
		$_SESSION['lname'] = $value['lastname'];
		$_SESSION['fname'] = $value['firstname'];
		$_SESSION['mname'] =$value['middlename'];
		$_SESSION['exname'] = $value['extraname'];
		$_SESSION['note'] = $value['note'];
		$_SESSION['tracker'] = $value['trans_id'];
	}
	
	if(isset($_POST['decline'])){
        $result = $user->decline_client_to_socialWork($_GET['id'],$_SESSION['userId']);
        if($result){
            echo "<script>alert('Client Successfully declined!');</script>";
            echo "<script>window.location='../socialwork/home.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }
        else{
            echo "<script>alert('Sorry Error Occurred on Action!');</script>";
            echo "<script>window.location='../socialwork/home.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";	
        }
	}
	
	

?>

<?php
	if((!$_SESSION['login']) && (!$_SESSION['userAccountusername'])	&& (!$_SESSION['userAccountpassword'])){
		header('Location:../index.php');
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		#historytbody {
			display:block;
			height:350px;
			overflow-y: scroll;
			overflow-x: auto;
		}
		#historythead, #historytbody .historytr {
			display:table;
			width:100%;
			table-layout:fixed;
		}
		#historythead {
			width: calc( 100% - 1em )
		}
		</style>

	</head>
	<body>
	<div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#decline" role="tab"><i class="fa fa-user mr-1"></i> Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ViewHistory" role="tab"><i class="fa fa-history mr-1"></i> View History</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="decline" role="tabpanel">

                        <!--Body-->
                        <?php
							if($_SESSION['note'] == "yes"){
							echo '<div class="body">
							  <form class="form-group" action="declineClient.php?id='.$value['trans_id'].'" method="POST">
								<div class="modal-body">
									<div class="row form-group" >
										<div class="form-group col-7 align-self-start">
										  <input value="'.$value['lastname'] .', '. $value['firstname'] .' '. $value['middlename'] .' '. $value['extraname'].'" id="fname" name="fname" type="text" class="form-control" readonly>
										  <label class="active" for="client_fullname">Name</label>
										</div>
										
										<div class="form-group col-5 align-self-end">
										  <input value="'. $transid.'" id="client_id" name="client_id" type="text" class="form-control" readonly>
										  <label class="active" for="client_id">Client ID</label>
										</div>
									</div>
										  
								</div>
									<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
											<button type="submit" class="btn btn-primary" name="decline">Decline</button>
										</div>
								</form> 		
								
							</div>';
							}
							else{
								echo '<div class="body">
							  <form class="form-group" action="declineClient.php?id='.$transid.'" method="POST">
								<div class="modal-body">
									<div class="row form-group">
										<div class="form-group col-7 align-self-start">
										  <input value="'.$_SESSION['lname'] .', '. $_SESSION['fname'] .' '. $_SESSION['mname'] .' '. $_SESSION['exname'].'" id="fname" name="fname" type="text" class="form-control" readonly></input>
										  <label class="active" for="client_fullname">Name</label>
										</div>
										
										<div class="form-group col-5 align-self-end">
										  <input value="'. $transid.'" id="client_id" name="client_id" type="text" class="form-control" readonly></input>
										  <label class="active" for="client_id">Client ID</label>
										</div>

										<div class="form-group col-12 align-self-end">
										  <input value="'. $value['note'].'" id="client_id" name="allowed" type="text" class="form-control" readonly></input>
										  <label class="active" for="client_id">Note</label>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
									<button type="submit" class="btn btn-primary" name="decline">Decline</button>
								</div>
								</form> 		
								
							</div>';
							}
							?>

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
											<th>Date Completed</th>
											<th>Mode of Assistance</th>
											<th>Type of Assistance</th>
											<th>Client Name</th>
											<th>Beneficiary Name</th>
											
										</tr>
									</thead>
									<tbody id="historytbody">
									<?php
									
										$history = $user->show_client_history_data($clientid);	
										
										if($history != false){
											foreach($history as $index => $value){
												
												$client_assistance = $user->getGISAssistanceUsingClientId($clientid);
                    
												$mode2='';
												$type2='';
												if(!empty($client_assistance[2]['mode'])){
														$mode2 = ' And '. $client_assistance[2]['mode'];
														if($client_assistance[1]['type'] !== $client_assistance[2]['type']){
															$type2 = ' And '. $client_assistance[2]['type'];
														}
												}
											?>
											<tr style="font-size: 15px" class="historytr">
											<?php
												echo '<td>'. $value['date_accomplished'].'</td>';
												echo '<td>'. $client_assistance[1]['mode'] .''. $mode2 .'</td>';
												echo '<td>'. $client_assistance[1]['type'] .''. $type2 .'</td>';
												echo '<td>'. $value['lastname'].', '.$value['firstname'].' '.$value['middlename'].'</td>';
												echo '<td>'; 
												if($value['relation']=='Self'){
													echo $value['lastname'].', '.$value['firstname'].' '.$value['middlename'];
												}else{
													echo $value['b_lname'].', '.$value['b_fname'].' '.$value['b_mname'];

												}

												echo '</td>';
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

	<!--para sa showing sa history-->

		
</body>
</html>