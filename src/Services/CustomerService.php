<?php
namespace App\Services;

use App\Repository\Repository;

class CustomerService
{
    private Repository $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function createCustomer(array $data): array
    {
        $result = ['error' => true, 'message' => ""];
        try {
            $lastInsertId = $this->repository->createCustomer($data);
            $result = ['error' => false, 'data' => $lastInsertId];
        } catch (\Exception $exception) {
            $result['message'] = sprintf("Error occurred: %s", $exception->getMessage());
        }

        return $result;
    }
}