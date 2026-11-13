<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Home extends MY_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('home_model');
		// $this->load->model('product_value_model'); // <-- ໂຫຼດເພີ່ມບ່ອນນີ້
		
    }


	public function index()
	{






if(isset($_SESSION['store_manager_id'])){

	header("Location: ".$this->base_url."/storemanager/user_owner");
		//$data['title'] = 'C2M System';
		//$this->weblayout('webbody/home',$data);
	}




if(isset($_SESSION['store_type']) && $_SESSION['store_type']=='0' ){

//$data['saletoday'] = $this->home_model->Saletoday();

//$data['productsaletoday'] = $this->home_model->Productsaletoday();

//$data['customersaletoday'] = $this->home_model->Customersaletoday();

//$data['productoutofstock'] = $this->home_model->Productoutofstock();

//$data['productdateend'] = $this->home_model->Productdateend();

function Productdateend()
{

echo $this->home_model->Productdateend();

}


//$data['productpawnenddate'] = $this->home_model->Productpawnenddate();



$data['tab'] = 'deshboard';
$data['title'] = 'POS - manage';
		$this->deshboardlayout('deshboard/deshboard',$data);

}else if(isset($_SESSION['store_type']) && $_SESSION['store_type']=='1'){

$data['tab'] = 'deshboard';
$data['title'] = 'Food - manage';
		$this->deshboardlayout('deshboard/food',$data);

}else if(isset($_SESSION['store_type']) && $_SESSION['store_type']=='2'){

$data['tab'] = 'deshboard';
$data['title'] = 'Apartment - manage';
		$this->deshboardlayout('deshboard/apartment',$data);

}else{
	header("Location: ".$this->base_url."/login");
		//$data['title'] = 'C2M System';
		//$this->weblayout('webbody/home',$data);
	}





if(isset($_GET['lang'])){

$sslang = array(
'lang' => $_GET['lang']
);

$this->session->set_userdata($sslang);
header("Location: ".$_SERVER['HTTP_REFERER']."");
}






	}


  function Saletoday()
  {

  echo $this->home_model->Saletoday();

  }

   function Getstockless()
  {

  echo $this->home_model->Getstockless();

  }
// try to add this function to product value controller
  function Getstock() {
    // ຖ້າບໍ່ຈຳເປັນຕ້ອງຮັບ POST Body ໃຫ້ລຶບສ່ວນ file_get_contents ອອກ
    // ຫະລື ຖ້າຕ້ອງການຮັບທັງ GET/POST:
    
    // ຕົວຢ່າງດຶງ Model ມາສະແດງເລີຍ:
    $list = $this->product_value_model->Getstock();
    
    // ສົ່ງຄ່າອອກໄປເປັນ JSON ໃຫ້ AngularJS
    header('Content-Type: application/json');
    echo json_encode($list);
}
  // try to add this function to product value controller
  
  
  
  	function Addimgbanner()
    {


if(!file_exists("pic/banner/".$_SESSION['store_id'])){
	mkdir("pic/banner/".$_SESSION['store_id'],0777,true);
}


if($_FILES["image1"]["name"]!=''){
move_uploaded_file($_FILES["image1"]["tmp_name"],"pic/banner/".$_SESSION['store_id']."/".time().md5($_FILES["image1"]["name"]).'.jpg');
$data['image1'] = 'pic/banner/'.$_SESSION['store_id'].'/'.time().md5($_FILES["image1"]["name"]).'.jpg';
}


if($_FILES["image2"]["name"]!=''){
move_uploaded_file($_FILES["image2"]["tmp_name"],"pic/banner/".$_SESSION['store_id']."/".time().md5($_FILES["image2"]["name"]).'.jpg');
$data['image2'] = 'pic/banner/'.$_SESSION['store_id'].'/'.time().md5($_FILES["image2"]["name"]).'.jpg';
}



if($_FILES["image3"]["name"]!=''){
move_uploaded_file($_FILES["image3"]["tmp_name"],"pic/banner/".$_SESSION['store_id']."/".time().md5($_FILES["image3"]["name"]).'.jpg');
$data['image3'] = 'pic/banner/'.$_SESSION['store_id'].'/'.time().md5($_FILES["image3"]["name"]).'.jpg';
}



if($_FILES["image4"]["name"]!=''){
move_uploaded_file($_FILES["image4"]["tmp_name"],"pic/banner/".$_SESSION['store_id']."/".time().md5($_FILES["image4"]["name"]).'.jpg');
$data['image4'] = 'pic/banner/'.$_SESSION['store_id'].'/'.time().md5($_FILES["image4"]["name"]).'.jpg';
}



if($_FILES["image5"]["name"]!=''){
move_uploaded_file($_FILES["image5"]["tmp_name"],"pic/banner/".$_SESSION['store_id']."/".time().md5($_FILES["image5"]["name"]).'.jpg');
$data['image5'] = 'pic/banner/'.$_SESSION['store_id'].'/'.time().md5($_FILES["image5"]["name"]).'.jpg';
}



$data['changetime'] = $_POST['changetime'];
$data['picheight'] = $_POST['picheight'];
$data['saleboxheight'] = $_POST['saleboxheight'];
$data['show_discount_text'] = $_POST['show_discount_text'];
$data['show_pricepernum'] = $_POST['show_pricepernum'];

$success = $this->home_model->Addimgbanner($data);

}



 function Getimgbanner()
  {

  echo $this->home_model->Getimgbanner();

  }
  

 function Delimage()
  {
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}	
  echo $this->home_model->Delimage($data);

  }
  



  function Productsaletoday()
{

echo $this->home_model->Productsaletoday();

}



