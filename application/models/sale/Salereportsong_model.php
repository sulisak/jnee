<?php

class Salereportsong_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }



 public function Daylist($data)
        {

$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;



$query0 = $this->db->query('SELECT
    sld.price_vat as price_vat,
    sld.product_id as product_id,
    SUM(sld.price_vat) as sum_price_vat,
    sld.product_code as product_code,
    wl.product_name as product_name,
    wl.product_wholesale_price as product_price,
    sld.product_stock_num as product_stock_num,
    sld.adddate as sale_adddate,

    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as importproduct_detail_num,
    (SELECT sum(sd.product_sale_num) FROM product_return_datail as sd WHERE sd.product_id=sld.product_id AND sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as product_numreturn,
    (SELECT im.importproduct_detail_date FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_date,
    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND im.importproduct_detail_date < sale_adddate ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_num_beforsale,
        
    SUM(sld.product_sale_num) as product_numall,
    SUM(sld.product_price * sld.product_sale_num) as product_pricesaleall,
    SUM(sld.product_price_discount * sld.product_sale_num) as product_pricediscountall,
    SUM((sld.product_price - sld.product_price_discount) * sld.product_sale_num) as product_priceall,
    SUM(wl.product_pricebase * sld.product_sale_num) as product_pricebaseall

FROM sale_list_datail as sld
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sld.sale_runno
LEFT JOIN wh_product_list as wl ON wl.product_id = sld.product_id
LEFT JOIN branch as b ON b.branch_id = sld.branch_id

WHERE sh.sale_type = 2 
  AND wl.product_wholesale_price IS NOT NULL 
  AND wl.product_wholesale_price > 0
  AND (
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%")
      OR 
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND wl.product_name LIKE "%'.$data['searchtext'].'%")
  )

GROUP BY sld.product_id, sld.product_code, wl.product_name, wl.product_wholesale_price 
ORDER BY product_numall DESC');


$query1 = $this->db->query('SELECT
    sld.price_vat as price_vat,
    SUM(sld.price_vat) as sum_price_vat,
    sld.product_id as product_id,
    sld.product_code as product_code,
    wl.product_name as product_name,
    wl.product_wholesale_price as product_price,
    sld.product_stock_num as product_stock_num,
    sld.adddate as sale_adddate,

    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as importproduct_detail_num,
    (SELECT sum(sd.product_sale_num) FROM product_return_datail as sd WHERE sd.product_id=sld.product_id AND sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as product_numreturn,
    (SELECT im.importproduct_detail_date FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_date,
    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND im.importproduct_detail_date < sale_adddate ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_num_beforsale,
        
    SUM(sld.product_sale_num) as product_numall,
    SUM(sld.product_price * sld.product_sale_num) as product_pricesaleall,
    SUM(sld.product_price_discount * sld.product_sale_num) as product_pricediscountall,
    SUM((sld.product_price - sld.product_price_discount) * sld.product_sale_num) as product_priceall,
    SUM(wl.product_pricebase * sld.product_sale_num) as product_pricebaseall

FROM sale_list_datail as sld
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sld.sale_runno
LEFT JOIN wh_product_list as wl ON wl.product_id = sld.product_id
LEFT JOIN branch as b ON b.branch_id = sld.branch_id

WHERE sh.sale_type = 2 
  AND wl.product_wholesale_price IS NOT NULL 
  AND wl.product_wholesale_price > 0
  AND sld.price_vat != "0.00"
  AND (
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%")
      OR 
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND wl.product_name LIKE "%'.$data['searchtext'].'%")
  )

GROUP BY sld.product_id, sld.product_code, wl.product_name, wl.product_wholesale_price 
ORDER BY product_numall DESC');



$query2 = $this->db->query('SELECT
    sld.price_vat as price_vat,
    SUM(sld.price_vat) as sum_price_vat,
    sld.product_id as product_id,
    sld.product_code as product_code,
    wl.product_name as product_name,
    wl.product_wholesale_price as product_price,
    sld.product_stock_num as product_stock_num,
    sld.adddate as sale_adddate,

    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as importproduct_detail_num,
    (SELECT sum(sd.product_sale_num) FROM product_return_datail as sd WHERE sd.product_id=sld.product_id AND sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'") as product_numreturn,
    (SELECT im.importproduct_detail_date FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_date,
    (SELECT SUM(im.importproduct_detail_num) FROM wh_importproduct_detail as im WHERE im.product_id=sld.product_id AND im.importproduct_detail_date BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND im.importproduct_detail_date < sale_adddate ORDER BY im.importproduct_detail_id ASC LIMIT 1) as importproduct_detail_num_beforsale,
        
    SUM(sld.product_sale_num) as product_numall,
    SUM(sld.product_price * sld.product_sale_num) as product_pricesaleall,
    SUM(sld.product_price_discount * sld.product_sale_num) as product_pricediscountall,
    SUM((sld.product_price - sld.product_price_discount) * sld.product_sale_num) as product_priceall,
    SUM(wl.product_pricebase * sld.product_sale_num) as product_pricebaseall

FROM sale_list_datail as sld
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sld.sale_runno
LEFT JOIN wh_product_list as wl ON wl.product_id = sld.product_id
LEFT JOIN branch as b ON b.branch_id = sld.branch_id

WHERE sh.sale_type = 2 
  AND wl.product_wholesale_price IS NOT NULL 
  AND wl.product_wholesale_price > 0
  AND sld.price_vat = "0.00"
  AND (
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%")
      OR 
      (sld.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND wl.product_name LIKE "%'.$data['searchtext'].'%")
  )

GROUP BY sld.product_id, sld.product_code, wl.product_name, wl.product_wholesale_price 
ORDER BY product_numall DESC');

if($data['showproductvat']=='0'){
$query = $query0;	
}else if($data['showproductvat']=='1'){
$query = $query1;
}else if($data['showproductvat']=='2'){
$query = $query2;
}

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }




public function Salelistdatail($data)
        {

$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;


$query = $this->db->query('SELECT 
    sd.*, 
    sd.branch_id,
    uo.name,
    FROM_UNIXTIME(sd.adddate, "%d-%m-%Y %H:%i:%s") as adddate
FROM sale_list_datail as sd
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sd.sale_runno
LEFT JOIN branch as b ON b.branch_id = sd.branch_id
LEFT JOIN user_owner as uo ON uo.user_id = sd.user_id
WHERE sh.sale_type = 2 
  AND sd.product_id = "'.$data['product_id'].'"
  AND (
      (sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%")
      OR 
      (sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sd.product_name LIKE "%'.$data['searchtext'].'%")
  )
ORDER BY sd.ID ASC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }



public function Salelistdatailinlist($data)
        {

$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;


$query = $this->db->query('SELECT 
    sd.*, 
    sh.cus_name,
    FROM_UNIXTIME(sd.adddate, "%d-%m-%Y %H:%i:%s") as adddate_format
FROM sale_list_datail as sd
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sd.sale_runno
LEFT JOIN branch as b ON b.branch_id = sd.branch_id
WHERE sh.sale_type = 2 
  AND (
      (sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%")
      OR 
      (sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sd.product_name LIKE "%'.$data['searchtext'].'%")
  )
ORDER BY sd.ID DESC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }





public function Discountlastlist($data)
        {

$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;


$query = $this->db->query('SELECT 
    sh.*, 
    b.branch_name,
    FROM_UNIXTIME(sh.adddate, "%d-%m-%Y %H:%i:%s") as adddate_format
FROM sale_list_header as sh
LEFT JOIN branch as b ON b.branch_id = sh.branch_id
WHERE sh.sale_type = 2 
  AND sh.discount_last != "0.00"
  AND sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'"
  AND b.branch_name LIKE "%'.$data['searchtext'].'%"
ORDER BY sh.ID DESC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }



public function Pawnlist($data)
        {

$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;


$query = $this->db->query('SELECT *,
 from_unixtime(add_time,"%d-%m-%Y %H:%i:%s") as adddate,
 pawnadd_cutmoney,
 pawnadd_permoney
FROM pawnadddate
WHERE add_time
BETWEEN "'.$dayfrom.'"
AND "'.$dayto.'"  ORDER BY p_id ASC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }




        public function Exportexcel($data)
        {
$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;

$query = $this->db->query('SELECT
    sh.cus_name as "ຊື່ລູກຄ້າ",
    sd.product_code as "ລະຫັດສິນຄ້າ",
    sd.product_name as "ຊື່ສິນຄ້າ",
    sd.product_price as "ລາຄາຂາຍຕໍ່ໜ່ວຍ",
    sd.product_price_discount as "ສ່ວນຫຼຸດຕໍ່ໜ່ວຍ",
    sd.product_sale_num as "ຈຳນວນທີ່ຊື້",
    ((sd.product_price - sd.product_price_discount) * sd.product_sale_num) as "ລາຍຮັບ",
    FROM_UNIXTIME(sd.adddate, "%d-%m-%Y %H:%i:%s") as "ວັນທີ"
FROM sale_list_datail as sd
LEFT JOIN sale_list_header as sh ON sh.sale_runno = sd.sale_runno
LEFT JOIN branch as b ON b.branch_id = sd.branch_id
WHERE sh.sale_type = 2 
  AND sh.owner_id = "'.$_SESSION['owner_id'].'" 
  AND sd.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'"
  AND (
      b.branch_name LIKE "%'.$data['searchtext'].'%"
      OR sd.product_name LIKE "%'.$data['searchtext'].'%"
  )
ORDER BY sd.ID DESC
 ');
return $query;

        }



    }
