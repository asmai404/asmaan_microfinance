<?php
include '../action/get_all_loanee_names_action.php';
echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';

// Function to display all messages
function display_all_messages() {
    global $conn;

    // Call the function to get all loanees
    $names = get_all_messages();
    
    // Check if loanees names are retrieved successfully
    if ($names !== false) {
        // Check if any loanee exist
        if (!empty($names)) {
            // Display table headers with Times New Roman font
            echo "<style>
                    table, th, td {
                        font-family: 'Times New Roman', Times, serif;
			font-size:22px;
                    }
                  </style>";
            echo "<table>";
            echo "<tr><th>Full Name</th><th>Email</th><th>Message|Report</th></tr>";         
            // Loop through each loanee and display their details
            foreach ($names as $name) {
                echo "<tr>";
                // Display the loanee's fullname
	        echo "<td style='width: 20%;'>" . $name['fname'] . ' ' . $name['lname'] . "</td>";

	        // Display the loan amount
                echo "<td style='width: 20%;'>" . $name['email'] . "</td>";

	        // Display the loan purpose
	        echo "<td style='width: 60%;'>" . $name['message'] . "</td>";

		echo "</tr>";
            }      
            echo "</table>";
        } else {

            echo "<tr><td colspan='3' style='color: red; text-align: center; width: 100%; font-family:Times New Roman, san-serif; font-size:22px;'><strong>Empty log</strong></td></tr>";
        }
    } else {
        // Error retrieving messages
        echo "Error retrieving messages.";
    }
}
?>