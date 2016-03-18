<?php 
	require_once("easyCRUD.class.php");

	class Setting  Extends Crud {
		
			# Your Table name 
			protected $table = 'settings';
			
			# Primary Key of the Table
			protected $pk	 = 'id';
	}

?>