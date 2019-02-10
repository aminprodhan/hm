<?php
/**
 * Created by Md. Rimon
 * User: Cursor BD User
 * Date: 1/26/2019
 * Time: 12:49 PM
 */

class Lvlp_model Extends CI_Model
{
    public function getAll($table,$col=null,$val=null){

        $w = $this->session->userdata('ware');
        if(!empty($w))
        {
            $this->db->where("(ware='".$w."' OR ware='0')");
        }

        $this->db->order_by('id','DESC');
        if(!empty($col))
            $this->db->where($col,$val);
        $info=$this->db->get($table);
        return $info->result_array();
    }

    function getRate($itemId)
    {
        $this->db->select();
        $this->db->from('tbl_item');

        $w = $this->session->userdata('ware');
        if(!empty($w))
        {
            $this->db->where("(ware='".$w."' OR ware='0')");
        }

        $this->db->where('id', $itemId);
        $query = $this->db->get();
        return $query->row();
    }

    public function anyName($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null){

        $w = $this->session->userdata('ware');
        if(!empty($col2)){
            $this->db->where($col2,$id2);
        }
        if(!empty($col3)){
            $this->db->where($col3,$id3);
        }
        if(!empty($w))
        {
            $this->db->where("(ware='".$w."' OR ware='0')");
        }

        $this->db->where($col,$id);
        $info=$this->db->get($table);
        foreach($info->result_array() as $val){
            return $val[$name];
        }
    }

    public function getFormatedNo($text,$column,$table){

        $w = $this->session->userdata('ware');

        $currentMonth = date('ym');

        $sql = "SELECT concat('".$text."',".$currentMonth.",count(".$column.") + 1) as auto_id FROM `".$table."` WHERE `".$column."` like '".$text ."". $currentMonth . "%' and ware='" . $w . "' ";

        $query = $this->db->query($sql)->row();

        return $query->auto_id;


    }

    public function getGrandTotal($laundry_bill_id){
        $this->db->select_sum('total');

        $w = $this->session->userdata('ware');

        if(!empty($w))
        {
            $this->db->where("(ware='".$w."' OR ware='0')");
        }

        $this->db->where('laundry_bill_id', $laundry_bill_id);
        $query = $this->db->get('tbl_laundry_bill_details');
        return $query->row();

    }
}