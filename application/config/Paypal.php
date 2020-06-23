<?php
/** set your paypal credential **/

$config['client_id'] = 'AYi10safNdkX9w4w6MczQe_AfryNYeD0UNHXOLIPNYH9uJMAc7QY_CeKXybx6pU67fwgkgkLzVbbRhxd';
$config['secret'] = 'EOJnyv3L-JcbquvkUc7XOWpgdNUBj9H0l4PhlfMVbW610O9pj5rMvEUZMrI7bHBdJ5dVZvzdnsH1J974';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);