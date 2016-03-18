<?php 
	require_once("easyCRUD.class.php");

	class twitter  Extends Crud {
		
			# Your Table name 
			protected $table = 'twiiter';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
			
			protected $mylimit=2;
	
		function gettwiiterbyowner($userid=0)
		{
			
				if($userid){
					$sql="select tr.*, u.firstname  from users u, twiiter tr where u.id=tr.ownerid and tr.ownerid='".$userid."' ";
				}else
				{
					$sql="select tr.*, u.firstname  from users u, twiiter tr where u.id=tr.ownerid ";
				}
			
				return $this->db->query($sql);
			
		}
		function gettwiiterbyownersql($userid=0,$limit=10)
		{
			$start=$limit-10;
				if($userid){
					$sql="select tr.*, u.firstname  from users u, twiiter tr where u.id=tr.ownerid and tr.ownerid='".$userid."' order by tr.id desc limit $start, 10 ";
				}else
				{
					$sql="select tr.*, u.firstname  from users u, twiiter tr where u.id=tr.ownerid order by tr.id desc limit $start, 10 ";
				}
			
				return $sql;
			
		}
		function findCustomlessthen($time,$status=0)
		{
			 $sql="select * from twiiter where timestamp <='".$time."' and status ='".$status."'" ;
			return $this->db->query($sql);
		}
		
		function findCustomindividuallessthen($time)
		{
			echo  $sql="select * from twiiter where timestamp <='".$time."'" ;
			return $this->db->query($sql);
		}
		
		/*function gettweetbydate($strtotime)
		{
			$sql="select * from twiiter where timestamp='".$strtotime."' ;
			return $this->db->query($sql);
		}*/
		
	}
	class usertimesetting Extends Crud
	{
		protected $table = 'usertimesetting';                                                                            
			
			# Primary Key of the Table
		protected $pk	 = 'id';
	}
	class Tweetuser Extends Crud{
		# Your Table name 
			protected $table = 'tweetuser';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';
		
		protected $mylimit=10;
			function gettweetuser($tweetid){
			 	$sql="select distinct (u.id) ,u.*,tr.id as tweetuserid, tr.status,tr.sent,tr.groupid  from users u, tweetuser tr where u.id=tr.userid and tr.tweetid='".$tweetid."'  ";
				return $this->db->query($sql);
			}
			function gettweetlaterapproveuser($tweetid){
			 	 $sql="select distinct (u.id) ,u.*,tr.id as tweetuserid, tr.status,tr.sent, tr.groupid  from users u, tweetuser tr where u.id=tr.userid and tr.tweetid='".$tweetid."' and tr.sent='0'";
				return $this->db->query($sql);
			}
			
			function findtweetuser($userid)
			{
				$sql="select tw.*, twu.status from twiiter tw ,tweetuser twu where  and twu.tweetid=tw.id and  twu.userid='".$userid."'";
				return $this->db->query($sql);
				
			}
			function findschduledtweetuser($userid,$history=0,$limit=10)
			{
				date_default_timezone_set("Asia/Kolkata");
				$day=strtotime(date("Y-m-d h:i:s"));
				$start=$limit-10;
				
				if($history){
				 $sql="select distinct (tw.id), tw.*, twu.status,twu.groupid, twu.tweetreplyid from twiiter tw ,tweetuser twu where twu.userid='".$userid."' and  twu.tweetid=tw.id and ( tw.timestamp < $day or tw.status=1 ) order by  tw.id desc limit $start , $this->mylimit";
				}
				else{
					$sql="select distinct (tw.id), tw.*, twu.status, twu.groupid, twu.tweetreplyid from twiiter tw ,tweetuser twu where twu.userid='".$userid."' and  twu.tweetid=tw.id and (tw.timestamp >$day and  tw.status=0) order by  tw.id desc limit $start , $this->mylimit";
				}
				 $sql;
				return $this->db->query($sql);
			}
			function findschduledtweetusersql($userid,$history=0,$limit=10)
			{
				date_default_timezone_set("Asia/Kolkata");
				$day=strtotime(date("Y-m-d h:i:s"));
				$start=$limit-10;
				
				if($history){
				 $sql="select distinct (tw.id), tw.*, twu.status, twu.groupid, twu.tweetreplyid  from twiiter tw ,tweetuser twu where twu.userid='".$userid."' and  twu.tweetid=tw.id and ( tw.timestamp < $day or tw.status=1 ) order by  tw.id desc limit $start , $this->mylimit";
				}
				else{
					$sql="select distinct (tw.id), tw.*, twu.status, twu.groupid, twu.tweetreplyid  from twiiter tw ,tweetuser twu where twu.userid='".$userid."' and  twu.tweetid=tw.id and (tw.timestamp >$day and  tw.status=0) order by  tw.id desc limit $start , $this->mylimit";
				}
				//echo  $sql;
				return $sql;
			}
			
			
				
	}
	
	class Category  Extends Crud {
		
			# Your Table name 
			protected $table = 'categories';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}
	class CategoryUrl  Extends Crud {
		
			# Your Table name 
			protected $table = 'categoryurl';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}
	class blogurl  Extends Crud {
		
			# Your Table name 
			protected $table = 'urlblog';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}
	class interestedcat  Extends Crud {
		
			# Your Table name 
			protected $table = 'interested_cat';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}
	class userrecommandtweet  Extends Crud {
		
			# Your Table name 
			protected $table = 'userrecommendtweet';                                                                            
			
			# Primary Key of the Table
			protected $pk	 = 'id';

		
	}


?>