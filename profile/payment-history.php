<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/config/global.php';
    $rd = $client->request('GET', $api_url. '/api/getpaymenthistory/'.$details->user->email, [
        'headers' =>   [
                    'neac' => 'Token M24dN00RacN77TaNLTM16e27TKNa84bb36KR13M3aL9b21M34KcM8OaRK7aKOM58',
                    'Content-Type' => 'application/json',
                    'exceptions' => false
                ],
    ]);
    $payment_method = json_decode($rd->getBody());
    $shopify = $payment_method->shopify;
    $offline = $payment_method->offline;
    $status = (array) $payment_method->cart;
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>
  <section class="position-relative" id="profile-area">
      <div class="container">
          <div class="d-flex">
                <?php  include('../template-parts/profile/sidebar.php'); ?>
                <div  class="main-wrapper flex-fill w-100">
                    <div style="">
                        <h4 class="mb-2 d-block">Website Transactions <img src="https://cdn.shopify.com/assets/images/logos/shopify-bag.png" width="20" alt=""></h4>
                        <div class="transaction-content">
                            <ul class="nav nav-tabs nav-tabs-neac border-0">
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent active" data-toggle="tab" href="#all">
                                        <span class="badge badge-primary px-3 rounded mb-2 font-sm">ALL</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent" data-toggle="tab" href="#pending">
                                        <span class="badge badge-danger px-3 rounded mb-2 font-sm">Pending</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent" data-toggle="tab" href="#for_approve">
                                        <span class="badge badge-warning px-3 rounded mb-2 font-sm">FOR APPROVED</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent" data-toggle="tab" href="#finance_approved">
                                        <span class="badge badge-success px-3 rounded mb-2 font-sm">FINANCE APPROVED</span>
                                    </a>
                                </li>
                            </ul>
                            <?php 
                                if($shopify) {
                            ?>
                                <div class="tab-content p-0">
                                    <?php
                                        $count = 0;
                                        foreach($shopify as $cart) {
                                            $count++;  
                                            $status_class = '';
                                            $status_color = '#fff';

                                            if($cart->financial_status == 'paid') {
                                                $status_class = 'for_approve'; 
                                                $status_color = '#fff5d6';
                                            }
                                            else if ($cart->financial_status == 'pending') {
                                                $status_class = 'pending';
                                                $status_color = '#f0cccf';
                                            }
                                            
                                            if (array_key_exists($cart->name, $status)) {
                                                if($status[$cart->name] == 1) {
                                                    $status_class = 'for_approve'; 
                                                    $status_color = '#fff5d6';
                                                } else if ($status[$cart->name] == 2) {
                                                    $status_class = 'finance_approved'; 
                                                    $status_color = '#bcddc4';
                                                }
                                            }
                                            
                                    ?>
                                            <div class="all <?= $status_class ?>">
                                                <a  style="background-color: <?= $status_color ?>" class="cardboard mt-0 p-3 text-decoration-none d-block collapsed mb-1" data-toggle="collapse" href="#collapsenclex<?= $count ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <div class="float-left">
                                                        <h5 class="mb-0"><?= $cart->name ?></h5>
                                                        <small title="Purchased this day" class="mr-3"><i class="fas fa-clock mr-1"></i> <?= date('F jS Y h:i:s A', strtotime($cart->created_at));?></small>
                                                        <small title="Merchant"><i class="fas fa-money mr-1"></i> <?= $cart->gateway ?></small>
                                                        <?php if($cart->note) { ?>
                                                            <i class="fas fa-sticky-note ml-3"></i>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="float-right text-center">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                                <div class="collapse" id="collapsenclex<?= $count ?>"  style="background-color: #fff; margin-bottom: 25px; padding: 10px;">
                                                    <table class="table table-striped table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Services</th>
                                                                <th style="width: 120px">Price <?= $cart->currency ?></th>
                                                                <th style="width: 120px"><small>Presentment</small><br>Price <?= $cart->presentment_currency ?></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            if($cart->line_items) {
                                                        ?>
                                                            <tbody>
                                                                <?php
                                                                foreach($cart->line_items as $item) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $item->title ?> <br><small><?= $item->variant_title ?></small></td>
                                                                        <td><?= $item->price_set->shop_money->amount ?></td>
                                                                        <td><?= $item->price_set->presentment_money->amount ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th style="border: none;">Sub Total</th>
                                                                    <th style="border: none;"><?= $cart->subtotal_price_set->shop_money->amount ?></th>
                                                                    <th style="border: none;"><?= $cart->subtotal_price_set->presentment_money->amount ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border: none;">Tax</th>
                                                                    <th style="border: none;"><?= $cart->total_tax_set->shop_money->amount ?></th>
                                                                    <th style="border: none;"><?= $cart->total_tax_set->presentment_money->amount ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th><?= $cart->total_price_set->shop_money->amount ?></th>
                                                                    <th><?= $cart->total_price_set->presentment_money->amount ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Payed</th>
                                                                    <th><?= $cart->total_price_set->shop_money->amount ?></th>
                                                                    <th><?= $cart->total_price_set->presentment_money->amount ?></th>
                                                                </tr>
                                                            </tfoot>
                                                        <?php
                                                            }
                                                        ?>
                                                    </table>
                                                    <?php if($cart->note) { ?>
                                                        <p class="p-3 mb-0"><strong>Note : </strong><?= $cart->note ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php
                                            }
                                    ?>
                                </div>
                            <?php
                                } else {
                            ?>
                                <div class="p-3 bg-white">
                                    <strong>No transaction as this moment!</strong>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div style="margin: 40px 12px 0;">
                        <h4 class="mb-2 d-block">Offline Transactions</h4>
                        <div class="transaction-content">
                            <ul class="nav nav-tabs nav-tabs-neac border-0">
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent active" data-toggle="tab" href="#all">
                                        <span class="badge badge-primary px-3 rounded mb-2 font-sm">ALL</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent" data-toggle="tab" href="#for_approve">
                                        <span class="badge badge-warning px-3 rounded mb-2 font-sm">FOR APPROVED</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-0 bg-transparent" data-toggle="tab" href="#finance_approved">
                                        <span class="badge badge-success px-3 rounded mb-2 font-sm">FINANCE APPROVED</span>
                                    </a>
                                </li>
                            </ul>
                            <?php 
                                if($offline) {
                            ?>
                                <div class="tab-content p-0">
                                    <?php
                                        $count = 0;
                                        foreach($offline as $cart) {
                                            $count++;  
                                            $status_class = '';
                                            $status_color = '#fff';
                                            
                                            if (array_key_exists($cart->order_no, $status)) {
                                                if($status[$cart->order_no] == 1) {
                                                    $status_class = 'for_approve'; 
                                                    $status_color = '#fff5d6';
                                                } else if ($status[$cart->order_no] == 2) {
                                                    $status_class = 'finance_approved'; 
                                                    $status_color = '#bcddc4';
                                                }
                                            }
                                            
                                    ?>
                                            <div class="all <?= $status_class ?>">
                                                <a  style="background-color: <?= $status_color ?>" class="cardboard mt-0 p-3 text-decoration-none d-block collapsed mb-1" data-toggle="collapse" href="#olfcollapsenclex<?= $count ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <div class="float-left">
                                                        <h5 class="mb-0"><?= $cart->order_no ?></h5>
                                                        <small title="Purchased this day" class="mr-3"><i class="fas fa-clock mr-1"></i> <?= date('F jS Y h:i:s A', strtotime($cart->payed_at));?></small>
                                                        <?php if($cart->notes) { ?>
                                                            <i class="fas fa-sticky-note"></i>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="float-right text-center">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                                <div class="collapse" id="olfcollapsenclex<?= $count ?>"  style="background-color: #fff; margin-bottom: 25px; padding: 10px;">
                                                    <table class="table table-striped table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Services</th>
                                                                <th style="width: 120px">Price <?= $cart->currency ?></th>
                                                            </tr>
                                                        </thead>
                                                            <?php $line_items = json_decode($cart->items); ?>
                                                            <tbody>
                                                                <?php
                                                                    if(isset($line_items->lineItems)) {
                                                                        foreach($line_items->lineItems as $item) {
                                                                ?>
                                                                        <tr>
                                                                            <td><?= $item->title ?> <br><small><?= $item->variant->title ?></small></td>
                                                                            <td><?= $item->variant->price ?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                    } else {
                                                                ?>
                                                                    <tr>
                                                                        <td colspan="2">No Service</td>
                                                                    </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th style="border: none;">Sub Total</th>
                                                                    <th style="border: none;"><?= $line_items->subtotalPrice ?></th>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <th style="border: none;">Tax</th>
                                                                    <th style="border: none;"><?= $line_items->totalTax ?></th>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th><?= $line_items->totalPrice ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Payed</th>
                                                                    <th><?= (is_int($cart->total)) ? $cart->total . '.00' : $cart->total  ?></th>
                                                                </tr>
                                                            </tfoot>
                                                    </table>
                                                    <?php if($cart->notes) { ?>
                                                        <p class="p-3 mb-0"><strong>Note : </strong><?= $cart->notes ?></p>
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                    <?php
                                            }
                                    ?>
                                </div>
                            <?php
                                } else {
                            ?>
                                <div class="p-3 bg-white">
                                    <strong>No transaction as this moment!</strong>
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