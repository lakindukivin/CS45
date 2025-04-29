<?php

class CheckoutModel
{
    use Database;

    // Public method to create or

    public function createOrder($customer_id, $deliveryAddress, $billingAddress, $cartItems, $orderDate, $orderStatus, $total)
    {
        try {
            $con = $this->connect();
            $con->beginTransaction();

            foreach ($cartItems as $item) {
                if (!isset($item->product_id) || !isset($item->quantity)) {
                    throw new Exception("Invalid cart item data: " . json_encode($item));
                }

                $pack_id = isset($item->pack_id) ? $item->pack_id : 0; // If not available, use 0
                $bag_id = isset($item->bag_id) ? $item->bag_id : 0;   // If not available, use 0

                $query = "INSERT INTO orders (customer_id, deliveryAddress, billingAddress, orderDate, orderStatus, total, product_id, bag_id, pack_id, quantity) 
                              VALUES (:customer_id, :deliveryAddress, :billingAddress, :orderDate, :orderStatus, :total, :product_id, :bag_id, :pack_id, :quantity)";

                $stmt = $con->prepare($query);

                $stmt->bindParam(':customer_id', $customer_id);
                $stmt->bindParam(':deliveryAddress', $deliveryAddress);
                $stmt->bindParam(':billingAddress', $billingAddress);
                $stmt->bindParam(':orderDate', $orderDate);
                $stmt->bindParam(':orderStatus', $orderStatus);
                $stmt->bindParam(':total', $total); // <-- Use the total passed directly
                $stmt->bindParam(':product_id', $item->product_id);
                $stmt->bindParam(':bag_id', $bag_id);
                $stmt->bindParam(':pack_id', $pack_id);
                $stmt->bindParam(':quantity', $item->quantity);

                $stmt->execute();
            }

            $con->commit();

            return true;
        } catch (PDOException $e) {
            $con->rollBack();
            error_log("PDO Error: " . $e->getMessage());
            throw new Exception("Error during order creation: " . $e->getMessage());
        } catch (Exception $e) {
            $con->rollBack();
            error_log("Exception: " . $e->getMessage());
            throw $e;
        }
    }
}
