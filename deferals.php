<?php
$page_name = "Deferrals";
include 'header.php';
?>
<div class="jumbotron">
    <ul class="nav nav-tabs nav-justified">  
        <li class="active"><a data-toggle="tab" href="#s1">Fist Deferral Request</a></li>
        <li><a data-toggle="tab" href="#s2">Third or Beyond Deferral</a></li>  
        <li><a data-toggle="tab" href="#s3">Partial Payment</a></li>
    </ul>
    
    <!-- Scripts -->
    <div class="tab-content">
        <br>
        <img class="script" src="format/img/logo.png" alt="Spotloan Logo" style="margin-left: 250;" Width="500" height="150">
        <div id="s1" class="tab-pane fade in active" >
            <div>
                <h2 class="text-center" style="color: #3793D2;">First (Early) Payment Deferral Request</h2>
                <div style="overflow: auto; height: 615px;">
                    <p>
                        <font color="#3793D2">Borrower:</font> I can't make this first payment.
                    </p> 
                    
                    <p>
                        <font color="#E6B800">RM:</font> Ok, would you be able to make a partial or interest only payment
                    </p>
                    
                    <p>
                        <font color="#3793D2">If Borrower Says:</font> Yes.
                        <br style="text-indent: 25px;">
                        (Proceed to <a href="#s3">Script 3</a>)
                    </p>
                    
                    <p>
                        <font color="#3793D2">Borrower:</font> I am not able to at this time.
                    </p>
                    
                    <p>
                        <font color="#E6B800">RM:</font> Ok, I would be happy to help you out! We have a couple options for you to keep your loan on track. The first option would be to restructure your payment schedule to accommodate for this adjustment. This will increase your payment amount but save you in interest in comparison to a deferral. This new payment amount would be <b>(Use restructure option)</b> and makes your last payment occur on <mark>[date]</mark> instead of <mark>[date]</mark>. Does that work for you?
                    </p>
                    
                    <p>
                        <font color="#E6B800">RM:</font> We do have the option to defer this payment which means you will add about (<b>$ use deferral calculator amount</b>) worth of interest to your loan. This will result in additional payments beyond your current final payment date.  Right now you're set up for a [Duration of the Loan] month term, but this will increase if you choose to defer this payment.
                    </p>
                    
                    <mark><font color="#3793D2">If they choose to defer:</font></mark>  
                    <p><font color="#E6B800">RM:</font> Ok, I am happy to defer your payment. Just to confirm, you will potentially add [$ approximate interest] to your loan but the faster you make up your payment, the less interest you will have to pay back. So if you wait until the end of your loan to make up your payment, you will have to pay the full interest charge of [$] spread out through additional payments. If you make up your payment sooner, this will decrease the interest charged to you, reducing the number of extra payments and overall balance.</p>  
                    
                    <mark><i>Example Explanation - Tell the borrower these are example numbers:</i></mark>
                    <div style="margin-left: 30px;">
                        <p><mark style="background-color:#40E0D0;"><font color="#E6B800">RM:</font>Let’s say deferring your payment will add $400 in interest, thats only if you wait until the end of your loan to make-up that payment. If you were to take care of the missed payment one month from now then you would only add $100 in interest. Because interest increases on a daily basis, it really matters when you make up the missed payment.</mark></p>
                    </div>
                    
                    <p><font color="#E6B800">RM:</font> If you cannot make up the missed payment all at once, I would encourage you to make smaller payments which will help to decrease the interest added from deferring.</p> 
                    
                    <p><font color="#E6B800">RM:</font> Are you still certain you are unable to make any kind of a payment? I just want to be sure you know all of your options. If yes, how much? (move to <a href="#s3">section 3</a>)</p>
                    
                    <p><font color="#3793D2">Borrower:</font> I just cannot pay anything right now…</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok, I understand that sometimes these things happen I just wanted to explain everything to make sure you have all the information. Do you still want to defer your payment?</p> 
                    
                    <p>
                        If you have not confirmed the potential amount added:<br>
                        <div style="margin-left:50px;"> 
                            <p>
                                <font color="#E6B800">RM:</font> Alright, I have deferred this payment due on (day, date). It has added approximately (deferral calculator amount$) to your loan, again you are not locked into this exact amount. Depending on when you make up the payment, this number could change.
                            </p>
                        </div>      
                    </p>
                    
                    <p><font color="#E6B800">RM:</font> Would you like to set something up before your next payment (STATE NEXT PAYMENT DATE)  or increase your amount for future payments to help with the interest? </p>
                    
                    <p><font color="#3793D2">Borrower:</font> Yes </p>
                    
                    <p><font color="#E6B800">RM:</font> Great!</p>
                    <p>
                        <ul style="margin-left: 15px;">
                            <li>
                                <p>Set up the SP as requested</p>
                            </li>
                            <li>
                                <p>Or discuss restructuring the loan payment to something they feel comfortable with, starting on their next payment date.</p>
                            </li> 
                            <li>
                                <p>
                                    Please note: <mark>If you restructure a borrower’s loan, they must agree to the new payment amount before a payment can be taken in the new amount.</mark>
                                </p>
                            </li>
                        </ul>
                    </p>
                    
                    <p><font color="#3793D2">Borrower:</font> NO</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok, I understand. Please let me know if anything changes in the future. </p>
                    
                    <p><font color="#E6B800">RM:</font> I will send you an email confirmation of our conversation, and thank you for reaching out today! </p>
                    
                    <p><font color="#E6B800">RM:</font> Do you have any other questions for me? </p>
                    
                    <p><font color="#E6B800">RM:</font> It was a pleasure working with you today and thank you for calling Spotloan. Take care!</p>
                </div>
            </div>  
        </div>
        <div id="s2" class="tab-pane fade">
            <div>
                <h2 class="text-center" style="color: #3793D2;">Third or Beyond Payment Deferral Request</h2>
                
                <div style="overflow: auto; height: 615px;">
                    <p><font color="#3793D2">Borrower:</font> I can’t make this upcoming payment; I need to skip this next payment (for any reason)</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok, thanks for giving me a call to help you with this payment change, happy to help!</p>
                    <ul style="margin-left: 15px;">
                    <li><p>Check the payment schedule to see if they have deferred payments in the past – this can help you direct the conversation towards a first time defer or a repeat defer customer.</p></li>
                    </ul> 
                    
                    <p><font color="#E6B800">RM:</font> If you defer this payment now, it will cost you more than what was originally discussed when you accepted the loan.</p>  
                    
                    <p><font color="#E6B800">RM:</font> Do you want to proceed? </p>
                    
                    <p><font color="#E6B800">RM:</font> I would encourage you to consider at least making a partial payment to help. The reason is that if we skip a payment, you will have to make up the payment later on plus additional interest. This will extend the life of your loan even further out than where it is now, due to the previous deferral(s) / missed payment(s).</p>
                    <ul style="margin-left: 15px;">
                    <li><p><font color="#3793D2">If needed - explanation below:</font></li>
                    <li><p><font color="#E6B800">RM:</font> When that happens, additional interest will begin to add on as your principal balance will be higher than originally expected at this point in your loan, thus you will ultimately pay more interest and have the loan longer than originally expected.</li>
                    </ul>
                    </p>
                    
                    <p><font color="#E6B800">RM:</font> Would you like to proceed or would you be able to make a partial payment?</p>
                    
                    <p><font color="#3793D2">Borrower:</font> I would like to defer/skip the payment.</p>
                    
                    <p><font color="#E6B800">RM:</font> Alright, by deferring this payment on (date of payment) approximately ($amount) will be added to your loan. 
                    
                    <p><font color="#E6B800">RM:</font> Does that work for you?
                    
                    <p><font color="#3793D2">Borrower:</font> NO</p>
                    
                    <p style="margin-left: 15px;"><font color="#E6B800">RM:</font> <font color="grey"><i>Tips for the conversation:</i></font> explain again, different wording</p>
                    <ul style="margin-left: 15px;">
                    <li><p>You have to make up the payment and the longer you wait to make that payment up, the more interest you will end up paying.</li>
                    <li><p>If you don’t make up the payment by (Original Loan Terms Final Payment date) then your repayment schedule will change.</li>
                    </ul>
                    </p>
                    
                    <p><font color="#3793D2">Borrower:</font> Yes</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok, Your next payment will be due on (next payment date) in the amount of (payment amount).</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok, would you like to go ahead and schedule a make up for this deferred payment?</p>
                    
                    <p><font color="#3793D2">Borrower:</font> Yes</p>
                    
                    <p><font color="#E6B800">RM:</font> Excellent, this will help reduce interest added, so I have scheduled a payment for (amount) on (date).</br> 
                    <font color="#3793D2">Borrower:</font> NO<br>
                    <font color="#E6B800">RM:</font> Ok, I understand. Please let me know if anything changes in the future.</p>
                    
                    <p><font color="#E6B800">RM:</font> I will send you an email confirmation of our conversation, and thank you for reaching out today!</p> 
                    
                    <p><font color="#E6B800">RM:</font> Do you have any other questions for me? </p>
                    
                    <p>It was a pleasure working with you today and thank you for calling Spotloan. Take care!</p>
                </div>
            </div>   
        </div>
        
        <div id="s3" class="tab-pane fade">
            <div>
                <h2 class="text-center" style="color: #3793D2;">Customer Pays a Smaller Amount - Way to Go!</h2>
                
                <div style="overflow: auto; height: 615px;">
                    <p><font color="#3793D2">Borrower:</font> I would like to pay a smaller amount.</p>
                    
                    <p><font color="#E6B800">RM:</font> Ok! How much would you be able to afford on this payment date?</p> 
                    
                    <p><font color="#3793D2">Borrower:</font> Amount</p>
                    
                    <p><font color="#E6B800">RM:</font> Great, I will set up a payment for ($) that will be due on (date).<br>
                    <font color="#E6B800">RM:</font> Does this work for you?<br>
                    <font color="#3793D2">Borrower:</font> Yes (we need them to agree to this verbally).<br> 
                    <font color="red" style="margin-left: 25px;">Action:</font> special payment and payment deferral</p>
                    
                    <p><font color="#E6B800">RM:</font> Also, would you like to set up a date to make up the remainder of the payment? <br>
                    <font color="#3793D2">Borrower:</font> Yes <font color="grey"><i>(Discuss an appropriate date that works for the borrower and get a hard yes of approval before confirming the action).</i></font></p>
                    
                    <p><font color="#3793D2">Borrower:</font> No<br>
                    <font color="#E6B800">RM:</font> Ok, I understand. Just keep in mind, it will really help you out if you can give me a call and make up the remainder.</p>
                    
                    <p><font color="#E6B800">RM:</font> Do you have any questions?</p>
                    
                    <p><font color="#E6B800">RM:</font> It was a pleasure working with you today and thank you for calling Spotloan. Take care!</p>
                </div>
            </div>
        </div>
    
    </div>
</div>
<?php
include 'footer.php';
?>