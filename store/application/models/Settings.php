<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Settings extends CI_Model{
	

	
	//customers	
	public function addCustomer($data){
		return $this->db->insert('tbl_customers',$data);	
	}
	
	public function updateCustomer($id,$data){	
		return $this->db->where("SN",$id)->update('tbl_customers',$data);		
	}
	public function getCustomers(){
		$this->db->from("tbl_customers");
		return $this->db->get()->result_array();
	}
	
	public function getCustomer($Supplier_id){
		if($Supplier_id=="0"){
			return array('firstname'=>'Generic', 'lastname'=>'Client',"phone"=>"No Phone Number");
		}
		$products =$this->db->from('tbl_customers')->where("SN",$Supplier_id)->get()->result_array();
		foreach($products as $product);
		return $product;
	}
	
	
	
	public function saveSettings($data){
		$this->db->where("SN","1")->update("others",$data);
	}
	public function getSettings(){
		$settings =$this->db->from("others")->where("SN","1")->get();
		foreach($settings->result_array() as $set);
		if(empty($set['slogo'])){
			$set['slogo'] = base_url('store_assets/default.png');
		}
		return $set;
	}
}