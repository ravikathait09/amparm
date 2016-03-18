  <!-- jQuery 2.0.2 -->
        <script src="<?php echo $config['ADMIN_URL']; ?>js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 
        <script src="<?php echo $config['ADMIN_URL']; ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
        <!-- Bootstrap -->
        <script src="<?php echo $config['ADMIN_URL']; ?>js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $config['ADMIN_URL']; ?>js/bootstrap-editable.js" type="text/javascript"></script>
        <script src="<?php echo $config['ADMIN_URL']; ?>js/jquery.validate.js" type="text/javascript"></script>
		
		 <script src="<?php echo $config['ADMIN_URL']; ?>js/jquery.validate.js" type="text/javascript"></script>
	   <script src="<?php echo $config['ADMIN_URL']; ?>js/moment.js"></script>
		 <script src="<?php echo $config['ADMIN_URL']; ?>js/bootstrap-datetimepicker.js" type="text/javascript"></script>
		<!--<script type="text/javascript"
		src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
		</script>-->
	
            <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
                                                                                                                    
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		
		
		<script type="text/javascript">
            $(function() {
                $('#userTable').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                   // "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
				 $('#userTable2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                   // "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

<script>
    $('.editVal').editable({
	validate: function(value) {
		if($.trim(value) == '') {
			return 'This field is required';
		}
    },
	success: function(response, newValue) {
			if(!response) {
				return "Ok";
			}          
			
			if(response.success === false) {
				 return response.msg;
			}
		}      
});

function vpb_image_preview(vpb_selector_) 
{
	var id = 1, last_id = last_cid = '';
	$.each(vpb_selector_.files, function(vpb_o_, file)
	{
		if (file.name.length>0) 
		{
			if (!file.type.match('image.*')) { return true; } // Do not add files which are not images
			else
			{
				//Clear previous previewed files and start again
			
			   
			   var reader = new FileReader();
			   
			   reader.onload = function(e) 
			   {
				   $('#vpb-display-preview').append(
				   '<div id="selector_'+vpb_o_+'" class="vpb_wrapper"> \
				   <img class="vpb_image_style" class="img-thumbnail" src="' + e.target.result + '" \
				   title="'+ escape(file.name) +'" /><br /> \
				   <a style="cursor:pointer;padding-top:5px;" title="Click here to remove '+ escape(file.name) +'" \
				   onclick="vpb_remove_selected(\''+vpb_o_+'\',\''+file.name+'\')">Remove</a> \
				   </div>');
			   }
			   reader.readAsDataURL(file);
		   }
		}
		else {  return false; }
	});
}


//Remove Previewed File only from the screen but will be uploaded when you click on the start upload button
function vpb_remove_selected(id,name)
{
	$('#v-add-'+id).remove();
	$('#selector_'+id).fadeOut();
}
function vpb_remove_uploaded2(id,name)
{
    $('#v-add-'+id).remove();
	$('#selector_'+id).fadeOut();
        $.ajax({
            url :'ajax.php?remove&id='+id+'&imageurl='+name ,
            type: 'Get',
            success: function(response)
			{
				  $('#v-add-'+id).remove();
	$('#selector_'+id).fadeOut();
			}
        });
        
}


</script>
<script>
        function changenotificationstatus()
{
	$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {notification:"notification",},
		success:function(res){	

			
		}
	});
}
</script>
    </body>
</html>