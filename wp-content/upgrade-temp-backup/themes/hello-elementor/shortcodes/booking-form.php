<?php

add_shortcode('booking_form', function () {
    ob_start();
?>
<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- jQuery library -->
<!-- Popper JS -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Stylesheet -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
<!--    <script type="text/javascript" src="//code.jquery.com/jquery-1.7.2.min.js"></script>-->
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD0ZGoVfySicVbBUD2Eeuuw_5CmtuUqdos">
</script>

<script language="javascript">
//var searchInput = 'search_input';
$(document).ready(function() {
    $(".default[name=\"datetime1\"]").datepicker({
        minDate: 0,
        dateFormat: 'dd-mm-yy',
    }).datepicker("setDate", new Date());

    $(".default[name=\"datetime2\"]").datepicker({
        minDate: 0,
        dateFormat: 'dd-mm-yy'
    });

    // Display current time in time fields
    const currentTime = new Date();
    let hours = currentTime.getHours();
    let minutes = currentTime.getMinutes();

    if (hours < 10) {
        hours = '0' + hours;
    }

    if (minutes < 10) {
        minutes = '0' + minutes;
    }

    if ($("[name=\"hour1\"]").val() === '0') {
        $("[name=\"hour1\"]").val(hours);
    }
    
    minutes = "00"; // Minutes should be 00 by default as minutes are displayed in steps of 5
    if ($("[name=\"minute1\"]").val() === '0') {
        $("[name=\"minute1\"]").val(minutes);
    }

    // var autocomplete;
    // var autocomplete2;
    // autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {

    //     types: ['geocode'],
    //     componentRestrictions: {
    //         country: "UK"
    //     },
    // });
    // autocomplete2 = new google.maps.places.Autocomplete((document.getElementById('search_input2')), {
    //     types: ['geocode'],
    //     componentRestrictions: {
    //         country: "UK"
    //     }
    // });
    // google.maps.event.addListener(autocomplete, 'place_changed', function() {
    //     var near_place = autocomplete.getPlace();
    //     document.getElementById('latitude_input').value = near_place.geometry.location.lat();
    //     document.getElementById('longitude_input').value = near_place.geometry.location.lng();

    // });


    // $(document).on('change', '#' + searchInput, function() {
    //     document.getElementById('latitude_input').value = '';
    //     document.getElementById('longitude_input').value = '';

    //     document.getElementById('latitude_view').innerHTML = '';
    //     document.getElementById('longitude_view').innerHTML = '';
    // });

    // google.maps.event.addListener(autocomplete2, 'place_changed', function() {
    //     var near_place2 = autocomplete2.getPlace();
    //     document.getElementById('latitude_input2').value = near_place2.geometry.location.lat();
    //     document.getElementById('longitude_input2').value = near_place2.geometry.location.lng();

    // });


    // $(document).on('change', '#search_input2', function() {
    //     document.getElementById('latitude_input2').value = '';
    //     document.getElementById('longitude_input2').value = '';

    // });
});

function expand(elementRef) {

    var dropdown = $(elementRef);
    dropdown.size = 5;
}

function closeListElement(elementRef) {
    elementRef.size = 1;
}
</script>
<style>
.field.clsRequired.valid {
    font-size: 15px;
    padding-left: 3px;
}

.field.clsRequired.minutes-min,
.field.clsRequired.hours-hrs {
    width: 95px;
    float: left;
}

.booking_title {
    text-align: center;
    color: #fff;
    font-family: "Noto Sans", Sans-serif;
    font-weight: 600;
    text-transform: uppercase;
}

.button-primary {
    background: blue;
    margin-top: 30px;
    color: #fff;
}

@media only screen and (max-width: 480px) {

    .col-3 {
        flex: 0 0 auto;
        width: 100%;
    }
}
</style>



<style>
.flatpickr-monthDropdown-months {
    display: inline-block !important;
}

.search-dropdown {
    position: relative;
}

.search-dropdown > .dropdown {
    position: absolute;
    background-color: #fff;
    border-radius: 2px;
    border-top: 1px solid #d9d9d9;
    box-shadow: 0 2px 6px rgba(0,0,0,.3);
    color: #444;
    width: 100%;
    height: auto;
    max-height: 400px;
    overflow: auto;
    z-index: 5000;
}

.search-dropdown > .dropdown.hidden {
    display: none;
}

.search-dropdown > .dropdown > .item {
    padding: 0 8px;
    transition: background-color .4;
    border-top: 1px solid #e6e6e6;
    color: #515151;
    font-size: 16px;
    line-height: 30px;
    cursor: pointer;
}

.search-dropdown > .dropdown > .item:hover {
    background-color: #fafafa;
}

.search-dropdown > .dropdown > .item.focused {
    background-color: #ebf2fe;
}
.form-styling{
    width: 100%;
    margin-top: 19px;
    padding: 25px;
    border-radius: 9px;
    color: white;
    margin-left: auto;
    margin-right: auto;
    /* background-image: linear-gradient(#821A3E,#bbb990,#22245A); */
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    margin-bottom: 10px;
}
.label-text{
    color: white;
}

.nav-tabs {
    border-bottom: 1px solid rgba(255, 255, 255, .2);
}

.nav-tabs .nav-link {
    background: none !important;
    color: white;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.nav-tabs .nav-link:hover {
    border: 1px solid rgba(255, 255, 255, .2);
}

.nav-tabs .nav-link.active {
    color: white;
    background-color: rgba(255,255,255,.3) !important;
    border: 1px solid rgba(255,255,255,.2);
}

.border-radius-left-0 {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
}

.border-radius-right-0 {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}

:disabled {
    background-color: #cfd1d3;
    color: #212529;
    -webkit-text-fill-color: #212529 !important;
}

</style>

<div class="container">

    <form id="addressSearchForm" method="post" class="form-group form-styling" action="/results/" name='searchform'>
        <div class="from-address-method-input">
            <?php if (from_address_method_is('auto')): ?>
                <input type="hidden" name="from_address_method" value="auto">
            <?php else: ?>
                <input type="hidden" name="from_address_method" value="manually">
            <?php endif; ?>
        </div>

        <div class="to-address-method-input">
            <?php if (to_address_method_is('auto')): ?>
                <input type="hidden" name="to_address_method" value="auto">
            <?php else: ?>
                <input type="hidden" name="to_address_method" value="manually">
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="booking_title">Book Your Ride</h3>

                <p class="urgent-booking-error d-none" style="background-color: red !important; font-weight: 500; border: 1px solid rgba(255,255,255,.2); padding: 6px 12px; border-radius: 0.25rem;">
                    You choose next 2 hours booking, please contact us by phone for urgent booking. Thanks
                </p>

                <!-- From Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= from_address_method_is('auto')? 'active': '' ?>" data-bs-toggle="tab" data-bs-target="#fromAuto" type="button" role="tab" aria-controls="fromAuto" aria-selected="true" onclick="setFromAddressMethod(this, 'auto')">From</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= from_address_method_is('manually')? 'active': '' ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#fromManual" type="button" role="tab" aria-controls="fromManual" aria-selected="false" onclick="setFromAddressMethod(this, 'manually')">Enter Manually</button>
                    </li>
                </ul>
                <div class="tab-content mb-3" id="myTabContent1">
                    <div class="tab-pane fade <?= from_address_method_is('auto')? 'show active': '' ?>" id="fromAuto" role="tabpanel">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <!-- <span class="label-text">From</span> -->
                                <div class="search-dropdown">
                                    <input type="text" class="form-control" id="search_input"
                                        placeholder="Search Airport Name, Post Code or Street Name" name="from_address"
                                        value="<?php if (isset($_POST['from_address'])) echo $_POST['from_address']; ?>" required />
                                    <div class="dropdown hidden">
                                    </div>
                                </div>
                                <!-- <input type="hidden" id="latitude_input" name="lat1"/>
                                <input type="hidden" id="longitude_input" name="long1"/> -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade <?= from_address_method_is('manually')? 'show active': '' ?>" id="fromManual" role="tabpanel">
                        <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <!-- <span class="label-text">From</span> -->
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="from_house" placeholder="House / Flat Number" value="<?= isset($_REQUEST['from_house'])? $_REQUEST['from_house']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="from_street" placeholder="Street" value="<?= isset($_REQUEST['from_street'])? $_REQUEST['from_street']: '' ?>" required >
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="from_town" placeholder="Town" value="<?= isset($_REQUEST['from_town'])? $_REQUEST['from_town']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="from_county"  placeholder="County" value="<?= isset($_REQUEST['from_county'])? $_REQUEST['from_county']: '' ?>" required >
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="from_country" placeholder="Country" value="<?= isset($_REQUEST['from_country'])? $_REQUEST['from_country']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="from_post_code" placeholder="Post Code" value="<?= isset($_REQUEST['from_post_code'])? $_REQUEST['from_post_code']: '' ?>" required >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destination Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= to_address_method_is('auto')? 'active': '' ?>"  data-bs-toggle="tab" data-bs-target="#destAuto" type="button" role="tab" aria-controls="destAuto"  onclick="setToAddressMethod(this, 'auto')">Destination</button>
                    </li>
                    <li class="nav-item" role="presentation" style="max-width: 131px;">
                        <button class="nav-link <?= to_address_method_is('manually')? 'active': '' ?>" data-bs-toggle="tab" data-bs-target="#destManual" type="button" role="tab" aria-controls="destManual" onclick="setToAddressMethod(this, 'manually')">Enter Manually</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade <?= to_address_method_is('auto')? 'show active': '' ?>" id="destAuto" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-12">
                                <!-- <span class="label-text">Destination</span> -->
                                <div class="search-dropdown">
                                    <input type="text" name="to_address" placeholder="Search Airport Name, Post Code or Street Name"
                                        class="form-control search-field" id="search_input2"
                                        value="<?php if (isset($_POST['to_address'])) echo $_POST['to_address']; ?>" required />
                                    <div class="dropdown hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade <?= to_address_method_is('manually')? 'show active': '' ?>" id="destManual" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <!-- <span class="label-text">Destination</span> -->
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="to_house" placeholder="House / Flat Number" value="<?= isset($_REQUEST['to_house'])? $_REQUEST['to_house']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="to_street" placeholder="Street" value="<?= isset($_REQUEST['to_street'])? $_REQUEST['to_street']: '' ?>" required >
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="to_town" placeholder="Town" value="<?= isset($_REQUEST['to_town'])? $_REQUEST['to_town']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="to_county" placeholder="County" value="<?= isset($_REQUEST['to_county'])? $_REQUEST['to_county']: '' ?>" required >
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-right-0" name="to_country" placeholder="Country" value="<?= isset($_REQUEST['to_country'])? $_REQUEST['to_country']: '' ?>" required >
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control border-radius-left-0" name="to_post_code" placeholder="Post Code" value="<?= isset($_REQUEST['to_post_code'])? $_REQUEST['to_post_code']: '' ?>" required >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 15px;padding-bottom: 10px;">

            <div class="col-3">

                <input type="radio" name="ttype" value="oneway" id="ttypeOneWay" class="radio"
                    <?php if (isset($_POST['ttype']) && $_POST['ttype'] === 'oneway') echo 'checked'; ?> required />
                <label style="<?php if (!isset($_POST['search'])) echo 'color: white' ?>;" class="label" for="ttypeOneWay">One way</label>


            </div>


            <div class="col-3">



                <input type="text" class="default" name="datetime1"
                    value="<?php if (isset($_POST['datetime1'])) echo $_POST['datetime1']; ?>" placeholder="Select Date"
                    required autocomplete="off" />
            </div>





            <div class="col-3">



                <select name="hour1" class="field clsRequired" onfocus="expand(this);"
                    onmouseout="closeListElement(this);" size="1">
                    <option value="0" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '0') echo 'selected' ?>>
                        Hour</option>
                    <option value="00" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '00') echo 'selected' ?>>
                        00</option>
                    <option value="01" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '01') echo 'selected' ?>>
                        01</option>
                    <option value="02" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '02') echo 'selected' ?>>
                        02</option>
                    <option value="03" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '03') echo 'selected' ?>>
                        03</option>
                    <option value="04" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '04') echo 'selected' ?>>
                        04</option>
                    <option value="05" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '05') echo 'selected' ?>>
                        05</option>
                    <option value="06" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '06') echo 'selected' ?>>
                        06</option>
                    <option value="07" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '07') echo 'selected' ?>>
                        07</option>
                    <option value="08" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '08') echo 'selected' ?>>
                        08</option>
                    <option value="09" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '09') echo 'selected' ?>>
                        09</option>
                    <option value="10" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '10') echo 'selected' ?>>
                        10</option>
                    <option value="11" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '11') echo 'selected' ?>>
                        11</option>
                    <option value="12" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '12') echo 'selected' ?>>
                        12</option>
                    <option value="13" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '13') echo 'selected' ?>>
                        13</option>
                    <option value="14" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '14') echo 'selected' ?>>
                        14</option>
                    <option value="15" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '15') echo 'selected' ?>>
                        15</option>
                    <option value="16" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '16') echo 'selected' ?>>
                        16</option>
                    <option value="17" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '17') echo 'selected' ?>>
                        17</option>
                    <option value="18" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '18') echo 'selected' ?>>
                        18</option>
                    <option value="19" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '19') echo 'selected' ?>>
                        19</option>
                    <option value="20" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '20') echo 'selected' ?>>
                        20</option>
                    <option value="21" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '21') echo 'selected' ?>>
                        21</option>
                    <option value="22" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '22') echo 'selected' ?>>
                        22</option>
                    <option value="23" <?php if (isset($_POST['hour1']) && $_POST['hour1'] === '23') echo 'selected' ?>>
                        23</option>

                </select>
            </div>


            <div class="col-3">



                <select name="minute1" class="field clsRequired">
                    <option value="0"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '0') echo 'selected' ?>>Minute
                    </option>
                    <option value="00"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '00') echo 'selected' ?>>00</option>
                    <option value="05"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '05') echo 'selected' ?>>05</option>
                    <option value="10"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '10') echo 'selected' ?>>10</option>
                    <option value="15"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '15') echo 'selected' ?>>15</option>
                    <option value="20"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '20') echo 'selected' ?>>20</option>
                    <option value="25"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '25') echo 'selected' ?>>25</option>
                    <option value="30"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '30') echo 'selected' ?>>30</option>
                    <option value="35"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '35') echo 'selected' ?>>35</option>
                    <option value="40"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '40') echo 'selected' ?>>40</option>
                    <option value="45"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '45') echo 'selected' ?>>45</option>
                    <option value="50"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '50') echo 'selected' ?>>50</option>
                    <option value="55"
                        <?php if (isset($_POST['minute1']) && $_POST['minute1'] === '55') echo 'selected' ?>>55</option>

                </select>
            </div>


        </div>



        <!-- Return -->
        <div class="row">
            <div class="col-3">

                <input type="radio" name="ttype" value="return" class="radio" id="return"
                    <?php if (isset($_POST['ttype']) && $_POST['ttype'] === 'return') echo 'checked'; ?> />
                <label style="<?php if (!isset($_POST['search'])) echo 'color: white' ?>;" class="label" for="return">Return</label>


            </div>
            <div class="col-3">
                <input type="text" class="default" name="datetime2" readonly
                    value="<?php if (isset($_POST['datetime2'])) echo $_POST['datetime2']; ?>" id="datetime"
                    placeholder="Select Date" autocomplete="off" />
            </div>
            <div class="col-3">
                <select name="hour2" class="field clsRequired" onfocus="expand(this);"
                    onmouseout="closeListElement(this);" size="1">
                    <option value="0" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '0') echo 'selected' ?>>
                        Hour</option>
                    <option value="00" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '00') echo 'selected' ?>>
                        00</option>
                    <option value="01" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '01') echo 'selected' ?>>
                        01</option>
                    <option value="02" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '02') echo 'selected' ?>>
                        02</option>
                    <option value="03" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '03') echo 'selected' ?>>
                        03</option>
                    <option value="04" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '04') echo 'selected' ?>>
                        04</option>
                    <option value="05" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '05') echo 'selected' ?>>
                        05</option>
                    <option value="06" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '06') echo 'selected' ?>>
                        06</option>
                    <option value="07" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '07') echo 'selected' ?>>
                        07</option>
                    <option value="08" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '08') echo 'selected' ?>>
                        08</option>
                    <option value="09" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '09') echo 'selected' ?>>
                        09</option>
                    <option value="10" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '10') echo 'selected' ?>>
                        10</option>
                    <option value="11" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '11') echo 'selected' ?>>
                        11</option>
                    <option value="12" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '12') echo 'selected' ?>>
                        12</option>
                    <option value="13" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '12') echo 'selected' ?>>
                        13</option>
                    <option value="14" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '14') echo 'selected' ?>>
                        14</option>
                    <option value="15" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '15') echo 'selected' ?>>
                        15</option>
                    <option value="16" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '16') echo 'selected' ?>>
                        16</option>
                    <option value="17" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '17') echo 'selected' ?>>
                        17</option>
                    <option value="18" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '18') echo 'selected' ?>>
                        18</option>
                    <option value="19" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '19') echo 'selected' ?>>
                        19</option>
                    <option value="20" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '20') echo 'selected' ?>>
                        20</option>
                    <option value="21" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '21') echo 'selected' ?>>
                        21</option>
                    <option value="22" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '22') echo 'selected' ?>>
                        22</option>
                    <option value="23" <?php if (isset($_POST['hour2']) && $_POST['hour2'] === '23') echo 'selected' ?>>
                        23</option>

                </select>
            </div>


            <div class="col-3">
                <select name="minute2" class="field clsRequired">
                    <option value="0"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '0') echo 'selected' ?>>Minute
                    </option>
                    <option value="00"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '00') echo 'selected' ?>>00</option>
                    <option value="05"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '05') echo 'selected' ?>>05</option>
                    <option value="10"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '10') echo 'selected' ?>>10</option>
                    <option value="15"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '15') echo 'selected' ?>>15</option>
                    <option value="20"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '20') echo 'selected' ?>>20</option>
                    <option value="25"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '25') echo 'selected' ?>>25</option>
                    <option value="30"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '30') echo 'selected' ?>>30</option>
                    <option value="35"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '35') echo 'selected' ?>>35</option>
                    <option value="40"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '40') echo 'selected' ?>>40</option>
                    <option value="45"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '45') echo 'selected' ?>>45</option>
                    <option value="50"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '50') echo 'selected' ?>>50</option>
                    <option value="55"
                        <?php if (isset($_POST['minute2']) && $_POST['minute2'] === '55') echo 'selected' ?>>55</option>
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3"></div>
            <div class="col-3">
                <label>Passengers</label>
                <select class="form-control w-fit-content" name="passengers">
                    <option value="1" <?php selected($_POST['passengers'], 1) ?>>1</option>
                    <option value="2" <?php selected($_POST['passengers'], 2) ?>>2</option>
                    <option value="3" <?php selected($_POST['passengers'], 3) ?>>3</option>
                    <option value="4" <?php selected($_POST['passengers'], 4) ?>>4</option>
                    <option value="5" <?php selected($_POST['passengers'], 5) ?>>5</option>
                    <option value="6" <?php selected($_POST['passengers'], 6) ?>>6</option>
                    <option value="7" <?php selected($_POST['passengers'], 7) ?>>7</option>
                    <option value="8" <?php selected($_POST['passengers'], 8) ?>>8</option>
                    <option value="9" <?php selected($_POST['passengers'], 9) ?>>9</option>
                    <option value="10" <?php selected($_POST['passengers'], 10) ?>>10</option>
                    <option value="11" <?php selected($_POST['passengers'], 11) ?>>11</option>
                    <option value="12" <?php selected($_POST['passengers'], 12) ?>>12</option>
                    <option value="13" <?php selected($_POST['passengers'], 13) ?>>13</option>
                    <option value="14" <?php selected($_POST['passengers'], 14) ?>>14</option>
                    <option value="15" <?php selected($_POST['passengers'], 15) ?>>15</option>
                </select>
            </div>
            <div class="col-3">
                <label>Luggage</label>
                <select class="form-control w-fit-content" name="luggage">
                    <option value="1" <?php selected($_POST['luggage'], 1) ?>>1</option>
                    <option value="2" <?php selected($_POST['luggage'], 2) ?>>2</option>
                    <option value="3" <?php selected($_POST['luggage'], 3) ?>>3</option>
                    <option value="4" <?php selected($_POST['luggage'], 4) ?>>4</option>
                    <option value="5" <?php selected($_POST['luggage'], 5) ?>>5</option>
                    <option value="6" <?php selected($_POST['luggage'], 6) ?>>6</option>
                    <option value="7" <?php selected($_POST['luggage'], 7) ?>>7</option>
                    <option value="8" <?php selected($_POST['luggage'], 8) ?>>8</option>
                    <option value="9" <?php selected($_POST['luggage'], 9) ?>>9</option>
                    <option value="10" <?php selected($_POST['luggage'], 10) ?>>10</option>
                    <option value="11" <?php selected($_POST['luggage'], 11) ?>>11</option>
                    <option value="12" <?php selected($_POST['luggage'], 12) ?>>12</option>
                    <option value="13" <?php selected($_POST['luggage'], 13) ?>>13</option>
                    <option value="14" <?php selected($_POST['luggage'], 14) ?>>14</option>
                    <option value="15" <?php selected($_POST['luggage'], 15) ?>>15</option>
                </select>
            </div>
        </div>
        <button type="submit" name="search" value="Search" class="btn btn-primary-new search">Search</button>
    </form>
