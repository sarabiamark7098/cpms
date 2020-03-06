<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}
?>
    
	<style>@media print{@page {size: landscape}}</style>
	<div class="container" style="font-size: 12px">
            <br>
            <div class="row">
                <!--LEFT-->
                <div class="col" style="border: solid 2px;margin-left:-10px;height: 680px">
                    <p class="text-center"><b>CASH ASSISTANCE VOUCHER</b></p>
                    <!--2nd row-->
                    <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px">
                        <div class="col-sm-7">
                            ENTITY NAME:<u style="width-left:5px;margin-left: 25px">DSWD FO XI</u></span><br>
                            <span>FIND CLUSTER:  <u style="margin-left: 25px">__01_____</u></span>     
                        </div>
                        <div class="col-sm-5">
                            NO : _________________________
                        </div>
                    </div>
                    <!--3rd row-->
                    <div class="row" style="font-size: 12px;border-top: solid 1px">
                        <div class="col-sm-2" >
                            <p>PAYYE/OFFICE: </p>
                            <p>ADDRESS: 	  </p>
                        </div>
						<div class="col-sm-6">
                        	<p><span><u style="margin-left: 30px"><?php echo ucwords(strtolower($coename))?></u></span></p>
							<p><span><u style="margin-left: 30px"><?php echo ucwords(strtolower($cash_add))?></u></span></p>
                        </div>
						<div class="col-sm-4 text-center" style="border-left: solid 1px;font-size: 10px">
                            <p><b>RESPONSIBILTY CENTER CODE: </b></p>
                            ________________________
                        </div>
                    </div>
                    <!--4th row-->
                    <p style="border-top: solid 1px;margin-left:-15px;margin-right: -15px"> &nbsp I. To be filled out upon request</p>
                    <!--5th row-->
                    <div class="row text-center" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px;margin-top: -10px">
                        <div class="col-sm-7">Particulars</div>
                        <div class="col-sm-5" style="border-left: solid 1px;">Amount</div>
                    </div>
                    <!--6th row-->
                    <div class="row text-center" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px;height: 50px;">
                        <div class="col-sm-7">
						<?php
							echo $client_assistance[1]['mode'] == "CAV"? $client_assistance[1]['type'] : "";
							echo "<br>";
							echo !empty($client_assistance[2]['mode']) == "CAV"? $client_assistance[2]['type'] : "";
						?>
						</h4>
						</div>                                         
                        <div class="col-sm-5" style="border-left: solid 1px;">
						<?php 
							echo $client_assistance[1]['mode']=="CAV"? "PHP ".$client_assistance[1]['amount']: "";
							echo "<br>"; 
							echo (!empty($client_assistance[2]['mode'])=="CAV" && !empty($client_assistance[2]['type']))? "PHP ".$client_assistance[2]['amount']: "";		
						?>
						</div>         
                    </div>
                     <!--7th row-->
					 <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px ;height: 200px;">
                            <!--[A]-->
                        <div class="col-sm-9">
                            <span style="border: solid 1px;width: 15px;margin-left: -15px"> A</span> Request by:
                            <div class="row text-center" style="margin-top: 10px;margin-left:25%;">
                                <div class="col-12"><b><?php echo strtoupper($soc_workerFullname) ?></b></div>                                   <!--NAME SA REQUESTOR-->
                                <div class="col-12" style="border-top: solid 1px"> SIGNATURE OVER PRINTED NAME <br> NAME OF REQUESTOR</div>
                            </div>  
                            <div class="row">
                                &nbsp&nbsp&nbsp&nbsp<span>Approved By:</span>
                                <div class="row text-center" style="margin-top:10px;margin-left:25%;">
                                    <div class="col-12"><b><?php echo $signatoryName; ?></b> </div>                                   <!--NAME SA REQUESTOR-->
                                    <div class="col-12" style="border-top: solid 1px; font-size: 10px"> SIGNATURE OVER PRINTED NAME<br>IMMEDIATE SUPERVISOR/AUTHORIZED REPRESENTATIVE</div>
                                </div>
                            </div>
                        <!--[A] END-->
                        </div>
                    </div>
                    <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px ;height: 150px;">
                            <!--[B]-->
                        <div class="col-sm-9">
                            <span style="border: solid 1px;width: 10px;margin-left: -15px"> B</span> PAID BY:
                            <div class="row text-center" style="margin-top: 25px;margin-left:25%;">
                                <div class="col-12"><b>PROCESA V. TIPON</b></div>                                   <!--NAME SA REQUESTOR-->
                                <div class="col-12" style="border-top: solid 1px"> SPECIAL DISTURBING OFFICER</div>
                            </div>
                            <div class="row">
                                &nbsp&nbsp&nbsp&nbsp<span>Cash Recieved by:</span>
                                <div class="row text-center" style="margin-top:10px;margin-left:25%;">
                                    <div class="col-12"><b><?php echo $coename; ?></b></div>                                   <!--NAME SA REQUESTOR-->
                                    <div class="col-12" style="border-top: solid 1px"> SIGNATURE OVER PRINTED NAME<br>PAYEE</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row" style="margin-top:15px; margin-left: 13px;">
                                    DATE: <div class="col-sm-12 text-center" style="border-bottom: solid 1px;margin-left: 50%; margin-top: -20px "><?php echo date("F j, Y");?></div>
                                </div>
                            </div> 
                        <!--[B] END-->
                        </div>
                    </div>
                </div>

                <!--CENTER-->
                <div class="col-1"></div>

                <!--RIGHT-->
                <div class="col" style="border: solid 2px;margin-right:-10px">
				<p class="text-center"><b>CASH ASSISTANCE VOUCHER</b></p>
                    <!--2nd row-->
                    <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px">
                        <div class="col-sm-7">
                            ENTITY NAME:<u style="width-left:5px;margin-left: 25px">DSWD FO XI</u></span><br>
                            <span>FIND CLUSTER:  <u style="margin-left: 25px">__01_____</u></span>     
                        </div>
                        <div class="col-sm-5">
                            NO : _________________________
                        </div>
                    </div>
                    <!--3rd row-->
					<div class="row" style="font-size: 12px;border-top: solid 1px">
                        <div class="col-sm-2" >
                            <p> PAYYE/OFFICE: </p>
                            <p>ADDRESS: 	  </p>
                        </div>
						<div class="col-sm-6" >
                        	<p><span><u style="margin-left: 30px"><?php echo ucwords(strtolower($coename))?></u></span></p>
							<p><span><u style="margin-left: 30px"><?php echo ucwords(strtolower($cash_add))?></u></span></p>
                        </div>
						<div class="col-sm-4 text-center" style="border-left: solid 1px;font-size: 10px">
                            <p><b>RESPONSIBILTY CENTER CODE: </b></p>
                            ________________________
                        </div>
                    </div>
                    <!--4th row-->
                    <p style="border-top: solid 1px;margin-left:-15px;margin-right: -15px"> &nbsp I. To be filled out upon request</p>
                    <!--5th row-->
                    <div class="row text-center" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px;margin-top: -10px">
                        <div class="col-sm-7">Particulars</div>
                        <div class="col-sm-5" style="border-left: solid 1px;">Amount</div>
                    </div>
                    <!--6th row-->
                    <div class="row text-center" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px;height: 50px;">
                        <div class="col-sm-7">
						<?php
							echo $client_assistance[1]['mode'] == "CAV"? $client_assistance[1]['type'] : "";
							echo "<br>";
							echo !empty($client_assistance[2]['mode']) == "CAV"? $client_assistance[2]['type'] : "";
						?>
						</h4>
						</div>                                         
                        <div class="col-sm-5" style="border-left: solid 1px;">
						<?php 
							echo $client_assistance[1]['mode']=="CAV"? "PHP ".$client_assistance[1]['amount']: "";
							echo "<br>"; 
							echo (!empty($client_assistance[2]['mode'])=="CAV" && !empty($client_assistance[2]['type']))? "PHP ".$client_assistance[2]['amount']: "";		
						?>
						</div>         
                    </div>
                     <!--7th row-->
					 <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px ;height: 200px;">
                            <!--[A]-->
                        <div class="col-sm-9">
                            <span style="border: solid 1px;width: 15px;margin-left: -15px"> A</span> Request by:
                            <div class="row text-center" style="margin-top: 10px;margin-left:25%;">
                                <div class="col-12"><b><?php echo strtoupper($soc_workerFullname) ?></b></div>                                   <!--NAME SA REQUESTOR-->
                                <div class="col-12" style="border-top: solid 1px"> SIGNATURE OVER PRINTED NAME <br> NAME OF REQUESTOR</div>
                            </div>  
                            <div class="row">
                                &nbsp&nbsp&nbsp&nbsp<span>Approved By:</span>
                                <div class="row text-center" style="margin-top:10px;margin-left:25%;">
                                    <div class="col-12"><b><?php echo $signatoryName; ?></b> </div>                                   <!--NAME SA REQUESTOR-->
                                    <div class="col-12" style="border-top: solid 1px; font-size: 10px"> SIGNATURE OVER PRINTED NAME<br>IMMEDIATE SUPERVISOR/AUTHORIZED REPRESENTATIVE</div>
                                </div>
                            </div>
                        <!--[A] END-->
                        </div>
                    </div>
                    <div class="row" style="border-top: solid 1px;margin-left:-15px;margin-right: -15px ;height: 150px;">
                            <!--[B]-->
                        <div class="col-sm-9">
                            <span style="border: solid 1px;width: 10px;margin-left: -15px"> B</span> PAID BY:
                            <div class="row text-center" style="margin-top: 25px;margin-left:25%;">
                                <div class="col-12"><b>PROCESA V. TIPON</b></div>                                   <!--NAME SA REQUESTOR-->
                                <div class="col-12" style="border-top: solid 1px"> SPECIAL DISTURBING OFFICER</div>
                            </div>
                            <div class="row">
                                &nbsp&nbsp&nbsp&nbsp<span>Cash Recieved by:</span>
                                <div class="row text-center" style="margin-top:10px;margin-left:25%;">
                                    <div class="col-12"><b><?php echo $coename; ?></b></div>                                   <!--NAME SA REQUESTOR-->
                                    <div class="col-12" style="border-top: solid 1px"> SIGNATURE OVER PRINTED NAME<br>PAYEE</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row" style="margin-top:15px; margin-left: 13px;">
                                    DATE: <div class="col-sm-12 text-center" style="border-bottom: solid 1px;margin-left: 50%; margin-top: -20px "><?php echo date("F j, Y");?></div>
                                </div>
                            </div> 
                        <!--[B] END-->
                        </div>
						<!--ROW-->
				</div>

            <!--CONTAINER-->
        </div>
