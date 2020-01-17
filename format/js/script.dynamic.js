//pending payment script
function pendingpmt(){
	var status = document.getElementById('pendingclick').checked;
	var insertform = document.getElementById('pendingForm');
	if(status){
		insertform.innerHTML =
			"<div class='form-group' id='pntdoc'>"
				+"<label for='datepending'>"
					+"Pending Payment Date"
				+"</label>"
				+"<input class='form-control' type='date' id='datepending' name='datepending' required/>"
			+"</div>"
			+"<div class='form-group'>"
				+"<label for='pennextpmtamt'>"
					+"Pending Payment Amount"
				+"</label>"
				+"<input class='form-control' type='number' step='0.01' id='pennextpmtamt' name='pennextpmtamt' required/>"
			+"</div>"
			;
	}else {
		insertform.innerHTML = '<g id="pendingForm"></g>';
	}
}

//next pmt script
function nextpmt(){
	var pmtbody = document.getElementById('pmtnotebody');
	var status = document.getElementById('pmtnote').checked;
	if(!status){
		pmtbody.innerHTML = 
		'<div class="col-md-6">'
			+'<g id="pmtnotebody"></g>'
		+'</div>'
		;
		
	}else {
		pmtbody.innerHTML =
			"<div class='form-group' id='pmtnote'>"
				+"<label for='nextpmtdate'>"
					+"Next Payment Date"
				+"</label>"
				+"<input class='form-control' type='date' id='nextpmtdate' name='nextpmtdate' required/>"
			+"</div>"
			+"<div class='form-group'>"
				+"<label for='nextpmtamt'>"
					+"Next Payment Amount"
				+"</label>"
				+"<input class='form-control' type='number' step='0.01' id='nextpmtamt' name='nextpmtamt' required/>"
			+"</div>"
			;
	}
		
}

//additional note
function addnote(){
	var notebody = document.getElementById('notefield');
	var status = document.getElementById('additional').checked;
	if(status){
		notebody.innerHTML=
		"<div class='form-group' id='notefield'>"
			+"<label for='additionalnote'>"
				+"Additional notes"
			+"</label>"
			+"<textarea name='additionalnote' class='form-control' rows='6' col='6' id='additionalnote'></textarea>"
		+"</div>"	
		;
	}else{
		notebody.innerHTML=
		'<div class="col-md-6">'
			+'<g id="notefield"></g>'
		+'</div>'
		;
	}
}

//payment confirmation

//Mailed Payment notification
function mailed(){
	var formLanding = document.getElementById('landform');
	var status = document.getElementById('mail').checked;
	
	if (status){
		formLanding.innerHTML = 
		'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="pmtdate">'
					+'Payment Date:'
				+'</label>'
				+'<input class="form-control" type="date" name="pmtdate" required/>'
			+'</div>'
			+'<div class="form-group">'
				+'<label for="pmtAmt">'
					+'Payment Amount:'
				+'</label>'
				+'<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>'
			+'</div>'
		+'</div>'
		+'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="mailtype">'
					+'Mailed Payment Type:'
				+'</label>'
				+'<select class="form-control" name="mailtype" id="mailtype" required/>'
					+'<option value="">Select</option>'
					+'<option value="money order">Money Order</option>'
					+'<option value="check">Check</option>'
				+'</select>'
			+'</div>'
		+'</div>'
		;
	}else{
		formLanding.innerHTML = '<div id="landform"></div>';
	}
}

//ACH payment notification
function achpmt(){
	var formLanding = document.getElementById('landform');
	var status = document.getElementById('ach').checked;
	
	if (status){
		formLanding.innerHTML = 
		'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="pmtdate">'
					+'Payment Date:'
				+'</label>'
				+'<input class="form-control" type="date" name="pmtdate" required/>'
			+'</div>'
			+'<div class="form-group">'
				+'<label for="pmtAmt">'
					+'Payment Amount:'
				+'</label>'
				+'<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>'
			+'</div>'
		+'</div>'
		+'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="bankname">'
					+'Bank Name:'
				+'</label>'
				+'<input class="form-control" type="text" name="bankname" required/>'
			+'</div>'
			+'<div class="form-group">'
				+'<label for="lastfour">'
					+'Last 4 Bank Account:'
				+'</label>'
				+'<input class="form-control" type="text" maxlength="4"  name="lastfour" required/>'
			+'</div>'
		+'</div>'
		;
	}else{
		formLanding.innerHTML = '<div id="landform"></div>';
	}
}