</div>

<!-- Google Maps JavaScript library -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
    // Close search dropdown when click outside
    $(document).ready(function () {
        $(document).click(function (e) {
            if ($(e.target).is($('.search-dropdown .dropdown:not(.hidden)')) || 
                $(e.target).is($('.search-dropdown .dropdown:not(.hidden)').closest('.search-dropdown').find('input')))
                return;
            $('.search-dropdown .dropdown:not(.hidden)').addClass('hidden');
        })
    })
</script>
<script>
    $('.search-dropdown input').on('keydown', function (e) {
        const keyCode = e.originalEvent.keyCode;
        if (keyCode !== 40 && keyCode !== 38)
            return;

        const dropdown = $(e.target).closest('.search-dropdown').find('.dropdown');
        const focusedItem = dropdown.find('.item.focused');
        let newFocusedItem = null;
        
        if (keyCode === 40) {
            if (focusedItem.length) {
                focusedItem.removeClass('focused');
                newFocusedItem = focusedItem.next();
                if (newFocusedItem.length) {
                    newFocusedItem.addClass('focused');
                } else {
                    newFocusedItem = dropdown.find('.item:first-child');
                    newFocusedItem.addClass('focused');
                }
            } else {
                newFocusedItem = dropdown.find('.item:first-child');
                newFocusedItem.addClass('focused');
            }
        } else {
            if (focusedItem.length) {
                focusedItem.removeClass('focused');
                newFocusedItem = focusedItem.prev();
                if (newFocusedItem.length) {
                    newFocusedItem.addClass('focused');
                } else {
                    newFocusedItem = dropdown.find('.item:last-child');
                    newFocusedItem.addClass('focused');
                }
            } else {
                newFocusedItem = dropdown.find('.item:last-child');
                newFocusedItem.addClass('focused');
            }
        }
        
        e.target.value = newFocusedItem.data('value');
        // console.log(newFocusedItem.get(0).offsetTop + newFocusedItem.get(0).offsetHeight, dropdown.get(0).offsetHeight);
        // if ((newFocusedItem.get(0).offsetTop + newFocusedItem.get(0).offsetHeight)  > dropdown.get(0).offsetHeight) // scroll if item not visible
        //     dropdown.get(0).scrollTop += newFocusedItem.get(0).offsetHeight;
        // else if ((newFocusedItem.get(0).offsetTop + newFocusedItem.get(0).offsetHeight)  > dropdown.get(0).offsetHeight)
    })
