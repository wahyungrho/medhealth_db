<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $response = array();
    $id_user = $_POST['id_user'];
    $id_product = $_POST['id_product'];

    $cekCart = mysqli_query($connection, "SELECT * FROM cart WHERE id_user= '$id_user' AND id_product = '$id_product'");
    $resultCekCart = mysqli_fetch_array($cekCart);

    if ($resultCekCart) {
        # code...
        $response['value'] = 2;
        $response['message'] = "Maaf, product tersebut telah tersedia dalam keranjang";
        echo json_encode($response);
    } else {
        $cekProduct = mysqli_query($connection, "SELECT * FROM product WHERE id_product = '$id_product'");
        $fetchProduct = mysqli_fetch_array($cekProduct);
        $fetchPrice = $fetchProduct['price'];

        $insertToCart = "INSERT INTO cart VALUE ('', '$id_user', '$id_product', 1, '$fetchPrice', NOW())";

        if (mysqli_query($connection, $insertToCart)) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeayy, Product added to cart success";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 0;
            $response['message'] = "Sorry, Added product failed";
            echo json_encode($response);
        }
    }
}
