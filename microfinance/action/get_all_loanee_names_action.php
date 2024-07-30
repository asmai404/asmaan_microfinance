<?php
// Include the connection file
include '../settings/connection.php';

// Function to get all loanees
function get_all_names() {
    global $conn;
    
    // Write the SELECT query to get all loaness
    $sql = "SELECT * FROM loan_application WHERE rid = 3";
    
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

// Function to get all messages
function get_all_messages() {
    global $conn;
    
    // Write the SELECT query to get all messages
    $sql = "SELECT * FROM contact_us";
    
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



// Function to get all clients
function get_all_clients() {
    global $conn;
    
    // Write the SELECT query to get all clients
    $sql = "SELECT * FROM clients";
    
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


// Function to get the full name from la_id
function get_full_name_from_la_id($la_id) {
    global $conn; 

    // SQL query to retrieve the full name based on la_id
    $query = "SELECT CONCAT(fname, ' ', lname) AS full_name FROM loan_application WHERE la_id = ?";
    
    // Prepare the query
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    // Bind the parameter
    $stmt->bind_param("i", $la_id);

    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($full_name);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    return $full_name;
}

// Function to get the email from la_id
function get_email_from_la_id($la_id) {
    global $conn; 

    // SQL query to retrieve the email based on la_id
    $query = "SELECT email FROM loan_application WHERE la_id = ?";

    // Prepare the query
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    // Bind the parameter
    $stmt->bind_param("i", $la_id);

    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($email);

    // Fetch the result
    if ($stmt->fetch()) {
        // Close the statement
        $stmt->close();
        return $email;
    } else {
        // Close the statement
        $stmt->close();
        return false; // or return null to indicate no result found
    }
}


// Function to retrieve all loan applicant
function get_standard_users() {
    global $conn;

    // Initialize an empty array to store standard users
    $standardUsers = array();

    // Write the SELECT query to fetch standard users
    $query = "SELECT la_id, fname, lname, email FROM loan_application WHERE rid = 3"; 
    
    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Add each standard user to the array
                $standardUsers[] = $row;
            }
        }

        // Free result set
        mysqli_free_result($result);
    }

    // Return the array of standard users
    return $standardUsers;
}


// Function to get all loanees
function get_all_transactions() {
    global $conn;
    
    // Write the SELECT query to get all transactions
    $sql = "SELECT * FROM transaction_mgt WHERE amount_repaid IS NOT NULL AND transaction_date IS NOT NULL";
    
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

// Function to get all loanees
function get_recent_transactions() {
    global $conn;
    
    // Write the SELECT query to get all transactions
    $sql = "SELECT * FROM transaction_mgt WHERE amount_repaid IS NOT NULL AND transaction_date IS NOT NULL ORDER BY t_id DESC LIMIT 5 ";
    
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




// Function to retrieve loan_applicants
function get_loan_applicants() {
    global $conn;

    // Initialize an empty array to store loan applicants
    $loan_applicants = array();

    // Write the SELECT query to fetch loan applicants
    $query = "SELECT * FROM loan_application WHERE rid = 3";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Add each loan applicant to the array
                $loan_applicants[] = $row;
            }
        }

        // Free result set
        mysqli_free_result($result);
    }

    // Return the loan applicants array
    return $loan_applicants;
}

// Function to retrieve female clients
function get_female_clients() {
    global $conn;

    $female_clients = array();
    $query = "SELECT * FROM loan_application WHERE rid = 4 AND gender = 'female'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $female_clients[] = $row;
            }
        }
        mysqli_free_result($result);
    }
    return $female_clients;
}

// Function to retrieve male clients
function get_male_clients() {
    global $conn;

    $male_clients = array();
    $query = "SELECT * FROM loan_application WHERE rid = 4 AND gender = 'male'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $male_clients[] = $row;
            }
        }
        mysqli_free_result($result);
    }
    return $male_clients;
}

// Function to retrieve clients
function get_clients() {
    global $conn;

    $clients = array();
    $query = "SELECT * FROM clients";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $clients[] = $row;
            }
        }
        mysqli_free_result($result);
    }
    return $clients;
}

// Function to retrieve transactions
function get_transactions() {
    global $conn;

    $transactions = array();
    $query = "SELECT * FROM transaction_mgt WHERE amount_repaid IS NOT NULL AND transaction_date IS NOT NULL";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $transactions[] = $row;
            }
        }
        mysqli_free_result($result);
    }
    return $transactions;
}

// Function to retrieve all loan amounts
function get_loan_amounts() {
    global $conn;

    $amounts = array();
    $query = "SELECT principal_amount FROM transaction_mgt";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any records were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch rows from the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $amounts[] = $row['principal_amount'];
            }
        }
        mysqli_free_result($result);
    }
    return $amounts;
}



?>
