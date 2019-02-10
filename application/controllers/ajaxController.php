<?php
class ajaxController extends CI_Controller
{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			$this->load->model("hotelInfoModel");
			$this->load->model("common");
			
        }

        public function getHotelFloorList(){

            $trans_id=$_POST["hid"];
            $res["floorInfo"]=$this->hotelInfoModel->getAllWithoutWare("tblfloorlist","ware",$trans_id);
            echo json_encode($res);

        }

        public function getSpeFloorInfo(){


            $trans_id=$_POST["id"];
            $res["floorInfo"]=$this->hotelInfoModel->getAllWithoutWare("tblfloorlist","floor_id",$trans_id);
            echo json_encode($res);

        }

        public function setRemoveFloorInfo(){

            $hid=$_POST["comboHotelId"];
            $floor_no=$_POST["txtFloorNo"];
            $status=$_POST["status"];
            $update_id=$_POST["update_id"];

            $w=$this->common->getSessionUserList(3);

            $isExists=$this->common->anyNameWithoutWare("tblfloorlist","floor_id",$update_id,"floor_id");
            if(!empty($isExists)){

                $data=array(
                    "by" => $w,
                    "trace" => 1,
                    "date_time" => $this->common->getCurrentDateTime(),
                );
                $this->db->where("floor_id",$update_id);
                $this->db->update("tblfloorlist",$data);

                $res["status"]=1;
                $res["msg"]="Deletion Successfully.....";

            }
            else{

                $res["status"]=0;
                $res["msg"]="Invalid Transaction.....";
            }

            $res["getHotelList"]=$this->hotelInfoModel->getHotelList();
            $res["list"]=$this->hotelInfoModel->getFloorList($hid);

            echo json_encode($res);

        }

        public function updateFloorInfo(){

            $hid=$_POST["comboHotelId"];
            $floor_no=$_POST["txtFloorNo"];
            $status=$_POST["status"];
            $update_id=$_POST["update_id"];

            $isExists=$this->common->anyNameWithoutWare("tblfloorlist","floor_id",$update_id,"floor_id");
            if(!empty($isExists)){

                $data=array(
                    "floor_no" => $floor_no,
                    "ware" => $hid,
                    "status" => $status,
                    "date_time" => $this->common->getCurrentDateTime(),
                );
              //  $this->db->where("ware",)
                $this->db->where("floor_id",$update_id);
                $this->db->update("tblfloorlist",$data);

                $res["status"]=1;
                $res["msg"]="Floor Information Updated......";
            }
            else{

                $res["status"]=0;
                $res["msg"]="Invalid Transaction.....";
            }

            $res["getHotelList"]=$this->hotelInfoModel->getHotelList();
            $res["list"]=$this->hotelInfoModel->getFloorList($hid);

            echo json_encode($res);

        }
        public function saveFloorInfo(){


            $hid=$_POST["comboHotelId"];
            $floor_no=$_POST["txtFloorNo"];
            $status=$_POST["status"];

            $isExists=$this->common->anyNameWithoutWare("tblfloorlist","ware",$hid,"floor_id","floor_no",$floor_no);
            if(!empty($isExists)){

                $res["status"]=0;
                $res["msg"]="Floor Already Created.......";
            }
            else{

                $data=array(
                    "floor_no" => $floor_no,
                    "ware" => $hid,
                    "status" => $status,
                    "date_time" => $this->common->getCurrentDateTime(),
                );
                
                $this->db->insert("tblfloorlist",$data);

               
                $res["status"]=1;
                $res["msg"]="Floor Inserted......";
            }

            $res["getHotelList"]=$this->hotelInfoModel->getHotelList();
            $res["list"]=$this->hotelInfoModel->getFloorList($hid);

            echo json_encode($res);

        }

        public function searchFloorInfo(){

            $searchHotelId=$_POST["searchHotelId"];
            $searchFloorId=$_POST["searchFloorId"];

            $res["getHotelList"]=$this->hotelInfoModel->getHotelList();
            $res["list"]=$this->hotelInfoModel->getFloorList($searchHotelId,$searchFloorId);

            echo json_encode($res);

        }
        
}

?>