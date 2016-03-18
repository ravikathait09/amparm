<?php 
	require_once("easyCRUD.class.php");

	class Page  Extends Crud {
		
			# Your Table name 
			protected $table = 'pages';
			
			# Primary Key of the Table
			protected $pk	 = 'id';

			function getNewRequests($arr){
				$sql = "SELECT id as ad_id , page_id FROM ad WHERE page_id IN (SELECT id FROM pages WHERE user_id = :user_id) AND read_status = 0";
				return $this->db->query($sql,$arr);
			}

			public function changePageStatus($arr,$status){
				echo $sql = "UPDATE ".$this->table." SET page_visibility = $status WHERE id = :id";
				return $this->db->query($sql,$arr);
				return true;
			}
			
	}

?>