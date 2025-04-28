<?php

class CheckoutModel
{
    use Database;

    // Public method to create order
    public function createOrder($customer_id, $deliveryAddress, $billingAddress, $cartItems, $orderDate, $orderStatus, $total)
    {
        try {
            // Start a transaction to ensure both orders and order_items are inserted correctly
            $con = $this->connect();
            $con->beginTransaction();

            // Insert into orders table
            $query = "INSERT INTO orders (customer_id, delivery_address, billing_address, order_date, order_status, total_amount) 
                  VALUES (:customer_id, :deliveryAddress, :billingAddress, :orderDate, :orderStatus, :total)";

            $stmt = $con->prepare($query);
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':deliveryAddress', $deliveryAddress);
            $stmt->bindParam(':billingAddress', $billingAddress);
            $stmt->bindParam(':orderDate', $orderDate);
            $stmt->bindParam(':orderStatus', $orderStatus);
            $stmt->bindParam(':total', $total);

            $stmt->execute();

            // Get the last inserted order ID
            $order_id = $con->lastInsertId();

            // Check if the order_id is valid
            if (!$order_id) {
                throw new Exception("Failed to retrieve the order ID after inserting into orders.");
            }

            // Check if $cartItems is an array and has data
            if (!is_array($cartItems) || count($cartItems) === 0) {
                throw new Exception("Invalid cart items data.");
            }

            // Insert into order_items table
            foreach ($cartItems as $item) {
                // Ensure item contains the necessary properties (product_id, quantity, price)
                if (!isset($item->product_id) || !isset($item->quantity) || !isset($item->price)) {
                    throw new Exception("Invalid cart item data: " . json_encode($item));
                }

                // Calculate the subtotal for the item (price * quantity)
                $subtotal = $item->price * $item->quantity;

                // Assuming pack_id and bag_id are optional and can be NULL if not provided
                $pack_id = isset($item->pack_id) ? $item->pack_id : null;
                $bag_id = isset($item->bag_id) ? $item->bag_id : null;

                // Insert into order_items table
                $query = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal, pack_id, bag_id) 
                      VALUES (:order_id, :product_id, :quantity, :price, :subtotal, :pack_id, :bag_id)";

                $stmt = $con->prepare($query);
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':product_id', $item->product_id);
                $stmt->bindParam(':quantity', $item->quantity);
                $stmt->bindParam(':price', $item->price);
                $stmt->bindParam(':subtotal', $subtotal);
                $stmt->bindParam(':pack_id', $pack_id);
                $stmt->bindParam(':bag_id', $bag_id);

                $stmt->execute();

                // Check if there was any issue inserting the item
                if ($stmt->rowCount() == 0) {
                    throw new Exception("Failed to insert item with product ID: " . $item->product_id);
                }
            }

            // Commit the transaction if everything is successful
            $con->commit();

            // Return the order ID
            return $order_id;
        } catch (PDOException $e) {
            // Rollback the transaction if something goes wrong
            $con->rollBack();

            // Log the error for debugging
            error_log("PDO Error: " . $e->getMessage());

            // Throw the exception to propagate the error
            throw new Exception("Error during order creation: " . $e->getMessage());
        } catch (Exception $e) {
            // Log any non-PDO exceptions
            error_log("Exception: " . $e->getMessage());

            // Rollback the transaction
            $con->rollBack();

            // Rethrow the exception
            throw $e;
        }
    }
}
