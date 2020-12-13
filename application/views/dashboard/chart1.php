   <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.1.7.2.min.js"></script>
  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/highchart/highcharts.js"></script>
 
   <script type="text/javascript">
		var chart2; // globally available
		$(document).ready(function() {
      	chart2 = new Highcharts.Chart({
         chart: {
            renderTo: 'chart5',
            type: 'column'
			
         },   
         title: {
            text: ''
         },
		 
         xAxis: {
            categories: ['Jumlah  Status Cuti']
         },
         yAxis: {
            title: {
               text: ''
            }
         },
          series:             
            [ <?php echo isset($series5) ? $series5 : ''; ?>]
		});
	});	
</script>
 
      <div id="chart5"  style="width: 100%; height: 100%; margin:0px ; float:none">
                                        
     </div>  
     </center>