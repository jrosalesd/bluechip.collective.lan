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
			<div>
			<!-- Email Temaplate -->
			
			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
			<p>Your current balance is $<?php echo number_format($bal,2,".",","); ?>. Your remaining payment schedule as of today can be found below:</p>
			
			<h3 class="offset25px">Payment Schedule</h3>
    		<div class="offset25px">
    			    <ul class="schl">
    			        <?php
            			$hist = str_ireplace("\n",",",$pmthist);
            			$hist = explode(",",$hist);
            			$dates = array();
            			$amount = array();
            			//var_dump($hist);
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