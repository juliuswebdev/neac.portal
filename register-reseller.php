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
            <form action="" method="POST" class="form-signin bg-white shadow" style="margin-top: -270px">
                <input type="hidden" name="u_t" value="b">
                <div class="text-center">
                    <img src="/node_modules/assets/img/logo.png" class="img-fluid" width="120" />
                    <p class="mb-0 mt-3">Register to create</p>
                    <h1 class="h3 mb-3 font-weight-normal">Reseller Account</h1>
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
                    <label>Company/Profession <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                        </div>
                        <input type="text" name="profession" class="form-control" placeholder="Company/Profession" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="required">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" name="profession" class="form-control" placeholder="Contact Number" required>
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
                        if(!isset($result->success)) {
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
                
     
                    <p style="float: right"><a href="/login-reseller" class="font-md mb-4">Login</a> / <a href="/forgot-password" class="font-md mb-4">Forgot Password?</a></p>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit"  style="width: 100%">Register</button>
                    <br>
                    <br>
                    <a href="/login" class="btn btn-default text-uppercase font-weight-bold  font-sm" style="width: 100%;"><i class="fas fa-arrow-left"></i> Applicant Account</a>
                </div>    
                
            </form>
        </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>