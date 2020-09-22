<div class="row">
	<div class="col-md-3">
		<h2>
			<?php echo $emname;?>
		</h2 
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower breaks a promise to pay.
				<br>
			</h5>
		</font>
	</div>
	<div class="col-md-9" style="border-left: solid;">
		<?php
		if($_GET['set'] == "on"){
			//variables to complete template
			//$status = false;
			$doa = date_create($_GET['doa']);
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
			<div id="copy_notify"></div>
			<div id="email-body">
                <!-- Email Temaplate -->
                <div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    <p> When we last connected, you agreed you would make a payment on <?php echo date_format($doa,"l, F jS");?>. Unfortunately, this payment was not made. We are willing to work with you, but need your cooperation in return.</p>
		    <p>Please call us at 888-681-6811 at your earliest convenience.</p>
		    
			<?php NxtPmt($nextpmtdate, $nextpmtamt, $pmtnote);?>
			
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
	                        <label for="doa">
	                            Date of Arrangement:
	                        </label>
	                        <input class="form-control" type="date" name="doa" required/>
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