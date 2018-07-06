<div class="row">
    <div class="col-md-3">
        <h2>
			Why is my loan so expensive
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Use when customer asks why he or she is paying so much for his/her Spotloan.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$pmthist =  trim($_GET['pmthist']);
			$loan = htmlspecialchars($_GET['loan']);
			$int_charge = htmlspecialchars($_GET['int_charge']);
			$payback = $loan+$int_charge;
			$lst_pmt_date = date_create(htmlspecialchars($_GET['lst_pmt_date']));
			$missedpmt = date_create(htmlspecialchars($_GET['missedpmt']));
			$bal = htmlspecialchars($_GET['bal']);
			$nxtpmt = htmlspecialchars($_GET['nxtpmt']);
			$nxtpmt_date = date_create(htmlspecialchars($_GET['nxtpmt_date']));
			
			?>
			<div>
				<a class="btn btn-danger col-md-3" href="emails.php?cs&id=<?php echo $_GET['id'];?>">
						Reset
					<span class="glyphicon glyphicon-refresh"></span>
				</a>
			</div>
			<br>
			<br>
			<hr>
			<div>
			<!-- Email Temaplate -->
			<p><strong>Subject:</strong>How your Spotloan works.</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			
			<p>Thank you for emailing us today, we are always glad to assist you. In your original loan terms, it does explain that you were borrowing the $<?php echo number_format($loan,2,".",","); ?> from us and paying $<?php echo number_format($int_charge,2,".",","); ?> in interest back to us bringing your total payback to $<?php echo number_format($payback,2,".",","); ?> assuming that you were not to miss or defer any payments. Underneath that information it explained that if you miss or defer a payment that you will pay more interest on your loan over time. In the loan documents it does have your last payment date as <?php echo date_format($lst_pmt_date,"F jS, Y"); ?> assuming that there would be no missed or deferred payments.</p>
			<?php
			if (!empty($missedpmt)) {
				?>
				<p>
					Since you have missed 1 payment on your loan, you agreed to the added interest that was explained in your loan documents. You have not made up your missed payment for <?php echo date_format($missedpmt,"l, F jS"); ?>. When you don’t make up the payments that you miss, you accrue interest on those payments until they are made up or made at the end of the loan.
				</p>
				<?php
			}
			?>
			
			
			<p>Your account balance is $<?php echo number_format($bal,2,".",","); ?> and your next payment of $<?php echo number_format($nxtpmt,2,".",","); ?> is due on <?php echo date_format($nxtpmt_date,"l, F jS"); ?>. As a reminder your interest does reflect on the account balance daily, this is for your benefit so that if you were to pay off early you would save on the interest. I have gone ahead and attached your remaining payment schedule.</p>
			
			<table class="bordered sch">
				<thead>
					<th class="col-sm-2">
						Date
					</th>
					<th class="col-sm-3">
						Amount
					</th>
				</thead>
				<tbody>
					<?php
					$hist = str_ireplace("\n",",",$pmthist);
					$hist = str_ireplace("\t",",",$hist);
					$hist = explode(",",$hist);
					$dates = array();
					$amount = array();
					foreach ($hist as $k => $v) {
	                    if ($k % 2 == 0) {
	                        $dates[] = date_create($v);
	                    }
	                    else {
	                        $amount[] = str_ireplace("$","",$v);
	                    }
	                }
					for ($i = 0; $i < count($dates); $i++) {
						?>
						<tr>
							<td class="col-sm-2"><?php echo date_format($dates[$i],"D, M jS");?></td>
							<td class="col-sm-3"><?php echo "$".number_format($amount[$i],2,".",",");?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
					
			</table>
			
			<p>Please remember that if you do miss anymore payment on your account that you will be adding additional interest to your loan and extending the length of your loan. If you have any more questions please don't hesitate to give us a call at 888-681-6811.</p>
			<br>
			
			<?php
			include('includes/signature.inc.php');
			?>	
			</div>
			<?php
		}else{
			?>
			<h2 class="text-center">
				Fill Out All Fields
			</h2>
			<br>
			<br>
			<form class="fom form-vertical" method="get">
				<input type="hidden" name="cs"/>
				<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="brwName">
								Borrower´s First Name:
							</label>
							<input class="form-control" type="text" placeholder="i. e. David" name="brwName" required/>
						</div>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<h3>Original Loan Terms</h3>
					<div class="col-md-4">
						<div class="form-group">
							<label for="loan">
								Original Loan
							</label>
							<select class="form-control" name="loan" required>
								<option value="">Choose Loan amount</option>
								<?php
								for ($i = 300; $i <= 800; $i+=100) {
									?>
									<option value="<?php echo $i;?>" >$<?php echo number_format($i,2,".",","); ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-group">
                            <label for="missedpmt">
                                Missed Payment Date:
                                <?php if($role=="Credit Service Manager"){echo "Not necessary";}?>
                            </label>
                            <input class="form-control" type="date" name="missedpmt" <?php if($role!="Credit Service Manager"){echo "required";}?>/>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="int_charge">
                                Interest Charge:
                            </label>
                            <input class="form-control" type="number" min="0" step="0.01" name="int_charge" required/>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="lst_pmt_date">
                                Last Payment Date:
                            </label>
                            <input class="form-control" type="date" name="lst_pmt_date" required/>
                        </div>
                    </div>
				</div>
				<div class="row">
					<h3>Current Loan Terms</h3>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="bal">
                                Outstanding Balance:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="bal" required/>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="nxtpmt">
                                Next Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="nxtpmt" required/>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="nxtpmt_date">
                                Next Payment Date:
                            </label>
                            <input class="form-control" type="date" name="nxtpmt_date" required/>
                        </div>
					</div>
				</div>
				<div>
					<h3>
						Insert Current Payment Schedule
					</h3>
					<div class="form-group">
							<label for="brwName">
								Date - Amount
							</label>
							<textarea class="form-control text-left " name="pmthist" rows="10" required></textarea>
						</div>
				</div>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>