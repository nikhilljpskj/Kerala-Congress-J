<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'format' => [86, 54],
    ]);
    $mpdf->WriteHTML('<h1>Testing QR Code</h1><p>If you see a QR code below, it is working.</p><barcode code="TEST-QR" type="QR" size="0.6" error="M" />');
    $mpdf->Output('test_qr.pdf', 'F');
    echo "Success: test_qr.pdf generated.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
