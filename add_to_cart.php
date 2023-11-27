<?php
$some_data = array(
  'userSecretKey' => '5mjp2anr-4k7p-ut6d-1itp-dwhcbzzvqmmm', //
  'categoryCode' => 'spwa53go',//
  'billName' => 'Travel Trip',
  'billDescription' => 'Demo Payment',
  'billPriceSetting' => 0,
  'billPayorInfo' => 1,
  'billAmount' => 1000,
  'billReturnUrl' => 'http://localhost:8080/packages.php',
  'billCallbackUrl' => 'http://localhost:8080/packages.php',
  'billExternalReferenceNo' => 'AFR341DFI',
  'billTo' => 'Amir Asyraaf',
  'billEmail' => 'amirasyraaf@gmail.com',
  'billPhone' => '0173794430',
  'billSplitPayment' => 0,
  'billSplitPaymentArgs' => '',
  'billPaymentChannel' => '0',
  'billContentEmail' => 'Thank you for purchasing our product!',
  'billChargeToCustomer' => 1,

);

$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');//buang dev
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

$result = curl_exec($curl);
$info = curl_getinfo($curl);
curl_close($curl);
$obj = json_decode($result,true);
$billcode=$obj[0]['BillCode'];
echo $billcode;

?>
     <script type="text/javascript">
     
     window.location.href="https://dev.toyyibpay.com/<?php echo $billcode;?>"; 
     </script>

  ?>
        <script type="text/javascript">
        
        window.location.href="https://dev.toyyibpay.com/<?php echo $billcode;?>"; 
        </script>

<!-- //$post_data['billCode']=$result[0] ['BillCode']; -->
<!-- //$post_data['paymentURL'] = 'https://dev.toyyibpay.com/' . $result[0]['BillCode']; -->

  <!-- header('Location: https://dev.toyyibpay.com/Amir'); -->