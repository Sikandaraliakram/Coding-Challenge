<?php

namespace App\Services;

use App\Repository\Repository;

class ProductService
{
    private Repository $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function createProduct(array $data): array
    {
        $result = ['error' => true, 'message' => ""];

        try {
            $lastInsertId = $this->repository->createProduct($data);
            $result = ['error' => false, 'data' => $lastInsertId];
        } catch (\Exception $exception) {
            $result['message'] = sprintf("Error occurred: %s", $exception->getMessage());
        }

        return $result;
    }
}