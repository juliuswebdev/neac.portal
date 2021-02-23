<?php
    set_time_limit(100000000);

    require $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    session_start();
    $api_url = 'http://localhost:8000';
    $site_url = 'http://neac.localhost';

    $document_path = $api_url. '/documents/';
    $client = new \GuzzleHttp\Client;

    $current_file = basename($_SERVER["SCRIPT_FILENAME"], '.php');

    $current_folder = str_replace('/', '', dirname($_SERVER['PHP_SELF']));

    $account_type = isset($_SESSION['account_type']) ? $_SESSION['account_type'] : '';

    if($current_folder == 'profile' && !isset($_SESSION['token'])) {
        header("Location: /login");
    }

    function secure_enc( $string, $action = 'e' ) {
        $secret_key = 'neacproject';
        $secret_iv = 'neacprojectsecret';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
    }

    global $details;
    if(isset($_SESSION['token'])) {
        $r = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'], [
            'headers' =>   [
                        'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                        'Content-Type' => 'application/json',
                        'exceptions' => false
                    ],
        ]);
        $return = json_decode($r->getBody());
        $details = $return;
        if($details->alert == 'error') {
            session_unset();
            header("Location: /");
        }
    }

    if($account_type == 'business' && $current_folder == 'profile') {
        if(
            $current_file == 'index' ||
            $current_file == 'email-history' ||
            $current_file == 'login-information' ||
            $current_file == 'logout' ||
            $current_file == 'profile-edit' ||
            $current_file == 'refer-friend'
        ) {
         
        } else {
          
            header("Location: /profile/");
        }
    }

?>