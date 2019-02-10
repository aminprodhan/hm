<?php
/**
 * This controller wil be used for the functionality of laundry, valueable deposit, lost found and parking  item
 * L for Laundry, V for Valueable Deposit , L for Lost& Found and P for Parking
 */
class Lvlp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lvlp_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");

    }

    //............................................Laundry Functionaltiy Start.............................................//
    public function laundry_form_view()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $data['all_item'] = $this->lvlp_model->getAll('tbl_item','type','9');
        $data['all_pay_mode'] = $this->lvlp_model->getAll('tbl_item','type','8');
        $data['all_bill'] = $this->lvlp_model->getAll('tbl_laundry_bill');
        $data["voucher_no"]= $this->lvlp_model->getFormatedNo("laun","voucher_no","tbl_laundry_bill");
        $data["ware"]= $ware;
        $data["pby"]= $admin;

        $this->load->view('admin/header');
        $this->load->view('lvlp/laundry',$data);
        $this->load->view('admin/footer');
    }

    public function getVoucherNo()
    {
        $text = $_POST['voucher_name'];
        $array['voucher_no'] = $this->lvlp_model->getFormatedNo($text,"voucher_no","tbl_laundry_bill");
        echo json_encode($array);
    }

    public function getRate()
    {
        $item_id = $_POST['item_id'];
        $array['item_rate'] = $this->lvlp_model->getRate($item_id);
        echo json_encode($array);
    }

    public function addNewLaundryBill()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $laundry_voucher_no = $_POST['laundry_voucher_no'];

        $laundry_bill_id = $this->lvlp_model->anyName('tbl_laundry_bill', 'voucher_no', $laundry_voucher_no, 'id');

        $is_paid = $this->lvlp_model->anyName('tbl_laundry_bill', 'check_in_no', $laundry_voucher_no, 'is_paid');

        if (empty($laundry_bill_id) || $is_paid == 1) {
            $data["check_in_no"] = trim($_POST['laundry_bill_check_in_no']);
            $data["voucher_no"]= $laundry_voucher_no;
            $data["createdDtm"]= date('Y-m-d H:i:s');
            $data["date"]= date('Y-m-d');
            $data["is_paid"]= 2;
            $data["grand_total"] = trim($_POST['laundry_bill_total']);
            $data["ware"]= $ware;
            $data["pby"]= $admin;

            $this->db->insert('tbl_laundry_bill', $data);
            $insert_id = $this->db->insert_id();

            $data1["laundry_bill_id"] = $insert_id;
            $data1["item_no"] = trim($_POST['laundry_bill_item_select']);
            $data1["rate"] = trim($_POST['laundry_bill_item_rate']);
            $data1["quantity"] = trim($_POST['laundry_bill_item_quantity']);
            $data1["total"] = trim($_POST['laundry_bill_total']);
            $data1["date"] = date('Y-m-d');
            $data1["ware"]= $ware;
            $data1["pby"]= $admin;
            $this->db->insert('tbl_laundry_bill_details', $data1);

            $ara = array(
                "id" => 2 //new inserted into two table
            );
        } else {
            $data1 = array(
                "laundry_bill_id" => $laundry_bill_id,
                "item_no" => trim($_POST['laundry_bill_item_select']),
                "rate" => trim($_POST['laundry_bill_item_rate']),
                "quantity" => trim($_POST['laundry_bill_item_quantity']),
                "total" => trim($_POST['laundry_bill_total']),
                "date" => date('Y-m-d'),
                "ware" => $ware,
                "pby" => $admin,
            );
            $this->db->insert('tbl_laundry_bill_details', $data1);

            $grand_total= $this->lvlp_model->getGrandTotal($laundry_bill_id);
            $data["grand_total"]= $grand_total->total ;
            $this->db->where('id', $laundry_bill_id);
            $this->db->update('tbl_laundry_bill', $data);

            $ara = array(
                "id" => 1 // inserted into bill details
            );
        }
        echo json_encode($ara);
    }

    public function getAllItem()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $laundry_voucher_no = $_POST['laundry_voucher_no'];

        $laundry_bill_id = $this->lvlp_model->anyName('tbl_laundry_bill', 'voucher_no', $laundry_voucher_no, 'id');

