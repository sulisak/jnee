<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dateend extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('warehouse/dateend_model');

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


$data['tab'] = 'dateend';
$data['title'] = 'Product Date End';
		$this->warehouselayout('warehouse/dateend',$data);
}


	 function Getstock()
    {


$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

echo $list = $this->dateend_model->Getstock($data);



}

public function NearExpiry()
    {
        try {
        $json = $this->dateend_model->GetNearExpiry();
    } catch (Throwable $e) {
        log_message('error', 'NearExpiry error: ' . $e->getMessage());
        $json = json_encode(array(), JSON_UNESCAPED_UNICODE);
    }

    $this->output
        ->set_content_type('application/json', 'utf-8')
        ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
        ->set_header('Pragma: no-cache')
        ->set_output($json);
    }


	}