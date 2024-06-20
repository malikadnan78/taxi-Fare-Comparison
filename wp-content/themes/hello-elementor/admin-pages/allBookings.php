<?php
function my_admin_menu3() {
add_menu_page(
__( 'Bookings page', 'my-textdomain' ),
__( 'Manage Bookings', 'my-textdomain' ),
'manage_options',
'bookings-page',
'booking_page_contents',
'dashicons-schedule',
5
);
}

add_action( 'admin_menu', 'my_admin_menu3' );


function booking_page_contents() {
    if (isset($_GET['id']) && isset($_GET['action'])) {

        $id=$_REQUEST['id'];
        global $wpdb;                           // WPDB class object

        $delete= $wpdb->delete(
            $wpdb->prefix . 'booking',      // table name with dynamic prefix
            ['id' => $id],                       // which id need to delete
            ['%d'],                             // make sure the id format
        );
        if($delete){
            ?>
            <script type='text/javascript'>
                alert('Booking Deleted');
        
               window.location = "?page=bookings-page";
        </script>
            <?php
        }
    }
    if (isset($_GET['confirmation-booking-id'])) {
        require get_template_directory() . '/pages/confirm_booking.php';
        $mailsent = sendBookingConfirmationEmail($_GET['confirmation-booking-id']);

        global $wpdb;
        $table = $wpdb->prefix.'booking';
        $data = array('booking_confirmed' => 1 );
        $where = [ 'id' => $_GET['confirmation-booking-id'] ];
        $format = array('%d');
        $wpdb->update($table,$data,$where,$format);

        if ($mailsent) {
            ?>
            <script>
                alert("Booking Confirmed successfully");
                window.location = "?page=bookings-page";
            </script>
            <?php
        }
    }

    if (isset($_GET['reciept-booking-id'])) {
        global $wpdb;
        $table = $wpdb->prefix.'booking';
        $data = array('paymentstatus' => 'paid' );
        $where = [ 'id' => $_GET['reciept-booking-id'] ];
        $format = array('%s','%s','%s');
        $wpdb->update($table,$data,$where,$format);

        $booking = $wpdb->get_row("SELECT * FROM wp_booking where id={$_GET['reciept-booking-id']}");
        $car           = $booking->car;
        $fname         = $booking->firstname;
        $lname         = $booking->lastname;
        $email         = $booking->email;
        $phone         = $booking->phone;
        $origin        = $booking->origin;
        $destination   = $booking->destination;
        $luggages      = $booking->luggage;
        $hluggages     = $booking->handluggage;
        $pickupdate    = $booking->pickdate;
        $return        = $booking->returndate;
        $passanger     = $booking->passangers;
        $trip          = $booking->trip;
        $amount        = $booking->cost;
        $reffno        = $booking->reffno;
        $flight        =$booking->flight;
        $tx            = '';
        $paymentmethod = $booking->paymentmethod;
        $discount      = $booking->discount;

        $email_data = compact('car', 'fname', 'lname', 'email', 'phone', 'origin', 'luggages', 'hluggages', 'pickupdate', 'return', 'passanger', 'destination', 'amount', 'tx', 'trip', 'reffno', 'paymentmethod','flight', 'discount');

        require get_template_directory() . '/pages/reciept_email.php';
        $mailsent = sendRecieptEmail($email_data);

        if ($mailsent) {
            ?>
            <script>
                alert("Reciept Sent successfully");
                window.location = "?page=bookings-page";
            </script>
            <?php
        }
    }
?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container-fluid wrap">
        <div class="row">
            <div class="col-12">
                <h1><?php esc_html_e( 'Bookings', 'my-plugin-textdomain' ); ?></h1>

                <table id="bookings" class="display cell-border table table-bordered table-hover dt-responsive responsive nowrap" >
                    <thead>
                    <tr>
                        <th>Created at</th>
                        <th>Reference</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone#</th>
                        <th>Address</th>
                        <th>Pick Date</th>
                        <th>Return Date</th>

                        <th>Cost</th>
                        <th>Fare Type</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Pick Location</th>
                        <th>Destination</th>
                        <th>Flight No</th>
                        <th>Trip Type</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    global $wpdb;

                    // $query = $wpdb->get_results("SELECT * , DATEDIFF(`pickdate`, CURDATE()) AS diff 
                    // FROM wp_booking 
                    // order by CASE WHEN diff = 0 THEN 1 ELSE 0 END, diff");

                    $query = $wpdb->get_results("(SELECT * FROM wp_booking WHERE booking_confirmed!=1 && DATE(pickdate)='".date("Y-m-d")."') 
                        UNION 
                        (SELECT * FROM wp_booking WHERE booking_confirmed!=1 && DATE(pickdate)!='".date("Y-m-d")."' ORDER BY pickdate DESC)");

                    // $query = $wpdb->get_results("SELECT * FROM wp_booking WHERE DATE(pickdate)= 
                    //     UNION SELECT * FROM wp_booking WHERE DATE(pickdate)!=".date('y-m-d')." ORDER BY pickdate DESC");

                    // $query = new WP_Query([
                    // 	's' => $search_term,
                    // 	'posts_per_page' => -1,
                    // ]);
                    foreach($query as $result){
                        ?>
                        <tr>

                            <td><?=$result->created_at;?></td>
                            <td><?=$result->reffno;?></td>
                            <td><?=$result->firstname;?></td>
                            <td><?=$result->lastname;?></td>
                            <td><?=$result->email;?></td>
                            <td><?=$result->phone;?></td>
                            <td><?=$result->address;?></td>
                            <td><?=$result->pickdate;?></td>
                            <td><?=$result->returndate;?></td>
                            <td>
                                <?php if ($result->cost_id): ?>
                                    <?php
                                    if ($result->faretype === 'Fixed')
                                        $page_name = 'prices-page';
                                    else
                                        $page_name = 'milage-price-division';
                                    ?>
                                    <a href="<?php echo $_SERVER['SCRIPT_URI'].'?page='.$page_name.'&id='.$result->id; ?>"><?=$result->cost;?></a>
                                <?php else: ?>
                                    <?=$result->cost;?>
                                <?php endif; ?>
                            </td>
                            <td><?=$result->faretype;?></td>
                            <td><?=$result->paymentmethod;?></td>
                            <td><?=$result->paymentstatus;?></td>
                            <td><?=$result->origin;?></td>
                            <td><?=$result->destination;?></td>
                            <td><?=$result->flight;?></td>
                            <td><?=$result->trip;?></td>
                            <td><?= $result->company ?></td>
                            <td><a href="?page=bookings-page&id=<?=$result->id;?>&action=delete">
                                    <i class='fa fa-trash'></i>
                                </a>&nbsp;
                                <a href="?page=edit-booking&id=<?=$result->id;?>&action=update"><i class="fa fa-edit"></i></a>&nbsp;

                                <?php if ($result->booking_confirmed): ?>
                                    <i class='fa fa-handshake-o'> Confirmed </i>
                                <?php else: ?>
                                    <a href="?page=bookings-page&confirmation-booking-id=<?php echo $result->id; ?>"><i class='fa fa-handshake-o'> Confirm</i></a>
                                <?php endif; ?>

                                <a href="?page=bookings-page&reciept-booking-id=<?php echo $result->id; ?>" ><i class='fa fa-envelope-open'> Send Reciept </i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



      <!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
      <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>



      <script>

      $(document).ready(function() {

          $('#bookings').DataTable( {
              //"order": [[ 6, "desc" ]],
              "aaSorting": [],
              responsive: true
      }); } );

      </script>
    <?php
}