//DC payment notification
function dcpmt(){
	var formLanding = document.getElementById('landform');
	var status = document.getElementById('dc').checked;
	
	if (status){
		formLanding.innerHTML = 
		'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="pmtdate">'
					+'Payment Date:'
				+'</label>'
				+'<input class="form-control" type="date" name="pmtdate" required/>'
			+'</div>'
			+'<div class="form-group">'
				+'<label for="pmtAmt">'
					+'Payment Amount:'
				+'</label>'
				+'<input class="form-control" type="number" step="0.01" name="pmtAmt" required/>'
			+'</div>'
		+'</div>'
		+'<div class="col-md-4">'
			+'<div class="form-group">'
				+'<label for="pmtconf">'
					+'DC Payment Confirmation ID:'
				+'</label>'
				+'<input class="form-control" type="text" name="pmtconf" required/>'
			+'</div>'
		+'</div>'
		;
	}else{
		formLanding.innerHTML = '<div id="landform"></div>';
	}
}

//addbox
$(document).ready(function(){
	var maxfields = 60;
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.pmthist'); //Input field wrapper
	var x=1;
	var insetHTML = 
	'<tr>'
	+	'<td><input class="form-control" type="date" name="date[]" id="date[]"></td>'
	+	'<td>'
	+		'<select class="form-control" name="tran_type[]" id="tran_type[]">'
	+			'<option value=""></option>'
	+			'<option value="Deferred Loan Payment">Deferred Loan Payment</option>'
	+			'<option value="Successful Payment">Successful Payment</option>'
	+			'<option value="Failed Payment">Failed Payment</option>'
	+			'<option value="New Loan Draw">New Loan Draw</option>'
	+			'<option value="Return Check Fee">Return Check Fee</option>'
	+		'</select>'
	+	'</td>'
	+	'<td><input class="form-control" type="number" step="0.01" name="amount[]"></td>'
	+	'<td>'
	+	'<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field" style="font-size:16px;color:#b30000"><span class="glyphicon glyphicon-remove-circle" style="font-size:24px;color:#b30000"></span> Remove</a>'
	+	'</td>'
	+'</tr>'
	;
	$(addButton).click(
		function(){
			if(x < maxfields){
				x++;
				$(wrapper).append(insetHTML);
			}	
		}
	);
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
        x--;
        });
});

document.getElementById('percent').onchange=function() {optionOne()};
document.getElementById('balance').onchange=function() {optionOne(); offer()};

function optionOne() {
    var percent = document.getElementById('percent').value;
    var Balance = document.getElementById('balance').value;
    var lump = Balance-(Balance*(percent/100));

    var x = document.getElementById('optOne');
    x.value = lump.toFixed(2);
}

document.getElementById('percent2').onchange=function() {offer()};


function offer() {
    var percent2 = document.getElementById('percent2').value;
    var Balance2 = document.getElementById('balance').value;
    var lump =Balance2-(Balance2*(percent2/100));

    var x = document.getElementById('optTwo');
    x.value = lump.toFixed(2);
}

function enterform(){
	var status, landform, child_in, child_out;
	status = document.getElementById('frst').checked;
	landform = document.getElementById('frst_enter');
	child_in = '<div id="frst_enter"><div class="form-group"><label for="bal">First Payment Amount</label><input class="form-control" step="0.01" type="number" id="frst_pmt" onkeyup="settlement()"></div></div>';
	child_out = '<div id="frst_enter"></div>';
	if(status){
		landform.innerHTML = child_in;
	}else{
		landform.innerHTML = child_out;
	}
}

function settlement_offer(argument) {
	// body...
}

function settlement() {
	
	var stl, bal,disc,pmtnum,pmts, w,x,y,z, pmtcheck, frstcheck;
	//new variables
	var aa, ab, ac, ad, principal, interest;
	//variables
	
	frstcheck = document.getElementById('frst');
    bal = document.getElementById('bal').value;
    disc = document.getElementById('disc').value;
    pmtnum = document.getElementById('pmtnums').value;
    principal = document.getElementById('principal').value;
    interest = bal - principal;
    
    w = document.getElementById('fpmtamt');
    x = document.getElementById('stl0');
    y = document.getElementById('stl');
    z = document.getElementById('pmtnum');
    aa = document.getElementById('interest');
    ab = document.getElementById('outstanding');
    ac = document.getElementById('principalBal');
    ad = document.getElementById('interetBal');
    
    if (frstcheck.checked) {
    	pmtcheck = document.getElementById('frst_pmt').value;
    	pmtnum -= 1;
    	stl = bal-(bal*(disc/100));
    	pmts = (stl-pmtcheck)/pmtnum;
    	w.value = pmtcheck;
    	x.innerHTML = disc+"% Settlement would be in the Amout of $" + stl.toFixed(2)
        +"<br>"
        +"This can be solved with a first payment of $" + pmtcheck + " and " + pmtnum + " payments of $" + pmts.toFixed(2);
        y.value = stl.toFixed(2);
        z.value = pmtnum;
        aa.innerHTML = "<b>Current interest and fees are a total of:</b> $"+interest.toFixed(2);
        ab.value = bal;
        ac.value = principal;
        ad.value = interest;
        
        
    }else{
    	stl =bal-(bal*(disc/100));
        pmts = stl/pmtnum;
        x.innerHTML = disc+"% Settlement would be in the Amout of $" + stl.toFixed(2)
        +"<br>"
        +"This can be solved in " + pmtnum + " payments of $" + pmts.toFixed(2);
        y.value = stl.toFixed(2);
        z.value = pmtnum;
        aa.innerHTML = "<b>Current interest and fees are a total of:</b> $"+interest.toFixed(2);
        ab.value = bal;
        ac.value = principal;
        ad.value = interest;
        
    }
    
    	
}

