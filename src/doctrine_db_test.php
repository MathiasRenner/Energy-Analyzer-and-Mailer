<?php

if (!$link = mysql_connect('localhost', 'root', 'OlcFSKlBQW')) {
    echo 'Keine Verbindung zu mysql';
    exit;
}

if (!mysql_select_db('***REMOVED***', $link)) {
    echo 'Konnte Schema nicht selektieren';
    exit;
}

$sql    = 'SELECT * FROM b1user';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Fehler, konnte die Datenbank nicht abfragen\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row['username'];
}

mysql_free_result($result);

?>
