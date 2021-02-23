<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = array_merge($_POST, $_GET);
        
        $r = $client->request('POST', $api_url. '/api/' .(isset($_GET['in']) ? 'login' : 'reseller' ), [
            'headers' =>   [
                        'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                        'Content-Type' => 'application/json',
                        'exceptions' => false
                    ],
            'body' => json_encode($body)
        ]);
        $return = json_decode($r->getBody());
        $result = $return;
        if($return->alert == 'success') {
            $_SESSION["token"] = $return->token;
            $_SESSION["account_type"] = $return->user->user_type;
            header("Location: /profile/refer-friend");
        }
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
                    <p class="mb-0 mt-3">Login with your</p>
                    <h1 class="h3 mb-3 font-weight-normal">Reseller Account</h1>
                </div>
                <?php if(isset($_GET['in']) && isset($_GET['mn'])){ ?>
                    <div class="alert alert-warning">Please login again to validate this account!</div>
                <?php } ?>
                <label>Email address</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email address" required value="<?= (isset($_GET['mn'])) ? secure_enc($_GET['mn'],'d') : '' ?>">
                </div>
                <label>Password</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <?php
                    if(isset($result->alert)) {
                        if($result->alert == 'danger') {
                ?>
                            <p><span style="color: red"><strong><?= $result->message ?></strong></span></p>
                <?php
                        }
                    }
                ?>            
                <a href="/register-reseller" class="font-md mb-4">Register</a> / <a href="/forgot-password" class="font-md mb-4">Forgot Password?</a>
                <br>
                <br>
                <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit"  style="width: 100%">Sign in</button>
                <br>
                <br>
                <a href="/login" class="btn btn-default text-uppercase font-weight-bold  font-sm" style="width: 100%;"><i class="fas fa-arrow-left"></i> Applicant Account</a>
            </form>
        </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>