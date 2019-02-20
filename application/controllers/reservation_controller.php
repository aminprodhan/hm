<?php
class Reservation_Controller extends CI_Controller
{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			$this->load->model("common_model");
			$this->load->model("common");
			$this->load->model("room_model");
			$this->load->model("reservation_model");

        }

        public function index(){

			$data["payment_info"]=array();
			$data["agent_list"]=$this->common_model->getAll("agent_list");
			$getRoomType=$this->common->getRoomReservationTypeId();
			$data["reservation_type"]=$this->common_model->getAll("type_list","type_id",$getRoomType,"","","","","id","asc");


            $this->load->view('admin/header');
            $this->load->view('reservation/new',$data);
            $this->load->view('admin/footer');

		}

		public function removeGuestInfo(){

			$w = $this->common->getSessionUserList(1);
			$combine_ginfo = json_decode(stripslashes($_POST['combine_ginfo']));
			foreach($combine_ginfo as $val){

				$data=array(
					"trace" => 1,
					"date_time" => $this->common->getCurrentDateTime(),
					"by" => $this->common->getUserAddress(),

				);

				$this->db->where("ware",$w);
				$this->db->where("id",$val[0]);
				$this->db->update("tbl_guest_info",$data);
			}

			echo 1;
		}

		public function saveModalNewGuestInfo(){

			$w = $this->common->getSessionUserList(1);
			$combine_ginfo = json_decode(stripslashes($_POST['combine_ginfo']));
			foreach($combine_ginfo as $val){

				$data_guest=array(
					"ware" => $w,
					"resv_id" => trim($val[0]),
					"name" => trim($val[1]),
					"email" => trim($val[2]),
					"mobile_no" => trim($val[3]),
					"address" => trim($val[4]),
					"country" => trim($val[5]),
					"indentity" => trim($val[6]),
					"room_type" => trim($val[7]),
					"date_time" => $this->common->getCurrentDateTime(),
					"by" => $this->common->getUserAddress(),
				);
						
				$this->db->insert("tbl_guest_info",$data_guest);

			}

			echo 1;

		}

		public function reservationList(){

			$data["agent_list"]=$this->common_model->getAll("agent_list");
			$data["start_date"]=date('d-m-Y');
			$data["end_date"]=date('d-m-Y');
			$data["list"]=array();
			if(!empty($_GET["start_date"]))
				{
					$data["start_date"]=$_GET["start_date"];
					$data["end_date"]=$_GET["end_date"];
					$data["list"]=$this->reservation_model->getReservationList("tbl_reservation");
				}

			$this->load->view('admin/header');
            $this->load->view('reservation/list',$data);
            $this->load->view('admin/footer');

		}

		public function getReservationInfo($resv_id,$status=0)
			{

				//$data["allot_id"]=$this->common->anyName("tbl_reservation","resv_id",$resv_id,"isAllotment");

				$checkUserValidity=0;
				

			    $data["status"]=$status;

				$getRoomType=$this->common->getRoomReservationTypeId();
				$data["reservation_type"]=$this->common_model->getAll("type_list","type_id",$getRoomType,"","","","","id","asc");
	
	
				$data["agent_list"]=$this->common_model->getAll("agent_list");
				$data["list"]=$this->reservation_model->getReservationList("tbl_reservation",$resv_id);
				$data["guest_list"]=$this->common_model->getAll("tbl_guest_info","resv_id",$resv_id);
				$data["resv_list"]=$this->room_model->getReservationRoomList($resv_id);
				$data["payment_info"]=$this->reservation_model->getReservationPayInfo($resv_id);
				
				$pay_type=$this->common->getRoomReservationType();
				//$pay_type=$this->common->getRoomReservationType();
				

				$data["pay_invoice"]=$this->common_model->getAll("payment_info","resv_id",
				$resv_id,"pay_type",$pay_type);

				$getRoomType=$this->common->getRoomType();

				$data["rt"]=$this->common_model->getAll("type_list","type_id",$getRoomType);


				$this->load->view('admin/header');
            	$this->load->view('reservation/reservation_update',$data);
				$this->load->view('admin/footer');
				

			}

		public function updateReservationInfo($reservationInfo,$resv_id,$isCheckIn){

			$w = $this->common->getSessionUserList(1);

			foreach($reservationInfo as $val){



				
				$data_resv=array(
                
					"ware" => $w,
					"resv_date" => date('Y-m-d',strtotime($val[1])),
					"agent" => $val[2],
					"adult" => $val[3],
					"children" => $val[4],
					"season" => $val[5],
					"room_type" => $val[6],
					//"resv_type" => $val[7],
					"isAllotment" => $val[15],
					"date_time" => $this->common->getCurrentDateTime(),
					"by" => $this->common->getUserAddress(),
				);


				if(!empty($isCheckIn))
					{
						$data_resv["check_in_date_time"]=$this->common->getCurrentDateTime();
						$data_resv["check_in_status"]=1;

						$data=array(
							"check_in_status" => 1,
						);

						$this->db->where("ware",$w);
						$this->db->where("resv_id",$resv_id);
						$this->db->update("tbl_room_check_in",$data);


					}
	
				
					$this->db->where("ware",$w);
					$this->db->where("resv_id",$resv_id);
					$this->db->update("tbl_reservation",$data_resv);
			
	
					$data_guest=array(
						"ware" => $w,
						"resv_id" => $resv_id,
						"name" => $val[8],
						"email" => $val[9],
						"mobile_no" => $val[10],
						"address" => $val[11],
						"country" => $val[12],
						"indentity" => $val[13],
						"room_type" => $val[14],
						"date_time" => $this->common->getCurrentDateTime(),
						"by" => $this->common->getUserAddress(),
					);
	
			
					$this->db->where("ware",$w);
					$this->db->where("resv_id",$resv_id);
					$this->db->update("tbl_guest_info",$data_guest);
				

			}

		}
		
		public function saveResvPayInfo()
			{


				$w = $this->common->getSessionUserList(1);


				$isCheckIn=$_POST["isCheckIn"];

				$reservationInfo = json_decode(stripslashes($_POST['reservationInfo']));
				$setBankPayment = json_decode(stripslashes($_POST['setBankPayment']));
				$payInvoice=json_decode(stripslashes($_POST['payInvoice']));
				foreach($payInvoice as $val){


					$this->updateReservationInfo($reservationInfo,$val[0],$isCheckIn);

					

					$msg="";
					$status=0;

					$isValidResvCode=$this->common->anyName("tbl_reservation","resv_id",$val[0],"resv_id");
					if(empty($isValidResvCode)){
						$msg="Reservation code not found.......";
						$status=1;
					}
					else{

						$ptype=$this->common->getRoomReservationType();
						if(!empty($isCheckIn)){

							$ptype=$this->common->getPayCheckInType();
						}

						$hasPayId=$this->common->anyName("payment_info","resv_id",$val[0],"pay_id","pay_type",$ptype);



						$pay_date=date('Y-m-d',strtotime($val[2]));
						$data=array(

							"pay_mode" => $val[1],
							"date" => $pay_date,
							"tax" => trim($val[4]),
							"amount" => trim($val[3]),
							"remarks" => $val[5],
							"ware" => $w,
							"pay_type" => $ptype,
							"date_time" => $this->common->getCurrentDateTime(),
                			"by" => $this->common->getUserAddress(),
							"resv_id" => $val[0],
						);



						if(empty($hasPayId) || !empty($isCheckIn)){
							$this->db->insert("payment_info",$data);
							$hasPayId=$this->db->insert_id();
						}
						else if(!empty($hasPayId)){

							$this->db->where("ware",$w);
							$this->db->where("pay_id",$hasPayId);
							$this->db->update("payment_info",$data);
						}

						$data=array(
							"trace" => 1,
						);


						if(empty($isCheckIn)){

							$this->db->set($data);
							$this->db->where("ware",$w);
							$this->db->where("pay_id",$hasPayId);
							$this->db->update("tbl_pay_bank_info");


							$this->db->set($data);
							$this->db->where("ware",$w);
							$this->db->where("pay_id",$hasPayId);
							$this->db->update("product_trans");

						}

						$data_accounts=array(
							"type" => $this->common->getRoomReservationType(),
							"amount" => $val[3],
							"date_time" => $this->common->getCurrentDateTime(),
                			"by" => $this->common->getUserAddress(),
							"date" => $pay_date,
							"ware" => $w,
							"model" => $this->common->getReservationModule(),
							
						);

						$data_accounts["pay_id"]=$hasPayId;
						$data_accounts["resv_id"]=$val[0];

						if($val[1] == $this->common->getBankPayModeId()){ //bank pay

							foreach($setBankPayment as $b){

								$chq_date=date('Y-m-d',strtotime($b[4]));
								$data=array(

									"account_number" => $b[1],
									"resv_id" => $val[0],
									"pay_id" => $hasPayId,
									"branch_name" => $b[2],
									"chq_number" => $b[3],
									"chq_date" => $chq_date,
									"bank_name" => $b[0],
									"ware" => $w,
									"date_time" => $this->common->getCurrentDateTime(),
									"by" => $this->common->getUserAddress(),
									
								);

								$this->db->insert("tbl_pay_bank_info",$data);


								//$data_accounts["dr"]=$this->;
								//$data_accounts["cr"]=0;
								


							}
						}
						else{  //cash pay

								//$data_accounts["dr"]=192;
								//$data_accounts["cr"]=0;

						}

						$data=array(
							"isComplete" => 1,
						);
						$this->db->where("ware",$w);
						$this->db->where("resv_id",$val[0]);
						$this->db->update("tbl_reservation",$data);

						
						$msg="Reservation Completed....";
						$status=0;

					}

					$ara=array(
						"msg" => $msg,
						"status" => $status,
					);

					echo json_encode($ara);

				}

				


			}
        
}