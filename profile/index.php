<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $form = '';
    $client = new \GuzzleHttp\Client;
    $rd = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'].'/applicant-profile-form', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $returnd = json_decode($rd->getBody());
    $form = $returnd;
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>
  <section class="position-relative" id="profile-area">
      <div class="container">
          <div class="d-flex">
                <?php  include('../template-parts/profile/sidebar.php'); ?>
              <div class="main-wrapper flex-fill" style="">
                  <div class="cardboard mt-0">
                      <div class="profile text-center">
                          <div class="cover-img">
                              <img src="/node_modules/assets/img/profile/cover.jpg" class="object-cover w-100 h-100"/>
                          </div>
                          <div class="profile-img position-relative" style="z-index: 999">
                            <?php
                                $profile = '';
                                if($details->user->profile->image) {
                                    $profile = $api_url. '/documents/'.$details->user->profile->image;
                                } else {
                                    $profile = '/node_modules/assets/img/profile.jpg';
                                }
                            ?>
                              <img src="<?= $profile ?>" class="object-cover w-100 h-100 shadow"/>
                          </div>
                          <h4 class="mt-3 text-primary font-weight-bold mb-4">                                    
                            <?php
                                echo $details->user->first_name.' '. $details->user->middle_name .' '.$details->user->last_name;
                            ?>
                           </h4>
                      </div>
                  </div>
                  <h4 class="mb-3 mt-4 d-block">
                      Profile
                  </h4>
                  <div class="cardboard p-4">
                        <h5 class="mb-3 d-block">Basic Informations</h5>
                        <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                <?= ($_SESSION['account_type'] == 'applicant') ? 'Application Number' : 'Reseller Code'; ?>
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                                  <?= $details->user->profile->application_number ?>
                              </p>
                          </div>
                      </div>

                      <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                  First Name
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                                  <?= $details->user->first_name ?>
                              </p>
                          </div>
                      </div>

                      <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                  Middle Name
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                                <?= $details->user->middle_name ?>
                              </p>
                          </div>
                      </div>

                      <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                 Last Name
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                                <?= $details->user->last_name ?>
                              </p>
                          </div>
                      </div>

                      <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                 Email Address
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                              <?php
                                if($details->user->email) {
                              ?>
                                <a href="mailto:<?= $details->user->email ?>"><?= $details->user->email ?></a>
                                <?php
                                } else {
                                    echo '-';
                                }
                              ?>
                              </p>
                          </div>
                      </div>

                      <div class="row mx-0">
                          <div class="col-md-4 p-1">
                              <p class="m-0 text-muted">
                                 Alternate Email Address
                              </p>
                          </div>
                          <div class="col-md-8 p-1">
                              <p class="m-0">
                              <?php
                                if($details->user->profile->alternate_email) {
                              ?>
                                <a href="mailto:<?= $details->user->profile->alternate_email ?>"><?= $details->user->profile->alternate_email ?></a>
                                <?php
                                } else {
                                    echo '-';
                                }
                              ?>
                              </p>
                          </div>
                      </div>
                            
                    <?php
                        if($_SESSION['account_type'] == 'applicant') {
                            foreach($form->applicant_form_input as $input) {
                                include('inputs/input-b.php');
                            }
                        }
                    ?>
                  </div>
              </div>
          </div>
      </div>
    </section>
</main>
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>