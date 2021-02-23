<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $files = $_FILES;
        $body = array_merge($_POST, $files);

        $r = $client->request('POST', $api_url. '/api/user/'.$_SESSION['token'] .'/savetestimonial', [
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
            <?php if($result) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $result->message; ?>
                </div>
            <?php } ?>
          <div class="d-flex">
          <?php  include('../template-parts/profile/sidebar.php'); ?>
              <div class="main-wrapper flex-fill" style="">
                  <h4 class="mb-2 d-block">
                      Testimonials Feedback
                  </h4>
                  <div class="cardboard p-4">
                        <form method="POST" action="" enctype="multipart/form-data">  
                            <input type="hidden" name="category" value="1">
                            <div class="row mx-0">
                                <div class="col-md-4 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Subject/Profession</p>
                                </div>
                                <div class="col-md-8 pt-2 pb-2 pl-0 pr-0">
                                    <input type="text" name="subject" class="form-control font-md" required/>
                                </div>
                            </div>

                            <div class="row mx-0">
                                <div class="col-md-4 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Feedback Description</p>
                                </div>
                                <div class="col-md-8 pt-2 pb-2 pl-0 pr-0">
                                    <textarea class="form-control font-md" name="description" required></textarea>
                                </div>
                            </div>

                            <div class="row mx-0">
                                <div class="col-md-4 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Attachments</p>
                                </div>
                                <div class="col-md-8 pt-2 pb-2 pl-0 pr-0">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="attachments[]" class="custom-file-input" accept=".jpg, .docx, .txt, .png, .mp4, .3gp" multiple>
                                            <label class="custom-file-label" for="exampleInputFile">Choose Files</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-0">
                                <div class="col-md-4 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Link</p>
                                </div>
                                <div class="col-md-8 pt-2 pb-2 pl-0 pr-0">
                                    <input type="url" name="url" class="form-control font-md"/>
                                </div>
                            </div>


                            <div class="row mx-0">
                                <div class="col-md-4 pt-2 pb-2 pl-0 pr-0">
                                    <p class="m-0 text-muted">Rate</p>
                                </div>
                                <div class="col-md-8 pt-2 pb-2 pl-0 pr-0">
                                    <div class="stars stars-review">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="label">&nbsp;</div>
                                    <input type="hidden" name="rating" id="rating" value="0">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary font-sm mt-2">
                                SUBMIT FEEDBACK
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