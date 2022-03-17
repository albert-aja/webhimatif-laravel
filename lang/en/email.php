<?php

return [
    'preheader'         => 'An email from :name',
    'auth' => [
        'subject'           => 'Activation Email | :name',
        'activate'          => 'Activate your :name account.',
        'confirmationText'  => 'Please confirm your email to activate your :name account.',
        'confirmation'      => 'Confirm Email',
        'expiredTime'       => 'This activation link only last an hour and will expires at :time',
        'notYou'            => 'Not you? Just ignore this email.',
        'thanks'            => 'Regards'
    ],
    'modeChange'   => 'Website status change notification| :name',
    'maintenance' => [
        'title'     => 'Website is currently in maintenance mode',
        'text1'     => 'Website status was changed to <strong>Maintenance Mode</strong> by :admin at :time.',
        'text2'     => 'To access the website, you can use the bypass token <strong>:token</strong> (e.g: http://example.com/token)'
    ],
    'active' => [
        'title' => 'Website is reactivated',
        'text'  => 'The website has been reactivated by :admin at :time.',
    ]
]

?>