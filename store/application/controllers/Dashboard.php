<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->model("utils");
        $this->load->model("users");
        $this->load->model("stock");
        $this->load->model("settings");
        $this->load->model("invoice");
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }
    }

    function index()
    {
		 if($this->users->get_user_by_username($this->session->userdata("username"))->role=="Sales Representative"){
			redirect('dashboard/pos');
		}
		
        $data = array();
        $data['page'] = 'dashboard';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function waiting_for_approval(){
        if($this->db->get_where('login_session',['SN'=>$this->session->userdata('session_id')])->row()->status == "APPROVED"){
            redirect('dashboard/pos');
        }else{
            $this->load->view('page/waiting_for_approval');
        }
    }

    function stock()
    {
        $data = array();
        $data['page'] = 'stock';
        $this->load->model("stock");
        if($this->stock->getUserDepartment() !="Top Administrator"){
            $data['stocks'] = $this->stock->getStocks(array('department'=>$this->stock->getUserDepartment()));
        }else{
            $data['stocks'] = $this->stock->getStocks();
        }
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }
    function stock_by_department()
    {
        $data = array();
        $data['page'] = 'stockby_department';
        $this->load->model("stock");
        if(isset($_POST['department'])){
            $department = $_POST['department'];
        }else{
            $de =[];
            $dpts = $this->stock->getDepartments();
            foreach($dpts as $dpt) {
                if ($dpt['type'] != "Service") {
                    $de[] = $dpt['department'];
                }
            }
            $department = $de[0];
            $_POST['department'] = $department;
        }
        $data['stocks'] = $this->stock->getStocks(array('department'=>$department));
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }




    function stock_expiry()
    {
        $data = array();
        $data['page'] = 'stock_batch_expiry';
        $this->load->model("stock");
        $data['stocks'] = $this->stock->getStocks();
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    function stock_expiry_product($batch_id)
    {
        $data = array();
        $data['page'] = 'stock_expiry';
        $this->load->model("stock");
        $data['batch_id'] = $batch_id;
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function out_of_stock()
    {
        $data = array();
        $data['page'] = 'out_of_stock';
        $this->load->model("stock");
        $data['stocks'] = $this->stock->getStocks();
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    function set_availability($product_id,$status){
        $this->db->where("SN",$product_id)->update("stock",array('status'=>$status));
        $this->session->set_flashdata("success","Operation Successfull!!...");
        redirect('dashboard/stock');
    }
    function new_stock()
    {
        $data = array();
        $this->load->model("stock");
        $data['page'] = 'new_stock';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function save_new_stock(){
        $data = $_POST;

        $data['image'] = '';
        $data['product_description'] = $_POST['product_description'];

        if($_POST['expiry_status'] == "yes"){
            $exp = $_POST['expired_date'];
        }else{
            $exp = false;
        }

        if($this->db->get_where("stock",array("product_name"=>$_POST['product_name']))->num_rows() > 0){
            $this->session->set_flashdata("error","Product Already Exist");
            redirect('dashboard/new_stock');
        }

        $this->session->set_flashdata("success","Stock Added Successfully!!...");
        $this->load->model("stock");
        if(isset($_POST['quantity'])){
            $qty = $_POST['quantity'];
        }else{
            $qty = $_POST['cartoon_qty'];
        }
		unset($data['quantity']);
		unset($data['cartoon_qty']);
		$product_id = $this->stock->add($data);
        if((int)$qty > 0) {

            $this->stock->recieve_stock_single($qty , $product_id, $exp);
        }
        redirect('dashboard/new_stock');
    }

    function edit_stock($stock_id){
        $data = array();
        $this->load->model("stock");
        $data['page'] = 'edit_stock';
        $data['stock'] = $this->stock->getStock($stock_id)[0];

        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function update_stock($stock_id){
        $this->load->model("stock");
        $stock =$this->stock->getStock($stock_id);
        $pre_image = $stock['image'];
        if(!empty($stock['image'])){
            unlink('product_image/'.$stock['image']);
        }
        if(is_uploaded_file($_FILES['image']) && file_exists($_FILES['image']['tmp_name'])){
            $image = time()."-".date('d').'.'.(pathinfo($_FILES['image']['name'])['extension']);
            move_uploaded_file($_FILES['image']['tmp_name'],'product_image/'.$image);
        }else{
            $image = '';
        }

        $data = $_POST;

        $data['image'] = $image;

        $this->session->set_flashdata("success","Stock Updated Successfully!!...");

        $this->stock->update($stock_id,$data);
        redirect('dashboard/stock');
    }


    function checkifBarcodeExist($code){
        $code = $this->db->get_where("stock",array("bar_code_code"=>$code));
        if($code->num_rows() > 0){
            die(json_encode(array("status"=>false)));
        }else{
            die(json_encode(array("status"=>true)));
        }
    }

    function checkifBarcodeExist2($code){
        $code = $this->db->get_where("stock",array("bar_code_code"=>$code));
        if($code->num_rows() > 0){
            die(json_encode(array("status"=>true,'data'=>$code->row_array())));
        }else{
            die(json_encode(array("status"=>false)));
        }
    }

    function move_to_sales_arena($stock_id){
        $this->load->model("stock");
        if(count($_POST)){
            $stock =$this->stock->getStock($stock_id);
            $qty = ( $stock['quantity'] -$_POST['qty_to_move'] );
            $new_m_qty =  $stock['quantity_arena']+ $_POST['qty_to_move'] ;

            if(!($qty < 0)){
                $this->db->where("SN",$stock_id)->update("stock",array("quantity"=>$qty,"quantity_arena"=>$new_m_qty));
                $array_insert = array(
                    'stock_id'=>$stock_id,
                    'from'=>'Store',
                    'to'=> 'Sales Arena',
                    'date'=>date('Y-m-d'),
                    'qty_moved'=>$_POST['qty_to_move'],
                    'remaining_qty'=>$qty
                );
                $this->db->insert("moved_history",$array_insert);
                $this->session->set_flashdata("success","Stock Moved to Sales Arena Successfully!!..");
                redirect("dashboard/stock");
            }else{
                $this->session->set_flashdata("error ","Insufficient Quantity to Moved, Check and try Again..");
                redirect("dashboard/move_to_sales_arena/".$stock_id);
            }
        }
        $this->load->model("stock");
        $data['page'] = 'move_to_sales_arena';
        $data['stock'] = $this->stock->getStock($stock_id);
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function move_to_store($stock_id){
        $this->load->model("stock");
        if(count($_POST)){
            $stock =$this->stock->getStock($stock_id);
            $qty = ($stock['quantity_arena'] - $_POST['qty_to_move']);
            $new_m_qty =  $stock['quantity']+ $_POST['qty_to_move'] ;
            if(!($qty < 0)){
                $this->db->where("SN",$stock_id)->update("stock",array("quantity"=>$new_m_qty,"quantity_arena"=>$qty));
                $array_insert = array(
                    'stock_id'=>$stock_id,
                    'from'=>'Sales Arena',
                    'to'=> 'Store',
                    'date'=>date('Y-m-d'),
                    'qty_moved'=>$_POST['qty_to_move'],
                    'remaining_qty'=>$new_m_qty
                );
                $this->db->insert("moved_history",$array_insert);
                $this->session->set_flashdata("success","Stock Moved back to Store Successfully!!..");
                redirect("dashboard/stock");
            }else{
                $this->session->set_flashdata("error","Insufficient Quantity to Moved, Check and try Again..");
                redirect("dashboard/move_to_store/".$stock_id);
            }
        }
        $this->load->model("stock");
        $data['page'] = 'move_to_store';
        $data['stock'] = $this->stock->getStock($stock_id);
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function settings($user_id=FALSE){
        if(isset($_GET['del']) && $user_id!=FALSE){
            $this->db->set('activated', $_GET['del']);
            $this->db->where('SN', $user_id);
            $this->db->update('users');
            redirect('dashboard/settings');
        }

        if(count($_POST)>0){
            $this->load->library("tank_auth");
            $user = $this->tank_auth->create_user($_POST['username'],$_POST['email'],$_POST['password'],0,$_POST['role'],$this->config->item('email_activation', 'tank_auth'));
            $this->db->where("SN",$user['user_id'])->update("users",$_POST['extra']);
            redirect('dashboard/settings');
        }
        $data = array();
        $data['page'] = 'settings';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function edit_settings($user_id){
        if(count($_POST)>0){
            foreach($_POST['extra'] as $key=>$val){
                $_POST[$key] = ucwords($val);
            }
            unset($_POST['extra']);
            $this->db->where("SN",$user_id)->update("users",$_POST);
            $this->session->set_flashdata("success","Profile was updated successfully!");
            redirect('dashboard/settings');
        }
        $data = array();
        $data['page'] = 'edit_settings';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function user_manager(){
        redirect('dashboard/settings');
    }


    function manufacturer(){
        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addManufacturer($_POST);
            $this->session->set_flashdata("success","Manufacturer Added Successfully!!...");
            redirect('dashboard/manufacturer');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->delete("manufacturer");
            $this->session->set_flashdata("success","Manufacturer deleted Successfully!!...");
            redirect('dashboard/manufacturer');
        }
        $data = array();
        $data['page'] = 'manufacturer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    function supplier(){

        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addSupplier($_POST);
            $this->session->set_flashdata("success","Supplier Added Successfully!!...");
            redirect('dashboard/supplier');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->delete("supplier");
            $this->session->set_flashdata("success","Supplier deleted Successfully!!...");
            redirect('dashboard/supplier');
        }

        $data = array();
        $data['page'] = 'supplier';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function branch(){
        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addBranch($_POST);
            $this->session->set_flashdata("success","Branch Added Successfully!!...");
            redirect('dashboard/branch');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->update("branch",array("delete_status"=>"1"));
            $this->session->set_flashdata("success","Branch deleted Successfully!!...");
            redirect('dashboard/branch');
        }

        $data = array();
        $data['page'] = 'branch';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function stock_transfer(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'stock_transfer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function new_transfer(){
        $this->load->model("stock");
        if(count($_POST)){
            $this->stock->transfer_stock($_POST);
            $this->session->set_flashdata("success","Stock Transfer has been added Successfully!!...");
            redirect('dashboard/new_transfer');
        }
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'new_transfer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function new_transfer_branch(){
        $this->load->model("stock");
        if(count($_POST)){
            $this->stock->transfer_stock($_POST);
            $this->session->set_flashdata("success","Stock Transfer has been added Successfully!!...");
            redirect('dashboard/new_transfer_branch');
        }
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'new_transfer_branch';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function viewtransfer(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'view_transfer';
        $data['transfer'] = $this->stock->getTransferByTransferID($this->uri->segment(3));
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function edit_transfer(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'edit_transfer';
        $data['transfer'] = $this->stock->getTransferByTransferID($this->uri->segment(3));

        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function update_transfer($transfer_id){
        $this->load->model("stock");
        $this->stock->update_stock($transfer_id,$_POST);
        $this->session->set_flashdata("success","Stock Transfer has been updated Successfully!!...");
        redirect("dashboard/viewtransfer/".$transfer_id);
    }

    public function stock_recieved(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'stock_recieved';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function login_session(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'login_session';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function decline_session($id){
        $this->db->where('SN',$id)->update('login_session',['status'=>'PENDING']);
        $this->session->set_flashdata("success","Session has been decline successfully!..");
        $this->session->set_flashdata("success","Stock Received has been added Successfully!!...");
        redirect('dashboard/login_session');
    }

    public function approve_session($id){
        $this->db->where('SN',$id)->update('login_session',['status'=>'APPROVED']);
        $this->session->set_flashdata("success","Session has been approved successfully!..");
        redirect('dashboard/login_session');
    }

    public function stock_recieved_single(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'stock_single_recieved';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function recieved_single_product($product_id){
        $update_stock = array(
            'cost_price'=>$_POST['cost_price'],
            'price'=>$_POST['price'],
            'item_packed'=>$_POST['item_packed'],
            'whole_cost_price'=>$_POST['whole_cost_price'],
            'whole_price'=>$_POST['whole_price']
        );
        $this->stock->update($product_id,$update_stock);
        unset($_POST['cost_price']);
        unset($_POST['price']);
        unset($_POST['item_packed']);
        unset($_POST['whole_cost_price']);
        unset($_POST['whole_price']);

        if(isset($_POST['expiry_date'])){
            $exp = $_POST['expiry_date'];
        }else{
            $exp = false;
        }

        $this->stock->recieve_stock_single($_POST['qty'],$product_id,$exp);
        $this->session->set_flashdata("success","Stock Received has been added Successfully!!...");
        redirect('dashboard/stock_recieved_single');
    }

    public function new_recieved_supplier(){
        $this->load->model("stock");
        if(count($_POST) >0){
            foreach($_POST as $key=>$value){
                if(!is_array($value) && $key!="transfer_note"){
                    if(empty($value)){
                        $this->session->set_flashdata("error","All Fields are required, Plese check form and try again");
                        redirect('dashboard/new_recieved_supplier');
                    }
                }

            }

            if(isset($_POST['product']) && count($_POST['product']) >0){
                $this->stock->recieve_stock($_POST);
                $this->session->set_flashdata("success","Stock Received has been added Successfully!!...");
            }else{
                $this->session->set_flashdata("error","No Product added, Please check and try again..");
            }
            redirect('dashboard/new_recieved_supplier');
        }
        $data = array();
        $data['page'] = 'new_recieved_supplier';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }
    public function new_recieved_branch(){
        $this->load->model("stock");
        if(count($_POST) >0){
            if(isset($_POST['product']) && count($_POST['product']) >0){
                $this->stock->recieve_stock($_POST);
                $this->session->set_flashdata("success","Stock Received has been added Successfully!!...");
            }else{
                $this->session->set_flashdata("error","No Product added, Please check and try again..");
            }
            redirect('dashboard/new_recieved_branch');
        }
        $data = array();
        $data['page'] = 'new_recieved_branch';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function view_received(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'view_received';
        $data['transfer'] = $this->stock->getReceiveByReceiveID($this->uri->segment(3));
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }



    public function edit_received(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'edit_recieved';
        $data['transfer'] = $this->stock->getReceiveByReceiveID($this->uri->segment(3));
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function update_received($transfer_id){
        $this->load->model("stock");
        if(isset($_POST['product']) && count($_POST['product']) >0){
            $this->stock->update_stock_recieved($transfer_id,$_POST);
            $this->session->set_flashdata("success","Stock Received has been updated Successfully!!...");
        }else{
            $this->session->set_flashdata("error","No Product added, Please add product to update recieved.");
        }
        redirect("dashboard/view_received/".$transfer_id);
    }


    public function transfer_stock_report(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'transfer_stock_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }
    public function recieved_stock_report(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'recieved_stock_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }
    public function stock_pick_up_report(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'stock_pick_up_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function rma(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'rma';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }
    public function newrma(){
        $this->load->model("stock");
        if(count($_POST) >0){
            $this->stock->addRMA($_POST);
            $this->session->set_flashdata("success","RMA Data has been added Successfully!!...");
            redirect("dashboard/newrma");
        }
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'newrma';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function perform_rma_action($rma_id,$action){
        $this->load->model("stock");
        $data = array();
        if(count($_POST) >0){
            if($_POST['btn'] =="Draft"){
                unset($_POST['btn']);
                $_POST['rma_action'] = $action;
                $this->db->where('rma_id',$rma_id)->update("rma_data",$_POST);
            }else{

            }
        }
        $data['page'] = 'rma_operation';
        $data['rma'] = $this->stock->getRMA($rma_id);
        $data['action']= $action;
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function rma_forms($rma_id){
        //0 ---> engineer Form
        //1 ---> Back to Supplier form
        //2 ---> Replaced for the customer form
        $data = array();
        $data['rma'] = $this->stock->getRMA($rma_id);
        $form_id = $_GET['id'];
        if($form_id == "1"){
            $this->load->view('page/rma_engineer',$data);
        }else{
            $this->load->view('page/rma_customer_form',$data);
        }

    }


    public function load_replaced_by_form($rma_id=0,$which = FALSE){
        $data = array();
        $data['rma'] = $this->stock->getRMA($rma_id);
        if($which != FALSE){
            if($which =="1"){
                $this->load->view('page/replace_by_femtechit',$data);
            }else{
                $this->load->view('page/replace_by_supplier',$data);
            }
        }
    }

    public function load_sent_to_engineer($rma_id=0,$which = FALSE){
        $data = array();
        $data['rma'] = $this->stock->getRMA($rma_id);
        if($which != FALSE){
            if($which =="1"){
                $this->load->view('page/femtechit_engineer',$data);
            }else{
                $this->load->view('page/warranty_engineer',$data);
            }
        }
    }

    public function getProductAssociatedWithBarcode(){
        $barcode= $_GET['barcode'];
        $product = $this->stock->getProductAssociatedWithBarcode($barcode);
        $product['type'] = "pieces";
        if($product!=false){
            die(json_encode($product));
        }else{
            die(json_encode(array('status'=>false,'message'=>'Product not Found!!...')));
        }
    }
    public function getProductBySearch(){
        $barcode= $_GET['barcode'];
        $product = $this->stock->getProductBySearch($barcode);
        if($product!=false){
            die(json_encode($product));
        }else{
            die(json_encode(array('status'=>false,'message'=>'Product not Found!!...')));
        }
    }
    public function getProductBySearchService(){
        $barcode= $_GET['barcode'];
        $product = $this->stock->getProductBySearchService($barcode);
        if($product!=false){
            die(json_encode($product));
        }else{
            die(json_encode(array('status'=>false,'message'=>'Product not Found!!...')));
        }
    }

    public function getProductAssociatedWithBarcodePickup(){
        $barcode= $_GET['barcode'];
        $product = $this->stock->getProductAssociatedWithBarcode($barcode);
        if($product!=false){
            if($product['stock_bar_status'] == "1"){
                die(json_encode(array('status'=>false,'message'=>'Product has been sold already')));
            }else if($product['stock_bar_status'] == "2"){
                die(json_encode(array('status'=>false,'message'=>'Product has already been transferred')));
            }else{
                $check_if_exist =$this->db->from("stock_pickup_items")->where("product_barcode",$barcode)->where("status","0")->get();
                if($check_if_exist->num_rows() >0){
                    foreach($check_if_exist->result_array() as $exist);
                    die(json_encode(array('status'=>false,'message'=>'Product has been pick by '.$exist['pickUpstaff'].' on '.$exist['pickup_date'])));
                }else{
                    die(json_encode($product));
                }
            }
        }else{
            die(json_encode(array('status'=>false,'message'=>'Product not Found!!...')));
        }
    }

    public function getServiceAssociatedWithBarcode(){
        $barcode= $_GET['barcode'];
        $product = $this->stock->getServiceAssociatedWithBarcode($barcode);
        if($product!=false){
            die(json_encode($product));
        }else{
            die(json_encode(array('status'=>false,'message'=>'Product not Found!!...')));
        }
    }


    public function view_stock_list($stock_id=0){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'view_stock_list';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function addPickUp(){
        $this->load->model("stock");
        $this->stock->addPickUp($_POST);
        die(json_encode(array("status"=>true, 'msg'=>"Stock pickup data was saved successfully")));
    }


    public function update_pick_up_status($sn=false){
        if($sn!=false){
            $this->load->model("stock");
            if($_POST['value'] == "returned"){
                $pick =$this->stock->getPick($sn);
                $stock =$this->stock->getStock($pick['product']);
                $this->stock->addStock($pick['product'],1);
                $this->db->where("SN",$sn)->update("stock_pickup_items",array("status"=>"1"));
                if(!empty($pick['product_barcode'])){
                    $this->db->where("bar_code")->update(array('status'=>0));
                }
                die(json_encode(array("status"=>true,"message"=>'<span class="label label-primary">Returned</span>')));
            }else if($_POST['value'] == "sold"){
                $pick =$this->stock->getPick($sn);
                $stock =$this->stock->getStock($pick['product']);
                $this->db->where("SN",$sn)->update("stock_pickup_items",array("status"=>"3"));
                if(!empty($pick['product_barcode'])){
                    $this->db->where("bar_code")->update(array('status'=>1));
                }
                die(json_encode(array("status"=>true,"message"=>'<span class="label label-success">Sold</span>')));
            }else{
                $pick =$this->stock->getPick($sn);
                $stock =$this->stock->getStock($pick['product']);
                $this->stock->addArenaStock($pick['product'],1);
                $this->db->where("SN",$sn)->update("stock_pickup_items",array("status"=>"2"));
                if(!empty($pick['product_barcode'])){
                    $this->db->where("bar_code")->update(array('status'=>0));
                }
                //status of pick up
                //0 ---> pending
                //1----> returned
                //2----> moved to arena
                //3----> sold
                die(json_encode(array("status"=>true,"message"=>'<span class="label label-primary">In-Arena</span>')));
            }
        }
    }


    public function mark_rma_as_completed($rma_id=FALSE,$extra){
        if($rma_id!=false){
            $this->db->where("rma_id",$rma_id)->update("rma",array("status"=>"1"));
            $this->session->set_flashdata("success","RMA Operation Marked Completed");
            redirect(base_url('dashboard/perform_rma_action/'.$rma_id.'/'.$extra));
        }
    }

    public function openPos($department){
        $department = str_replace('%20',' ',$department);
        $service = $this->db->get_where("department",["type"=>"Service"])->result_array();
        $s =[];
        foreach($service as $se){
            $s[] = $se['department'];
        }
        //$s[] = "Cinema";
        $service = $this->db->get_where("department",["type"=>"Sales"])->result_array();
        $sales =[];
        foreach($service as $se){
            $sales[] = $se['department'];
        }
        $o_department = $s;
        $n_department = $sales;

        $this->session->set_userdata('top_administrator_department',$department);

        if(in_array($department,$o_department)){
            $data = [];
            if($department == "Cinema"){
                $data['endpoint'] = 'movieSave';
            }else{
                $data['endpoint'] = 'serviceSave';
            }
            $this->load->view("pos/terminal-others",$data);
        }

        if(in_array($department,$n_department)){
            $this->load->view("pos/terminal");
        }

    }

    public function pos(){
        $user_id = $this->tank_auth->get_user_id();
        $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
        $service = $this->db->get_where("department",["type"=>"Service"])->result_array();
        $s =[];
        foreach($service as $se){
            $s[] = $se['department'];
        }
        //$s[] = "Cinema";
        $service = $this->db->get_where("department",["type"=>"Sales"])->result_array();
        $sales =[];
        foreach($service as $se){
            $sales[] = $se['department'];
        }
        $o_department = $s;
        $n_department = $sales;
        if(in_array($user['department'],$o_department)){
            $data = [];
            if($user['department'] == "Cinema"){
                $data['endpoint'] = 'movieSave';
            }else{
                $data['endpoint'] = 'serviceSave';
            }
            $this->load->view("pos/terminal-others",$data);
        }

        if(in_array($user['department'],$n_department)){
            $this->load->view("pos/terminal");
        }

    }

    public function continue_cart($cart_id){
            $pending_cart = $this->db->get_where("others",["SN"=>"1"])->row()->pending_cart;
            $carts = json_decode($pending_cart,true);
            if(isset($carts[$cart_id])){
                die(json_encode(array('status'=>true,'items'=>$carts[$cart_id]['items'])));
            }

    }
    public function delete_cart($cart_id){
            $pending_cart = $this->db->get_where("others",["SN"=>"1"])->row()->pending_cart;
            $carts = json_decode($pending_cart,true);
            if(count($carts) > 0) {
                if (isset($carts[$cart_id])) {
                    unset($carts[$cart_id]);
                    $this->db->where("SN","1")->update("others",['pending_cart'=>json_encode($carts)]);
                    echo 'Pending Cart (' . count($carts) . ')';
                }
            }
    }

    public function list_pending_cart(){
        $pending_cart = $this->db->get_where("others",["SN"=>"1"])->row()->pending_cart;
        $carts = json_decode($pending_cart,true);
        if(count($carts) > 0) {
        }else{
            $carts = array();
        }
        $this->load->view("page/pending_cart",['carts'=>$carts]);
    }



    public function serviceSave(){
        $cart = $_POST['cart'];
        $user = $_POST['user_id'];
        $save_array['reciept_id'] = $this->utils->generateUniqueID('sales','reciept_id');
        $save_array['discount_type'] = $_POST['discount_type'];
        $save_array['comment'] = $_POST['comment'];
        $save_array['date'] = date('Y-m-d');
        $save_array['discount'] = $_POST['discount'];
        $save_array['user_id'] =$user;
        $save_array['sales_time'] = date("h:i a");
        if(isset($_POST['amount_tendered'])){
            $save_array['amount_tendered'] = $_POST['amount_tendered'];
        }else{
            $save_array['amount_tendered'] = 0;
        }
        $total = 0;
        $total_profit = 0;
        $savings = array();
        $error = array();
        if(isset($_POST['cart_continue_id'])){
            if($this->session->userdata('pending_cart')) {
                $p_cart = $this->session->userdata('pending_cart');
                unset($p_cart[$_POST['cart_continue_id']]);
                $this->session->set_userdata('pending_cart',$p_cart);
            }
        }
        foreach($cart as $key=>$value){
            $item = $this->stock->getService($key);
            $savings[]=array(
                'item_name'=>$item['name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'department'=>$item['department'],
                'total'=>($value*$item['price']),
                'cost_price'=>0,
                'total_cost_price'=>($value*0),
                'profit'=>(($value*$item['price']) - ($value*0)),
                'id'=>$key,
            );
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*0));
        }
        $vat = ($this->settings->getSettings()['vat']/100)*$total;
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        $save_array['total_amount'] = $total;
        $save_array['items'] = json_encode($savings);
        $save_array['payment_method'] = $_POST['method'];
        if(isset($_POST['customer_id'])){
            $save_array['customer'] = $_POST['customer_id'];
        }else{
            $save_array['customer'] = 0;
        }
        $save_array['vat'] = $this->settings->getSettings()['vat'];
        $save_array['scharge'] = $this->settings->getSettings()['scharge'];
        $save_array['vat_amount'] = (($save_array['vat']/100)*$total);
        $save_array['s_charge_amt'] = (($save_array['scharge']/100)*$total);
        $save_array['total_amount_paid'] = $othertotal;
        $save_array['total_profit'] = $total_profit;
        $save_array['department'] = $this->stock->getUserDepartmentPos();
        if($this->input->post('sales_type')){
            $save_array['status'] = $this->input->post('sales_type');
        }else{
            $save_array['status'] = 'COMPLETE';
        }
        $this->db->insert("sales",$save_array);
        die(json_encode(array('status'=>true,'print'=>base_url('dashboard/print_recipt/'.$save_array['reciept_id'].'/'.$_POST['rec_size']))));

    }

    public function movieSave(){
        $cart = $_POST['cart'];
        $user = $_POST['user_id'];
        $save_array['reciept_id'] = $this->utils->generateUniqueID('sales','reciept_id');
        $save_array['discount_type'] = $_POST['discount_type'];
        $save_array['comment'] = $_POST['comment'];
        $save_array['date'] = date('Y-m-d');
        $save_array['discount'] = $_POST['discount'];
        $save_array['user_id'] =$user;
        $save_array['sales_time'] = date("h:i a");
        if(isset($_POST['amount_tendered'])){
            $save_array['amount_tendered'] = $_POST['amount_tendered'];
        }else{
            $save_array['amount_tendered'] = 0;
        }
        $total = 0;
        $total_profit = 0;
        $savings = array();
        $error = array();
        if(isset($_POST['cart_continue_id'])){
            if($this->session->userdata('pending_cart')) {
                $p_cart = $this->session->userdata('pending_cart');
                unset($p_cart[$_POST['cart_continue_id']]);
                $this->session->set_userdata('pending_cart',$p_cart);
            }
        }
        foreach($cart as $key=>$value){
            $item = $this->stock->getShow($key);
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'total'=>($value*$item['price']),
                'cost_price'=>0,
                'department'=>'Cinema',
                'total_cost_price'=>($value*0),
                'profit'=>(($value*$item['price']) - ($value*0)),
                'id'=>$key,
            );
            $this->db->where('SN',$key)->update('movies_shows',['qty_sold'=>($item['qty_sold']+1)]);
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*0));
        }
        $vat = ($this->settings->getSettings()['vat']/100)*$total;
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        $save_array['total_amount'] = $total;
        $save_array['items'] = json_encode($savings);
        $save_array['payment_method'] = $_POST['method'];
        if(isset($_POST['customer_id'])){
            $save_array['customer'] = $_POST['customer_id'];
        }else{
            $save_array['customer'] = 0;
        }
        $save_array['vat'] = $this->settings->getSettings()['vat'];
        $save_array['scharge'] = $this->settings->getSettings()['scharge'];
        $save_array['vat_amount'] = (($save_array['vat']/100)*$total);
        $save_array['s_charge_amt'] = (($save_array['scharge']/100)*$total);
        $save_array['total_amount_paid'] = $othertotal;
        $save_array['total_profit'] = $total_profit;
        $save_array['department'] = $this->stock->getUserDepartmentPos();
        if($this->input->post('sales_type')){
            $save_array['status'] = $this->input->post('sales_type');
        }else{
            $save_array['status'] = 'COMPLETE';
        }
        $this->db->insert("sales",$save_array);
        die(json_encode(array('status'=>true,'print'=>base_url('dashboard/print_recipt/'.$save_array['reciept_id'].'/'.$_POST['rec_size']))));

    }

    public function hold_cart(){
        $hold_id =  mt_rand();
        $save_array = array();
        $cart = $_POST['cart'];
        $product_type = $_POST['product_type'];
        $save_array['hold_id'] =$hold_id;
        $save_array['time'] = date('d F Y, h:i:s A');
        $save_array['total'] = 0;
        $save_array['items'] = [];
        $save_array['department'] = $this->stock->getUserDepartmentPos();
        $total =0;
        $savings = array();
        foreach($cart as $key=>$value){
            $item = $this->stock->getStock(str_replace('packed','',$key))[0];
            if($product_type[$key] == "packed"){
                $item['price'] = $item['whole_price'];
                $item['type'] = $product_type[$key];
            }else{
                $item['type'] = $product_type[$key];
            }
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'total'=>($value*$item['price']),
                'id'=>$item['SN'],
                'type'=>$item['type']
            );
            $total+=($value*$item['price']);
        }
        $save_array['items'] = $savings;
        $save_array['total']+=$total;
        $save_array['pending_cart_name'] = $this->session->userdata("username")."/".date('d/m/Y h:i a');
		$pending_cart = $this->db->get_where("others",["SN"=>"1"])->row()->pending_cart;
		$cart = json_decode($pending_cart,true);
        if($cart){
            $cart[$hold_id] = $save_array;
        }else{
            $cart = array();
            $cart[$hold_id] = $save_array;
        }
        $this->db->where("SN","1")->update("others",['pending_cart'=>json_encode($cart)]);
        die(json_encode(array('status'=>true)));
    }

    public function posSave(){
        $cart = $_POST['cart'];
        $product_type = $_POST['product_type'];
        $user = $_POST['user_id'];
        $save_array['reciept_id'] = $this->utils->generateUniqueID('sales','reciept_id');
        $save_array['discount_type'] = $_POST['discount_type'];
        $save_array['comment'] = $_POST['comment'];
        $save_array['date'] = date('Y-m-d');
        $save_array['discount'] = $_POST['discount'];
        $save_array['user_id'] =$user;
        $save_array['sales_time'] = date("h:i a");
        if(isset($_POST['amount_tendered'])){
            $save_array['amount_tendered'] = $_POST['amount_tendered'];
        }else{
            $save_array['amount_tendered'] = 0;
        }
        $total = 0;
        $total_profit = 0;
        $savings = array();
        $error = array();
        if(isset($_POST['cart_continue_id'])){
                $pending_cart = $this->db->get_where("others",["SN"=>"1"])->row()->pending_cart;
                $p_cart = json_decode($pending_cart,true);
                unset($p_cart[$_POST['cart_continue_id']]);
                $this->db->where("SN","1")->update("others",['pending_cart'=>json_encode($p_cart)]);
        }
        foreach($cart as $key=>$value){
            $item = $this->stock->getStock(str_replace('packed','',$key))[0];
            $this->session->set_userdata("tracking_id",$save_array['reciept_id']);
            $this->session->set_userdata("sold",true);
            if($product_type[$key] == "packed"){
                $item['price'] = $item['whole_price'];
                $item['cost_price'] = $item['whole_cost_price'];
                $item['product_name'] = $item['product_name']." - Packed";
                $this->stock->removePackedQty($item['id_stock'], $value);
            }else {
                $this->stock->removeStock($item['id_stock'], $value);
            }
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'product_type'=>$product_type[$key],
                'department'=>$item['department'],
                'total'=>($value*$item['price']),
                'cost_price'=>$item['cost_price'],
                'total_cost_price'=>($value*$item['cost_price']),
                'profit'=>(($value*$item['price']) - ($value*$item['cost_price'])),
                'id'=>$key,
            );
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*$item['cost_price']));
        }
        $this->session->unset_userdata("sold");
        $this->session->unset_userdata("tracking_id");
        if($_POST['discount']!=0){
            if($_POST['discount_type']=="1"){
                $save_array['discount']=$_POST['discount'];
            }
        }
        $vat = $this->input->post('vat');
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        $save_array['total_amount'] = $total;
        $save_array['items'] = json_encode($savings);
        $save_array['payment_method'] = $_POST['method'];
        if(isset($_POST['customer_id'])){
            $save_array['customer'] = $_POST['customer_id'];
        }else{
            $save_array['customer'] = 0;
            //die(json_encode(array('status'=>false,'message'=>'Please Select a Customer')));
        }
        $save_array['vat'] =$this->input->post('vat');
        $save_array['scharge'] = $this->settings->getSettings()['scharge'];
        $save_array['vat_amount'] = $this->input->post('vat');;
        $save_array['s_charge_amt'] = (($save_array['scharge']/100)*$total);
        $save_array['total_amount_paid'] = $othertotal;
        $save_array['total_profit'] = $total_profit;
        $save_array['department'] = $this->stock->getUserDepartmentPos();
        if($this->input->post('sales_type')){
            $save_array['status'] = $this->input->post('sales_type');
        }else{
            $save_array['status'] = 'COMPLETE';
        }
        $this->db->insert("sales",$save_array);
        $sales_id = $this->db->insert_id();
        if(isset( $_POST['payments'])) {
            $payments = $_POST['payments'];
            foreach ($payments as $payment) {
                $payment['sales_id'] = $sales_id;
                $payment['customer'] =  $save_array['customer'];
                $payment['user'] = $_POST['user_id']; 
                $this->db->insert('tbl_payment', $payment);
            }
        }
        die(json_encode(array('status'=>true,'print'=>base_url('dashboard/print_recipt/'.$save_array['reciept_id'].'/'.$_POST['rec_size']))));
    }

    public function creditSales(){
        $cart = $_POST['cart'];
        $user = $_POST['user_id'];
        $save_array['credit_id'] = $this->utils->generateUniqueID('tbl_credit_sales','credit_id');
        $save_array['discount_type'] = $_POST['discount_type'];
        $save_array['comment'] = $_POST['comment'];
        $save_array['date'] = date('Y-m-d');
        $save_array['discount'] = $_POST['discount'];
        $save_array['user_id'] =$user;
        $save_array['sales_time'] = date("h:i a");
        $total = 0;
        $total_profit = 0;
        $savings = array();
        $error = array();

        foreach($cart as $key=>$value){
            $item = $this->stock->getStock($key)[0];
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'total'=>($value*$item['price']),
                'cost_price'=>$item['cost_price'],
                'total_cost_price'=>($value*$item['cost_price']),
                'profit'=>(($value*$item['price']) - ($value*$item['cost_price'])),
                'id'=>$key,
            );
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*$item['cost_price']));
        }
        $vat = ($this->settings->getSettings()['vat']/100)*$total;
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        //get credit limit from settings
        $extra_charges=$this->db->from("others")->where("SN","1")->get()->result_array()[0];
        if(!empty($extra_charges['credit_limit']) && $extra_charges['credit_limit'] > 0){
            if($othertotal > $extra_charges['credit_limit']){
                die(json_encode(array('status'=>false,'message'=>'Credit Sales Total can not be more than '.number_format($extra_charges['credit_limit'],2) .', transaction not processed')));
            }
        }
        $total = 0;
        $total_profit = 0;
        $savings = array();
        $error = array();

        foreach($cart as $key=>$value){
            $item = $this->stock->getStock($key)[0];
            $this->session->set_userdata("tracking_id",$save_array['credit_id']);
            $this->session->set_userdata("sold",true);
            $this->stock->removeStock($item['id_stock'],$value);
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'total'=>($value*$item['price']),
                'cost_price'=>$item['cost_price'],
                'total_cost_price'=>($value*$item['cost_price']),
                'profit'=>(($value*$item['price']) - ($value*$item['cost_price'])),
                'id'=>$key,
            );
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*$item['cost_price']));
        }
        $this->session->unset_userdata("sold");
        $this->session->unset_userdata("tracking_id");
        if($_POST['discount']!=0){
            if($_POST['discount_type']=="1"){
                $save_array['discount']=$_POST['discount'];
            }
        }
        $vat = ($this->settings->getSettings()['vat']/100)*$total;
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        $save_array['total_amount'] = $total;
        $save_array['items'] = json_encode($savings);
        $save_array['payment_method'] = $_POST['method'];
        if(isset($_POST['customer_id'])){
            $save_array['customer'] = $_POST['customer_id'];
        }else{

            die(json_encode(array('status'=>false,'message'=>'Please Select a Customer')));
        }
        $save_array['vat'] = $this->settings->getSettings()['vat'];
        $save_array['scharge'] = $this->settings->getSettings()['scharge'];
        $save_array['vat_amount'] = (($save_array['vat']/100)*$total);
        $save_array['s_charge_amt'] = (($save_array['scharge']/100)*$total);
        $save_array['total_amount_paid'] = $othertotal;
        $save_array['total_profit'] = $total_profit;
        $save_array['status'] = 'COMPLETE';
        $this->db->insert("tbl_credit_sales",$save_array);
        die(json_encode(array('status'=>true,'print'=>base_url('dashboard/print_credit_recipt/'.$save_array['credit_id'].'/'.$_POST['rec_size']))));

    }

    public function depositSave($deposit_id){
        if(!$deposit_id){
            die(json_encode(array('status'=>false,'message'=>"Error locating Deposit Payment Invalid Transaction!!..")));
        }
        $cart = $_POST['cart'];
        $user = $_POST['user_id'];
        $save_array['reciept_id'] = $this->utils->generateUniqueID('sales','reciept_id');
        $save_array['discount_type'] = $_POST['discount_type'];
        $save_array['comment'] = $_POST['comment'];
        $save_array['date'] = date('Y-m-d');
        $save_array['discount'] = $_POST['discount'];
        $save_array['user_id'] =$user;
        $save_array['sales_time'] = date("h:i a");
        $total = 0;
        $total_profit= 0;
        $savings = array();
        $error = array();
        foreach($cart as $key=>$value){
            $item = $this->stock->getStock($key)[0];
            $this->session->set_userdata("tracking_id",$save_array['reciept_id']);
            $this->session->set_userdata("sold",true);
            $this->stock->removeStock($item['id_stock'],$value);
            $savings[]=array(
                'item_name'=>$item['product_name'],
                'item_price'=>$item['price'],
                'item_qty'=>$value,
                'total'=>($value*$item['price']),
                'cost_price'=>$item['cost_price'],
                'total_cost_price'=>($value*$item['cost_price']),
                'profit'=>(($value*$item['price']) - ($value*$item['cost_price'])),
                'id'=>$key,
            );
            $total+=($value*$item['price']);
            $total_profit+=(($value*$item['price']) - ($value*$item['cost_price']));
        }
        $this->session->unset_userdata("sold");
        $this->session->unset_userdata("tracking_id");
        if($_POST['discount']!=0){
            if($_POST['discount_type']=="1"){
                $save_array['discount']=$_POST['discount'];
            }
        }
        $vat = ($this->settings->getSettings()['vat']/100)*$total;
        $scharge =($this->settings->getSettings()['scharge']/100)*$total;
        $othertotal = $total - $save_array['discount'];
        $othertotal = $othertotal+$vat+$scharge;
        $save_array['total_amount'] = $total;
        $save_array['items'] = json_encode($savings);
        if(isset($_POST['invoice'])){
            $save_array['payment_type'] = "Invoice";
        }
        $save_array['payment_method'] = $_POST['method'];
        if(isset($_POST['customer_id'])){
            $save_array['customer'] = $_POST['customer_id'];
        }else{
            die(json_encode(array('status'=>false,'message'=>'Please Select a Customer')));
        }
        $save_array['vat'] = $this->settings->getSettings()['vat'];
        $save_array['scharge'] = $this->settings->getSettings()['scharge'];
        $save_array['vat_amount'] = (($save_array['vat']/100)*$total);
        $save_array['s_charge_amt'] = (($save_array['scharge']/100)*$total);
        $save_array['total_amount_paid'] = $othertotal;
        $save_array['total_profit'] = $total_profit;
        $save_array['status'] = 'COMPLETE';
        $this->db->insert("sales",$save_array);
        $s_id = $this->db->insert_id();
        //handle deposit
        $this->db->where("SN",$deposit_id)->update("deposit",array("deposit_status"=>"USED","sales_id"=>$s_id));
        die(json_encode(array('status'=>true,'redirect'=>base_url('dashboard/view_deposit/'.$deposit_id),'print'=>base_url('dashboard/print_recipt/'.$save_array['reciept_id'].'/'.$_POST['rec_size']))));
    }

    public function addCustomer(){
        $this->settings->addCustomer($_POST);
        $id =$this->db->insert_id();
        $customer =$this->settings->getCustomer($id);
        $customer['status'] = true;
        die(json_encode($customer));
    }
    public function refresh_stock_list(){
        $items = $this->stock->getSellable(array("quantity!="=>"0",'status'=>"1"));
        if(count($items) >0){
            foreach($items as $item){
                echo '<div data-qty="'.$item['quantity'].'" data-track="1" data-amount="'.$item['price'] .'" data-id="'.$item['SN'].'" data-item-name="'.$item['product_name'].'" onclick="addTocart(this)" class="col-lg-3 col-md-3 col-xs-6 shop-items filter-add-product noselect text-center" style="padding:5px; border-right: solid 1px #DEDEDE;border-top: solid 1px #DEDEDE;border-bottom: solid 1px #DEDEDE;" data-design="velvet v-neck body suit"><img data-original="'.$this->settings->getSettings()['slogo'].'" style="max-height: 64px; display: block;" class="img-responsive img-rounded lazy" src="'.$this->settings->getSettings()['slogo'] .'"><div class="caption text-center" style="padding:2px;overflow:hidden;"><strong class="item-grid-title"><span class="marquee_me">'.$item['product_name'] .'</span></strong><br><span class="align-center">&#8358;'. number_format($item['price'],2).'</span></div></div>';
            }
        }else{
            echo '<h2 align="center" style="margin-top:28%;">No Available Product!..<h2>';
        }
    }

    public function print_recipt($reciept_id,$receipt_type){
        $receipt_type =ucwords($receipt_type);
        $res = $this->stock->getSale($reciept_id);
        $data['payment'] = $res;
        $data['invoice'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/pos_recipt_print',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/pos_recipt_print',$data);
        }else{
            $this->load->view('print/invoice',$data);
        }
    }


    public function print_credit_recipt($reciept_id,$receipt_type){
        $receipt_type =ucwords($receipt_type);
        $res = $this->stock->getCredit($reciept_id);
        $data['payment'] = $res;
        $data['invoice'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/credit/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/credit/pos_recipt_print',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/credit/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/credit/pos_recipt_print',$data);
        }else{
            $this->load->view('print/credit/invoice',$data);
        }
    }



    public function print_add_depo_recipt($reciept_id,$receipt_type){
        $res = $this->stock->getDepositPayment($reciept_id);
        $data['payment'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/deposit/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/deposit/medium',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/deposit/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/deposit/communication',$data);
        }else{
            $this->load->view('print/deposit/invoice',$data);
        }
    }
    public function print_add_depo_full_recipt($reciept_id,$receipt_type){
        $res = $this->stock->getDepositall($reciept_id);
        $data['payment'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/deposit/deposit_all/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/deposit/deposit_all/medium',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/deposit/deposit_all/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/deposit/deposit_all/communication',$data);
        }else{
            $this->load->view('print/deposit/deposit_all/invoice',$data);
        }
    }


    public function sales(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'sales';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

        public function sales_user()
    {
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'sales';
        $data['user_id_filter'] = $_GET['user_id'];
        $this->load->view('page/heading', $data);
        $this->load->view('page/footer', $data);
    }

    public function Invoice($invoice_id=false){
        if($invoice_id==false){
            redirect('dashboard/invoices');
        }
        if(isset($_GET['markAspaid'])){
            $invoice= $this->invoice->getInvoice($invoice_id);
            $this->invoice->markAspaid($invoice_id);
            $this->session->set_flashdata("success","Operation Successfull!!...");
            redirect('dashboard/Invoice/'.$invoice_id);
        }
        $data = array();
        $data['invoice'] = $this->invoice->getInvoice($invoice_id);
        $this->load->view("print/invoice.print_canteen.php",$data);
    }


    public function invoices(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'invoices';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function sales_report(){
        $data['page'] = 'sales_reports';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function refund_report(){
        $data['page'] = 'refund_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function admin_refund_report(){
        $data['page'] = 'admin_refund_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function report_customer(){
        $data['page'] = 'report_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }
    public function report_stock(){
        $data['page'] = 'report_stock';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function report_sales_rep(){
        $data['page'] = 'report_sales_rep';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function report_payment_method(){
        $data['page'] = 'report_payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function bulk_report(){
        redirect(base_url('dashboard/report_stock'));
    }

    public function myprofile(){
        if(count($_POST) >0){
            $this->db->where("SN",$this->session->userdata("user_id"));
            $this->db->update("users",array('username'=>$_POST['email']));
            $this->session->set_flashdata("success","Operation Successful!!...");
            if(isset($_POST['password']) && !(empty($_POST['password']))){
                require_once(APPPATH.'libraries/phpass-0.1/PasswordHash.php');
                $password = $_POST['password'];
                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));
                $hashed_password = $hasher->HashPassword($password);
                $this->users->change_password($this->session->userdata("user_id"),$hashed_password);
                $this->session->set_flashdata("success","Operation Successful!!... Password has been Updated Successfully too.");
            }
        }

        $data['page'] = 'myprofile';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    public function extra_charges(){
        if(count($_POST)){
            if(!empty($_FILES['slogo']['name'])){
                if(getimagesize($_FILES['slogo']['tmp_name'])){
                    $getImage = explode("/",$this->settings->getSettings()['slogo']);
                    $getImage = $getImage[count($getImage)-1];
                    if($getImage!="default.png"){
                        @unlink("store_assets/".$getImage);
                    }
                    $extenstion = pathinfo($_FILES['slogo']['name'])['extension'];
                    $store_image_name = time().'-'.'store_logo.'.$extenstion;
                    move_uploaded_file($_FILES['slogo']['tmp_name'],'store_assets/'.$store_image_name);
                    $_POST['slogo'] = base_url("store_assets/".$store_image_name);
                }
            }
            $this->db->where("SN","1")->update("others",$_POST);
            $this->session->set_flashdata("success","Operation Successful!!...");
            redirect("dashboard/extra_charges");
        }
        $data['page'] = 'extra_charges';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }



    public function branch_has_been_deleted(){
        $this->load->view('page/branch_has_been_deleted',$data);
    }


    public function backup(){
        $data['page'] = 'backup';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function backupandUpload(){
        $path = 'db-backup-'.time().'.sql';

        $dbHost = $this->db->hostname;

        $dbUsername = $this->db->username;

        $dbPassword = $this->db->password;

        $database = $this->db->database;

        $this->utils->backupDatabaseTables($path,$dbHost,$dbUsername,$dbPassword,$database );
    }


    public function restore_database(){
        if(isset($_POST['restore_btn'])){
            if(file_exists($_FILES['restore']['tmp_name']) && is_uploaded_file($_FILES['restore']['tmp_name'])){
                $ext = pathinfo($_FILES['restore']['name']);
                if($ext['extension'] == "sql"){
                    $filename=$_FILES['restore']['name'];
                    $filepath=$_FILES['restore']['tmp_name'];
                    move_uploaded_file($filepath,'application/'.$filename);
                    if($lines=file_get_contents('application/'.$filename)){
                        $num =0;
                        $sql ='';
                        $clean_query =$lines;
                        $clean_query =explode(";",$clean_query);
                        foreach($clean_query as $_query){
                            if(!empty($_query)){
                                $this->db->simple_query($_query);
                                $num++;
                            }
                        }
                        if($num > 0){
                            $this->session->set_flashdata("success","Database Restore was Successful!... enjoy - (".$num.") query was executed successfully!!..");
                            redirect('dashboard/backup');
                        }else{
                            $this->session->set_flashdata("error","Unable to restore database, seems you don't have any content in the file or you uploaded an invalid file !!.. Please try again");
                            redirect('dashboard/backup');
                        }
                    }else{
                        $this->session->set_flashdata("error","Unable to restore database, we can not read the file you upload!!.. Please try again");
                        redirect('dashboard/backup');
                    }
                }else{
                    $this->session->set_flashdata("error","The file you uploaded seems not be an sql file... Please try again");
                    redirect('dashboard/backup');
                }
            }else{
                $this->session->set_flashdata("error","You did not upload anything!!..");
                redirect('dashboard/backup');
            }
        }else{
            redirect('dashboard/backup');
        }
        $data['page'] = 'backup';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function view_sales($id){
        $data['page'] = 'view_sales';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function customerlist(){
        $data['page'] = 'customerlist';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function generateBarcode($code){
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code39', 'image', array('text'=>$code), array());
    }

    function barcode(){
        $this->load->view("page/barcodes");
    }
    function barcode_page(){
        $data = array();
        $data['page'] = 'barcode_page';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function edit_sales($transaction_id){
        $data = array();
        $data['page'] = 'edit_sales';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }
    function payment_method($id=false){
        if(count($_POST) >0){
            $_POST['defaults'] = "0";
            $_POST['payment_method'] = strtoupper($_POST['payment_method']);
            $this->db->insert("payment_method",$_POST);
            redirect("dashboard/payment_method");
        }
        if(isset($_GET['del'])){
            if($this->db->from("sales")->where("payment_method",$id)->get()->num_rows() > 0){
                $this->session->set_flashdata("error","Unable to delete Payment Method, transaction exists with this payment method");
                redirect("dashboard/payment_method");
            }else{
                $this->db->where("SN",$id)->delete("payment_method");
                redirect("dashboard/payment_method");
            }
        }
        $data = array();
        $data['page'] = 'payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    function deposits(){
        $data = array();
        $data['page'] = 'deposits';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function add_deposit(){
        if(count($_POST)>0){
            $_POST['branch_id'] = $this->stock->getBranch_id();
            $_POST['reciept_id'] = $this->utils->generateUniqueID('deposit','reciept_id');
            $_POST['deposit_id'] = $this->utils->generateUniqueID('deposit','deposit_id');
            $this->db->insert("deposit",$_POST);
            $id = $this->db->insert_id();
            $_POST['deposit_SN'] = $id;
            unset($_POST['deposit_for']);
            $this->db->insert("deposit_payment_history",$_POST);
            redirect("dashboard/deposits");
        }
        $data = array();
        $data['page'] = 'add_deposits';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function view_deposit($deposit_id=false){
        if($deposit_id){
            $data = array();
            $data['page'] = 'view_deposits';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/deposit");
        }
    }

    function add_new_deposit_history($deposit_id){
        if($deposit_id){
            if(count($_POST)>0){
                $_POST['branch_id'] = $this->stock->getBranch_id();
                $_POST['reciept_id'] = $this->utils->generateUniqueID('deposit_payment_history','reciept_id');
                $this->db->insert("deposit_payment_history",$_POST);
                redirect("dashboard/view_deposit/".$deposit_id);
            }


            $data = array();
            $data['page'] = 'add_new_deposit_history';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/deposit");
        }
    }

    function checkout_depsits($deposit_id){
        if($deposit_id){
            $data = array();
            $data['page'] = 'checkout_depsits';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/deposit");
        }
    }

    function refund_deposit($deposit_id){
        if($deposit_id){

            if(count($_POST)){
                $this->db->where("SN",$deposit_id)->update("deposit",array('date_refunded'=>$_POST['date_refunded'],'reason_for_refund'=>$_POST['reason_for_refund'],'deposit_status'=>"REFUND"));
                redirect('dashboard/view_deposit/'.$deposit_id);
            }
            $data = array();
            $data['page'] = 'refund_depsits';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/deposit");
        }
    }
    function therminal_deposit($deposit_id){
        if($deposit_id){
            $data = array();
            $this->load->view('pos/therminal_deposit');
        }else{
            redirect("dashboard/deposit");
        }
    }



//deposit Report
    public function deposit_report(){
        $data['page'] = 'deposit_reports';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }
    public function deposit_report_customer(){
        $data['page'] = 'deposit_report_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function deposit_report_sales_rep(){
        $data['page'] = 'deposit_report_sales_rep';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function deposit_report_payment_method(){
        $data['page'] = 'deposit_report_payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function credit(){
        $data = array();
        $data['page'] = 'credits';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function view_credit($credit_id){
        if(!$credit_id){
            redirect("dashboard/credit");
        }else{
            $data = array();
            $data['page'] = 'view_credit';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }
    }

    public function add_new_credit(){
        $data = array();
        $data['page'] = 'preparing_credit_sales';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function therminal_credit(){
        $this->load->view('pos/therminal_credit');
    }

    function new_payment_credit($credit_id){
        if($credit_id){
            if(count($_POST)>0){
                $_POST['reciept_id'] = $this->utils->generateUniqueID('credit_payment_history','reciept_id');
                $credit_details = $this->stock->getCredit($credit_id);
                $payment_b4 = $this->stock->getTotalAmountCreditPaid($credit_details['SN'],false);
                $payment_b4  = $payment_b4  +  $_POST['amount'];
                if($payment_b4 > $credit_details['total_amount_paid']){
                    $this->session->set_flashdata('error','Unable to add Payment to History, Reason <br> Total Paid can not be greater than total amount!..');
                    redirect("dashboard/new_payment_credit/".$credit_id);
                }
                $this->db->insert("credit_payment_history",$_POST);
                $payment_b4 = $this->stock->getTotalAmountCreditPaid($credit_id,false);
                if($payment_b4 == $credit_details['total_amount_paid']){
                    $this->db->where("SN",$credit_id)->update("tbl_credit_sales",array("status"=>1));
                    $this->session->set_flashdata('success','Credit mark as finished successfully');
                }
                redirect("dashboard/view_credit/".$credit_id);
            }
            $data = array();
            $data['page'] = 'new_payment_credit';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/credit");
        }
    }



    public function print_add_credit_recipt($reciept_id,$receipt_type){
        $res = $this->stock->getCreditPayment($reciept_id);
        $data['payment'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/credit/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/credit/medium',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/credit/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/credit/communication',$data);
        }else{
            $this->load->view('print/credit/invoice',$data);
        }
    }
    public function print_add_credit_full_recipt($reciept_id,$receipt_type){
        $res = $this->stock->getCreditall($reciept_id);
        $data['payment'] = $res;
        if($receipt_type=="Thermal"){
            $this->load->view('print/credit/deposit_all/pos_recipt_print',$data);
        }else if($receipt_type=="Medium"){
            $this->load->view('print/credit/deposit_all/medium',$data);
        }else if($receipt_type=="Big"){
            $this->load->view('print/credit/deposit_all/big',$data);
        }else if($receipt_type=="Communication"){
            $this->load->view('print/credit/deposit_all/communication',$data);
        }else{
            $this->load->view('print/credit/deposit_all/invoice',$data);
        }
    }

    public function invoice_report(){
        $data['page'] = 'invoice_report/invoice_reports';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function invoice_report_customer(){
        $data['page'] = 'invoice_report/invoice_report_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function invoice_report_sales_rep(){
        $data['page'] = 'invoice_report/invoice_report_sales_rep';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function invoice_report_payment_method(){
        $data['page'] = 'invoice_report/invoice_report_payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function credit_reports(){
        $data['page'] = 'credit_report/credit_reports';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function credit_report_customer(){
        $data['page'] = 'credit_report/credit_report_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function credit_report_sales_rep(){
        $data['page'] = 'credit_report/credit_report_sales_rep';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function credit_report_payment_method(){
        $data['page'] = 'credit_report/credit_report_payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function return_stock($prod,$id){
        $this->db->where("bar_code",$id)->update("product_bar_code",array("status"=>"0"));
        $branch_id = $this->stock->getBranch_id();
        $qty =$this->db->from("stock_branch")->where("branch_id",$branch_id)->where("stock_id",$prod)->get()->result_array()[0]['quantity'];
        $qty++;
        $this->db->where("branch_id",$branch_id)->where("stock_id",$prod)->update("stock_branch",array("quantity"=>$qty));
        redirect(base_url('dashboard/view_stock_list/'.$prod));
    }

    function category(){
        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addcategory($_POST);
            $this->session->set_flashdata("success","Category Added Successfully!!...");
            redirect('dashboard/category');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->delete("category");
            $this->session->set_flashdata("success","Category deleted Successfully!!...");
            redirect('dashboard/category');
        }
        $data = array();
        $data['page'] = 'category';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function bank_manager(){
        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addbank($_POST);
            $this->session->set_flashdata("success","Bank Added Successfully!!...");
            redirect('dashboard/bank_manager');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->delete("tbl_bank");
            $this->session->set_flashdata("success","Bank deleted Successfully!!...");
            redirect('dashboard/bank_manager');
        }
        $data = array();
        $data['page'] = 'bank_manager';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    function suppliers(){
        $this->load->model('stock');
        if(count($_POST)>0){
            $this->stock->addSupplier($_POST);
            $this->session->set_flashdata("success","Supplier Added Successfully!!...");
            redirect('dashboard/supplier');
        }
        if(isset($_GET['del'])){
            $this->db->where("SN",$this->uri->segment(3))->delete("category");
            $this->session->set_flashdata("success","Supplier deleted Successfully!!...");
            redirect('dashboard/supplier');
        }
        $data = array();
        $data['page'] = 'supplier';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }
    function view_stock_movement($stock_id){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'view_stock_movement';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    function expenses_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'expenses';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function new_expenses(){
        if(count($_POST)>0){
            $this->stock->addExpenses($_POST);
            $this->session->set_flashdata("success","Operation successfull!!..");

            redirect('dashboard/expenses_report');
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'newexpenses';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    function edit_expenses($sn){
        if(count($_POST)>0){
            $ex = $this->db->get_where("tbl_expenses",array("SN"=>$sn))->row_array();
            if($ex['expense_purpose_title']=="Salary Payment"){
                $this->session->set_flashdata("error","Unable to edit Salary payment expenses");
                redirect('dashboard/expenses_report');
            }
            $this->stock->updateExpenses($_POST,$sn);
            $this->session->set_flashdata("success","Operation successful!!..");

            redirect('dashboard/expenses_report');
        }
        $ex = $this->db->get_where("tbl_expenses",array("SN"=>$sn))->row_array();
        if($ex['expense_purpose_title']=="Salary Payment"){
            $this->session->set_flashdata("error","Unable to edit Salary payment expenses");
            redirect('dashboard/expenses_report');
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'editexpenses';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }

    function delete_expenses($sn){
        $ex = $this->db->get_where("tbl_expenses",array("SN"=>$sn))->row_array();
        if($ex['expense_purpose_title']=="Salary Payment"){
            $this->session->set_flashdata("error","Unable to delete Salary payment expenses");
            redirect('dashboard/expenses_report');
        }else{
            $this->db->where("SN",$sn)->delete("tbl_expenses");
            $this->session->set_flashdata("success","Operation successfull!!..");
            redirect('dashboard/expenses_report');
        }
    }

    function expenses_monthly_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'expenses_monthly_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    function staff_salary(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'staff_salary';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function new_salary_payment(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'new_salary_payment';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function processnewsalarypayment(){
        unset($_POST['employee_length']);
        $alltotal =0;
        $total = 0;
        $payment_array =array(
            'payment_id'=>$this->utils->generateUniqueID("tbl_payment_payrole","payment_id"),
            'month'=>$_POST['month'],
            'month_number'=>$_POST['month_no'],
            'year'=>$_POST['year'],
            'type'=>"Salary"
        );
        $this->db->insert("tbl_payment_payrole",$payment_array);
        $payment_id =$this->db->insert_id();
        foreach($_POST['salary'] as $emp_id=>$value){
            $payment_history = array(
                'employee_id'=>$emp_id,
                'payment_id'=>$payment_id,
                'month'=>$_POST['month'],
                'month_no'=>$_POST['month_no'],
                'year'=>$_POST['year'],
                'salary'=>$value,
                'addition'=>$_POST['addition'][$emp_id],
                'deduction'=>$_POST['deduction'][$emp_id],
                'loan_deduction'=>$_POST['loan_deduction'][$emp_id],
                'branch_id'=>0,
                'department_id'=>0,
            );
            $addition = (((float)$value) +((float)$_POST['addition'][$emp_id]));
            $deduction = (((float)$_POST['deduction'][$emp_id]) + ((float)$_POST['loan_deduction'][$emp_id]));
            $total = $addition - $deduction;
            $alltotal = $alltotal+$total;
            $this->db->insert("tbl_payment_payrole_history",$payment_history);
        }

        $this->db->where("SN",$payment_id)->update("tbl_payment_payrole",array("total_pay"=>$alltotal,'total_staff'=>count($_POST['salary'])));
        redirect("dashboard/staff_salary");
    }


    public function view_history_salary($payrole_id){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'view_history_salary';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function mark_fully_paid_salary($id){
        $payment = $this->stock->getpaymentgeneratedbyid($id);
        if($payment['status']!="1"){
            $history = $this->stock->getpaymentgeneratedhistorybypaymentid($id);
            foreach($history as $his){
                if($his['loan_deduction'] !="0"){
                    $loan = $this->stock->getpendingloanbyemployeeID($his['employee_id']);
                    if($loan !=false){
                        $loan_save = array(
                            'load_id'=>$loan['SN'],
                            'employee_id'=>$his['employee_id'],
                            'amount_paid'=>$his['loan_deduction'],
                            'date'=>date('Y-m-d')
                        );
                        $this->db->insert("loan_payment_history",$loan_save);
                        $amount_borrow = $loan['amount'];
                        $total_paid = $this->stock->getTotalloanpayment($loan['SN']);
                        if(($amount_borrow == $total_paid) || ($amount_borrow < $total_paid)){
                            $this->db->where("SN",$loan['SN'])->update("tbl_loan",array('status'=>1));
                        }
                    }
                }
            }
            $this->db->where("SN",$id)->update("tbl_payment_payrole",array('pay_date'=>date('Y-m-d'),'status'=>1));
            $expense_payment = array(
                'expense_date'=>date('Y-m-d'),
                'month'=>$payment['month'],
                'month_number'=>$payment['month_number'],
                'year'=>$payment['year'],
                'expense_total_amount'=>$payment['total_pay'],
                'expense_purpose'=>'Salary Payment for '.$payment['month'].','.$payment['year'],
                'expense_purpose_title'=>'Salary Payment'
            );
            $this->db->insert("tbl_expenses",$expense_payment);
        }
        $this->session->set_flashdata("success","Operation successfull!!..");
        redirect("dashboard/view_history_salary/".$id);
    }


    public function print_payment_slip(){
        $this->load->view('page/payment_slip');
    }


    public function view_delete_sales($sales_id){
        $sales = $this->db->get_where("sales",array("reciept_id"=>$sales_id))->row_array();
        if($sales['status'] == "VOID"){
            $this->session->set_flashdata("error","Sales has already been canceled/voided");
            redirect('dashboard/view_sales/'.$sales_id);
        }
        if($sales['status'] != "COMPLETE"){
            $this->session->set_flashdata("error","Sales has already been canceled/voided");
            redirect('dashboard/view_sales/'.$sales_id);
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'void_sales';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function delete_sales($sales_id){
        $sales = $this->db->get_where("sales",array("reciept_id"=>$sales_id))->row_array();
        if($sales['status'] == "VOID"){
            $this->session->set_flashdata("error","Sales has already been canceled/voided");
            redirect('dashboard/view_sales/'.$sales_id);
        }
        if($sales['status'] != "COMPLETE"){
            $this->session->set_flashdata("error","Sales has already been canceled/voided");
            redirect('dashboard/view_sales/'.$sales_id);
        }
        $products = json_decode($sales['items'],true);
        if(count($products) > 0){
            foreach($products as $product){
                if($product['product_type'] =="packed"){
                    $this->stock->addpacked(str_replace('packed','',$product['id']), $product['item_qty'], TRUE);
                }else {
                    $this->stock->addStock2($product['id'], $product['item_qty'], TRUE);
                }
            }
        }
        $v = $this->users->get_user_by_username($this->session->userdata("username"))->SN;
        $this->db->where("reciept_id",$sales_id)->update("sales",array("status"=>"VOID","reason"=>$this->input->post('reason'),"voided_by"=>$v,"date_voided"=>date("Y-m-d")));
        $this->session->set_flashdata("success","Operation complete");
        redirect('dashboard/view_sales/'.$sales_id);
    }


    //Profit / Loss

    public function todays_profit(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'todays_profit';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function by_sales_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'profit_loss_general';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function by_report_customer(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'by_report_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function by_report_sales_rep(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'by_report_sales_rep';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function by_report_stock(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'by_report_stock';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function by_report_payment_method(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'by_report_payment_method';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function new_entry(){
        if(count($_POST)>0){
            $this->session->set_flashdata("success","Sales Transaction has been added successfully!.");
            $this->db->insert("tbl_cashbook",$this->input->post(null));
            redirect("dashboard/new_entry");
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'new_bank_deposit_withdraw';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function deposit_credit_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'deposit_credit_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function ref(){
        $this->load->view("page/dailysales");
    }

    public function new_assets(){
        if(count($_POST) > 0){
            $this->db->insert("tbl_assets",$this->input->post(null));
            $this->session->set_flashdata("success","Assets as been added successfully!....");
            redirect("dashboard/new_assets");
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'new_assets';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function view_assests($sn){
        if(count($_POST) > 0){
            $this->db->where("SN",$sn)->update("tbl_assets",$this->input->post(null));
            $this->session->set_flashdata("success","Assets as been updated successfully!....");
            redirect("dashboard/view_assests/".$sn);
        }
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'edit_assets';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function assets_list(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'assets_list';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function credit_payment_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'credit_payment_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function reset_password($user_id){
        require_once(APPPATH.'libraries/phpass-0.1/PasswordHash.php');
        $password = '123456';
        $hasher = new PasswordHash(
            $this->config->item('phpass_hash_strength', 'tank_auth'),
            $this->config->item('phpass_hash_portable', 'tank_auth'));
        $hashed_password = $hasher->HashPassword($password);
        $this->db->where("SN",$user_id)->update("users",array("password"=>$hashed_password));
        $this->session->set_flashdata("success","Password has been reset to default 123456");
        redirect("dashboard/settings");
    }

    public function new_invoice(){
        $this->load->model("stock");
        if(count($_POST) >0){

            if(empty($_POST['supplier'])){
                $this->session->set_flashdata("error","Please select Supplier");
                redirect('dashboard/new_invoice');
            }




            if(isset($_POST['product']) && count($_POST['product']) >0){
                $this->stock->addSupplierInvoice($_POST);
                $this->session->set_flashdata("success","Invoice has been saved Successfully!!...");
            }else{
                $this->session->set_flashdata("error","No Product added, Please check and try again..");
            }
            redirect('dashboard/new_invoice');
        }
        $data = array();
        $data['page'] = 'new_invoice';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function supplier_invoice_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'supplier_invoice_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function view_invoice(){
        $this->load->model("stock");
        $data = array();
        $data['page'] = 'view_invoice';
        $data['transfer'] = $this->stock->getSupplierInvoiceID($this->uri->segment(3));
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function complete_invoice($id){
        $this->db->where("supplier_id",$id)->update("supplier_invoice",array("status"=>"complete"));
        $this->session->set_flashdata("success","Operation Successful");
        redirect('dashboard/view_invoice/'.$id);

    }

    public function add_new_invoice_history($invoice_id){
        if($invoice_id){
            if(count($_POST)>0){
                $credit_details = $this->db->get_where("supplier_invoice",array("supplier_id"=>$invoice_id))->row_array();
                $payment_b4 = $this->stock->getInvoiceAmountpaid($credit_details['SN'],false);

                $payment_b4  = $payment_b4  +  $_POST['amount'];
                if($payment_b4 > $credit_details['total_invoice_amount']){
                    $this->session->set_flashdata('error','Unable to add Payment to History, Reason <br> Total Paid can not be greater than total invoice amount!..');
                    redirect("dashboard/view_invoice/".$invoice_id);
                }
                unset($_POST[0]);
                $this->db->insert("invoice_payment_history",$_POST);
                if($payment_b4 == $credit_details['total_invoice_amount']){
                    $this->db->where("SN",$credit_details['SN'])->update("supplier_invoice",array("status"=>"Complete"));
                    $this->session->set_flashdata('success','Invoice Marked as finished successfully');
                }
                redirect("dashboard/view_invoice/".$invoice_id);
            }
            $data = array();
            $data['page'] = 'new_payment_invoice';
            $this->load->view('page/heading',$data);
            $this->load->view('page/footer',$data);
        }else{
            redirect("dashboard/supplier_invoice_report");
        }

    }

    public function edit_customer($sn){
        $customer =  $this->db->get_where("tbl_customers",array("SN"=>$sn))->row_array();
        if(count($_POST)>0){
            $from = strtotime($_POST['date']);
            $_POST['expired_date'] = date("Y-m-d",strtotime("+ ".$_POST['weeks']." weeks",$from));
            $this->db->where("SN",$sn)->update("tbl_customers",$_POST);
            $this->session->set_flashdata("success","Customer was updated successfully!");
            redirect('dashboard/customerlist');
        }
        $data = array();
        $data['customer'] = $customer;
        $data['page'] = 'edit_customer';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function due_payment_report(){
        $data = array();
        $data['page'] = 'due_payment_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);

    }


    public function total_income_report(){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'total_income_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    function get_recieved_stock($num){
        $products = $this->stock->getStocksToRecieved(array("status"=>"1"));
        $html ='<select required class="form-control input-sm" id="select-'.$num.'" name="product['.$num.']"><option value="">-Select Product-</option>';
        foreach($products as $product){
            $html .='<option data-code="'.$product['id_stock'].'" '.($product['expiry_status']=='Yes' ? 'expiry_date='.$this->stock->getCurrentBatchExpiryDate($product['SN']) : '').'  '.($product['expiry_status']=='Yes' ? 'can_expired="1"' : '').' value="'.$product['id_stock'].'">'.$product['product_name'].'</option>';
        }
        $html.='</select><div id="expiry_div_'.$num.'"  class="form-group" style="display:none;margin-top:12px;"><label>Expiry Date</label><input type="text" data-min-view="2" data-date-format="yyyy-mm-dd" id="expiry_date_'.$num.'" name="expiry_date['.$num.']" class="form-control input-sm"/></div>';

        echo $html;
    }

    function get_recieved_stock_bar_code($num,$code){
        $check = $this->stock->getStocksToRecieved(array("bar_code_code"=>$code));
        if(count($check) == 0){
         echo 'not_found';
        }else {
            $products = $this->stock->getStocksToRecieved(array("status" => "1"));
            $html = '<select id="' . $code . '" required class="form-control input-sm" id="select-' . $num . '" name="product[' . $num . ']">';
            foreach ($products as $product) {
                $html .= '<option ' . ($code == $product['bar_code_code'] ? 'selected' : '') . ' data-code="' . $product['id_stock'] . '" ' . ($product['expiry_status'] == 'Yes' ? 'expiry_date=' . $this->stock->getCurrentBatchExpiryDate($product['SN']) : '') . '  ' . ($product['expiry_status'] == 'Yes' ? 'can_expired="1"' : '') . ' value="' . $product['id_stock'] . '">' . $product['product_name'] . '</option>';
            }
            $html .= '</select><div id="expiry_div_' . $num . '"  class="form-group" style="'.($product['expiry_status']=="Yes" ? 'display:block;' : 'display:none;').'margin-top:12px;"><label>Expiry Date</label><input type="text" data-min-view="2" data-date-format="yyyy-mm-dd" value="'.date('Y-m-d').'" id="expiry_date_' . $num . '" name="expiry_date[' . $num . ']" class="form-control input-sm"/></div>';

            echo $html;
        }
    }


    function view_stock_batches($stock_id){
        $this->load->model('stock');
        $data = array();
        $data['page'] = 'view_stock_batches';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function adduser(){
        $data = array();
        $data['page'] = 'new_users';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function genre(){
        if(count($_POST) > 0){
            $this->db->insert('genre',['genre'=>$this->input->post('genre')]);
            redirect('dashboard/genre');
        }
        $data = array();
        $data['page'] = 'genre';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function delete_genre($id){
        $this->db->where('SN',$id)->delete('genre');
        $this->session->set_flashdata("success","Operation Successful!!...");
        redirect('dashboard/genre');
    }

    public function new_movies(){
        if(count($_POST) > 0){
            $this->db->insert('movies',$this->input->post(null));
            $this->session->set_flashdata("success","Movie has been added successfully");
            redirect('dashboard/movies');
        }
        $data = array();
        $data['page'] = 'new_movies';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function movies(){
        if(count($_POST) > 0){
            $this->db->insert('movies',$this->input->post(null));
            $this->session->set_flashdata("success","Movie has been added successfully");
            redirect('dashboard/movies');
        }
        $data = array();
        $data['page'] = 'movies';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function show_movie($sn){
        if(count($_POST) > 0){
            $_POST['movie_id'] = $sn;
            $_POST['added_by'] = $this->tank_auth->get_user_id();
            $this->db->insert('movies_shows',$this->input->post(null));
            $this->session->set_flashdata("success","Movie Show has been added successfully");
            redirect('dashboard/list_shows');
        }
        $data = array();
        $data['page'] = 'show_movies';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function list_shows(){
        $data = array();
        $data['page'] = 'list_shows';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function edit_movie($sn){
        if(count($_POST) > 0){
            $this->db->where('SN',$sn)->update('movies',$this->input->post(null));
            $this->session->set_flashdata("success","Movie has been updated successfully");
            redirect('dashboard/edit_movie/'.$sn);
        }
        $data = array();
        $data['page'] = 'edit_movies';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function department(){
        if(count($_POST) > 0){
            $this->db->insert('department',$this->input->post(null));
            $this->session->set_flashdata("success","Department has been added successfully");
            redirect('dashboard/department');
        }
        $data = array();
        $data['page'] = 'department';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function service_category(){
        if(count($_POST) > 0){
            $this->db->insert('service_category',$this->input->post(null));
            $this->session->set_flashdata("success","Category has been added successfully");
            redirect('dashboard/service_category');
        }
        $data = array();
        $data['page'] = 'service_category';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function edit_service_category($sn){
        if(count($_POST) > 0){
            $this->db->where('SN',$sn)->update('service_category',$this->input->post(null));
            $this->session->set_flashdata("success","Category has been updated successfully");
            redirect('dashboard/service_category');
        }
        $data = array();
        $data['service'] = $this->stock->getServiceCategory($sn);
        $data['page'] = 'edit_service_category';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function new_service(){
        if(count($_POST) > 0){
            $this->db->insert('services',$this->input->post(null));
            $this->session->set_flashdata("success","Congratulation, New Service has been created");
            redirect('dashboard/new_service');
        }
        $data = array();
        $data['page'] = 'new_service';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function list_service(){
        $data = array();
        $data['page'] = 'list_service';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function edit_service($sn){
        if(count($_POST) > 0){
            $this->db->where('SN',$sn)->update('services',$this->input->post(null));
            $this->session->set_flashdata("success","Service has been updated");
            redirect('dashboard/list_service');
        }
        $data = array();
        $data['service'] = $this->db->from('services')->where('SN',$sn)->get()->row_array();
        $data['page'] = 'edit_service';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function delete_service($sn){
        $this->db->where('SN',$sn)->delete('services');
        redirect('dashboard/list_service/');
    }

    public function sort_expiry($batch_product_sn){
        $this->db->where("SN",$batch_product_sn)->update("batch_product_table",array("status"=>"sorted"));
        $batch = $this->db->from("batch_product_table")->where("SN",$batch_product_sn)->get()->row_array();
        $getProductInbatch = $this->db->get_where("batch_product_table",array("batch_id"=>$batch['batch_id'],"status"=>"unsorted"));
        if($getProductInbatch->num_rows() == 0){
            $this->db->where("SN",$batch['batch_id'])->update('batch_table',array("status"=>"sorted"));
            redirect('dashboard/stock_expiry');
        }
        redirect('dashboard/stock_expiry_product/'.$batch_product_sn);
    }


    public function edit_category($sn){
        if(count($_POST) > 0){
            $this->db->where('SN',$sn)->update('category',$this->input->post(null));
            $this->session->set_flashdata("success","Category has been updated");
            redirect('dashboard/category');
        } 
        $data = array();
        $data['page'] = 'edit_category';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function depacked($sn){
        if(count($_POST) >0){
            $stock = $this->stock->getStockByID($sn);
            $numofqty_per_pack = $stock['item_packed'];
            $qty = (int)$this->input->post('qty');
            $extra_qty = (int)$this->input->post('extra_qty');
            $this->stock->removePackedQty($sn,$qty);
            $this->stock->addStockPieces($sn,(($qty*$numofqty_per_pack)+ $extra_qty));
            $this->session->set_flashdata("success","Quantity has been depacked/convert to Pieces successfully");
            redirect('dashboard/depacked/'.$sn);
        }
        $data = array();
        $data['page'] = 'depacked';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function packed_and_unpacked($product_id, $type){
        $product = $this->stock->getStockByID($product_id);
        if($product['product_type'] !="Packed"){
            $info = $this->stock->getProductBySe($product_id);
            $info['type'] = "pieces";
            die(json_encode($info));
        }else{
            if($type =="packed"){
                $info = [
                        "product_name"=>$product['product_name']." - ".$type,
                        "id_stock"=>$product['id_stock'],
                        "quantity"=>$product['cartoon_qty'],
                        "price"=>$product['whole_price'],
                        "vat"=>$product['vat'],
                        "type"=>$type
                ];
            }else{
                $info = $this->stock->getProductBySe($product_id);
                $info['type'] = "pieces";
            }
            die(json_encode($info));
        }
    }


    public function delete_movie($sn){
        if($this->db->get_where("movies_shows",['movie_id'=>$sn])->num_rows() == 0){
            $this->db->where('SN', $sn)->delete('movies');
            $this->session->set_flashdata("success", "Movie has been deleted successfully");
            redirect('dashboard/movies');
        }else{
            $this->session->set_flashdata("error", "Unable to delete movie, because it exist in one or more movie shows");
            redirect('dashboard/movies');
        }
    }

    public function delete_show($sn){
        $this->db->where('SN', $sn)->delete('movies_shows');
        $this->session->set_flashdata("success", "Movie show has been deleted successfully");
        redirect('dashboard/list_shows');
    }


    public function edit_department($sn){
        if(count($_POST) > 0){
            $this->db->where('SN',$sn)->update('department',$this->input->post(null));
            $this->session->set_flashdata("success","Department has been updated");
            redirect('dashboard/department');
        }
        $data = array();
        $data['page'] = 'edit_depatment';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }


    public function payment_report(){
        $data = array();
        $data['page'] = 'payment_report';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }

    public function payment_report_user(){
        $data = array();
        $data['page'] = 'payment_report_user';
        $this->load->view('page/heading',$data);
        $this->load->view('page/footer',$data);
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
