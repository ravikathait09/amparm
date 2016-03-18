<?php 
	require_once("easyCRUD.class.php");

	class User  Extends Crud {
		
			# Your Table name 
			protected $table = 'users';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		public function selectalltype(){
			$sql="select * from ". $this->table." where type !=1";
			return $this->db->query($sql);
		}
		
		
		

	}
	
	class Main Extends Crud {
			public function runsql($sql){
		
			return $this->db->query($sql);
		}
	}
	class Setting  Extends Crud {
		
			# Your Table name 
			protected $table = 'mysetting';
			
			# Primary Key of the Table
			protected $pk	 = 'id';
	}

	
?>