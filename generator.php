<?php

$content = file_get_contents('n:/XAMPP/htdocs/keralacongress.org.in/public/cities.js');
preg_match('/const selfGovtData = (\{.*?\});/s', $content, $matches);
$dataStr = preg_replace('/(\w+):/', '"$1":', $matches[1]);
$dataStr = str_replace("'", '"', $dataStr); // in case

// We'll just read it using JSON since it's JS object syntax
$data = json_decode($matches[1], true);

if ($data === null) {
   echo "Failed to decode JSON. Error: " . json_last_error_msg() . "\n";
   exit(1);
}

$sql = "-- Dynamic District Migration\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `districts` (\n";
$sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
$sql .= "  `name` VARCHAR(100) NOT NULL UNIQUE\n";
$sql .= ");\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `assemblies` (\n";
$sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
$sql .= "  `district_id` INT NOT NULL,\n";
$sql .= "  `name` VARCHAR(150) NOT NULL,\n";
$sql .= "  FOREIGN KEY (`district_id`) REFERENCES `districts`(`id`)\n";
$sql .= ");\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `local_bodies` (\n";
$sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
$sql .= "  `assembly_id` INT NOT NULL,\n";
$sql .= "  `name` VARCHAR(250) NOT NULL,\n";
$sql .= "  FOREIGN KEY (`assembly_id`) REFERENCES `assemblies`(`id`)\n";
$sql .= ");\n\n";

$distId = 1;
$assemId = 1;
$lbId = 1;

foreach ($data as $dist => $assemblies) {
    if ($dist === "Wards No. 1 to 12") { continue; } // Exclude odd objects
    
    $distClean = trim($dist);
    $sql .= "INSERT IGNORE INTO `districts` (`id`, `name`) VALUES ($distId, '" . addslashes($distClean) . "');\n";
    
    foreach ($assemblies as $assem => $localBodies) {
        $assemClean = trim($assem);
        $sql .= "INSERT IGNORE INTO `assemblies` (`id`, `district_id`, `name`) VALUES ($assemId, $distId, '" . addslashes($assemClean) . "');\n";
        
        foreach ($localBodies as $lb) {
            $lbClean = trim($lb);
            $sql .= "INSERT IGNORE INTO `local_bodies` (`id`, `assembly_id`, `name`) VALUES ($lbId, $assemId, '" . addslashes($lbClean) . "');\n";
            $lbId++;
        }
        $assemId++;
    }
    $distId++;
}

file_put_contents('n:/XAMPP/htdocs/keralacongress.org.in/db/district_migration.sql', $sql);
echo 'Migration script generated to db/district_migration.sql!';
