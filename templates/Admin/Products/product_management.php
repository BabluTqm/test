<div class="row wrapper border-bottom white-bg page-heading" style="margin-top: 12px;">
    <div class="col-lg-10">
        <h2>Products</h2>
    </div>
    <div class="col-lg-2">
        <div class="ibox-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct" style="margin-top: 18px;">
                Add Product
            </button>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">

    <div class="row" id="product-list">
        <div class="sk-spinner sk-spinner-wave hide-spin">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>

        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>SR NO.</th>
                            <th>SERVICE NAME </th>
                            <th>PRODUCT NAME </th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($products as $pro) {
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?php echo $pro->service->service; ?> </td>
                                <td><?php echo $pro->product_name; ?> </td>
                                <td>
                                    <?php echo $this->Html->link(__(''), ['action' => '',], ['class' => 'fa fa-pencil update text-navy', 'data-id' => $pro->id]); ?>
                                    <?php
                                    if ($pro->delete_status == 1) {
                                        echo $this->Form->postLink(__(''), ['controller' => 'Products', 'prefix' => 'Admin', 'action' => 'deleteRecoverProduct', $pro->id], ['class' => 'fa fa-trash delete text-navy', 'id' => 'recycle', 'data-id' => $pro->id]);
                                    } else {
                                        echo $this->Form->postLink(__(''), ['controller' => 'Products', 'prefix' => 'Admin', 'action' => 'deleteRecoverProduct', $pro->id], ['class' => 'fa fa-recycle restore text-navy', 'id' => 'delete', 'data-id' => $pro->id]);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!--===================== modal for adding products  ===================================-->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD PRODUCT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create(null, ['id' => 'addProduct-form']) ?>
                    <fieldset>
                        <?php
                        echo $this->Form->input('product_name', ['id' => 'product_name', 'class' => 'form-control p-2', 'placeholder' => 'Product Name', 'style' => 'border: 1px solid black;']);
                        ?>
                        <label id="exister" class="text-danger " style="margin:10px 0px;"></label>
                        <br>
                        <select class="form-select" name="service_id" id="service_id" aria-label="Default select example" style="border:1px solid black;width:100%;padding:6px;background:white;">
                            <option value="">-- Choose Service --</option>
                            <?php foreach ($services as $list) : ?>
                                <option style="font-size: 14px;" value="<?php echo $list->id ?>"><?= $list->service ?></option>
                            <?php endforeach; ?>
                        </select>
                    </fieldset>
                    <br>
                    <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mt-2']) ?>
                    <?php echo $this->Form->end() ?>
                </div>

            </div>
        </div>
    </div>


    <!--===================== modal for update product details  ===================================-->
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Product Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create(null, ['id' => 'update-form']) ?>
                    <fieldset>
                        <?php
                        echo $this->Form->input('id', ['type' => 'hidden', 'id' => 'product-id', 'class' => 'form-control']);
                        echo $this->Form->input('product_name', ['id' => 'get-product', 'class' => 'form-control p-2', 'style' => 'border: 1px solid black;']);
                        ?>

                    </fieldset>
                    <br>
                    <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mt-2']) ?>
                    <?php echo $this->Form->end() ?>
                </div>

            </div>
        </div>
    </div>