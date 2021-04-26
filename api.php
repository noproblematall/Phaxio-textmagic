<?php
require('./fpdf/fpdf.php');
require_once('./config.php');
require_once('./vendor/autoload.php');

use TextMagic\Models\SendMessageInputObject;
use TextMagic\Api\TextMagicApi;
use TextMagic\Configuration;

if (isset($_POST) && !empty($_POST)) {
    $phone = str_replace(' ', '', $_POST['phone']);
    if(strlen($phone) == 10){
        $phone = '+1'.$phone;
    }else{
        $phone = '+'.$phone;
    }
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0, 10 , 'Date:  '.date("Y-m-d"), 0, 1);
    $pdf->Cell(0, 15 , 'I am writing to demand to review the DHS file of my children. My name is:', 0, 1);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0, 8 , 'Name:' . '  ' . $_POST['fullname'], 0, 1);
    $pdf->Cell(0, 8 , 'Address:' . '  ' . $_POST['street'], 0, 1);
    $pdf->Cell(0, 8 , 'City:' . '  ' . $_POST['city'], 0, 1);
    $pdf->Cell(0, 8 , 'State:' . '  ' . $_POST['state'], 0, 1);
    $pdf->Cell(0, 8 , 'ZIP:' . '  ' . $_POST['zip_code'], 0, 1);
    $pdf->Cell(0, 8 , 'Cell Phone:' . '  ' . $phone, 0, 1);

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0, 15 , 'The child/children whose file I wish to review is/are:', 0, 1);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0, 8 , 'Child Name:', 0, 1);
    $pdf->SetXY(110, 98);
    $pdf->Cell(0, 8 , 'Date Of Birth:', 0, 1);
    $pdf->Cell(0, 8 , $_POST['child_full_name'], 0, 1);
    $pdf->SetXY(110, 106);
    $pdf->Cell(0, 8 , $_POST['child_birthday'], 0, 1);
    if ($_POST['number'] > 0) {
        for ($i=1; $i <= $_POST['number']; $i++) {
            $child_name = $_POST['child_full_name_'.$i];
            $child_bir = $_POST['child_birthday_'.$i];
            $pdf->Cell(0, 8, $child_name, 0, 1);
            $pdf->SetXY(110, 106+(8*$i));
            $pdf->Cell(0, 8, $child_bir, 0, 1);
        }
    }

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0, 10 , 'I demand the right to review their files within ten business days.', 0, 1);
    $pdf->Cell(0, 15 , 'My identification is as follows:', 0, 1);
    $exp = explode(',', $_POST['driver_lience']);
    if ($exp[1][0] == 'i') {
        $extension = '.png';
    } else{
        $extension = '.jpg';
    }
    $data = base64_decode($exp[1]);
    $driver_lience = time() . '_driver' .$extension;
    $file = 'uploads/'.$driver_lience;
    file_put_contents($file, $data);
    $pdf->Image($file,null,null,120);
    // echo $pdf->GetPageWidth();
    // var_dump(getimagesize($file)[0]);
    // unlink($file);

    $pdf->Cell(0, 15 , 'My signature:', 0, 1);
    $exp = explode(',', $_POST['signature_img']);
    if ($exp[1][0] == 'i') {
        $extension = '.png';
    } else{
        $extension = '.jpg';
    }
    $data = base64_decode($exp[1]);
    $signature_lience = time() . '_signature' .$extension;
    $file = 'uploads/'.$signature_lience;
    file_put_contents($file, $data);
    $pdf->Image($file);
    $pdf_name = 'fax_'.time().'.pdf';
    $pdf->Output('F', $pdf_name);    

    unlink($file);
    
    Phaxio Part -----------
    $params = array(
        'to' => $phaxio_phone,
        'file' => array(
            fopen($pdf_name, 'r')
        )
    );
    
    $phaxio = new Phaxio($apiKeys[$apiMode], $apiSecrets[$apiMode], $apiHost);
    $result = $phaxio->sendFax($params);

    Textmagic Part -----------
    
    $config = Configuration::getDefaultConfiguration()
    ->setUsername($textmagic_name)
    ->setPassword($textmagic_key);

    $api = new TextMagicApi(
        new GuzzleHttp\Client(),
        $config
    );

    $file = new \SplFileObject($pdf_name);

    try {        
        $result = $api->uploadMessageAttachment($file);
        $result = json_decode($result);
        $text = 'Please download this file you faxed for your records.  my.textmagic.com/'.$result->href;
        $input = new SendMessageInputObject();
        $input->setText($text);
        $input->setPhones($phone);
        try {
            $result = $api->sendMessage($input);
            var_dump($result);
        } catch (Exception $e) {
            echo 'Exception when calling TextMagicApi->sendMessage: ', $e->getMessage(), PHP_EOL;
        }

    } catch (Exception $e) {
        echo 'Exception when calling TextMagicApi->uploadMessageAttachment: ', $e->getMessage(), PHP_EOL;
    }

    unlink($pdf_name);
}
