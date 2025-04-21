<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* Reset styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333 !important;
            background-color: #f9f9f9;
        }

        /* Force all text to be black (overriding Gmail's defaults) */
        p,
        span,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        td,
        th,
        div {
            color: #333333 !important;
        }

        /* Force links to be a specific color instead of Gmail default */
        a {
            color: #0066cc !important;
            text-decoration: underline;
        }

        /* Email container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .header h2 {
            margin-top: 15px;
            color: #333333 !important;
        }

        /* Content area */
        .content {
            padding: 20px;
        }

        /* Order summary box */
        .order-summary {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .order-summary h5 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333333 !important;
        }

        /* Order details section */
        .order-details {
            margin-top: 20px;
        }

        .order-details h5 {
            margin-bottom: 15px;
            font-size: 16px;
            color: #333333 !important;
        }

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #333333 !important;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        tfoot td {
            border-top: 2px solid #dee2e6;
        }

        .text-end {
            text-align: right;
        }

        /* Product image and info */
        .product-row {
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 10px;
        }

        .product-info p {
            margin-bottom: 3px;
        }

        .text-muted {
            color: #6c757d !important;
            font-size: 12px;
        }

        /* Shipping info */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-half {
            width: 50%;
            padding: 0 10px;
        }

        @media (max-width: 600px) {
            .col-half {
                width: 100%;
                margin-bottom: 20px;
            }
        }

        .shipping-info {
            margin-top: 20px;
        }

        .shipping-info h5 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333333 !important;
        }

        /* Thank you message */
        .thank-you {
            font-size: 18px;
            font-weight: bold;
            margin: 25px 0;
            color: #333333 !important;
        }

        /* Buttons */
        .button-container {
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-right: 10px;
        }

        .button-primary {
            background-color: #007bff;
            color: white !important;
            border: 1px solid #007bff;
        }

        .button-secondary {
            background-color: #ffffff;
            color: #6c757d !important;
            border: 1px solid #6c757d;
        }

        /* Footer */
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d !important;
            border-top: 1px solid #dee2e6;
        }

        .footer p {
            color: #6c757d !important;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 5px;
            color: #6c757d !important;
            text-decoration: none;
        }

        /* Helper classes */
        .mb-0 {
            margin-bottom: 0;
        }

        .mt-3 {
            margin-top: 15px;
        }

        .mt-4 {
            margin-top: 20px;
        }

        /* Fix for Gmail specifically */
        u+.body .gmail-specific {
            color: #333333 !important;
        }

        .text-capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body class="body">
    <div class="email-container gmail-specific">
        <!-- Header -->
        <div class="header">
            <img src="{{ config('logo') }}" alt="{{ config('site_title') }}" height="50">
            <h2 class="mt-3">Order Confirmation</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello <strong>{{ $order->name ?? $order->user->name }}</strong>,</p>

            <p>Thank you for your order! We're pleased to confirm that we've received your order and it's being
                processed.</p>

            <div class="order-summary">
                <h5>Order Summary</h5>
                <p><strong>Order Number:</strong> #{{ $order->id }}</p>
                <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}
                </p>
                <p><strong>Total Amount:</strong> LEI {{ number_format($order->total, 2) }}</p>
            </div>

            <div class="order-details">
                <h5>Order Details</h5>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-start">Service</th>
                                <th class="text-start">Variations</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="product-row">
                                            <img src="{{ asset('/storage/' . $item->service->thumbnail) }}"
                                                alt="{{ $item->service->name }}" class="product-image">
                                            <div class="product-info">
                                                <p class="mb-0"><strong>{{ $item->service->name }}</strong></p>
                                                <span class="text-muted">Category:
                                                    {{ $item->service->category->title }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        @foreach (json_decode($item->variations) as $va)
                                            <span class="d-block"
                                                style="font-size: 12px;">{{ $va->type }}: <span
                                                    class="badge text-primary">{{ $va->name }}</span></span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><span
                                            class="text-muted">{{ number_format(json_decode($item->price)->mainPrice, 2) }} lei</span>
                                    </td>
                                    <td>{{ number_format(json_decode($item->price)->mainPrice * $item->quantity, 2) }} lei
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @php
                            $mainTotal = 0;
                            foreach ($order->items as $item) {
                                $mainTotal += json_decode($item->price)->mainPrice * $item->quantity;
                            }

                        @endphp
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                <td>{{ number_format($mainTotal, 2) }} lei</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Discount:</strong></td>
                                <td>({{ number_format($mainTotal - $order->total, 2) }}) lei</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>{{ number_format($order->total, 2) }}</strong> lei</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-half shipping-info">
                    <h5>Address</h5>
                    <p>
                        {{ $order->name ?? $order->user->name }}<br>
                        @if ($order->address)
                            {{ $order->address }}<br>
                        @else
                            {{ $order->user->city }} {{ $order->user->zip }}, {{ $order->user->country }}<br>
                        @endif
                    </p>
                </div>
            </div>

            <div class="thank-you">
                <p>Thank you for shopping with us!</p>
            </div>

            <div class="button-container">
                {{-- <a href="#" class="button button-primary">Download Invoice</a> --}}
            </div>

            <div class="mt-4">
                <p>If you have any questions about your order, please contact our customer service team at <a
                        href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a> or call us at
                    {{ $site['phone'] }}.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> {{ $site['title'] }}. All rights reserved.
            </p>
            <p>{{ $site['address'] }}</p>

            <div class="social-links">
                @foreach ($socials as $key => $item)
                    <a href="{{ $item->url }}" class="text-capitalize">{{ $item->name }}</a>
                    @if ($key < count($socials) - 1)
                        |
                    @endif
                @endforeach
            </div>

            {{-- <div class="mt-3">
                <p><small>This email was sent to {Customer Email}. To update your preferences or unsubscribe, <a href="#">click here</a>.</small></p>
            </div> --}}
        </div>
    </div>
</body>

</html>
