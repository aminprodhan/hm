<?php 
/**
 * admin module
 */
class Admin_Model extends CI_Model
{
	
	function __construct(argument)
	{
		# code...
	}

	public function get_specific($table,$field,$data,$return)
	{
        $w = $this->session->userdata('wire');

        //if(!empty($w) && $table != 'setting')
        //$this->db->where('ware',$w);
        //print_r($w);
        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");

        $module = $this->session->userdata('exes');

        if (!empty($module))
            $this->db->where("(module='" . $module . "' OR module='0')");

        $this->db->get($table);
	}
}

?>