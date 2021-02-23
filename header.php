<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>NEAC Medical Exams Application Center</title>
        <link rel="stylesheet" href="/node_modules/css/admin.css">
        <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="/node_modules/assets/fonts/fonts.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="/node_modules/plugins/font-awesome/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="/node_modules/plugins/slick/slick.css">
        <link rel="stylesheet" href="/node_modules/plugins/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="/node_modules/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/node_modules/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="/node_modules/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/node_modules/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/node_modules/plugins//select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="/node_modules/css/styles.css">
        <link rel="stylesheet" href="/style.css">
        <link rel="icon" href="<?= $api_url ?>/img/icon.png" sizes="32x32" />
    </head>
    <body>
        <?php  if(isset($_SESSION['token']) && $current_file != 'login-reseller') { ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-0">
            <div class="container">
                <a class="navbar-brand my-auto" href="/">
                    <img src="/node_modules/assets/img/logo.png" alt="" style="width: 140px;">
                </a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item p-0 position-relative">
                        <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink2" data-toggle="dropdown">
                            <div class="float-left">
                            <?php
                                    $profile = '';
                                    if($details->user->profile->image) {
                                        $profile = $api_url. '/documents/'.$details->user->profile->image;
                                    } else {
                                        $profile = '/node_modules/assets/img/profile.jpg';
                                    }
                                ?>
                                <img src="<?= $profile ?>" class="rounded-circle" style="width: 35px;height: 35px;object-fit: cover;">
                            </div>
                            <div class="float-left pt-1 d-none d-md-inline-block font-sm" style="padding-left: 15px; padding-top: 8px!important;">
                                <?php
                                    echo $details->user->first_name. ' ' .$details->user->last_name;
                                ?>
                                <i class="fas fa-chevron-down ml-1"></i>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink2">
                            <a class="dropdown-item font-sm" href="/profile"><i class="fas fa-user mr-2"></i>Account Profile</a>
                            <a class="dropdown-item text-danger font-sm" href="/profile/logout">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <?php } ?>