function pmtSplit(a) {
	var half, third, double, target, dv2, dv3, followups;
	a = Number(a);
	target = document.getElementById('targetresult');
	followups = document.getElementById('followup');
	half = a/2;
	third = a/3;
	double = a*2;
	dv2 = a+half;
	dv3 = a+third;
	
	
	target.innerHTML = "<b>Your Regular Payment is:</b> " + "$" + a.toFixed(2);
	target.innerHTML +="<br>";
	target.innerHTML += "<b>Half a Payment:</b> " + "$" + half.toFixed(2);
	target.innerHTML +="<br>";
	target.innerHTML += "<b>Double Payment:</b> " + "$" + double.toFixed(2);
	target.innerHTML +="<br>";
	target.innerHTML +="<b>Devide by 2:</b>";
	target.innerHTML +="<br>";
	target.innerHTML +="Make up on you next two payments by changing them to " + "$" + dv2.toFixed(2);
	target.innerHTML +="<br>";
	target.innerHTML +="<b>Devide by 3:</b>";
	target.innerHTML +="<br>";
	target.innerHTML += "Make up on you next three payments by changing them to " + "$" + dv3.toFixed(2);
	target.innerHTML +="<br>";
	target.innerHTML +="<b>The borrower was advised that additional will accrue when doing any of these changes.</b>";
	target.innerHTML +="<br>";
	
	followups.innerHTML = "<div>";
	followups.innerHTML += "<br>";
	followups.innerHTML += "<b>Devide by Two Follow up</b>";
	followups.innerHTML += "<br>";
	followups.innerHTML += "Please set up a payment in the amount of $" + dv2.toFixed(2) + " on [Enter date]";
	followups.innerHTML += "</div>";
	followups.innerHTML += "<br>";
	followups.innerHTML += "<br>";
	followups.innerHTML += "<div>";
	followups.innerHTML += "<b>Devide by Thre Follow up</b>";
	followups.innerHTML += "<br>";
	followups.innerHTML += "Please set up a payment in the amount of $" + dv3.toFixed(2) + "on [Enter date] an reset follow to to set another payment for $" + dv3.toFixed(2) + " on [Enter date]";
	followups.innerHTML += "</div>";
}

//sold account payments
function soldpmt(){
	var outputopn, status, landingform, outputcls;
	status = document.getElementById('sldcheck').checked;
	landingform = document.getElementById('sldland');
	if (status) {
		outputopn =
		'<div id="sldland" name="sldland">'
			+'<div class="form-group">'
				+'<label for="pmtdate">'
					+'Last Successful Payment Date:'
				+'</label>'
				+'<input class="form-control" type="date" name="pmtdate"/>'
			+'</div>'
			+'<div class="form-group">'
				+'<label for="pmtAmt">'
				+'Last Successful Payment Amount:'
				+'</label>'
				+'<input class="form-control" type="number" step="0.01" name="pmtAmt"/>'
			+'</div>'
		+'</div>'
		;
		landingform.innerHTML = outputopn;
	}else{
		outputcls = '<div id="sldland" name="sldland"></div>';
		landingform.innerHTML = outputcls;
	}
}

/*Draggable objects*/

//soldlist forms
function SigleRecord(){
	var soldlist_landform, form;
	
}

//
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
//copy

function copyFollowUp(containerid,value){
    if (document.selection){
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");
    }else if(window.getSelection){
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        //alert("The "+value+" has been copied"); 
        var alertHTML = '<div class="alert alert-success" role="alert"><strong>Success!</strong> The '+value+' has been copied</div>';
    	document.getElementById('copy_notify').innerHTML = alertHTML;
    	window.setTimeout(function () {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
	        $(this).remove();
	    });
	}, 3000);
    }
    
}


{
	var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById('user_last').onchange=function() {shortName()};
    

    function shortName() {
        var fName = document.getElementById('user_first').value;
        var lName = document.getElementById('user_last').value;
        var replace = fName + " " + lName.substring(0,1);
        var replaceuid = fName + lName.substring(0,1);
        var email = fName + "." +  lName.substring(0,1) + "@spotloan.com";
        
    
        var x = document.getElementById('user_shortname');
        var y = document.getElementById('user_email');
        var z = document.getElementById('user_uid');
        x.value = replace;
        y.value = email.toLowerCase();
        z.value = replaceuid.toLowerCase();
    }
    document.getElementById('statuscheck').onchange=function() {updatelist()};
    
    function updatelist(){
        var statuscheck = document.getElementById('statuscheck').value
    }
    
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    }); 
}


