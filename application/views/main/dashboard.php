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

	

	a:hover{
		text-decoration: none;
	}
	
	

</style>




<div class="row">
	<div class="col-md-12" style="background-color: #f7fbfe; height: 400px">
		
	</div>
</div>

<pre>
	<?php print_r($this->session->userdata()) ?>
</pre>



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
