            <div class="row">
                <div class="col-md-3">
                    <h2>
						Request for More Funds Email
					</h2>
					<font color="red">
						<h5>
							<b>Generate: </b>When someone contacts their RM asking if they can get a second loan.
							<br>
							<b>Action:</b> Manual - Agent to edit and send 
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
						<div>
						<!-- Email Temaplate -->
						<p><strong>Subject:</strong> Getting another loan with Spotloan</p><br>
					<p>
					    	Hi <?php echo ucfirst($brwName);?>,
					    </p>
					    <br>
					    
						<p>Thanks for contacting me. At Spotloan, we offer only one loan at a time and these loans can’t be rolled over without paying off the loan.</p>
					    <p>Here’s what we can do:</p>
					    
					    <p>-  I can work with you if you need to make any changes to your upcoming payment. I just need to know <b><u>2 business day</u></b> in advance.</p>
					
					    <p>-  After paying off your current loan, you can apply again – in most cases, <b>you’re guaranteed a second loan.</b></p>
					    <p>Think about it and let me know what you want to do.</p>
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
							<button type="submit" name="set" class="btn btn-success" value="on" colspan="3">
								Generate Email
							</button>
						</form>
						<?php
					}
					?>
                </div>
            </div>