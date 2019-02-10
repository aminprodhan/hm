<?php
    class Room_Model extends CI_Model {

        public function __construct() {

            $this->load->database();

        }


        public function getReservationRoomList($resv_id){
            $w = $this->common->getSessionUserList(1);


    $sub_query="SELECT room_id,id as rrid,start_date,end_date,rent FROM `tbl_room_check_in` WHERE
              ware='".$w."' and resv_id='".$resv_id."' group by id";


            $sql="
            select t.rrid, t.start_date,t.end_date, tri.id as rid, tri.room_no,
            tfl.floor_no,t.rent,
            tri.total_bed ,tl.type_name,w.hotel_name
                from(".$sub_query.") as t 
                left join  `tbl_room_info` as tri on t.room_id=tri.id
            left join tblfloorlist as tfl
            on tri.floor=tfl.floor_id and tri.ware=tfl.ware          
            left join type_list as tl on tri.room_type=tl.id
            join ware as w on tri.ware=w.id where w.id='1'       
            group by t.rrid ";

               return $this->db->query($sql)->result_array();

        }

        public function checkingIsValid($cnv_sdate,$cnv_edate,$room_id){
            $w = $this->common->getSessionUserList(1);
            $sub_query="SELECT room_id FROM `tbl_room_check_in` WHERE

            ((".$cnv_sdate." <=   conv_start_datetime
            and ".$cnv_edate." <= conv_end_datetime 
            and ".$cnv_edate." >= conv_start_datetime )

                or (".$cnv_sdate." >= conv_start_datetime 
                  and ".$cnv_edate." <= conv_end_datetime) 

                or (conv_start_datetime >= ".$cnv_sdate."
                  and conv_end_datetime <= ".$cnv_edate.")

                or (".$cnv_sdate." >= conv_start_datetime 
                  and ".$cnv_edate." >= conv_end_datetime 
                  and conv_end_datetime >= ".$cnv_sdate." ))
                  and ware='".$w."' and room_id='".$room_id."' group by id limit 1";

            
            $q=$this->db->query($sub_query)->row();
            if(!empty($q->room_id))
                return 1;

                return 0;

        }

        public function getAvailableRoomList($cnv_sdate,$cnv_edate,$searchRoomType=null){
            $w = $this->common->getSessionUserList(1);

            $rt="";
            if(!empty($searchRoomType))
                $rt=" and tri.room_type='".$searchRoomType."'";

    $sub_query="SELECT room_id FROM `tbl_room_check_in` WHERE

                    (('".$cnv_sdate."' <=   conv_start_datetime
                    and '".$cnv_edate."' <= conv_end_datetime 
                    and '".$cnv_edate."' >= conv_start_datetime )

                or ('".$cnv_sdate."' >= conv_start_datetime 
                          and '".$cnv_edate."' <= conv_end_datetime) 

                or (conv_start_datetime >= '".$cnv_sdate."' 
                          and conv_end_datetime <= '".$cnv_edate."')

                or ('".$cnv_sdate."' >= conv_start_datetime 
                          and '".$cnv_edate."' >= conv_end_datetime 
                          and conv_end_datetime >= '".$cnv_sdate."' ))
                          and ware='".$w."'  group by id";


            $sql="
                SELECT tri.id as rid, tri.room_no,tfl.floor_no,tri.rent,
                tri.total_bed ,tl.type_name,w.hotel_name
                FROM `tbl_room_info` as tri join tblfloorlist as tfl
                on tri.floor=tfl.floor_id and tri.ware=tfl.ware          
                left join type_list as tl on tri.room_type=tl.id
                join ware as w on tri.ware=w.id where w.id='".$w."' and 
                tri.id not in (".$sub_query.")  ".$rt."       
                group by tri.id";

               // return $sql;

               return $this->db->query($sql)->result_array();

        }

        public function anyNameWithoutWare($table, $col, $id, 
        $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null) 
            {
            //$w = $this->session->userdata('wire');
                $w = $this->common->getSessionUserList(1);
                
                if (!empty($col2)) {
                    $this->db->where($col2, $id2);
                }
                if (!empty($col3)) {
                    $this->db->where($col3, $id3);
                }
              //  $this->db->where("status","1");

            //  $this->db->where("(ware='" . $w . "' OR ware='0')");
                
                $this->db->where($col, $id);
                $info = $this->db->get($table);
                foreach ($info->result_array() as $val) {
                    return $val[$name];

                }
        }

        public function getRoomTypeList($table,$col=null,$val=null,
        $col2=null,$asc=null,$col3=null,
        $val3=null,$col4=null,$val4=null){

            $w = $this->session->userdata('wire');				
            $this->db->where("status",'1');

            $this->db->where("(ware='".$w."' OR ware='0')");


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

}