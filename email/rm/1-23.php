<div class="row">
    <div class="col-md-3">
        <h2>
			<?php echo $emname;?>
		</h2>
		<font color="red">
			<h5>
				<b>Template Usage: </b>Use this template when a borrower needs a payment reminder.
				<br>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
        
		if($_GET['set'] == "on"){
			//variables to complete template
			$pmthist =  trim($_GET['pmthist']);
			$bal = htmlspecialchars(trim($_GET['bal']));
			
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
		    
			<p>Your current balance is $<?php echo number_format($bal,2,".",","); ?>. Your remaining payment schedule as of today can be found below:</p>
			<?php
			$schhandler = new  Sch($pmthist);
			if ($_GET['schType'] == 0) {
				$schhandler->SchPost();
			}elseif ($_GET['schType'] == 1) {
				$schhandler->CompleteSchedule();
			}
			?>
			<p><?php echo pendingpayment(4, $_GET['pendingclick'], $_GET['pennextpmtamt'], $_GET['datepending']);?></p>
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
						<div class='form-group'>
							<label for='bal'>
								Outstanding Balance:
							</label>
							<input class='form-control' type='number' step='0.01' id='bal' name='bal' required/>
						</div>
					</div>
					<div class="col-md-8">
						<?php
						$schhandler = new  Sch();
						$schhandler->forms();
						?>
					</div>
				</div>
				<?php pendingpayment(0);?>
				<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
					Generate Email
				</button>
			</form>
			
			<?php
		}
		?>
    </div>
</div>