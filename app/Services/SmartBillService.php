<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class SmartBillService
{
    protected $client;
    protected $email;
    protected $apiKey;
    protected $companyVatCode;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'http_errors' => true,
        ]);
        $this->email = env('SMARTBILL_API_EMAIL');
        $this->apiKey = env('SMARTBILL_API_TOKEN');
        $this->companyVatCode = env('SMARTBILL_COMPANY_VAT');
        $this->baseUrl = 'https://ws.smartbill.ro/SBORO/api';
    }

    protected function validateConfiguration()
    {
        if (empty($this->apiKey) || empty($this->companyVatCode)) {
            throw new \RuntimeException('SmartBill API configuration is incomplete');
        }

        if (!str_starts_with($this->baseUrl, 'https://')) {
            throw new \RuntimeException('SmartBill API endpoint must use HTTPS');
        }
    }

    protected function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->email . ':' . $this->apiKey),
        ];
    }



    protected function handleException(GuzzleException $e)
    {
        $response = [
            'error' => $e->getMessage(),
            'code' => $e->getCode(),
        ];

        if ($e->hasResponse()) {
            $response['details'] = $e->getResponse()->getBody()->getContents();
        }

        return $response;
    }

    /**
     * Create an invoice
     */
    public function createInvoice(array $invoiceData)
    {
        $url = $this->baseUrl . '/invoice';

        // try {
        // $response = $this->client->post($url, [
        //     'headers' => $this->getHeaders(),
        //     'json' => [
        //         'companyVatCode' => $this->companyVatCode,
        //         'invoice' => $invoiceData
        //     ],
        //     'verify' => base_path('/public/storage/cacert.pem')
        // ]);
        
        // dd([
        //     "companyVatCode" => $this->companyVatCode,
        //     "seriesName" => "RCON",
        //     "client" => $invoiceData['client'],
        //     "issueDate" => now()->format('Y-m-d'),
        //     "products" => $invoiceData['products'],
        // ]);

        
        // $response = Http::withHeaders($this->getHeaders())->withOptions([
        //     'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        // ])->post($url, [
        //     "companyVatCode" => $this->companyVatCode,
        //     "seriesName" => "RCON",
        //     "client" => $invoiceData['client'],
        //     "issueDate" => now()->format('Y-m-d'),
        //     "products" => $invoiceData['products'],
        // ]);

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

        dd($response);

        dd(json_decode($response->getBody()->getContents(), true));
        return json_decode($response->getBody()->getContents(), true);
        // } catch (GuzzleException $e) {
        //     // Handle exception
        //     return ['error' => $e->getMessage()];
        // }
    }

    /**
     * Get invoice PDF
     */
    public function getInvoicePdf($invoiceSeries, $invoiceNumber)
    {
        $url = $this->baseUrl . '/invoice/pdf';

        try {
            $response = $this->client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/octet-stream',
                    'Authorization' => 'Basic ' . base64_encode($this->email . ':' . $this->apiKey),
                ],
                'query' => [
                    'cif' => $this->companyVatCode,
                    'seriesName' => $invoiceSeries,
                    'number' => $invoiceNumber
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            // Handle exception
            return ['error' => $e->getMessage()];
        }
    }

    // Add more methods for other SmartBill API endpoints as needed


    public function testConnection()
    {
        $url = $this->baseUrl . '/status';
        // dd($this->getHeaders());
        // dd(base64_decode('b2ZmaWNlQHJlc2hhcGUtY2xpbmlxdWUucm86MDAyfGE5YWYzNmNlZTYyMjJkNWI0MTc4MTMyZjIxMDRiYmFh'));
        // dd(base_path('\public\storage\cacert.pem'));
        try {
            $response = $this->client->get($url, [
                'headers' => $this->getHeaders(),
                'verify' => base_path('/public/storage/cacert.pem')
            ]);

            dd($response);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            dd($e);
            logger()->error('SmartBill Connection Test Failed: ' . $e->getMessage());
            return ['error' => 'Connection test failed'];
        }
    }



    public function testConnection2()
    {
        try {
            $response = $this->client->get($this->baseUrl . '/status', [
                'headers' => $this->getHeaders(),
                'verify' => base_path('public/storage/cacert.pem'), // Ensure this path is correct
                'debug' => fopen(storage_path('logs/smartbill_debug_' . date('Y-m-d') . '.log'), 'a'),
                'timeout' => 15,
                'connect_timeout' => 5,
                'allow_redirects' => false, // Disable redirects for debugging
                'http_errors' => false // Don't throw exceptions on HTTP errors
            ]);

            // Verify response status
            if ($response->getStatusCode() !== 200) {
                throw new \Exception("Unexpected status code: " . $response->getStatusCode());
            }

            // Verify content type
            $contentType = $response->getHeaderLine('Content-Type');
            if (strpos($contentType, 'application/json') === false) {
                throw new \Exception("Unexpected Content-Type: " . $contentType);
            }

            $body = json_decode($response->getBody(), true);

            // Verify response structure
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON response");
            }

            return $body;

            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody(), true)
            ];
        } catch (GuzzleException $e) {
            $this->logError($e);
            throw new \RuntimeException('SmartBill connection test failed: ' . $e->getMessage());
        }
    }

    protected function logError(GuzzleException $e)
    {
        Log::error('SmartBill API Error', [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            'trace' => $e->getTraceAsString()
        ]);
    }


    public function testConnection3()
    {
        $url = $this->baseUrl . '/status'; // Endpoint as shown in docs

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getHeaders(),
                'verify' => false, // Temporary for testing
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null
            ];
        }
    }
}
