<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salereportyoy extends MY_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->database();
 
		$this->load->model('sale/Salereportyoy_model', 'salereportyoy_model');

        if (!isset($_SESSION['owner_id'])) {
            header("location: " . $this->base_url);
        }
    }

	public function index()
    {
        $data['tab'] = 'salereportyoy';
        $data['title'] = 'ລາຍງານການຂາຍຍ່ອຍ';
        $this->salelayout('sale/salereportyoy', $data);
    }


function Daylist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportyoy_model->Daylist($data);
        
	}


function Salelistdatail()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportyoy_model->Salelistdatail($data);
        
	}



function Salelistdatailinlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportyoy_model->Salelistdatailinlist($data);
        
	}


	

	function Discountlastlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportyoy_model->Discountlastlist($data);
        
	}




		function Pawnlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportyoy_model->Pawnlist($data);
        
	}



	function Excel() {
       
    $data = json_decode(file_get_contents("php://input"),true);
    if(!isset($data)){
exit();
}


if($data['excel']=='1'){
 $list = $this->salereportyoy_model->Exportexcel($data);
}else{
	$list = 'null';
}	

    $this->to_excel($list, 'brands-excel');

 

}



}