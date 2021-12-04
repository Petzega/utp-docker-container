<?php
    $conn = mysqli_connect("localhost", "root", "utp!", "bd_scraper");

    $type = $_GET['item_type'];

    if(isset($_GET['key'])) {
        $key = $_GET["key"];
        if ($type == 'product') {
            /*$query = "SELECT p.product_name, p.product_price, p.product_image, e.est_name FROM product as p, establishment as e WHERE product_name LIKE '%$key%'";*/
            if ($key == '') {
                $query = "SELECT p.product_id, p.product_name, p.product_price, p.product_image, e.est_name FROM product AS p, establishment AS e WHERE p.est_id = e.est_id ORDER BY p.product_name asc";   
            } else {
                $query = "SELECT p.product_id, p.product_name, p.product_price, p.product_image, p.est_id, e.est_name FROM product AS p, establishment AS e WHERE p.product_name LIKE '%$key%' AND p.est_id = e.est_id ORDER BY p.product_price asc";
            }
            /*$query = "SELECT p.product_id, p.product_name, p.product_price, p.product_image, p.est_id, e.est_name
            FROM product AS p, establishment AS e WHERE p.product_name LIKE '%$key%' AND p.est_id = e.est_id ORDER BY p.product_price asc";*/
            $result = mysqli_query($conn, $query);
            $response = array();
            while($row = mysqli_fetch_assoc($result)) {
                array_push($response,
                array(
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'product_price' => $row['product_price'],
                    'product_image' => $row['product_image'],
                    'est_name' => $row['est_name'],
                ));
            }
            echo json_encode($response);
        }
    } else {
        if ($type == 'product') {
            $query = "SELECT p.product_id, p.product_name, p.product_price, p.product_image, e.est_name
            FROM product AS p, establishment AS e WHERE p.est_id = e.est_id ORDER BY p.product_name asc";
            $result = mysqli_query($conn, $query);
            $response = array();
            while($row = mysqli_fetch_assoc($result)) {
                array_push($response,
                array(
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'product_price' => $row['product_price'],
                    'product_image' => $row['product_image'],
                    'est_name' => $row['est_name'],
                ));
            }
            echo json_encode($response);
        }
    }
    mysqli_close($conn);
?>