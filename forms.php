<?php
$page_name = "Forms";
include 'header.php';
?>
<div class="jumbotron">
	<div class="row">
	    <div class="col-md-3"><button id="acctact" type="button" class="btn btn-warning" onclick="display(this.id)">Account Actions</button></div>
	    <div class="col-md-3"><button id="leaves" type="button" class="btn btn-warning" onclick="display(this.id)">Leaves</button></div>
	    <div class="col-md-3"><button id="relcalls" type="button" class="btn btn-warning" onclick="display(this.id)">Released Calls</button></div>
	    <div class="col-md-3"><button id="feedback" type="button" class="btn btn-warning" onclick="display(this.id)">Feedback</button></div>
	</div>
</div>
<div id="formland"></div>

<?php
include 'footer.php';
?>