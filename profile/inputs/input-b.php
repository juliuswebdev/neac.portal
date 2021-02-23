<div class="row mx-0">
                                                        <div class="col-md-4 p-2">
                                                            <p class="m-0 text-muted">
                                                                <?= $input->label ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-8 p-2">

                                                            <?php if($input->type == 'text') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

                                                            <?php } elseif($input->type == 'text_area') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

                                                            <?php } elseif($input->type == 'email') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

                                                            <?php } elseif($input->type == 'number') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

                                                            <?php } elseif($input->type == 'url') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

                                                                <!-- CONTENT -->

                                                            <?php } elseif($input->type == 'summer_note') { ?>

                                                                <?= ($input->post) ? $input->post : '-'; ?>

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
                                                                <?php } else { echo '-'; } ?>

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
                                                                    <?php } else { echo '-'; } ?>

                                                                <!-- SELECT -->

                                                            <?php } elseif($input->type == 'select') { ?>

                                                                <?php
                                                                    $select = explode(':::', $input->settings);
                                                                    if($input->post) {
                                                                ?>

                                                                <?php foreach($select as $item) { ?>
                                                                <?php
                                                                            $select_item = array_pad(explode(' : ',$item),2,null);
                                                                            $value = $select_item[0];
                                                                            $text = $select_item[1];
                                                                            $selected = '';
                                                                            if($value == $input->post) {
                                                                                echo $text;
                                                                            }
                                                                ?>
                                                                <?php
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                ?>


                                                            <?php } elseif($input->type == 'checkbox') { ?>

                                                                <?php
                                                                    $select = explode(':::', $input->settings);
                                                                    $text_temp = '';
                                                                    if($input->post) {
                                                                ?>
                                                                <?php foreach($select as $item) { ?>
                                                                        <?php
                                                                            $select_item = array_pad(explode(' : ',$item),2,null);
                                                                            $value = $select_item[0];
                                                                            $text = $select_item[1];
                                                                            $checked = '';
                                                                            $val_post = explode(',', $input->post);
                                                                            if(in_array($value, $val_post)) {
                                                                                $text_temp .= $text .', ';

                                                                            }
                                                                        ?>
                                                                <?php }
                                                                    echo substr($text_temp, 0, -2);
                                                                    } else {
                                                                        echo '-';
                                                                    } 
                                                                ?> 

                                                            <?php } elseif($input->type == 'radio') { ?>

                                                                    <?php 
                                                                        $select = explode(':::', $input->settings);
                                                                        $count = 1;
                                                                        if($input->post) {
                                                                    ?>
                                                                    <?php foreach($select as $item) { ?>
                                                                    <?php
                                                                                $select_item = array_pad(explode(' : ',$item),2,null);
                                                                                $value = $select_item[0];
                                                                                $text = $select_item[1];
                                                                                $count++;
                                                                                $checked = '';
                                                                                if($value == $input->post) {
                                                                                    echo $text;
                                                                                }
                                                                    ?>
                                                                    <?php
                                                                            }
                                                                        } else {
                                                                            echo '-';
                                                                        } 
                                                                    ?>

                                                                <!-- Javascript -->

                                                                <?php } elseif($input->type == 'date_picker') { ?>

                                                                    <?= ($input->post) ? $input->post : '-'; ?>

                                                                <?php } elseif($input->type == 'time_picker') { ?>

                                                                    <?= ($input->post) ? $input->post : '-'; ?>

                                                                <?php } elseif($input->type == 'date_time_picker') { ?>

                                                                    <?= ($input->post) ? $input->post : '-'; ?>

                                                                <?php } elseif($input->type == 'date_range_picker') { ?>

                                                                    <?= ($input->post) ? $input->post : '-'; ?>

                                                                <?php } elseif($input->type == 'color_picker') { ?>

                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text"><i class="fas fa-square" style="color: <?= $input->post; ?>"></i></div>
                                                                    </div>

                                                                <?php } ?>
                                                        </div>
                                                    </div>