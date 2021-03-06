<div class="row">
    <div class="col-md-3">
        <h2>
			Payment Schedule Email
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a customer requests their payment Schedule 
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
			$pmthist =  trim($_GET['pmthist']);
			
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
			<p><strong>Subject:</strong> Check it out – Your payment Schedule</p><br>
			
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>Thanks for checking in on your loan. I’ve attached your payment schedule.</p>
			
			<h3 class="offset25px">Payment Schedule</h3>
    		<div class="offset25px">
    			    <ul class="schl">
    			        <?php
            			$hist = str_ireplace("\n",",",$pmthist);
            			$hist = str_ireplace("\t",",",$hist);
            			$hist = explode(",",$hist);
            			$dates = array();
            			$amount = array();
            			foreach ($hist as $k => $v) {
                            if ($k % 2 == 0) {
                                $dates[] = date_create($v);
                            }
                            else {
                                $amount[] = str_ireplace("$","",$v);
                            }
                        }
            			for ($i = 0; $i < count($dates); $i++) {
            				?>
            				<li><?php echo date_format($dates[$i],"D, M jS");?> - <?php echo "$".number_format($amount[$i],2,".",",");?></li>
            				<?php
            			}
            			?>
    			    
    			    </ul>
			</div>
			<?php
            NxtPmt($dates[0],  $amount[0], "on");
            ?>
            
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
					<div class="col-md-8">
						<div class="form-group">
							<label for="brwName">
								Date - Amount
							</label>
							<textarea class="form-control text-left " name="pmthist" rows="10" required></textarea>
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