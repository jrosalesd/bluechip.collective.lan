<div class="row">
    <div class="col-md-3">
        <h2>
			Attempt to Call Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b> When a customer contacts an agent and the agent responds, trying to reach that customer for a specific reason.
				<br>
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
			$phone = htmlspecialchars(trim($_GET['phone']));
			$reason = htmlspecialchars(trim($_GET['call_reason']));
			$reason_call = array(
				"You’ll note that I’ve left a message for you",
				"Unfortunately, your line was busy",
				"It seems your voice mailbox is full",
				"It seems your phone number is no longer correct"
			);
			
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
<div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->
			<p>
				<strong>Subject:</strong>
				Trying to reach you – please call <?php echo $SysName;?> at 1(888) 681-6811
			</p>
			<br>

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    
			
			<p>
				I just tried to call you at <?php echo $phone;?> and was unable to reach you. <?php echo $reason_call[$reason];?>. <b>Please call me when you get this email.</b> I need to connect with you right away about your account.
			</p>
			
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
							<label for="phone">
								Primary Phone number:
							</label>
							<input class="form-control" type="text" placeholder="888-681-6811" name="phone" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="call_reason">
								Contact Outome:
							</label>
							<select class="form-control" name="call_reason">
								<option value=""></option>
								<option value="0">Left Voicemail</option>
								<option value="1">Bussy Line</option>
								<option value="2">Voicemail is full</option>
								<option value="3">Incorrect Phone Number</option>
							</select>
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