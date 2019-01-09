<?php

class ProductModel
{
    public function addProduct($productName, $categoryId, $ownerId, $description) {
        global $db;

        try {
            $query = "INSERT INTO products (product_name, category_id, owner_id, description)
                      VALUES (:productName, :categoryId, :ownerId, :description)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->bindParam(':ownerId', $ownerId);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAllProducts($limit = null, $offset = 0) {
        global $db;

        try {
            $query = "SELECT products.id, product_name, owner_id, role_id, username, category, groups.id AS group_id, group_name FROM products
                      LEFT JOIN users ON users.id = products.owner_id
                      LEFT JOIN categories ON categories.id = products.category_id
                      LEFT JOIN users_groups on users_groups.user_id = users.id
                      LEFT JOIN groups ON groups.id = users_groups.group_id";
            if (is_integer($limit)) {
                $stmt = $db->prepare(
                    $query
                    . " LIMIT ? OFFSET ?"
                );
                $stmt->bindParam(1, $limit, PDO::PARAM_INT);
                $stmt->bindParam(2, $offset, PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare($query);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findProductById($productId) {
        global $db;

        try {
            $query = "SELECT products.id, product_name, category_id, owner_id, description, groups.id AS group_id FROM products
                      LEFT JOIN users_groups on users_groups.user_id = owner_id
                      LEFT JOIN groups ON groups.id = users_groups.group_id
                      WHERE products.id = :productId";
            $stmt =  $db->prepare($query);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function editProduct($productId, $productName, $categoryId, $description) {
        global $db;

        try {
            $query = "UPDATE products SET product_name = :productName, category_id = :categoryId, description = :description
                      WHERE id = :productId";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':productId', $productId);
            return $stmt->execute();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function removeProduct($productId) {
        global $db;

        try {
            $query = "DELETE FROM products WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $productId);
            return $stmt->execute();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getProductCount($categoryId = null) {
        global $db;

        try {
            $query = "SELECT COUNT(id) FROM products";
            if (!empty($categoryId)) {
                $stmt = $db->prepare(
                    $query
                    . " WHERE category_id = ?"
                );
                $stmt->bindParam(1, $categoryId, PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare($query);
            }
            $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        }

        return $stmt->fetchColumn(0);
    }
}