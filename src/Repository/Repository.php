<?php

namespace App\Repository;

use App\Database\Database;
use App\Helpers\ValidationHelper;
use PDO;

class Repository
{
    /** @var Database db */
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getSalesListByFilter(?array $filter = []): array
    {
        $sql = "
                SELECT 
                    p.product_name AS productName, 
                    c.customer_name as customerName, 
                    c.customer_mail as customerMail, 
                    p.product_price as productPrice, 
                    s.sale_date as saleDate, 
                    s.version 
                    FROM sales s 
                    INNER JOIN products p ON p.product_id = s.product_id 
                    INNER JOIN customers c ON c.customer_id = s.customer_id";

        $conditions = [];
        $execute = [];

        if (!empty($filter['customer_name'])) {
            $conditions[] = "c.customer_name = ?";
            $execute[] = trim($filter['customer_name']);
        }

        if (!empty($filter['product_name'])) {
            $conditions[] = "p.product_name = ?";
            $execute[] = trim($filter['product_name']);
        }

        if (!empty($filter['product_price'])) {
            $conditions[] = "p.product_price = ?";
            $execute[] = trim($filter['product_price']);
        }

        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $statement = $this->db->getConnection()->prepare($sql);
        $statement->execute($execute);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCustomer(array $data): string
    {
        $sql = "INSERT INTO customers (customer_name, customer_mail) VALUES (:customer_name, :customer_mail)";
        $statement = $this->db->getConnection()->prepare($sql);
        $statement->execute([
            'customer_name' => trim($data['customer_name']),
            'customer_mail' => trim($data['customer_mail'])
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function createProduct(array $data): string
    {
        $sql = "INSERT INTO products (product_name, product_price) VALUES (:product_name, :product_price)";
        $statement = $this->db->getConnection()->prepare($sql);
        $statement->execute([
            'product_name' => trim(addslashes($data['product_name'])),
            'product_price' => $data['product_price']
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function createSale(array $data): string
    {
        $sql = "INSERT INTO sales (customer_id, product_id, sale_date, version) VALUES (:customer_id, :product_id, :sale_date, :version)";
        $statement = $this->db->getConnection()->prepare($sql);
        $statement->execute([
            'customer_id' => $data['customer_id'],
            'product_id' => $data['product_id'],
            'sale_date' => $data['sale_date'],
            'version' => $data['version']
        ]);
        return $this->db->getConnection()->lastInsertId();
    }
}
