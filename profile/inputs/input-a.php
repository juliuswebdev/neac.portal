<div class="row mx-0">
                                                        <?php if($input->type == 'html') { ?>
                                                        <div class="col-md-12 p-2">
                                                            <?= $input->settings ?>
                                                        </div>
                                                        <?php } else {
                                                            $required = ($input->required) ? 'required' : '';  
                                                            $required_span = ($input->required) ? '<span class="required">*</span>' : '';
                                                        ?>
                                                        
                                                            <div class="col-md-4 p-2">
                                                                <p class="m-0 text-muted">
                                                                    <?= $input->label . ' ' . $required_span ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-8 p-2">

                                                                <?php if($input->type == 'text') { ?>

                                                                    <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                                                <?php } elseif($input->type == 'text_area') { ?>

                                                                    <textarea name="<?= $input->type .'_fi_' .$input->id ?>" class="form-control" rows="4" placeholder="<?= $input->placeholder ?>" <?= $required ?>><?= $input->post ?></textarea>

                                                                <?php } elseif($input->type == 'email') { ?>

                                                                    <input type="email" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                                                <?php } elseif($input->type == 'number') { ?>

                                                                <?php   
                                                                        $settings = array_pad(explode(':::',$input->settings),2,null);
                                                                        $min = $settings[0];
                                                                        $max = $settings[1];
                                                                ?>

                                                                    <input type="number" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control" min="<?= $min ?>" max="<?= $max ?>" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                                                <?php } elseif($input->type == 'url') { ?>

                                                                    <input type="url" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control" placeholder="<?= $input->placeholder ?>" <?= $required ?>>

                                                                    <!-- CONTENT -->

                                                                <?php } elseif($input->type == 'summer_note') { ?>

                                                                    <small style="display: block; margin-bottom: 15px; "><?= $input->placeholder ?></small>
                                                                    <textarea name="<?= $input->type .'_fi_' .$input->id ?>" class="form-control summer_note" rows="4" placeholder="" <?= $required ?>><?= $input->post ?></textarea>

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
                                                                            <input type="file" name="<?= $input->type .'_fi_' .$input->id ?>[]" value="<?= $input->post ?>" class="custom-file-input" accept="<?= $input->settings ?>" multiple>
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
                                                                                <input type="file" name="<?= $input->type .'_fi_' .$input->id ?>[]" value="<?= $input->post ?>" class="custom-file-input" accept="<?= $input->settings ?>" multiple>
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
                                                                                if($value == $input->post) {
                                                                                $selected = 'selected';
                                                                                }
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
                                                                                if(in_array($value, $val_post)) {
                                                                                $checked = 'checked';
                                                                                }
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
                                                                                if($value == $input->post) {
                                                                                $checked = 'checked';
                                                                                }
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
                                                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control input_blank date_picker_js"  data-disable-previous="<?= $input->settings ?>" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                                                        </div>

                                                                    <?php } elseif($input->type == 'time_picker') { ?>

                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                                            </div>
                                                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control input_blank time_picker_js"  placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                                                        </div>

                                                                    <?php } elseif($input->type == 'date_time_picker') { ?>

                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                            </div>
                                                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control input_blank date_time_picker_js" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                                                        </div>

                                                                    <?php } elseif($input->type == 'date_range_picker') { ?>

                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                            </div>
                                                                            <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control input_blank date_range_picker_js" placeholder="<?= $input->placeholder ?>" <?= $required ?> autocomplete="off">
                                                                        </div>

                                                                    <?php } elseif($input->type == 'color_picker') { ?>

                                                                        <div class="input-group color_picker_js colorpicker-element">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-square" style="color: <?= $input->post ?>;"></i></span>
                                                                        </div>
                                                                        <input type="text" name="<?= $input->type .'_fi_' .$input->id ?>" value="<?= $input->post ?>" class="form-control"  placeholder="<?= $input->placeholder ?>" <?= $required ?>>
                                                                        </div>

                                                                    <?php } ?>
                                                            </div>

                                                        <?php } ?>
                                                    </div>