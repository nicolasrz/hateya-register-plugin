<?php

/**
 * @package hateya-register
 * @version 1.0.0
 */
/*
Plugin Name: Hateya Register
Plugin URI: -
Description: Choose domain email that you don't allowed to register
Author: NicolasRz
Version: 1.0.1
Author URI:
*/


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function hateyaRegister_checkEmailDomain($errors, $sanitized_user_login, $user_email)
{
    $domainBlacklist = [
        "gmail.com",
        "gmail.fr"
    ];

    $currentEmailIsBlackListed = false;


    foreach ($domainBlacklist as $email) {
        $regexPattern = '/^\w+@' . $email . '$/i';

        if (preg_match($regexPattern, $user_email) > 0) {
            $currentEmailIsBlackListed = true;
        }
    }

    /** If current email is found is our black listed list  */
    if ($currentEmailIsBlackListed) {
        $errors->add('demo_error', __('<strong>Email not allowed</strong>'));
    }
    return $errors;
}

add_filter('registration_errors', 'hateyaRegister_checkEmailDomain', 10, 3);

