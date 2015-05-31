</div>
</div>

<div  class="col-lg-12 col-md-6 col-sm-2 footer"> 2015 &copy; karthick kumar </div>
</body>
</html>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/script.js"></script>
<script>                    
        $(document).ready(function($) {

            var options = {
                beforeSend: function(){
                    $(".error").html('Processing ,please wait...');
                },
                complete: function(response){
					$("#myModal2 .error").addClass("bg-success text-success");	
                    $("#myModal2 .error").html(response.responseText);
					$("#myModal2").modal('hide');
					location.reload();          
                }
            };  
            // Submit the form
            $("#imagesform").ajaxForm(options);  

            return false;
            
        });
		
		$(document).ready(function($) {

            var options = {
                beforeSend: function(){
                    $(".error").html('Processing ,please wait...');
                },
                complete: function(response){
					$("#myModal3 .error").addClass("bg-success text-success");	
                    $("#myModal3 .error").html(response.responseText);
					$("#myModal3").modal('hide');
					location.reload();          
                }
            };  
            // Submit the form
            $("#uploadcsv").ajaxForm(options);  

            return false;
            
        });
        </script>
