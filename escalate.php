<?php
$page_name = "Escalations";
include 'header.php';
?>
<div class="jumbotron">
	<div class="text-center">
	    <h1 style="color:#3793D2;">
	        Escalation Procedures
        </h1>
	</div>
	<hr>
	<br>
	
	<div>
	    <h3>
	        <a data-toggle="collapse" data-target="#esc">
	            Escalation Queue
	        </a>
	    </h3>
	    <div id="esc" class="collapse">
	        
	        <p>
	        	Transfer call to Credit Service Manager (
	        	<?php
	        	include 'includes/dbh.inc.php';
	        	$q = "Select * FROM users WHERE user_role='Credit Service Manager' AND user_status=1";
	        	$q_result = mysqli_query($conn, $q);
	        	$numrows=mysqli_num_rows($q_result);
	        	if ($numrows > 0) {
	        		while($row = mysqli_fetch_array($q_result)){
	        			echo " |".$row['user_shortname'].". "; 
	        		}
	        	}
	        	
	        	$conn->close();
	        	?>
	        	)
	        </p>
	        <p>
	            No need to take action
	            When an account is assigned to any escalations agent or to the escalations queue, this account must not be touched. Instead you should transfer call inmidiately to a Credit Service Manager.
	        </p>
	    </div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#pc">
				Pending Collective (Settlement or Arrangements
			</a>
		</h3>
		<div class="collapse" id="pc">
			<p>
				Transfer call to CM
			</p>
			<p>
				You can take payment/Send email to FR
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#bk">
				Pending Bankruptcy/Bankruptcy/WIS 128.21
			</a>
		</h3>
		<div class="collapse" id="bk">
			<p>
				<ol>
					<li>
						<p>
							<b>If you receive a call:</b> Handle the call - Provide the status of the account
						</p>
					</li>
					<li>
						<p>
							If borrower calls in to make payment
							<ul>
								<li>
									<p>
										Inform borrower that to continue payments, their lawyer must mail a letter requesting continued debt for the borrower with an explanation why.	
									</p>
								</li>
							</ul>
						</p>
					</li>
					<li>
						<p>
							Borrower states their application for Bankruptcy was denied and they would like to resume payments
						</p>
						<ul>
							<li>
								<p>
									Thank them for the notification and inform them to fax us the paperwork to indicate this information. Once this is received we will be able to resume their loan payments.	
								</p>
									
							</li>
						</ul>
					</li>
					<li>
						<p>
							Borrower calls in to inform that he/she is filling for bankruptcy
						</p>
						<ul>
							<li>
								<p>
									Ask for Attorney’s name and number
								</p>
							</li>
							<li>
								<p>
									Escalate to TLs
								</p>
							</li>
							<li>
								<p>
									Inform borrower that a member from our company will be contacting his/her attorney
								</p>
							</li>
						</ul>
					</li>
				</ol>
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#cede">
				Cease and Desist Queue: (Customers who have requested that we cease and desist communication)
			</a>
		</h3>
		<div class="collapse" id="cede">
			<p>
				<b>If you receive a call:</b><br>
				Transfer the call to a supervisor or Credit service Manager
			</p>
			<p>
				<b>If borrower submits a Cease and Desists. (Any type)</b><br>
				Inform TL and forward any documentation submitter by borrower.
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#ips">
				Impending Sale Queue (Pending for sale – 91+days)
			</a>
		</h3>
		<div class="collapse" id="ips">
			<p>
				If you receive a call: Transfer to FR
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#sold">
				Sold Queue
			</a>
		</h3>
		<div class="collapse" id="sold">
			<p>
				<b>If you receive a call:</b><br>
				<b>Check the Sold List Account by Clicking <a href="./soldlist.php" target="_blank">here</a></b>
				<br><br>
					[Script] Due to the delinquency (or broken settlement payments) on your Spot loan, your loan was sold to a 3rd party collection company. Spot loan can no longer work with you. You will need to work with that agency to resolve the balance you had with Spot loan, since they now own the debt
			</p>
			<p>
				<g class="text-center">
					Collection Agencies
				</g>
				<br><br>
				<?php
				include 'includes/dbh.inc.php';
	        	$q = "Select * FROM debtsalebuyers WHERE NOT PhoneNumber='N/A' ORDER BY Code ASC";
	        	$q_result = mysqli_query($conn, $q);
	        	$numrows=mysqli_num_rows($q_result);
	        	?>
	        	<table border="3" style="width:100%;">
	        		<thead>
	        			<tr>
							<th>
								Abbreviation
							</th>
							<th>
								Company Name
							</th>
							<th>
								Phone Number
							</th>
						</tr>
	        		</thead>
					<tbody>
						<?php
						while($row=mysqli_fetch_array($q_result)){
							?>
							<tr>
								<td><?php echo $row['Code']?></td>
								<td><?php echo $row['Name']?></td>
								<td><?php echo $row['PhoneNumber']?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
					<tfoot>
						<tr>
					        <td class="text-center" colspan='3' >
					        	**Please confirm with your Supervisor before giving out any information to the borrower.**
					        </td>
				        </tr>
					</tfoot>
	        	</table>
	        	<?php
	        	
	        	$conn->close();
				?>
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#dq">
				Deceased Queue
			</a>
		</h3>
		<div class="collapse" id="dq">
			<p>
				<b>Action:</b><br>
				 Forward to TL - Include all Managers on Email
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#dcq">
				Debt Consolidation Queue
			</a>
		</h3>
		<div class="collapse" id="dcq">
			<p>
				<b>If the Loan is already on the Any Debt Consolidation Queue:</b><br>
	        	Transfer Call to Debt Consolidation Agent (
	        	<?php
	        	include 'includes/dbh.inc.php';
	        	$q = "Select * FROM users WHERE user_role='Debt Consolidation' AND user_status=1";
	        	$q_result = mysqli_query($conn, $q);
	        	$numrows=mysqli_num_rows($q_result);
	        	if ($numrows > 0) {
	        		while($row = mysqli_fetch_array($q_result)){
	        			echo " |".$row['user_shortname'].". "; 
	        		}
	        	}
	        	
	        	$conn->close();
	        	?>
	        	)
	        </p>
			<p>
				<b>If borrower calls in to inform that he’s going to use a DC</b><br>
					a.- Ask for company’s name and phone number<br>
					b.- Forward to TL - (incluide all Supervisors/Managers in your site)
			</p>
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#fq">
				Fraud Queue
			</a>
		</h3>
		<div class="collapse" id="fq">
			<div>
				<p>
					<a data-toggle="collapse" data-target="#fq-1">
						If caller has no account with us
					</a>	
				</p>
				<div class="collapse" id="fq-1">
					<p>
						Empathize with Caller for the situation they are going through.<br>
						Fill out Fraud Form.<br>
						<a data-toggle="collapse" data-target="#fraud-frm">
							Fraud Form
						</a>
						<div id="fraud-frm" class="collapse">
							<iframe src="https://docs.google.com/a/spotloan.com/forms/d/e/1FAIpQLSfNau8WWKtCC-idtqXGhQfLKSxPkwauyYMEZGFvCeHSbqFUkw/viewform" height="625px" width="800px" scrolling="auto" >
							</iframe>
						</div>
					</p>
				</div>
			</div>
			<div>
				<p>
					<a data-toggle="collapse" data-target="#fq-2">
						If caller has an account with us
					</a>	
				</p>
				<div id="fq-2" class="collapse">
					<p>
						Transfer the call to a CSM (
						<?php
			        	include 'includes/dbh.inc.php';
			        	$q = "Select * FROM users WHERE user_role='Credit Service Manager' AND user_status=1";
			        	$q_result = mysqli_query($conn, $q);
			        	$numrows=mysqli_num_rows($q_result);
			        	if ($numrows > 0) {
			        		while($row = mysqli_fetch_array($q_result)){
			        			echo " |".$row['user_shortname'].". "; 
			        		}
			        	}
			        	
			        	$conn->close();
			        	?>
			        	)
					</p>
					<p>
						If you receive notification of fraud claims in writing (email/fax), send it to your Team Lead/Manager
					</p>
					<p>
						If a Credit Service Manager is available in InContact, transfer the call with a two step transfer to introduce the caller and purpose of the call
					</p>
					<p>
						If unable to transfer the call	
						<ol>
							<li>
								<p>
									Document the caller’s statements of identity theft on the account	
								</p>
							</li>
							<li>
								<p>
									Note the phone number you called or received the call from.
								</p>
							</li>
							<li>
								<p>
									Request a valid email address so our Credit Service Managers may communicate with them if they are unavailable via Phone - Document the email on the account (if the email they provide is the same as what is on the account, note this and do not follow the step below)
								</p>
							</li>
							<li>
								<p>
									Mark the listed on the account as invalid (only if different from email given by consumer)
								</p>
							</li>
						</ol>
					</p>
					<p>
						<b>
							DO NOT request the customer to file a police report as there is specific communication and information that must be provided by the Credit Service Manager<br>
							DO NOT give the caller any information that is on the Spotloan file.<br>
							DO NOT tell them the address, any reference names, phone numbers, bank account information
						</b>
						<ul>
							<li>
								<p>
									Loan details of any kind cannot be shared with the caller. This will be handled during the investigation conducted by Escalations/Credit Service Manager
								</p>
							</li>
						</ul>
					</p>
				</div>
			</div>				
		</div>
	</div>
	<hr>
	<div>
		<h3>
			<a data-toggle="collapse" data-target="#conq">
				Contingent Queue
			</a>
		</h3>
		<div class="collapse" id="conq">
			<p>
				Spotloan is partnering up with TrueAccord, a 3rd party debt Collection firm that will be collecting on a small number of delinquent accounts on behalf of Spotloan. These accounts have not been sold, so please do not say this to the borrowers. These accounts are simply being serviced by a different agency.	
			</p>
			<p>
				<b>Relationship Managers:</b><br>
				<i>If you receive an IB call from a borrower that was placed in the Contingent Queue on 06/10/14, let them know that their account is being serviced by an outside agency, and they will be contacted soon.  DO NOT transfer the call to Collection nor perform any type of actions on the account.  If the borrower insists on working with Spotloan only, please let them know that someone will contact them shortly from Spotloan – Forward Information to TL</i><br>
				<g>
					TrueAccord<br>
					1-866-611-2731<br>
					9am to 5pm PST, Monday to Friday
				</g>
			</p>
			<p>
				<b>Can a Contingent Queue account take out a new loan?</b><br>
				They are eligible to re-apply if they pay in full or settle in full with the Contingency company TrueAccord – Forward information to TL – Ask for help
			</p>
		</div>
	</div>
	<hr>
</div>
<?php
include 'footer.php';
?>