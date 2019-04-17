<div class="row">
    <div class="col-md-3">
        <h2>
			NSF Respose Email
		</h2>
		<h4>(For the less than 1% who will still miss their payment)</h4>
		<font color="red">
			<h5>
				<b>Generate: </b>se when customer asks why we charge NSF fee
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
            $bankname = nl2br(htmlspecialchars($_GET['bankname']));
			$return = htmlspecialchars($_GET['return']);
			
			//variables changes
			$pmtAmt *=2;
			
			//next Business day
            $currentYear = date('Y');
            $tmpDate = date('m/d/Y');
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
            
            $i = 2;
            $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
            
            while (in_array($nextBusinessDay, $holidays)) {
                $i++;
                $nextBusinessDay = date('m/d/Y', strtotime($tmpDate . ' +' . $i . ' Weekday'));
            }
            
            $pmtdate = date_create($nextBusinessDay);
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
			<p>
				<strong>Subject:</strong>Non Sufficient Fund Fee? Here is why!
			</p>
			<br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			
			<p>
				I understand that you are going through a tough time and by not doing payments your Spotloan gets expensive fast – it can extend the life of your loan and add more interest plus the $10.00 fee for insufficient funds. As your Relationship Manager, I want to help you save money.
			</p>
			<p>
				Your best option is to make up your payment soon. Every day you accrue interest. The longer you wait the more expensive this option becomes. I’m here to work with you.
			</p>
			
			<ol>
				<li>
					<p>
						We can set a double payment on <?php echo date_format($pmtdate,"l, F jS"); ?> of $<?php echo number_format($pmtAmt,2,".",","); ?>.	
					</p>
				</li>
				<li>
					<p>
						We can set the failed payment as an extra payment at a later time, just let me know when you'd be able to make it up.
					</p>
				</li>
			</ol>
			
			<p>
				All of these options will cost you more because of additional interest that happens when you extend your loan terms. Please let me know right away what option above works best for you. I need at least 2 business days before your payment is due to make these changes.
			</p>
			<p>
				Also your <?php echo $bankname;?> account appears as <?php echo strtolower($return);?> in our system. Let me know if you will change your banking information so I can update the system before your future payments.
			</p>
			<p>
				Again, I won't make any changes to your account until you confirm what you’d like me to do. Let me know!
			</p>
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="pmtAmt">
                                Regular Payment Amount:
                            </label>
                            <input class="form-control" type="number" step="0.01" name="pmtAmt" required/>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
                            <label for="bankname">
                                Bank Name:
                            </label>
                            <input class="form-control" type="text" name="bankname" required/>
                        </div>
						<div class="form-group">
                        	<label for="return">
                        		Return Reason:
                        	</label>
                        	<select name="return" class="form-control">
                        		<option value="">Choose Return Code</option>
                        		<?php
                        		$q = "SELECT * FROM ach_return_codes";
                        		$result = mysqli_query($conn, $q);
                        		$numrows = mysqli_num_rows($result);
                        		if ($numrows > 0) {
                        			while($row = mysqli_fetch_array($result)){
                        				?>
                        				<option value="<?php echo $row['short_desc'];?>"><?php echo $row['code']." - ".$row['desc'];?></option>
                        				<?php
                        			}
                        		}
                        		?>
                        	</select>
                        </div>
					</div>
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