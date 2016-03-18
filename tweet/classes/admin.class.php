<?php 
	require_once("easyCRUD.class.php");

	class Admin  Extends Crud {                                               
		
			# Your Table name 
			protected $table = 'users';
			
			# Primary Key of the Table
			protected $pk	 = 'id';

			public function blockUser($arr,$status){
				echo $sql = "UPDATE ".$this->table." SET status = $status WHERE id = :id";
				return $this->db->query($sql,$arr);                      
				return true;                    
			}

			public function updateType($arr,$status){
				echo $sql = "UPDATE ".$this->table." SET type = $status WHERE id = :id";
				return $this->db->query($sql,$arr);                        
				return true;                                        
			}

			public function deleteUser($id){
				global $config;
				//GET ALL VEHICLES OF THAT USER
				$sql = "SELECT * FROM vehicles WHERE owner_id = $id";
				$vehicles = $this->db->query($sql);
				if(isset($vehicles) and is_array($vehicles) and count($vehicles)>0){
					foreach($vehicles as $vehicleData){
						//GET ALL VEHICLE PICS
						$sql1 = "SELECT * FROM vehicle_pics WHERE v_id = ".$vehicleData['id'];
						$vehicles_pics = $this->db->query($sql1);
						if(isset($vehicles_pics) and is_array($vehicles_pics) and count($vehicles_pics)>0){
							foreach($vehicles_pics as $vehiclePicData){
								//GET ALL VEHICLE PICS
								if(is_file($config['DOC_ROOT'].'uploads/'.$vehiclePicData['img_path']) and file_exists($config['DOC_ROOT'].'uploads/'.$vehiclePicData['img_path'])){
									unlink($config['DOC_ROOT'].'uploads/'.$vehiclePicData['img_path']);
								}
							}
							$sql2 = "DELETE FROM vehicle_pics WHERE v_id = ".$vehicleData['id'];
							$vehicles_pics = $this->db->query($sql2);
							$sql3 = "DELETE FROM vehicle_desc WHERE v_id = ".$vehicleData['id'];
							$vehicles_pics = $this->db->query($sql3);
							$sql4 = "DELETE FROM vehicle_availibilty_year WHERE vehicle_id = ".$vehicleData['id'];
							$vehicles_pics = $this->db->query($sql4);
							$sql5 = "DELETE FROM vehicle_availibilty_week WHERE vehicle_id = ".$vehicleData['id'];
							$vehicles_pics = $this->db->query($sql5);
						}
					}	
				}
				$sql6 = "DELETE FROM vehicles WHERE owner_id = $id";
				$vehicles = $this->db->query($sql6);
				$sql7 = "DELETE FROM users WHERE id = $id";
				$vehicles = $this->db->query($sql7);
				$sql8 = "DELETE FROM user_price_levels WHERE user_id = $id";
				$vehicles = $this->db->query($sql8);
				//DELETE ALL VEHICLES OF THAT USER
				//DELETE ALL VEHICLES OF THAT USER
			}
	}


?>