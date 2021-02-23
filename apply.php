<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    $form = '';
    if(isset($_POST['submit'])) {
        $files = $_FILES;
        $body = array_merge($_POST, $files);
        $r = $client->request('POST', $api_url. '/api/apply/', [
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
    $referred_by_api = $client->request('GET', $api_url. '/api/getreseller', [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $referred_by = json_decode($referred_by_api->getBody());
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
    <section style="
        background: url('/node_modules/assets/img/sub-banner.jpg') center;
        background-size: cover;
        height: 240px;
        ">
    </section>
    <section style="margin-bottom: 120px;">
        <form action="" method="POST" class="form-applynow container bg-white shadow p-5 mx-auto" style="margin-top: -10%">
            <div class="text-center">
                <img src="/node_modules/assets/img/logo.png" class="img-fluid" width="120" />
                <h1 class="h3 mb-1 mt-3 font-weight-normal">Start Your Application Now!</h1>
            </div>
            <p class="mb-0 mt-3 mb-3">By submitting the form below you can start your inquiry. Incase you have concerns our specialist will assist you. Please make sure that you enter a valid e-mail address as your username. Our Online Specialists will contact you using your email address. We can assist you processing your application regardless where you currently reside. You can ask your questions to the Specialist once you receive her or his email.</p>
            <?php if(isset($result->success)) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $result->success; ?>
                </div>
            <?php } ?>
            <div>
                <h4 class="mb-3 mt-5 d-block">
                    Log-in Information
                </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="m-0 text-muted">E-mail:<span style="color:red;font-size:12px;">* (You must enter a VALID e-mail address as your username)</span></p>
                            <input class="form-control" name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <p class="m-0 text-muted">Alternative E-mail: </p>
                            <p style="color:red;font-size:12px; line-height: 1.2">(Due to the security and communication related issues we do NOT recommend using YAHOO email address to create an account.)</p>
                            <input class="form-control" name="alternate_email" type="text" value="<?= isset($_POST['alternate_email']) ? $_POST['alternate_email'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="m-0 text-muted">Password: <span style="color:red;font-size:12px;">* (6 characters or more)</span></p>
                            <input class="form-control" name="password" type="password"  value="">
                        </div>
                        <div class="form-group">
                            <p class="m-0 text-muted">Re-type Password: <span style="color:red;font-size:12px;">*</span></p>
                            <input class="form-control" name="confirm_password" type="password"  value="">
                        </div>
                    </div>
                    <div class="col-md-5 form-group">
                        <p class="mb-0 text-muted">First Name:<span style="color:red;font-size:12px;">*</span></p>
                        <input class="form-control" name="first_name" type="text" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>">
                    </div>
                    <div class="col-md-2 form-group">
                        <p class="mb-0 text-muted">Middle Name:<span style="color:red;font-size:12px;">*</span></p>
                        <input class="form-control" name="middle_name" type="text" value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : '' ?>"> 
                    </div>
                    <div class="col-md-5 form-group">
                        <p class="mb-0 text-muted">Last Name:<span style="color:red;font-size:12px;">*</span></p>
                        <input class="form-control" name="last_name" type="text" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"> 
                    </div>
                </div>
            
            </div>
            <div>
                <div class="row">
                <?php
                    foreach($form->applicant_form_input as $input) {
                ?>
                    
                        <?php if($input->type == 'html') { ?>
                        <div class="col-md-12 ">
                            <?= $input->settings ?>
                        </div>
                        <?php } else {
                            $required = ($input->required) ? 'required' : '';  
                            $required_span = ($input->required) ? '<span class="required">*</span>' : '';
                        ?>
                            <div class="form-group <?= ($input->class) ? $input->class : 'col-md-12' ?>">
                                <p class="m-0 text-muted">
                                    <?= $input->label . ' ' . $required_span ?>
                                </p>
                           
                        

                                <?php if($input->type == 'text') { ?>

                                    <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                <?php } elseif($input->type == 'text_area') { ?>

                                    <textarea name="<?= $input->type .'_fi_' .$input->id ?>" class="form-control" rows="4" placeholder="<?= $input->placeholder ?>" <?= $required ?>></textarea>

                                <?php } elseif($input->type == 'email') { ?>

                                    <input type="email" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                <?php } elseif($input->type == 'number') { ?>

                                <?php   
                                        $settings = array_pad(explode(':::',$input->settings),2,null);
                                        $min = $settings[0];
                                        $max = $settings[1];
                                ?>

                                    <input type="number" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control" min="<?= $min ?>" max="<?= $max ?>" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                <?php } elseif($input->type == 'url') { ?>

                                    <input type="url" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                    <!-- CONTENT -->

                                <?php } elseif($input->type == 'summer_note') { ?>

                                    <small style="display: block; margin-bottom: 15px; "><?= $input->placeholder ?></small>
                                    <textarea name="<?= $input->type .'_fi_' .$input->id ?>" class="form-control summer_note" rows="4" placeholder="" <?= $required ?>></textarea>

                                <?php } elseif($input->type == 'multiple_image') { ?>
                                
                                    <?php
                                            $images = '';
                                            if($input->post) {
                                            $images = explode(',', $input->post);
                                            }
                                    ?>
                                    <?php if($images) { ?>
                                            <ul class="multiple_image_lists">
                                            <?php foreach($images as $image) { ?>
                                                <li><img src="<?= $document_path ?><?= $image ?>" alt=""></li>
                                            <?php } ?>
                                            </ul>
                                    <?php } ?>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="<?= $input->type .'_fi_' .$input->id ?>[]" value="" class="custom-file-input" accept="<?= $input->settings ?>" multiple>
                                            <label class="custom-file-label" for="exampleInputFile">Choose Images</label>
                                        </div>
                                    </div>
                                    <small>
                                        <strong>accepts: </strong><?= $input->settings ?>
                                    </small>

                                    <?php } elseif($input->type == 'multiple_file') { ?>

                                    <?php
                                        $files = '';
                                        if($input->post) {
                                        $files = explode(',',$input->post);
                                        }
                                    ?>

                                    <?php if($files) { ?>
                                        <ul class="multiple_file_lists">
                                    <?php foreach($files as $file) { ?>
                                    <?php
                                                $item = explode("_nurse_", $file);
                                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                    ?>
                                            <li><a  target="_blank" href="<?= $document_path ?><?= $file ?>"><?= $item[0] ?>.<?= $ext ?></a></li>
                                    <?php } ?>
                                        </ul>
                                    <?php } ?>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="<?= $input->type .'_fi_' .$input->id ?>[]" value="" class="custom-file-input" accept="<?= $input->settings ?>" multiple>
                                                <label class="custom-file-label" for="exampleInputFile">Choose Files</label>
                                            </div>
                                        </div>
                                        <small>
                                            <strong>accepts: </strong><?= $input->settings ?>
                                        </small>


                                    <!-- SELECT -->

                                    <?php } elseif($input->type == 'select') { ?>

                                    <?php
                                            $select = explode(':::', $input->settings);
                                    ?>
                                        <select name="<?= $input->type .'_fi_' .$input->id ?>" class="form-control">
                                        <option value="" selected disabled><?= $input->placeholder ?></option>
                                    <?php foreach($select as $item) { ?>
                                    <?php
                                                $select_item = array_pad(explode(' : ',$item),2,null);
                                                $value = $select_item[0];
                                                $text = $select_item[1];
                                                $selected = '';

                                    ?>
                                            <option value="<?= $value ?>" <?= $selected ?>><?= $text ?></option>
                                    <?php } ?>
                                        </select>

                                    <?php } elseif($input->type == 'checkbox') { ?>

                                    <?php
                                            $select = explode(':::', $input->settings);
                                            $count = 1;
                                    ?>
                                    <?php foreach($select as $item) { ?>
                                        <div class="input-group">
                                            <?php
                                                $select_item = array_pad(explode(' : ',$item),2,null);
                                                $value = $select_item[0];
                                                $text = $select_item[1];
                                                $count++;
                                                $checked = '';
                                                $val_post = explode(',', $input->post);

                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input" name="<?= $input->type .'_fi_' .$input->id ?>[]"  id="<?= $input->type .'_fi_' .$input->id. '_' .$count  ?>" value="<?= $value ?>" type="checkbox" <?= $checked ?>>
                                                <label for="<?= $input->type .'_fi_' .$input->id. '_' .$count ?>" class="form-check-label"><?= $text ?></label>
                                            </div>
                                        </div>

                                    <?php } ?> 

                                        <?php } elseif($input->type == 'radio') { ?>

                                        <?php 
                                            $select = explode(':::', $input->settings);
                                            $count = 1;
                                        ?>
                                    <?php foreach($select as $item) { ?>
                                        <div class="input-group">
                                    <?php
                                                $select_item = array_pad(explode(' : ',$item),2,null);
                                                $value = $select_item[0];
                                                $text = $select_item[1];
                                                $count++;
                                                $checked = '';
                                    ?>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" name="<?= $input->type .'_fi_' .$input->id ?>" id="<?= $input->type .'_fi_' .$input->id. '_' .$count  ?>" value="<?= $value ?>" type="radio" <?= $checked ?>>
                                                <label for="<?= $input->type .'_fi_' .$input->id. '_' .$count ?>" class="custom-control-label"><?= $text ?></label>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>

                                    <!-- Javascript -->

                                    <?php } elseif($input->type == 'date_picker') { ?>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control input_blank date_picker_js" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                        </div>

                                    <?php } elseif($input->type == 'time_picker') { ?>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control input_blank time_picker_js"  placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                        </div>

                                    <?php } elseif($input->type == 'date_time_picker') { ?>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control input_blank date_time_picker_js" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                        </div>

                                    <?php } elseif($input->type == 'date_range_picker') { ?>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control input_blank date_range_picker_js" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                        </div>

                                    <?php } elseif($input->type == 'color_picker') { ?>

                                        <div class="input-group color_picker_js colorpicker-element">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-square" style="color: ;"></i></span>
                                        </div>
                                        <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="" class="form-control"  placeholder="<?= $input->placeholder ?>" <?= $required ?>>
                                        </div>

                                    <?php } ?>
                            </div>
                        <?php } ?>
                <?php
                    }
                ?>
                </div>
            </div>
            <div>
                <h4 class="mb-3 mt-3 d-block">
                    REFERRED BY: If the applicant is referred by Client. ENDORSED BY: If we have referred the applicant to the client.
                </h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <p class="mb-0 text-muted">To avail a discount enter your promocode here:<span style="color:red;font-size:12px;"></span></p>
                        <input class="form-control" name="reseller_code" type="text" value="<?= isset($_GET['ref_code']) ? $_GET['ref_code'] : ''; ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <p class="mb-0 text-muted">Reffered By:<span style="color:red;font-size:12px;"></span></p>
                        <select name="referred_by" class="form-control">
                            <?php
                                foreach( $referred_by as $by) {
                            ?>
                                <option value="<?= $by->id ?>"><?= $by->first_name .' '. $by->last_name . ' ['. $by->email .']' ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-primary font-sm text-uppercase font-weight-bold" type="submit" name="submit">Submit</button>
        </form>
    </section>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>