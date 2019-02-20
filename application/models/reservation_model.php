<?php 

class Reservation_Model extends CI_Model
{
	
    public function __construct() {

        $this->load->database();

    }

    public function getReservationPayInfo($resv_id){

        $w = $this->common->getSessionUserList(1);

        $resv_type=$this->common->getRoomReservationType();

        $sql="
            select pi.*,b.* from payment_info as pi 
                join
             tbl_pay_bank_info as b on pi.resv_id=b.resv_id 
                where pi.resv_id='".$resv_id."' and pi.pay_type='".$resv_type."'  and b.trace='0' and pi.trace='0' limit 1";
        
        return $this->db->query($sql)->result_array();
    }

    public function getReservationList($table,$resv_code=null){
        $w = $this->common->getSessionUserList(1);


        if(!empty($_GET["resv_code"])){
            $this->db->where("resv_code",$_GET["resv_code"]);
        }
        else if(!empty($_GET["start_date"])){

            $sd=date('Y-m-d',strtotime($_GET["start_date"]));
            $ed=date('Y-m-d',strtotime($_GET["end_date"]));

            $this->db->where("resv_date >=",$sd);
            $this->db->where("resv_date <=",$ed);

        }

        if(!empty($resv_code))
            $this->db->where("resv_id",$resv_code);

        $this->db->order_by("resv_id","desc");
        $this->db->where("ware",$w);

        if(!empty($_GET["agent"]))
            $this->db->where("agent",$_GET["agent"]);

        if(!empty($_GET["status"]))
            $this->db->where("isComplete",$_GET["status"]);
            
          $info=$this->db->get($table)->result_array();   

         // echo $this->db->last_query();

          return $info;

    }

}