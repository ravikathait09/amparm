 <!-- / #wrapper -->
        <!-- Back to top -->
        <div id="back-to-top"><a href="#">Back to Top</a>
        </div>
        <!-- Javascripts -->
        <!-- Load pace first -->
        <script src="plugins/core/pace/pace.min.js"></script>
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
        window.jQuery || document.write('<script src="js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="js/libs/jquery-migrate-1.2.1.min.js">\x3C/script>')
        </script>
        <!--[if lt IE 9]>
  <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script type="text/javascript" src="js/libs/respond.min.js"></script>
<![endif]-->
        <!-- Bootstrap plugins -->
        <script src="js/bootstrap/bootstrap.js"></script>
        <!-- Core plugins ( not remove ) -->
        <script src="js/libs/modernizr.custom.js"></script>
        <!-- Handle responsive view functions -->
        <script src="js/jRespond.min.js"></script>
        <!-- Custom scroll for sidebars,tables and etc. -->
        <script src="plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
        <!-- Remove click delay in touch -->
        <script src="plugins/core/fastclick/fastclick.js"></script>
		  <script src="js/jquery.validate.js"></script>
        <!-- Increase jquery animation speed -->
       
        <!-- Quick search plugin (fast search for many widgets) -->
        <script src="plugins/core/quicksearch/jquery.quicksearch.js"></script>
        <!-- Bootbox fast bootstrap modals -->
        <script src="plugins/ui/bootbox/bootbox.js"></script>
        <!-- Other plugins ( load only nessesary plugins for every page) -->
      
        <script src="js/jquery.supr.js"></script>
        <script src="js/main.js"></script>
		   <script src="<?php echo $config['ADMIN_URL']; ?>js/moment.js"></script>
		<script src="plugins/tables/datatables/jquery.dataTables.js" type="text/javascript"></script>
		 <script src="<?php echo $config['ADMIN_URL']; ?>js/bootstrap-datetimepicker.js" type="text/javascript"></script>
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
		function managegroup(obj)
		{		
			jQuery(obj).remove();
			$.ajax({
			type:'post',
			url:'ajax.php?managegroup',
			success:function(res){	
					$('#ptagbody').html('You Request has been pending to admin. Admin will approve it.');
					$('#modal-style5').modal('toggle');
			
				}
			});		
		}
(function($) {
    $.fn.flash_message = function(options) {
      
      options = $.extend({
        text: 'Done',
        time: 5000,
        how: 'before',
        class_name: ''
      }, options);
      
      return $(this).each(function() {
        if( $(this).parent().find('.flash_message').get(0) )
          return;
        
        var message = $('<span />', {
          'class': 'flash_message ' + options.class_name,
          text: options.text
        }).hide().fadeIn('fast');
        
        $(this)[options.how](message);
        
        message.delay(options.time).fadeOut('normal', function() {
          $(this).remove();
		  $('#status-area').hide();
        });
        
      });
    };
})(jQuery);
function vpb_image_preview2(vpb_selector_) 
{
	var id = 1, last_id = last_cid = '';
	$.each(vpb_selector_.files, function(vpb_o_, file)
	{
		 $('#editretweetimage').html('');
		if (file.name.length>0) 
		{
			if (!file.type.match('image.*')) { return true; } // Do not add files which are not images
			else
			{
				//Clear previous previewed files and start again
			
			   
			   var reader = new FileReader();
			   
			   reader.onload = function(e) 
			   {
				   $('#editretweetimage').append(
				   '<div id="selector_'+vpb_o_+'" class="vpb_wrapper"> \
				   <img width="200px" class="vpb_image_style" class="img-thumbnail" src="' + e.target.result + '" \
				   title="'+ escape(file.name) +'" /><br /> \
				  			   </div>');
			   }
			   reader.readAsDataURL(file);
		   }
		}
		else {  return false; }
	});
}
function vpb_image_preview(vpb_selector_) 
{
	var id = 1, last_id = last_cid = '';
	$.each(vpb_selector_.files, function(vpb_o_, file)
	{
		 $('#retweetimage').html('');
		if (file.name.length>0) 
		{
			if (!file.type.match('image.*')) { return true; } // Do not add files which are not images
			else
			{
				//Clear previous previewed files and start again
			
			   
			   var reader = new FileReader();
			   
			   reader.onload = function(e) 
			   {
				   $('#retweetimage').append(
				   '<div id="selector_'+vpb_o_+'" class="vpb_wrapper"> \
				   <img width="200px" class="vpb_image_style" class="img-thumbnail" src="' + e.target.result + '" \
				   title="'+ escape(file.name) +'" /><br /> \
				  			   </div>');
			   }
			   reader.readAsDataURL(file);
		   }
		}
		else {  return false; }
	});
}
setInterval("myajaxsession()",1000);
function myajaxsession()
{
$.ajax({
		type:'post',
		url:'ajax.php?checksession',
			
		success:function(res){
			if(!res)	{
			location.reload();
			}
		}
	});
}

function showpopup(id)
{
	$.ajax({
		type:'post',
		url:'ajax.php?userdetail='+id,
		success:function(res){
			$('.profilecontent').html(res);
		}
	});
		$('#viewprofile').modal('show');
}
        </script>
<div class="modal fade modal-style5"  id="viewprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="background:#fff">
		<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
					<h4 class="modal-title" id="mySmallModalLabel">Profile details</h4>
					</div>
					
		 </div>
		 <div class="profilecontent">
		 </div>
			
	</div>
</div>

    </body>
</html>