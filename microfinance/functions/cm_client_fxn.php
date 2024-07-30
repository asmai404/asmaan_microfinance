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
	    echo "<tr><th>Client name</th><th>Client email</th><th>Loan amount</th><th>Interest rate</th><th>Repayment method</th><th>Loan date</th><th>Due date</th></tr>";
            // Loop through each chore and display its details
            foreach ($names as $name) {
                echo "<tr>";
	        // Display the following details about the clients 
                echo "<td style='width: 14.3%;'>" . $name['client_name'] . "</td>";

		echo "<td style='width: 14.3%;'>" . $name['email'] . "</td>";

	        echo "<td style='width: 14.3%;'>" . $name['amount_loaned_to'] . "</td>";

                echo "<td style='width: 14.2%;'>" . $name['interest_rate'] . "</td>";

	        echo "<td style='width: 14.3%;'>" . $name['repayment_method'] . "</td>";

		echo "<td style='width: 14.3%;'>" . $name['date_granted_loan'] . "</td>";

		echo "<td style='width: 14.3%;'>" . $name['due_date'] . "</td>";

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

                
