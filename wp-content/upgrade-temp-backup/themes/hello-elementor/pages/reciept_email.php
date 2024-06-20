<?php

function sendRecieptEmail($data)
{
    extract($data);

    if (!isset($discount)) {
        $discount = 0;
    }

    $body = '
  <blockquote type="cite">
        <div dir="ltr">&#xFEFF;<table style="font-family:Arial,Helvetica,sans-serif" width="99%" cellspacing="7"
                cellpadding="7" border="0">
                <tbody>
                    <tr style="font-size:small">
                        <td style="font-family:Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;font-style:normal;line-height:normal;font-variant:normal;text-transform:none;color:#ffffff;text-decoration:none"
                            height="50" bgcolor="#5A45CE" align="center">::: Confirmed Quick Booking - Pick Drop
                            Cars :::</td>
                    </tr>
                    <tr style="font-size:small">
                        <td align="left">
                            <p style="font-weight:bold">Booking Reference: ' . $reffno . '</p>
                            <p style="font-weight:bold">Dear ' . $fname . ' ' . $lname . ',</p>
                            <p>We have confirmed your Online booking request. Our driver will come and pick you up on
                                time. Followings are the details of the booking.</p>
                        </td>
                    </tr>
                    <tr style="font-size:small">
                        <td align="center">
                            <table
                                style="border:solid 1px #d5d5d5;background-color:#fff;padding:2% 2%;width:100%;float:left"
                                cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        <td id="m_4292282901239295323m_1711941332604012033table" style="color:Black"
                                            align="center">
                                            <div style="display:none">
                                            </div>
                                            <table
                                                style="border:#d4e0ee 1px solid;background-color:White;font-family:verdana,arial;font-size:11px;font-weight:normal;color:#000;text-decoration:none;width:100%"
                                                width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                    <tr style="background-color:#eff3f9">
                                                        <td colspan="2"
                                                            style="padding:5px;text-decoration:underline;border-top:#d4e0ee 1px solid;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;font-size:12px">
                                                            Traveller Information
                                                        </td>
                                                        <td colspan="2"
                                                            style="padding:5px;text-decoration:underline;border-top:#d4e0ee 1px solid;border-bottom:#d4e0ee 1px solid;font-size:12px">
                                                            Carrier Details
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;width:15%">
                                                            Name:
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;width:25%">
                                                            ' . $fname . ' ' . $lname . '
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;width:15%">
                                                            Passenger No:
                                                        </td>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid;width:45%"
                                                            id="m_4292282901239295323m_1711941332604012033nop">
                                                            ' . $passanger . '
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            Email Address:
                                                        </td>
                                                        <td>
                                                            <a href="mailto:' . $email . '"
                                                                target="_blank">' . $email . '</a>
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            Hand Luggage:
                                                        </td>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid">
                                                            ' . $hluggages . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            Mobile Number:
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            ' . $phone . '
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            Check-in Luggage:
                                                        </td>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid">
                                                            ' . $luggages . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            Vehicle:
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                            ' . $car . '
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;display:none"
                                                            width="30%">Additional Notes:</td>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;display:none"
                                                            width="30%">
                                                            
                                                        </td>
                                                        <td
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">

                                                        </td>
                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="border-bottom:#d4e0ee 1px solid">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr valign="top">
                                                        <td colspan="2">
                                                            <table
                                                                style="border:#d4e0ee 1px solid;background-color:White;font-family:verdana,arial;font-size:11px;font-weight:normal;color:#000;text-decoration:none;width:100%"
                                                                width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                <tbody>
                                                                    <tr style="background-color:#eff3f9">
                                                                        <td style="padding:5px;text-decoration:underline;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;font-size:12px"
                                                                            colspan="2">
                                                                            Pick-up Information
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                            From:
                                                                        </td>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                            ' . $origin . '
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                            Pick Up Date:
                                                                        </td>
                                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid"
                                                                            id="m_4292282901239295323m_1711941332604012033pickupdate">
                                                                            ' . date('d F Y', strtotime($pickupdate)) . '
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                            Pick Up Time:
                                                                        </td>
                                                                        <td style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid"
                                                                            id="m_4292282901239295323m_1711941332604012033pickuptime">
                                                                            ' . date('H:i', strtotime($pickupdate)) . '
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td colspan="2">
                                                            <table
                                                                style="border:#d4e0ee 1px solid;background-color:White;font-family:verdana,arial;font-size:11px;font-weight:normal;color:#000;text-decoration:none;width:100%"
                                                                width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                <tbody>
                                                                    <tr style="background-color:#eff3f9">
                                                                        <td style="padding:5px;text-decoration:underline;border-bottom:#d4e0ee 1px solid;font-size:12px"
                                                                            colspan="2">
                                                                            Drop-off Information
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                            To:
                                                                        </td>
                                                                        <td
                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid">
                                                                            ' . $destination . '
                                                                        </td>
                                                                    </tr>
                                                                     <tr>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Flight Number:
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . $flight . '
                                                                                        </td>
                                                                                    </tr>
';

    if (strtolower($trip) === 'return') {
        $body .= '
                                                                    <tr style="background-color:#eff3f9">
                                                                        <td colspan="2">

                                                                            <table
                                                                                style="border:#d4e0ee 1px solid;background-color:White;font-family:verdana,arial;font-size:11px;font-weight:normal;color:#000;text-decoration:none"
                                                                                width="100%" cellspacing="0"
                                                                                cellpadding="0" border="0">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="background-color:#eff3f9">
                                                                                        <td style="padding:5px;text-decoration:underline;border-bottom:#d4e0ee 1px solid;font-size:12px"
                                                                                            colspan="2">
                                                                                            Return Information
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr style="display:table-row">
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Return From
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . $destination . '
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Flight Number:
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . $flight . '
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr style="display:table-row">
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Return To
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . $origin . '
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Return Date
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . date('d F Y', strtotime($return)) . '
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            Return Time:
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid">
                                                                                            ' . date('H:i', strtotime($return)) . '
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
';
    }

    $body .= '                                          <tr>
                                                        <td colspan="2"
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;border-top:#d4e0ee 1px solid">
                                                            Additional Information: </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr id="m_4292282901239295323m_1711941332604012033trvia"
                                                        style="display:none">
                                                        <td
                                                            style="padding:10px 5px 10px 5px;font-size:14px;border:#d4e0ee 1px solid;background-color:White;text-decoration:underline;font-weight:bold">
                                                            Via Point:
                                                        </td>
                                                        <td style="padding:10px 5px 10px 5px;font-size:11px;border:#d4e0ee 1px solid;background-color:#eff3f9"
                                                            colspan="3">
                                                            -
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <td colspan="4" style="border-bottom:#d4e0ee 1px solid">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;border-top:#d4e0ee 1px solid">
                                                            <b>Fare Summary</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;border-top:#d4e0ee 1px solid">
                                                            Basic Fare : £ ' . ($amount?? $cost) . '[fare_type]</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="padding:5px;border-bottom:#d4e0ee 1px solid;border-right:#d4e0ee 1px solid;border-top:#d4e0ee 1px solid">
                                                            Discount : £ ' . $discount . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"
                                                            style="padding:10px 5px 10px 5px;font-size:18px;border-bottom:#d4e0ee 1px solid;background-color:#eff3f9">
                                                            <span>Total Fare: <span style="color:#008000"
                                                                    id="m_4292282901239295323m_1711941332604012033fares">£
                                                                    ' . ($amount?? $cost) . '</span></span> Payment
                                                            Type: <span style="color:#008000">' . $paymentmethod . '</span>.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr style="font-size:small">
                        <td style="font-weight:bold">
                            <p>Kind Regards,<br>Pick Drop,<br>+44 7383 333605</p>
                        </td>
                    </tr>
                    <tr style="text-align:center">
                        <td>Follow us on</td>
                    </tr>
                    <tr style="text-align:center">
                        <td><a style="display:inline-block" href="https://www.facebook.com/#/" target="_blank"
                                data-saferedirecturl=""><img
                                    src="https://ci5.googleusercontent.com/proxy/_btsqrtWG4EOgXeHnWrvdiWxHIGNZHGKKMbnZ_K21iCNYpe6B_zfKvOE6PA1ZvTtH4IkDSGRTjFE7nei31kdHXSK7Chs7vHI8bGv_CU=s0-d-e1-ft#https://www.britanniaairportcars.co.uk/images/facebook.png"
                                    alt="Facebook" class="CToWUd"></a><a style="display:inline-block"
                                href="https://twitter.com/#" target="_blank" data-saferedirecturl="#"><img
                                    src="https://ci5.googleusercontent.com/proxy/aNkVp5aUXIcr9c6W99nAwOjMcfCNMB6qUu2YzGb-4ghO90krgfmPx3T7xS6WIWNnPbO85r8bNgmYj96Gg-dgbJWJnllyMKxsLbkKPg=s0-d-e1-ft#https://www.britanniaairportcars.co.uk/images/twitter.png"
                                    alt="Twitter" class="CToWUd"></a><a style="display:inline-block"
                                href="https://www.linkedin.com/#" target="_blank" data-saferedirecturl=""><img
                                    src="https://ci4.googleusercontent.com/proxy/2BnTXm6h2yK8YhSLShE9JDcXWBCpIgeF3VSc3QJYdrqqVfDRzq5Ibn7PzxvqZIPLpUCKRszdmATQHWHfXzTKog-Dj8lvwgPhW1oPEMs=s0-d-e1-ft#https://www.britanniaairportcars.co.uk/images/linkedin.png"
                                    alt="Linkedin" class="CToWUd"></a><a style="display:inline-block"
                                href="https://www.instagram.com/#" target="_blank" data-saferedirecturl="#"><img
                                    src="https://ci5.googleusercontent.com/proxy/sHbGDMUdtUElOb3OzK5x5Nb_Os_E9aAiVoj8PQ4gQHoAE2hYSpmfQpblNEniK0HMenGyWrEBMqmJQxR-bDzj8qynvEibozXqsMflu-Xa=s0-d-e1-ft#https://www.britanniaairportcars.co.uk/images/instagram.png"
                                    alt="Instagram" class="CToWUd"></a></td>
                    </tr>
                    <tr style="font-size:small">
                        <td style="font-size:12px;font-style:normal;line-height:normal;font-variant:normal;text-transform:none;color:#ffffff;text-decoration:none;font-family:Arial,Helvetica,sans-serif"
                            height="10" bgcolor="#003A79" align="center">Pick Drop | All rights reserved.
                    </tr>
                </tbody>
            </table>
        </div>
    </blockquote>
  ';

    $to = $email;
    $subject = 'Booking Confirmation & Reciept';

    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Pick Drop <info@pickdrop.co.uk>');

    // Display fare type for admin
    $body1 = str_replace('[fare_type]', $fare_type === 'Fixed'? ' (coming from postcode)': ' (coming from milage)', $body);
    $mailsent2 =  wp_mail('arshadmansoor@gmail.com,markhorsolutionsltd@gmail.com', $subject, $body1, $headers);

    $body2 = str_replace('[fare_type]', '', $body); // No need to display fare type to customer
    $mailsent =  wp_mail($to, $subject, $body2, $headers);

    if ($mailsent) {
        return true;
    } else {
        false;
    }
}
