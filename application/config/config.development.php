<?php

    // error_reporting(1);
    // ini_set("display_errors", 1);
    date_default_timezone_set('Europe/London');

    /* basic information */
    DEFINE('SITE_NAME', 'Market');
    DEFINE('SITE_SLOGAN', 'Market');
    DEFINE('SITE_THEME', 'default');
    DEFINE('SEO_SITE_DESCRIPTION', 'default');
    DEFINE('SEO_SITE_KEYWORDS', 'default');
    DEFINE('SURL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));
    DEFINE('ADMIN_SURL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])).'admin');
    DEFINE('COMPANY_REGISTRATION_NUMBER', '12345678');
    DEFINE('MAIN_ADDRESS_NAME', '123');
    DEFINE('MAIN_ADDRESS_STREET', 'test');
    DEFINE('MAIN_ADDRESS_TOWN', 'ghhjdhjh');
    DEFINE('MAIN_ADDRESS_COUNTY', 'hjhjhh');
    DEFINE('MAIN_ADDRESS_COUNTRY', 'hjhjhh');
    DEFINE('MAIN_ADDRESS_POSTCODE', 'hjhjhh');
    DEFINE('CONTACT_PHONE', '000-0000-0000');
    DEFINE('CONTACT_EMAIL', 'welcome@gmail.com');
    DEFINE('MAX_FILE_SIZE', '50000'); //5mb
    DEFINE('EMAIL_ENABLED', true);
    DEFINE('REQUIRE_EMAIL_VERIFY', 'verify');
    DEFINE('USER_VERIFY_ID ', 'enabled');

    /* Mods */
    DEFINE('VOICE_COMMANDS', 'disabled');
    DEFINE('TRADING', 'enabled');
        
    /* Social */
    DEFINE('TWITTER_USER', '@whoever');
    DEFINE('FACEBOOK_PAGE', '@whoever');

    /* coin settings */
    DEFINE('TRANSACTION_CONFIRMATIONS', 2);
    DEFINE('TRANSACTION_FEES', '0.03'); //percentage


    /* SMTP INFO */
    DEFINE('DEFAULT_EMAIL_ADDRESS', 'myemail@gmail.com');
    DEFINE('DEFAULT_EMAIL_SMTP', 'smtp.gmail.com');
    DEFINE('DEFAULT_EMAIL_USERNAME', 'myemail@gmail.com');
    DEFINE('DEFAULT_EMAIL_PWD', 'password');
    DEFINE('DEFAULT_EMAIL_PORT', '465');
    DEFINE('DEFAULT_EMAIL_SSL', 'ssl');
    


    
return array(   

    /* SURL directory and folder options */
    'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
    'SURL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
    'ADMIN_SURL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])).'admin',
    'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
    'PATH_APPS' => realpath(dirname(__FILE__).'/../../') . '/application/',
    'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',
    'PATH_CACHE' => realpath(dirname(__FILE__).'/../../') . '/application/cache/',
    'PATH_LIBS' => realpath(dirname(__FILE__).'/../../') . '/application/libs/',
    'PATH_MAIN' => realpath(dirname(__FILE__).'/../../'),
    'DEFAULT_CONTROLLER' => 'home',
    'DEFAULT_ACTION' => 'index',
    
    /* database stuff */
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'exchange',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
);

