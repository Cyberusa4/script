<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
     */

    'reset' => lang('Your password has been reset!', 'alerts'),
    'sent' => lang('We have emailed your password reset link!', 'alerts'),
    'throttled' => lang('Please wait before retrying.', 'alerts'),
    'token' => lang('This password reset token is invalid.', 'alerts'),
    'user' => lang("We can't find a user with that email address.", 'alerts'),

];
