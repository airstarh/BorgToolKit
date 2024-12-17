<?php

/*123
ssh dbloyalty1_ar@roxa.fundist.org
ssh -L 3307:roxa.fundist.org:3306 dbloyalty1_ar@roxa.fundist.org
mysql -h 127.0.0.1 -u dbloyalty1_ar -P 3307 bonusprod
*/

$conn = new mysqli("127.0.0.1", "dbloyalty1_ar", "", "bonusprod", 3307);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Your MySQL query here
$sql    = "
SELECT a.ID
, a.AddDate
, '---' as '---'
, a.*
FROM ApiRequests_v2 a
WHERE
a.AddDate >= '2024-12-09 14:53'
AND a.AddDate <= '2024-12-09 15:29'
AND a.Request LIKE '%Tournaments/Stats%'
;
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Process each row
        print_r($row);
    }
} else {
    echo "0 results";
}

$conn->close();

