<?php
class Allotment_Controller extends CI_Controller
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
			$this->load->model("allotment_model");

        }

        public function index(){

			$data["agent_list"]=$this->common_model->getAll("agent_list");
			
			$data["info"]=array();
			$data["room_list"]=array();
			$data["payment_info"]=array();
			$data["pay_invoice"]=array();

            $this->load->view('admin/header');
            $this->load->view('allotment/new_allotment',$data);
            $this->load->view('admin/footer');

		}

		public function getAllotmentCodeList(){

			$id=$_POST["id"];
			
            $w = $this->common->getSessionUserList(1);		

			if(!empty($w))
				$this->db->where("(ware='".$w."' OR ware='0')");

			$this->db->where("trace","0");

			$this->db->like('allot_code', $id); 
			$info=$this->db->get('tbl_allotment');	
		
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['allot_code']);
			}
			echo json_encode($data);

		}

		public function getAllotmentInfo($allot_id){



				$data["agent_list"]=$this->common_model->getAll("agent_list");
				$data["info"]=$this->allotment_model->getAllotmentList("tbl_allotment",$allot_id);
				$data["room_list"]=$this->allotment_model->getAllotmentRoomList($allot_id);
				$data["payment_info"]=$this->allotment_model->getAllotmentPayInfo($allot_id);

				$pay_type=$this->common->getAllotmentType();

				$data["pay_invoice"]=$this->common_model->getAll("payment_info","resv_id",$allot_id,"","pay_type",$pay_type);
				$data["rt"]=$this->common_model->getAll("type_list","type_id",20);

				$this->load->view('admin/header');
				$this->load->view('allotment/new_allotment',$data);
				$this->load->view('admin/footer');


		}


		public function getAllotmentList(){

				//echo 11;

			$data["agent_list"]=$this->common_model->getAll("agent_list");
			$data["start_date"]=date('d-m-Y');
			$data["end_date"]=date('d-m-Y');
			$data["list"]=array();
			if(!empty($_GET["start_date"]))
				{
					$data["start_date"]=$_GET["start_date"];
					$data["end_date"]=$_GET["end_date"];
					$data["list"]=$this->allotment_model->getAllotmentList("tbl_allotment");
				}


            $this->load->view('admin/header');
            $this->load->view('allotment/allotment_list',$data);
            $this->load->view('admin/footer');

		}

		public function saveAllotmentPayInfo()
		{
			$w = $this->common->getSessionUserList(1);

			$allotmentInfo = json_decode(stripslashes($_POST['allotmentInfo']));
			$setBankPayment = json_decode(stripslashes($_POST['setBankPayment']));
			$payInvoice = json_decode(stripslashes($_POST['payInvoice']));

			foreach($allotmentInfo as $p){

				if(!empty($p[0])){

					$pdate=date('Y-m-d',strtotime($p[2]));

					$data=array(
						"agent_id" => $p[1],
						"ware" => $w,
						"date" => $pdate,
						"remarks" => $p[3],
						"date_time" => $this->common->getCurrentDateTime(),
						"by" => $this->common->getUserAddress(),
					);

					$this->db->where("allot_id",$p[0]);
					$this->db->update("tbl_allotment",$data);

					$this->setAllotmentPayment($payInvoice,$setBankPayment);

				}
			}

		}


