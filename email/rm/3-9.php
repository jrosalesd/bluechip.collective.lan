<div class="row">
    <div class="col-md-3">
        <h2>
			Mailing Payment Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When customer has declined ACH and no payments have been processed.
				<br>
				<b>Action: </b>Manual - Agent to edit and send
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$Loanid = $_GET['loanid'];
			$pmthist =  trim($_GET['pmthist']);
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
			<div id="copy_notify"></div>
			<div>
			<!-- Email Temaplate -->
			<p><strong>Subject:</strong>Payment Options</p>
			<br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
			<p>
				It may seem too early for payment information but I wanted to make sure you were ready when the time came. Since you opted out of ACH auto-debit, simply mail in your payments via check or money order to <?php address(1);?> Make sure you include the following information:
			</p>
			<ul class="sch">
		        <li>Full Name</li>
		        <li>Address</li>
		        <li>Loan ID Number (yours is <?php echo $Loanid;?>)</li>
		    </ul>
			<p>
				Remember it is best to drop your payment in the mail 7-10 business days before the due date so it has time to get to us! I have attached your payment schedule for your reference and if the mail ever becomes too much of a hassle just give us a call and we can easily set up automatic payments.
			</p>
			<p>Here is you Payment schedule:</p>
			<div class="offset25px">
    			    <ul class="schl">
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
            				<li><?php echo date_format($dates[$i],"D, M jS");?> - <?php echo "$".number_format($amount[$i],2,".",",");?></li>
            				<?php
            			}
            			?>
    			    
    			    </ul>
			</div>
			<?php
            NxtPmt($dates[0],  $amount[0], "on");
            ?>
			<p>Thanks again for choosing Spotloan!</p>
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
						<?php
                        statedrop();
                        ?>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="loanid">
								Borrower's Loan ID:
							</label>
							<input class="form-control" type="text" placeholder="Loan ID" name="loanid" required/>
						</div>
					</div>
					<div class="col-md-4"></div>
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