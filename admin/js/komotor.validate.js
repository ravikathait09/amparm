jQuery(document).ready(function(){
	jQuery("#loginForm").validate();
	jQuery("#saveVariable").validate({
		rules:	{
			varName:	{
				required:	true,
				remote:		'post.php'
			}
		}

	});
	jQuery("#saveCategory").validate({
		rules:	{
			catName:	{
				required:	true,
				remote:		'post.php'
			}
		}

	});
	jQuery("#saveCatLang").validate({
		rules:	{
			catName:	{
				required:	true,
				remote:	{
					url:	'post.php',
					data: {
						cat_id: function () {
							return $("#cat_id").val();
						}
					}
				}
			}
		}

	});
});