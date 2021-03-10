<?php
include_once 'connections.php';

class review
{
    public function add_review($customer_username, $description, $rate, $order_id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $review_added = $conn->prepare("INSERT INTO `reviews`(`customer_username`, `description`, `rate`, `order_id`) VALUES (?,?,?,?)");
        $review_added->bind_param('isisi', $customer_username, $description, $rate, $order_id);
        if ($review_added->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_rev_by_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_review = $conn->prepare("DELETE FROM `reviews` WHERE review_id = ?  ;");
        $deleted_review->bind_Param('i', $id);
        if ($deleted_review->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function retrive_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `reviews` ;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }
}
