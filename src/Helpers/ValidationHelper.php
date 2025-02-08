<?php

namespace App\Helpers;

class ValidationHelper
{
    /**
     * Validate JSON keys.
     *
     * @param array $data The data to validate.
     * @param array $keys The required keys.
     * @return bool True if all keys are valid, false otherwise.
     */
    public static function validateJsonKeys(array $data, array $keys): bool
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $keys)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validate JSON values.
     *
     * @param array $data The data to validate.
     * @return bool True if all values are valid, false otherwise.
     */
    public static function validateJsonValues(array $data): bool
    {
        $validators = [
            'sale_id' => fn($value) => is_string($value) && !empty($value),
            'customer_name' => fn($value) => is_string($value) && !empty($value),
            'customer_mail' => fn($value) => is_string($value) && !empty($value) && filter_var($value, FILTER_VALIDATE_EMAIL),
            'product_id' => fn($value) => is_int($value) && $value > 0,
            'product_name' => fn($value) => is_string($value) && !empty($value),
            'product_price' => fn($value) => is_numeric($value) && $value > 0,
            'sale_date' => fn($value) => is_string($value) && !empty($value) && self::validateDate($value),
            'version' => fn($value) => is_string($value) && !empty($value),
        ];

        foreach ($validators as $key => $validator) {
            if (!isset($data[$key]) || !$validator($data[$key])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate date format.
     *
     * @param string $date The date string to validate.
     * @return bool True if the date is valid, false otherwise.
     */
    private static function validateDate(string $date): bool
    {
        return (strtotime($date) !== false);
    }
}