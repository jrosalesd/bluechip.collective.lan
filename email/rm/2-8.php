<div class="row">
    <div class="col-md-3">
        <h2>
			Restructure Schedule update <small>(RM should probably call on this one)</small>
		</h2>
		<font color="red">
			<h5>
				<b>Generate: </b>When a loan is restructured and the system is updated and Borrower request an updated payment schedule
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$pmthist = trim($_GET['pmthist']);
			
			//next payment
			$pmtnote = htmlspecialchars($_GET['pmtnote']);
			$nextpmtdate = date_create(htmlspecialchars($_GET['nextpmtdate']));
			$nextpmtamt = htmlspecialchars($_GET['nextpmtamt']);
			
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
			<p>
				<strong>
					Subject:
				</strong> 
				Your Spotloan - Schedule Update
			</p>
		<p>
		    	Hi <?php echo ucfirst($brwName);?>,
		    </p>
		    <br>
		    
		    
			<p>I really appreciate you contacting me. I’m glad we could make adjustments so that you can stay on track with paying off your loan. Attached is a copy of your new payment schedule.</p>
			
			<table class="bordered" style="margin-top:20px;margin-bottom:40px;font: 20px/30px Arial, sans-serif;">
				<thead>
					<th class="col-sm-2">
						Date
					</th>
					<th class="col-sm-3">
						Amount
					</th>
				</thead>
				<tbody>
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
						<tr>
							<td class="col-sm-2"><?php echo date_format($dates[$i],"D, M jS");?></td>
							<td class="col-sm-3"><?php echo "$".number_format($amount[$i],2,".",",");?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
					
			</table>
			<?php
            if ($pmtnote == 'on') {
                ?>
                <p>
                    As a friendly reminder, your next scheduled payment of $<?php echo number_format($nextpmtamt,2,".",",");?> will be due on <?php echo date_format($nextpmtdate,"l, F jS");?>.
                </p>
                <?php
            }
            ?>
            <?php
            if ($_GET['additional'] == 'on') {
                ?>
                <p>
                    <?php echo nl2br(htmlspecialchars($_GET['additionalnote']))?>
                </p>
                <?php
            }
            ?>
            
			<p>Let me know if you have any questions.</p>
            <br>
            
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
				<div class="row">
					<div class="col-md-3">
						<div class="checkbox">
							<label for="pmtnote">
							    <input type="checkbox"  id="pmtnote" name="pmtnote" onclick="nextpmt()"/><b>Next Payment Notice</b>
							</label>
						</div>
						<div class="checkbox">
							<label for="additional">
								<input type="checkbox"  id="additional" name="additional" onclick="addnote();"/><b>Other Notes</b>
							</label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<g id="pmtnotebody"></g>
							</div>
							<div class="col-md-6">
								<g id="notefield"></g>
							</div>
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