<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

    /*
	 / --------------------------------------------------------------------
	 / Authentication
	 / --------------------------------------------------------------------
	 /
	 / Fields that are available to be used as credentials for login.
	 /
	 */
    'valid_fields' => [
		'email',
		// 'username',
	],

    /*
	 / --------------------------------------------------------------------
	 / Allow User Registration
	 / --------------------------------------------------------------------
	 /
	 / When enabled (default) any unregistered user may apply for a new
	 / account. If you disable registration you may need to ensure your
	 / controllers and views know not to offer registration.
	 /
	 */
	'allowRegistration' => env('ALLOW_REGISTRATION', false),

    /*
	 / --------------------------------------------------------------------
	 / Require Confirmation Registration via Email
	 / --------------------------------------------------------------------
	 /
	 / When enabled, every registered user will receive an email message
	 / with an activation link to confirm the account.
	 /
	 / @var string|null Name of the ActivatorInterface class
	 */
	'requireActivation' => env('REQUIRE_ACTIVATION', false),

    /*
	 / --------------------------------------------------------------------
	 / Allow Password Reset via Email
	 / --------------------------------------------------------------------
	 /
	 / When enabled, users will have the option to reset their password
	 / via the specified Resetter. Default setting is email.
	 /
	 / @var string|null Name of the ResetterInterface class
	 */
	'activeResetter' => env('RESET_PASSWORD', false),

    /*
	 / --------------------------------------------------------------------
	 / Encryption Algorithm to Use
	 / --------------------------------------------------------------------
	 /
	 / Valid values are
	 / - PASSWORD_DEFAULT (default)
	 / - PASSWORD_BCRYPT
	 / - PASSWORD_ARGON2I  - As of PHP 7.2 only if compiled with support for it
	 / - PASSWORD_ARGON2ID - As of PHP 7.3 only if compiled with support for it
	 /
	 / If you choose to use any ARGON algorithm, then you might want to
	 / uncomment the "ARGON2i/D Algorithm" options to suit your needs
	 /
	 / @var string|int
	 */
	'hashAlgorithm' => PASSWORD_DEFAULT,

    /*
	 / --------------------------------------------------------------------
	 / Minimum Password Length
	 / --------------------------------------------------------------------
	 /
	 / The minimum length that a password must be to be accepted.
	 / Recommended minimum value by NIST = 8 characters.
	 /
	 */
	'minimumPasswordLength' => 8,
    

	/*
	 / --------------------------------------------------------------------
	 / Reset Time
	 / --------------------------------------------------------------------
	 /
	 / The amount of time that an email verification-token, 
     / and password reset-token is valid for,
	 / in seconds.
	 /
	 / @var int
	 */
	'expiredTime' => 3600,

	/*
	 / --------------------------------------------------------------------
	 / Resend email cooldown time
	 / --------------------------------------------------------------------
	 /
	 / The amount of time to resend email,
	 / in seconds.
	 /
	 / @var int
	 */
	'resendCooldown' => 120,
];