function Productoutofstock()
{

echo $this->home_model->Productoutofstock();

}



function Productdateend()
{

echo $this->home_model->Productdateend();

}


function Productpawnenddate()
{

echo $this->home_model->Productpawnenddate();

}



//   public function Showcus2mer()
//   {

// $query = $this->db->query('SELECT
// *
//  FROM banner_cus2mer');
 
 
// 	foreach($query->result() as $row){
// 	$data['changetime'] = $row->changetime*1000;
// 	$data['image1'] = $row->image1;
// 	$data['image2'] = $row->image2;
// 	$data['image3'] = $row->image3;
// 	$data['image4'] = $row->image4;
// 	$data['image5'] = $row->image5;
	
// 	$data['picheight'] = $row->picheight;
// 	$data['saleboxheight'] = $row->saleboxheight;
// 	$data['show_discount_text'] = $row->show_discount_text;
// 	$data['show_pricepernum'] = $row->show_pricepernum;
// } 
 
// $data['title'] = 'ຈໍລູກຄ້າ';
// $this->showcuslayout('webbody/showcus2mer',$data);


//   }


public function Showcus2mer()
    {
        // ດຶງຂໍ້ມູນການຕັ້ງຄ່າຈາກຕາຕະລາງ banner_cus2mer
        $query = $this->db->get('banner_cus2mer');
        
        // กำหนดค่าเริ่มต้น (Default values) เผื่อกรณีตารางว่างเปล่า
        $data['changetime']          = 5000; // ค่าเริ่มต้น 5 วินาที
        $data['image1']              = '';
        $data['image2']              = '';
        $data['image3']              = '';
        $data['image4']              = '';
        $data['image5']              = '';
        $data['picheight']           = 945;
        $data['saleboxheight']       = 560;
        $data['show_discount_text']  = '0';
        $data['show_pricepernum']    = '0';

        // วนลูปดึงข้อมูลแถວแรกมาใช้งาน
        if ($query->num_rows() > 0) {
            $row = $query->row();
            
            // แปลงเวลาสไลด์โชว์เป็น Milliseconds สำหรับใช้กับ Bootstrap Carousel / ng-interval
            $data['changetime']         = ($row->changetime > 0) ? $row->changetime * 1000 : 5000;
            $data['image1']             = $row->image1;
            $data['image2']             = $row->image2;
            $data['image3']             = $row->image3;
            $data['image4']             = $row->image4;
            $data['image5']             = $row->image5;
            
            $data['picheight']          = $row->picheight;
            $data['saleboxheight']      = $row->saleboxheight;
            $data['show_discount_text'] = $row->show_discount_text;
            $data['show_pricepernum']   = $row->show_pricepernum;
        } 
        
        // กำหนดชื่อหัวข้อหน้าเว็บ (รองรับภาษาลาว)
        $data['title'] = 'ຈໍລູກຄ້າ';
        
        // เรียกใช้งาน Layout สำหรับแสดงผลหน้าจอฝั่งลูกค้า
        $this->showcuslayout('webbody/showcus2mer', $data);
    }



