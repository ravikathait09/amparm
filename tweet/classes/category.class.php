<?php 
	require_once("easyCRUD.class.php");

	class Category  Extends Crud {
		
			# Your Table name 
			protected $table = 'categories';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}

?>