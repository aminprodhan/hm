<?php
/**
 * 
 */
class Common_Model extends CI_Model
{
	function __construct()
	{
		$this->load->model('common');
	}
	public function singleRowSpecificTwoCondition($table,$col,$id,$col2=null,$id2=null,$name,$col3=null,$id3=null){

		$w = $this->common->getSessionUserList(1);;
		
		$module = $this->common->getSessionUserList(4);

		if(!empty($w)){

			$this->db->where("(ware='".$w."' OR ware='0')");

		}

		if(!empty($module))
			$this->db->where("(module='".$module."' OR module='0')");
		
		if(!empty($col2)){
			$this->db->where($col2,$id2);
		}

		if(!empty($col3)){
			$this->db->where($col3,$id3);
		}
		
		$this->db->where($col,$id);
		$info=$this->db->get($table);
		$this->db->order_by("id", "desc");
		
		foreach($info->result_array() as $val){
			return $val[$name];
		}
	}
	public function multiConditionOneRow($table,$field1,$val1,$field2=null,$val2=null,$name,$field3=null,$val3=null,$field4=null,$val4=null,$field5=null,$val5=null)
	{
		$w = $this->common->getSessionUserList(1);;
		$module = $this->common->getSessionUserList(4);

		if(!empty($w))
			$this->db->where("(ware = '".$w."' OR ware='0')");

		if(!empty($module))
			$this->db->where("(module='".$module."' OR module='0')");

		if(!empty($field2))
			$this->db->where($field2,$val2);

		if(!empty($field3))
			$this->db->where($field3,$val3);

		if(!empty($field4))
			$this->db->where($field4,$val4);

		if(!empty($field5))
			$this->db->where($field5,$val5);

		$this->db->where($field1,$val1);
		$check = $this->db->get($table);
		$this->db->order_by("id","asc");

		foreach ($check->result_array() as $value) {
			return $value[$name];
		}
	}
	public function singleRowSpecific($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null){

		$w = $this->common->getSessionUserList(1);;
		
		$module = $this->common->getSessionUserList(4);
		
		if(!empty($w)){

			$this->db->where("(ware='".$w."' OR ware='0')");

		}

		if(!empty($module))
			$this->db->where("(module='".$module."' OR module='0')");
		
		if(!empty($col2)){
			$this->db->where($col2,$id2);
		}

		if(!empty($col3)){
			$this->db->where($col3,$id3);
		}
		

		$this->db->where($col,$id);
		$info=$this->db->get($table);
		foreach($info->result_array() as $val){
			return $val[$name];
		}
	}
	
	public function getAll($table, $col = null, $val = null, $col2 = null,
	    $val2 = null, $col3 = null, $val3 = null,$order=null,$order_val=null)
    {

        $w = $this->common->getSessionUserList(1);;

        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");

        $module = $this->common->getSessionUserList(4);

        if (!empty($module))
            $this->db->where("(module='" . $module . "' OR module='0')");

		if (!empty($order))
			$this->db->order_by($order, $order);
		else if($table != "payment_info")
        	$this->db->order_by('id', 'DESC');

		$this->db->where("trace","0");

        if (!empty($col))
			$this->db->where($col, $val);
			
		if (!empty($col2))
            $this->db->where($col2, $val2);
		
		if (!empty($col3))
            $this->db->where($col3, $val3);
			
		$info = $this->db->get($table);
		
        return $info->result_array();
    } 

    public function getAllData($table, $col = null, $val = null, $col1 = null, $val1 = null)
    {

        $w = $this->common->getSessionUserList(1);;

        //if(!empty($w) && $table != 'setting')
        //$this->db->where('ware',$w);
        //print_r($w);
        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");

        $module = $this->common->getSessionUserList(4);

        if (!empty($module))
            $this->db->where("(module='" . $module . "' OR module='0')");

        $this->db->order_by('id', 'ASC');

        if (!empty($col))
            $this->db->where($col, $val);

        if (!empty($col1))
            $this->db->where($col1, $val1);
        
        $info = $this->db->get($table);
        return $info->result_array();
    }
}