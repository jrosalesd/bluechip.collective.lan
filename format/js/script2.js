</</ JavaScript Document


function checkTime(i) {
    if (i  10) {
      i = "0" + i;
    }
    return i;
}   

function getUTCTime() {
    var d = new Date();
    var localTime = d.getTime();
    var localOffset = d.getTimezoneOffset() * 60000;
    var utc = localTime + localOffset;
    
    return utc;
}
function hawaiiTime(){
    var utc = getUTCTime();
    var offSet = (-10)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var hawaiiWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
        
    document.getElementById("hawaiiWriteTimes").innerHTML = hawaiiWriteTime;
    var t = setTimeout(hawaiiTime, 500);
    
}

function alaskaTime(){
    var utc = getUTCTime();
    var offSet = (-8)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"            
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var alaskaWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
    
    document.getElementById("alaskaWriteTimes").innerHTML = alaskaWriteTime; 
        
    var t = setTimeout(alaskaTime, 500);
    
}
function pacificTime(){
    var utc = getUTCTime();
    var offSet = (-7)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"            
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var pacificWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
    
    document.getElementById("pacificWriteTimes").innerHTML = pacificWriteTime; 
        
    var t = setTimeout(pacificTime, 500);
    
}

function mountainTime(){
    var utc = getUTCTime();
    var offSet = (-6)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"            
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var mountainWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
    
    document.getElementById("mountainWriteTimes").innerHTML = mountainWriteTime; 
        
    var t = setTimeout(mountainTime, 500);
    
}

function centralTime(){
    var utc = getUTCTime();
    var offSet = (-5)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"            
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var centralWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
    
    document.getElementById("centralWriteTimes").innerHTML = centralWriteTime; 
        
    var t = setTimeout(centralTime, 500);
    
} 

function easternTime(){
    var utc = getUTCTime();
    var offSet = (-4)*60*60*1000;
    var d = new Date(utc + offSet);
    var date = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var h = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    date = checkTime(date);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
    var monthN = months[month] 
    var dn = "AM"            
    if (h>12){
      dn = "PM"
      h = h-12
    }    
    if (h==0){
      h=12
    }
    var easternWriteTime = monthN + ", " + date + " " + year + " || " + h+":" + m + ":" + s + " " + dn;
    
    document.getElementById("easternWriteTimes").innerHTML = easternWriteTime; 
        
    var t = setTimeout(easternTime, 500);
    
}

function startTime() {
    hawaiiTime();
    alaskaTime();
    pacificTime();
    mountainTime();
    centralTime();
    easternTime();
}
