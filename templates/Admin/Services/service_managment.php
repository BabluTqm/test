 <div class="wrapper wrapper-content">

   <div class="row">

     <div class="col-lg-12">
       <div class="ibox float-e-margins">
         <div class="ibox-title">
           <h5>Services </h5>
           <div class="ibox-tools">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
               Add Service
             </button>
           </div>
         </div>
         <div class="ibox-content">
           <div class="row">
             <div class="col-sm-9 m-b-xs">
             </div>
             <div class="col-sm-3">
               <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                   <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
             </div>
           </div>
           <div class="table-responsive">
             <div class="sk-spinner sk-spinner-wave hide-spin">
               <div class="sk-rect1"></div>
               <div class="sk-rect2"></div>
               <div class="sk-rect3"></div>
               <div class="sk-rect4"></div>
               <div class="sk-rect5"></div>
             </div>
             <table class="table table-striped" id="table">
               <thead>
                 <tr>

                   <th>SR NO.</th>
                   <th>SERVICE NAME </th>
                   <th>STATUS </th>
                   <th>ACTION</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $i = 1;
                  if ($services->count() != 0) {
                    foreach ($services as $service) {
                  ?>
                     <tr>
                       <td><?php echo $i++; ?></td>
                       <td><?php echo $service->service ?> </td>
                       <td>
                         <?php
                          if ($service->service_status == 1) {
                          ?>

                           <span class="text">
                             <?php
                              echo '<span class="small text-navy">Active</span>';
                              // echo 'Active';
                              ?>
                           </span>
                         <?php
                          } else {
                          ?>
                           <span class="text">
                           <?php
                            echo '<span class="small text-danger">Deleted</span>';
                          }

                            ?>
                           </span>
                       </td>
                       <td>
                         <?php echo $this->Html->link(__(''), ['action' => '',], ['class' => 'fa fa-pencil edit text-navy', 'data-id' => $service->id]); ?>
                         <?php
                          if ($service->service_status == 1) {
                            echo $this->Form->postLink(__(''), ['controller' => 'Services', 'prefix' => 'Admin', 'action' => 'deleteRecoverService', $service->id], ['class' => 'fa fa-trash delete text-navy', 'id' => 'recycle', 'data-id' => $service->id]);
                          } else {
                            echo $this->Form->postLink(__(''), ['controller' => 'Services', 'prefix' => 'Admin', 'action' => 'deleteRecoverService', $service->id], ['class' => 'fa fa-recycle restore text-navy', 'id' => 'delete', 'data-id' => $service->id]);
                          }
                          ?>
                       </td>
                     </tr>
                   <?php
                    }
                  } else {
                    ?>
                   <tr class="text-center text-muted">
                     <td colspan="4">
                       <h4>No Results to show</h4>
                     </td>
                   </tr>
                 <?php
                  }
                  ?>
               </tbody>
             </table>
           </div>
           <div class=" btn-group text-center page-tab">
             <ul id="pagination-list" class="d-flex">
               <!-- Pagination links will be added dynamically here -->
             </ul>
           </div>

         </div>
       </div>
     </div>

   </div>


 </div>


 <!-- //model -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">ADD SERVICE</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <?php echo $this->Form->create(null, ['id' => 'modal-form']) ?>
         <fieldset>
           <?php
            echo $this->Form->input('service', ['id' => 'service', 'class' => 'form-control p-2', 'style' => 'border: 1px solid black;']);
            ?>
           <span class="service-error" id="service-error"></span>
         </fieldset>
         <br>
         <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mt-2']) ?>
         <?php echo $this->Form->end() ?>
       </div>

     </div>
   </div>
 </div>
 <div class="modal fade" id="edit">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Update Service Details</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <?php echo $this->Form->create(null, ['id' => 'edit-form']) ?>
         <fieldset>
           <legend><?= __('Edit Service') ?></legend>
           <?php
            echo $this->Form->input('id', ['type' => 'hidden', 'id' => 'service-id', 'class' => 'form-control']);
            echo $this->Form->input('service', ['id' => 'get-service', 'class' => 'form-control p-2', 'style' => 'border: 1px solid black;']);
            ?>
           <span class="service-error" id="service_error_edit"></span>
         </fieldset>
         <br>
         <?php echo $this->Form->button(__('Submit'), ['class' => 'edit-form btn btn-primary mt-2']) ?>
         <?php echo $this->Form->end() ?>
       </div>

     </div>
   </div>
 </div>