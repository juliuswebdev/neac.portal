<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = $_POST;
        $r = $client->request('POST', $api_url. '/api/forgotpassword', [
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

                    <h1 class="h3 mb-3 mt-3 font-weight-normal">Password Reset</h1>
                </div>
                <label>Email address</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                         <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email address" required>
                </div>
                <?php if($result) { ?>
                    <div class="alert alert-<?= $result->alert ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?= $result->message; ?>
                    </div>
                <?php } ?>
                <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit" style="width: 100%;">Send Password Reset Link</button>
            </form>
        </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>