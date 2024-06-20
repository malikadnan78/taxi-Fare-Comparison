<?php

add_shortcode('cars_results', function () {
    if (!isset($_POST['search'])) {
        return "<div class=\"bg-white\">
            <h3>Not Found</h3>
        </div>";
    }

    $from_address = $to_address = '';

    if ($_POST['from_address_method'] === 'auto') {
        $from_address = $_POST['from_address'];
    } else {
        $from_house = $_POST['from_house'];
        $from_street = $_POST['from_street'];
        $from_town = $_POST['from_town'];
        $from_county = $_POST['from_county'];
        $from_country = $_POST['from_country'];
        $from_post_code = $_POST['from_post_code'];
        $from_address = "$from_house $from_street $from_town $from_county $from_country $from_post_code";
    }

    if ($_POST['to_address_method'] === 'auto') {
        $to_address = $_POST['to_address'];
    } else {
        $to_house = $_POST['to_house'];
        $to_street = $_POST['to_street'];
        $to_town = $_POST['to_town'];
        $to_county = $_POST['to_county'];
        $to_country = $_POST['to_country'];
        $to_post_code = $_POST['to_post_code'];
        $to_address = "$to_house $to_street $to_town $to_county $to_country $to_post_code";
    }

    $drive = $_POST['ttype'];
    $trip_type = ($drive === 'oneway' ? "One Way" : "Return");

    $date = $_POST['datetime1'];
    $hour = $_POST['hour1'];
    $minute = $_POST['minute1'];
    $datetime = "$date $hour:$minute";

    $date_return = $hour_return = $minute_return = $datetime_return = null;
    if ($trip_type === "Return") {
        $date_return = $_POST['datetime2'];
        $hour_return = $_POST['hour2'];
        $minute_return = $_POST['minute2'];
        $datetime_return = "$date_return $hour_return:$minute_return";
    }

    $passengers = $_POST['passengers'];
    $luggage = $_POST['luggage'];

    ob_start();

?>

    <script>
        const searchData = {
            from_address: '<?= $from_address ?>',
            to_address: '<?= $to_address ?>',

            trip_type: '<?= $trip_type ?>',

            date: '<?= $date ?>',
            hour: '<?= $hour ?>',
            minute: '<?= $minute ?>',
            datetime: '<?= $datetime ?>',

            date_return: '<?= $date_return ?>',
            hour_return: '<?= $hour_return ?>',
            minute_return: '<?= $minute_return ?>',
            datetime_return: '<?= $datetime_return ?>',

            passengers: '<?= $passengers ?>',
            luggage: '<?= $luggage ?>',
        };

        loadResultsSafe(searchData);

        function loadResultsSafe(searchData) {
            if (!jQuery)
                setTimeout(() => loadResultsSafe(searchData), 100);
            else
                loadResults(searchData);
        }

        async function loadResults() {
            const endpoints = [
                'https://britishcartransfer.co.uk/wp-json/api/cars-search',
                'https://bacarhire.co.uk/wp-json/api/cars-search',
                'https://airportpickdrop.com/wp-json/api/cars-search',
                'https://24x7cars.co.uk/wp-json/api/cars-search',
                'https://londoncartransfer.com/wp-json/api/cars-search',
                'https://londoncartransfer.co.uk/wp-json/api/cars-search',
            ]

            const apiRequests = [];
            for (endpoint of endpoints) {
                apiRequests.push(sendApiRequest(endpoint, searchData));
            }

            try {
                let cars = await Promise.all(apiRequests);
                cars = [].concat(...cars);
                renderCars(cars);
            } catch (error) {
                console.log("Could not load cars", error);
                renderCars([]);
            }
        }

        async function sendApiRequest(endpoint, searchData) {
            try {
                return await jQuery.ajax({
                    url: endpoint,
                    type: 'GET',
                    data: searchData,
                });
            } catch (error) {
                console.log("Failed:", endpoint, error);
                return [];
            }
        }

        function renderCars(cars) {
            let loader = document.querySelector('#loader');
            if (!loader) {
                setTimeout(() => renderCars(cars), 500);
                return;
            }

            loader.style.display = 'none';

            const carsContainer = document.querySelector('.cars');

            if (cars.length === 0) {
                return;
            }

            const carTemplate = document.querySelector("#carTemplate");
            let distance = null;

            const distanceEl = document.querySelector('.distance');
            distanceEl.textContent = cars[0].distance + ' ' + cars[0].distance_unit;
            distanceEl.style.visibility = "visible";

            if (cars[0].duration_text) {
                const durationEl = document.querySelector('.duration');
                durationEl.textContent = cars[0].duration_text;
                durationEl.style.visibility = "visible";
            }

            let cheapestFair = null;

            cars.forEach(car => {
                const carEl = carTemplate.content.cloneNode(true);

                const carImg = carEl.querySelector('.car-image');
                carImg.src = car.site_logo;
                if (car.logo_bg_color) {
                    carImg.style.backgroundColor = car.logo_bg_color;
                }
                if (car.site_name === '24X7 Cars') {
                    carImg.style.marginLeft = '50px';
                }

                carEl.querySelector('.car-title').textContent = car.title;
                let carPrice = carEl.querySelector('.car-price');
                carPrice.textContent = '£' + car.price;
                let priceClass = 'price-site-' + car.site_name.split(' ').join('_space_');
                carPrice.classList.add(priceClass)
                carEl.querySelector('.site-name').textContent = car.site_name.replaceAll('__', '(').replaceAll('--', ')').replaceAll('-', '.');
                const bookNowBtn = carEl.querySelector('.book-now-btn');

                bookNowBtn.href = `/booking-details?${(new URLSearchParams({
                    from_address: searchData.from_address,
                    to_address: searchData.to_address,
                    trip_type: searchData.trip_type,
                    datetime: searchData.datetime,
                    datetime_return: searchData.datetime_return,
                    passengers: searchData.passengers,
                    luggage: searchData.luggage,

                    id: car.id,
                    title: car.title,
                    price: car.price,
                    site: car.site_name,
                    payment_methods: car.payment_methods,
                })).toString()}`;

                let btnClass = 'btn-primary-site-' + car.site_name.split(' ').join('_space_');

                bookNowBtn.querySelector('button').classList.remove('btn-primary-new');
                bookNowBtn.querySelector('button').classList.add(btnClass);

                carEl.querySelector('.styles').innerHTML = `
                    <style>
                        .${priceClass} {
                            color: ${car.color} !important;
                        }
                        .${btnClass} {
                            background: ${car.color} !important;
                            /* font-family: "Roboto Slab", Sans-serif; */
                            color: #FFFFFF !important;
                            padding: 7px 27px !important;
                            border: 2px solid ${car.color} !important;
                            box-shadow: none !important;
                            font-weight: 600;
                        }

                        .${btnClass}:hover, .${btnClass}:focus {
                            background: #ffffff !important;
                            color: ${car.color} !important;
                            padding: 7px 27px !important;
                            border: 2px solid ${car.color} !important;
                        }
                    </style>
                `;
     
                carsContainer.append(carEl);

                if (cheapestFair === null)
                    cheapestFair = car.price;
                
                if (car.price < cheapestFair)
                    cheapestFair = car.price;
            });

            if (cheapestFair !== null) {
                const cheapestFairEl = document.querySelector('.cheapest-fair');
                cheapestFairEl.textContent = '£' + cheapestFair;
                cheapestFairEl.style.visibility = "visible";
            }
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: #F5F5F5;
        }

        .booking-body {
            padding: 32px 0;
        }

        .Heading-style {
            background-color: #5A45CE;
            /* font-family: "Roboto Slab", Sans-serif; */
            color: #ffffff;
            padding: 15px 35px;
            font-size: 17px;
            border-radius: 7px;
        }

        .service-categories {
            margin-bottom: 1.5em;
            background-size: cover;
        }



        .service-categories .card {
            transition: all 0.3s;
        }

        .service-categories .card-title {
            padding-top: 0.5em;
            /* font-family: "Roboto Slab", Sans-serif; */
        }

        .service-categories a:hover {
            text-decoration: none;
        }

        .service-card {
            background: #ffffff;
            border: 0;
            padding: 1rem;
        }

        .service-card:hover {
            background: rgb(199, 204, 209);
            box-shadow: 2px 4px 8px 0px rgba(46, 61, 73, 0.2)
        }

        .fa {
            color: #5A45CE;
            width: 100%;
        }

        .card-block>h4 {
            margin-top: 10px;
            /* font-family: "Roboto Slab", Sans-serif; */
        }

        /*----  Card Style  ----*/
        /* #cards_landscape_wrap-2 {
            text-align: left;
            background: #F7F7F7;
        } */

        #cards_landscape_wrap-2 .container {
            padding-bottom: 100px;
        }

        #cards_landscape_wrap-2 a {
            text-decoration: none;
            outline: none;
        }

        #cards_landscape_wrap-2 .car:first-child .card-flyer {
            border-radius: 5px 5px 0 0;
        }

        #cards_landscape_wrap-2 .car:last-child .card-flyer {
            border-radius: 0 0 5px 5px;
        }

        #cards_landscape_wrap-2 .card-flyer .image-box {
            background: #ffffff;
            overflow: hidden;
            border-right: 1px solid #ddd3d3 !important;
            border-radius: 5px 0px 0px 5px;
        }

        #cards_landscape_wrap-2 .card-flyer .image-box img {
            -webkit-transition: all .9s ease;
            -moz-transition: all .9s ease;
            -o-transition: all .9s ease;
            -ms-transition: all .9s ease;
            /* width: 100%; */
            display: block;
            width: auto;
            height: 100px;
            margin: auto;
        }
        @media (min-width: 1050px) {
            #cards_landscape_wrap-2 .card-flyer .image-box img {
                height: 135px;
            }
        }

        #cards_landscape_wrap-2 .card-flyer:hover .image-box img {
            opacity: 0.7;
            -webkit-transform: scale(1.15);
            -moz-transform: scale(1.15);
            -ms-transform: scale(1.15);
            -o-transform: scale(1.15);
            transform: scale(1.15);
        }

        #cards_landscape_wrap-2 .card-flyer .text-box {
            text-align: left;
        }

        /* #cards_landscape_wrap-2 .card-flyer .text-box .text-container {
            padding: 30px 18px 0px 18px;
        } */

        #cards_landscape_wrap-2 .card-flyer {
            background: #FFFFFF;
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.40);
        }

        #cards_landscape_wrap-2 .card-flyer:hover {
            background: #fff;
            /* box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50); */
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }

        #cards_landscape_wrap-2 .card-flyer .text-box h6 {
            margin-top: 0px;
            margin-bottom: 4px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            /* font-family: "Roboto Slab", Sans-serif; */
            letter-spacing: 1px;
            color: #5A45CE;
        }

        #cards_landscape_wrap-2 .card-flyer .text-box h5 {
            margin-top: 0px;
            margin-bottom: 4px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            /* font-family: "Roboto Slab", Sans-serif; */
            letter-spacing: 1px;
            color: #000000;
        }

        hr {
            margin: 0;
            border-color: #000000;
        }

        .content {
            padding: 20px 18px 30px 18px;
        }

        .details {
            background-color: #F4A100;
            padding: 5px 15px;
            border-radius: 8px;
        }

        .details>p {
            margin: 3px;
            color: #000000;
        }

        .btn-primary-new {
            background: #5A45CE !important;
            /* font-family: "Roboto Slab", Sans-serif; */
            color: #FFFFFF !important;
            padding: 7px 27px !important;
            border: 2px solid #5A45CE !important;
            box-shadow: none !important;
        }

        .btn-primary-new:hover, .btn-primary-new:focus {
            background: #ffffff !important;
            color: #5A45CE !important;
            padding: 7px 27px !important;
            border: 2px solid #5A45CE !important;
        }

        .modal-content {
            box-shadow: 0 0.25rem 1rem 0 rgba(0, 0, 0, .1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffff
        }

        .form-heading {
            /* font-family: "Roboto Slab", Sans-serif; */
            font-size: 17px;
            font-weight: 600;
        }

        #loader {
            text-align: center;
            margin-top: 10rem;
        }

        .cars {
            max-width: 100%;
            margin: auto !important;
        }

        #addressSearchForm {
            margin-top: 0;
        }

        .car-price {
            color: #5A45CE;
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1650px !important;
            }
        }
        
        .booking_title, label, .nav-tabs .nav-link {
            color: #000000 !important;
        }

        .nav-tabs {
            border-bottom: 1px solid rgba(0, 0, 0, .3) !important;
        }

        .nav-tabs .nav-link.active {
            border: 1px solid rgba(0, 0, 0, .3) !important;
        }

        #addressSearchForm input, #addressSearchForm select {
            border: 1px solid rgba(0, 0, 0, .3) !important;
            box-shadow: none !important;
        }

        .container {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .card-flyer .text-box  {
            padding: 1rem;
        }
        @media (min-width: 600px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

    </style>

    <div class="container">
        <div class="row booking-body">
            <div class="col-lg-5 col-xl-4">
                <?= do_shortcode("[booking_form]") ?>
            </div>
            <div class="col-lg-7 col-xl-8">
                <h4 class="Heading-style" style="margin-bottom: 16px !important;">
                    Top Results
                </h4>
                <section class="service-categories text-xs-center">
                    <div class="display-flex">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="card service-card card-inverse">
                                    <div class="card-block">
                                        <span class="fa fa-lightbulb-o fa-2x"></span>
                                        <h5 class="card-title">Total Distance</h5>
                                        <h5 class="distance card-detail" style="visibility: hidden;">78 Miles</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="card service-card card-inverse">
                                    <div class="card-block">
                                        <span class="fa fa-bolt fa-2x"></span>
                                        <h5 class="card-title">Cheapest Fair</h5>
                                        <h5 class="cheapest-fair card-detail" style="visibility: hidden;">$110</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="card service-card card-inverse">
                                    <div class="card-block">
                                        <span class="fa fa-eye fa-2x"></span>
                                        <h5 class="card-title">Estimated Time</h5>
                                        <h5 class="duration card-detail" style="visibility: hidden;">20 Mins</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="cards_landscape_wrap-2">
                        <h4 id="loader">Loading...</h4>
                        <div class="row cars">

                        </div>
                </section>
            </div>
        </div>
    </div>

    <template id="carTemplate">
        <div class="car col-12">
            <div class="styles"></div>
            <div class="card-flyer row">
                <div class="image-box col-12 col-sm-4 col-md-3 col-lg-4 col-xl-3 col-xxl-3">
                    <img class="car-image" src="car1.png" style="height: 100px; width: auto; padding: 16px;" alt="" />
                    <p class="site-name mb-0 mt-2 mb-2 text-center" style="font-weight: 500;"></p>
                </div>
                <div class="text-box col-12 col-sm-8 col-md-9 col-lg-8 col-xl-9 row col-xxl-9">
                    <div class="text-container col-10 col-md-7 col-lg-8 col-xl-9 row col-xxl-9">
                        <h5 class="car-title">Torronto</h5>
                    </div>
                    <!-- <div class="content">
                        <div class="details d-flex justify-content-between mb-2">
                            <p>
                                Car Number
                            </p>
                            <p>
                                AEE-432
                            </p>
                        </div>
                        <div class="details d-flex justify-content-between mb-2">
                            <p>
                                Driver Name
                            </p>
                            <p>
                                Alex
                            </p>
                        </div>
                        <div class="details d-flex justify-content-between mb-2">
                            <p>
                                Contact Number
                            </p>
                            <p>
                                4564654
                            </p>
                        </div>

                    </div> -->
                    <div class="d-flex justify-content-center pb-3 col-2 col-md-5 col-lg-4 col-xl-3 col-xxl-3 align-items-center flex-column">
                        <h3 class="car-price">$ 98</h3>
                        <a href="" class="book-now-btn">
                            <button type="button" class="btn btn-primary-new">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<?php

    $output = ob_get_clean();
    return $output;
});
