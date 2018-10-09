<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower states they will be mailing payments.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			$loanid = htmlspecialchars($_GET['loanid']);
			$pmthist =  trim($_GET['pmthist']);
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt'])
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

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction'],1);?>
		    
		    <p>This email is confirmation of your opt-out of auto-debit payments. You can mail in your payments via check or money order to our address below:</p>
		    <div class="offset50px">
		    	<?php echo address();?>
		    </div>
		    <p>Include the following information:</p>
		    <div class="offset50px">
		    	<p>
		    		Full Name
					<br/>Address
					<br/>Loan ID Number <?php echo $loanid;?>
		    	</p>
		    </div>
		    <p>Remember, payments need to be mailed 7-10 business days before the due date for adequate time to arrive. I have attached your payment schedule for your reference. Please remember, you can always turn auto-debit back on.</p>
		    <p>Your remaining payment schedule is as follows:</p>
		    <div class="offset50px">
		    	<ul class="schl">
		    		<?php
	    			
        			$hist = str_ireplace("\n",",",$pmthist);
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
		    <p>Please let me know if you need further assistance.</p>
			
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
						<div class="form-group">
							<label for="loanid">
								Borrower's Loan ID:
							</label>
							<input class="form-control" type="text" placeholder="2356246" id="loanid" name="loanid" required/>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label for="brwName">
								Date Amount
							</label>
							<textarea class="form-control text-left " name="pmthist" rows="10" required></textarea>
						</div>
					</div>
				</div>
				<?php supCorr();?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="2">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
	</div>
</div>