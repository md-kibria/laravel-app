<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmartBillService;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    protected $smartBill;

    public function __construct(SmartBillService $smartBill)
    {
        $this->smartBill = $smartBill;
    }

    public function createInvoice(Request $request)
    {
        // $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Basic ' . base64_encode(env('SMARTBILL_API_EMAIL') . ':' . env('SMARTBILL_API_TOKEN')),
        //     'Content-Type' => 'application/json'
        // ])->withOptions([
        //     'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        // ])->post('https://ws.smartbill.ro/SBORO/api/invoice', [
        //     "companyVatCode" => "RO38395650",
        //     "seriesName" => "RCON",
        //     "client" => [
        //         "name" => "SC Company SA",
        //         "vatCode" => "RO12345678",
        //         "isTaxPayer" => true,
        //         "address" => "Str. Iasomiei nr 2",
        //         "city" => "Cluj-Napoca",
        //         "county" => "Cluj-Napoca",
        //         "country" => "Romania",
        //         "email" => "emailclient@domain.ro",
        //         "saveToDb" => true
        //     ],
        //     "issueDate" => "2023-07-27",
        //     "products" => [
        //         [
        //             "code" => "10",
        //             "name" => "Produs 1",
        //             "measuringUnitName" => "buc",
        //             "currency" => "RON",
        //             "quantity" => 1,
        //             "price" => 10,
        //             "isTaxIncluded" => true,
        //             "taxPercentage" => 19,
        //             "saveToDb" => false
        //         ]
        //     ]
        // ]);

        // dd($response);
        
        $invoiceData = [
            'client' => [
                // 'name' => $request->client_name,
                // 'vatCode' => $request->client_vat_code ?? '',
                // 'address' => $request->client_address,
                // 'email' => $request->client_email
                // other client details
                // 'name' => 'Mr Dev',
                // 'vatCode' => '',
                // 'address' => 'Dhaka, BD',
                // 'email' => 'mrdev774@gmail.com'

                "name" => "SC Company SA",
                "vatCode" => "RO12345678",
                "isTaxPayer" => true,
                "address" => "Str. Iasomiei nr 2",
                "city" => "Cluj-Napoca",
                "county" => "Cluj-Napoca",
                "country" => "Romania",
                "email" => "emailclient@domain.ro",
                "saveToDb" => true
            ],
            // 'issueDate' => now()->format('Y-m-d'),
            // 'dueDate' => now()->addDays(30)->format('Y-m-d'),
            'products' => [
                [
                    // 'name' => 'Product 1',
                    // 'code' => 'PROD1',
                    // 'quantity' => 1,
                    // 'price' => 10,
                    // 'isTaxIncluded' => false,
                    // 'taxPercentage' => 0,
                    // other product details
                    "code" => "10",
                    "name" => "Produs 1",
                    "measuringUnitName" => "buc",
                    "currency" => "RON",
                    "quantity" => 1,
                    "price" => 10,
                    "isTaxIncluded" => true,
                    "taxPercentage" => 19,
                    "saveToDb" => false
                ]
            ],
            // other invoice details
        ];
// dd($this->smartBill->createInvoice([]));
        $result = $this->smartBill->createInvoice($invoiceData);

        dd($result);

        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }


        return redirect()->route('invoice.show', [
            'series' => $result['series'],
            'number' => $result['number']
        ]);
    }

    public function getInvoice($id) {
        $invoice = $this->smartBill->getInvoicePdf('RCON', $id);

        if (isset($invoice['error'])) {
            return back()->with('error', $invoice['error']);
        }

        dd($invoice);
        return view('invoice.show', compact('invoice'));
    }

    public function test()
    {
        // $result = $this->smartBill->testConnection4();
        // dd($result);

        // $response = Http::withHeaders([
        //     'Authorization' => '',
        //     'Content-Type' => 'application/json'
        // ])->withOptions([
        //     'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        // ])->get('https://jsonplaceholder.typicode.com/users',[]);

        // dd($response->json());


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(env('SMARTBILL_API_EMAIL') . ':' . env('SMARTBILL_API_TOKEN')),
            'Content-Type' => 'application/json'
        ])->withOptions([
            'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        ])->post('https://ws.smartbill.ro/SBORO/api/invoice', [
            "companyVatCode" => "RO38395650",
            "seriesName" => "RCON",
            "client" => [
                "name" => "SC Company SA",
                "vatCode" => "RO12345678",
                "isTaxPayer" => true,
                "address" => "Str. Iasomiei nr 2",
                "city" => "Cluj-Napoca",
                "county" => "Cluj-Napoca",
                "country" => "Romania",
                "email" => "emailclient@domain.ro",
                "saveToDb" => true
            ],
            "issueDate" => "2023-07-27",
            "products" => [
                [
                    "code" => "10",
                    "name" => "Produs 1",
                    "measuringUnitName" => "buc",
                    "currency" => "RON",
                    "quantity" => 1,
                    "price" => 10,
                    "isTaxIncluded" => true,
                    "taxPercentage" => 19,
                    "saveToDb" => false
                ]
            ]
        ]);

        if ($response->successful()) {
            $result = json_decode($response->json());
            dd($result['number']);
            return $response->json(); // The invoice details
        } else {
            return $response->body(); // Error message
        }
    }

    public function showInvoice($series, $number)
    {
        $pdf = $this->smartBill->getInvoicePdf($series, $number);

        if (!$pdf) {
            abort(404, 'Invoice not found');
        }

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice_' . $series . '_' . $number . '.pdf"');
    }
}
