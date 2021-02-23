<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $result = '';
    if(isset($_POST['submit'])) {
        $body = $_POST;
        $r = $client->request('POST', $api_url. '/api/refer/'.$_SESSION['token'], [
            'headers' =>   [
                        'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                        'Content-Type' => 'application/json',
                        'exceptions' => false
                    ],
            'body' => json_encode($body)
        ]);
        $result = json_decode($r->getBody());
    }
    $get_referred_api = $client->request('GET', $api_url. '/api/getrefer/'.$_SESSION['token'], [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $get_referred = json_decode($get_referred_api->getBody());

    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>
  <section class="position-relative" id="profile-area">
      <div class="container">
            <div class="d-flex">
            <?php  include('../template-parts/profile/sidebar.php'); ?>
            <div class="main-wrapper flex-fill" style="">
            
                <div class="clearfix refer-friend-transaction">
                    <div class="refer-friend-total">
                        <div class="cardboard p-2 text-center">    
                            <strong>Completed: </strong> <strong class="text-success"><?= $get_referred->completed ?></strong>
                        </div>
                    </div>
                    <div class="refer-friend-total">
                        <div class="cardboard p-2 text-center">  
                            <strong>Total Earned: </strong> <strong class="text-success"><?= number_format($get_referred->total_earn, 2) ?></strong>
                        </div>
                    </div>
                    <div class="refer-friend-total">
                        <div class="cardboard p-2 text-center">  
                            <strong>Total Deposit: </strong> <strong class="text-success"><?= number_format($get_referred->total_deposit, 2) ?></strong>
                        </div>
                    </div>
                    <div class="refer-friend-total">
                        <div class="cardboard p-2 text-center">  
                            <strong>Total Balance: </strong> <strong class="text-success"><?= number_format($get_referred->total_balance, 2) ?></strong>
                        </div>
                    </div>
                </div>

                <div class="cardboard p-2">
                    <div class="text-center bg-primary py-3">
                    <?php
                        if($details->user->reseller_code) {
                    ?>
                        <h5 class="text-white mx-auto mb-1 mt-5" style="width: 300px;">
                            Reseller Code: <?= $details->user->reseller_code ?>
                        </h5>

                        <h5 class="text-white mx-auto mb-3 mt-3" style="width: 300px;">
                            Share the link
                        </h5>
                        <div class="p-3 text-white border border-white d-inline-block" style="width: 250px;">
                            <input type="text" value="<?= 'https://'.$_SERVER['HTTP_HOST']; ?>/apply?ref_code=<?= $details->user->reseller_code ?>" class="p-0 border-0 bg-transparent text-white w-100" id="qrInput">
                        </div>
                        <div class="text-center mb-3">
                            <button class="d-block btn btn-primary font-sm mx-auto mt-3" onclick="myFunction()">COPY</button>
                        </div>
                    <?php
                        } else {
                    ?>
                        <div class="mt-5 mb-5">
                            <h4 class="text-white ">
                                In order to create a Reseller Code please login here. 
                                <a class="text-white" style="text-decoration: underline;" href="/login-reseller">Link</a>
                            </h4>
                            <small class="text-white">Note: Email and Password is similar to your current account.</small>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="mt-5">
                    <h4 class="mb-2 d-block">
                        Refer a Friend
                    </h4>
                    <div class="cardboard p-4">
                        <?php if($result) { ?>
                            <div class="alert alert-<?= $result->alert ?> alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?= $result->message; ?>
                            </div>
                        <?php } ?>
                        <form action="" method="POST" class="mb-0">
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <p class="m-0 text-muted">
                                        First Name <span style="color:red;font-size:12px;">*</span>
                                    </p>
                                    <input type="text" class="form-control font-md" name="first_name" value="" required>
                                </div>
                                <div class="col-md-2 form-group">
                                    <p class="m-0 text-muted">
                                        Middle Name
                                    </p>
                                    <input type="text" class="form-control font-md" name="middle_name" value="">
                                </div>
                                <div class="col-md-5 form-group">
                                    <p class="m-0 text-muted">
                                        Last Name <span style="color:red;font-size:12px;">*</span>
                                    </p>
                                    <input type="text" class="form-control font-md" name="last_name" value="" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <p class="m-0 text-muted">
                                        Email Address <span style="color:red;font-size:12px;">*</span>
                                    </p>
                                    <input type="email" class="form-control font-md" name="email" value="" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <p class="m-0 text-muted">
                                        Mobile Number <span style="color:red;font-size:12px;">*</span>
                                    </p>
                                    <input type="text" class="form-control font-md" name="mobile_number" value="" required>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary font-sm mt-2">Add</button>
                        </form>  
                    </div>
                </div>
                <div class="mt-5">
                    <h4 class="mb-2 d-block">
                        Referred Friend Lists
                    </h4>
                    
                    <div class="cardboard scroll-y p-4">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($get_referred->reffered) {   
                                        $count = 1;
                                        foreach($get_referred->reffered as $item) {
                                ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $item->first_name ?></td>
                                            <td><?= $item->middle_name ?></td>
                                            <td><?= $item->last_name ?></td>
                                            <td><?= $item->email ?></td>
                                            <td><?= $item->mobile_number ?></td>
                                        </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="6">No Result</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>                 
                <div class="mt-5">
                    <h4 class="mb-2 d-block">
                        Successful Registered Friend
                    </h4>
                    <div class="cardboard scroll-y p-4">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($get_referred->registered_referred) { 
                                        $count = 1;
                                        foreach($get_referred->registered_referred as $item) {
                                ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name ?></td>
                                            <td><?= $item->email ?></td>
                                            <td><?= $item->mobile_number ?></td>
                                            <td>
                                            <?php
                                                if($item->cart_status == 2) {
                                                    echo '<span class="text-success">Successful Applicant</span>';
                                                    
                                                } else {
                                                    echo '<span class="text-primary">Registered</span>';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                            <tr>
                                                <td colspan="6">No Result</td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                            </tbody>
                        </table>
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