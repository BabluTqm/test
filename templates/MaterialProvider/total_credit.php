<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ibox">
                                <div class="ibox-content product-box">
                                    <div class="product-imitation">
                                        <h1 class="text-navy">Total Credit :</h1>
                                        <?php
                                    //   dd($result->contractor_credit->total_credit);
                                       if(!empty($result->contractor_credit->total_credit)){
                                           echo '$'. $result->contractor_credit->total_credit ;
                                           
                                        }else {
                                           echo 'no Balance';
                                       
                                        } ?></h2>
                                    </div>
                                    <div class="product-desc">
                                        <a href="/materialProvider/purchasedCredit" class="product-price">Purchased Credit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>