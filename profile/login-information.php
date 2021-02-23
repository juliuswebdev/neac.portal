<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = $_POST;
        $r = $client->request('POST', $api_url. '/api/user/'.$_SESSION['token'] .'/changepassword', [
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
  <section class="position-relative" id="profile-area">
      <div class="container">
            <?php if(isset($result->success)) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $result->success; ?>
                </div>
            <?php } ?>
          <div class="d-flex">
              <?php  include('../template-parts/profile/sidebar.php'); ?>
              <div class="main-wrapper flex-fill" style="">
                    <h4 class="mb-2 d-block">
                      Change Password
                    </h4>
                    <div class="cardboard p-4">
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
                                }
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="row mx-0">
                                <div class="col-md-5 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Old Password</p>
                                </div>
                                <div class="col-md-7 pt-2 pb-2 pl-0 pr-0">
                                    <input type="password" name="old_password" class="form-control font-md"/>
                                </div>
                            </div>
                            <hr>
                            <div class="row mx-0">
                                <div class="col-md-5 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">New Password
                                    </p>
                                </div>
                                <div class="col-md-7 pt-2 pb-2 pl-0 pr-0">
                                    <input type="password" name="new_password" id="new_password" class="form-control font-md"/>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="col-md-5 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Confirm New Password</p>
                                </div>
                                <div class="col-md-7 pt-2 pb-2 pl-0 pr-0">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control font-md"/>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary font-sm mt-2">
                                UPDATE
                            </button>
                        </form>
                    </div>
              </div>
          </div>
      </div>
    </section>
</main>
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>