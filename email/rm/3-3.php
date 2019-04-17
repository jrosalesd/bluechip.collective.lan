<div class="row">
    <div class="col-md-3">
        <h2>
			When will my funds be Deliver? 
			<br>
			<small>Customer asking about her deposit.</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer emails or calls the RM and says the funds have been not been deposited and wants to know when deposit will be done.
				<br><br>
				<b>Action: </b>Manual - Agent to edit and send
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$start = strtotime($_GET['1stbd']);
			//next Business day
            $currentYear = date('Y');
            $tmpDate = date('m/d/Y',$start);
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
            $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
            
            while (in_array($nextBusinessDay, $holidays)) {
                $i++;
                $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
            }
            $day1 = date_create($_GET['1stbd']);
            $day2 = date_create($nextBusinessDay);
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
				<strong>Subject:</strong> Your Spotloan deposit update
			</p>
			<br>
			

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>		    
			
			<p>Thanks for contacting me. I hope you are well.</p>
			<p>In regards to your e-mail, the funds arrive within 1-2 business days after you've confirmed the e-mail; these said,  funds were set to arrive either <?php echo date_format($day1,"l, F jS"); ?> or <?php echo date_format($day2,"l, F jS"); ?>, any time during business hours.</p>
			<p>I recommend you stay in contact with your bank today so you can know when the funds will arrive. Let me know if you have any questions.</p>
			
		    
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
                            <label for="1stbd">
                                First Business day for Deposit:
                            </label>
                            <input class="form-control" type="date" name="1stbd" required/>
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