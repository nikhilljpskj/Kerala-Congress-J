<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'format' => [86, 54],
    ]);
    $mpdf->WriteHTML('<h1>Testing mPDF</h1><p>If you see this, mPDF is working.</p>');
    $mpdf->Output('test_output.pdf', 'F');
    echo "Success: test_output.pdf generated.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
