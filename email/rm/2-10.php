<div class="row">
    <div class="col-md-3">
        <h2>
			Final Payment Pending<small> Processing last payment</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When Borrower asks about the status of the last payment.
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
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
			<p><strong>Subject:</strong> Pending last payment - Payment will clear on <?php echo date_format($pmtdate,"l, F jS"); ?></p><br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    <p>Your final payment is still being processed by our system, and should clear on <?php echo date_format($pmtdate,"l, F jS"); ?>. If you wish to reapply you may do so, all you need to do is go to our website and submit a new application, just like the first time.</p>

		    <p>Keep in mind that if your final payment is returned and you are approved for a new loan, you will be responsible for both balances.</p>
		
		    <p>If you have any questions or concerns, don't hesitate to give us a call or send us an email and any one of our Relationship Managers will be more than pleased to assist you.</p>
		    
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
                                Last Payment Clear Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
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