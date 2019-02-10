<?php
class Room_Controller extends CI_Controller
{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			$this->load->model("room_model");
			$this->load->model("common");
			
        }


        public function searchRoomForReservation(){

            $room_start_date = date('Y-m-d',strtotime($_POST['room_start_date']));
            $room_end_date = date('Y-m-d',strtotime($_POST['room_end_date']));        
            $cnv_sdate=strtotime($room_start_date);
            $cnv_edate=strtotime($room_end_date);

            $searchRoomType=$_POST["searchRoomType"];

            $res["list"]=$this->room_model->getAvailableRoomList($cnv_sdate,$cnv_edate,$searchRoomType);
            echo json_encode($res);
            
        }

    public function setRoomForReservation(){

        $room_data = json_decode(stripslashes($_POST['room_data']));
       
        $room_start_date = date('Y-m-d',strtotime($_POST['room_start_date']));
        $room_end_date = date('Y-m-d',strtotime($_POST['room_end_date']));      

        $cnv_sdate=strtotime($room_start_date);
        $cnv_edate=strtotime($room_end_date);

        $resv_id=$isUpdate=$_POST["resv_code"];

        $reservationInfo = json_decode(stripslashes($_POST['reservationInfo']));
        
        $w = $this->common->getSessionUserList(1);
        $resv_code=$this->common->getReservationCode();
       // $resv_id=0;
        foreach($reservationInfo as $val){

            $data_resv=array(
                
                "ware" => $w,
                "resv_date" => date('Y-m-d',strtotime($val[1])),
                "agent" => $val[2],
                "adult" => $val[3],
                "children" => $val[4],
                "season" => $val[5],
                "room_type" => $val[6],
                "resv_type" => $val[7],
                "date_time" => $this->common->getCurrentDateTime(),
                "by" => $this->common->getUserAddress(),
            );

            if(empty($resv_id)){

                $data_resv["resv_code"]=$resv_code;
                $this->db->insert("tbl_reservation",$data_resv);
                $resv_id=$this->db->insert_id();
            }
            else{

                $this->db->where("ware",$w);
                $this->db->where("resv_id",$resv_id);
                $this->db->update("tbl_reservation",$data_resv);
               // $resv_id= $resv_code;
            }

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

            if(empty($isUpdate)){
                
                $this->db->insert("tbl_guest_info",$data_guest);
            }
            else{
                $this->db->where("ware",$w);
                $this->db->where("resv_id",$resv_id);
                $this->db->update("tbl_guest_info",$data_guest);
            }

        }

        if($resv_id > 0){
            foreach($room_data as $r){
             $room_rent=$this->common->getDataRow("tbl_room_info","id",$r[0],"rent");   
             
             $rtype=0;
             if(!empty($room_rent->room_type))
                $rtype=$room_rent->room_type;
                
            $rent=0;
                if(!empty($room_rent->rent))
                   $rent=$room_rent->rent;

            $isValidReservation=$this->room_model->checkingIsValid($cnv_sdate,$cnv_edate,$r[0]);       
            if(empty($isValidReservation)){
                $data_resv=array(
                    
                    "ware" => $w,
                    "resv_id" => $resv_id,
                    "room_id" => $r[0],
                    "start_date" => $room_start_date,
                    "end_date" => $room_end_date,
                    "season" => $val[5],
                    "rent" => $rent,
                    "room_type" => $rtype,
                    "conv_start_datetime" => $cnv_sdate,
                    "conv_end_datetime" => $cnv_edate,
                    "date_time" => $this->common->getCurrentDateTime(),
                    "by" => $this->common->getUserAddress(),
                );

                $this->db->insert("tbl_room_check_in",$data_resv);
            }

            }

        }

        $this->getReservationRoomList($resv_id);
    }

    public function removeReservationRoom(){
        
        $room_data = json_decode(stripslashes($_POST['room_data'])); 
        $resv_id=$isUpdate=$_POST["resv_code"];        
        $w = $this->common->getSessionUserList(1);
        foreach($room_data as $r){
            
            $this->db->where("id",$r[0]);
            $this->db->where("ware",$w);
            $this->db->where("resv_id",$resv_id);
            $this->db->delete("tbl_room_check_in");

        }
        $this->getReservationRoomList($resv_id);

    }

    public function getReservationRoomList($resv_id){

        $res["list"]=$this->room_model->getReservationRoomList($resv_id);
        $res["resv_id"]=$resv_id;

        echo json_encode($res);
    }
 

     public function saveRoomInfo(){

        $dataCombineToJson = json_decode(stripslashes($_POST['dataCombineToJson']));
        //$res["list"]=array();

        $transtype=$_POST["trans_id"];
        $status=0;
        $msg="Data empty.....";
        foreach($dataCombineToJson as $val){

            $isValidRoomNo=$this->room_model->
                anyNameWithoutWare("tbl_room_info","room_no",
                $val[0],"id","ware",$val[1] ,"floor",$val[2] 
            );
                $data=array(
                    "room_no" => $val[0],
                    "ware" => $val[1],
                    "floor" => $val[2],
                    "room_type" => $val[3],
                    "total_bed" => $val[4],
                    "status" => $val[5],
                    "date_time" => $this->common->getCurrentDateTime(),
                );

                $status=0;$msg="";
                if($transtype < 0 && empty($isValidRoomNo))
                   {
                        $this->db->insert("tbl_room_info",$data);
                        $status=1;
                        $msg="Inserted....";
                   } 
                else if($transtype < 0 && !empty($isValidRoomNo)){
                    $status=0;
                    $msg="Data already exist....";
                }
                else if($transtype > 0 && empty($isValidRoomNo) || (
                    $isValidRoomNo == $transtype 
                    && $transtype > 0 && !empty($isValidRoomNo)
                )){ 

                    $this->db->where("id",$transtype);
                    $this->db->update("tbl_room_info",$data);

                    $status=1;
                    $msg="Data Updated....";
                }
               else{
                    $status=0;
                    $msg="Data already exist....";

               }
        }

       
       /* $ara=array(
            "status" => $status,
            "msg" => $msg,
        );
        echo json_encode($ara);*/

        $res["status"]=$status;
        $res["msg"]=$msg;

     }   

     public function getStoredRoomList($res){

       $res["list"]=$this->common->getAllWithoutWare("tbl_room_info");
        echo json_encode($res);

     }

}