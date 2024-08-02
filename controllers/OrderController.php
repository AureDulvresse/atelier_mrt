<?php

require_once 'models/Order.php';
require_once 'models/OrderItem.php';

class OrderController
{
    private $db;
    private $order;
    private $orderItem;

    public function __construct($pdo)
    {
        $this->db = $pdo;
        $this->order = new Order($this->db);
        $this->orderItem = new OrderItem($this->db);
    }

    public function createOrder()
    {
        $customer_id = $_POST['customer_id'];
        $total_amount = $_POST['total_amount'];
        $status = 'pending'; // Initial status

        $this->order->customer_id = $customer_id;
        $this->order->total_amount = $total_amount;
        $this->order->status = $status;

        if ($this->order->create()) {
            $order_id = $this->db->conn->lastInsertId();

            // Add order items
            $items = json_decode($_POST['items'], true);
            foreach ($items as $item) {
                $this->orderItem->order_id = $order_id;
                $this->orderItem->artwork_id = $item['artwork_id'];
                $this->orderItem->quantity = $item['quantity'];
                $this->orderItem->price = $item['price'];
                $this->orderItem->add();
            }

            echo json_encode(['message' => 'Order created successfully', 'order_id' => $order_id]);
        } else {
            echo json_encode(['message' => 'Failed to create order']);
        }
    }

    public function viewOrder()
    {
        $order_id = $_POST['order_id'];
        $orderItems = $this->orderItem->read($order_id);

        $items = [];
        while ($row = $orderItems->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        echo json_encode($items);
    }
}
