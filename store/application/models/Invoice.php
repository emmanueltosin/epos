<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Invoice extends CI_Model{
	
	
	public function create_reservation_invoice($invoice_details){
		$invoice_id =$this->utils->generateUniqueID('tbl_invoice_history','invoice_id');
		$user = $this->user->getUser();
		$array = array(
					'type'=>$invoice_details['type'],
					'invoice_id'=>$invoice_id,
					'customer'=>$invoice_details['customer_id'],
					'department'=>$invoice_details['department'],
					'amount'=>$invoice_details['amount'],
					'user_created'=>$user['id'],
					'last_modeified_user'=>$user['id'],
					'invoice_item'=>$invoice_details['invoice_item'],
					'date_added'=>date('Y-m-d')
				);
		$this->db->insert("tbl_invoice_history",$array);
		$return = array('invoice_id'=>$invoice_id,'SN'=>$this->db->insert_id());
		return $return;
	}
	
	
	public function update_reservation_invoice($invoice_id,$invoice_details){
		$user = $this->user->getUser();
		$array = array(
					'type'=>$invoice_details['type'],
					'customer'=>$invoice_details['customer_id'],
					'department'=>$invoice_details['department'],
					'amount'=>$invoice_details['amount'],
					'last_modeified_user'=>$user['id'],
					'invoice_item'=>$invoice_details['invoice_item'],
				);
		$this->db->where("invoice_id",$invoice_id)->update("tbl_invoice_history",$array);
		return true;
	}
	
	public function getPendingCustomerInvoice($customer_id,$array =FALSE){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		$this->db->where("payment_status","0");
		$this->db->where("customer",$customer_id);
		if($array!=false){
			foreach($array as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice =$this->db->get();
		return $invoice->result_array();
	}
	
	public function getPendingDashCustomerInvoice(){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		$this->db->where("payment_status","0");		
		$invoice =$this->db->get();
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		return $invoice->result_array();
	}
	
	public function getPaidDashCustomerInvoice(){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		$this->db->where("payment_status","1");		
		$invoice =$this->db->get();
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		return $invoice->result_array();
	}
	
	
	public function getTotalIncome($month){
		$br = $this->stock->getBranch_id();
		$user_type = $this->users->get_user_by_username($this->session->userdata("username"))->role;
		$user_id = $this->users->get_user_by_username($this->session->userdata("username"))->SN;
        $department = $this->users->get_user_by_username($this->session->userdata("username"))->department;
		$this->db->select("SUM(total_amount_paid) as total");
		$this->db->from("sales");
		$this->db->where("Month(date)",$month);
		$this->db->where("status","COMPLETE");
		if($user_type=="Sales Representative"){
			$this->db->where("user_id",$user_id);
		}
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
        if($department !="Top Administrator"){
            $this->db->where("department",$department);
        }
		$invoice =$this->db->get();
		if(isset($invoice->result_array()[0]['total'])){
		return $invoice->result_array()[0]['total'];
		}
		return 0;
	}	
	
	public function getDailyIncome($month){
		$br = $this->stock->getBranch_id();
		$user_type = $this->users->get_user_by_username($this->session->userdata("username"))->role;
		$user_id = $this->users->get_user_by_username($this->session->userdata("username"))->SN;
		$department = $this->users->get_user_by_username($this->session->userdata("username"))->department;
		$this->db->select("SUM(total_amount_paid) as total");
		$this->db->from("sales");
		$this->db->where("date",$month);
		$this->db->where("status","COMPLETE");
		if($user_type=="Sales Representative"){
			$this->db->where("user_id",$user_id);
		}

		if($department !="Top Administrator"){
            $this->db->where("department",$department);
        }
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice =$this->db->get();
		if(isset($invoice->result_array()[0]['total'])){
		return $invoice->result_array()[0]['total'];
		}
		return 0;
	}
	
	public function getMonthRange($from,$to){
		$br = $this->stock->getBranch_id();
		$user_type = $this->users->get_user_by_username($this->session->userdata("username"))->role;
		$user_id = $this->users->get_user_by_username($this->session->userdata("username"))->SN;
        $department = $this->users->get_user_by_username($this->session->userdata("username"))->department;
		$this->db->select("SUM(total_amount_paid) as total");
		$this->db->from("sales");
		$this->db->where("date BETWEEN '$from' AND '$to'");
		$this->db->where("status","COMPLETE");
		if($user_type=="Sales Representative"){
			$this->db->where("user_id",$user_id);
		}
        if($department !="Top Administrator"){
            $this->db->where("department",$department);
        }
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice =$this->db->get();
		if(isset($invoice->result_array()[0]['total'])){
		return $invoice->result_array()[0]['total'];
		}
		return 0;
	}
	
	public function getPaymentRange($from,$to){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_payment");
		$this->db->where("payment_date BETWEEN '$from' AND '$to'");
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice =$this->db->get();
		return $invoice->result_array();
	}
	
	public function getPayments($array=false){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_payment");
		if($array!=false){
			foreach($array as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		if($br!=0){
			$this->db->where("branch_id",$br);
		}		
		$invoice =$this->db->get();
		return $invoice->result_array();
	}
	
	public function getInvoice($invoice_id){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		$this->db->or_where("SN",$invoice_id);
		$this->db->or_where("Invoice_id",$invoice_id);
		if($br!=0){
			$this->db->where("branch_id",$br);
		}	
		$invoice = $this->db->get();
		foreach($invoice->result_array() as $in);
		return $in;
	}
	
	public function getInvoices($array=false){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		if($array!=false){
			foreach($array as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice = $this->db->get();
		return $invoice->result_array();
	}
	
	public function getInvoicesRange($from,$to,$array=false){
		$br = $this->stock->getBranch_id();
		$this->db->from("tbl_invoice_history");
		if($array!=false){
			foreach($array as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$this->db->where("date_added BETWEEN '$from' AND '$to'");
		if($br!=0){
			$this->db->where("branch_id",$br);
		}
		$invoice = $this->db->get();
		return $invoice->result_array();
	}
	public function markAspaid($invoice_id,$link_id=false){
		$In = $this->getInvoice($invoice_id);
		$payment_id =$this->utils->generateUniqueID('tbl_payment','payment_id');
		$payment_array = array(
								'payment_id'=>$payment_id,
								'cuustomer'=>$In['customer'],
								'invoice_id'=>$invoice_id,
								'invoice_serial'=>$In['SN'],
								'payment_date'=>date('Y-m-d'),
								'user'=>$this->tank_auth->get_user_id(),
								'amount'=>$In['amount'],
								'department'=>$In['department'],
								'type'=>$In['type'],
								'branch_id'=>$In['branch_id']
							);
		$this->db->insert("tbl_payment",$payment_array);
		$id = $this->db->insert_id();
		$this->db->where("invoice_id",$invoice_id)->update("tbl_invoice_history",array('payment_id'=>$payment_id,'payment_serial'=>$id,'payment_status'=>'1','last_modeified_user'=>$this->tank_auth->get_user_id()));		
		return true;
	}
	
	
	public function getInvoiceByreservation_invoice_link($reservation_invoice_link){
		$this->db->from("tbl_invoice_history");
		$this->db->where('reservation_invoice_link',$reservation_invoice_link);
		$this->db->order_by("SN","DESC");
		$invoice =$this->db->get();
		return $invoice->result_array();
	}
	
	public function getInvoiceRange($from,$to,$array=FALSE){
		$br =$this->stock->getBranch_id();
		$this->db->from('tbl_invoice_history');
		$this->db->where("date_added BETWEEN '$from' AND '$to'");
		if($br!=0){
		$this->db->where("branch_id",$br);
		}
		if($array!=false){
			foreach($array as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$this->db->order_by("SN","DESC");
		return $this->db->get()->result_array();
	}
	
}

?>