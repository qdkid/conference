<h1>Student Enrollment Chart</h1>
<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist" id="dashboardTab">
		<li role="presentation" class="active"><a href="#home"
			aria-controls="home" role="tab" data-toggle="tab">Chart</a></li>
		<li role="presentation"><a href="#data" role="tab" data-toggle="tab">Data</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<p>&nbsp;</p>
			<div id="dashboard_div">
			<table><tr><td>
								<?php
		echo $this->Form->input ( 'term', array (
				'empty' => "-- Choose Term --",
				'options' => $terms,
				'id' => 'term_dropdown' 
		) );
		?>
				<!--Divs that will hold each control and chart-->
				<div id="control1" style="width: 250px"></div>
				<div id="control2" style="width: 250px"></div>
				<div id="control3" style="width: 250px"></div>
				<div id="control4" style="width: 250px"></div>
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
<script type="text/javascript">
	google.load("visualization", "1.1", {packages:["table"]});
	google.load('visualization', '1.1', {packages: ['controls']});
	
    function drawChart(response) {
        var data = new google.visualization.DataTable(response);
        var dt_rows = data.getNumberOfRows();
        
        // Create a category filter, passing some options
        var categoryPicker1 = new google.visualization.ControlWrapper({
          'controlType' : 'CategoryFilter',
          'containerId': 'control1',
          'options': {
            'filterColumnLabel': 'Course Code'
          }
        });

        var categoryPicker2 = new google.visualization.ControlWrapper({
            'controlType' : 'CategoryFilter',
            'containerId': 'control2',
            'options': {
              'filterColumnLabel': 'Teacher'
            }
          });
        
      	var categoryPicker3 = new google.visualization.ControlWrapper({
    		'controlType' : 'NumberRangeFilter',
    		'containerId' : 'control3',
    		'options' : {
    			'filterColumnLabel' : 'Reg Ratio',
     			'ui' : {
    				format : {
    					fractionDigits : 0,
    					pattern : '#',
    					suffix : '%'
    				}
    			}
    		}
    	});

 
    	var categoryPicker4 = new google.visualization.ControlWrapper({
    		'controlType' : 'NumberRangeFilter',
    		'containerId' : 'control4',
    		'options' : {
    			'filterColumnLabel' : 'Drop Ratio',
    			'ui' : {
    				format : {
    					fractionDigits : 0,
    					pattern : '#',
    					suffix : '%'
    				}
    			}
    		}
    	});
        
        // Create a pie chart, passing some options
        var width =800;
		combo = new google.visualization.ChartWrapper({
			'chartType' : 'ComboChart',
			'containerId' : 'chart_div',
			'options' : {
				title : '',
				titleTextStyle : {
					alignment : 'center'
				},
				hAxis : {
					title : "",
					textStyle : {
						fontSize : '10'
					},
					slantedText : true,
					slantedTextAngle : 90
				},
				vAxes : {
					0 : {
						format : '#,###',
						title : 'Student Count',
						viewWindow : {
							min : 0
						},
						gridlines:{count:11}
					},
					1 : {
						format : '#',
						title : 'Ratio (%)',
						viewWindow : {
							min : 0,
						},
						gridlines:{count:11}
					}
				},
				legend : {
					position : 'top',
					textStyle : {
						'fontSize' : 10
					},
					alignment : 'center'
				},
				seriesType : "bars",
				series : {
					0 : {
						type : "bar",
						targetAxisIndex : 0
					},
					1 : {
						type : "bar",
						targetAxisIndex : 0
					},
	
					2 : {
						type : "line",
						curveType : 'function',
						pointSize : 5,
						targetAxisIndex : 1
					},
					3 : {
						type : "line",
						curveType : 'function',
						pointSize : 5,
						targetAxisIndex : 1
					},
				},
				isStacked : true,
				width : width,
				height : 600,
				tooltip : {
					isHtml : true
				},
				chartArea : {
					top : 100,
					height : 250,
					left : 70,
					width : width - 140
				}
			},
			'view' : {
				'columns' : [ 0, 5, 6 , 7, 8]
			}
		});
        

        //add event handler to draw table
    	google.visualization.events.addListener(combo, 'ready', function() {
    		draw_table(combo.getDataTable());
    	});

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));
    	
        // Establish dependencies
        dashboard.bind(categoryPicker1, [categoryPicker2,categoryPicker3, categoryPicker4]);
        dashboard.bind(categoryPicker2, [categoryPicker3, categoryPicker4]);
        dashboard.bind(categoryPicker3, categoryPicker4);
        dashboard.bind([categoryPicker1, categoryPicker2,categoryPicker3, categoryPicker4], combo);

        // Draw the dashboard.
        dashboard.draw(data);
      }

      function draw_table (data) {
        var display = new google.visualization.DataView (data);
        display.hideColumns([0]);
        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(display, {'showRowNumber': true,'page':'enable','pageSize': 25 });
      }

      function refresh_chart(term_id) {
       		$.ajax({
    			url : '<?php
							
echo $this->Html->url ( array (
									"controller" => "Enrollments",
									"action" => "getEnrollments",
									"json" 
							) );
							?>',
    			dataType : "json",
    			type : "POST",
    			data : {
    				'term_id' : term_id
    			},
    			success : function(response) {
    				drawChart(response);
    			},
    			error : function(xhr, err) {
    				alert("System can't retrieve enrollment data");
    				console.log("readyState: " + xhr.readyState + "\nstatus: "
    						+ xhr.status + "\nresponseText: " + xhr.responseText);
    			}
    		});
    	}
  	$('#term_dropdown').on ('change', function (){
		refresh_chart($('#term_dropdown').val());
  	  	});
</script>



