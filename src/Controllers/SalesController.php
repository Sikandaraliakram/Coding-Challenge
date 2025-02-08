<?php

namespace App\Controllers;

use App\Helpers\Twig;
use App\Request\Request;
use App\Services\SalesService;
use Exception;

class SalesController
{
    private SalesService $salesService;

    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
        $this->salesService = new SalesService();
    }

    /**
     * Display the sales index page.
     */
    public function index(): void
    {
        try {
            $data = $this->salesService->getSales();
            $response = Twig::render(
                'index.twig',
                'src/Views/sales',
                ['salesList' => $data]
            );
        } catch (Exception $e) {
            $response = $e->getMessage();
        }
        echo $response;
    }

    /**
     * Filter sales based on request data.
     * This function is for filtering data using from ajax call
     */
    public function filterSales(): void
    {
        try {

            $data = $this->salesService->getSales($this->request->getPost());
            $response = Twig::render(
                'list.twig',
                'src/Views/sales',
                ['salesList' => $data]
            );
        } catch (Exception $e) {
            $response = $e->getMessage();
        }
        echo $response;
    }

    /**
     * Upload sales data from the request.
     * calling this from ajax
     */
    public function uploadSalesData(): void
    {
        try {
            $response = $this->salesService->upload($this->request);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }
        echo $response;
    }


}