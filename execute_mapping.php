<?php
$conn = new mysqli("localhost", "kerala_congress1", "kerala_congress", "kerala_congress");
mysqli_report(MYSQLI_REPORT_OFF);

$queries = [
    "UPDATE members m JOIN districts d ON TRIM(m.district) = d.name SET m.district_id = d.id;",
    "UPDATE members m JOIN assemblies a ON TRIM(m.assembly) = a.name AND m.district_id = a.district_id SET m.assembly_id = a.id;",
    "UPDATE members m JOIN local_bodies l ON TRIM(m.selfgovt) = l.name AND m.assembly_id = l.assembly_id SET m.local_body_id = l.id;",
    "UPDATE users u JOIN districts d ON TRIM(u.district) = d.name SET u.district_id = d.id;",
    "ALTER TABLE members ADD FOREIGN KEY (district_id) REFERENCES districts(id);",
    "ALTER TABLE members ADD FOREIGN KEY (assembly_id) REFERENCES assemblies(id);",
    "ALTER TABLE members ADD FOREIGN KEY (local_body_id) REFERENCES local_bodies(id);",
    "ALTER TABLE users ADD FOREIGN KEY (district_id) REFERENCES districts(id);"
];

foreach ($queries as $q) {
    if ($conn->query($q) === TRUE) {
        echo "Success: $q\n";
    } else {
        echo "Error: " . $conn->error . " for query: $q\n";
    }
}
echo "Data Mapping Executed Successfully!\n";
$conn->close();
