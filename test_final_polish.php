<?php
require_once __DIR__ . '/vendor/autoload.php';
define('BASE_PATH', __DIR__);
define('VIEWS_PATH', BASE_PATH . '/app/views');

$member = [
    'fname' => 'NIJIN',
    'lname' => 'VARGHESE',
    'reg_no' => 'KC/2026/001',
    'blood' => 'B+',
    'district_name' => 'Kottayam',
    'assembly_name' => 'Kanjirappally',
    'membership' => 'Kerala Youth Front (KYF)'
];

$logoPath = BASE_PATH . '/images/logo_kc.svg';
$photoPath = BASE_PATH . '/images/Joy Abraham.jfif';

$qrData = "KERALA CONGRESS MEMBERSHIP\n" .
          "--------------------------\n" .
          "Name: {$member['fname']} {$member['lname']}\n" .
          "Reg No: {$member['reg_no']}\n" .
          "District: " . ($member['district_name'] ?? $member['district']) . "\n" .
          "Assembly: " . ($member['assembly_name'] ?? $member['assembly']);

ob_start();
require VIEWS_PATH . '/admin/id_card.php';
$html = ob_get_clean();

try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'format' => [85.6, 53.98],
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0,
    ]);
    $mpdf->WriteHTML($html);
    $mpdf->Output('final_polish_id.pdf', 'F');
    echo "Success: final_polish_id.pdf generated.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
