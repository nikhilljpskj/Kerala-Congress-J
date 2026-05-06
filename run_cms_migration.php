<?php
$conn = new mysqli('localhost', 'kerala_congress1', 'kerala_congress', 'kerala_congress');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = file_get_contents(__DIR__ . '/db/cms_migration.sql');
if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "Migration Success";
} else {
    echo "Migration Failed: " . $conn->error;
}
$conn->close();
