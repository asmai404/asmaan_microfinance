<?php
include '../action/get_all_loanee_names_action.php';
echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';

// Function to display all loanees
function display_all_transactions() {
    global $conn;

    // Call the function to get all loanees
    $names = get_all_transactions();
    
    // Check if transaction are retrieved successfully
    if ($names !== false) {
        // Check if any loanee exist
        if (!empty($names)) {
            // Display table headers with Times New Roman font
            echo "<style>
                    table, th, td {
                        font-family: 'Times New Roman', Times, serif;
			font-size:18px;
                    }
                  </style>";
            echo "<table>";
            echo "<tr style='color:#0056b3;'><th>Client name</th><th>Client email</th><th>Loan amount</th><th>Outstanding balance</th><th>Total amount repaid</th><th>Current amount repaid</th><th>Transaction date</th><th style='text-align: center; vertical-align: middle;'>Status</th></tr>";         
            // Loop through each loanee and display their details
            foreach ($names as $name) {
                echo "<tr>";
	        echo "<td style='width: 15%;'>" . $name['client_name'] . "</td>";

                echo "<td style='width: 15%;'>" . $name['email'] . "</td>";

	        echo "<td style='width: 12%;'>" . $name['loan_amount'] . "</td>";

                echo "<td style='width: 12%;'>" . $name['outstanding_balance'] . "</td>";

		echo "<td style='width: 12%;'>" . $name['total_amount_repaid'] . "</td>";

		echo "<td style='width: 12%;'>" . $name['amount_repaid'] . "</td>";

	        echo "<td style='width: 12%;'>" . $name['transaction_date'] . "</td>";

		// Determine status color and status title based on status (update)
            	$statusColor = '';
            	$statusTitle = '';
            	switch ($name['sid']) {
                    case 2: // Pending
                        $statusColor = '#ffcc00'; // Change color to gold
                        $statusTitle = 'Pending'; // Set title to InProgress
                        break;
                    case 3: // Confirmed
                        $statusColor = '#00cc00'; // Change color to green
                        $statusTitle = 'Confirmed'; // Set title to Completed
                        break;
                    default:
                        $statusColor = '#0080FF'; // Default color
                        $statusTitle = 'Default'; // Set title to Assigned
                        break;
                }

                // Display status icon with dynamic color and make it clickable
                echo "<td style='width: 10%; border: 4px solid #dddddd; text-align: center; vertical-align: middle;'>";
                echo "<a href='#?t_id=" . $name['t_id'] . "' class='delete-link'>";
                echo "<i class='fas fa-check-circle' title='" . $statusTitle . "' style='color: " . $statusColor . "' ></i>";
                echo "</a>";
                echo "</td>";

                echo "</tr>";
            }      
            echo "</table>";
        } else {

            echo "<tr><td colspan='8' style='color: red; text-align: center; width: 100%; font-family:Times New Roman, san-serif; font-size:22px;'><strong>Empty log</strong></td></tr>";
        }
    } else {
        // Error retrieving transaction
        echo "Error retrieving transaction.";
    }
}
?>