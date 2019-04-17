<div class="row">
    <div class="col-md-3">
        <h2>
			Customer Emails
		</h2>
		<font color="red">
				<br>
				<b>Template: </b>Custome Email to address all other topics that are not templated 
				<br>
				<b>Action: </b>Make sure to ask have your Supevisor review before sending any custom emails.
			</h5>
		</font>
    </div>
    <div class="col-md-9" id="embody" style="border-left: solid;">
        <?php
		if($_GET['set'] == "on"){
			//variables to complete template
			$brwName = htmlspecialchars(trim($_GET['brwName']));
			$comment = nl2br(htmlspecialchars($_GET['comment']));
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
			<div id="copy_notify"></div>
<div class="row">
                    <div class="col-lg-4"><button id="copy-init" class="btn btn-primary" onclick="copyFollowUp('email-body',this.value)" value="email">Copy Email</button></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <hr>
            <div id="email-body">
                <!-- Email Temaplate -->

			<?php echo brwname($_GET['brwName'],$_GET['sup-correction']);?>
		    
		    <p>
				<?php echo $comment;?>
			</p>
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
    			if ($state_status == "No"){
    				?>
    				<p>
    					<?php echo $state_note;?>
    				</p>
    				<?php
    			}
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
							<input class="form-control" type="text" placeholder="i. e. David" name="brwName" id="brwName" required/>
						</div>
						<div class="form-group">
							<label for="state"  alt="Not Required">
								Borrower's State:
							</label>
							<select class="form-control" id="state" name="state">
								<option value="">Select</option>
								<?php
								if($rows > 0){
									while($row = mysqli_fetch_array($state_q)){
										?>
										<option value="<?php echo $row['id']?>" <?php if($_GET['state'] == $row['id']){echo "selected";}?>><?php echo $row['state_name']?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-8">
					    <label for="comment">
					        Instroduce message below:
					    </label>
						<textarea name='comment' id="comment" class='form-control' rows='10' col='10' id='comment'></textarea>
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