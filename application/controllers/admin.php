<?php

/**
 * hm_home(hotelmanagement_home)
 */

class Admin extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->model('common_model');
        $this->load->model("common");
        $this->load->model("hotelInfoModel");
        $this->load->model("room_model");
    }
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');

		$this->session->set_userdata('admin', 1);	
		$this->session->set_userdata('type', 1);
		$this->session->set_userdata('ware', 1);
		$this->session->set_userdata('module', 0);
	}
	public function add_hotel()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/add_hotel');
		$this->load->view('admin/footer');
	}
	public function hotel_module()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/hotel_module');
		$this->load->view('admin/footer');
	}
    public function floorCreate(){
        $this->load->view('admin/header');
        $data["getHotelList"]=$this->hotelInfoModel->getHotelList();
        $this->load->view('setting/floor_create',$data);
        $this->load->view('admin/footer');
    }
	public function country()
	{
		$this->load->view('admin/header');
		$data['country_get'] = $this->load->common_model->getAll('sett_country','type',1);
    	$data['get_state'] = $this->load->common_model->getAll('sett_country','type',2);
    	$data['get_city'] = $this->load->common_model->getAll('sett_country','type',3);
		$this->load->view('admin/country',$data);
		$this->load->view('admin/footer');
	}
	public function add_country()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

		$add_country_name = $_POST['add_country_name1'];

        if (empty($admin))
        redirect('admin');

		$name = $this->common_model->singleRowSpecificTwoCondition('sett_country','name',$add_country_name,'type',1,'name');
		if($name == $add_country_name){
			echo 2;
		}else{
	        $data = array(
	            "name" => $_POST['add_country_name1'],
	            "p_id" => 0,
	            "type" => 1,
	            "ware" => $w,
	            "pby" => $admin,
	        );
	        $this->db->insert('sett_country', $data);
        	echo 1;
		}
    }


    public function getAllCountryAppend()
	{
		$w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
        redirect('admin');
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		
		
		$country_code = $_POST['country_code'];	
		
		$this->db->where('type', $country_code); 
		$info=$this->db->get('sett_country');
		
		$data=array();
		
		$sl = 0;
		foreach($info->result_array() as $val){
			
			$data['message'][$sl] = $val;
			$sl++;
		}
		echo json_encode($data);
	}

	public function getState()
	{
		$w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
        redirect('admin');
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		$country_change = $_POST['country_change'];	
		
		$this->db->where('p_id', $country_change); 
		$this->db->where('p_id!=', 0); 
		$info=$this->db->get('sett_country');
		
		$data=array();
		
		$sl = 0;
		foreach($info->result_array() as $val){
			
			$data['message'][$sl] = $val;
			$sl++;
		}

		echo json_encode($data);
	}

	public function getAllCountry()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $code = $_POST['code'];

        $this->db->where('type', $code);

        $this->db->where('ware', $w);

        $info = $this->db->get('sett_country');
        $res['posts'] = array();
        foreach ($info->result_array() as $val) {

            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];

            array_push($res['posts'], $post);

        }

        echo json_encode($res);
    }

    public function deleteSingleCountry()
    {

        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

        $id = $_POST['id'];

        $this->db->where('id', $id);
        $this->db->delete('sett_country');

        $resp_post['message'] = 'Successfully Deleted!';

        $this->db->where('ware', $w);
        $this->db->where('type', 1);

        $info = $this->db->get('sett_country');
        $resp_post['posts'] = array();
        foreach ($info->result_array() as $val) {

            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];

            array_push($resp_post['posts'], $post);

        }

        $resp_post['success'] = 1;

        echo json_encode($resp_post);
    }
	public function countryUpdate()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $update_country_btn_id = $_POST['update_country_btn_id'];
        $country_name_update = $_POST['country_name_update'];


      	$check = $this->common_model->singleRowSpecificTwoCondition('sett_country','type','1','name',$country_name_update,'id');
      	
  		if(empty($check)){
  			$data = array(
      			'name' => $country_name_update
      		);
  			$this->db->where('id',$update_country_btn_id);
  			$this->db->update('sett_country',$data);
  			echo 1;
  		}else{
  			echo 2;
  		}
    }
    /* end country function (add, edit, delete)*/
   
    public function add_state()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
        redirect('admin');

        $addState_country_name = $_POST['addState_country1'];
        $addState_state = $_POST['addState_state1'];


        $name = $this->common_model->singleRowSpecificTwoCondition('sett_country','p_id',$addState_country_name,'name',$addState_state,'name');
        if($name == $addState_state){
            echo 2;
        }else{
            $data = array(
                "name" => $addState_state,
                "p_id" => $addState_country_name,
                "type" => 2,
                "ware" => $w,
                "pby" => $admin,
            );
            $this->db->insert('sett_country', $data);
            echo 1;
        }
    }

	public function getAllState()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $code = $_POST['code'];

        $this->db->where('type', $code);

        $this->db->where('ware', $w);

        $info = $this->db->get('sett_country');
        $state_result['states'] = array();
        foreach ($info->result_array() as $val) {

            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['p_id'] = $val['p_id'];

            array_push($state_result['states'], $post);

        }
        echo json_encode($state_result);
    }
    public function update_state()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

        $state_update_id = $_POST['state_update_id'];
        $state_update_name = $_POST['state_update_name'];
        $state_update_country = $_POST['state_update_country'];

        $state_check = $this->common_model->singleRowSpecificTwoCondition('sett_country','p_id',$state_update_country,'name',$state_update_name,'name');
        if($state_check != $state_update_name){
            $data = array(
                'name' => $state_update_name,
                'p_id' => $state_update_country
            );
            $this->db->where('id',$state_update_id);
            $this->db->update('sett_country',$data);

            echo 1;
        }else{
            echo 2;
        }
    }

	public function deleteState()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

        $id = $_POST['del_state'];

        $this->db->where('id', $id);
        $this->db->delete('sett_country');

        $resp_post['message'] = 'Successfully Deleted!';


        $this->db->where('ware', $w);
        $this->db->where('type', 2);

        $info = $this->db->get('sett_country');
        
        $resp_post['states'] = array();
        foreach ($info->result_array() as $val) {
            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['p_id'] = $val['p_id'];

            array_push($resp_post['states'], $post);
        }
        $resp_post['success'] = 1;

        echo json_encode($resp_post);
    }
    /* end all state function (add, edit, delete)*/

    /* start city function (add, edit, delete)*/
    public function get_state_ajax()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;


        $update_city_state_id = $_POST['update_city_state_id'];
        $p_id = $_POST['p_id'];

        $country_id =  $this->common_model->singleRowSpecific('sett_country','id',$p_id,'p_id');

        $this->db->where('ware', $w);
        $this->db->where('type', $update_city_state_id);

        $info = $this->db->get('sett_country');
        
        $resp_post['states'] = array();
        foreach ($info->result_array() as $val) {
            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['p_id'] = $val['p_id'];

            array_push($resp_post['states'], $post);
        }

        $resp_post['message'] = $country_id;

        $resp_post['success'] = 1;

        echo json_encode($resp_post);
    }


    public function city_add()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");

        if (empty($admin))
        redirect('admin');
        
        $city_name = $_POST['city_name1'];
        $state_id = $_POST['state_id1'];

        $city = $this->common_model->singleRowSpecificTwoCondition('sett_country','p_id',$state_id,'name',$city_name,'name');

        if($city == $city_name){
            echo 2;
        }else{
            $data = array(
                "name" => $city_name,
                "p_id" => $state_id,
                "type" => 3,
                "ware" => $w,
                "pby" => $admin
            );
            $this->db->insert('sett_country', $data);
            echo 1;
        }
    }

    public function getAllCity()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $code = $_POST['city_type1'];

        $this->db->where('type', $code);

        $this->db->where('ware', $w);

        $info = $this->db->get('sett_country');
        $city_result['cities'] = array();
        foreach ($info->result_array() as $val) {

            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['p_id'] = $val['p_id'];

            array_push($city_result['cities'], $post);

        }
        echo json_encode($city_result);
    }

    public function update_city()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;
        
        $update_city_id = $_POST['update_city_id'];
        $update_city_state = $_POST['update_city_state'];
        $update_city_name = $_POST['update_city_name'];

        $check = $this->common_model->singleRowSpecificTwoCondition('sett_country','p_id',$update_city_state,'name',$update_city_name,'name');
        if ($check != $update_city_name) {
            $data = array(
                'name' => $update_city_name,
                'p_id' => $update_city_state
            );
            $this->db->where('id',$update_city_id);
            $this->db->update('sett_country',$data);

            echo 1;
        }else{
            echo 2;
        }

    }

	public function delete_city()
	{
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

		$delete_city_id = $_POST['del_city'];

		$this->db->where('id',$delete_city_id);
		$this->db->delete('sett_country');

        $resp_post['message'] = 'Successfully Deleted!';

        $this->db->where('ware', $w);
        $this->db->where('type', 3);

        $get_cities = $this->db->get('sett_country');

        $resp_post['cities'] = array();
        foreach ($get_cities->result_array() as $key => $value) {
        	$post = array();
        	$post['id'] = $value['id'];
            $post['name'] = $value['name'];
        	$post['p_id'] = $value['p_id'];

        	array_push($resp_post['cities'],$post);
        }
        $resp_post['success'] = 1;

        echo json_encode($resp_post);
	}
    /* end country-state-city */
    /* start menu */

    public function menu()
    {
        $this->load->view('admin/header');
        $data['all_module'] = $this->common_model->getAll('sett_modules','status',1);
        $data['menu_all_module'] = $this->common_model->getAll('sett_menu');
        $data['all_main_menu'] = $this->common_model->getAll('sett_menu','type',0);
        $this->load->view('admin/menu',$data);
        $this->load->view('admin/footer');
    }
    public function add_main_menu()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");

        if (empty($admin))
        redirect('admin');


        $main_menu_name = $_POST['main_menu_name1'];
        $main_menu_controller = $_POST['main_menu_controller1'];
        $main_menu_module = $_POST['main_menu_module1'];
 
        //$check = $this->common_model->singleRowSpecific('sett_menu','p_id',0,'name');
        
        $check = $this->common_model->multiConditionOneRow('sett_menu','module',$main_menu_module,'controller',$main_menu_controller,'name');
        //$resp_post['ms'] = $check;
        if($check != $main_menu_name){
            $data = array(
                "name" => $main_menu_name,
                "p_id" => 0,
                "type" => 0,
                "module" => $main_menu_module,
                "controller" => $main_menu_controller,
                "ware" => $w,
                "pby" => $admin
            );
            $this->db->insert('sett_menu', $data);
            echo 1;
        }else{
            echo 2;
        }
    }
    public function update_main_menu()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");

        if (empty($admin))
        redirect('admin');

        $update_main_menu_id = $_POST['update_main_menu_id1'];
        $update_main_menu_name = $_POST['update_main_menu_name1'];
        $update_main_menu_module = $_POST['update_main_menu_module1'];
        $update_main_menu_controller = $_POST['update_main_menu_controller1'];

        $check =  $this->common_model->multiConditionOneRow('sett_menu','module',$update_main_menu_module,'controller',$update_main_menu_controller,'name');

        if($check != $update_main_menu_name){
            $data = array(
                'name' => $update_main_menu_name,
                'module' => $update_main_menu_module,
                'controller' => $update_main_menu_controller
            );
            $this->db->where('id',$update_main_menu_id);
            $this->db->update('sett_menu',$data);
            echo 1;
        }else{
            echo 2;
        }
    }
    public function getAllMenu()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $code = $_POST['menu_type'];

        $this->db->where('type', $code);

        $this->db->where('ware', $w);

        $info = $this->db->get('sett_menu');
        $menu_result['menues'] = array();
        foreach ($info->result_array() as $val) {

            $module =  $this->common_model->singleRowSpecific('sett_modules','id',$val['module'],'name');
            //$module =  'module';

            $post = array();
            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['module'] = $module;
            $post['module_id'] = $val['module'];
            $post['controller'] = $val['controller'];

            array_push($menu_result['menues'], $post);
        }
        echo json_encode($menu_result);
    }
    public function delete_main_menu()
    {
        $w = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

        $delete_menu = $_POST['delete_menu_id'];

        $this->db->where('id', $delete_menu);
        $this->db->delete('sett_menu');

        $resp_post['message'] = 'Successfully Deleted!';

        $this->db->where('ware', $w);
        $this->db->where('type', 1);

        $info = $this->db->get('sett_menu');
        $resp_post['menues'] = array();
        foreach ($info->result_array() as $val) {

            $module =  $this->common_model->singleRowSpecific('sett_modules','id',$val['module'],'name');
            //$module =  'module';

            $post = array();
            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['module'] = $module;
            $post['module_id'] = $val['module'];
            $post['controller'] = $val['controller'];

            array_push($resp_post['menues'], $post);
        }
        
        echo json_encode($resp_post);
    }

    /*public function get_state_ajax()
    {
        $resp_post = array();
        $resp_post['success'] = 0;


        $update_city_state_id = $_POST['update_city_state_id'];
        $p_id = $_POST['p_id'];

        $country_id =  $this->common_model->singleRowSpecific('sett_country','id',$p_id,'p_id');

        $this->db->where('ware', $w);
        $this->db->where('type', $update_city_state_id);

        $info = $this->db->get('sett_country');
        
        $resp_post['states'] = array();
        foreach ($info->result_array() as $val) {
            $post = array();

            $post['id'] = $val['id'];
            $post['name'] = $val['name'];
            $post['p_id'] = $val['p_id'];

            array_push($resp_post['states'], $post);
        }

        $resp_post['message'] = $country_id;

        $resp_post['success'] = 1;

        echo json_encode($resp_post);
    }*/
    public function sub_menu_list_on_change()
    {
        $w = $this->common->getSessionUserList(1);
        $admin = $this->common->getSessionUserList(3);
        if (empty($admin))
            redirect('admin');
        
        $response = array();
        $response['success'] = 0;

        $module_id = $_POST['module_id'];

        $this->db->where('module',$module_id);
        $this->db->get('sett_menu');

    }
    /* main menu view/add/update/delete */
    

    /* start season view/add/update/delete */
    public function season()
    {
        $this->load->view('admin/header');
        $data['all_hotels'] = $this->hotelInfoModel->getHotelList();
        $data['seasons'] = $this->common_model->getAll('sett_season');
        $this->load->view('setting/season',$data);
        $this->load->view('admin/footer');
    }

    public function getAllSeason()
    {
        $w = $this->common->getSessionUserList(1);
        $admin = $this->common->getSessionUserList(3);
        if (empty($admin))
            redirect('admin');

        $this->db->where('ware', $w);

        $info = $this->db->get('sett_season');
        $season_result['all_season'] = array();
        foreach ($info->result_array() as $val) {

            $hotel =  $this->common->anyNameWithoutWare('ware','id',$val['ware'],'hotel_name');

            $post = array();
            $post['id'] = $val['id'];
            $post['season_name'] = $val['season_name'];
            $post['hotel_name'] = $hotel;
            $post['start_date'] = $val['start_date'];
            $post['end_date'] = $val['end_date'];
            array_push($season_result['all_season'], $post);
        }
        echo json_encode($season_result);
    }
    public function add_season()
    {
        $w = $this->common->getSessionUserList(1);
        $admin = $this->common->getSessionUserList(3);

        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");

        if (empty($admin))
        redirect('admin');


        $add_season_hotel = $_POST['add_season_hotel1'];
        $add_season_name = $_POST['add_season_name1'];
        $add_season_start_date = $_POST['add_season_start_date1'];
        $add_season_end_date = $_POST['add_season_end_date1'];
 
        $check = $this->common_model->multiConditionOneRow('sett_season','ware',$add_season_hotel,'season_name',$add_season_name,'season_name');
        

        if($check != $add_season_name){
            $data = array(
                "season_name" => $add_season_name,
                "start_date" => $add_season_start_date,
                "end_date" => $add_season_end_date,
                "ware" => $add_season_hotel,
                "pby" => $admin
            );
            $this->db->insert('sett_season', $data);
            echo 1;
        }else{
            echo 2;
        }
    }

    public function update_season()
    {
        $w = $this->common->getSessionUserList(1);
        $admin = $this->common->getSessionUserList(3);

        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");

        if (empty($admin))
        redirect('admin');

        $update_season_id = $_POST['update_season_row_id'];
        $update_season_hotel = $_POST['update_season_hotel'];
        $update_season_name = $_POST['update_season_name'];
        $update_season_start_date = $_POST['update_season_start_date'];
        $update_season_end_date = $_POST['update_season_end_date'];
 
        $check = $this->common_model->multiConditionOneRow('sett_season','ware',$update_season_hotel,'season_name',$update_season_name,'season_name');
        

        if($check != $update_season_name){
            $data = array(
                "season_name" => $update_season_name,
                "start_date" => $update_season_start_date,
                "end_date" => $update_season_end_date,
                "ware" => $update_season_hotel
            );
            $this->db->where('id', $update_season_id);
            $this->db->update('sett_season', $data);
            echo 1;
        }else{
            echo 2;
        }
    }

    public function delete_season()
    {
        $w = $this->common->getSessionUserList(1);
        $admin = $this->common->getSessionUserList(3);
        if (empty($admin))
            redirect('admin');

        $resp_post = array();
        $resp_post['success'] = 0;

        $delete_season_id = $_POST['delete_season_id'];

        $this->db->where('id',$delete_season_id);
        $this->db->delete('sett_season');

        echo 1;
    }
    /* end season view/add/update/delete */
}