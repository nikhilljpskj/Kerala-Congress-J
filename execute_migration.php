<?php
// Execute the base migration first
$conn = new mysqli('localhost', 'kerala_congress1', 'kerala_congress', 'kerala_congress');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Run the clean parts of the migration SQL (the INSERTS) that the generator made initially
$content = file_get_contents('n:/XAMPP/htdocs/keralacongress.org.in/db/district_migration.sql');
// We need to cut off the corrupted echo parts at the end safely. 
// We know it gets corrupted after the last clean INSERT IGNORE.
$pos = strpos($content, "A L T E R ");
if ($pos !== false) {
    $content = substr($content, 0, $pos);
}
// Clean up any remaining null bytes or oddities
$content = preg_replace('/[^\P{C}\n]+/u', '', $content);
file_put_contents('n:/XAMPP/htdocs/keralacongress.org.in/db/district_migration_clean.sql', $content);

echo "Running initial inserts...\n";
if ($conn->multi_query($content)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "Inserts successful!\n";
} else {
    die("Inserts failed: " . $conn->error . "\n");
}


// 2. Perform table alterations and safe data migration using sequential statements
$queries = [
    // Alterations
    "ALTER TABLE members ADD COLUMN district_id INT;",
    "ALTER TABLE members ADD COLUMN assembly_id INT;",
    "ALTER TABLE members ADD COLUMN local_body_id INT;",
    "ALTER TABLE users ADD COLUMN district_id INT;",

    // Migrations mapping existing strings to the newly inserted district/assembly/body items
    "UPDATE members m JOIN districts d ON TRIM(m.district) = d.name SET m.district_id = d.id;",
    "UPDATE members m JOIN assemblies a ON TRIM(m.assembly) = a.name AND m.district_id = a.district_id SET m.assembly_id = a.id;",
    "UPDATE members m JOIN local_bodies l ON TRIM(m.selfgovt) = l.name AND m.assembly_id = l.assembly_id SET m.local_body_id = l.id;",
    "UPDATE users u JOIN districts d ON TRIM(u.district) = d.name SET u.district_id = d.id;",

    // Constraints
    "ALTER TABLE members ADD FOREIGN KEY (district_id) REFERENCES districts(id);",
    "ALTER TABLE members ADD FOREIGN KEY (assembly_id) REFERENCES assemblies(id);",
    "ALTER TABLE members ADD FOREIGN KEY (local_body_id) REFERENCES local_bodies(id);",
    "ALTER TABLE users ADD FOREIGN KEY (district_id) REFERENCES districts(id);"
];

echo "Executing structural modifications and migrations...\n";
foreach ($queries as $index => $q) {
    echo "Running query {$index}...\n";
    if ($conn->query($q) === TRUE) {
        // Success
    } else {
        // We will ignore duplicate column errors in case we run this multiple times
        if ($conn->errno !== 1060) {
            echo "Error running query: " . $conn->error . "\n";
            echo "Query was: $q\n";
            exit(1);
        }
    }
}

echo "Database Migration Completed Beautifully!\n";
$conn->close();
