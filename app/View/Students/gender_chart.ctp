<h1>Student Age/Gender Pie Chart</h1>
<script type="text/javascript">
	google.load("visualization", "1.1", {packages:["table"]});
	google.load('visualization', '1.1', {packages: ['controls']});
	google.setOnLoadCallback(drawChart);
    function drawChart() {
        <?php echo "var raw_data = " . json_encode ( $table ) . ";\n"; ?>
        var data = new google.visualization.DataTable(raw_data);
        var dt_rows = data.getNumberOfRows();
        
        // Create a category filter, passing some options
        var categoryPicker1 = new google.visualization.ControlWrapper({
          'controlType' : 'CategoryFilter',
          'containerId': 'control1',
          'options': {
            'filterColumnLabel': 'Gender'
          }
        });

        var categoryPicker2 = new google.visualization.ControlWrapper({
            'controlType' : 'CategoryFilter',
            'containerId': 'control2',
            'options': {
              'filterColumnLabel': 'Age Range'
            }
          });
        
        // Create a pie chart, passing some options
        var combo = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div',
          'options': {
        	'title': 'Gender/Age Distribution',  
            'width': 600,
            'height': 600,
            'pieSliceText': 'value',
            'legend': 'right'
          },
        'view': {'columns':[0,3]}
        });

        //add event handler to draw table
    	google.visualization.events.addListener(combo, 'ready', function() {
    		draw_table(combo.getDataTable());
    	});

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));
    	
        // Establish dependencies
        dashboard.bind(categoryPicker1, categoryPicker2);
        dashboard.bind([categoryPicker1, categoryPicker2], combo);

        // Draw the dashboard.
        dashboard.draw(data);
      }

      function draw_table (data) {
        var display = new google.visualization.DataView (data);
        display.hideColumns([0]);
        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(display, {'showRowNumber': true,'page':'enable','pageSize': 25  });
      }
</script>
<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist" id="dashboardTab">
		<li role="presentation" class="active"><a href="#home"
			aria-controls="home" role="tab" data-toggle="tab">Chart</a></li>
		<li role="presentation"><a href="#data" role="tab" data-toggle="tab">Data</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<div id="dashboard_div">
			<table><tr><td>
				<!--Divs that will hold each control and chart-->
				<div id="control1" style="width: 250px"></div>
				<div id="control2" style="width: 250px"></div>
				</td><td>
				<div id="chart_div"></div>
				</td></tr>
			</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="data">
			<div id="table_div"></div>
		</div>

	</div>

</div>




