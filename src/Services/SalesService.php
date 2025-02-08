<?php

namespace App\Services;

use App\Database\Database;
use App\Helpers\Constant;
use App\Helpers\ValidationHelper;
use App\Helpers\VersionComparisonHelper;
use App\Repository\Repository;
use App\Request\Request;
use Exception;

class SalesService
{
    private Database $db;
    private Repository $repository;
    private CustomerService $customerService;
    private ProductService $productService;



    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->repository = new Repository();
        $this->customerService = new CustomerService();
        $this->productService = new ProductService();
    }

    public function getSales(?array $filterData = []): array
    {
        try {
            $response =  $this->repository->getSalesListByFilter($filterData);
            foreach ($response as $key => $value){
                $response[$key]['timezone'] = VersionComparisonHelper::compareVersion($value['version']);
            }
            return $response;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function upload(Request $request): string
    {
        try {
            $fileData = $request->getUploadedFileContent('importfile');

            if (empty($fileData)) {
                return $this->jsonResponse('error', 'No file data found!');
            }

            $this->db->getConnection()->beginTransaction();

            foreach ($fileData as $value) {
                $this->processSaleData($value);
            }

            $this->db->getConnection()->commit();

            return $this->jsonResponse('success', 'sales uploaded successfully!');
        } catch (\Exception $e) {
            $this->db->getConnection()->rollback();
            return $this->jsonResponse('error', $e->getMessage());
        }
    }

    /**
     * Processes a single sale entry from the uploaded file.
     */
    private function processSaleData(array $value): void
    {
        if (!$this->isValidJsonData($value)) {
            throw new \Exception('Invalid JSON Data!');
        }

        $customerResponse = $this->customerService->createCustomer($value);
        $productResponse = $this->productService->createProduct($value);

        if ($customerResponse['error'] || $productResponse['error']) {
            throw new \Exception('Error creating customer or product.');
        }

        $this->repository->createSale([
            'customer_id' => $customerResponse['data'],
            'product_id' => $productResponse['data'],
            'sale_date' => $value['sale_date'],
            'version' => $value['version']
        ]);
    }

    /**
     * Validates JSON structure and values.
     */
    private function isValidJsonData(array $value): bool
    {
        return ValidationHelper::validateJsonKeys($value, Constant::SALES_KEYS) &&
            ValidationHelper::validateJsonValues($value);
    }

    /**
     * Returns a JSON response string.
     */
    private function jsonResponse(string $status, string $message): string
    {
        return json_encode(['status' => $status, 'msg' => $message]);
    }
    
}