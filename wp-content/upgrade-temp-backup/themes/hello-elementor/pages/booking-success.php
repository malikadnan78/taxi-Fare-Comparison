<?php

/*
    Template Name: Booking Success
*/
$site = $_REQUEST['site']?? null;
$payment_method = $_REQUEST['payment_method']?? null;
$booking_id = $_REQUEST['booking_id']?? null;

$payment_methods = [
    'cash',
    'stripe',
    'paypal'
];

if (!isset($payment_method) || !in_array($payment_method, $payment_methods) || !isset($booking_id) || !isset($site)) {
    wp_redirect(home_url());
    redirect_js(home_url());
    wp_die();
}

$endpoints = [
    'British Car Transfer' => 'https://britishcartransfer.co.uk/wp-json/api/booking?id=' . $booking_id,
    'Car Hire' => 'https://bacarhire.co.uk/wp-json/api/booking?id=' . $booking_id,
    'Airport Pick Drop' => 'https://airportpickdrop.com/wp-json/api/booking?id=' . $booking_id,
    '24X7 Cars' => 'https://24x7cars.co.uk/wp-json/api/booking?id=' . $booking_id,
    'London Car Transfer' => 'https://londoncartransfer.com/wp-json/api/booking?id=' . $booking_id,
    'London Car Transfer __-co-uk--' => 'https://londoncartransfer.co.uk/wp-json/api/booking?id=' . $booking_id,
];

// Get Booking details
$url = $endpoints[$site];

$request = array(
    'method'      => 'GET',
    'headers'     => [
        'Content-Type' => 'application/json',
    ],
);

$response = wp_remote_post($url, $request);

if (! is_wp_error($response)) {
    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);
    $response_body = json_decode($response_body);

    if ($response_code === 200) {
        global $wpdb;

        $data = array_merge(
            json_decode(json_encode($response_body->data), true),
            ['company' => (function ($name) {
                $name = str_replace('__', '(', $name);
                $name = str_replace('--', ')', $name);
                $name = str_replace('-', '.', $name);
                return $name;
            })($site)]
        );

        $wpdb->insert('wp_booking', $data);
    }
} else {
    echo "Response Code: $response_code";
    echo "<br>";
    echo "Response Body: $response_body";
    exit();
}

?>

<?php get_header(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div class="container">
        <?php if ($payment_method === 'cash'): ?>
            <div class="p-5 my-2">
                <h3 class="pay mb-3" >Your Ride has been Booked. We will confirm your booking shortly. You have to Pay Cash. Please contact us by Phone or Whatsapp to confirm your booking. <span style="white-space: nowrap;">+ 44 73 83333 605</span></h3 >
            </div>
        <?php elseif ($payment_method === 'paypal'): ?>
            <div class="p-5 my-2">
                <h3 class="pay mb-3" >Thank you for your booking, we have recieved your request. Your ride has been booked, we will confirm it soon.</h3 >
            </div>
        <?php else: ?>
            <div class="p-5 my-2">
                <h3 class="pay mb-3" >Thank you for your booking, we have recieved your request. Your ride has been booked, we will confirm it soon.</h3 >
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>