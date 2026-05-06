<?php
require_once __DIR__ . '/vendor/autoload.php';
define('BASE_PATH', __DIR__);
define('VIEWS_PATH', BASE_PATH . '/app/views');

$member = [
    'fname' => 'TEST',
    'lname' => 'MEMBER',
    'reg_no' => '12345',
    'blood' => 'O+',
    'district_name' => 'Kottayam',
    'assembly_name' => 'Pala',
    'membership' => 'Kerala Congress'
];

$logoPath = BASE_PATH . '/images/logo_kc.svg';
$photoPath = BASE_PATH . '/images/Joy Abraham.jfif';
$qrData = "TEST QR DATA";

ob_start();
require VIEWS_PATH . '/admin/id_card.php';
$html = ob_get_clean();

try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'format' => [86, 54],
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
    ]);
    $mpdf->WriteHTML($html);
    $mpdf->Output('test_premium_id.pdf', 'F');
    echo "Success: test_premium_id.pdf generated.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
