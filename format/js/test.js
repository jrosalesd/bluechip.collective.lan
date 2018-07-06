</</ JavaScript Document

 function nthWeekdayOfMonth(weekday, n, date) {
  var date = new Date(date.getFullYear(), date.getMonth(), 1),
      add = (weekday - date.getDay() + 7) % 7 + (n - 1) * 7;
  date.setDate(1 + add);
  return date;
}
function firstSundayMarch(){
      var date = new Date();
      var suday = nthWeekdayOfMonth(0, 2, new Date(date.getFullYear, 2));
      
      document.getElementById("day1").innerHTML = sunday;
}
