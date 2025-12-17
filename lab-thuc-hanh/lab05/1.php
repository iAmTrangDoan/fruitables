
<?php
$arr = array();

$r = array("id"=>1, "name"=>"Product1");
$arr[] = $r;

$r = array("id"=>2, "name"=>"Product2");
$arr[] = $r;

$r = array("id"=>3, "name"=>"Product3");
$arr[] = $r;

$r = array("id"=>4, "name"=>"Product4");
$arr[] = $r;
foreach ($arr as $product) {
    echo '<a href="4_2.php?id=' . $product['id'] . '">' . $product['name'] . '</a><br>';
}
?>
