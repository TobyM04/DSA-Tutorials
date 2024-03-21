<?php
// Since you're using root with no password, these will be the credentials used.
$dsn = 'mysql:host=localhost;dbname=Stations;charset=utf8';
$username = 'root';
$password = ''; // No password for root

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    echo '<table>';
    echo '<tr><th>Name</th><th>Wikipedia Link</th></tr>';
    foreach ($db->query('SELECT name, wp_link FROM station') as $station) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($station['name']).'</td>';
        echo '<td><a href="'.htmlspecialchars($station['wp_link']).'">'.htmlspecialchars($station['wp_link']).'</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} catch (PDOException $e) {
    die("<h3>I'm sorry, Dave. I'm afraid I can't do that.</h3>" . $e->getMessage());
}

$db = null;
?>

