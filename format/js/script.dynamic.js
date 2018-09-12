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
	if(status){
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
	}else {
		pmtbody.innerHTML = 
		'<div class="col-md-6">'
			+'<g id="pmtnotebody"></g>'
		+'</div>'
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

/*Draggable objects*/
