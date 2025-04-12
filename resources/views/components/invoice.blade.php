<div class="py-5">
    <div class="card" id="invoice">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-header border-bottom-dashed p-4">
                    <div class="d-sm-flex">
                        <div class="flex-grow-1">
                            <div class="logo-dark d-flex align-items-center">
                                <img src="@if ($settings->logo) {{ asset('/storage/' . $settings->logo) }} @endif"
                                    class="card-logo card-logo-dark" alt="logo dark" height="60">
                                <h3 class="px-2 m-0">{{ $settings->title }}</h3>
                            </div>
                            <div class="mt-sm-4 mt-4">
                                <h6 class="text-muted text-uppercase fw-semibold fs-14">Address</h6>
                                <p class="text-muted mb-1" id="address-details">{{ $settings->address }}</p>
                                <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span>
                                    {{ $settings->postalCode ?? 'null' }}</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0 mt-sm-0 mt-3">
                            <h6><span class="text-muted fw-normal">Legal Registration No:</span> <span
                                    id="legal-register-no">{{ $settings->registration }}</span></h6>
                            <h6><span class="text-muted fw-normal">VAT No:</span> <span
                                    id="legal-register-no">{{ $settings->vat }}</span></h6>
                            <h6><span class="text-muted fw-normal">Email:</span> <span
                                    id="email">{{ $settings->email }}</span></h6>
                            <h6><span class="text-muted fw-normal">Website:</span> <a href="https://themesbrand.com/"
                                    class="link-primary" target="_blank" id="website">{{ $settings->url }}</a></h6>
                            <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                    id="contact-no">
                                    {{ $settings->phone }}</span></h6>
                        </div>
                    </div>
                </div>
                <!--end card-header-->
            </div>
            <!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold fs-14">Order No</p>
                            <h5 class="fs-15 mb-0">#<span id="invoice-no">{{ $order->id }}</span></h5>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold fs-14">Date</p>
                            <h5 class="fs-15 mb-0"><span
                                    id="invoice-date">{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</span>
                                <small class="text-muted"
                                    id="invoice-time">{{ \Carbon\Carbon::parse($order->created_at)->format('h:ia') }}</small>
                            </h5>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold fs-14">Payment Status</p>
                            @if ($order->status == 'paid')
                                <span class="badge bg-success-subtle text-success" id="payment-status">Paid</span>
                            @elseif($order->status == 'unpaid')
                                <span class="badge bg-danger-subtle text-danger" id="payment-status">Unpaid</span>
                            @else
                                <span class="badge bg-primary-subtle text-primary"
                                    id="payment-status">{{ $order->status }}</span>
                            @endif
                        </div>
                        <!--end col-->
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold fs-14">Total Amount</p>
                            <h5 class="fs-15 mb-0">RON <span
                                    id="total-amount">{{ number_format($order->total, 2) }}</span>
                            </h5>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4 border-top border-top-dashed">
                    <div class="row g-3">
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase fw-semibold fs-14 mb-3">Billing Address</h6>
                            <p class="fw-medium mb-2 fs-16" id="billing-name">{{ $order->name ?? $order->user->name }}
                            </p>
                            <p class="text-muted mb-1" id="billing-address-line-1">
                                {{ $order->city ?? $order->user->city }}
                                {{ $order->country ?? ', ' . $order->user->country }}</p>
                            <p class="text-muted mb-1"><span>Phone: +</span><span
                                    id="billing-phone-no">{{ $order->phone ?? $order->user->phone }}</span></p>
                            <p class="text-muted mb-0"><span>Email: </span><span
                                    id="billing-tax-no">{{ $order->email ?? $order->user->email }}</span>
                            </p>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="products-list">
                                @foreach ($orderItems as $item)
                                    <tr>
                                        <th scope="row">#{{ $item->service->id }}</th>
                                        <td class="text-start">{{ $item->service->name }}</td>
                                        <td>RON{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end">RON {{ number_format($item->price * $item->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <div class="border-top border-top-dashed mt-2">
                        <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                            style="width:250px">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td class="text-end">RON <span
                                            id="total-amount">{{ number_format($order->total, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Discount <small class="text-muted"></small></td>
                                    <td class="text-end">- 00.00</td>
                                </tr>
                                <tr class="border-top border-top-dashed fs-15">
                                    <th scope="row">Total Amount</th>
                                    <th class="text-end">RON <span
                                            id="total-amount">{{ number_format($order->total, 2) }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>

                </div>
                <!--end card-body-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>

    <div class="hstack gap-2 justify-content-end d-print-none mt-4">
        <b onclick="printInvoice()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>
            Print</b>
        <a href="javascript:void(0);" onclick="downloadInvoice()" class="btn btn-primary"><i
                class="ri-download-2-line align-bottom me-1"></i>
            Download</a>
    </div>

    <script>
        function printInvoice() {
            const invoice = document.querySelector('#invoice');

            if (invoice) {
                const printWindow = window.open('', '_blank');

                printWindow.document.write(`
            <html>
                <head>
                    <title>Print Invoice</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                    <link rel="stylesheet" href="styles.css">
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                    </style>
                </head>
                <body>${invoice.outerHTML}</body>
            </html>
        `);

                printWindow.document.close();

                // Ensure styles are loaded before printing
                printWindow.onload = function() {
                    printWindow.print();
                    printWindow.close();
                };
            } else {
                console.error('Invoice element not found.');
            }
        }

        function downloadInvoice() {
            // Get the invoice element
            const invoice = document.getElementById("invoice");

            // Options for html2pdf
            const opt = {
                margin: 5,
                filename: 'invoice_' + document.getElementById("invoice-no").textContent + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    scrollY: 0,
                    windowHeight: document.getElementById("invoice").scrollHeight
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait',
                    putOnlyUsedFonts: true
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }
            };

            // Temporarily hide the download button to avoid capturing it
            const downloadBtn = document.querySelector('.d-print-none');
            if (downloadBtn) downloadBtn.style.visibility = 'hidden';

            // Generate PDF from HTML using html2pdf
            html2pdf().set(opt).from(invoice).toPdf().get('pdf').then(function(pdf) {
                // Restore the download button visibility
                if (downloadBtn) downloadBtn.style.visibility = 'visible';
            }).save();
        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</div>
