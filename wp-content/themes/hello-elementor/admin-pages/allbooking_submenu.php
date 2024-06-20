<?php
function theme_options_panel(){

    add_submenu_page( 'bookings-page', 'Confirmed Bookings', 'Confirmed Bookings', 'manage_options', 'confirmed-bookings', 'confirmed_bookings_func');
    add_submenu_page( 'bookings-page', 'Quotations', 'Quotations', 'manage_options', 'quotations', 'quotations_func');
}
add_action('admin_menu', 'theme_options_panel');
function confirmed_bookings_func(){
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
        $tx            = '';
        $paymentmethod = $booking->paymentmethod;

        $email_data = compact('car', 'fname', 'lname', 'email', 'phone', 'origin', 'luggages', 'hluggages', 'pickupdate', 'return', 'passanger', 'destination', 'amount', 'tx', 'trip', 'reffno', 'paymentmethod');

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
    <div class="container-fluid">
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
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Pick Location</th>
                        <th>Destination</th>
                        <th>Fare Type</th>
                        <th>Flight No</th>
                        <th>Trip Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    global $wpdb;

                    // $query = $wpdb->get_results("SELECT * , DATEDIFF(`pickdate`, CURDATE()) AS diff 
                    // FROM wp_booking 
                    // order by CASE WHEN diff = 0 THEN 1 ELSE 0 END, diff");

                    $query = $wpdb->get_results("(SELECT * FROM wp_booking WHERE booking_confirmed=1 && DATE(pickdate)='".date("Y-m-d")."') 
                        UNION 
                        (SELECT * FROM wp_booking WHERE booking_confirmed=1 && DATE(pickdate)!='".date("Y-m-d")."' ORDER BY pickdate DESC)");

                    // $query = $wpdb->get_results("SELECT * FROM wp_booking WHERE DATE(pickdate)= 
                    //     UNION SELECT * FROM wp_booking WHERE DATE(pickdate)!=".date('y-m-d')." ORDER BY pickdate DESC");

                    // $query = new WP_Query([
                    //  's' => $search_term,
                    //  'posts_per_page' => -1,
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

                            <td><?=$result->cost;?></td>
                            <td><?=$result->paymentmethod;?></td>
                            <td><?=$result->paymentstatus;?></td>
                            <td><?=$result->origin;?></td>
                            <td><?=$result->destination;?></td>
                            <td><?=$result->faretype;?></td>
                            <td><?=$result->flight;?></td>
                            <td><?=$result->trip;?></td>
                            <td>
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

function quotations_func() {

    if (isset($_GET['id']) && isset($_GET['action'])) {

        $id=$_REQUEST['id'];
        global $wpdb;                           // WPDB class object

        $delete= $wpdb->delete(
            $wpdb->prefix . 'quotations',      // table name with dynamic prefix
            ['id' => $id],                       // which id need to delete
            ['%d'],                             // make sure the id format
        );
        if($delete){
            ?>
            <script type='text/javascript'>
                alert('Quotation Deleted');
        
               window.location = "?page=quotations";
        </script>
            <?php
        }
    }

    ?>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><?php esc_html_e( 'Quotations', 'my-plugin-textdomain' ); ?></h1>

                <table id="quotations" class="display cell-border table table-bordered table-hover dt-responsive responsive nowrap" >
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Origin Address</th>
                        <th>To Address</th>
                        <th>Trip Type</th>
                        <th>Pickup Date</th>
                        <th>Return Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    global $wpdb;
                    $query = $wpdb->get_results("SELECT * FROM wp_quotations ORDER BY id DESC");

                    foreach($query as $result){
                        ?>
                        <tr>

                            <td><?=$result->email;?></td>
                            <td><?=$result->origin_address;?></td>
                            <td><?=$result->to_address;?></td>
                            <td><?=$result->ttype;?></td>
                            <td><?=$result->datetime1;?></td>
                            <td><?=$result->datetime2;?></td>
                            <td>
                                <a href="?page=quotations&id=<?=$result->id;?>&action=delete">
                                    <i class='fa fa-trash'></i>
                                </a>&nbsp;
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

          $('#quotations').DataTable( {
              //"order": [[ 6, "desc" ]],
              "aaSorting": [],
              responsive: true
      }); } );

      </script>
    <?php
}