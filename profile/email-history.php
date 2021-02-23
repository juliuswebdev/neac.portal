<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $rd = $client->request('GET', $api_url. '/api/user/'.$_SESSION['token'].'/'.$details->user->email.'/getmails', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $return = json_decode($rd->getBody());
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
 
?>
  <section class="position-relative" id="profile-area">
      <div class="container">
          <div class="d-flex">
              <?php  include('../template-parts/profile/sidebar.php'); ?>
                <div class="main-wrapper flex-fill w-100" style="">
                    <h4 class="mb-4 d-block">
                        Email History
                    </h4>
                  <?php
                    if($return->mails) {
                        $count = 0;
                        foreach($return->mails as $mail) {
                           
                            $count++;
                  ?>
                        <div class="acc">
                            <a class="cardboard mt-0 p-3 text-decoration-none d-block collapsed" data-toggle="collapse" href="#collapsenclex<?= $count ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="float-left">
                                    <h5 class="mb-0">
                                    <small>Subject:</small> <?=  $mail->subject ?>
                                    </h5>
                                    <p class="mb-0 font-sm">From: <?= $mail->first_name.' '. $mail->last_name ?></p>
                                </div>
                                <div class="float-right text-center">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="collapse" id="collapsenclex<?= $count ?>" style="">
                                <div class="cardboard p-4 mb-4">
                                    <div>
                                        <strong>Body</strong><br>
                                        <?= $mail->messages ?>
                                    </div>
                                    <?php
                                        if($mail->attachments) {
                                    ?>
                                    <div class="mb-3">
                                        <strong>Attachments</strong><br>
                                        <?php 
                                                $attachments = explode(',',$mail->attachments);
                                           
                                            foreach($attachments as $attachment) {
                                                
                                                    $item = explode("_nurse_", $attachment);
                                                    $ext = explode(".", $attachment);
                                                ?>
                                                <small><a href="<?= $api_url ?>/documents/<?= $attachment ?>"><?= $item[0] ?>.<?= $ext[1] ?></a></small><br>
                                                <?php
                                            }
                                        
                                        ?>
                                    </div>
                                    <?php
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
                        <strong>No Email/s as this moment!</strong>
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