<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    $forms = '';
    $forms_lock = explode(',', $details->user->profile->forms_lock);

    if(isset($_POST['submit'])) {
        $files_temp = $_FILES;
        unset($files_temp['files']);
        $files = [];
        foreach($files_temp as $key => $file) {
            $name = $files_temp[$key]['name'];
            for( $i=0 ; $i < count($name) ; $i++ ) {
                $tmpFilePath = $files_temp[$key]['tmp_name'][$i];
                if ($tmpFilePath != ""){
                   $files[$key] = $files_temp[$key]; 
                }
            } 
        }
        $body = array_merge($_POST, $files);
        $r = $client->request('POST', $api_url. '/api/user/'.$_SESSION['token'] .'/saveform', [
            'headers' =>   [
                        'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                        'Content-Type' => 'application/json',
                        'exceptions' => false
                    ],
            'body' => json_encode($body)
        ]);
        $return = json_decode($r->getBody());
        $result = $return;
        $forms_lock[] = $_POST['form_group_id'];
    }

    $rd = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'].'/forms', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $returnd = json_decode($rd->getBody());
    $forms = $returnd;

    include $_SERVER['DOCUMENT_ROOT'] . '/header.php';


?>
  <section class="position-relative" id="profile-area">
      
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
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <p class="mb-0">We are dedicated to provide a quality service in timely manner to all applicants. If you have any complaints about the quality of there service you are receiving please email the NEAC Management directly at feedback@applynclex. If you have questions of concerns about your application please click "SUBMIT CONCERNS" .</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <h4 class="mb-3 mt-4 d-block">
                      Application Status
                    </h4>
                  <?php
                    if($forms->form_groups) {
                        $count = 0;
                        foreach($forms->form_groups as $form) {
                            $locked = in_array($form->form_group->id, $forms_lock);
                            $count++;

                            $collapsed = 'collapsed';
                            $collapsed_show = '';
                            if(isset($_POST['form_group_id'])) {
                                if($_POST['form_group_id'] == $form->form_group->id) {
                                    $collapsed = '';
                                    $collapsed_show = 'show';
                                }
                            }
                    ?>
                            <div class="acc">
                                <a class="cardboard mt-0 p-3 text-decoration-none d-block <?= $collapsed ?>" data-toggle="collapse" href="#collapsenclex<?= $count ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <div class="float-left">
                                        <h5 class="mb-0">
                                        <?=  $form->form_group->name ?> 
                                        <?php
                                            if($locked) {
                                                echo '<small class="ml-2"><i class="fas fa-check text-sm text-success"></i></small>';
                                            }
                                        ?>
                                        </h5>
                                        <?php
                                            if($form->form_group->description) {
                                        ?>
                                            <p class="mb-0 font-sm"><?=  $form->form_group->description ?></p>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="float-right text-center" style="<?= ($form->form_group->description) ? '' : 'margin-top: 0' ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                                <div class="collapse <?= $collapsed_show ?>" id="collapsenclex<?= $count ?>" style="">
                                    <div class="cardboard p-4 mb-4">
                                        <?php if(!$locked) { ?>
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to submit the form? After submitting the form you cannot change the value!');">
                                                <input type="hidden" name="form_group_id" value="<?= $form->form_group->id ?>">
                                                <input type="hidden" name="form_group_name" value="<?= $form->form_group->name ?>">
                                                <?php
                                                foreach($form->form_inputs as $input) {
                                                    include('inputs/input-a.php');
                                                }
                                                ?>
                                                <hr>
                                                <div class="row mx-0">
                                                    <div class="agreement-area">
                                                        <input class="mr-1 mt-1" type="checkbox" name="agreement" id="agreement" required>
                                                        <label for="agreement">
                                                            <a href="#agreement_modal-<?= $count ?>" data-toggle="modal" data-target="#agreement_modal-<?= $count ?>">Agreement/Terms</a>
                                                        </label>

                                                        <div class="modal fade" id="agreement_modal-<?= $count ?>" tabindex="-1" role="dialog">
                                                            <?php require_once('../template-parts/terms-and-agreement.php'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-primary font-sm mt-2">UPDATE</button>
                                            </form>
                                        <?php } else {
                                                foreach($form->form_inputs as $input) {
                                                    include('inputs/input-b.php');
                                                }
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
                      <strong>No Available Form as this moment!</strong>
                    </div>
                <?php
                    }
                  ?>
                
              </div>
          </div>
      </div>
    </section>
</main>
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>