// update QR upload and EMVCo string ======================
public function get_dynamic_qr_ajax()
    {
        // ຮັບຄ່າ JSON ທີ່ສົ່ງມາຈາກ AngularJS
        $request_data = json_decode(file_get_contents('php://input'), true);
        $amount = isset($request_data['amount']) ? floatval($request_data['amount']) : 0;

        // ດຶງ owner_qr ແລະ owner_emvco_string ຈາກຕາຕະລາງ owner ຕາມ store_id ຫລື owner_id ໃນ session
        $owner_id = isset($_SESSION['store_id']) ? $_SESSION['store_id'] : 1; 
        
        $this->db->select('owner_qr, owner_emvco_string');
        $this->db->where('owner_id', $owner_id);
        $query = $this->db->get('owner');
        $owner = $query->row();

        // ກວດສອບວ່າພົບຂໍ້ມູນ ແລະ ມີ EMVCo string ຫລືບໍ່
        if ($owner && !empty($owner->owner_emvco_string)) {
            $raw_static_string = $owner->owner_emvco_string;
        } else {
            // Fallback case ບໍ່ພົບຂໍ້ມູນໃນ Database
            $raw_static_string = "00020101021115312031041800520446mch19FF924FFF6038570016A00526628466257701082771041802030020314mch19FF924FFF65204549953034185802LA5921 KHAO PING SAMAIPHONE6002VT62200716stk6a7d38e1afe846304B15D";
        }

        $static_qr_file = ($owner && !empty($owner->owner_qr)) ? $owner->owner_qr : '';

        require_once FCPATH . 'vendor/autoload.php';
        
        // ສ້າງ Dynamic QR String ພ້ອມຝັງຈຳນວນເງິນ ($amount) ແລະ ຄຳນວນ CRC
        $dynamic_qr_string = $this->generate_emvco_dynamic_qr($raw_static_string, $amount);

        // ສ້າງ QR Code ດ້ວຍ Endroid
        $qrCode = new \Endroid\QrCode\QrCode($dynamic_qr_string);
        $qrCode->setSize(300);
        
        $dataUri = $qrCode->writeDataUri();

        $response = [
            'status' => 'success',
            'owner_qr' => $static_qr_file,       // ສົ່ງຊື່ໄຟລ໌ Static QR ກັບໄປນຳ
            'qr_image' => $dataUri                // ສົ່ງ Data URI ຂອງ Dynamic QR ກັບໄປ
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    private function generate_emvco_dynamic_qr($static_string, $amount)
    {
        if (substr($static_string, -4) === 'B15D' || strlen($static_string) > 4) {
            $pos = strpos($static_string, '6304');
            if ($pos !== false) {
                $static_string = substr($static_string, 0, $pos);
            }
        }

        $static_string = str_replace('010211', '010212', $static_string);

        // ປັບປຸງ: ໃຊ້ round() ສຳລັບ Lao Kip ເພື່ອຕັດຈຸດທົດສນຽມ (.00) ອອກ ປ້ອງກັນແອັບທະນາຄານປະຕິເສດ
        $clean_amount = round($amount);
        $amount_str = (string)$clean_amount;
        
        $len = strlen($amount_str);
        $tag54 = '54' . str_pad($len, 2, '0', STR_PAD_LEFT) . $amount_str;

        $target_tag = '5802LA';
        $pos_tag = strpos($static_string, $target_tag);
        
        if ($pos_tag !== false) {
            $emvco_data = substr_replace($static_string, $tag54, $pos_tag, 0);
        } else {
            $emvco_data = $static_string . $tag54;
        }

        $emvco_data .= '6304';
        $emvco_data .= $this->calculate_crc16($emvco_data);

        return $emvco_data;
    }

    private function calculate_crc16($payload)
    {
        $result = 0xFFFF;
        $length = strlen($payload);
        for ($i = 0; $i < $length; $i++) {
            $result ^= (ord($payload[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                if (($result & 0x8000) != 0) {
                    $result = (($result << 1) ^ 0x1021);
                } else {
                    $result = ($result << 1);
                }
                $result &= 0xFFFF;
            }
        }
        return strtoupper(str_pad(dechex($result), 4, '0', STR_PAD_LEFT));
    }
// update QR upload and EMVCo string ======================
// update QR code to return both owner_qr and owner_emvco_string 




}