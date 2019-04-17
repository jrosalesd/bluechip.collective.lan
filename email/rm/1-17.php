<div class="row">
    <div class="col-md-3">
        <h2>
			Settlement Completion Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>Copy and Paste 
				<br>
				<b>Action: </b>Once a borrower has completed a settlement.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			
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
			<div id="email-body">
                <!-- Email Temaplate -->
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
			<p><strong>Subject:</strong> Great! Your account is settled.</p>
			<br />
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			
			<p>
				Hope you're having a wonderful day. Here's a confirmation email that your account has been settled. Thank you for working with me.
			</p>
			<?php
			if ($state_status == "No"){
				?>
				<p>
					<?php echo $state_note;?>
				</p>
				<?php
			}else{
			?>
			<p>
				And for being a repeat borrower, you're eligible to apply for a new loan with us.
			</p>
			<p>
				Please visit our website.
			</p>
			<p>
				www.Spotloan.com
			</p>
			<?php
			}
			?>
			<br />
			
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
					<div class="col-md-4"></div>
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