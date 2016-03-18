<?php 
	require_once("easyCRUD.class.php");

	class Contact  Extends Crud {
		
			# Your Table name 
			protected $table = 'contact';
			
			# Primary Key of the Table
			protected $pk	 = 'id';

			
			
	}

?>