<?php

        class HotelInfoModel extends CI_Model {

            public function __construct() {

                $this->load->database();

            }

            public function getAllWithoutWare($table,$col=null,$val=null,
            $col2=null,$asc=null,$col3=null,
            $val3=null,$col4=null,$val4=null){
	
                $w = $this->session->userdata('wire');				
                
                
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

            public function getAll($table,$col=null,$val=null,
            $col2=null,$asc=null,$col3=null,
            $val3=null,$col4=null,$val4=null){
	
                $w = $this->session->userdata('wire');				
                $this->db->where("(ware='".$w."' OR ware='0')");
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
            public function getHotelList(){


                $utype=$this->common->getSessionUserList(2);
                $w=$this->common->getSessionUserList(1);

                if($utype != 1)
                    $this->db->where("id",$w);

                $this->db->where("trace","0");
                return $info=$this->db->get("ware")->result_array();

            }
           public function getFloorList($hid=null,$floor_no=null){

                if(!empty($hid))
                    $this->db->where("ware",$hid);

                if(!empty($floor_no))
                    $this->db->where("floor_no",$floor_no);
                
                $this->db->where("trace","0");
                
                return $info=$this->db->get("tblfloorlist")->result_array();
           }

        }

?>