<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppsetting extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('salesetting/ppsetting_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
        
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		

$data['tab'] = 'ppsetting';
$data['title'] = 'Promp pay';
		$this->salesettinglayout('salesetting/ppsetting',$data);
}





public function Get()
{
    $list = $this->ppsetting_model->Getpp();
    // echo json_encode(['list' => json_decode($list)]);


    // log raw data
    log_message('debug', 'Ppsetting::Get() raw list = ' . print_r($list, true));

    // try decoding if it's still JSON string
    $decoded = json_decode($list);

    // log after decode
    log_message('debug', 'Ppsetting::Get() decoded = ' . print_r($decoded, true));

    echo json_encode(['list' => $decoded], JSON_UNESCAPED_UNICODE);

}
public function Getqr()
{
    $list = $this->ppsetting_model->Getqr();
    // echo json_encode(['list' => json_decode($list)]);


    // log raw data
    log_message('debug', 'Ppsetting::Get() raw list = ' . print_r($list, true));

    // try decoding if it's still JSON string
    $decoded = json_decode($list);

    // log after decode
    log_message('debug', 'Ppsetting::Get() decoded = ' . print_r($decoded, true));

    echo json_encode(['list' => $decoded], JSON_UNESCAPED_UNICODE);

}

// origin work with upload QR code and EMVCo string

// public function get_dynamic_qr_ajax()
// {
//     // ຮັບຄ່າ JSON ທີ່ສົ່ງມາຈາກ AngularJS
//     $request_data = json_decode(file_get_contents('php://input'), true);
//     $amount = isset($request_data['amount']) ? floatval($request_data['amount']) : 0;

//     // ດຶງ owner_emvco_string ຈາກຕາຕະລາງ owner ຕາມ store_id ຫລື owner_id ໃນ session
//     $owner_id = isset($_SESSION['store_id']) ? $_SESSION['store_id'] : 1; // ປັບຕາມຕົວແປ session ຂອງທ່ານ
    
//     $this->db->select('owner_emvco_string');
//     $this->db->where('owner_id', $owner_id);
//     $query = $this->db->get('owner');
//     $owner = $query->row();

//     // ກວດສອບວ່າພົບຂໍ້ມູນ ແລະ ມີ EMVCo string ຫລືບໍ່
//     if ($owner && !empty($owner->owner_emvco_string)) {
//         $raw_static_string = $owner->owner_emvco_string;
//     } else {
//         // Fallback case ບໍ່ພົບຂໍ້ມູນໃນ Database
//         $raw_static_string = "00020101021115312031041800520446mch19FF924FFF6038570016A00526628466257701082771041802030020314mch19FF924FFF65204549953034185802LA5921 KHAO PING SAMAIPHONE6002VT62200716stk6a7d38e1afe846304B15D";
//     }

//     require_once FCPATH . 'vendor/autoload.php';
    
//     // ສ້າງ Dynamic QR String ພ້ອມຝັງຈຳນວນເງິນ ($amount) ແລະ ຄຳນວນ CRC
//     $dynamic_qr_string = $this->generate_emvco_dynamic_qr($raw_static_string, $amount);

//     // ສ້າງ QR Code ດ້ວຍ Endroid (ປັບຕາມເວີຊັນທີ່ທ່ານໃຊ້)
//     $qrCode = new \Endroid\QrCode\QrCode($dynamic_qr_string);
//     $qrCode->setSize(300);
    
//     $dataUri = $qrCode->writeDataUri();

//     $response = [
//         'status' => 'success',
//         'qr_image' => $dataUri
//     ];

//     header('Content-Type: application/json');
//     echo json_encode($response);
// }

    // private function generate_emvco_dynamic_qr($static_string, $amount)
    // {
    //     if (substr($static_string, -4) === 'B15D' || strlen($static_string) > 4) {
    //         $pos = strpos($static_string, '6304');
    //         if ($pos !== false) {
    //             $static_string = substr($static_string, 0, $pos);
    //         }
    //     }

    //     $static_string = str_replace('010211', '010212', $static_string);

    //     $amount_str = number_format($amount, 2, '.', '');
    //     $len = strlen($amount_str);
    //     $tag54 = '54' . str_pad($len, 2, '0', STR_PAD_LEFT) . $amount_str;

    //     $target_tag = '5802LA';
    //     $pos_tag = strpos($static_string, $target_tag);
        
    //     if ($pos_tag !== false) {
    //         $emvco_data = substr_replace($static_string, $tag54, $pos_tag, 0);
    //     } else {
    //         $emvco_data = $static_string . $tag54;
    //     }

    //     $emvco_data .= '6304';
    //     $emvco_data .= $this->calculate_crc16($emvco_data);

    //     return $emvco_data;
    // }

    // private function calculate_crc16($payload)
    // {
    //     $result = 0xFFFF;
    //     $length = strlen($payload);
    //     for ($i = 0; $i < $length; $i++) {
    //         $result ^= (ord($payload[$i]) << 8);
    //         for ($j = 0; $j < 8; $j++) {
    //             if (($result & 0x8000) != 0) {
    //                 $result = (($result << 1) ^ 0x1021);
    //             } else {
    //                 $result = ($result << 1);
    //             }
    //             $result &= 0xFFFF;
    //         }
    //     }
    //     return strtoupper(str_pad(dechex($result), 4, '0', STR_PAD_LEFT));
    // }
// origin work with upload QR code and EMVCo string
    
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
public function Getqr_loadsale()
{
    $list = $this->ppsetting_model->Getqr_loadsale();
    // echo json_encode(['list' => json_decode($list)]);


    // log raw data
    log_message('debug', 'Ppsetting::Get() raw list = ' . print_r($list, true));

    // try decoding if it's still JSON string
    $decoded = json_decode($list);

    // log after decode
    log_message('debug', 'Ppsetting::Get() decoded = ' . print_r($decoded, true));

    echo json_encode(['list' => $decoded], JSON_UNESCAPED_UNICODE);

}

public function Update()
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) exit();

    $success = $this->ppsetting_model->Updatepp($data);
    echo json_encode(['success' => $success]);
}








	}