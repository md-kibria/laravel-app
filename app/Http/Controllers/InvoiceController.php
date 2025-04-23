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
        $invoiceData = [
            'client' => [
                // 'name' => $request->client_name,
                // 'vatCode' => $request->client_vat_code ?? '',
                // 'address' => $request->client_address,
                // 'email' => $request->client_email
                // other client details
                'name' => 'Mr Dev',
                'vatCode' => '',
                'address' => 'Dhaka, BD',
                'email' => 'mrdev774@gmail.com'
            ],
            'issueDate' => now()->format('Y-m-d'),
            'dueDate' => now()->addDays(30)->format('Y-m-d'),
            'products' => [
                [
                    'name' => 'Product 1',
                    'code' => 'PROD1',
                    'quantity' => 1,
                    'price' => 100,
                    'isTaxIncluded' => false,
                    'taxPercentage' => 0,
                    // other product details
                ]
            ],
            // other invoice details
        ];

        $result = $this->smartBill->createInvoice($invoiceData);

        // dd($result);

        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }


        return redirect()->route('invoice.show', [
            'series' => $result['series'],
            'number' => $result['number']
        ]);
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



        // return base64_encode('office@reshape-clinique.ro:002|a9af36cee6222d5b4178132f2104bbaa');
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('office@reshape-clinique.ro:002|a9af36cee6222d5b4178132f2104bbaa'),
        ])->withOptions([
            'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        ])->post('https://ws.smartbill.ro/SBORestApi/api/invoice', [
            'companyVatCode' => 'RO38395650',
            'seriesName' => 'FCT', // invoice series
            'client' => [
                'name' => 'Client Name',
                'vatCode' => 'RO38395650',
                'country' => 'Romania',
                'city' => 'Bucharest',
                'county' => 'Bucharest',
                'address' => 'Strada Exemplu, Nr. 1',
            ],
            'products' => [
                [
                    'name' => 'Product 1',
                    'code' => 'P001',
                    'currency' => 'RON',
                    'measuringUnitName' => 'buc',
                    'isTaxIncluded' => true,
                    'price' => 100,
                    'quantity' => 1,
                ]
            ],
            'issueDate' => now()->toDateString(),
            'dueDate' => now()->addDays(7)->toDateString(),
            'email' => 'client@example.com',
        ]);

        if ($response->successful()) {
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
