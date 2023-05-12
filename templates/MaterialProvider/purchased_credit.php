<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Purchased Credit</h5>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="ibox">
                                <div class="ibox-content product-box">
                                    <div class="product-desc">
                                        <div class="m-t text-righ">

                                            <div class="form-group has-success"><label class="col-sm-2">Purchased Credit</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="my-input"></div>
                                            </div>
                                            &nbsp;
                                            <button class="btn btn-primary btn-block stripeCharge" id="my-button" disabled>Purchased Now</button>
                                            <script src="https://checkout.stripe.com/checkout.js"></script>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('body').on('click', '.stripeCharge', function() {
                                                        // var amount = $(this).data('amount');
                                                        var amount = $('#my-input').val();
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
                                            </script>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>