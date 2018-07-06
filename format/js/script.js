// JavaScript Document
function calc(){
       var principal = Number(document.getElementById('principal').value);
       var rate = Number(document.getElementById('rate').value);
       var note = "Your approximate daily interest accrual is: $";
       var note2 = "Until you next payment you will accrue approximately $";
       var interest = note+ Number(principal*(rate/100)/365).toFixed(2);
       var day =  document.getElementById('days').value;
       var msec1 = Date.parse(day);
       var mssec2 = Date.parse(new Date());
       var dtnp = Math.round((msec1 - mssec2) / 86400000)+1;
       var interest2 = note2 +  Number((principal*(rate/100)/365) * dtnp).toFixed(2);
       
                
         document.getElementById("demo").innerHTML = interest;
         document.getElementById("demo0").innerHTML = interest2;
}



function todayForCc() {
      var d =new Date();
      var pmt = document.getElementById("123Pay").value;
      var pmtPrnt = Number(pmt).toFixed(2);
      var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
      var month = d.getMonth();
      var monthName = months[month];
      var date = d.getDate();
      var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      var day = d.getDay();
      var dayName = days[day];
      var year = d.getFullYear();
      date = checkTime(date);
      var dateFormat = " today, " +  monthName + " " + date + ", " + year;
      var write = "By providing me with your debit/credit card information, you represent that you are the owener of the debit/credit card and you authorize Spotloan to electronically process a onetime debit/credit card payment in the amount of $" +  pmtPrnt + dateFormat +  ". Do you undestand and agree with this statement?";
      
      document.getElementById("scriptWrite").innerHTML = write;
}       



function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
}
    
$(document).ready(function() {
    setInterval(localtime, 30000);
});
function localtime() {
    $.ajax({
        url: 'includes/time.php',
        success: function(data) {
            $('#today').html(data);
        },
    });
}

function txtMemo(){
 var cid = document.getElementById("cid").value;
 var r = document.getElementById("reason").value;
 var i = document.getElementById("info").value;
 var a = document.getElementById("action").value;
 var outCome = "CID: " + cid + "<br><br>"               
               + r + ".<br>"
               + i +".<br>"
               + a + ".";
  document.getElementById("riaOutcome").innerHTML = outCome;
}
function clearnotearea(){
    document.getElementById("riaOutcome").innerHTML = ""
}


function dstChange(){
    var d = new Date();
    var y = d.getFullYear();
    var d1 = new Date(y,2,1);
    var d2 = new Date(y,10,1);
    var dst;
    if (d>= (d1 + 14 - (d1.getDay())-1) && d< (d2 + 7 - (d2.getDay())-1)) {
        dst = 1;
    } else {
        dst = 0;    
    }
    
    return dst;
    
}

/*
function workingDaysBetweenDates() {
    var d0= new Date();
    var d1= document.getElementById()
	var holidays = ['2016-05-03','2016-05-05'];
    var startDate = parseDate(d0);
    var endDate = parseDate(d1);  
     Validate input
    if (endDate < startDate) {
        return 0;
    }
     Calculate days between dates
    var millisecondsPerDay = 86400 * 1000; // Day in milliseconds
    startDate.setHours(0,0,0,1);  // Start just after midnight
    endDate.setHours(23,59,59,999);  // End just before midnight
    var diff = endDate - startDate;  // Milliseconds between datetime objects    
    var days = Math.ceil(diff / millisecondsPerDay);
    
    // Subtract two weekend days for every week in between
    var weeks = Math.floor(days / 7);
    days -= weeks * 2;

    // Handle special cases
    var startDay = startDate.getDay();
    var endDay = endDate.getDay();
    
    // Remove weekend not previously removed.   
    if (startDay - endDay > 1) {
        days -= 2;
    }
    // Remove start day if span starts on Sunday but ends before Saturday
    if (startDay == 0 && endDay != 6) {
        days--;  
    }
    // Remove end day if span ends on Saturday but starts after Sunday
    if (endDay == 6 && startDay != 0) {
        days--;
    }
    /* Here is the code 
    for (var i in holidays) {
      if ((holidays[i] >= d0) && (holidays[i] <= d1)) {
      	days--;
      }
    }
    return days;
    */