</script>

<script>
    // Search addresses
    $(document).ready(function () {
        let timeout = null;
        $('#search_input').on('keyup', function (e) {
            const keyCode = e.originalEvent.keyCode;
            if (keyCode === 40 || keyCode === 38) // For up and down arrow keys
                return;
            //searchAddress(e.target);
            clearTimeout(timeout);
            timeout = setTimeout(() => searchAddress(e.target), 500);
        });
        $('#search_input2').on('keyup', function (e) {
            const keyCode = e.originalEvent.keyCode;
            if (keyCode === 40 || keyCode === 38) // For up and down arrow keys
                return;
            //searchAddress(e.target);
            clearTimeout(timeout);
            timeout = setTimeout(() => searchAddress(e.target), 500);
        });

        let searchXHR = null;

        function searchAddress(target) {
            if (searchXHR && searchXHR.readyState !== 4) {
                searchXHR.abort();
            }

            const dropdown = target.closest('.search-dropdown').querySelector('.dropdown');

            if (! target.value) {
                // if (! dropdown.classList.contains('hidden'));
                //     dropdown.classList.add('hidden');
                loadAirports(target);
                return;
            }

            searchXHR = $.ajax({
                url: '/wp-address.php',
                type: 'POST',
                // contentType: 'application/json',
                data: {
                    action: 'search_address',
                    query: target.value,
                },
                beforeSend: function () {
                    dropdown.classList.remove('hidden');
                    dropdown.innerHTML = '<div class="d-flex gap-1 align-items-center justify-content-center p-2"><div class="spinner-border spinner-border-sm text-muted"></div> <b class="text-muted">Loading...</b><div>';
                },
                success: function (res) {
                    res = JSON.parse(res.trim());

                    //dropdown.classList.remove('hidden');
                    dropdown.innerHTML = '';
                    // $(dropdown).append($(`<div class="dropdown-header">or select a quick suggestion from the list:</div>`));
                    res.forEach(item => {
                        const itemEl = $(`<div class="item" data-value="${item.address}">${item.displayAddress}</div>`);
                        itemEl.click(() => {
                            target.value = item.address;
                            dropdown.classList.add('hidden');
                        });
                        $(dropdown).append(itemEl);
                    });
                }
            });
        }

        $('#search_input, #search_input2').on('focus', function (event) {
            loadAirports(event.target);
        });

        let airports = null;

        function loadAirports(target) {
            if (searchXHR && searchXHR.readyState !== 4) {
                searchXHR.abort();
            }

            if (airports) {
                showAirports(target);
                return;
            }

            const dropdown = target.closest('.search-dropdown').querySelector('.dropdown');

            searchXHR = $.ajax({
                url: '/wp-airports.php',
                type: 'GET',
                // contentType: 'application/json',
                beforeSend: function () {
                    dropdown.classList.remove('hidden');
                    dropdown.innerHTML = '<div class="d-flex gap-1 align-items-center justify-content-center p-2"><div class="spinner-border spinner-border-sm text-muted"></div> <b class="text-muted">Loading...</b><div>';
                },
                success: function (res) {
                    res = JSON.parse(res.trim());
                    airports = res;
                    showAirports(target);
                }
            });
        }

        function showAirports(target) {
            const dropdown = target.closest('.search-dropdown').querySelector('.dropdown');
            dropdown.classList.remove('hidden');
            dropdown.innerHTML = '';
            // $(dropdown).append($(`<div class="dropdown-header">or select a quick suggestion from the list:</div>`));
            airports.forEach(item => {
                const itemEl = $(`<div class="item" data-value="${item.address}">${item.displayAddress}</div>`);
                itemEl.click(() => {
                    target.value = item.address;
                    dropdown.classList.add('hidden');
                });
                $(dropdown).append(itemEl);
            });
        }
    });
