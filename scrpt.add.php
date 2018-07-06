<?php
include 'header.php';
?>
<div class="jumbotron">
	<div class="row">
        <div class="col-md-3">
            <h2 Class="text-center"><font color="#3793D2">Additional Scripts</font></h2>
        </div>
        
        <div class="col-md-9" style="border-left: solid; overflow: auto; height: 650px;">
            
            <h3 style="text-indent:-10px;"><b>Customer call ins to change his banking account and is already imported to LA PRO.</b></h3>
            
            <h4><font color="#F09646">Scripting</font></h4>
            <p style="text-indent:20px;">“If you would like to change the bank account that the loan is deposited into, we need to cancel the original loan and complete a new application. Canceling the loan and recording it in our system can take up to a day, so I will set a time to call you tomorrow to complete the new loan application. Please keep in mind, this does not mean that you will be automatically approved for another loan. Your banking information is a part of how the decision is made. Would you like to proceed?”</p>
            
            <h4><font color="#F09646"><upper>RM ACTION:</upper></font></h4>
            <p style="text-indent:20px;">Send an email from the borrower?s servicing page from the internal option „Send to Servicing?, stating "delete this loan in ACHWorks". <b><u>This must be done by 6:00pm CT on the same day of the application.</u></b> Set a follow-up message in the</p>
            
            
            <hr>
            <h3 style="text-indent:-10px;"><b>When an application has been imported into LA Pro, bank account information is incorrect, borrower stating they did not receive funds.</b></h3>
            
            <h4><font color="#F09646">Scripting</font></h4>
            <p style="text-indent:20px;">"Once the loan is returned to us by your bank which can take 2-7 business days, you are welcome to reapply using the new account information. Keep in mind, this does not mean that you will be automatically approved for another loan. Your banking information is a part of how the decision is made. Would you like to proceed with this?”</p>
            
            <h4><font color="#F09646"><upper>RM ACTION:</upper></font></h4>
            <p style="text-indent:20px;">Set a follow up in the borrower's servicing page to verify that the loan has been returned and the loan status is „canceled?. (A loan, once we know that the deposit has failed - will become "canceled") On average, this takes 2 - 3 business days to be returned from the borrower's bank. Contact the borrower to notify them that their loan was canceled, and proceed with a new application, if desired.</p>
            
            
            <hr>
            <h3 style="text-indent:-10px;"><b>Funds are sent, bank account information verified to be correct, but borrower states that they did not receive them.</b></h3>
            
            <h4><font color="#F09646">Scripting</font></h4>
            <p style="text-indent:20px;">"I am sorry there are difficulties with the loan deposit. I will need to transfer your call to our Credit Service Manager, and they will be able to assist you. Would you hold a moment please?" If a credit service manager isn’t available state: "Our Credit Service Manager is currently assisting other borrowers, and they will get back to you as soon as possible".</p>
            
            <h4><font color="#F09646"><upper>RM ACTION:</upper></font></h4>
            <p style="text-indent:20px;">Transfer the caller to a Credit Service Manager. If one is not available send an email to account.inquiry@spotloan.com, detailing the situation. Be sure to include the URL or loan ID number of the account.</p>
            
            
            <hr>
            <h3 style="text-indent:-10px;"><b>If the loan is re-decisioned (warrants additional investigation) after the approval, it will be deleted in the ACH Provider portal.</b></h3>
            
            <h4><font color="#F09646">Scripting</font></h4>
            <p style="text-indent:20px;">"During a final review by our credit team, they decided that your application requires additional documentation. I need you to send a voided check from the checking account you listed in your application to:
            
            <p style="text-indent:20px;"><b><u>Spotloan, P.O. Box 927 Palatine, IL 60078-0927</u></b><br>
            
            <p style="text-indent:20px;">"We need to receive your voided check within 5 business days from today, and it may take us up to a week to review your documentation and make a final decision. If we don't receive the required documentation, we will consider your application to be incomplete and you will need to reapply to obtain a Spot loan"
            
            <p style="text-indent:20px;">If they ask why additional documentation is needed, the RM can honestly say that they don't know -- they're just reading a message that is on the applicant's account.</p>
            
            <h4><font color="#F09646"><upper>RM ACTION:</upper></font></h4>
            <p style="text-indent:20px;">Servicing will send you an email to request this documentation from the customer. Call the customer to inform them of the requirements.</p>
            
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>