<?php
    class Allotment_Model extends CI_Model
    {
        function __construct()
        {
            $this->load->database();
        }


      /*  public function getAllotmentRoomList($resv_id){
            $w = $this->common->getSessionUserList(1); $w = $this->common->getSessionUserList(1);


    $sub_query="SELECT room_id,id as rrid,from_date,to_date,rent FROM `tbl_room_allotment` WHERE
              ware='".$w."' and allot_id='".$resv_id."' group by id";


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

        }*/

        public function getAllotmentPayInfo($allot_id){

            $w = $this->common->getSessionUserList(1);
    
            $resv_type=$this->common->getAllotmentType();
    
            $sql="
                select pi.*,b.* from payment_info as pi 
                    join
                 tbl_pay_bank_info as b on pi.resv_id=b.resv_id 
                    where pi.resv_id='".$allot_id."' and pi.pay_type='".$resv_type."'
                      and b.trace='0' and pi.trace='0' limit 1";

            // echo $sql;
            
            return $this->db->query($sql)->result_array();
        }

        public function getAllotmentList($table,$allot_id=null){
            $w = $this->common->getSessionUserList(1);
    
    
            if(!empty($_GET["allot_code"])){
                $this->db->where("allot_code",$_GET["allot_code"]);
            }
            else if(!empty($_GET["start_date"])){
    
                $sd=date('Y-m-d',strtotime($_GET["start_date"]));
                $ed=date('Y-m-d',strtotime($_GET["end_date"]));
    
                $this->db->where("date >=",$sd);
                $this->db->where("date <=",$ed);
    
            }
    
            if(!empty($allot_id))
                $this->db->where("allot_id",$allot_id);
    
            $this->db->order_by("allot_id","desc");

            $this->db->where("ware",$w);
    
            if(!empty($_GET["agent"]))
                $this->db->where("agent_id",$_GET["agent"]);
    
            if(!empty($_GET["status"]))
                $this->db->where("isComplete",$_GET["status"]);
                
              $info=$this->db->get($table)->result_array();   
    
             // echo $this->db->last_query();
    
              return $info;
    
        }

        public function getAllotmentRoomList($allot_id){

            $w = $this->common->getSessionUserList(1);

            $sql="select 
           tra.id as rid, tri.room_no,tra.from_date,tra.to_date,tra.rent,
             s.season_name,a.name as agent_name,f.floor_no
             from tbl_room_allotment as tra 
                 left join tbl_room_info as tri on tra.room_id=tri.id
                 left join sett_season as s on s.id=tra.season_id
                 left join agent_list a on a.id=tra.agent_id 
                 left join tblfloorlist as f on f.floor_id=tri.floor
                    where 1 and tra.allot_ref_id='".$allot_id."' 
                     and tra.ware='".$w."' and tra.trace='0'  group by tra.id";
            
            return $this->db->query($sql)->result_array();
                

        }


        public function getAvailableRoomList($cnv_sdate,$cnv_edate,$searchRoomType=null){
        
            $w = $this->common->getSessionUserList(1);
            $rt="";
           
           /*$sub_query="SELECT room_id FROM `tbl_room_allotment` WHERE
    
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
                          and ware='".$w."' group by id";*/

            
            $sub_query="SELECT room_id FROM `tbl_room_allotment` WHERE release_status='1' and ware='".$w."' and trace='0' group by id ";

            $sql_rent="
                select rent_room_id,rent as urent from (
                select * from (
                    select r.rent_room_id,r.rent,s.start_date,s.end_date from tbl_rent as r
                     join sett_season as s on r.rent_season=s.id 
                         where r.trace='0' and (r.ware='0' or r.ware='".$w."') 
                           and s.trace='0' and (s.ware='0' or s.ware='".$w."')
                         order by s.start_date desc ) as t order by end_date desc 
                         
                         ) as t group by rent_room_id";

    
    
            $sql="
                SELECT tri.id as rid, tri.room_no,tfl.floor_no,rr.urent as rent,
                tri.total_bed ,tl.type_name,w.hotel_name
                FROM `tbl_room_info` as tri 
                    join 
                tblfloorlist as tfl
                    on tri.floor=tfl.floor_id and tri.ware=tfl.ware
                left join (".$sql_rent.") as  rr on rr.rent_room_id=tri.id         
                left join type_list as tl 
                    on tri.room_type=tl.id
                join ware as w 
                    on tri.ware=w.id where w.id='".$w."' 
                and tri.id not in (".$sub_query.")  ".$rt."       
                group by tri.id";
    
               // return $sql;
    
               return $this->db->query($sql)->result_array();
    
        }
    }
?>