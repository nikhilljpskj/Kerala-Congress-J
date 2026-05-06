<?php
$_SERVER['SERVER_NAME'] = 'localhost';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/models/Location.php';
require_once __DIR__ . '/app/controllers/ApiController.php';

$db = new \config\Database();
$pdo = $db->getConnection();

$_SERVER['REQUEST_METHOD'] = 'GET';
$api = new \app\controllers\ApiController();

ob_start();
$api->getDistricts();
$districts = json_decode(ob_get_clean(), true);

if (count($districts['data']) > 0) {
    $firstDistrictId = $districts['data'][0]['id'];

    $_GET['district_id'] = $firstDistrictId;
    ob_start();
    $api->getAssemblies();
    $assemblies = json_decode(ob_get_clean(), true);
    
    if (count($assemblies['data']) > 0) {
        $firstAssemblyId = $assemblies['data'][0]['id'];

        $_GET['assembly_id'] = $firstAssemblyId;
        ob_start();
        $api->getLocalBodies();
        $localBodies = json_decode(ob_get_clean(), true);
    }
}

echo "Testing getDistricts:\n";
echo "Count: " . count($districts['data']) . "\n";
echo "First District: " . $districts['data'][0]['name'] . "\n";

echo "\nTesting getAssemblies for District ID $firstDistrictId:\n";
echo "Count: " . count($assemblies['data']) . "\n";
echo "First Assembly: " . $assemblies['data'][0]['name'] . "\n";

echo "\nTesting getLocalBodies for Assembly ID $firstAssemblyId:\n";
echo "Count: " . count($localBodies['data']) . "\n";
echo "First Local Body: " . $localBodies['data'][0]['name'] . "\n";

echo "\nAll tests completed.\n";
