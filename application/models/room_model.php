<?php
    class Room_Model extends CI_Model {

        public function __construct() {

            $this->load->database();

        }


        public function getReservationRoomList($resv_id){
            $w = $this->common->getSessionUserList(1); $w = $this->common->getSessionUserList(1);

            $resv_type=$this->common->anyName("tbl_reservation","resv_id",$resv_id,"resv_type");


    $sub_query="SELECT ware,trace, room_id,id as rrid,start_date,end_date,rent FROM `tbl_room_check_in` as t WHERE
              ware='".$w."' and resv_id='".$resv_id."' and resv_type='".$resv_type."' 
              and (t.ware='".$w."' or t.ware='0') and t.trace='0' group by id";


            $sql="
            select '' bed_no, t.rrid, t.start_date,t.end_date, tri.id as rid, tri.room_no,
            tfl.floor_no,t.rent,
            tri.total_bed ,tl.type_name,w.hotel_name
                from(".$sub_query.") as t 
                left join  `tbl_room_info` as tri on t.room_id=tri.id
            left join tblfloorlist as tfl
            on tri.floor=tfl.floor_id and tri.ware=tfl.ware          
            left join type_list as tl on tri.room_type=tl.id
            join ware as w on tri.ware=w.id where w.id='1'       
            group by t.rrid ";

            $isBed=$this->common->getBedTypeId();
            if($isBed == $resv_type){


                $sql="
                    select rb.bed_no, t.rrid, t.start_date,t.end_date, tri.id as rid, tri.room_no,
                    f.floor_no,t.rent,
                    tri.total_bed ,tl.type_name,w.hotel_name
                        from(".$sub_query.") as t 
                        join  `tbl_room_bed_info` as rb on rb.bed_id=t.room_id                  
                        join tbl_room_info as tri on rb.room_id=tri.id
                        join tblfloorlist as f on tri.floor=f.floor_id
                        join type_list as tl on tri.room_type=tl.id
                        join ware as w on tri.ware=w.id 
                         group by t.rrid ";

            }
        
        
            return $this->db->query($sql)->result_array();

        }

        public function checkingIsValid($cnv_sdate,$cnv_edate,$room_id,$dtable=null,$resv_type=null){


            $table="tbl_room_check_in";
            if(!empty($dtable))
              $table=$dtable;


              $default_resv_type=$this->common->getDefaultReservationType();
              if(!empty($resv_type)){ 
                 $default_resv_type=$resv_type;
              }

              $vtype=" and resv_type='".$default_resv_type."'";

            $w = $this->common->getSessionUserList(1);
            $sub_query="SELECT room_id FROM ".$table." WHERE

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
                  and ware='".$w."' and room_id='".$room_id."' ".$vtype." group by id limit 1";

            
            $q=$this->db->query($sub_query)->row();
            if(!empty($q->room_id))
                return 1;

                return 0;

        }



        public function getAvailableRoomList($cnv_sdate,$cnv_edate,
          $searchRoomType=null,$resv_allot_id=null,$resv_type=null){


            $w = $this->common->getSessionUserList(1);


            
          

            $rt=""; $rt_bed="";
            if(!empty($searchRoomType))
               {
                    $rt=" and tri.room_type='".$searchRoomType."'";
                    $rt_bed=" and t.room_type='".$searchRoomType."'";
               }
                $default_table="tbl_room_check_in";
               
                 $resv_type_col=" and r.resv_type='".$resv_type."'";

               
          


             $sub_query="SELECT room_id FROM ".$default_table." as r WHERE

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
                          and ware='".$w."' ".$resv_type_col."  group by id";



            $join=" left join ";


                $sql_rent="
                    select rent_room_id,rent as urent from (
                          select * from (
                              select r.rent_room_id,r.rent,s.start_date,s.end_date from tbl_rent as r
                               join sett_season as s on r.rent_season=s.id 
                                   where r.trace='0' and (r.ware='0' or r.ware='".$w."') 
                                     and s.trace='0' and (s.ware='0' or s.ware='".$w."') ".$resv_type_col."
                                   order by s.start_date desc ) as t order by end_date desc                             
                                   ) as t group by rent_room_id";
       


                if(!empty($resv_allot_id))
                    {
                        //$default_table="tbl_room_allotment";
                        $join=" join ";
                        $sql_rent="select room_id as rent_room_id,rent as urent 
                           from tbl_room_allotment where allot_ref_id='".$resv_allot_id."' group by room_id";
               
                    }


                    $bed_room_list="SELECT room_id FROM `tbl_room_bed_info` 
                      WHERE (ware='0' or ware='1') and trace='0' and status='0' group by room_id";    

                        $sql="
                              SELECT '' bed_no, tri.id as rid, tri.room_no,tfl.floor_no,rr.urent as rent,
                                   tri.total_bed ,tl.type_name,w.hotel_name
                                   FROM `tbl_room_info` as tri 
                                       join 
                                   tblfloorlist as tfl
                                       on tri.floor=tfl.floor_id and tri.ware=tfl.ware
                                    ".$join." (".$sql_rent.") as  rr on rr.rent_room_id=tri.id         
                                    left join type_list as tl 
                                       on tri.room_type=tl.id
                                    join ware as w 
                                       on tri.ware=w.id where w.id='".$w."' 
                                   and tri.id not in (".$sub_query.") and tri.id not in(".$bed_room_list.")  ".$rt."       
                                   group by tri.id"; 

                                   
                $isBed=$this->common->getBedTypeId();
                    if($isBed == $resv_type){


                        $sql="select t.* ,rr.urent as rent from (

                                 SELECT rb.room_id as rrr, tri.room_type, rb.bed_id as rid,rb.bed_no,0 total_bed,tri.room_no,f.floor_no,
                                        tl.type_name,w.hotel_name
                                        FROM  `tbl_room_bed_info` as rb                   
                                       join tbl_room_info as tri on rb.room_id=tri.id
                                       join tblfloorlist as f on tri.floor=f.floor_id
                                       join type_list as tl on tri.room_type=tl.id
                                       join ware as w on tri.ware=w.id 	
                                       where 
                                         (rb.ware='".$w."' or rb.ware='0') and rb.trace='0' and
                                         (tri.ware='".$w."' or tri.ware='0') and tri.trace='0' and
                                         (f.ware='".$w."' or f.ware='0') and f.trace='0' ) as t
                                         ".$join." (".$sql_rent.") as  rr on rr.rent_room_id=t.rid where 
                                          t.rid not in (".$sub_query.") and t.rrr in(".$bed_room_list.")  ".$rt_bed."       
                                         group by t.rid


                                ";

                               // echo $sql;

                    }
                                   
                                   //echo $sql;


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

?>