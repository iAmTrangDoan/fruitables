<?php

if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}

class ProductModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //  Lấy sản phẩm có phân trang
    //  $limit Số sản phẩm trên mỗi trang (mặc định 6)
    //  $page Trang hiện tại (mặc định 1)

    public function getProducts($limit = 6, $page = 1, $categoryId = null)
    {
        try {

            $offset = ($page - 1) * $limit;

            $sql = "SELECT * FROM products";
            $whereClause = "";
            $paramIndex = 1;

            if ($categoryId !== null) {
                $whereClause .= " WHERE category_id = ?";
            }

            $sql .= $whereClause;
            $sql .= " ORDER BY id LIMIT ? OFFSET ?";

            $stmt = $this->pdo->prepare($sql);

            // Tham số lọc theo category
            if ($categoryId !== null) {
                $stmt->bindParam($paramIndex++, $categoryId, PDO::PARAM_INT);
            }

            // tham số phân trang
            $stmt->bindParam($paramIndex++, $limit, PDO::PARAM_INT);
            $stmt->bindParam($paramIndex, $offset, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi lấy danh sách sản phẩm " . $e->getMessage());
        }
    }

    public function getProductsByCategory($categoryId)
    {
        try {
            $sql = "SELECT * FROM products WHERE category_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi lấy sản phẩm theo danh mục ID: " . $categoryId . " " . $e->getMessage());
        }
    }

    // Hàm đếm tổng số sản phẩm (cần cho việc tính toán số trang)
    public function countAllProducts($categoryId = null)
    {
        try {
            $sql = "SELECT COUNT(*) FROM products";

            //Đếm sản phẩm theo danh mục để hiển thị phân trang
            $params = [];
            if ($categoryId !== null) {
                $sql .= " WHERE category_id = ?";
                $params[] = $categoryId;
            }
            $stmt = $this->pdo->prepare($sql);
            if ($categoryId !== null) {
                $stmt->bindParam(1, $categoryId, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function getProductsForAdmin()
    {
        try {
            $sql = "SELECT p.*, c.name AS category_name 
                        FROM products p
                        JOIN categories c ON p.category_id = c.id
                        ORDER BY p.id ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi lấy danh sách sản phẩm quản trị: " . $e->getMessage());
        }
    }

    public function insert($data)
    {
        try {
            $sql = "INSERT INTO products
                    (name, description, price, stock_quantity, image_url, category_id)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $data['name'],
                $data['description'],
                $data['price'],
                $data['stock_quantity'],
                $data['image_url'],
                $data['category_id']
            ]);
        } catch (PDOException $e) {
            throw new Exception("Lỗi thêm sản phẩm: " . $e->getMessage());
        }
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $data)
    {
        try {
            $sql = "UPDATE products SET
                        name = ?,
                        description = ?,
                        price = ?,
                        stock_quantity = ?,
                        image_url = ?,
                        category_id = ?
                    WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $data['name'],
                $data['description'],
                $data['price'],
                $data['stock_quantity'],
                $data['image_url'],
                $data['category_id'],
                $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Lỗi cập nhật sản phẩm: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Lỗi xóa sản phẩm: " . $e->getMessage());
        }
    }
}
