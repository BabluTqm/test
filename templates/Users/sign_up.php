<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>SIGN UP</h3>
        <p>Enter your details to create account.</p>
        <!-- <form class="m-t" role="form" action="/users/login" id="form" method="post"> -->
        <?php echo $this->Form->create(null, ['id' => 'form']) ?>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="First Name" id="user-profile-first-name" name="user_profile[first_name]" maxlength="255">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Last Name" id="user-profile-last-name" name="user_profile[last_name]" maxlength="100">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" id="email" name="email" maxlength="250">
        </div>

        <div class="form-group text-left">
            <label class="choose">Choose User Type</label><br>

            <label for="user-type-1"> <input type="radio" value="1" id="user-type-1" name="user_type">Owner</label><br>
            <label for="user-type-2"> <input type="radio" value="2" id="user-type-2" name="user_type">General Contractor</label><br>
            <label for="user-type-3"> <input type="radio" value="3" id="user-type-3" name="user_type">Sub-Contractor</label><br>
            <label for="user-type-4"> <input type="radio" value="4" id="user-type-4" name="user_type">Material-Provider</label><br>
            <span style="color:red;"><?php echo $error; ?></span>
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b" id="load">SIGN UP</button>

        <p class="text-muted text-center"><small>Already have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="/users/login">SIGN IN</a>
        <?php echo $this->Form->end() ?>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>