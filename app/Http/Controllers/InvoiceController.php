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

    public function test() {
        $result = $this->smartBill->testConnection4();
        dd($result);

        // $response = Http::withHeaders([
        //     'Authorization' => '',
        //     'Content-Type' => 'application/json'
        // ])->withOptions([
        //     'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        // ])->get('https://jsonplaceholder.typicode.com/users',[]);

        // dd($response->json());
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
