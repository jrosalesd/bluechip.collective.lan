<div class="row">
    <div class="col-md-3">
        <h2>
			Online Account access Issues
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer calls because he or she can't complete the online account registration.
				<br>
				<b>Template: </b>Manual - Agent to edit and send
				<br>
				<b>Action: </b>
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$cofdate = date_create(htmlspecialchars($_GET['confdate']));
			$confdm = $_GET['confdate'];
			
			$currentYear = date('Y');
                        $tmpDate = $confdm;
                        $holidays = [ 
                            date("m/d/Y",mktime(0, 0, 0, 1, 1,$currentYear)), 
                            date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $currentYear))), 
                            date("m/d/Y",strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $currentYear))), 
                            date("m/d/Y",strtotime("last Monday of May $currentYear")), 
                            date("m/d/Y",mktime(0, 0, 0, 7, 4, $currentYear)), 
                            date("m/d/Y",strtotime("first Monday of September $currentYear")), 
                            date("m/d/Y",strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $currentYear))), 
                            date("m/d/Y",mktime(0, 0, 0, 11, 11, $currentYear)), 
                            date("m/d/Y",strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $currentYear))), 
                            date("m/d/Y",mktime(0, 0, 0, 12, 25, $currentYear))
                        ];
                        
                        $i = 1;
                        $nextBusinessDay0 = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
                        
                        while (in_array($nextBusinessDay0, $holidays)) {
                            $i++;
                            $nextBusinessDay0 = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
                        }
                        $day1=date_create($nextBusinessDay0);
                        
                        $i = 2;
                        $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
                        
                        while (in_array($nextBusinessDay, $holidays)) {
                            $i++;
                            $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
                        }
                        $day2=date_create($nextBusinessDay);
                    
                        
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
			<p><strong>Subject:</strong> Your Spotloan Online Access</p>
			<br>

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    

		    <p>In regards to the online account, Once you have signed the loan agreement, click ‘next step’</p>
		    <ul>
			    <li>
			    	<p>This will take you to a ‘choose password’ page</p>
			    </li>
			    <li>
			    	<p>We give you a gage of how strong the password is and won’t let you proceed until you are in the green.</p>
			    </li>
			    <li>
			    	<p>Once you have set your password, you will be able to log in from the www.spotloan.com page on the top right corner.</p>
			    </li>
		    </ul>
			<p>
				The funds arrive 1-2 business days after you've confirmed the e-mail. I see here you confirmed it yesterday <?php echo date_format($cofdate,"l, F jS"); ?>; therefore, the funds will arrive either today <?php echo date_format($day1,"l, F jS");?> or <?php echo date_format($day2,"l, F jS");?>.
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="confdate">
                                Confirmation Date:
                            </label>
                            <input class="form-control" type="date" name="confdate" required/>
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