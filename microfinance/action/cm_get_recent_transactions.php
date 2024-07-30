<?php
// Function to get all loanees
function get_recent_transaction() {
    global $conn;
    
    // Write the SELECT query to get all transactions
    $sql = "SELECT * FROM transaction_mgt WHERE amount_repaid IS NOT NULL AND transaction_date IS NOT NULL ORDER BY t_id DESC LIMIT 5";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if execution worked
    if ($result) {
        // Check if any record was returned
        if ($result->num_rows > 0) {
            // Fetch records and store them in an array
            $names = array();
            while ($row = $result->fetch_assoc()) {
                $names[] = $row;
            }
            return $names;
        } else {
            return array();
        }
    } else {
        // Return false if query execution failed
        return false;
    }
}

?>