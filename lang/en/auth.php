<?php

return [
    'failed'            =>  'These credentials do not match our records.',
    'password'          =>  'The provided password is incorrect.',
    'throttle'          =>  'Too many login attempts. Please try again in :seconds seconds.',
    'email'             =>  'Email',
    'username'          =>  'Username',
    'password'          =>  'Password',
    'repeatPassword'    =>  'Repeat Password',
    'signIn'            =>  'Sign In',
    'toast' => [
        'success'   =>  'Success!',
        'resended'  =>  'Kami telah mengirim ulang email verifikasi anda! Silahkan periksa email anda',
        'cooldown'  =>  'Wait <span id=\'countdown\'></span> second(s)',
        'resendText'=>  'Resend Email',
    ], 
    'login' => [
        'loginTitle'            =>  'Login',
        'loginText'             =>  'Welcome to Admin Login Page.',
        'emailOrUsername'       =>  'Email or Username',
        'rememberMe'            =>  'Remember Me',
        'showPassword'          =>  'Show Password',
        'loginAction'           =>  'Login',
        'needAnAccount'         =>  'Create new Account',
        'forgotYourPassword'    =>  'Forgot Password?',
        'badAttempt'            =>  'Unable to log you in. Please check your credentials.',
    ],
    'register' => [
        'registerTitle'             =>  'Register',
        'alreadyRegistered'         =>  'Already registered?',
        'registerDisabled'          =>  'Sorry, new user accounts are not allowed at this time.',
    ],
    'verify' => [
        'verifyTitle'       => 'Verify your email',
        'checkEmail'        => 'Please check your email <strong>:email</strong> dan click the confirm button to verify your email.',
        'notice'            => 'If you can\'t find the verification email in your inbox, please check your spam. The activation email is valid until :date',
        'didnotReceive'     => 'Didn\'t receive email? Click the button below to resend the verification email.'
    ]
];
