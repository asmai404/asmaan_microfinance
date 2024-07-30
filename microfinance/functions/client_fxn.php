<?php
include '../action/get_all_loanee_names_action.php';
echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';

// Function to display all clients
function display_all_clients() {
    // Call the function to get all chores
    $names = get_all_clients();
    
    // Check if clients are retrieved successfully
    if ($names !== false) {
        // Check if any clients exist
        if (!empty($names)) {
	    // Display table headers with Times New Roman font
            echo "<style>
                    table, th, td {
                        font-family: 'Times New Roman', Times, serif;
			font-size:22px;
                    }
                  </style>";
	    echo "<table>";
	    echo "<tr><th>Client name</th><th>Loan amount</th><th>Interest rate</th><th>Repayment method</th><th>Loan date</th><th>Due date</th><th>Actions</th></tr>";
            // Loop through each chore and display its details
            foreach ($names as $name) {
                echo "<tr>";
	        // Display the following details about the clients 
                echo "<td style='width: 16%;'>" . $name['client_name'] . "</td>";

	        echo "<td style='width: 16%;'>" . $name['amount_loaned_to'] . "</td>";

                echo "<td style='width: 14%;'>" . $name['interest_rate'] . "</td>";

	        echo "<td style='width: 18%;'>" . $name['repayment_method'] . "</td>";

		echo "<td style='width: 14.5%;'>" . $name['date_granted_loan'] . "</td>";

		echo "<td style='width: 14.5%;'>" . $name['due_date'] . "</td>";

		// Add edit and delete icons or links here
                echo "<td style='width: 7%; border: 4px solid #dddddd; text-align: center; vertical-align: middle;'>";
                echo "<a href='../admin/edit_amount_dashboard.php?c_id=" . $name['c_id'] . "' class='edit-link' style='color:#00cc00;'><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;";
                echo "<a href='../action/delete_client_loan_action.php?c_id=" . $name['c_id'] . "' class='edit-link' style='color:red;'><i class='fas fa-trash-alt' title='Delete'></i></a>"; 
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {

            echo "<tr><td colspan='7' style='color: red; text-align: center; width: 100%; font-family:Times New Roman, san-serif; font-size:22px;'><strong>Empty log</strong></td></tr>";
        }
    } else {
        // Error retrieving clients
        echo "Error retrieving clients.";
    }
}
?>

                
