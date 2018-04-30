<?php
if (isset($_GET['sourceId'])) 
{
	if($_GET['sourceId']== 1){
?>
<!--Results of source 1-->
		<a href="#" class="list-group-item">Car</a>
		<a href="#" class="list-group-item">House</a>
		<a href="#" class="list-group-item">Land</a>
<?php
	}
	elseif ($_GET['sourceId']== 2) {
		?>
		<a href="javascript:void()" onclick="callDetails(1)" id="record1" class="list-group-item">Master's Degree</a>
		<a href="javascript:void()" onclick="callDetails(2)" id="record2"  class="list-group-item">Bachaloret Degree</a>
		<a href="javascript:void()" onclick="callDetails(3)" id="record3"  class="list-group-item">A'level Diploma</a>
		<a href="javascript:void()" onclick="callDetails(4)" id="record4"  class="list-group-item">O'level Diploma</a>
		<a href="#" class="list-group-item">Primary Diploma</a>
		<a href="#" class="list-group-item">Nursary Diploma</a>
		<div class="input-group">
			<div class="input-group-addon">25/REB/</div>
			<input type="text" class="form-control" placeholder="Education Handle Id here!">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button">Claim!</button>
			</span>
		</div>
<?php
	}
	elseif ($_GET['sourceId']== 3) {
?>
<a href="#" class="list-group-item">No criminal record yet.</a>
<?php	
	}elseif ($_GET['sourceId']== 5) {
?>
<a href="#" class="list-group-item">Wife</a>
<a href="#" class="list-group-item">KidA</a>
<a href="#" class="list-group-item">Kid2</a>
<a href="#" class="list-group-item">Parent1</a>
<a href="#" class="list-group-item">Parent2</a>
<?php	
	}else{
		# code...
	}

}
elseif (isset($_GET['recordId'])) {
		if($_GET['recordId']== 1){
?>
<!--Results of record 1-->
		Information Regarding that and this should be here
<?php
	}
	elseif ($_GET['recordId']== 2) {
		?>
		Information Regarding this
<?php
}
}
?>
