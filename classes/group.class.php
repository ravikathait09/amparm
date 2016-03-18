<?php 
	require_once("easyCRUD.class.php");
	
	class Contact  Extends Crud {
		
			# Your Table name 
			protected $table = 'contact';
			
			# Primary Key of the Table
			protected $pk	 = 'id';

	}
	
	class Group  Extends Crud {
		
			# Your Table name 
			protected $table = 'grouptable';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
			
			function allgroupname($userid){
				$sql="select gr.title, gr.id,  from grouptable gr ,grooupuser  gu where gu ";
				
			}
			
			function getgroupbyowner($userid=0)
			{
				if($userid){
					$sql="select gr.*, u.firstname from users u, grouptable gr where u.id=gr.owner_id and gr.owner_id='".$userid."' ";
				}else
				{
					$sql="select gr.*, u.firstname from users u, grouptable gr where u.id=gr.owner_id ";
				}
				return $this->db->query($sql);
			}
			
		
		
	}
	class groupuser  Extends Crud {
		
			# Your Table name 
			protected $table = 'groupuser';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
			function findgroupuser($groupid)
			{
			   $sql="select u.*, gr.group_notification,gr.point  from users u, groupuser gr where u.id=gr.userid and gr.groupid='".$groupid."' ";
				return $this->db->query($sql);
			}
			
			function findgroupbyuser($userid)
			{
				 $sql="select gt.*, gr.group_notification,gr.point  from grouptable gt, groupuser gr where gr.groupid=gt.id and gr.userid='".$userid."' ";
				return $this->db->query($sql);
			}

		
	}
	class tweetergroup  Extends Crud {
		
			# Your Table name 
			protected $table = 'tweetergroup';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
		function findgroupdetail($tweetid)
		{
		 	 $sql="select gr.title, tw.id from tweetergroup tw, grouptable gr where tw.groupname=gr.id  and tw.tweetid='".$tweetid."' ";
			return $this->db->query($sql);
		}
		
	}
	
	class Notification Extends Crud {
		protected $table = 'notification';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
	}


?>