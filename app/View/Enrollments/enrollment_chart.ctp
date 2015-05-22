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
				<table>
					<tr>
						<td>
								<?php
								echo $this->Form->input ( 'term', array (
										'empty' => "-- Choose Term --",
										'options' => $terms,
										'id' => 'term_dropdown' 
								) );
								?>
				<!--Divs that will hold each control and chart-->
							<div id="course_code_control" style="width: 250px"></div>
							<div id="teacher_control" style="width: 250px"></div>
							<div id="reg_ratio_control" style="width: 250px"></div>
							<div id="drop_ratio_control" style="width: 250px"></div>
						</td>
						<td>
							<div id="chart_div"></div>
						</td>
					</tr>
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
    	var formatter = new google.visualization.NumberFormat({
    		suffix : '%',
    		fractionDigits : 0
    	});

    	formatter.format(data, 7);
    	formatter.format(data, 8);
        
        // Create a category filter, passing some options
        var course_code_picker = new google.visualization.ControlWrapper({
          'controlType' : 'CategoryFilter',
          'containerId': 'course_code_control',
          'options': {
            'filterColumnLabel': 'Course Code'
          }
        });

        var teacher_picker = new google.visualization.ControlWrapper({
            'controlType' : 'CategoryFilter',
            'containerId': 'teacher_control',
            'options': {
              'filterColumnLabel': 'Teacher'
            }
          });
        
      	var reg_ratio_picker = new google.visualization.ControlWrapper({
    		'controlType' : 'NumberRangeFilter',
    		'containerId' : 'reg_ratio_control',
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

 
    	var drop_ratio_picker = new google.visualization.ControlWrapper({
    		'controlType' : 'NumberRangeFilter',
    		'containerId' : 'drop_ratio_control',
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
    		drawTable(combo.getDataTable());
    	});

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));
    	
        // Establish dependencies
        dashboard.bind(course_code_picker, [teacher_picker,reg_ratio_picker, drop_ratio_picker]);
        dashboard.bind(teacher_picker, [reg_ratio_picker, drop_ratio_picker]);
        dashboard.bind(reg_ratio_picker, drop_ratio_picker);
        dashboard.bind([course_code_picker, teacher_picker,reg_ratio_picker, drop_ratio_picker], combo);

        // Draw the dashboard.
        dashboard.draw(data);
      }

      function drawTable (data) {
        var display = new google.visualization.DataView (data);
        display.hideColumns([0]);
        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(display, {'showRowNumber': true,'page':'enable','pageSize': 25 });
      }

      function refreshChart(term_id) {
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
		refreshChart($('#term_dropdown').val());
  	  	});
</script>



