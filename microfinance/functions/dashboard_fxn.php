<?php
include '../action/get_all_loanee_names_action.php';


// Function to display the total number of loan applicants or 0 if there are no loan applicants
function display_loan_applicants() {
    // Call the function to retrieve loan applicants
    $all_loan_applicants = get_loan_applicants();
    // Calculate the total number of loan applicants
    $total_loan_applicants = count($all_loan_applicants);
    // Display the total number of loan applicants or 0 if there are no loan applicants
    echo "{$total_loan_applicants}";
}


// Function to display the total number of female clients or 0 if there are no female clients
function display_female_clients() {
    $all_female_clients= get_female_clients();
    $total_female_clients = count($all_female_clients);
    echo "{$total_female_clients}";
}

// Function to display the total number of male clients or 0 if there are no male clients
function display_male_clients() {
    $all_male_clients= get_male_clients();
    $total_male_clients = count($all_male_clients);
    echo "{$total_male_clients}";
}

// Function to display the total number of clients or 0 if there are no clients
function display_clients() {
    $all_clients= get_clients();
    $total_clients = count($all_clients);
    echo "{$total_clients}";
}

// Function to display the total number of transactions or 0 if there are no transactions
function display_transactions() {
    $all_transactions= get_transactions();
    $total_transactions = count($all_transactions);
    echo "{$total_transactions}";
}

// Function to calculate the mean amount loaned out
function calculate_mean($amounts) {
    if (count($amounts) == 0) {
        return 0;
    }
    $total_amount = array_sum($amounts);
    $mean = $total_amount / count($amounts);
    return $mean;
}

// Function to display the mean amount loaned out
function display_mean() {
    $loan_amounts = get_loan_amounts();
    $mean_amount = calculate_mean($loan_amounts);
    $formatted_mean_amount = sprintf("%.2f", $mean_amount);
    echo "GHS {$formatted_mean_amount}";
}

?>