public function setAllotmentPayment($payInvoice,$setBankPayment){

			$msg="";
			$status=0;
			$w = $this->common->getSessionUserList(1);
	foreach($payInvoice as $val){

			$isValidResvCode=$this->common->anyName("tbl_allotment","allot_id",$val[0],"allot_id");
			if(empty($isValidResvCode)){
				$msg="Allotment code not found.......";
				$status=1;
			}
			else{

				$hasPayId=$this->common->anyName("payment_info","resv_id",$val[0],"pay_id");
				$pay_date=date('Y-m-d',strtotime($val[2]));
				$data=array(

					"pay_mode" => $val[1],
					"pay_type" => $this->common->getAllotmentType(),
					"date" => $pay_date,
					"tax" => trim($val[4]),
					"amount" => trim($val[3]),
					"remarks" => $val[5],
					"ware" => $w,
					"date_time" => $this->common->getCurrentDateTime(),
					"by" => $this->common->getUserAddress(),
					"resv_id" => $val[0],
				);

				if(empty($hasPayId)){
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

				$this->db->set($data);
				$this->db->where("ware",$w);
				$this->db->where("pay_id",$hasPayId);
				$this->db->update("tbl_pay_bank_info");


				$this->db->set($data);
				$this->db->where("ware",$w);
				$this->db->where("pay_id",$hasPayId);
				$this->db->update("product_trans");



				$data_accounts=array(

					"type" => $this->common->getAllotmentType(),
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

					}
				}
			

				$data=array(
					"isComplete" => 1,
				);
				$this->db->where("ware",$w);
				$this->db->where("allot_id",$val[0]);
				$this->db->update("tbl_allotment",$data);

				
				$msg="Allotment Completed....";
				$status=0;

				$ara=array(
					"msg" => $msg,
					"status" => $status,
				);

				echo json_encode($ara);

			}

		}

		}

		public function removeAllotmentRoom(){

			//$combineRoomList=$_POST["combineRoomList"];
			$allotment_code=$_POST["allotment_code"];
			$w = $this->common->getSessionUserList(1);

			$combineRoomList = json_decode(stripslashes($_POST['combineRoomList']));

			foreach($combineRoomList as $c){

				$this->db->where("id",$c[0]);
				$this->db->where("allot_ref_id",$allotment_code);
				$this->db->delete("tbl_room_allotment");


			}

			$this->getRoomAllotmentList($allotment_code);


		}

		public function saveAllotmentRoom(){

			$agent_list=$_POST["agent_list"];
			$allotment_code=$_POST["allotment_code"];
			$date=$_POST["date"];

			$remarks=$_POST["remarks"];

			$allotment_start_date=date('Y-m-d',strtotime($_POST["allotment_start_date"]));
			$allotment_end_date=date('Y-m-d',strtotime($_POST["allotment_end_date"]));

			$combineRoomList = json_decode(stripslashes($_POST['combineRoomList']));

			$w = $this->common->getSessionUserList(1);

			$cnv_sdate=strtotime($allotment_start_date);
			$cnv_edate=strtotime($allotment_end_date);

			$data=array(
				"agent_id" => $agent_list,
				"ware" => $w,
				"date" => date('Y-m-d',strtotime($date)),
				"remarks" => $remarks,
				"date_time" => $this->common->getCurrentDateTime(),
				"by" => $this->common->getUserAddress(),
			);


			$allot_ref_id=0;
			if(empty($allotment_code))
			{
				$code=$this->common->getAllotmentCode();

				$data["allot_code"]=$code;

				$this->db->insert("tbl_allotment",$data);
				$allot_ref_id=$this->db->insert_id();
			}
			else if(!empty($allotment_code)){

				$allot_ref_id=$allotment_code;
				$this->db->where("allot_id",$allotment_code);
				$this->db->update("tbl_allotment",$data);

			}
			


			//$this->db->where("allot_ref_id",$allot_ref_id);
			//$this->db->delete("tbl_room_allotment");

			foreach($combineRoomList as $val){

				//$isValidReservation=0;
					$isValidReservation=$this->room_model->checkingIsValid($cnv_sdate,$cnv_edate,$val[0],"tbl_room_allotment");  
					if(empty($isValidReservation) && $val[0] > 0){


							$getSeasonInfo=$this->common->getSeasonInfo($val[0]);
							$session_id=0;
							$rent=0;
							if(!empty($getSeasonInfo->season_id))
								$session_id=$getSeasonInfo->season_id;

							if(!empty($getSeasonInfo->urent))
								$rent=$getSeasonInfo->urent;

							$data=array(

								"allot_ref_id" => $allot_ref_id,
								"ware" => $w,
								"agent_id" => $agent_list,
								"season_id" => $session_id,
								"room_id" => $val[0],
								"from_date" => $allotment_start_date,
								"to_date" => $allotment_end_date,
								"rent" => $rent,
								"date_time" => $this->common->getCurrentDateTime(),
								"by" => $this->common->getUserAddress(),
								"conv_start_datetime" => $cnv_sdate,
								"conv_end_datetime" => $cnv_edate,
							);

						$this->db->insert("tbl_room_allotment",$data);

					}
			}

			$this->getRoomAllotmentList($allot_ref_id);


		}

		public function getRoomAllotmentList($allot_ref_id)
		{

			$data["list"]=$this->allotment_model->getAllotmentRoomList($allot_ref_id);
			$data["allot_id"]=$allot_ref_id;

			echo json_encode($data);

		}

		public function getAvailabilAllotmentRoomList(){

			$agent_list=$_POST["agent_list"];
			$start_date=$_POST["allotment_start_date"];
			$end_date=$_POST["allotment_end_date"];

			$converted_start_date=strtotime($start_date);
			$converted_end_date=strtotime($end_date);

			$data["list"]=$this->allotment_model->getAvailableRoomList($converted_start_date,$converted_end_date);

			echo json_encode($data);

		}
    }
?>
