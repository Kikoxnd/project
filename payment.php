<?php
  $some_data = array(
    'userSecretKey'=>'a4y1x5qh-yooi-btg6-ngzk-30li2zius13h',
    'categoryCode'=>'v6j07gny',
    'billName'=>'Car Rental WXX123',
    'billDescription'=>'Car Rental WXX123 On Sunday',
    'billPriceSetting'=>0,
    'billPayorInfo'=>1,
    'billAmount'=>1000,
    'billReturnUrl'=>'http://bizapp.my',
    'billCallbackUrl'=>'http://bizapp.my/paystatus',
    'billExternalReferenceNo' => 'AFR341DFI',
    'billTo'=>'John Doe',
    'billEmail'=>'jd@gmail.com',
    'billPhone'=>'0194342411',
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'0',
    'billContentEmail'=>'Thank you for purchasing our product!',
    'billChargeToCustomer'=>1,
    'billExpiryDate'=>'17-12-2020 17:00:00',
    'billExpiryDays'=>3
  );  

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  $obj = json_decode($result);
  echo $result;
  ?>