<div class="wrapper wrapper-content">
    <div id="table-hide">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Project Details</h5>
                        <div class="ibox-tools">
                            <!-- <?= $this->Html->link(__('Purchage'), ['controller' => 'Stripes', 'action' => 'stripe', $assigned->user_id], ['class' => 'btn btn-primary']) ?> -->
                            <?php if ($assigned->credit_status == 0) {
                                echo '<button class="btn btn-primary stripeCharge" id="my-button">Purchased Now</button>';
                            } else {
                            }
                            ?>
                            <?= $this->Html->link(__('Back'), ['controller' => 'Contractors', 'action' => 'assignedProjectList'], ['class' => 'btn btn-primary']) ?>

                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">Project Name</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->project_name; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Owner Name</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->user_profile->first_name; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Mobile</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->user_profile->phone; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Email</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->user->email; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Project Address 1</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->project_address1; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Project Address 2</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->project_address2; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">State</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->state; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">City</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->city; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Pin Code</div>
                                    <div class="col-md-6">
                                        <?php echo $assigned->project->pincode; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Services Provided by Contractor</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $count = 0; ?>
                                        <?php foreach ($owner_services as $service) : ?>
                                            <td><?php echo '<b>' . ++$count . '</b>' . "." . $service->service->service ?></td>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="form-control" id="my-input">
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