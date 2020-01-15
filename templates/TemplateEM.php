<?php
$subpage = "Name";
?>
<div class="jumbotron">
	<hr>
		<div class="row">
			<ul class="list-inline text-center">
				<li class="col-md-4">
					<a href="cmmenu.php?col=<?php echo $_GET['col'];?>&temp=<?php echo --$back;?>" class="btn btn-success" role="button">
						<span class="glyphicon glyphicon-arrow-left"></span>
						Previous Template
					</a>
				</li>
				<li class="col-md-4">
					<a href="cmmenu.php" class="btn btn-primary" role="button">
						<span class="glyphicon glyphicon-menu-hamburger"></span>
						Collection Menu
					</a>
				</li>
				<li class="col-md-4">
					<a href="cmmenu.php?col=<?php echo $_GET['col'];?>&temp=<?php echo ++$forth;?>" class="btn btn-success" role="button">
						Next Template
						<span class="glyphicon glyphicon-arrow-right"></span>
					</a>
				</li>
			</ul>
		</div>
	<hr>
	<div class="row">
		<div class="col-md-3">
			<h2>
				
			</h2>
			<font color="red">
				<h5>
					<b>Generate: </b>Copy and Paste 
					<br>
					<b>Template: </b>
					<br>
					<b>Action: </b>
				</h5>
			</font>
		</div>
		<div class="col-md-9" style="border-left: solid;">
			<?php
			if($_GET['set'] == "on"){
				//variables to complete template
				$brwName = trim($_GET['brwName']);
				
				?>
				<div>
					<a class="btn btn-danger col-md-3" href="cmmenu.php?col=<?php echo $_GET['col'];?>&temp=<?php echo $_GET['temp'];?>">
							Reset
						<class="glyphicon glyphicon-refresh"></span>
					</a>
				</div>
				<br>
				<div>
				<!-- Email Temaplate -->
				<?php
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
					<input type="hidden" name="col" value="<?php echo $_GET['col'];?>"/>
					<input type="hidden" name="temp" value="<?php echo $_GET['temp'];?>"/>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="brwName">
									Borrower´s First Name:
								</label>
								<input class="form-control" type="text" name="brwName"/>
							</div>
						</div>
						<div class="col-md-5"></div>
						<div class="col-md-2"></div>
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
</div>
<?php

?>


				<p>
			    	Hi <?php echo ucfirst($brwName);?>,
			    </p>
			    <br>
			    <p>Thank you for contacting Spotloan in regards to your account. My name is <?php echo $SysName;?>. and I will be assisting with your account today.
			    </p>
			    
			    
<?php
				if ($state_status == "No"){
					?>
					<p>
						<?php echo $state_note;?>
					</p>
					<?php
				}
				?>