<?php
require_once __DIR__ . '/vendor/autoload.php';
define('BASE_PATH', __DIR__);
define('VIEWS_PATH', BASE_PATH . '/app/views');

$member = [
    'fname' => 'Jais John',
    'lname' => 'Vettiyar',
    'reg_no' => '55775',
    'blood' => 'A+',
    'district_name' => 'Alappuzha',
    'assembly_name' => 'Mavelikkara',
    'membership' => 'Kerala IT & Professional Congress (KITPROC)',
    'mobile' => '+91 94473 55775',
    'email' => 'jaisjohn@example.com'
];

$logoPath = BASE_PATH . '/images/logo_kc.svg';
$photoPath = BASE_PATH . '/images/Joy Abraham.jfif'; 
$qrData = "KERALA CONGRESS MEMBERSHIP\nName: Jais John Vettiyar\nReg No: 55775";
$dob = "1981-08-09";

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
    $mpdf->Output('user_exact_id.pdf', 'F');
    echo "Success: user_exact_id.pdf generated.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
