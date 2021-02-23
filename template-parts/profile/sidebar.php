<?php
    $path = basename($_SERVER['PHP_SELF']);
?>
<div id="sidebar-wrapper">
    <div class="list-group list-group-flush">

        <a href="/profile" class="<?= ($path == 'index.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="PROFILE">
            <i class="far fa-user"></i><span class="ml-2">PROFILE</span>
            <i class="fas fa-chevron-right"></i>
        </a>

        <a href="/profile/profile-edit" class="<?= ($path == 'profile-edit.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="EDIT PROFILE">
            <i class="fas fa-edit"></i><span class="ml-2">EDIT PROFILE</span>
            <i class="fas fa-chevron-right"></i>
        </a>

        <?php if($_SESSION['account_type'] != 'business') {?>
        <a href="/profile/forms" class="<?= ($path == 'forms.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="FORMS">
            <i class="fab fa-wpforms"></i><span class="ml-2">FORMS</span>
            <i class="fas fa-chevron-right"></i>
        </a>

        <a href="/profile/application-status" class="<?= ($path == 'application-status.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="APPLICATION STATUS">
            <i class="far fa-question-circle"></i><span class="ml-2">APPLICATION STATUS</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php } ?>

        <a href="/profile/login-information" class="<?= ($path == 'login-information.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="LOGIN INFORMATION">
            <i class="fas fa-globe"></i><span class="ml-2">LOGIN INFORMATION</span>
            <i class="fas fa-chevron-right"></i>
        </a>

        <?php if($_SESSION['account_type'] != 'business') {?>
        <a href="/profile/testimonial" class="<?= ($path == 'testimonial.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="TESTIMONIAL FEEDBACK">
            <i class="fas fa-comments"></i><span class="ml-2">TESTIMONIAL FEEDBACK</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php } ?>

        <a href="/profile/refer-friend" class="<?= ($path == 'refer-friend.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="REFER FRIENDS">
            <i class="fas fa-qrcode"></i><span class="ml-2">REFER FRIENDS</span>
            <i class="fas fa-chevron-right"></i>
        </a>

        <?php if($_SESSION['account_type'] != 'business') {?>
        <a href="https://medexamscenter.com/pages/neac-services" target="_blank" class=" list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="ADD SERVICE">
            <i class="fas fa-shopping-cart"></i><span class="ml-2">ADD SERVICE</span> 
            <i class="fas fa-chevron-right"></i>
        </a>

        <a href="/profile/payment-history" class="<?= ($path == 'payment-history.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="PAYMENT HISTORY">
            <i class="fas fa-history"></i><span class="ml-2">PAYMENT HISTORY</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php } ?>

        <a href="/profile/email-history" class="<?= ($path == 'email-history.php') ? 'active' : '' ?> list-group-item list-group-item-action border-0" data-placement="right" data-toggle="tooltip" title="EMAIL HISTORY">
            <i class="fas fa-at"></i><span class="ml-2">EMAIL HISTORY</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>