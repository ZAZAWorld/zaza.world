<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session',

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '1099831506795901',
            'client_secret' => '***********************',
            'scope'         => array('email', 'public_profile', 'user_about_me', 'user_birthday'),
        ),

        'Google' => array(
            'client_id'     => '952887191908-bbf64pcs5p7lf8q2sn6hssaf2is1mo4d.apps.googleusercontent.com',
            'client_secret' => '***********************',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        )

    )

);
