<?php

/*
    Template Name: Book
*/

$site = $_REQUEST['site'] ?? null;

// Car info
$data['id'] = $_REQUEST['id'] ?? null;
$data['price'] = $_REQUEST['price'] ?? null;

// Booking info
$data['from_address'] = $_REQUEST['from_address'] ?? null;
$data['to_address'] = $_REQUEST['to_address'] ?? null;
$data['trip_type'] = $_REQUEST['trip_type'] ?? null;
$data['datetime'] = $_REQUEST['datetime'] ?? null;
$data['datetime_return'] = $_REQUEST['datetime_return'] ?? null;
$data['passengers'] = $_REQUEST['passengers'] ?? null;
$data['luggage'] = $_REQUEST['luggage'] ?? null;
$data['hand_luggage'] = $_REQUEST['hand_luggage'] ?? null;

// Billing info
$data['first_name'] = $_REQUEST['first_name']?? null;
$data['last_name'] = $_REQUEST['last_name']?? null;
$data['email'] = $_REQUEST['email']?? null;
$data['address'] = $_REQUEST['address']?? null;
$data['phone'] = $_REQUEST['phone']['full']?? null;
$data['address'] = $_REQUEST['address']?? null;
$data['flight'] = $_REQUEST['flight']?? null;
$data['payment_method'] = $_REQUEST['payment_method']?? null;

$success_url = 'https://pickdrop.co.uk/booking-success?payment_method=' . $data['payment_method'] . '&site=' . $site;
$cancel_url = 'https://pickdrop.co.uk/booking-cancel?payment_method=' . $data['payment_method'] . '&site=' . $site;

$data['success_url'] = $success_url;
$data['cancel_url'] = $cancel_url;

$endpoints = [
    'British Car Transfer' => 'https://britishcartransfer.co.uk/wp-json/api/book',
    'Car Hire' => 'https://bacarhire.co.uk/wp-json/api/book',
    'Airport Pick Drop' => 'https://airportpickdrop.com/wp-json/api/book',
    '24X7 Cars' => 'https://24x7cars.co.uk/wp-json/api/book',
    'London Car Transfer' => 'https://londoncartransfer.com/wp-json/api/book',
    'London Car Transfer __-co-uk--' => 'https://londoncartransfer.co.uk/wp-json/api/book',
];


add_filter( 'http_request_timeout', function ($timeout) {
    return 120;
});


$url = $endpoints[$site];

$request = array(
    'method'      => 'POST',
    'headers'     => [
        'Content-Type' => 'application/json',
    ],
    'body' => json_encode(['data' => $data]),
);

$response = wp_remote_post($url, $request);

if (is_wp_error($response)) {
    $error_message = $response->get_error_message();
    // echo "Error: $error_message";
    if (current_user_can('administrator')) {
        $_SESSION['error'] = $error_message;
    } else {
        $_SESSION['error'] = "Booking Failed! Please try again later or contact us if the issue still persists.";
    }
    $_SESSION['form_data'] = $data;
    wp_redirect($_SERVER['HTTP_REFERER']);
    redirect_js($_SERVER['HTTP_REFERER']);
    wp_die();
}

$response_code = wp_remote_retrieve_response_code($response);
$response_body = wp_remote_retrieve_body($response);
$response_body = json_decode($response_body);

if ($response_code !== 200) {
    // echo "Response Code: $response_code";
    // echo "<br>";
    // echo "Response Body: $response_body";
    if (current_user_can('administrator')) {
        $_SESSION['error'] = $response_body->message;
    } else {
        $_SESSION['error'] = "Booking Failed! Please try again later or contact us if the issue still persists.";
    }
    $_SESSION['form_data'] = $data;
    wp_redirect($_SERVER['HTTP_REFERER']);
    redirect_js($_SERVER['HTTP_REFERER']);
    wp_die();
}

if ($data['payment_method'] === 'cash') {
    wp_redirect($success_url . '&booking_id=' . $response_body->data->booking_id);
    redirect_js($success_url . '&booking_id=' . $response_body->data->booking_id);
    wp_die();
}

if ($data['payment_method'] === 'stripe') {
    wp_redirect($response_body->data->stripe_url);
    redirect_js($response_body->data->stripe_url);
    wp_die();
}

if ($data['payment_method'] === 'paypal') {
    ?>
    <?php get_header(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div class="container">
        <div class="p-5 my-4 text-center">
            <form id="gateway_form" method="POST" name="gateway_form text-center" action="<?= $response_body->data->paypal_form_action ?>">
                <input type="hidden" name="rm" value="<?= $response_body->data->paypal_form_data->rm ?>"/>
                <input type="hidden" name="cmd" value="<?= $response_body->data->paypal_form_data->cmd ?>"/>
                <input type="hidden" name="charset" value="<?= $response_body->data->paypal_form_data->charset ?>"/>
                <input type="hidden" name="business" value="<?= $response_body->data->paypal_form_data->business ?>"/>
                <input type="hidden" name="currency_code" value="<?= $response_body->data->paypal_form_data->currency_code ?>"/>
                <input type="hidden" name="notify_url" value="<?= $response_body->data->paypal_form_data->notify_url ?>"/>
                <input type="hidden" name="item_name_1" value="<?= $response_body->data->paypal_form_data->item_name_1 ?>" />
                <input type="hidden" name="item_number_1" value="<?= $response_body->data->paypal_form_data->item_number_1 ?>" />
                <input type="hidden" name="amount_1" value="<?= $response_body->data->paypal_form_data->amount_1 ?>" />
                <input type="hidden" name="quantity_1" value="<?= $response_body->data->paypal_form_data->quantity_1 ?>"/>
                <input type="hidden" name="return" value="<?= $response_body->data->paypal_form_data->return ?>"/>
                <input type="hidden" name="upload" value="<?= $response_body->data->paypal_form_data->upload ?>"/>
                <input type="hidden" name="mrb" value="<?= $response_body->data->paypal_form_data->mrb ?>"/>
                <input type="submit" id="pay" class="btn btn-danger btn-lg" value="Pay with Paypal" >
            </form>
        </div>
    </div>
    <?php get_footer(); ?>
    <?php
    die();
}