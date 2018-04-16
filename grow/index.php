<!DOCTYPE html>
<html>
<head>
	<title>U+ Grow</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div id="tester" style="width:600px;height:250px;"></div>
	</div>

	<div class="container">
		<div id="plot" style="width:600px;height:250px;"></div>
	</div>

	<div class="container">
		<div id="age_plot" style="width:600px;height:250px;"></div>
	</div>

	
<script type="text/javascript" src="js/plotly-latest.min.js"></script>
<script>
	TESTER = document.getElementById('tester');
	Plotly.plot( TESTER, [{
	x: [1, 2, 3, 4, 5],
	y: [1, 2, 4, 8, 16] }], {
	margin: { t: 0 } } );


	function makeplot() {
	  Plotly.d3.csv("data/i2i_cleaned.csv", function(data){ processData(data) } );

	};

	function processData(allRows) {

	  // console.log(allRows);
	  var x = [], y = [], standard_deviation = [], age = [], age_dt = {x:[], y:[]};

	  var pop_count = 0; //number of sample

	  for (var i=0; i<allRows.length; i++) {
	    row = allRows[i];
	    x.push( row['AAPL_x'] );
	    y.push( row['AAPL_y'] );

	    if(age[row['age']]){
	    	age[row['age']] = age[row['age']]+1
	    }else{
	    	age[row['age']] = 1
	    }

	    t1 = 0;
	    for (age_elem in age){
	    	age_dt['x'][t1] = age_elem
	    	age_dt['y'][t1] = (i/age[age_elem])*100
	    	t1++;
	    }
	  
	  }
	  // console.log(age_dt)


	  agePlot(age_dt)

	  //Finding age percentage
	  age_percentage = {};


	  // console.log( 'age', age );
	  // makePlotly( x, y, standard_deviation );
	}


	function agePlot(age_plot){
		//plotting the age and saving
		console.log(age_plot)

		var plotDiv = document.getElementById("age_plot");

		var traces = [{
		    x: age_plot.x,
		    y: age_plot.y
		  }];

		Plotly.newPlot('plot', traces,
		{title: 'Age and saving propotion'});

	}

	function makePlotly( x, y, standard_deviation ){
	  var plotDiv = document.getElementById("plot");
	  var traces = [{
	    x: x,
	    y: y
	  }];

	  Plotly.newPlot('plot', traces,
	    {title: 'Age and saving propotion'});
	};

	makeplot();
</script>
</body>
</html>