</script>

<script>
    function setFromAddressMethod(self, value) {
        self.closest('form').querySelector('.from-address-method-input').innerHTML = '<input type="hidden" name="from_address_method" value="'+value+'">'
    }

    function setToAddressMethod(self, value) {
        self.closest('form').querySelector('.to-address-method-input').innerHTML = '<input type="hidden" name="to_address_method" value="'+value+'">'
    }
</script>

<script>
// Wait for the DOM to be ready
// Initialize form validation on the registration form.
// It has the name attribute "registration"
$("form[name='searchform']").validate({
    // Specify validation rules
    rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        datetime1: "required",
        // lastname: "required",
        datetime2: {
            required: '#return:checked'
            //     // Specify that email should be validated
            //     // by the built-in "email" rule
            //     email: true
        },
        // password: {
        //     required: true,
        //     minlength: 5
        // }
    },
    // Specify validation error messages
    messages: {
        datetime: "Please enter your Pickuo"
        // lastname: "Please enter your lastname",
        // password: {
        //     required: "Please provide a password",
        //     minlength: "Your password must be at least 5 characters long"
        // },
        // email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        if (validateBookingDate())
            form.submit();
    }
});
// });




//$(document).ready(function () {

//});
</script>

<script>
    $(document).ready(function () {
        $('#addressSearchForm').on('submit', function (event) {
            if (! validateBookingDate())
                event.preventDefault();
        });

        $("[name=\"datetime1\"]").on('change', function (event) {
            validateBookingDate();
        });

        $("[name=\"hour1\"]").on('change', function (event) {
            validateBookingDate();
        });

        $("[name=\"minute1\"]").on('change', function (event) {
            validateBookingDate();
        });

        $("[name=\"ttype\"]").on('change', function (event) {
            const datetime = document.querySelector('[name=\"datetime2\"]');
            const hour = document.querySelector('[name=\"hour2\"]');
            const minute = document.querySelector('[name=\"minute2\"]');
            if (event.target.value === 'oneway')
                datetime.disabled = hour.disabled = minute.disabled = true;
            else
                datetime.disabled = hour.disabled = minute.disabled = false;
        });
    });

    function validateBookingDate() {
        const date = $("[name=\"datetime1\"]").val();
        const hour = $("[name=\"hour1\"]").val();
        const minute = $("[name=\"minute1\"]").val();

        if (hour === '0' || minute === '0')
            return false;

        const limitDate = new Date();
        limitDate.setHours(limitDate.getHours() + 2);

        const dateString = date + ' ' + hour + ':' + minute;
        
        const bookingDate = createDateFromFormat(dateString, 'dd-mm-yyyy HH:mm');
        
        if (bookingDate <= limitDate) {
            $('.urgent-booking-error').removeClass('d-none');
            return false;
        }

        $('.urgent-booking-error').addClass('d-none');
        
        return true;

    }

    function createDateFromFormat(dateString, format) {
        var parts = dateString.split(' ');
        var datePart = parts[0];
        var timePart = parts[1];

        var dateParts = datePart.split('-');
        var day = parseInt(dateParts[0], 10);
        var month = parseInt(dateParts[1], 10) - 1;
        var year = parseInt(dateParts[2], 10);

        var timeParts = timePart.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);

        return new Date(year, month, day, hours, minutes);
    }

</script>

<?php
    $content = ob_get_clean();
    return $content;
});

function from_address_method_is($method = 'auto') {
    if (!isset($_REQUEST['from_address_method']))
        return $method === 'auto';
    
    return $_REQUEST['from_address_method'] === $method;
}

function to_address_method_is($method = 'auto') {
    if (!isset($_REQUEST['to_address_method']))
        return $method === 'auto';
    
    return $_REQUEST['to_address_method'] === $method;
}