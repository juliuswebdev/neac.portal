<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    include ('config/google.php');
    try {
        if(isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if(!isset($token['error'])) {
        
                $google_client->setAccessToken($token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $me = $google_service->userinfo->get();
                $data = [
                    'id' => $me['id'],
                    'first_name' => $me['givenName'],
                    'middle_name' => '',
                    'last_name' => $me['familyName'],
                    'email' => $me['email'],
                    'picture' => $me['picture'],
                ];
                $client = new \GuzzleHttp\Client;
                $r = $client->request('POST', $api_url. '/api/register-socialmedia', [
                    'headers' =>   [
                                'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                                'Content-Type' => 'application/json',
                                'exceptions' => false
                            ],
                    'body' => json_encode($data)
                ]);
                $return = json_decode($r->getBody());
                if($return->alert == 'success') {
                    $_SESSION["token"] = $return->token;
                    header("Location: /profile");
                }
            }
        }
    } catch(Exception $e) {
        echo '<h2>A problem occur! Please try again.</h2>';
    }

?>