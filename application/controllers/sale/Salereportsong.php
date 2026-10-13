<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salereportsong extends MY_Controller {


// public function __construct()
//     {
//         parent::__construct();
//         $this->load->database();
//         $this->load->library('session');

//         // Explicitly set the variable name to $this->salereportsong_model
//         $this->load->model('sale/Salereportsong_model', 'salereportsong_model');

//         if (!isset($_SESSION['owner_id'])) {
//             header("location: " . $this->base_url);
//             exit();
//         }
//     }

//     public function index()
//     {
//         $data['tab'] = 'salereportsong';
//         $data['title'] = 'ລາຍງານການຂາຍສົ່ງ';
//         $this->salelayout('sale/salereportsong', $data);
//     }

//     public function Daylist()
//     {
//         $data = json_decode(file_get_contents("php://input"), true);
//         echo $this->salereportsong_model->Daylist($data);
//     }


	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        // Explicitly set the variable name to $this->salereportsong_model
        $this->load->model('sale/Salereportsong_model', 'salereportsong_model');

        if (!isset($_SESSION['owner_id'])) {
            header("location: " . $this->base_url);
            exit();
        }
    }

    public function index()
    {
        $data['tab'] = 'salereportsong';
        $data['title'] = 'ລາຍງານການຂາຍສົ່ງ';
        $this->salelayout('sale/salereportsong', $data);
    }

  //   public function Daylist()
  //   {
  //       $data = json_decode(file_get_contents("php://input"), true);
  //       echo $this->salereportsong_model->Daylist($data);

		// console.log("Daylist song:", data);
  //       // $scope.daylistData = data;
		
  //   }


	public function Daylist()
{
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Set JSON header so AngularJS automatically parses response as an Array/Object
    header('Content-Type: application/json');
    echo $this->salereportsong_model->Daylist($data);
}


function Salelistdatail()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportsong_model->Salelistdatail($data);
        
	}



function Salelistdatailinlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportsong_model->Salelistdatailinlist($data);
        
	}


	

	function Discountlastlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportsong_model->Discountlastlist($data);
        
	}




		function Pawnlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salereportsong_model->Pawnlist($data);
        
	}



	function Excel() {
       
    $data = json_decode(file_get_contents("php://input"),true);
    if(!isset($data)){
exit();
}


if($data['excel']=='1'){
 $list = $this->salereportsong_model->Exportexcel($data);
}else{
	$list = 'null';
}	

    $this->to_excel($list, 'brands-excel');

 

}



}