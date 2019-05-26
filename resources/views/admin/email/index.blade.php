<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Billing e.g. invoices and receipts</title>
        <style>
            * {
                margin: 0;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                box-sizing: border-box;
                font-size: 14px;
            }

            img {
                max-width: 100%;
            }

            body {
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: none;
                width: 100% !important;
                height: 100%;
                line-height: 1.6em;
            }

            /* Let's make sure all tables have defaults */
            table td {
                vertical-align: top;
            }

            /* -------------------------------------
                BODY & CONTAINER
            ------------------------------------- */
            body {
                background-color: #f6f6f6;
            }

            .body-wrap {
                background-color: #f6f6f6;
                width: 100%;
            }

            .container {
                display: block !important;
                max-width: 600px !important;
                margin: 0 auto !important;
                /* makes it centered */
                clear: both !important;
            }

            .content {
                max-width: 600px;
                margin: 0 auto;
                display: block;
                padding: 20px;
            }

            /* -------------------------------------
                HEADER, FOOTER, MAIN
            ------------------------------------- */
            .main {
                background-color: #fff;
                border: 1px solid #e9e9e9;
                border-radius: 3px;
            }

            .content-wrap {
                padding: 20px;
            }

            .content-block {
                padding: 0 0 20px;
            }

            .header {
                width: 100%;
                margin-bottom: 20px;
            }

            .footer {
                width: 100%;
                clear: both;
                color: #999;
                padding: 20px;
            }
            .footer p, .footer a, .footer td {
                color: #999;
                font-size: 12px;
            }

            /* -------------------------------------
                TYPOGRAPHY
            ------------------------------------- */
            h1, h2, h3 {
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                color: #000;
                margin: 40px 0 0;
                line-height: 1.2em;
                font-weight: 400;
            }

            h1 {
                font-size: 32px;
                font-weight: 500;
                /* 1.2em * 32px = 38.4px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
                /*line-height: 38px;*/
            }

            h2 {
                font-size: 24px;
                /* 1.2em * 24px = 28.8px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
                /*line-height: 29px;*/
            }

            h3 {
                font-size: 18px;
                /* 1.2em * 18px = 21.6px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
                /*line-height: 22px;*/
            }

            h4 {
                font-size: 14px;
                font-weight: 600;
            }

            p, ul, ol {
                margin-bottom: 10px;
                font-weight: normal;
            }
            p li, ul li, ol li {
                margin-left: 5px;
                list-style-position: inside;
            }

            /* -------------------------------------
                LINKS & BUTTONS
            ------------------------------------- */
            a {
                color: #348eda;
                text-decoration: underline;
            }

            .btn-primary {
                text-decoration: none;
                color: #FFF;
                background-color: #348eda;
                border: solid #348eda;
                border-width: 10px 20px;
                line-height: 2em;
                /* 2em * 14px = 28px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
                /*line-height: 28px;*/
                font-weight: bold;
                text-align: center;
                cursor: pointer;
                display: inline-block;
                border-radius: 5px;
                text-transform: capitalize;
            }

            /* -------------------------------------
                OTHER STYLES THAT MIGHT BE USEFUL
            ------------------------------------- */
            .last {
                margin-bottom: 0;
            }

            .first {
            margin-top: 0;
            }

            .aligncenter {
                text-align: center;
            }

            .alignright {
                text-align: right;
            }

            .alignleft {
            text-align: left;
            }

            .clear {
                clear: both;
            }

            /* -------------------------------------
                ALERTS
                Change the class depending on warning email, good email or bad email
            ------------------------------------- */
            .alert {
                font-size: 16px;
                color: #fff;
                font-weight: 500;
                padding: 20px;
                text-align: center;
                border-radius: 3px 3px 0 0;
            }
            .alert a {
                color: #fff;
                text-decoration: none;
                font-weight: 500;
                font-size: 16px;
            }
            .alert.alert-warning {
                background-color: #FF9F00;
            }
            .alert.alert-bad {
                background-color: #D0021B;
            }
            .alert.alert-good {
                background-color: #68B90F;
            }

            /* -------------------------------------
                INVOICE
                Styles for the billing table
            ------------------------------------- */
            .invoice {
                margin: 40px auto;
                text-align: left;
                width: 80%;
                }
                .invoice td {
                padding: 5px 0;
                }
                .invoice .invoice-items {
                width: 100%;
                }
                .invoice .invoice-items td {
                border-top: #eee 1px solid;
                }
                .invoice .invoice-items .total td {
                border-top: 2px solid #333;
                border-bottom: 2px solid #333;
                font-weight: 700;
            }

            /* -------------------------------------
                RESPONSIVE AND MOBILE FRIENDLY STYLES
            ------------------------------------- */
            @media only screen and (max-width: 640px) {
                body {
                    padding: 0 !important;
                }

                h1, h2, h3, h4 {
                    font-weight: 800 !important;
                    margin: 20px 0 5px !important;
                }

                h1 {
                    font-size: 22px !important;
                }

                h2 {
                    font-size: 18px !important;
                }

                h3 {
                    font-size: 16px !important;
                }

                .container {
                    padding: 0 !important;
                    width: 100% !important;
                }

                .content {
                    padding: 0 !important;
                }

                .content-wrap {
                    padding: 10px !important;
                }

                .invoice {
                    width: 100% !important;
                }
            }
        </style>
        {{-- <link href="styles.css" media="all" rel="stylesheet" type="text/css" /> --}}
    </head>
    <body>
        <table class="body-wrap">
            <tr>
                <td></td>
                <td class="container" width="600">
                    <div class="content">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-wrap aligncenter">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="content-block">
                                                <h1 class="aligncenter">TicketBooking</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block">
                                                <h2 class="aligncenter">@lang('main.thank_use')</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block aligncenter">
                                                <table class="invoice">
                                                    <tr>
                                                        <td>
                                                            <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td colspan="2">@lang('main.information_ticket')</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.name')</td>
                                                                    <td class="alignright">{{ $ticket->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.email')</td>
                                                                    <td class="alignright">{{ $ticket->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.phone')</td>
                                                                    <td class="alignright">{{ $ticket->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.quantity')</td>
                                                                    <td class="alignright">
                                                                        {{ $ticket->quantity }}
                                                                        ({{ implode(', ', json_decode($ticket->seat_number)) }})
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.payment_method')</td>
                                                                    <td class="alignright">{{ $ticket->payment_method_str }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.date_away')</td>
                                                                    <td class="alignright">{{ $ticket->date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('main.route')</td>
                                                                    <td class="alignright">{{ $ticket->busRoute->route->name_route }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.lisense_plate')</td>
                                                                    <td class="alignright">{{ $ticket->busRoute->bus->lisense_plate }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.start_place')</td>
                                                                    <td class="alignright">{{ $ticket->start_place ?? $ticket->busRoute->route->start_station_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('ticket.destination_place')</td>
                                                                    <td class="alignright">{{ $ticket->destination_place ?? $ticket->busRoute->route->destination_station_name }}</td>
                                                                </tr>
                                                                <tr class="total">
                                                                    <td class="alignright" width="80%">@lang('ticket.total_price')</td>
                                                                    <td class="alignright">{{ $ticket->price_format }}đ</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block aligncenter">
                                                <a href="http://www.mailgun.com">View detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block aligncenter">
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div class="footer">
                            <table width="100%">
                                <tr>
                                    <td class="aligncenter content-block">Questions? Email <a href="mailto:">support@acme.inc</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td></td>
            </tr>
        </table>
    </body>
</html>