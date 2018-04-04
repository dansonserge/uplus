<!DOCTYPE html>
<html>
<head>
	<title>SMS Report</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div>
		<div style="height: 150px;">
			<img src="https://uplus.rw/frontassets/img/logo_main_3.png" class="logo" alt="" width="140" style="float: right; padding-top: 10px">
		</div>
	<div class="row">
	    <div class="col-sm">
	      	Customer: Africa Smart Investment Distribution<br> 
			Customer No.: 585667132510
	    </div>
	    <div class="col-sm">
	      <h5>SENT MESSAGE REPORT<h5>
	    </div>
	    <div class="col-sm">
	      	UPLUS MUTUAL PARTNERS LTD.<br>
			Address: 6th Floor, Telcom House, Kacyiru<br>
			Tel.: +(250) 784848236, +(250) 785054743<br>
			TIN: 106774687
	    </div>
	 </div>

	<table class="table table-sm table-bordered">
		<tbody>
			<tr>
				<td width="16%" class="table-active">From</td>
				<td width="16%">ASI-D</td>
				<td width="16%" class="table-active">Created</td>
				<td width="18%">29 Mar 2018 03:22PM</td>
				<td width="16%" class="table-active">Total</td>
				<td width="18%">SMS's 37,852</td>
			</tr>
			<tr>
				<td width="16%" class="table-active">Unit Cost</td>
				<td width="16%">8 RWF</td>
				<td width="16%" class="table-active">Total Cost</td>
				<td width="18%">302,816 RWF</td>
				<td width="16%" class="table-active"></td>
				<td width="18%"></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-bordered">
		<thead>
			<tr>
				<th class="table-primary">Message</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>
						Muraho, ASI-D irabamenyesha ko mugiye gushyirwa kurutonde rw'abatishyura muri Credit Reference Bureau (CRB) kubera umwenda wa Mudasobwa
						ya POSITIVO BGH mufite, kandi ukaba umaze kwibutswa inshuro 3 utagira icyo ubikoraho. Bityo ukaba utazahabwa service mu bigo by'imari na za
						Banki mu Rwanda. Niba waramaze kwishyura, wahamagara kuri 0783873884; 0783785168 cg ukaza aho dukorera ku Gishushu, Tele 10, etaji ya 4
						kugira ngo ukurwe k'urutonde rw'abishyuzwa. Kwishyura bigomba gukorwa bitarenze taliki ya 31/03/2018 kuri compte yacu iri muri BPR:
						593412493610179 cyangwa muri BK: 00258-07723973-03. Murakoze
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-bordered">
		<thead>
				<tr class="table-primary">
					<th>No.</th>
					<th>Phone No.</th>
					<th>Created</th>
					<th>Status</th>
				</tr>
		</thead>
		<tbody>
		<?php
			include 'db.php';

			$sql = $db->query("SELECT * FROM smsreport WHERE status = 'Unsent'");
			$n=0;
			$data= array();
			while ($row = mysqli_fetch_array($sql)) 
			{
				$n++;
				echo "<tr><td>".$n."</td><td>".$row['phone']."</td><td>".$row['created']."</td><td>".$row['status']."</td></tr>";
				
			}
			
		?>
		</tbody>
	</table>
</div>
</body>
</html>
