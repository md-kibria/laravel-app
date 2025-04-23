<?php

namespace App\Services;

use GuzzleHttp\Client;
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

    protected function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->email . ':' . $this->apiKey),
        ];
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
}
