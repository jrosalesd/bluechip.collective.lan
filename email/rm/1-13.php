<div class="row">
    <div class="col-md-3">
        <h2>
			Missed payment <small>(NSF)</small>
		</h2>
		<h4>(For the less than 1% who will still miss their payment)</h4>
		<font color="red">
			<h5>
				<b>Generate: </b>Copy and Paste 
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
			$bankname = nl2br(htmlspecialchars($_GET['bankname']));
			$pmtAmt = htmlspecialchars($_GET['pmtAmt']);
			$pmtdate = date_create($_GET['pmtdate']);
			$return = htmlspecialchars($_GET['return']);
			
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
			<p><strong>Subject:</strong> Whoops! You’ve missed a Spotloan payment</p>
			<br>

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
			
			<p>
				I sent you a payment confirmation email two days ago. Unfortunately, <?php echo $bankname;?> just told me that your payment of $<?php echo number_format($pmtAmt,2,".",","); ?> on <?php echo date_format($pmtdate,"l, F jS"); ?>, didn’t go through because <?php echo $return;?>. This means that the payment confirmation you received is incorrect and we have added a $10 fee to your loan balance.
			</p>
			<p>
				I know that sometimes it's tough to cover all of your expenses. But it’s important that you get your account back on track quickly to avoid extra interest. Even a payment of just $20 can bring your account current.
			</p>
			<p>
				I’d like to help you out, so please call me at 1(888) 681-6811.
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
                            <label for="pmtdate">
                                Missed Payment Date:
                            </label>
                            <input class="form-control" type="date" name="pmtdate" required/>
                        </div>
                        <div class="form-group">
                            <label for="pmtAmt">
                                Missed Payment Amount:
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
                        				<option value="<?php echo $row['brw_expo'];?>"><?php echo $row['code']." - ".$row['desc'];?></option>
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