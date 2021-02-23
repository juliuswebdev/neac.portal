<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    $form = '';
    if(isset($_POST['submit'])) {
        $files = [];
        if($_FILES['image']['name']) {
            $files_temp = $_FILES;
            unset($files_temp['files']);
            foreach($files_temp as $key => $file) {
                $name = $files_temp[$key]['name'];
                for( $i=0 ; $i < count($name) ; $i++ ) {
                    $tmpFilePath = $files_temp[$key]['tmp_name'][$i];
                    if ($tmpFilePath != ""){
                    $files[$key] = $files_temp[$key]; 
                    }
                } 
            }
        }
        $body = array_merge($_POST, $files);
        $r = $client->request('POST', $api_url. '/api/user/'.$_SESSION['token'] .'/updateprofile', [
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
    $rd = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'].'/applicant-profile-form', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $returnd = json_decode($rd->getBody());
    $form = $returnd;
    include $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>
  <section class="position-relative" id="profile-area">
  <form method="POST" action="" enctype="multipart/form-data">  
      <div class="container">
        <?php if($result) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $result->message; ?>
            </div>
        <?php } ?>
          <div class="d-flex">
              <?php  include('../template-parts/profile/sidebar.php'); ?>
              <div class="main-wrapper flex-fill" style="">
                  <div class="cardboard mt-0">
                      <div class="profile text-center">
                          <div class="cover-img">
                              <img src="/node_modules/assets/img/sub-banner.jpg" class="object-cover w-100 h-100"/>
                          </div>
                          <div class="avatar-upload" style="margin-top: -100px;">
                              <div class="avatar-edit">
                                  <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                  <label for="imageUpload"></label>
                              </div>
                              <div class="avatar-preview">
                                    <?php
                                        $profile = '';
                                        if($details->user->profile->image) {
                                            $profile = $api_url. '/documents/'.$details->user->profile->image;
                                        } else {
                                            $profile = '/node_modules/assets/img/profile.jpg';
                                        }
                                    ?>
                                  <div id="imagePreview" style="background-image: url('<?= $profile ?>');">
                                  </div>
                              </div>
                          </div>
                          <h4 class="mt-3 text-primary font-weight-bold mb-4">
                            <?php
                                echo $details->user->first_name.' '. $details->user->middle_name .' '.$details->user->last_name;
                            ?>
                           </h4>
                      </div>
                  </div>
                  <h4 class="mb-3 mt-4 d-block">
                      Edit Profile
                  </h4>
                  <div class="cardboard p-4">
                        <h5 class="mb-3 d-block">Basic Informations</h5>                                
                        <div class="row mx-0">
                            <div class="col-md-4 p-2">
                                <p class="m-0 text-muted">
                                    First Name <span class="required">*</span>
                                </p>
                            </div>
                            <div class="col-md-8 p-2">
                                <input type="text" class="form-control font-md" name="first_name" value="<?= $details->user->first_name ?>" required/>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-md-4 p-2">
                                <p class="m-0 text-muted">
                                    Middle Name
                                </p>
                            </div>
                            <div class="col-md-8 p-2">
                                <input type="text" class="form-control font-md" name="middle_name" value="<?= $details->user->middle_name ?>"/>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-md-4 p-2">
                                <p class="m-0 text-muted">
                                    Last Name <span class="required">*</span>
                                </p>
                            </div>
                            <div class="col-md-8 p-2">
                                <input type="text" class="form-control font-md" name="last_name" value="<?= $details->user->last_name?>" required/>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-md-4 p-2">
                                <p class="m-0 text-muted">
                                    Alternate Email Address
                                </p>
                            </div>
                            <div class="col-md-8 p-2">
                                <input type="text" class="form-control font-md" name="alternate_email" value="<?= $details->user->profile->alternate_email ?>"/>
                            </div>
                        </div>
                        <?php
                            if($_SESSION['account_type'] == 'applicant') {
                                foreach($form->applicant_form_input as $input) {
                                    include('inputs/input-a.php');
                                }
                            }
                        ?>
                        <hr>
                        <div class="row mx-0">
                            <div class="agreement-area">
                                <input class="mr-1 mt-1" type="checkbox" name="agreement" id="agreement" required>
                                <label for="agreement">
                                    <a href="#agreement_modal" data-toggle="modal" data-target="#agreement_modal">Agreement/Terms</a>
                                </label>
                                <div class="modal fade" id="agreement_modal" tabindex="-1" role="dialog">
                                    <?php require_once('../template-parts/terms-and-agreement.php'); ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary font-sm mt-2">
                            UPDATE
                        </button>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      </form>
    </section>
</main>
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>


