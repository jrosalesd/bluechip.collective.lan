			<div class="row">
				<div class="col-md-3">
					<h2>
						New Settlement Arrangement Email
					</h2>
					<font color="red">
						<h5>
							<b>Generate: </b>Agent selects to send this from the servicing screen
							<br>
							<b>Template: </b>Spotloan email with logo
							<br>
							<b>Action: </b>Manual - RM/FR to edit and send
						</h5>
					</font>
				</div>
				<div class="col-md-9" style="border-left: solid;">
					<?php
					if($_GET['set'] == "on"){
						//variables to complete template
							$brwName = trim($_GET['brwName']);
							$loanID = $_GET['loanID'];
							$start = strtotime($_GET['start']);
							$stl = $_GET['stl'];
							$currentYear = date('Y');
							$holidays = [ 
							    mktime(0, 0, 0, 1, 1,$currentYear), 
							    strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $currentYear)), 
							    strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $currentYear)), 
							    strtotime("last Monday of May $currentYear"), 
							    mktime(0, 0, 0, 7, 4, $currentYear), 
							    strtotime("first Monday of September $currentYear"), 
							    strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $currentYear)), 
							    mktime(0, 0, 0, 11, 11, $currentYear), 
							    strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $currentYear)), 
							    mktime(0, 0, 0, 12, 25, $currentYear)
							];
							?>
							<?php
							$url = $_SERVER[REQUEST_URI];
							$url = explode("&",$url);
							$del_val ="set=on";
							if (($key = array_search($del_val, $url)) !== false) {
							    unset($url[$key]);
							}
							$url = join("&",$url);
							?>
							<div id="em-nav">
								<a class="btn btn-danger col-md-3" href="emails.php?cs&id=<?php echo $_GET['id'];?>">
										Reset
									<span class="glyphicon glyphicon-refresh"></span>
								</a>
								<a class="btn btn-warning col-md-3" href="<?php echo $url;?>#form">
									<span class="glyphicon glyphicon-edit"></span>
										Edit
								</a>
							</div>
							<br>
							<br>
							<?php
							if (isset($_GET['inst'])) {
								$pmtnum= $_GET['pmtnum'];
								$daynum = $_GET['daynum'];
								$end= $start + ($one_day_sec*($daynum * $pmtnum));
								$fpmtamt = $_GET['fpmtamt'];
								$stlpmt = $stl/$pmtnum;
								$stlpmt2 = ($stl-$fpmtamt)/($pmtnum-1);
								$loandate = [];
								$pmtlist = [];
								
								if (!empty($fpmtamt)) {
									array_push ($loandate, $start);
									array_push ($pmtlist, (float)$fpmtamt);
									$workbal = $stl-$fpmtamt;
									$start+=($daynum*$one_day_sec);
									if($daynum > 14){
										if ($daynum > 15) {
											
											if (date("t",$start-($daynum*$one_day_sec))==31) {
												$start+=$one_day_sec;
											}elseif (date("n",$start-($daynum*$one_day_sec))==2) {
												if(date("t",$start-($daynum*$one_day_sec))==29){
													$start-=(1*$one_day_sec);
									            }else{
									            	$start-=(2*$one_day_sec);
									            }
											}
											
										}else {
											
											if (date("d",$start) < 16) {
												if (date("t",$start-($daynum*$one_day_sec))==31) {
													$start+=$one_day_sec;
												}elseif (date("n",$start-($daynum*$one_day_sec))==2) {
													if(date("t",$start-($daynum*$one_day_sec))==29){
														$start-=(1*$one_day_sec);
										            }else{
										            	$start-=(2*$one_day_sec);
										            }	
												}
											}if (date("d",$start) == 31) {
												$start+=$one_day_sec;
											}
											
										}
									}
									//echo date("Y/m/d",$start);
									$stlpmt = $workbal/($pmtnum-1);
								}
								
								for ($date=$start; $date<$end; $date=strtotime("+$daynum days",$date)) {
									$pmt= $stlpmt;
									//echo date("m-d-Y",strtotime("-1 month",$date))."<br>";
									if($daynum > 14){
										if ($daynum > 15) {
											if ($date > $start) {
												if (date("t",$date-($daynum*$one_day_sec))==31) {
													$date+=$one_day_sec;
												}elseif (date("n",$date-($daynum*$one_day_sec))==2) {
													if(date("t",$date-($daynum*$one_day_sec))==29){
														$date-=(1*$one_day_sec);
										            }else{
										            	$date-=(2*$one_day_sec);
										            }
												}
											}
										}else {
											if ($date > $start) {
												if (date("d",$date) < 16) {
													if (date("t",$date-($daynum*$one_day_sec))==31) {
														$date+=$one_day_sec;
													}elseif (date("n",$date-($daynum*$one_day_sec))==2) {
														if(date("t",$date-($daynum*$one_day_sec))==29){
															$date-=(1*$one_day_sec);
											            }else{
											            	$date-=(2*$one_day_sec);
											            }	
													}
												}if (date("d",$date) == 31) {
													$date+=$one_day_sec;
												}
											}
										}
									}
									array_push ($loandate, $date); 
									array_push ($pmtlist,$pmt);
									
								}
							}
							
							//var_dump($loandate);
							?>
							<hr>
							<div id="copy_notify"></div>
				            <div class="well well-lg">
				            	<?php
				            	//variables
				            	$assignee = $SysName;
				            	$approver = htmlspecialchars($_GET['approver']);
				            	$outstading = $_GET['outstanding'];
				            	$principal = $_GET['principalBal'];
				            	$interest = $_GET['interetBal'];
				            	/*
				            	Follow up
				            	*NEW SETTLEMENT:
								*Approved by: Julio R.
								*Working for:
								A: Current Outstanding Balance:
								B: Principal of Outstanding:
								C: Interest of Outstanding: 
								D: Settlement Amount:
								E: Payment Schedule:
				            	*/
				            	?>
				                <div class="well well-sm">
				                    <?php
				                    $onlineDueDate = strtotime(htmlspecialchars($_GET['start']));
				                    $date = $onlineDueDate + 7*$one_day_sec;
				                    
				                    echo "<b>FOLLOW UP <br> Please set the follow up for ".date('m/d/Y',$date)."</b>";
				                    ?>
				                </div>
				                <?php
				                
				                //Assign values to the $follow_up variable
				                $follow_up = "
				                	*NEW SETTLEMENT:
									*Approved by: ".ucwords($approver).". |
									*Working for: $assignee. |
									*Settlement Type: ".(isset($_GET['lump']) ? "Lump Sum Payment" : "Installments")."
									A: Current Outstanding Balance: $". number_format($outstading,2,".",",")." |
									B: Principal of Outstanding: $". number_format($principal,2,".",",")." |
									C: Interest and fees of Outstanding:  $". number_format($interest,2,".",",")." |
									D: Settlement Amount: $". number_format($stl,2,".",",")." |
									E: Payment Schedule: ";
				                $followUpSchedule = "";
				                if (isset($_GET['lump'])) {
				                	$followUpSchedule = date("m/d/Y", $start).":$".number_format($stl,2,".",",");
				                }else{
				                	$length = sizeof($loandate);
					                for ($i = 0; $i < $length; $i++) {
					                	
										$date = $loandate[$i];
										 if (date("w",$date)==6) {
								            $date+= (2*$one_day_sec);
								        }elseif (date("w",$date)==0) {
								            $date+=$one_day_sec;
								        }elseif (in_array($date,$holidays,true)) {
								           $date+=$one_day_sec;
											        }
					                	 if ($i+1 < $length) {
					                	 	$followUpSchedule .= "(".ordinalNumber($i+1)." Pmt) ". date("m/d/Y", $date).":$".number_format($pmtlist[$i],2,".",",")." | ";
					                	 }else {
					                	 	$followUpSchedule .="(".ordinalNumber($i+1).") ".  date("m/d/Y", $date).":$".number_format($pmtlist[$i],2,".",",");
					                	 }
					                }
				                }
					                
				                $follow_up .= "[ ".$followUpSchedule." ]";
				                ?>
				                <div class="followup">
				                    <div id="follow-up">
				                          <i>
				                        <?php echo $follow_up;?>
				                        </i>
				                    </div>
				                    <div class="float-right">
				                        <div class="row">
				                            <div class="col-lg-4"></div>
				                            <div class="col-lg-4"></div>
				                            <div class="col-lg-4"><button id="copy-init" class="btn btn-success" onclick="copyFollowUp('follow-up',this.value)" value="FollowUp">Copy Follow-Up</button></div>
				                        </div>
				                        
				                    </div>
				                </div>
				                
				                    
				            </div>
							<hr>
							<div class="copier">
								<div id="copy_notify"></div>
								<div class="row">
				                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
				                    <div class="col-lg-4"></div>
				                    <div class="col-lg-4"></div>
				                </div>
				            	<hr>
							</div>
							<div id="email-body">
								<!-- Email Temaplate -->
								<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
								
								<p>
									I would like to recap our conversation and confirm that we have reached an agreement to settle your Spotloan account for the amount of $<?php echo number_format($stl,2,".",",");?>.
								</p>
								
								<?php
								if (isset($_GET['inst'])){
									?>
									
									<p>
										<?php
										if (!empty($fpmtamt)) {
											?>
											You have agreed to make your first payment of $<?php echo number_format($fpmtamt,2,".",",");?> and <?php echo $pmtnum-1;?> <?php if($daynum==14){echo "Bi-Weekly";}elseif ($daynum==30) {
											echo "Monthly";}elseif($daynum==15){echo "Semi-Monthly";}?> payments of $<?php echo number_format($stlpmt2,2,".",",");?> for a total of <?php echo $pmtnum;?> payments. Here’s your payment schedule:
											<?php
										}else {
											?>
											You have agreed to make <?php echo $pmtnum;?> <?php if($daynum==14){echo "Bi-Weekly";}elseif ($daynum==30) {
											echo "Monthly";}elseif($daynum==15){echo "Semi-Montly";}?> payments of $<?php echo number_format($stlpmt,2,".",",");?>. Here’s your payment schedule:
											<?php
										}
										?>
									</p>
									<div>
										<ul class="sch">
											<?php
											for ($i = 0; $i < count($loandate); $i++) {
													$date = $loandate[$i];
												 if (date("w",$date)==6) {
										            $date+= (2*$one_day_sec);
										        }elseif (date("w",$date)==0) {
										            $date+=$one_day_sec;
										        }elseif (in_array($date,$holidays,true)) {
										           $date+=$one_day_sec;
										        }
										        ?>
										        <li>
									        		<?php
										        	echo date("m/d/Y", $date)." $".number_format($pmtlist[$i],2,".",",");
										        	?>
										        </lip>
										        <?php
											}
											?>
										</ul>
									</div>
									<?php
									
								}elseif (isset($_GET['lump'])) {
									?>
									<p>
										You have agreed to make a one time payment in the amount of $<?php echo number_format($stl,2,".",",");?> on <?php echo date("l, F jS", $start);?>.
									</p>
									<?php
								}
								?>
								<p>
									You have authorized us to withdraw <?php if (isset($_GET['lump'])){echo "this payment on the date";}else{echo "these payments on the dates";}?>  shown above from the bank account you provided to Spotloan. You have indicated that you understand your authorization will remain in full force and effect unless you contact us at least <u>2 business days</u> before your scheduled payment to let us know that you would like to revoke this authorization.
								</p>
								<p>
									To send a money order, please mail it to our mail processor at:
								</p>
								<p style="margin-left: 25px;">
									<?php
				                    include 'includes/dbh.inc.php';
				                    $dbquery = "SELECT * FROM sp_contact where status=1 and address_type='Mailing Address'";
				                    $dbinit = mysqli_query($conn, $dbquery);
				                    $dbrow = mysqli_num_rows($dbinit);
				                    if($dbrow > 0)
				                    {
				                        while ($dbrow=mysqli_fetch_array($dbinit)) 
				                        {
				                           ?>
				                           <div>
				                           		<p>
				                           			Spotloan
					                                <br><?php echo $dbrow['address1'];
					                                if(!empty($dbrow['address2']))
					                                {
					                                     ?><br><?php echo $dbrow['address2'];
					                                }
					                                ?>
						                            <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
					                           		<br>Attention to: <?php echo $loanID;?>
				                           		</p>
				                           </div>
				                           <?php
				                        }
				                    }
				                    ?>
								</p>
								<p>
									When you make payments, it is critical that the auto-debit payments be successfully completed and not returned; and that mailed payments arrive by the due date, not just be postmarked. If you do not make your payments in full and on time, this settlement agreement will be voided and you will be responsible for repaying the full outstanding balance at the time of default. This would include any interest that would have accrued on that balance if this settlement agreement did not exist (minus any payments you made).
								</p>
								<p>
									Thank you for resolving this debt and fulfilling your commitment. Please let me know if you have any questions or if there’s anything else I can do to help.
								</p>
							
							<?php
						
							include('includes/signature.inc.php');
							?>
							</div>
						</div>
						<?php
					}else{
						?>
						<h2 class="text-center">
							Fill Out All Fields
						</h2>
						<br>
						<br>
						
						<hr>
						<div class="btn-group btn-group-justified">
							<a href="?cs&id=<?php echo $_GET['id'];?>&lump" class="btn btn-success">Lump Sum Payment</a>
							<a href="?cs&id=<?php echo $_GET['id'];?>&inst" class="btn btn-success">Installments</a>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<?php
								
									?>
									<div class="form-group">
										<?php
										if (isset($_GET['inst'])) {
											?>
											<label for="frst">
												<input type="checkbox" id="frst" onclick="enterform()">is the first payment different?
											</label>
											<?php
										}else if (isset($_GET['lump'])) {
											?>
											<input type="hidden" id="frst">
											<?php
										}
										?>
										
									</div>
										
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="bal">
												Oustading Balance
											</label>
											<input class="form-control" step="0.01" type="number" id="bal" onkeyup="settlement()">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="principal">
												Principal
											</label>
											<input class="form-control" step="0.01" type="number" id="principal" onkeyup="settlement()">
										</div>
										<div id="interest"></div>
									</div>
								</div>
								
								
									
								<div class="form-group">
									<label for="disc">
										Discount %
									</label>
									<input class="form-control" type="text" id="disc" onkeyup="settlement()">
								</div>
								<div class="form-group">
									<?php
									if (isset($_GET['inst'])) {
										?>
										<label for="pmtnums">
											Number of Payments
										</label>
										<input class="form-control" type="text" id="pmtnums" onkeyup="settlement()">
										<?php
									}else if (isset($_GET['lump'])){
										?>
										<input type="hidden" id="pmtnums" value="1">
										<?php
									}
									?>
								</div>
								
								<div id="frst_enter"></div>
							</div>
							<div class="col-md-6">
								<p id="stl0"></p>
							</div>
						</div>
						<hr>
						<form  class="fom form-vertical" method="get">
							<input type="hidden" name="cs"/>
							<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
							<div class="row" style = "display: none;">
								<input type="text" class="col-md-4" id="outstanding" name="outstanding" value="<?php echo $_GET['outstanding'];?>">
								<input type="text" class="col-md-4" id="principalBal" name="principalBal" value="<?php echo $_GET['principalBal'];?>">
								<input type="text" class="col-md-4" id="interetBal" name="interetBal" value="<?php echo $_GET['interetBal'];?>">
							</div>
							<div íd="form" class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="approver">Who approved the Settlement?</label>
										<select class="form-control" name="approver" id="approver" required>
											<option value="">Choose One</option>
											<?php
												$sql = "SELECT * FROM users WHERE user_role=1 AND user_status=1";
												$ql_run =  mysqli_query($conn, $sql);
												$sql_numrows = mysqli_num_rows($ql_run);
												if ($sql_numrows > 0) {
													while($list = mysqli_fetch_array($ql_run)){
														?>
														<option value="<?php echo $list['user_shortname'];?>" <?php if($_GET['approver'] == $list['user_shortname']){echo "selected";}?>>
															<?php
															echo(
																ucwords(
																	$list['user_first']." ".$list['user_last']
																)
															);
																
															?>
														</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group"></div>
								</div>
								<div class="col-md-4">
									<div class="form-group"></div>
								</div>
							</div>
							<?php
							if (isset($_GET['lump'])) {
								?>
								<input type="hidden" name="lump"/>
								<input type="hidden" name="pmtnum" id="pmtnum" />
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="brwName">
												Borrower´s First Name:
											</label>
											<input class="form-control" type="text" name="brwName" value="<?php echo $_GET['brwName']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="loanID">
												Loan Id:
											</label>
											<input class="form-control" type="text" name="loanID" value="<?php echo $_GET['loanID']; ?>" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="start">
												Lump Sum Payment Date:
											</label>
											<input class="form-control" type="date" name="start" value="<?php echo $_GET['start']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="stl">
												Settlement amount:
											</label>
											<input class="form-control" type="number" step="0.01" name="stl" id="stl" value="<?php echo $_GET['stl']; ?>" required/>
										</div>
									</div>
								</div>
								<?php
							}elseif (isset($_GET['inst'])) {
								?>
								<input type="hidden" name="inst"/>
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="brwName">
												Borrower´s First Name:
											</label>
											<input class="form-control" type="text" name="brwName" value="<?php echo $_GET['brwName']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="loanID">
												Loan Id:
											</label>
											<input class="form-control" type="text" name="loanID" value="<?php echo $_GET['loanID']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="daynum">
												Payment Frequency:
											</label>
											<select class="form-control" name="daynum" required>
												<option value="14" <?php if($_GET['daynum']==14){echo "selected";}?>>Bi-Weekly</option>
												<option value="15" <?php if($_GET['daynum']==15){echo "selected";}?>>Semi-Monthly</option>
												<option value="30" <?php if($_GET['daynum']==30){echo "selected";}?>>Monthly</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="start">
												First Payment Date:
											</label>
											<input class="form-control" type="date" name="start" value="<?php echo $_GET['start']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="pmtnum">
												Number of payments:
											</label>
											<input class="form-control" type="text" name="pmtnum" id="pmtnum" value="<?php echo $_GET['pmtnum']; ?>" required/>
										</div>
										<div class="form-group">
											<label for="stl">
												Settlement amount:
											</label>
											<input class="form-control" type="number" step="0.01" name="stl" id="stl" value="<?php echo $_GET['stl']; ?>" required/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="fpmtamt">
												First Payment Amount(If Applicable):
											</label>
											<input class="form-control" type="number" step="0.01" name="fpmtamt" id="fpmtamt" value="<?php echo $_GET['fpmtamt']; ?>"/>
										</div>
									</div>
								</div>
								<?php
							}
							?>
							<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
								Generate Email
							</button>
						</form>
						<script>
							
						</script>
						<?php
					}
					?>
				</div>
			</div>