<?php

    class Common extends CI_Model 
        {

            public function __construct() {

                $this->load->database();

            }

            public function getDataRow($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null) {
                //$w = $this->session->userdata('wire');
                $w = $this->getSessionUserList(1);
        
                
                if (!empty($col2)) {
                    $this->db->where($col2, $id2);
                }
                if (!empty($col3)) {
                    $this->db->where($col3, $id3);
                }
                $this->db->where("trace","0");

                $this->db->where("(ware='" . $w . "' OR ware='0')");
                
                $this->db->where($col, $id);
               return $info = $this->db->get($table)->row();
               
            }

            public function getReservationCode(){

                $w = $this->getSessionUserList(1);

                $sql="SELECT concat('resv-201902-', (
                    resv_code  +1 )
                     ) AS code from(
                     select ifNull(max(resv_id),'0') as resv_code 
                     from tbl_reservation where ware='".$w."' and trace='0') as t";

              $q=$this->db->query($sql)->row();
              
              if(!empty($q->code))
                return $q->code;

                return 0;

            }

            public function getUserAddress(){
	
                $host=gethostname();
                $ip=$this->input->ip_address();
                $by=$this->getSessionUserList(3);
                $details="Pc Name : ".$host.",Ip Address: ".$ip.", user id:".$by;
                
                return $details;
            
            
            }

            public function getAllWithoutWare($table,$col=null,$val=null,
            $col2=null,$asc=null,$col3=null,
            $val3=null,$col4=null,$val4=null){
	
                $w = $this->getSessionUserList(1);		

                $this->db->where("trace",'0');
                $this->db->order_by($col2,$asc);	
                if(!empty($col))
                    $this->db->where($col,$val);
                
                if(!empty($val3))
                    $this->db->where($col3,$val3);
                    
                if(!empty($col4))
                    $this->db->where($col4,$val4);

                $info=$this->db->get($table);           
                return $info->result_array();
    

            }
            public function anyNameWithoutWare($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null) {
                //$w = $this->session->userdata('wire');
                $w = $this->getSessionUserList(1);
        
                
                if (!empty($col2)) {
                    $this->db->where($col2, $id2);
                }
                if (!empty($col3)) {
                    $this->db->where($col3, $id3);
                }
                $this->db->where("trace","0");

               // $this->db->where("(ware='" . $w . "' OR ware='0')");
                
                $this->db->where($col, $id);
                $info = $this->db->get($table);
                foreach ($info->result_array() as $val) {
                    return $val[$name];
                }
            }



            public function anyName($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null) {
                //$w = $this->session->userdata('wire');
                $w = $this->getSessionUserList(1);
        
                
                if (!empty($col2)) {
                    $this->db->where($col2, $id2);
                }
                if (!empty($col3)) {
                    $this->db->where($col3, $id3);
                }
                $this->db->where("trace","0");

                $this->db->where("(ware='" . $w . "' OR ware='0')");
                
                $this->db->where($col, $id);
                $info = $this->db->get($table);
                foreach ($info->result_array() as $val) {
                    return $val[$name];
                }
            }
        public function getSessionUserList($getSessionId){
       
                $admin=1;	
                $type=1;	
                $w=1;
                $module=4;  

            $ara=array(

                "1" => $w,
                "2" => $type,
                "3" => $admin,
                "4" => $module,

            );
           if(!empty($ara[$getSessionId]))
                return $ara[$getSessionId];
            else
                return 0;
    
            
    
        }
        public function getCurrentDateTime(){
		
		
            $date_time = new DateTime('now', new DateTimezone('Asia/Dhaka'));
           $hours=$date_time->format('G'); 
           $date_time=$date_time->format('Y-m-d G:i:s');
           
           return $date_time;
       }
            
        }

?>