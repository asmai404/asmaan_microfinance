<?php
include '../action/get_all_loanee_names_action.php';
echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';

// Function to display all loanees
function display_all_names() {
    global $conn;

    // Call the function to get all loanees
    $names = get_all_names();
    
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
            echo "<tr><th>Full Name</th><th>Amount</th><th>Purpose</th><th>Phone</th><th>Email</th><th>Action</th></tr>";         
            // Loop through each loanee and display their details
            foreach ($names as $name) {
                echo "<tr>";
                // Display the loanee's fullname
	        echo "<td style='width: 19%;'>" . $name['fname'] . ' ' . $name['lname'] . "</td>";

	        // Display the loan amount
                echo "<td style='width: 19%;'>" . $name['amount'] . "</td>";

	        // Display the loan purpose
	        echo "<td style='width: 19%;'>" . $name['purpose'] . "</td>";

	        // Display the loanee's phone number
                echo "<td style='width: 19%;'>" . $name['phone'] . "</td>";

	        // Display the loanee's email
		echo "<td style='width: 19%;'>" . $name['email'] . "</td>";

		// Add delete icon/link
                echo "<td style='width: 5%; border: 4px solid #dddddd; text-align: center; vertical-align: middle;'>";
                echo "<a href='../action/delete_loan_applicant_action.php?la_id=" . $name['la_id'] . "' class='edit-link' style='color:red;'><i class='fas fa-trash-alt' title='Delete'></i></a>"; 
                echo "</td>";

                echo "</tr>";
            }      
            echo "</table>";
        } else {

            echo "<tr><td colspan='6' style='color: red; text-align: center; width: 100%; font-family:Times New Roman, san-serif; font-size:22px;'><strong>Empty log</strong></td></tr>";
        }
    } else {
        // Error retrieving names
        echo "Error retrieving names.";
    }
}
?>