<?php /* Template Name: My Account */
get_header();
?>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
  <style>
    .register {
        position: absolute;
        margin-top: -56px;
        margin-left: 80px;
    }

    .iti {
        position: relative;
        display: block !important;
    }

    .col-3.box {
        border: 1px solid red;
    }

    .car_title {
        text-align: center;
        font-weight: 700;
    }

    .book_now a {
        background: blue;
        padding: 10px;
        text-align: center;
        color: #fff;
        text-decoration: none;
    }

    .book_now {
        margin-bottom: 24px;
        margin-left: 33%;
    }

    .container {
        padding-top: 100px;
        padding-bottom: 100px;
    }

    .details .col-10,
    .details .col-2 {
        float: left;
        background: #ccc;
        padding: 5px;
        border-bottom: 1px solid #fff;
    }

    .results {
        font-family: "Arial", Sans-serif;
        margin-bottom: 15px;
        border-bottom: 1px solid red;
        padding: 0;
    }

    .cost {

        text-align: center;
        font-weight: 700;

    }

    .distance {
        float: left;
        margin-right: 25px;
        margin-bottom: 15px;
        font-size: 1.3em;
    }

    .btnimp:hover {
        background-color: #0a2066;
    }

    .btnimp {
        background-color: #b11134;
        width: 100%;
        border: none;

    }

    .form-heading{
        text-align: center;
        font-family: "Noto Sans", Sans-serif;
        font-weight: 600;
        text-transform: uppercase;
    }

    [type=button], [type=submit], button {
    display: inline-block;
    font-weight: 400;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: #ED1C24;
    border: 0px;
    padding: .5rem 1rem;
    font-size: ;
    /* font-size: 1rem; */
    ius: 3px;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
}

    .form{
        padding: 50px;
        box-shadow: 0px 0px 1px 0px rgba(0,0,0,0.5);
    }

    .pagination {
        display: none;
    }
</style>

    <div class="container">
        <?php
        $_SESSION["bookinuri"] = $_SERVER['REQUEST_URI'];
if (!is_user_logged_in()) { 
?>
    <div class="container">
        <div class="row">
            <h2 class="form-heading">Please Login</h2>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 form">
                <?php
                wp_login_form();
                ?>
                <a href="/register"><button class="register">Register</button></a>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>
<?php
} else if (is_user_logged_in()) {
    if (isset($_SESSION['booking_url'])) {
        wp_redirect($_SESSION['booking_url']);
        exit();
    }

    $current_user = wp_get_current_user();

    if (isset($_REQUEST['refund_request'])) {
        require 'refund_request_email.php';

        $booking_id = $_REQUEST['booking_id'];
        $reason = $_REQUEST['reason']?? '';
        
        global $wpdb;
        $res = $wpdb->insert($wpdb->prefix."refund_requests", array(
            'user_id' => $current_user->ID,
            'booking_id' => $booking_id,
            'reason' => $reason,
        ), array(
            '%d',
            '%d',
            '%s',
        ));

        $username = $current_user->user_login;
        $email = $current_user->user_email;
        send_refund_request_email(compact('username', 'email'));

        if ($res) {
            ?>
            <script>
                alert("Request successfully sent.");
            </script>
            <?php
        }
    }
?>

        <div class="row">
            <div class="col-12">
                <h1><?php esc_html_e( 'My Bookings', 'my-plugin-textdomain' ); ?></h1>

                <table id="bookings" class="display cell-border table table-bordered table-hover dt-responsive responsive nowrap" >
                    <thead>
                    <tr>
                        <th>Created at</th>
                        <th>Reference</th>
                        <th>Pick Date</th>
                        <th>Return Date</th>

                        <th>Cost</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Pick Location</th>
                        <th>Destination</th>
                        
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

                    $query = $wpdb->get_results("(SELECT * FROM wp_booking WHERE user_id=".$current_user->ID." ORDER BY pickdate DESC)");

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
                                    <?=$result->cost;?>
                                <?php else: ?>
                                    <?=$result->cost;?>
                                <?php endif; ?>
                            </td>
                            <td><?=$result->paymentmethod;?></td>
                            <td><?=$result->paymentstatus;?></td>
                            <td><?=$result->origin;?></td>
                            <td><?=$result->destination;?></td>
                            
                            <td><?=$result->flight;?></td>
                            <td><?=$result->trip;?></td>
                            <td class="col-2 text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestRefund<?= $result->id ?>">
                                    Request Refund
                                </button>
                                <!-- The Modal -->
                                <div class="modal fade" id="requestRefund<?= $result->id ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <input type="hidden" name="booking_id" value="<?= $result->id; ?>">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Request Refund</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div>
                                                        <label>Reason</label>
                                                        <textarea rows="5" name="reason" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="refund_request" value="true">Submit Request</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    <?php } 
get_footer(); ?>