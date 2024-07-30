<?php
// Include the connection file
include '../settings/connection.php';


// Function to get a single outstanding balance by ID
function get_names_by_id($t_id) {
    global $conn;

    // Write SELECT query to retrieve transaction_mgt by ID
    $sql = "SELECT * FROM transaction_mgt WHERE t_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $t_id);
        
        // Execute the query
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // Check if any record was returned
            if ($result->num_rows > 0) {
                $names = $result->fetch_assoc();
                return $names;
            } else {
                return null;
            }
        } else {
            // Error executing query
            return null;
        }       
        // Close statement
    } else {
        // Error preparing statement
        return null;
    }
}
?>
