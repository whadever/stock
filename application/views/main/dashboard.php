<style>
	
	input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
          color:    #000 !important;
          font-size: 10px !important;
          margin-left: 3px !important;
      }
      input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
         color:    #000 !important;
         opacity:  1 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }
      input::-moz-placeholder { /* Mozilla Firefox 19+ */
         color:    #000 !important;
         opacity:  1 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }
      input:-ms-input-placeholder { /* Internet Explorer 10-11 */
         color:    #000 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }

	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
		background-color: white !important;

	}

	.page_subtitle{
		font-size: 18px;
		font-weight: bold;
	}

	a:hover{
		text-decoration: none;
	}
	
	

</style>


<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<p class="page_subtitle">DASHBOARD</p>
			</div>
		
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="cal-body" class="wrap" style="margin-bottom:20px;">
				
				</div>
			</div>
		</div>
			
		</div>
	</div>
</div>




<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
<script type="text/javascript">
    $(function () {
        $('#datepicker1').datepicker({
        	format: "yyyy-mm",
		    viewMode: "months", 
		    minViewMode: "months"

        });
        
    });
</script>

<script>
$(document).ready(function(){
    $('#datepicker1').on("changeDate", function() {
	    setTimeout(function(){
	    	var date = $('#datepicker1').val().split('-');



	    	$.ajax({
	          url: "<?php echo base_url('main/index')?>"+ "/" + date[0] + "/" + date[1] + "",
	          type: 'GET',
	          cache : false,
	          success: function(result){
	         
	            
	            location.replace("<?php echo base_url('main/index') ?>"+"/"+date[0] + "/" + date[1]);
	          }
	        });
	    },1);
	});
});

</script>

<!-- get timezone -->
<!-- 
<script type="text/javascript" src="<?php echo base_url().'js/timezone.js' ?>">
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var tz = jstz.determine();
    var timezone = tz.name();
    alert(timezone);
  });
</script> -->