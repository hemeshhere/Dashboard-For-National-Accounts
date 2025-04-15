<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Valid Users that can login
$valid_users = [
    'user' => [
        'password' => 'user123',
        'name' => 'user',
        'security_question' => 'What city were you born in?',
        'security_answer' => 'Delhi'
    ]
];
function update_user_password($username, $new_password) {
    global $valid_users;
    if (isset($valid_users[$username])) {
        $valid_users[$username]['password'] = $new_password;
        return true;
    }
    return false;
}

function verify_login($username, $password) {
    global $valid_users;
    return isset($valid_users[$username]) && 
           $valid_users[$username]['password'] === $password;
}
?>