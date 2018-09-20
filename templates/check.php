
<?php
// check code

include '../includes/dbh.inc.php';
include '../includes/functions.inc.php';
/*$sql1 = "SELECT MAX(ID) FROM email WHERE catID='2' AND type='rm'";
$sql1init = mysqli_query($conn, $sql1);
$numrows = mysqli_num_rows($sql1init);
if ($numrows > 0) {
   $rows=mysqli_fetch_assoc($sql1init);
   $dbid= implode(" ",$rows);
   $sql2="SELECT * FROM email WHERE ID=$dbid";
   $sql2init = mysqli_query($conn, $sql2);
   $numrows2 = mysqli_num_rows($sql2init);
   if ($numrows2 > 0) {
       $rows2=mysqli_fetch_assoc($sql2init);
       $emid= $rows2['emID']+1;
       echo $emid;
   }
}
$conn->close();*/

//echo restructure("2019-25-05", $pmtnum, "Semi-Monthly");
echo checkday("2018-9-18");