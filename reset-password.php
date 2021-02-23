<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = array_merge($_POST, $_GET);
        $r = $client->request('POST', $api_url. '/api/resetpassword', [
            'headers' =>   [
                        'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                        'Content-Type' => 'application/json',
                        'exceptions' => false
                    ],
            'body' => json_encode($body)
        ]);
        $return = json_decode($r->getBody());
        $result = $return;
    }
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';

?>
         <section class="banner" style="
            background: url('/node_modules/assets/img/sub-banner.jpg') center;
            background-size: cover;
        ">
         </section>
         <section class="auth-section">
             <form action="" method="POST" class="form-signin bg-white shadow">
                <div class="text-center">
                    <img src="/node_modules/assets/img/logo.png" class="img-fluid" width="120" />
                    <h1 class="h3 mb-1 mt-3 font-weight-normal">Reset Password</h1>
                    <p><strong>[<?= isset($_GET['mn']) ? secure_enc($_GET['mn'], 'd') : '';?></strong>]</p>
                </div>
                <?php
                    if($result) {
                        if(!$result->success) {
                            echo '<div class="alert alert-danger" role="alert">';
                            foreach($result as $item) {
                                if(is_array($item)) {
                                echo $item[0].'<br>';
                                } else {
                                echo $item.'<br>';  
                                }
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="alert alert-success" role="alert">'.$result->success.'! Please login again <a href="/login">Link</a>.</div>';
                        }
                    }
                ?>
                
                <label>New Password</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                     </div>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                
                <label>Confirm New Password</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit"  style="width: 100%;">Reset</button>
             </form>
         </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>