//        $this->db->select('Details.item_no,Details.rate,Details.quantity,Details.total,Bill.is_paid');
//        $this->db->from('tbl_laundry_bill_details as Details');
//        $this->db->join('tbl_laundry_bill as Bill', 'Bill.id = Details.laundry_bill_id');
//        $this->db->where('Details.laundry_bill_id', $laundry_bill_id);
//        $info = $this->db->get();

        if(!empty($ware)){
            $this->db->where("(ware='".$ware."' OR ware='0')");
        }

        $this->db->where('laundry_bill_id', $laundry_bill_id);
        $info = $this->db->get("tbl_laundry_bill_details");

        $grand_total= $this->lvlp_model->getGrandTotal($laundry_bill_id);

        $res['info'] = array();
        $res['gt'] = $grand_total->total ;

        foreach ($info->result_array() as $val) {

            $post = array();

            $post['item_no'] = $this->lvlp_model->anyName('tbl_item', 'id', $val['item_no'], 'name');
            $post['rate'] = $val['rate'];
            $post['quantity'] = $val['quantity'];
            $post['total'] = $val['total'];
            $post['id'] = $val['id'];
            $post['voucher_no'] = $laundry_voucher_no;

            array_push($res['info'], $post);

        }
        //print_r($res);
        echo json_encode($res);
    }

    public function laundry_bill_status_update(){
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $laundry_voucher_no = $_POST['laundry_voucher_no'];

        if (!empty($laundry_voucher_no)) {
            $data["grand_total"] = trim($_POST['grand_total']);
            $data["pay_mode"] = trim($_POST['pay_mode']);
            $data["is_paid"] = trim($_POST['is_paid']);
            $data["updatedDtm"]= date('Y-m-d H:i:s');

            if(!empty($ware)){
                $this->db->where("(ware='".$ware."' OR ware='0')");
            }
            $this->db->where('voucher_no', $laundry_voucher_no);
            $this->db->update('tbl_laundry_bill', $data);

            $ara = array("id" => 2);//updated in table
        } else {
            $ara = array("id" => 1);// not updated
        }
        echo json_encode($ara);
    }

    public function getAllLaundryBill(){

        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $voucher_no = $_POST['voucher_no'];
        $check_in_no = $_POST['check_in_no'];
        $is_paid = $_POST['is_paid'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        if(!empty($ware)){
            $this->db->where("(ware='".$ware."' OR ware='0')");
        }
        if(!empty($voucher_no)){
            $this->db->where("id",$voucher_no);
        }
        if(!empty($check_in_no)){
            $this->db->where("check_in_no",$check_in_no);
        }
        if(!empty($is_paid)){
            $this->db->where("is_paid",$is_paid);
        }
        if(!empty($from_date)&& !empty($to_date)){
            $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
        }

        $this->db->order_by('voucher_no','asc');
        $info = $this->db->get("tbl_laundry_bill");

        $res["list"]=array();

        foreach($info->result_array() as $val){

            if($val['is_paid'] == '2'){
                $yesno = 'No';
                $style= "Tomato";
            }elseif($val['is_paid'] == '1'){
                $yesno = 'Yes';
                $style= "MediumSeaGreen";
            }else{
                $yesno = 'None';
            }

            $post=array();
            $post["id"]=$val["id"];
            $post["voucher_no"]=$val["voucher_no"];
            $post["check_in_no"]=$val["check_in_no"];
            $post["is_paid"]=$yesno;
            $post["style"]=$style;
            $post["grand_total"]=$val["grand_total"];
            if($this->lvlp_model->anyName('tbl_item', 'id', $val["pay_mode"], 'name')) {
                $post["pay_mode"] = $this->lvlp_model->anyName('tbl_item', 'id', $val["pay_mode"], 'name');
            }
            else{
                $post["pay_mode"]= "Not Paid Yet";
            }
            $post["date"]=$val["date"];

            array_push($res["list"],$post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getBillInfo()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $laundry_voucher_no = $_POST['voucher_no'];

        if(!empty($ware)){
            $this->db->where("(ware='".$ware."' OR ware='0')");
        }
        $this->db->where('voucher_no', $laundry_voucher_no);
        $info = $this->db->get("tbl_laundry_bill");

        $res["info"] =  $info->row();

        //print_r($res);
        echo json_encode($res);
    }

    public function delete_laundry_item()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $laundry_bill_details_id = $_POST['id'];
        $laundry_voucher_no = $_POST['voucher_no'];

        if(!empty($laundry_bill_details_id)){
            if(!empty($ware)){
                $this->db->where("(ware='".$ware."' OR ware='0')");
            }
            $this->db->where('id', $laundry_bill_details_id);
            $this->db->delete("tbl_laundry_bill_details");

            $laundry_bill_id = $this->lvlp_model->anyName('tbl_laundry_bill', 'voucher_no', $laundry_voucher_no, 'id');

            $grand_total= $this->lvlp_model->getGrandTotal($laundry_bill_id);
            $data["grand_total"]= $grand_total->total ;
            $this->db->where('id', $laundry_bill_id);
            $this->db->update('tbl_laundry_bill', $data);

            $ara = array("id" => 2);//deleted in table
        }else {
            $ara = array("id" => 1);// not deleted
        }
        echo json_encode($ara);

    }

    //............................................Laundry Functionaltiy End.............................................//

    //............................................valueable Deposit Functionaltiy Start.............................................//

    public function valueable_deposit_form_view()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $data['all_item'] = $this->lvlp_model->getAll('tbl_item','type','7');

        $data['all_pay_mode'] = $this->lvlp_model->getAll('tbl_item','type','8');

        $data['all_deposit'] = $this->lvlp_model->getAll('tbl_laundry_bill');

        $data["deposit_no"]= $this->lvlp_model->getFormatedNo("depo","deposit_no","tbl_valueable_deposit");
        $data["ware"]= $ware;
        $data["pby"]= $admin;

        $this->load->view('admin/header');
        $this->load->view('lvlp/valueable_deposit',$data);
        $this->load->view('admin/footer');
    }

    public function addNewDeposit()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $deposit_no = $_POST['deposit_no'];

        $deposit_id = $this->lvlp_model->anyName('tbl_valueable_deposit', 'deposit_no', $deposit_no, 'id');

        $is_return = $this->lvlp_model->anyName('tbl_valueable_deposit', 'check_in_no', $deposit_no, 'is_return');

        if (empty($deposit_id) || $is_return == 1) {
            $data["deposit_no"]= $deposit_no;
            $data["check_in_no"] = trim($_POST['deposit_check_in_no']);
            $data["is_return"]= 2; //2 means no
            $data["remarks"] = trim($_POST['deposit_remarks']);
            $data["date"]= date('Y-m-d');
            $data["createdDtm"]= date('Y-m-d H:i:s');
            $data["ware"]= $ware;
            $data["pby"]= $admin;

            $this->db->insert('tbl_valueable_deposit', $data);
            $insert_id = $this->db->insert_id();

            $data1["deposit_id"] = $insert_id;
            $data1["item_no"] = trim($_POST['deposit_item_select']);
            $data1["quantity"] = trim($_POST['deposit_item_quantity']);
            $data1["balance"] = trim($_POST['deposit_balance']);
            $data1["remarks"] = trim($_POST['deposit_remarks']);
            $data1["deposit_date"] = date('Y-m-d');
            $data1["ware"]= $ware;
            $data1["pby"]= $admin;
            $this->db->insert('tbl_valueable_deposit_details', $data1);

            $ara = array(
                "id" => 2 //new inserted into two table
            );
        } else {
            $data1["deposit_id"] = $deposit_id;
            $data1["item_no"] = trim($_POST['deposit_item_select']);
            $data1["quantity"] = trim($_POST['deposit_item_quantity']);
            $data1["balance"] = trim($_POST['deposit_balance']);
            $data1["remarks"] = trim($_POST['deposit_remarks']);
            $data1["deposit_date"] = date('Y-m-d');
            $data1["ware"]= $ware;
            $data1["pby"]= $admin;
            $this->db->insert('tbl_valueable_deposit_details', $data1);

//            $grand_total= $this->lvlp_model->getGrandTotal($laundry_bill_id);
//            $data["grand_total"]= $grand_total->total ;
//            $this->db->where('id', $laundry_bill_id);
//            $this->db->update('tbl_laundry_bill', $data);

            $ara = array(
                "id" => 1 // inserted into bill details
            );
        }
        echo json_encode($ara);
    }

    public function getDepositItem()
    {
        $ware = $this->session->userdata('ware');
        $admin = $this->session->userdata('admin');

        $deposit_no = $_POST['deposit_no'];

        $deposit_id = $this->lvlp_model->anyName('tbl_valueable_deposit', 'deposit_no', $deposit_no, 'id');

//        $this->db->select('Details.item_no,Details.rate,Details.quantity,Details.total,Bill.is_paid');
//        $this->db->from('tbl_laundry_bill_details as Details');
//        $this->db->join('tbl_laundry_bill as Bill', 'Bill.id = Details.laundry_bill_id');
//        $this->db->where('Details.laundry_bill_id', $laundry_bill_id);
//        $info = $this->db->get();

        if(!empty($ware)){
            $this->db->where("(ware='".$ware."' OR ware='0')");
        }

        $this->db->where('deposit_id', $deposit_id);
        $info = $this->db->get("tbl_valueable_deposit_details");

        //$grand_total= $this->lvlp_model->getGrandTotal($laundry_bill_id);

        $res['info'] = array();
        //$res['gt'] = $grand_total->total ;

        foreach ($info->result_array() as $val) {

            $post = array();

            $post['id'] = $val['id'];
            $post['item_no'] = $this->lvlp_model->anyName('tbl_item', 'id', $val['item_no'], 'name');
            $post['quantity'] = $val['quantity'];
            $post['balance'] = $val['balance'];
            if($val['return_quantity']){
                $post['return_quantity'] = $val['return_quantity'];
            }else{
                $post['return_quantity'] = 0;
            }
            if($val['return_date']){
                $post['return_date'] = $val['return_date'];
            }else{
                $post['return_date'] = "Not Returned Yet";
            }
            if($val['remarks']){
                $post['remarks'] = $val['remarks'];
            }else{
                $post['remarks'] = "No Remarks";
            }

            $post['deposit_no'] = $deposit_no;

            array_push($res['info'], $post);

        }
        //print_r($res);
        echo json_encode($res);
    }

    //............................................valueable Deposit Functionaltiy End.............................................//
}
?>