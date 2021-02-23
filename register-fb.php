<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    include ('config/facebook.php');
    try {
        $oHelper = $oFB->getRedirectLoginHelper();
        $oAccessToken = $oHelper->getAccessToken();

        if ($oAccessToken !== null) {
            $oResponse = $oFB->get('/me?fields=id,first_name,middle_name,last_name,email,picture.width(400).height(400)', $oAccessToken);
            $me = $oResponse->getGraphUser();
            
            $data = [
                'id' => $me->getID(),
                'first_name' => $me->getFirstName(),
                'middle_name' => $me->getMiddleName(),
                'last_name' => $me->getLastName(),
                'email' => $me->getEmail(),
                'picture' => $me->getPicture()->getUrl(),
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
    } catch(Exception $e) {
        echo '<h2>A problem occur! Please try again.</h2>';
    }
?>