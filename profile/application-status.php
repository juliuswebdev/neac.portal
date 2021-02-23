<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $rd = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'].'/applicationstatus', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $returnd = json_decode($rd->getBody());
    $application_status = $returnd;
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>
  <section class="position-relative" id="profile-area">
      <div class="container">
          <div class="d-flex">
              <?php  include('../template-parts/profile/sidebar.php'); ?>
              <div class="main-wrapper flex-fill w-100" style="">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <p class="mb-0">We are dedicated to provide a quality service in timely manner to all applicants. If you have any complaints about the quality of there service you are receiving please email the NEAC Management directly at feedback@applynclex. If you have questions of concerns about your application please click "SUBMIT CONCERNS" .</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <h4 class="mb-3 mt-4 d-block">
                      Application Status
                  </h4>
                  <div class="tab-content p-0">
                      <div class="tab-pane container active p-0" id="unpaid">
                          <?php
                            if($application_status->application_status) {
                            $count = 0;
                                foreach($application_status->application_status as $application_status) {
                                    $count++;
                           ?>
                                    <div class="acc">
                                        <a class="cardboard mt-0 p-3 text-decoration-none d-block collapsed" data-toggle="collapse" href="#collapsenclex<?= $count ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="float-left">
                                                <h5 class="mb-0">
                                                    <?= $application_status->application_status_group->name ?>
                                                </h5>
                                                <?php 
                                                    $arrow = '';
                                                    if($application_status->application_status_group->description) {
                                                ?>
                                                        <p class="mb-0 font-sm"><?= $application_status->application_status_group->description ?></p>
                                                <?php } else { $arrow = 'margin-top: 0px;'; } ?>
                                            </div>
                                            <div class="float-right text-center" style="<?= $arrow; ?>">
                                                <i class="fas fa-chevron-right"></i>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                        
                                        <div class="collapse" id="collapsenclex<?= $count ?>" style="">
                                            <div class="cardboard p-4 mb-4">
                                            <div class="alert alert-info alert-dismissible">
                                                <strong>Status:</strong>
                                                <?php
                                                    if($application_status->application_status_message) {
                                                        echo $application_status->application_status_message->application_status_message;
                                                    } else {
                                                        echo 'Inquiry';
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                                foreach($application_status->application_status_inputs as $input) {
                                                    include('inputs/input-b.php');
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                          <?php
                                }
                            } else {
                            ?>
                                <div class="p-3 bg-white">
                                    <strong>No Available Application Status as this moment!</strong>
                                </div>
                            <?php
                            }
                        ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
</main>
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>