<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = $_POST;
        $r = $client->request('POST', $api_url. '/api/register', [
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
            <form action="" method="POST" class="form-signin bg-white shadow" style="margin-top: -300px">
                <input type="hidden" name="u_t" value="applicant">
                <div class="text-center">
                    <img src="/node_modules/assets/img/logo.png" class="img-fluid" width="120" />
                    <p class="mb-0 mt-3">Register to create</p>
                    <h1 class="h3 mb-3 font-weight-normal">Applicant Account</h1>
                </div>
                <div class="form-group">
                    <label>Email address <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email address" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>First Name <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    </div>
                </div>
                <?php
                    if($result) {
                        if(!$result->success) {
                            echo '<div class="alert alert-danger" role="alert">';
                            foreach($result as $errors) {
                                if(is_array($errors)) {
                                    foreach($errors as $error) {
                                        echo $error. '<br>';
                                    }
                                }
                                else {
                                    $error. '<br>';
                                }
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="alert alert-success" role="alert">';
                            echo $result->success;
                            echo '</div>';
                        }
                    }
                ?>
                <div class="agreement-area">
                    <input class="mr-1 mt-1" type="checkbox" name="agreement" id="agreement" required>
                    <label for="agreement">
                        <a href="#agreement_modal" data-toggle="modal" data-target="#agreement_modal">Agreement/Terms</a>
                    </label>

                    <div class="modal fade" id="agreement_modal" tabindex="-1" role="dialog">
                        <?php require_once('template-parts/terms-and-agreement.php'); ?>
                    </div>


                    <p style="float: right"><a href="/login" class="font-md mb-4">Login</a> / <a href="/forgot-password" class="font-md mb-4">Forgot Password?</a></p>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit"  style="width: 100%">Register</button>
                    <?php
                        if (!session_id()) {
                            session_start();
                        }
                        include ('config/facebook.php');
                        include ('config/google.php');


                        $helper = $oFB->getRedirectLoginHelper();
                        $permissions = ['email']; // Optional permissions
                        $loginUrl = $helper->getLoginUrl( $site_url.'/register-fb', $permissions);
                        echo '<hr>';
                        echo '<table class="mt-3" style="width: 100%"><tr>';
                        echo '<td class="text-center p-1"><a href="' . $loginUrl . '"><img src="/node_modules/assets/img/fb.png" class="mb-2" width="50"><br>Register with Facebook!</a></td>';
                        echo '<td class="text-center p-1"><a href="'.$google_client->createAuthUrl().'"><img src="/node_modules/assets/img/google.png" class="mb-2" width="50"><br>Register with Google!</a></td>';
                        echo '</tr></table>';
                    ?>
                    <br>
                    <a href="/login-reseller" class="btn btn-default text-uppercase font-weight-bold  font-sm" style="width: 100%;">Reseller Account <i class="fas fa-arrow-right"></i></a>
                </div>
            </form>

        </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>