<div class="row">
    <div class="col-md-3">
        <h2>
			4 Business Days Reminder Emai
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>4 business days before a payment is auto-scheduled.
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
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			$pmtdate = date_create($_GET['pmtdate']);
			
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
			<p>
				<strong>Subject:</strong>Spotloan payment of $<?php echo number_format($pmtAmt,2,".",","); ?> due on <?php echo date_format($pmtdate,"l, F jS"); ?>
			</p>
			<br>
			

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    
			
			<p>
				I just want to remind you that your Spotloan payment of $<?php echo number_format($pmtAmt,2,".",","); ?> is scheduled for <?php echo date_format($pmtdate,"l, F jS"); ?>. Please let me know right away if you have any questions.
			</p>
			
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
					<div class="col-md-4">
						<div class="form-group">
                            <label for="pmtdate">
                                Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
                        </div>
                        <div class="form-group">
                            <label for="pmtAmt">
                                Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
        				</div>
					</div>
					<div class="col-md-4"></div>
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