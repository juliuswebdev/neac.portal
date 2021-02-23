<?php
    // Neac Test
    // https://developers.facebook.com/apps/1082528192204817/fb-login/settings/
    $oFB = new Facebook\Facebook([
        'app_id' => '1082528192204817',
        'app_secret' => 'a07770444b6a7d839102e9d6236cc992',
        'default_graph_version' => 'v2.10',
        'persistent_data_handler' => 'session'
    ]);
?>