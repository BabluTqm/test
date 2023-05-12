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
                                        <a href="/Contractors/purchasedCredit" class="product-price">Purchased Credit</a>
                                        <!-- <small class="text-muted">Category</small>
                                        <a href="#" class="product-name"> Product</a>
                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a> -->



                                       <!--  <input type="number" id="kkkk">
                                        <button class="btn btn-primary btn-block stripeCharge" data-amount="100">Purchased Now</button>
                                        <script src="https://checkout.stripe.com/checkout.js"></script>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('body').on('click', '.stripeCharge', function() {
                                                    // var amount = $(this).data('amount');
                                                    var amount = $('#kkkk').val();
                                                    var handler = StripeCheckout.configure({
                                                        key: 'pk_test_5f6jfFP2ZV5U9TXQYG0vtqFJ00eFVWNoRX', // your publisher key id
                                                        locale: 'auto',
                                                        token: function(token) {
                                                            // You can access the token ID with `token.id`.
                                                            // Get the token ID to your server-side code for use.
                                                            // console.log('Token Created!!');
                                                            // console.log(token)
                                                            // $('#token_response').html(JSON.stringify(token));
                                                            $.ajax({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': csrfToken
                                                                },
                                                                url: "/payment",
                                                                method: 'post',
                                                                data: {
                                                                    tokenId: token.id,
                                                                    amount: amount,
                                                                },
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    // console.log(response.data);
                                                                    if (response.data['status'] == 'succeeded') {
                                                                        swal("Good job!", "Your credit has been successfully!", "success");
                                                                    }
                                                                }
                                                            })
                                                        }
                                                    });
                                                    handler.open({
                                                        name: 'Demo Site',
                                                        description: '2 widgets',
                                                        amount: amount * 100
                                                    });
                                                });
                                            });
                                        </script> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>