<?php

/*
    Template Name: Booking Details
*/

$id = $_REQUEST['id'] ?? null;
$title = $_REQUEST['title'] ?? null;
$price = $_REQUEST['price'] ?? null;
$site = $_REQUEST['site'] ?? null;

$from_address = $_REQUEST['from_address'] ?? null;
$to_address = $_REQUEST['to_address'] ?? null;
$trip_type = $_REQUEST['trip_type'] ?? null;
$datetime = $_REQUEST['datetime'] ?? null;
$datetime_return = $_REQUEST['datetime_return'] ?? null;
$passengers = $_REQUEST['passengers'] ?? null;
$luggage = $_REQUEST['luggage'] ?? null;
$payment_methods = explode(',', $_REQUEST['payment_methods']?? '');

if (!$id || !$title || !$price || !$site || !$from_address || !$to_address || !$trip_type || !$datetime || !$passengers) {
    wp_redirect(home_url());
    ?>
    <script>
        window.location.href = '<?= home_url(); ?>'
    </script>
    <?php
    wp_die();
}

?>

<?= get_header(); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<style>
    input[type="text"], input[type="tel"], select {
        border: 1px solid rgba(0,0,0,.125) !important;
    }

    .iti {
        display: block;
    }
</style>

<div class="container py-4">
    <h2 class="text-center mb-2">Booking Form</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['error'] ?></strong>
        </div>
    <?php unset($_SESSION['error']); endif; ?>
    <div class="row">
        <div class="col-md-4 order-md-2">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Booking Details</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Car</h6>
                        <small class="text-muted"><?= $title ?></small>
                    </div>
                    <span class="text-muted">£<?= $price ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Pickup Location</h6>
                        <small class="text-muted"><?= $from_address ?></small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Destination</h6>
                        <small class="text-muted"><?= $to_address ?></small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Pick up Date/Time</h6>
                        <small class="text-muted"><?= $datetime ?></small>
                    </div>
                </li>
                <?php if ($trip_type === 'Return'): ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Return Date/Time</h6>
                        <small class="text-muted"><?= $datetime_return ?></small>
                    </div>
                </li>
                <?php endif; ?>
                <li style="background-color:#5A45CE; color:white" class="list-group-item d-flex justify-content-between">
                    <span>Total (GBP)</span>
                    <strong>£<?= $price ?></strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Billing Address</span>
            </h4>
            <form action="/book" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="price" value="<?= $price ?>">
                <input type="hidden" name="site" value="<?= $site ?>">
                <input type="hidden" name="from_address" value="<?= $from_address ?>">
                <input type="hidden" name="to_address" value="<?= $to_address ?>">
                <input type="hidden" name="trip_type" value="<?= $trip_type ?>">
                <input type="hidden" name="datetime" value="<?= $datetime ?>">
                <input type="hidden" name="datetime_return" value="<?= $datetime_return ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName" class="mb-2">First Name</label>
                        <input type="text" id="firstName" name="first_name" value="<?= old('first_name') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName" class="mb-2">Last Name</label>
                        <input type="text" id="lastName" name="last_name" value="<?= old('last_name') ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email" class="mb-2">Email (*)</label>
                        <input type="text" id="email" name="email" value="<?= old('email') ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="phone" class="mb-2">Phone <span class="text-muted">(*)</span></label>
                        <input type="tel"  class="form-control" id="phone" placeholder="" required name="phone[main]" value="<?= old('phone') ?>">
                        <input type="hidden" name="full_phone">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="mb-2">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required name="address" value="<?= old('address') ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="flightNumber" class="mb-2">Flight Number</label>
                        <input type="text" class="form-control" id="flightNumber" placeholder=""  name="flight" value="<?= old('flight') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="passengers" class="mb-2">Passengers</label>
                        <select class="form-select" id="passengers" name="passengers" required>
                            <option value="">Select</option>
                            <option value="1" <?php selected($passengers, 1) ?>>1</option>
                            <option value="2" <?php selected($passengers, 2) ?>>2</option>
                            <option value="3" <?php selected($passengers, 3) ?>>3</option>
                            <option value="4" <?php selected($passengers, 4) ?>>4</option>
                            <option value="5" <?php selected($passengers, 5) ?>>5</option>
                            <option value="6" <?php selected($passengers, 6) ?>>6</option>
                            <option value="7" <?php selected($passengers, 7) ?>>7</option>
                            <option value="8" <?php selected($passengers, 8) ?>>8</option>
                            <option value="9" <?php selected($passengers, 9) ?>>9</option>
                            <option value="10" <?php selected($passengers, 10) ?>>10</option>
                            <option value="11" <?php selected($passengers, 11) ?>>11</option>
                            <option value="12" <?php selected($passengers, 12) ?>>12</option>
                            <option value="13" <?php selected($passengers, 13) ?>>13</option>
                            <option value="14" <?php selected($passengers, 14) ?>>14</option>
                            <option value="15" <?php selected($passengers, 15) ?>>15</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="luggage" class="mb-2">Luggage</label>
                        <select class="form-select" id="luggage" name="luggage" required>
                            <option value="">Select</option>
                            <option value="1" <?php selected($luggage, 1) ?>>1</option>
                            <option value="2" <?php selected($luggage, 2) ?>>2</option>
                            <option value="3" <?php selected($luggage, 3) ?>>3</option>
                            <option value="4" <?php selected($luggage, 4) ?>>4</option>
                            <option value="5" <?php selected($luggage, 5) ?>>5</option>
                            <option value="6" <?php selected($luggage, 6) ?>>6</option>
                            <option value="7" <?php selected($luggage, 7) ?>>7</option>
                            <option value="8" <?php selected($luggage, 8) ?>>8</option>
                            <option value="9" <?php selected($luggage, 9) ?>>9</option>
                            <option value="10" <?php selected($luggage, 10) ?>>10</option>
                            <option value="11" <?php selected($luggage, 11) ?>>11</option>
                            <option value="12" <?php selected($luggage, 12) ?>>12</option>
                            <option value="13" <?php selected($luggage, 13) ?>>13</option>
                            <option value="14" <?php selected($luggage, 14) ?>>14</option>
                            <option value="15" <?php selected($luggage, 15) ?>>15</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="handLuggage" class="mb-2">Hand Luggage</label>
                        <select class="form-select" id="handLuggage" name="hand_luggage" required>
                            <option value="">Select</option>
                            <option value="1" <?= (int) old('hand_luggage') === 1? 'selected': '' ?>>1</option>
                            <option value="2" <?= (int) old('hand_luggage') === 2? 'selected': '' ?>>2</option>
                            <option value="3" <?= (int) old('hand_luggage') === 3? 'selected': '' ?>>3</option>
                            <option value="4" <?= (int) old('hand_luggage') === 4? 'selected': '' ?>>4</option>
                            <option value="5" <?= (int) old('hand_luggage') === 5? 'selected': '' ?>>5</option>
                            <option value="6" <?= (int) old('hand_luggage') === 6? 'selected': '' ?>>6</option>
                            <option value="7" <?= (int) old('hand_luggage') === 7? 'selected': '' ?>>7</option>
                            <option value="8" <?= (int) old('hand_luggage') === 8? 'selected': '' ?>>8</option>
                            <option value="9" <?= (int) old('hand_luggage') === 9? 'selected': '' ?>>9</option>
                            <option value="10" <?= (int) old('hand_luggage') === 10? 'selected': '' ?>>10</option>
                            <option value="11" <?= (int) old('hand_luggage') === 11? 'selected': '' ?>>11</option>
                            <option value="12" <?= (int) old('hand_luggage') === 12? 'selected': '' ?>>12</option>
                            <option value="13" <?= (int) old('hand_luggage') === 13? 'selected': '' ?>>13</option>
                            <option value="14" <?= (int) old('hand_luggage') === 14? 'selected': '' ?>>14</option>
                            <option value="15" <?= (int) old('hand_luggage') === 15? 'selected': '' ?>>15</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <h5 class="mb-2">Payment Method</h5>
                        <?php foreach ($payment_methods as $method): ?>
                            <div class="custom-control custom-radio d-flex align-items-center gap-1 mb-2 ps-2">
                                <input id="<?= $method ?>" name="payment_method" type="radio" class="custom-control-input" required value="<?= $method ?>" <?= old('payment_method') === $method? 'checked': '' ?>>
                                <label class="custom-control-label" for="<?= $method ?>"><?= ucfirst($method === 'stripe'? 'Pay with Credit/Debit Card': $method) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-primary-new d-block w-100">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        var phone_number = window.intlTelInput(document.querySelector("#phone"), {
            separateDialCode: true,
            preferredCountries:["gb"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
    });
</script>
<?php get_footer(); ?>