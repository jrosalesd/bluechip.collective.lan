<div class="row">
    <div class="col-md-3">
        <h2>
			Authorization for ACH Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Reauthorization of ACH by customer after that customer decides that payments can once again be taken from their bank account. 
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
			
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
			
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
			<p><strong>Subject:</strong> Your payments are about to get easier!</p>
			<br>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>		    
		    
			
			<p>Hurray! I’m so glad you’ve decided to re-authorize automatic debits from your account. It’s definitely the easiest way to ensure your payments get made on time.</p>
			
			<?php
            NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);
            ?>
			<p>Please let me know if you have any questions.</p>
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
				<?php
				nxtpmtcheck();
				?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			<?php
		}
		?>
    </div>
</div>