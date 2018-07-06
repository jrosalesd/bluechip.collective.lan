<?php
$page_name = "App Script";
include 'header.php';
if (!isset($_GET['app'])) {
    header("Refresh:0; url=?app=1&scr=");
}
?>
<div class="jumbotron">
    <div class="btn-group btn-group-justified">
        <a href="script.php?app=1&scr=<?php echo $_GET['scr'];?>#script" class="btn <?php if($_GET['app'] == 1){echo "btn-success";}else{echo "btn-default";}?>">Inbount Application</a>
        <a href="script.php?app=2&scr=<?php echo $_GET['scr'];?>#script" class="btn <?php if($_GET['app'] == 2){echo "btn-success";}else{echo "btn-default";}?>">Outbound Application</a>
    </div>
    
    <br>
    <img class="script" src="format/img/logo.png" alt="Spotloan Logo" style="margin-left: 250;" Width="500" height="150">
    <div id="script">
	<div  id="content" style="margin-left: auto; margin-right: auto;">
	    <div class="btn-group btn-group-justified">
            <a class="btn <?php if($_GET['scr'] == 0){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=0#script">Introductions</a>
            <a class="btn <?php if($_GET['scr'] == 1){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=1#script">Pending/Callback</a>
            <a class="btn <?php if($_GET['scr'] == 2){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=2#script">Income</a>
            <a class="btn <?php if($_GET['scr'] == 3){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=3#script">Banking</a>
            <a class="btn <?php if($_GET['scr'] == 4){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=4#script">Loan Term </a>
            <a class="btn <?php if($_GET['scr'] == 5){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=5#script">Scoring</a>
            <a class="btn <?php if($_GET['scr'] == 6){echo "btn-success";}else{echo "btn-default";}?>" href="script.php?app=<?php echo $_GET['app'];?>&scr=6#script">Decision</a>
	    </div>
	</div>
	<br>
	<?php
	if ($_GET['scr']==0) {
	       ?>
	        <div style="overflow-y: auto; height:600px">
            <p>
                <i>
                    We do not complete applications over the phone. The process must be started online. In order to apply a borrower must have an email and computer access is helpful. Should someone have technical issues, we may transfer them to the help Team to assist.
                    <br>REMEMBER TO ALWAYS THANK REPEAT BORROWERS FOR COMING BACK AT THE START OF THE CALL!
            </i>
            </p>
            <p><mark style="background-color:yellow;">All applications must be verbally confirmed with the individual whose name the loan is under. You may not confirm a loan with a spouse, child, or other party. Should that be requested, we will need to view the Power of Attorney Documentation.</mark></p>
            <?php
            if ($_GET['app']==1) {
               ?>
                <p>
                    <font color="#3793D2">RM:</font>  Thank you for calling Spotloan, this is <?php echo $SysName;?> how may I help you? <br>                <font color="#F09646">Caller: I would like to apply for a loan.</font>
                </p>
                
                <p><font color="#3793D2">RM:</font>  Great! Loan applications are done online at spotloan.com and only take a few minutes to fill out. Once you complete the online application be on the lookout for an email to help you complete the process. If you are approved you may receive the funds as soon as the next business day!</p>
                
                <p>
                    <font color="#F09646">
                        Caller: Ok, I will do that.
                    </font>
                    <br>
                    <font color="#3793D2">
                        RM:
                    </font>  
                    Thank you for calling Spotloan.
                </p>
                
                <p><font color="#F09646">Caller: I don’t want to go online. I want to fill the application out over the phone. </font></p>
                
                <p><font color="#3793D2">RM:</font>  Unfortunately, I am unable to start an application over the phone; all applications must be completed online. Please go to spotloan.com to begin the process.</p>
                
                <p><i>If they state technical issues or are very difficult: What you can do is email our help Team at help@spotloan.comand they will get back to you within 48 hours.</i></p>
                
                <p><font color="#F09646">Caller: I have some questions about your loans?</font></p>
                
                <p><font color="#3793D2">RM:</font>  Well, all applications are filled out online at spotloan.com and almost all the questions callers have can be found on the FAQ page but are there any specific questions I can answer for you now?</p>
               <?php
            }elseif ($_GET['app']==2) {
                ?>
                <p><b>Voicemail for Applicants:</b><br>
                <font color="#3793D2">RM:</font> Hi, this message is for [Applicant Name]. I received your Spotloan application but need to verify a few details with you over the phone. Please give me a call back to complete this at 888-681-6811. Thank you and have a great day!</p>
                <?php
            }
            ?>
                
            </div>
            <p><font color="red"><b>Click on Pending/Callback Tab</b></font></p>
	        <?php
	    }elseif ($_GET['scr']==1) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
	            <?php
	            if ($_GET['app']==1) {
	               ?>
	               <p>
	                   <font color="#3793D2">RM:</font> Thank you for calling spotloan this is <?php echo $SysName;?>, how may I help you?
	               </p>
	                <p><font color="#F09646">Caller: I just applied at Spotloan.com, and I would like to know if I was approved.</font></p>
                    <p><font color="#3793D2">RM:</font>  I will be more than glad to help you check the status of you application. May I please have the phone number you used for your application?</p>
                    <p><font color="#F09646">Caller: Yes, my number is ### ### ####</font></p>
                    <p><font color="#3793D2">RM:</font>Thank you. May I please have your first and last name?</p>
                    <p><font color="#F09646">Caller: Yes, my name is [caller's name]</font></p>
                    <p><font color="#3793D2">RM:</font>Thank you.</p>
	               <?php
	            }elseif ($_GET['app']==2) {
	                ?>
	                <p><font color="#3793D2">RM:</font>  Hi, this is <?php echo $SysName;?> calling from Spotloan, is [Applicant Name] available? </p>
                    <div style="margin-left: 50px;">
                        <p>3rd Party Answers / Applicant is not available.<br>
                        <font color="#3793D2">RM:</font>  When is a better time to call back? Thank you.<br>
                        <font color="#828282"><i>Select a customer call back time based on given response.</i></font></p>
                    </div>
                    <p><font color="#3793D2">RM:</font> Hi [customer], I’m a Relationship Manager with Spotloan, and have your application here for a final review. Do you have a few minutes to speak with me?</p>
                    <p><font color="#828282"><i>(This is a courtesy call we give to all our applicants to verify the information entered online is correct - if asked, they will have an answer if they are approved at the end of the call)</i></font></p>
                    <p><font color="#F09646">Caller: Yes</font></p>
                    <p><font color="#3793D2">RM:</font>  Great! I want to let you know this call is recorded and may be monitored.</p>
	                <?php
	            }
	            ?>
                
                <p><font color="#3793D2">RM:</font>  And, I have here that you applied for a [$] loan over [#] months, is that correct?</p>
                <p><font color="#3793D2">RM:</font> Great and for complete verification, can you please confirm your email address? </p>
                <p><font color="#3793D2">RM:</font>  Thank you. And I want to verify that we have the correct social.  I have the first five digits as [$+#] can you please give me the last four? </p>
                <p><font color="#3793D2">RM:</font>  Perfect, and is your birthday [month, date, year]? </p>
	        </div>
	        <p><font color="red"><b>Click on Income Tab</b></font></p> 
	        <?php
	    }elseif ($_GET['scr']==2) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
                <p><font color="#3793D2">RM:</font>  Thank you. </p>
                <p><font color="#3793D2">RM:</font> Next, we schedule payments according to the days that you get paid, so I just want to make sure we have that information correct as well.</p> 
                <p><font color="grey"><i>If asked, this is to confirm we have all digits typed in correctly. </i></font></p>
                <p><font color="#3793D2">RM:</font>  I have that you got paid on [date] and expect to get paid again on [date]. Is that correct?</p>
                <p><font color="#3793D2">RM:</font>  Are you paid [every other week]/ [twice a month] / [monthly]?</p>
                <p><font color="grey"><i>The system automatically changes 15th/30th (last working day) of the month to 1st/16th. Please explain this change and let them know that we do not want to take payments before they get paid as can happen with the date changes.</p>
                <p>Semi-monthly income should be dates in combination that have 15 days between for our services, for example: 1st and 16th, 2nd and 17th, 5th and 20th)</i></font></p>
                
                <p>
                    <a href="#mil" data-toggle="collapse">
                        <b>
                            <i>
                                Verify Military question if marked YES 
                            </i>
                        </b>
                    </a>
                </p>
                <div id="mil" class="collapse" style="margin-left: 50px;">
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font> 
                        Are you in the military or a dependent of anyone in the military?
                    </p>
                    <p>
                        <font color="#828282">
                            <i>
                                Only applicable if they are active/reserve duty. Dependents qualify as spouses or children, if the borrower is still enrolled in school and lives at home. Must be Army, Navy, Marine Corps, Air Force or Coast Guard. Also individuals who get over half support for 180 days immediately preceding applying for a loan will qualify for this discounted rate.
                            </i>
                        </font>
                    </p>
                </div>
	        </div>
	        <p><font color="red"><b>Click on Banking Tab</b></font></p>
	        <?php
	    }elseif ($_GET['scr']==3) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
                <p><font color="#3793D2">RM:</font> Thank you for that, we just have one final piece to verify.</p> 
                
                <p>
                    <font color="#3793D2">
                        RM:
                    </font> 
                    I see that you have a [checking / savings] account with [bank name], can you please verify the account number?
                </p>
                
                <div>
                    <i>
                        <p style="margin-left: 50px;">
                            <font color="#828282">
                                Only verify routing numbers if bank name is not listed.
                            </font><br>
                            <font color="#828282" style="margin-left: 50px;">
                                We just want to be sure these digits are typed in correctly so you don’t have to wait for your money.
                            </font>
                        </p>
                    </i>
                </div>
                
                <p>
                    <font color="#F09646">
                        Withdraw payments automatically?:
                    </font>
                    <br>
                    <font color="#3793D2">
                        RM:
                    </font> 
                    And you selected to have payments automatically withdrawn is that correct?
                </p>
                
                <div style="margin-left: 50px;">
                    <p>
                        <font color="#F09646">
                            Applicant - No:
                        </font> 
                        <font color="#828282">
                            <i>
                                (please explain the below, talk honestly to be sure that the borrower understands):
                            </i>
                        </font>
                    </p>
                    <br>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font> 
                        Ok, to make payments you will need to mail them in. Please understand that your payments will be due on the days we discuss and are set in the loan agreement. Spotloan accepts personal checks, cashier’s checks, and money orders. And I will send you an email with payment instructions if you are approved.
                    </p>
                </div>
                <p>
                    <a href="#autodep" data-toggle="collapse">
                        <font color="#F09646">
                            Applicant does not have direct deposit box checked:
                        </font>
                    </a>
                </p>
                <div id="autodep" class="collapse" style="margin-left: 50px;">
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        I see here that you do not receive your income via direct deposit, is that correct?
                    </p>
                    <p>
                        <font color="#3793D2">RM:
                        </font>
                        Ok, I will set your payment dates two days after you get paid so you have time to deposit your check.
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Would that work for you?
                        <br>
                        <font color="#828282">
                            <i>
                                (If you answer "NO" to this question, the system will automatically move the customer’s payment dates back two business days to allow the customer time to deposit checks. If they do not want this you must change your answer, and note that this has been verified by the customer).
                            </i>
                        </font>
                    </p>
                </div> 
                
	        </div>
	        <p>
                <font color="red">
                    <b>
                        Click on Loan Term Tab
                    </b>
                </font>
            </p>
	        <?php
	    }elseif ($_GET['scr']==4) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    So, I have your first payment scheduled for [date] in the amount of [$]. Does that date and amount work for you? 
                </p>
                <p>
                    <font color="#828282">
                        <i>If an applicant is concerned about payment amount –If they are uncomfortable with the payment amount ask them if borrowing a smaller amount will work for their needs, as that will be how they can lower the payment amount.
                        </i>
                    </font>
                </p> 
                <div>
                    <p>
                        <mark style="background-color: yellow;">
                            If you are approved for a loan, your interest rate will be:
                        </mark>
                    </p>
                    <?php
                    include "includes/dbh.inc.php";
                    $q="SELECT * FROM rates";
                    $result= mysqli_query($conn, $q);
                    $numrows= mysqli_num_rows($result);
                    ?>
                    <div class="rate">
                        <table>
                            <?php
                            while($row= mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td class="col-md-2"><b><?php echo $row['desc'];?></b></td>
                                    <td class="text-left col-md-4"><?php echo$row['rate']."%";?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                                
                    </div>
                    <?php
                    $conn->close();
                    ?>
                </div>
                <br>
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    <mark style="background-color: yellow;">
                        The approximate interest charge will be [finance charge]. This is assuming no changes are made to your payment schedule.
                    </mark>
                </p> 
                <p>
                    <font color="#828282">
                        <i>
                            These are estimated based on when we think we will schedule your first payment, this may vary slightly, until we actually generate the actual loan documents, it is not an exact amount. Not obligated to accept the terms.
                        </i>
                    </font>
                </p>
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    If you think you will need to skip or miss a payment, give me a call 2 business days before your payment is due. Missing or deferring a payment will increase your estimated charges because interest accrues on a daily basis.
                </p> 
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    You have the option to pay off early; this will save you money. 
                </p>
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    Do you have any questions?
                </p>
                <p>
                    <font color="#3793D2">
                        RM:
                    </font>
                    Alright, I will process your application now.
                </p> 
                
                
	        </div>
	        <p>
                <font color="red">
                    <b>
                        Click on Scoring Tab
                    </b>
                </font>
            </p>
	        <?php
	    }elseif ($_GET['scr']==5) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
	            <p>
                    Based on the information provided, make an educated guess on the pribability of repayment. Select score for Likelihood of repayment and then 
                    <font color="#3793D2">
                        <i>
                            Click Go Robot Go
                        </i>
                    </font>
                </p>
                <br>
                
	        </div>
	        <p>
                <font color="red">
                    <b>
                        Click on Decision Tab
                    </b>
                </font>
            </p>
	        <?php
	    }elseif ($_GET['scr']==6) {
	        ?>
	        <div style="overflow-y: auto; height:600px;">
                <div class="text-center">
                    <div class="col-md-6">
                        <h3>
                            <a href="#approved2" data-toggle="collapse">
                                <b>
                                    Click here if Approved
                                </b>
                            </a>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <h3>
                            <a href="#denied2" data-toggle="collapse">
                                <b>
                                    Click here if Denied
                                </b>
                            </a>
                        <h3>
                    </div>
                </div>
                <div id="approved2" class="collapse" style="margin-left:15%; margin-right:10%;">
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Ok [applicant name],  congratulations! You have been approved!
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Do you promise to make this regular payment of [$]?
                        <br>
                        <font color="#828282" style="margin-left: 50px;">
                            <i>
                                Check the box!
                            </i>
                        </font>
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        I’ve sent an email with your loan documents. If you decide you want the loan after reviewing your documents, you should receive your funds within 1-2 business days. Clicking ‘yes I accept’ means you have reviewed and electronically agree to your loan terms.
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        You will receive your loan agreement in an email and we encourage you to print a copy for your records.
                    </p>        
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        If you don’t see an email in the next 20 minutes, check your Spam or Junk folder.
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Again my name is <?php echo $SysName;?> and I am your current Relationship Manager. If you have any questions please don’t hesitate to give me a call or send me an email.
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Is there anything else I can help you with today?
                    </p>
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Thanks for choosing Spotloan!
                    </p>
                </div>
                <div id="denied2" class="collapse" style="margin-left:20%; margin-right:20%;">
                    <p>
                        <font color="#3793D2">
                            RM:
                        </font>
                        Unfortunately, we will not be able to offer you a loan today. Due to privacy reasons, I am unable to see why, however you will receive an email with the details included. You are eligible to re-apply after 45 days and thank you for applying with Spotloan. Take Care!
                    </p>
                </div>
                
                <font color="#828282" >
                    <i>
                        <p style="margin-left:10%; margin-right:20%;">
                            Complete your notes.
                        </p>
                        <p style="margin-left:10%; margin-right:20%;">
                            Click “Save & Exit”
                            <br>
                            If the borrower says they never received their approval email, resend the email. If this does not work, try resending to a different email address of theirs (note their old address as well!) Yahoo email takes a little longer to receive our emails, sometimes up to five minutes. After informing them of what they will receive, you can ask them to call you back if they have issues.
                        </p>
                    </i>
                </font>
	        </div>
	        <?php
	    }
	?>
	</div>
</div>
<?php
include 'footer.php';
?>