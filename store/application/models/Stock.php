<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Stock extends CI_Model{

    public function add($data){
        $data['id_stock'] = $this->utils->generateUniqueID("stock","id_stock");
        $this->db->insert("stock",$data);
        $id = $this->db->insert_id();
        return $data['id_stock'];
    }
    public function update($stcok_id,$data){
        return $this->db->where("SN",$stcok_id)->update("stock",$data);
    }

    public function addStockPieces($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $this->db->where("SN",$stock['SN']);
        $newqty = $stock['quantity']+$qty;
        $this->db->update("stock", array('quantity' => $newqty));
        if($addtohistroy == TRUE){
            $this->addTohistory(array(
                "stock_id"=>$stock['SN'],
                "amt_in"=>$qty,
                "amt_out"=>0,
                "balance"=>$newqty,
                "sold"=>0
            ));
        }
    }

    public function addpacked($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $this->db->where("SN",$stock['SN']);
        $newqty = $stock['cartoon_qty']+$qty;
        $this->db->update("stock", array('cartoon_qty' => $newqty));
        if($addtohistroy == TRUE){
            $this->addTohistory(array(
                "stock_id"=>$stock['SN'],
                "amt_in"=>$qty,
                "amt_out"=>0,
                "balance"=>$newqty,
                "sold"=>0,
                "comment"=>"Void Sale add packed/cartoon product back (".$qty.") Quantity"
            ));
        }
    }

    public function addStock2($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $this->db->where("SN",$stock['SN']);
        if($stock['product_type'] == "Packed"){
            $newqty = $stock['cartoon_qty']+$qty;
            $this->db->update("stock", array('cartoon_qty' => $newqty));
        }else {
            $newqty = $stock['quantity']+$qty;
            $this->db->update("stock", array('quantity' => $newqty));
        }
        if($addtohistroy == TRUE){
            $this->addTohistory(array(
                "stock_id"=>$stock['SN'],
                "amt_in"=>$qty,
                "amt_out"=>0,
                "balance"=>$newqty,
                "sold"=>0
            ));
        }
    }

    public function addStock($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $this->db->where("SN",$stock['SN']);
        if($stock['product_type'] == "Packed"){
            $newqty = $stock['cartoon_qty']+$qty;
            $this->db->update("stock", array('cartoon_qty' => $newqty,'last_stock_date'=>date('Y-m-d')));
        }else {
            $newqty = $stock['quantity']+$qty;
            $this->db->update("stock", array('quantity' => $newqty,'last_stock_date'=>date('Y-m-d')));
        }
        if($addtohistroy == TRUE){
            $this->addTohistory(array(
                "stock_id"=>$stock['SN'],
                "amt_in"=>$qty,
                "amt_out"=>0,
                "balance"=>$newqty,
                "sold"=>0
            ));
        }
    }


    public function addTohistory($data){
        if($this->session->userdata("tracking_id")){
            $tr = $this->session->userdata("tracking_id");
        }else{
            $tr ="0";
        }
        $insert = array(
            "tracking_id"=>$tr,
            "stock_id"=>$data['stock_id'],
            "amt_in"=>$data['amt_in'],
            "amt_out"=>$data['amt_out'],
            "date_"=>date("Y-m-d"),
            "sold"=>$data['sold'],
            "balance"=>$data['balance'],
            "comment"=>(isset($data['comment']) ? $data['comment'] : ''),
            "user"=>$this->users->get_user_by_username($this->session->userdata("username"))->SN
        );
        $this->db->insert("tbl_transfer_recieved",$insert);
    }


    public function removeStock($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $newqty = $stock['quantity']-$qty;
        $this->db->where("SN",$stock['SN']);
        $this->db->update("stock",array('quantity'=>$newqty));
        if($addtohistroy == TRUE){
            if($this->session->userdata("sold")){
                $this->addTohistory(array(
                    "stock_id"=>$stock['SN'],
                    "amt_in"=>0,
                    "amt_out"=>0,
                    "sold"=>$qty,
                    "balance"=>$newqty,
                ));
            }else{
                $this->addTohistory(array(
                    "stock_id"=>$stock['SN'],
                    "amt_in"=>0,
                    "sold"=>0,
                    "amt_out"=>$qty,
                    "balance"=>$newqty,
                ));
            }
        }
    }

    public function removePackedQty($product_id,$qty,$addtohistroy = TRUE){
        $stock =$this->getStockByID($product_id);
        $newqty = $stock['cartoon_qty']-$qty;
        $this->db->where("SN",$stock['SN']);
        $this->db->update("stock",array('cartoon_qty'=>$newqty));
        if($addtohistroy == TRUE){
            if($this->session->userdata("sold")){
                $this->addTohistory(array(
                    "stock_id"=>$stock['SN'],
                    "amt_in"=>0,
                    "amt_out"=>0,
                    "sold"=>$qty,
                    "balance"=>$newqty,
                    "comment"=>"Packed/Cartoon Product (".$qty.") Sold"
                ));
            }else{
                $this->addTohistory(array(
                    "stock_id"=>$stock['SN'],
                    "amt_in"=>0,
                    "sold"=>0,
                    "amt_out"=>$qty,
                    "balance"=>$newqty,
                    "comment"=>"De-packed/Convert Product (".$qty.")"
                ));
            }
        }
    }


    public function getStocks($array = false){
        $this->db->from("stock");
        if($array!=false){
            foreach($array as $key=>$value){
                if($key!="quantity" && $key!="quantity!="){
                    $this->db->where($key,$value);
                }
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }


    public function getSellable($array = false){
        $this->db->from("stock");
        $this->db->where("quantity >","0");
        $product = array();
        if($array!=false){
            foreach($array as $key=>$value){
                if($key!="quantity" && $key!="quantity!="){
                    $this->db->where($key,$value);
                }
            }
        }
        $pros = $this->db->get()->result_array();
        foreach($pros as $pro){
            if($pro['product_type'] == "Packed"){
                if($pro['cartoon_qty'] > 0){
                    $product[] = $pro;
                }
            }else{
                $product[] = $pro;
            }
        }

        return $product;
    }


    public function getStocksToRecieved($array = false){
        $this->db->from("stock");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $history =$this->db->get();
        return $history->result_array();
    }
    public function getBranch_id(){
        $get =$this->users->get_user_by_username($this->session->userdata("username"));
        return $get->branch_id;
    }

    public function getStock($stock_id){
        $this->db->select("*");
        $this->db->from("stock");
        $this->db->or_where('SN',$stock_id);
        $this->db->or_where('id_stock',$stock_id);
        $record =$this->db->get()->result_array();
        return $record;
    }

    public function getStockByBarcode($stock_id){
        $this->db->select("*");
        $this->db->from("stock");
        $this->db->or_where('SN',$stock_id);
        $this->db->or_where('id_stock',$stock_id);
        $this->db->or_where('bar_code_code',$stock_id);
        $record =$this->db->get()->row_array();
        return $record;
    }

    public function getStockByID($stock_id){
        $this->db->from("stock");
        $this->db->or_where('SN',$stock_id);
        $this->db->or_where('id_stock',$stock_id);
        $record =$this->db->get();
        foreach($record->result_array() as $rec);
        $cat = $this->db->get_where("category",array("SN"=>$rec['category_id']))->row_array();
        unset($cat['SN']);
        unset($cat['category']);
        unset($cat['updated']);
        unset($cat['created']);
        return array_merge($rec,$cat);
    }

    public function stock_data_tables($limit=false,$offset=false,$search=false){
        $_POST['offset'] = ($_POST['offset']=="0" ? false : $_POST['offset']);
        $this->db->from("stock");
        $this->db->order_by("SN","DESC");
        if($limit!=false && $offset==false){
            $this->db->limit($limit);
        }
        if($limit!=false && $offset!=false){
            $this->db->limit($limit,($offset*$limit));
        }
        if($search!=false){
            $this->db->like('product_name',$search);
        }
        $history =$this->db->get();
        return $history->result_array();
    }


    public function addManufacturer($data){
        $this->db->insert("manufacturer",$data);
    }


    public function getManufacturers(){
        $this->db->from("manufacturer");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }

    public function getMovies(){
        $this->db->from("movies");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }

    public function getGenre(){
        $this->db->from("genre");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }

    public function getManufacturer($id){
        $this->db->from("manufacturer");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        return $record->result_array();
    }

    public function addcategory($data){
        $this->db->insert("category",$data);
    }

    public function getCategories(){
        $this->db->from("category");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }


    public function getCategory($id){
        $this->db->from("category");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        return $record->result_array();
    }

    public function addBank($data){
        $this->db->insert("tbl_bank",$data);
    }

    public function getBanks(){
        $this->db->from("tbl_bank");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }


    public function getBank($id){
        $this->db->from("tbl_bank");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        return $record->row_array();
    }



    public function addSupplier($data){
        $this->db->insert("supplier",$data);
    }


    public function getSuppliers(){
        $this->db->from("supplier");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }


    public function getSupplier($id){
        $this->db->from("supplier");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        foreach($record->result_array() as $info);
        return $info;
    }



    public function addBranch($data){
        $this->db->insert("branch",$data);
    }


    public function getBranches(){
        $this->db->from("branch");
        $this->db->where("delete_status","0");
        $this->db->order_by("SN","DESC");
        $record =$this->db->get();
        return $record->result_array();
    }


    public function getBranch($id){
        $this->db->from("branch");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        foreach($record->result_array() as $br)
            return $br;
    }

    public function getBranch_name($id){
        $this->db->from("branch");
        $this->db->order_by("SN","DESC");
        $this->db->where("SN",$id);
        $record =$this->db->get();
        foreach($record->result_array() as $br)
            return $br['branch_name'];
    }


    public function update_barcode_status($bar_code,$value){
        // 0 = available
        // 1 = sold
        //2 = transfer
        //3 pickup
        return $this->db->where("bar_code",$bar_code)->update("product_bar_code",array('status'=>$value,'recieved_ref'=>''));
    }


    public function add_barcode($stock_id,$barcode,$ref_id=FALSE){
        foreach($barcode as $bar){
            $sti =$this->getStock($stock_id);
            $insert_array = array(
                'bar_code'=>$bar,
                'stock_id'=>$sti['SN'],
                'date_available'=>date("Y-m-d"),
                'added_by'=>$this->tank_auth->get_user_id(),
                'recieved_ref' => ($ref_id==FALSE ? '' : $ref_id)
            );
            $this->db->insert("product_bar_code",$insert_array);
        }
    }

    public function delete_barcode($bar_code){
        $this->db->where("bar_code",$bar_code)->delete("product_bar_code");
    }
    public function add_product_to_batch($product_id, $qty, $expiry_date){
        $product = $this->getStockByID($product_id);
        $batch = $this->db->get_where('batch_table',array('expiry_date'=>$expiry_date));
        if($batch->num_rows() > 0){
            $batch = $batch->row_array();

            $batch_product = $this->db->get_where('batch_product_table',array(
                    'product_id'=>$product['SN'],
                    'batch_id'=>$batch['SN'],
                    'expiry_date'=>$expiry_date
                )
            );
            if($batch_product->num_rows() > 0){
                $batch_product = $batch_product->row_array();
                $quantity = $batch_product['quantity'];
                $quantity+=$qty;
                $this->db->where('SN',$batch_product['SN'])->update('batch_product_table',array('quantity'=>$quantity));
            }else{
                $insert_batch_product = array(
                    'batch_code'=>$batch['batch_id'],
                    'batch_id'=>$batch['SN'],
                    'product_id'=>$product['SN'],
                    'price'=>$product['price'],
                    'quantity'=>$qty,
                    'expiry_date'=>$expiry_date,
                    'date_recieved'=>date('Y-m-d'),
                    'current_batch'=>'No'
                );

                $this->db->insert('batch_product_table',$insert_batch_product);
            }
        }else{
            $batch_number = $this->generateBatchNumber();
            $insert = array(
                'expiry_date'=>$expiry_date,
                'batch_id'=>$batch_number,
                'user'=>$this->tank_auth->get_user_id(),
                'current_batch'=>'No'
            );
            $this->db->insert("batch_table",$insert);
            $id = $this->db->insert_id();

            //insert product to the batch

            $insert_batch_product = array(
                'batch_code'=>$batch_number,
                'batch_id'=>$id,
                'product_id'=>$product['SN'],
                'price'=>$product['price'],
                'quantity'=>$qty,
                'expiry_date'=>$expiry_date,
                'date_recieved'=>date('Y-m-d'),
                'current_batch'=>'No'
            );

            $this->db->insert('batch_product_table',$insert_batch_product);
        }
    }
    public function generateBatchNumber(){
        $batch_number = $this->utils->generateUniqueID("batch_table","batch_id");
        return $batch_number;
    }

    public function recieve_stock_single($qty,$product_id,$expiry_date = false){
        $recieved_id= $this->utils->generateUniqueID("stock_recieved","recieved_id");
        if($expiry_date !== false){
            $this->add_product_to_batch($product_id,$qty,$expiry_date);
        }
        $product = array(
            array('qty'=>$qty,"remark"=>"Received","product"=>$product_id)
        );
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['recieved_id'] = $recieved_id;
        $save_data['recieved_date'] = date('Y-m-d');
        $save_data['recieved_id'] = $recieved_id;
        $save_data['supplier'] = 1;
        $save_data['reciever_userfullname'] = $this->tank_auth->get_user_id();
        $save_data['transfer_user'] = 'Almas';
        $this->session->set_userdata("tracking_id",$recieved_id);
        $this->addStock($product_id,$qty);
        return $this->db->insert("stock_recieved",$save_data);
    }

    public function recieve_stock($data){
        $product = array();
        $recieved_id= $this->utils->generateUniqueID("stock_recieved","recieved_id");
        foreach($data['product'] as $key=>$trns_product){
            $product[] = array(
                'qty'=>$data['qty'][$key],
                'product'=>$trns_product,
                'remark'=>'Received'
            );
            if(isset($data['expiry_date'][$key])){
                $this->add_product_to_batch($trns_product,$data['qty'][$key],$data['expiry_date'][$key]);
            }

        }
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['recieved_id'] = $recieved_id;
        $save_data['recieved_date'] = $data['recieved_date'];
        if(isset($data['branch'])){
            $save_data['branch'] = $data['branch'];
        }else{
            $save_data['supplier'] = $data['supplier'];
        }
        $save_data['branch_id'] = $this->getBranch_id();
        $save_data['reciever_userfullname'] = $this->tank_auth->get_user_id();;
        $save_data['transfer_user'] = $data['transfer_user'];
        $save_data['note'] = $data['transfer_note'];
        $this->session->set_userdata("tracking_id",$recieved_id);
        foreach($data['product'] as $key=>$id){
            $this->addStock($data['product'][$key],$data['qty'][$key]);
        }
        return $this->db->insert("stock_recieved",$save_data);
    }

    public function transfer_stock($data){
        $product = array();

        foreach($data['product'] as $key=>$trns_product){
            $product[] = array(
                'qty'=>$data['qty'][$key],
                'product'=>$trns_product,
                'remark'=>'transfer',
            );
        }
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['transfer_id'] = $this->utils->generateUniqueID("stock_transfer","transfer_id");
        $save_data['transfer_date'] = $data['transfer_date'];
        $save_data['branch'] = $data['branch'];
        $save_data['reciever_userfullname'] = $data['reciever_userfullname'];
        $save_data['transfer_user'] = $this->tank_auth->get_user_id();
        $save_data['note'] = $data['transfer_note'];
        $save_data['branch_id'] = $this->getBranch_id();
        $this->session->set_userdata("tracking_id",$save_data['transfer_id']);
        foreach($product as $key=>$id){
            $p = $this->getStockByID($product[$key]['product']);
            if($p['product_type'] == "Packed"){
                $this->removePackedQty($product[$key]['product'], $product[$key]['qty']);
            }else {
                $this->removeStock($product[$key]['product'], $product[$key]['qty']);
            }
        }
        return $this->db->insert("stock_transfer",$save_data);
    }

    public function update_stock($transfer_id,$data){
        //first lets reverse what we did to stock list before
        $transfer = $this->getTransferByTransferID($transfer_id);
        $products = json_decode($transfer['products'],TRUE);
        foreach($products  as $key=>$id){
            $this->addStock($products[$key]['product'],$products[$key]['qty']);
            $barcodes = $products[$key]['product_barcodes'];
            $barcodes= explode(",",$barcodes);
            foreach($barcodes as $barcode){
                $this->update_barcode_status($barcode,0);
            }
        }
        foreach($data['product'] as $key=>$trns_product){
            $product[] = array(
                'qty'=>$data['qty'][$key],
                'product'=>$trns_product,
                'remark'=>'transfer',
                'product_barcodes'=>$data['bar_code'][$key]
            );
        }
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['transfer_date'] = $data['transfer_date'];
        $save_data['branch'] = $data['branch'];
        $save_data['reciever_userfullname'] = $data['reciever_userfullname'];
        $save_data['transfer_user'] = $this->tank_auth->get_user_id();
        $save_data['note'] = $data['transfer_note'];
        $this->session->set_userdata("tracking_id",$transfer['transfer_id']);
        foreach($product as $key=>$id){
            $this->removeStock($product[$key]['product'],$product[$key]['qty']);
            $product_barcodes = explode(",",$product[$key]['product_barcodes']);
            foreach($product_barcodes as $bar){
                $this->update_barcode_status($bar,2);
            }
        }

        return $this->db->where("transfer_id",$transfer_id)->update("stock_transfer",$save_data);
    }




    public function getStocktransfers($array=FALSE){
        $br =$this->getBranch_id();
        $this->db->from("stock_transfer");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br!=0){
            $this->db->where("branch_id",$br);
        }
        $transfers = $this->db->get();
        return $transfers->result_array();
    }

    public function getStocktransfersBetween($from,$to,$array=FALSE){
        $br =$this->getBranch_id();
        $this->db->from("stock_transfer");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br==0){
            $this->db->where("(transfer_date BETWEEN '$from' AND '$to')");
        }else{
            $this->db->where("(transfer_date BETWEEN '$from' AND '$to') AND branch_id='$br'");
        }
        $transfers = $this->db->get();
        return $transfers->result_array();
    }

    public function outReport($from,$to,$array=FALSE){
        $br =$this->getBranch_id();
        $total_ =0;
        $this->db->from("stock_transfer");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br==0){
            $this->db->where("(transfer_date BETWEEN '$from' AND '$to')");
        }else{
            $this->db->where("(transfer_date BETWEEN '$from' AND '$to') AND branch_id='$br'");
        }
        $transfers = $this->db->get();
        foreach($transfers->result_array() as $trnx){
            foreach(json_decode($trnx['products'],true) as $pr){
                $total_ = $total_+$pr['qty'];
            }
        }
        return $total_;
    }

    public function inReport($from,$to,$array=FALSE){
        $br =$this->getBranch_id();
        $total_ =0;
        $this->db->from("stock_recieved");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br==0){
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to')");
        }else{
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to') AND branch_id='$br'");
        }
        $transfers = $this->db->get();
        foreach($transfers->result_array() as $trnx){
            foreach(json_decode($trnx['products'],true) as $pr){
                $total_ = $total_+$pr['qty'];
            }
        }
        return $total_;
    }

    public function getStockrecievedBetween($from,$to,$array=FALSE){
        $br =$this->getBranch_id();
        $this->db->from("stock_recieved");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br==0){
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to')");
        }else{
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to')  AND branch_id='$br'");
        }
        $transfers = $this->db->get();
        return $transfers->result_array();
    }

    public function getStockrecieved($array=FALSE){
        $br =$this->getBranch_id();
        $this->db->from("stock_recieved");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br!=0){
            $this->db->where("branch_id",$br);
        }
        $transfers = $this->db->get();
        return $transfers->result_array();
    }


    public function getTransferByTransferID($transfer_id){
        $this->db->from("stock_transfer");
        $this->db->where("transfer_id",$transfer_id);
        $transfer =$this->db->get();
        foreach($transfer->result_array() as $trans);
        return $trans;
    }

    public function getReceiveByReceiveID($transfer_id){
        $this->db->from("stock_recieved");
        $this->db->where("recieved_id",$transfer_id);
        $transfer =$this->db->get();
        foreach($transfer->result_array() as $trans);
        return $trans;
    }

    public function addSupplierInvoice($data){
        $product = array();
        $recieved_id= $this->utils->generateUniqueID("supplier_invoice","supplier_id");
        foreach($data['product'] as $key=>$trns_product){
            $product[] = array(
                'qty'=>$data['qty'][$key],
                'product'=>$trns_product,
                'remark'=>'Received'
            );
        }
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['supplier_id'] = $recieved_id;
        $save_data['supplier'] = $data['supplier'];
		$save_data['total_invoice_amount'] = $data['total_invoice_amount'];
        $save_data['recieved_date'] = $data['recieved_date'];
        $save_data['branch_id'] = $this->getBranch_id();
        $save_data['note'] = $data['transfer_note'];
        //$save_data['bank'] = $data['bank'];
        //$save_data['amount_paid'] = $data['amount_paid'];
        //$save_data['payment_method'] = $data['payment_method'];
        $save_data['status'] = $data['status'];
        return $this->db->insert("supplier_invoice",$save_data);
    }

    public function update_stock_recieved($transfer_id,$data){
        //first lets reverse what we did to stock list before
        $transfer = $this->getReceiveByReceiveID($transfer_id);
        $products = json_decode($transfer['products'],TRUE);
        foreach($products  as $key=>$id){
            $this->removeStock($products[$key]['product'],$products[$key]['qty']);
        }
        foreach($data['product'] as $key=>$trns_product){
            $product[] = array(
                'qty'=>$data['qty'][$key],
                'product'=>$trns_product,
                'remark'=>'Received'
            );
        }
        $save_data = array();
        $save_data['products']= json_encode($product);
        $save_data['recieved_date'] = $data['recieved_date'];
        if(isset($data['branch'])){
            $save_data['branch'] = $data['branch'];
        }else{
            $save_data['supplier'] = $data['supplier'];
        }
        $save_data['reciever_userfullname'] = $this->tank_auth->get_user_id();
        $save_data['transfer_user'] = $data['transfer_user'];
        $save_data['note'] = $data['transfer_note'];

        $this->session->set_userdata("tracking_id",$transfer['recieved_id']);
        foreach($product as $key=>$id){
            $this->addStock($data['product'][$key],$data['qty'][$key]);
        }

        return $this->db->where("recieved_id",$transfer_id)->update("stock_recieved",$save_data);
    }


    public function getProductAssociatedWithBarcode($barcode){
		$dpt = $this->users->get_user_by_username($this->session->userdata("username"))->department;
		if($dpt !="Top Administrator"){
			$where = "AND stock.department='$dpt'";
		}else{
			$where="";
		}
        $query = "select *,stock.SN as cat_id from stock  JOIN category ON stock.category_id=category.SN where (stock.bar_code_code ='$barcode' OR stock.SN='$barcode') ".$where;
        $product = $this->db->query($query);
        if($product->num_rows() > 0){
            return $product->row_array();
        }else{
            return false;
        }
    }

    public function getProductBySe($barcode){
        $query = "select *,stock.SN as cat_id from stock  JOIN category ON stock.category_id=category.SN where stock.SN='$barcode'";
        $product = $this->db->query($query);
        if($product->num_rows() > 0){
            return $product->row_array();
        }else{
            return false;
        }
    }

    public function getCinemaServiceAssociatedWithBarcode($barcode){
        $product = $this->db->get_where('movies_shows',array('SN'=>$barcode));

        if($product->num_rows() > 0) {
            $product = $product->row_array();
            $movie = $this->db->get_where('movies_shows',array('SN'=>$product['movie_id']))->row_array();
            return [
                "SN"=> $product['SN'],
                "id_stock"=>$product['servicecode'],
                "product_name"=>$movie['title'],
                "quantity"=>($product['seats']- $product['qty_sold']),
                "price"=>$product['price'],
                "track"=>1
            ];
        }else{
            return false;
        }

    }

    public function getServiceAssociatedWithBarcode($barcode){
        $department = $this->getUserDepartment();
        if($department == "Cinema") {
            return $this->getCinemaServiceAssociatedWithBarcode($barcode);
        }else {
            if ($department == 'Top Administrator') {
                $department = $this->session->userdata('top_administrator_department');
                if($department == "Cinema") {
                    return $this->getCinemaServiceAssociatedWithBarcode($barcode);
                }else {
                    $product = $this->db->get_where('services', array('SN' => $barcode, 'department' => $department));
                }
            } else {
                $product = $this->db->get_where('services', array('SN' => $barcode, 'department' => $department));
            }
        }
        if($product->num_rows() > 0){
            $product = $product->row_array();
            return [
                "SN"=> $product['SN'],
                "id_stock"=>$product['servicecode'],
                "product_name"=>$product['name'],
                "quantity"=>"Nil",
                "track"=>0,
                "price"=>$product['price'],
            ];

        }else{
            return false;
        }
    }

    public function getProductBySearch($text){
        $department = $this->getUserDepartment();
        if($department == 'Top Administrator'){
            $department = $this->session->userdata('top_administrator_department');
            $product = $this->db->query("SELECT * FROM stock WHERE (department='{$department}') AND (product_name LIKE '%{$text}%' OR model LIKE '%{$text}%')");
        }else {
            $product = $this->db->query("SELECT * FROM stock WHERE (department='{$department}') AND (product_name LIKE '%{$text}%' OR model LIKE '%{$text}%')");
        }
        if($product->num_rows() > 0){
            $products = array();
            foreach($product->result_array() as $prod){
                $products[] = array("id"=>$prod['SN'],"name"=>$prod['product_name']);
            }
            return $products;
        }else{
            return array();
        }
    }

    public function getProductBySearchService($text){
        $department = $this->getUserDepartment();
        if($department == "Cinema"){
            return $this->search_current_show($text);
        }else {
            if ($department == 'Top Administrator') {
                $department = $this->session->userdata('top_administrator_department');
                if($department == "Cinema"){
                    return $this->search_current_show($text);
                }else {
                    $product = $this->db->query("SELECT * FROM services WHERE (department='{$department}') AND (name LIKE '%{$text}%' OR description LIKE '%{$text}%')");
                }
            } else {
                $product = $this->db->query("SELECT * FROM services WHERE (department='{$department}') AND (name LIKE '%{$text}%' OR description LIKE '%{$text}%')");
            }

            if ($product->num_rows() > 0) {
                $products = array();
                foreach ($product->result_array() as $prod) {
                    $products[] = array("id" => $prod['SN'], "name" => $prod['name']);
                }
                return $products;
            } else {
                return array();
            }
        }
    }

    public function search_current_show($text){
        $date = date('Y-m-d');
        $product = $this->db->query("SELECT *,movies_shows.SN as show_id FROM movies JOIN movies_shows ON movies.SN=movies_shows.movie_id WHERE (movies_shows.date_='{$date}') AND (movies.title LIKE '%{$text}%' OR movies.description LIKE '%{$text}%')");
        if ($product->num_rows() > 0) {
            $products = array();
            foreach ($product->result_array() as $prod) {
                $products[] = array("id" => $prod['show_id'], "name" => $prod['title']);
            }
            return $products;
        } else {
            return array();
        }
    }

    public function getSale($recipt_id){
        $products =$this->db->from('sales')->or_where("reciept_id",$recipt_id)->or_where("SN",$recipt_id)->get()->result_array();
        if(count($products) >0){
            foreach($products as $product);
            return $product;
        }
        return false;
    }


    public function getSales($array=FALSE){
        $this->db->from('sales');
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }

        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }
    public function getSalesRange($from,$to,$array=FALSE){
        $this->db->from('sales');
        $this->db->where("date BETWEEN '$from' AND '$to'");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }

    public function getPaymentMethod(){
        return $this->db->get("payment_method")->result_array();
    }


    public function getFullDepositRange($from,$to,$array=FALSE){
        $this->db->from('deposit_payment_history');
        $this->db->where("date_added BETWEEN '$from' AND '$to'");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        $d_ps = $this->db->get()->result_array();
        foreach($d_ps as $key=>$d_p){
            $dep = $this->db->get_where('deposit',array('SN'=>$d_p['deposit_SN']))->result_array()[0];
            unset($d_ps[$key]['sn']);
            $d_ps[$key]['SN'] = $d_ps[$key]['SN'] = $dep['SN'];
        }

        return $d_ps;
    }
    public function getDepositRange($from,$to,$array=FALSE){
        $this->db->from('deposit');
        $this->db->where("date_added BETWEEN '$from' AND '$to'");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }
    public function getDeposithistoryRange($from,$to,$array=FALSE){
        $this->db->from('deposit_payment_history');
        $this->db->where("date_added BETWEEN '$from' AND '$to'");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }

    public function getTotalAmountDeposited($d_id,$formated = FALSE){
        $this->db->from("deposit_payment_history");
        $this->db->where("deposit_SN",$d_id);
        $rec = $this->db->get()->result_array();
        $total = 0;
        foreach($rec as $r){
            $total= $total + $r['amount'];
        }
        if($formated){
            return number_format($total,2);
        }
        return $total;
    }


    public function getDepositPayment($d_id){
        $this->db->from("deposit_payment_history");
        $this->db->where("SN",$d_id);
        return  $this->db->get()->result_array()[0];
    }

    public function getDepositall($d_id){
        $this->db->from("deposit_payment_history");
        $this->db->where("deposit_SN",$d_id);
        $rec = array();
        $rec['payment_history']=  $this->db->get()->result_array();
        $this->db->from("deposit");
        $this->db->where("SN",$d_id);
        $rec['deposit'] = $this->db->get()->result_array()[0];
        return $rec;
    }


    public function getCredit($recipt_id){
        $products =$this->db->from('tbl_credit_sales')->or_where("SN",$recipt_id)->or_where("credit_id",$recipt_id)->get()->result_array();
        if(count($products) >0){
            foreach($products as $product);
            return $product;
        }
        return false;
    }


    public function getCredits($array=FALSE){
        $this->db->from('tbl_credit_sales');
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }

    public function getCreditRange($from,$to,$array=FALSE){
        $this->db->from('tbl_credit_sales');
        $this->db->where("date BETWEEN '$from' AND '$to'");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }

    public function getTotalAmountCreditPaid($d_id,$formated = FALSE){
        $this->db->from("credit_payment_history");
        $this->db->where("credit_SN = '$d_id' OR credit_id='$d_id'");
        $rec = $this->db->get()->result_array();
        $total = 0;
        foreach($rec as $r){
            $total= $total + $r['amount'];
        }
        if($formated){
            return number_format($total,2);
        }
        return $total;
    }


    public function getCreditPayment($d_id){
        $this->db->from("credit_payment_history");
        $this->db->where("SN",$d_id);
        return  $this->db->get()->result_array()[0];
    }


    public function getCreditall($d_id){
        $this->db->from("credit_payment_history");
        $this->db->where("credit_SN = '$d_id' OR credit_id='$d_id'");
        $rec = array();
        $rec['payment_history']=  $this->db->get()->result_array();
        $this->db->from("tbl_credit_sales");
        $this->db->where("SN = '$d_id' OR credit_id='$d_id'");
        $rec['deposit'] = $this->db->get()->result_array()[0];
        return $rec;
    }


    public function getExpenses($array=FALSE){
        $this->db->from("tbl_expenses");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $payments =$this->db->order_by("SN","DESC")->get();
        return $payments->result_array();
    }

    public function getExpensesRange($from=FALSE,$to=FALSE,$array=FALSE){
        $this->db->from("tbl_expenses");
        if($array!=false){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($from != FALSE && $to != FALSE){
            $this->db->where("expense_date BETWEEN '$from' AND '$to'");
        }
        $payments =$this->db->order_by("SN","DESC")->get();
        return $payments->result_array();
    }

    public function addExpenses($data){
        $months = array("January"=>"1", "February"=>"2", "March"=>"3", "April"=>"4", "May"=>"5",
            "June"=>"6", "July"=>"7",
            "August"=>"8","September"=>"9","October"=>"10","November"=>"11","December"=>"12");
        $months = array_flip($months);
        $mnth = explode("-",$_POST['expense_date']);

        $m = $mnth[1];
        $y = $mnth[0];

        $data['month_number'] = $m;
        $data['year'] = $y;
        $data['month'] =$months[(int)$m];
        $this->db->insert("tbl_expenses",$data);
    }

    public function updateExpenses($data,$sn){
        $months = array("January"=>"1", "February"=>"2", "March"=>"3", "April"=>"4", "May"=>"5",
            "June"=>"6", "July"=>"7",
            "August"=>"8","September"=>"9","October"=>"10","November"=>"11","December"=>"12");
        $months = array_flip($months);
        $mnth = explode("-",$_POST['expense_date']);

        $m = $mnth[1];
        $y = $mnth[0];

        $data['month_number'] = $m;
        $data['year'] = $y;
        $data['month'] =$months[(int)$m];
        $this->db->where("SN",$sn)->update("tbl_expenses",$data);
    }

    public function delete_expenses($id){
        return $this->db->where("SN",$id)->delete("tbl_expenses");
    }


    public function getpaymentgenerated($limit=false,$type=false){
        $this->db->from('tbl_payment_payrole');
        if($limit!=false){
            $this->db->limit(4);
        }
        if($type!=false){
            $this->db->where("type",$type);
        }
        $this->db->order_by("SN","DESC");
        return $this->db->get()->result_array();
    }

    public function getpaymentgeneratedbyid($id){
        $payments= $this->db->from("tbl_payment_payrole")->where("SN",$id)->get()->result_array();
        foreach($payments as $pay);
        return $pay;
    }

    public function getpaymentgeneratedhistorybypaymentid($id){
        return $this->db->from("tbl_payment_payrole_history")->where("payment_id",$id)->get()->result_array();
    }


    public function numberofgetexpiredproduct(){
        $extra_charges=$this->db->get_where('others',array("SN"=>"1"))->row_array();
        $track = $extra_charges['track_expiry_date'];
        $date = strtotime('+ '.$track.' days');
        $ex_date = date('Y-m-d',$date);
        $batch_table = $this->db->from('batch_table')->where('status','unsorted')->where('expiry_date <',$ex_date)->get();
        return $batch_table->num_rows();
    }


    public function getInvoiceAmountpaid($d_id,$formated = FALSE){
        $this->db->from("invoice_payment_history");
        $this->db->where("Invoice_SN",$d_id);
        $rec = $this->db->get()->result_array();
        $total = 0;
        foreach($rec as $r){
            $total= $total + $r['amount'];
        }
        if($formated){
            return number_format($total,2);
        }
        return $total;
    }

    public function addInvoicePayment($invoice_id,$data){
        $save_data = array();
        $save_data['amount'] = $data['amount_paid'];
        $save_data['Invoice_SN'] = $invoice_id;
        $save_data['date_added'] = $data['recieved_date'];
        $save_data['supplier_id'] = $data['supplier_id'];
        $save_data['payment_method'] = $data['payment_method'];
        $save_data['invoice_id'] = $data['invoice_id'];
        return $this->db->insert("invoice_payment_history",$save_data);
    }

    public function getInvoicePaymentHistory($d_id){
        $this->db->from("invoice_payment_history");
        $this->db->where("Invoice_SN",$d_id);
        return  $this->db->get()->result_array();
    }

    public function getSupplierInvoiceID($transfer_id){
        $this->db->from("supplier_invoice");
        $this->db->where("supplier_id",$transfer_id);
        $transfer =$this->db->get();
        foreach($transfer->result_array() as $trans);
        return $trans;
    }

    public function getSupplierInvoiceBetween($from,$to,$array=FALSE){
        $br =$this->getBranch_id();
        $this->db->from("supplier_invoice");
        if($array!=FALSE){
            foreach($array as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($br==0){
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to')");
        }else{
            $this->db->where("(recieved_date BETWEEN '$from' AND '$to')  AND branch_id='$br'");
        }
        $this->db->order_by("SN","DESC");
        $transfers = $this->db->get();
        return $transfers->result_array();
    }


    public function getTotalDiscountByProduct($sales_id){
        $items = $this->db->get_where("sales",array("reciept_id"=>$sales_id))->row()->items;
        $items = json_decode($items,true);
        $total =0;
        foreach($items as $item){
            $total+=@$item['discount'];
        }
        return $total;
    }

    function getCurrentBatchExpiryDate($product_id){
        return date('Y-m-d');
    }


    function getStockDepartmentlist(){
        $user_id = $this->tank_auth->get_user_id();
        $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
        if($user['department'] == "Top Administrator"){
            $user['department'] = $this->session->userdata('top_administrator_department');
        }
        if($user['department'] == "Cinema"){
            return $this->getCinemaproduct();
        }
        $dpt = $this->db->get_where('department',array('department'=>$user['department']))->row();
        if($dpt->type == "Service"){
            return $this->getServiceProductList($user['department']);
        }
        return array();
    }

    public function getServiceProductList($department){
        $products = $this->db->get_where('services',array("status"=>"1","department"=>$department))->result_array();
        $product_array = [];
        foreach($products as $product){
            $product_array[] = array(
                'price'=>$product['price'],
                'SN'=>$product['SN'],
                'track'=>0,
                'product_name'=>$product['name'],
                'quantity'=>0
            );
        }

        return $product_array;
    }

    public function getCinemaproduct(){
        $movies = $this->db->get_where('movies_shows',array("date_"=>date('Y-m-d')));
        $product_array = [];
        foreach($movies->result_array() as $movie){
            $detail = $this->db->get_where('movies',array('SN'=>$movie['movie_id']))->row_array();
            $product_array[] = array(
                'price'=>$movie['price'],
                'SN'=>$movie['SN'],
                'track'=>1,
                'qty_sold'=>$movie['qty_sold'],
                'product_name'=>$detail['title'],
                'quantity'=>$movie['seats']-$movie['qty_sold']
            );
        }
        return $product_array;
    }

    public function getShow($show_id){
        $show =  $this->db->get_where('movies_shows',array('SN'=>$show_id))->row_array();
        $detail = $this->db->get_where('movies',array('SN'=>$show['movie_id']))->row_array();
        $product_array = array(
            'price'=>$show['price'],
            'SN'=>$show['SN'],
            'track'=>1,
            'qty_sold'=>$show['qty_sold'],
            'product_name'=>$detail['title'],
            'quantity'=>$show['seats']-$show['qty_sold']
        );
        return $product_array;
    }

    public function getUserDepartment(){
        $user_id = $this->tank_auth->get_user_id();

        $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
        return $user['department'];
    }
    public function getUserDepartmentPos(){
        $user_id = $this->tank_auth->get_user_id();
        $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
        if($user['department'] == "Top Administrator"){
            return $this->session->userdata("top_administrator_department");
        }
        return $user['department'];
    }

    public function getDepartments(){
        return $this->db->from('department')->order_by('SN','DESC')->get()->result_array();
    }

    public function getServiceCategories(){
        return $this->db->from('service_category')->order_by('SN','DESC')->get()->result_array();
    }

    public function getServiceCategory($id){
        return $this->db->from('service_category')->where('SN',$id)->order_by('SN','DESC')->get()->row_array();
    }


    public function getService($service_id){
        return $this->db->get_where('services',array('SN'=>$service_id))->row_array();
    }


    public function getVatablePrice($sn){
        $stock = $this->getStockByID($sn);
        $cat = $this->getCategory($stock['category_id']);
        $cat = $cat[0];
        $vat = $cat['vat'];
        if($stock['product_type'] == "Packed"){
            $vatable_packed_price = ($vat/100) * $stock['whole_price'];
            $vatable_pieces_price =  ($vat/100) *  $stock['price'];
            return  number_format(($vatable_pieces_price+$stock['price']),2)." / ". number_format(($vatable_packed_price+$stock['whole_price']),2);
        }else{
            $vatable_price = ($vat/100) * $stock['price'];
            return number_format(($stock['price']+$vatable_price),2);
        }
    }
}


?>
