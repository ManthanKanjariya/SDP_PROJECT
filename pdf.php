
<?php
include ("./vendor/mpdf/mpdf");
require_once __DIR__ . '/vendor/autoload.php';
$con = mysqli_connect('localhost', 'root', '', 'opts');
$res = mysqli_query($con, "SELECT * FROM system_info");

if (mysqli_num_rows($res) > 0) {
    $html = '<table>';
    $html .= '<tr><td>Id</td><td>Meta_field</td><td>Meta_value</td></tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['meta_field'] . '</td><td>' . $row['meta_value'] . '</td></tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

?>