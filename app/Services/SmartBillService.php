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
        $this->email = 'office@reshape-clinique.ro';
        $this->apiKey = '002|a9af36cee6222d5b4178132f2104bbaa';
        $this->companyVatCode = 'RO38395650';
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

    public function testConnection4()
    {
        $url = $this->baseUrl . '/status';

        try {
            // $response = $this->client->get($url, [
            //     'headers' => $this->getHeaders(),
            //     'verify' => false, // Temporary for testing
            // ]);

            // return [
            //     'status' => $response->getStatusCode(),
            //     'data' => json_decode($response->getBody()->getContents(), true)
            // ];


            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->email . ':' . $this->apiKey),
            ])->withOptions([
                'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
            ])->get('https://ws.smartbill.ro/SBORO/api/status', []);

            dd($response);
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
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

        try {
            $response = $this->client->post($url, [
                'headers' => $this->getHeaders(),
                'json' => [
                    'companyVatCode' => $this->companyVatCode,
                    'invoice' => $invoiceData
                ],
                'verify' => base_path('/public/storage/cacert.pem')
            ]);

            // dd($response);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // Handle exception
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Get invoice PDF
     */
    public function getInvoicePdf($invoiceSeries, $invoiceNumber)
    {
        $url = $this->baseUrl . '/invoice/pdf';

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getHeaders(),
                'query' => [
                    'companyVatCode' => $this->companyVatCode,
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
