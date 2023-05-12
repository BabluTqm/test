$(document).ready(function () {
    jQuery.validator.addMethod(
        "noSpace",
        function (value, element) {
            return value == "" || value.trim().length != 0;
        },
        "No space please fill the Character"
    );

    /******************Search Function***************/
    // $("#key").on("keyup", function() {
    //   var value = $(this).val().toLowerCase();
    //   $("td").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });

    // $("#key").on("keyup", function () {
    //     var value = $(this).val().toLowerCase();
    //     $("#myTable tr").filter(function () {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    //     });
    // });

    /*****************************Password Method ********************************/
    jQuery.validator.addMethod(
        "Uppercase",
        function (value) {
            return /[A-Z]/.test(value);
        },
        "Your Password must contain at least one UpperCase Character"
    );

    jQuery.validator.addMethod(
        "lowercase",
        function (value) {
            return /[a-z]/.test(value);
        },
        "Your Password must contain at least one Lower Character"
    );

    jQuery.validator.addMethod(
        "specialChar",
        function (value) {
            return /[!@#$%&*_-]/.test(value);
        },
        "Your Password must contain at least one Special Character"
    );

    jQuery.validator.addMethod(
        "Numberic",
        function (value) {
            return /[0-9]/.test(value);
        },
        "Your Password must contain at least one Numeric Value"
    );

    /********************************************************************************/
    jQuery.validator.addMethod(
        "lettersonly",
        function (value, element) {
            return this.optional(element) || /^[a-z]/i.test(value);
        },
        "**Please Letters only Not fill Space"
    );

    //register form validation

    $("#form").validate({
        rules: {
            project_name: "required",
            "user_profile[first_name]": "required",
            state: "required",
            city: "required",
            project_address1: { required: true },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },

            password: {
                required: true,
                noSpace: true,
                Uppercase: true,
                lowercase: true,
                specialChar: true,
                Numberic: true,
            },

            email: {
                required: true,
                noSpace: true,
            },
        },

        messages: {
            project_name: {
                required: "Please enter the project name",
            },
            "user_profile[first_name]": {
                required: "Please enter the owner name",
            },
            state: {
                required: "Please enter the state of project",
            },
            city: {
                required: "Please enter the city of project",
            },
            project_address1: {
                required: "Please enter the address of project",
            },
            pincode: {
                required: "Please enter the pincode of project area",
            },
            email: {
                required: "Please enter a email",
                email: "Please enter valid email",
            },

            password: {
                required: "Please enter a password",
            },
        },

        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#owner-update").validate({
        rules: {
            project_name: "required",
            "user_profile[first_name]": "required",
            state: "required",
            city: "required",
            project_address1: { required: true },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },

            password: {
                required: true,
                noSpace: true,
                Uppercase: true,
                lowercase: true,
                specialChar: true,
                Numberic: true,
            },

            email: {
                required: true,
                noSpace: true,
            },
        },

        messages: {
            project_name: {
                required: "Please enter the project name",
            },
            "user_profile[first_name]": {
                required: "Please enter the owner name",
            },
            state: {
                required: "Please enter the state of project",
            },
            city: {
                required: "Please enter the city of project",
            },
            project_address1: {
                required: "Please enter the address of project",
            },
            pincode: {
                required: "Please enter the pincode of project area",
            },
            email: {
                required: "Please enter a email",
                email: "Please enter valid email",
            },

            password: {
                required: "Please enter a password",
            },
        },

        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/users/owner-profile",
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "Details Has been updated Successfully!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/projects/requested-project-list";
                        });
                    }
                },
            });
            return false;
        },
    });

    $("#update-unassign-project").validate({
        rules: {
            project_name: "required",
            "user_profile[first_name]": "required",
            state: "required",
            city: "required",
            project_address1: { required: true },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },

            password: {
                required: true,
                noSpace: true,
                Uppercase: true,
                lowercase: true,
                specialChar: true,
                Numberic: true,
            },

            email: {
                required: true,
                noSpace: true,
            },
        },

        messages: {
            project_name: {
                required: "Please enter the project name",
            },
            "user_profile[first_name]": {
                required: "Please enter the owner name",
            },
            state: {
                required: "Please enter the state of project",
            },
            city: {
                required: "Please enter the city of project",
            },
            project_address1: {
                required: "Please enter the address of project",
            },
            pincode: {
                required: "Please enter the pincode of project area",
            },
            email: {
                required: "Please enter a email",
                email: "Please enter valid email",
            },

            password: {
                required: "Please enter a password",
            },
        },

        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/projects/projectView/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "Details Has been updated Successfully!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/projects/projectView/" + id;
                        });
                    }
                },
            });
            return false;
        },
    });

    $("#assign-form").validate({
        rules: {
            project_name: "required",
            "user_profile[first_name]": "required",
            state: "required",
            city: "required",
            project_address1: { required: true },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },

            password: {
                required: true,
                noSpace: true,
                Uppercase: true,
                lowercase: true,
                specialChar: true,
                Numberic: true,
            },

            email: {
                required: true,
                noSpace: true,
            },
        },

        messages: {
            project_name: {
                required: "Please enter the project name",
            },
            "user_profile[first_name]": {
                required: "Please enter the owner name",
            },
            state: {
                required: "Please enter the state of project",
            },
            city: {
                required: "Please enter the city of project",
            },
            project_address1: {
                required: "Please enter the address of project",
            },
            pincode: {
                required: "Please enter the pincode of project area",
            },
            email: {
                required: "Please enter a email",
                email: "Please enter valid email",
            },

            password: {
                required: "Please enter a password",
            },
        },

        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/projects/projectAssignView/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "Details Has been updated Successfully!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/projects/assignProject";
                        });
                    }
                },
            });
            return false;
        },
    });

    $("#admin-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            "user_services[][service_id]": {
                required: true,
            },
            "user_profile[first_name]": "required",
            "user_profile[last_name]": "required",
            "user_profile[phone]": "required",
            "user_profile[address1]": "required",
            "user_profile[state]": "required",
            "user_profile[city]": "required",
            "user_profile[pincode]": {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6,
            },
            "user_profile[company_name]": "required",
        },

        messages: {
            email: {
                required: "Please enter the project name",
                email: "Please enter a valid email",
            },
            "user_profile[first_name]": "Please enter first name",
            "user_profile[last_name]": "Please enter  last name",
            "user_profile[phone]": "Please enter  contact number",
            "user_profile[address1]": "Please enter address",
            "user_profile[state]": "Please enter state",
            "user_profile[city]": "Please enter city",
            "user_profile[pincode]": {
                required: "Please enter pincode",
                minlength: "Pincode Must be 6 digit",
                maxlength: "Pincode Must be 6 digit",
            },
            "user_profile[company_name]":
                "Please enter contarctor's company name",
            "user_services[][service_id]": {
                required: "Please select atleast one service",
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/users/ownerEdit/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "User details Has been updated!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/users/ownerManagement";
                        });
                    }
                },
            });
            return false;
        },
    });

    $("#gc-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            "user_services[][service_id]": {
                required: true,
            },
            "user_profile[first_name]": "required",
            "user_profile[last_name]": "required",
            "user_profile[phone]": "required",
            "user_profile[address1]": "required",
            "user_profile[state]": "required",
            "user_profile[city]": "required",
            "user_profile[pincode]": {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6,
            },
            "user_profile[company_name]": "required",
        },

        messages: {
            email: {
                required: "Please enter the project name",
                email: "Please enter a valid email",
            },
            "user_profile[first_name]": "Please enter first name",
            "user_profile[last_name]": "Please enter  last name",
            "user_profile[phone]": "Please enter  contact number",
            "user_profile[address1]": "Please enter address",
            "user_profile[state]": "Please enter state",
            "user_profile[city]": "Please enter city",
            "user_profile[pincode]": {
                required: "Please enter pincode",
                minlength: "Pincode Must be 6 digit",
                maxlength: "Pincode Must be 6 digit",
            },
            "user_profile[company_name]":
                "Please enter contarctor's company name",
            "user_services[][service_id]": {
                required: "Please select atleast one service",
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/contractor/generalContractorEdit/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "User details Has been updated!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/contractor/generalListing";
                        });
                    }
                },
            });
            return false;
        },
    });

    $("#sc-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            "user_services[][service_id]": {
                required: true,
            },
            "user_profile[first_name]": "required",
            "user_profile[last_name]": "required",
            "user_profile[phone]": "required",
            "user_profile[address1]": "required",
            "user_profile[state]": "required",
            "user_profile[city]": "required",
            "user_profile[pincode]": {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6,
            },
            "user_profile[company_name]": "required",
        },

        messages: {
            email: {
                required: "Please enter the project name",
                email: "Please enter a valid email",
            },
            "user_profile[first_name]": "Please enter first name",
            "user_profile[last_name]": "Please enter  last name",
            "user_profile[phone]": "Please enter  contact number",
            "user_profile[address1]": "Please enter address",
            "user_profile[state]": "Please enter state",
            "user_profile[city]": "Please enter city",
            "user_profile[pincode]": {
                required: "Please enter pincode",
                minlength: "Pincode Must be 6 digit",
                maxlength: "Pincode Must be 6 digit",
            },
            "user_profile[company_name]":
                "Please enter contarctor's company name",
            "user_services[][service_id]": {
                required: "Please select atleast one service",
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/contractor/subContractorEdit/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "User details Has been updated!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/contractor/subListing";
                        });
                    }
                },
            });
            return false;
        },
    });

    //======================== update mp profile by admin ==================
    $("#mp-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            "user_product[][product_id]": {
                required: true,
            },
            "user_profile[first_name]": "required",
            "user_profile[last_name]": "required",
            "user_profile[phone]": "required",
            "user_profile[address1]": "required",
            "user_profile[state]": "required",
            "user_profile[city]": "required",
            "user_profile[pincode]": {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6,
            },
            "user_profile[company_name]": "required",
        },

        messages: {
            email: {
                required: "Please enter the project name",
                email: "Please enter a valid email",
            },
            "user_profile[first_name]": "Please enter first name",
            "user_profile[last_name]": "Please enter  last name",
            "user_profile[phone]": "Please enter  contact number",
            "user_profile[address1]": "Please enter address",
            "user_profile[state]": "Please enter state",
            "user_profile[city]": "Please enter city",
            "user_profile[pincode]": {
                required: "Please enter pincode",
                minlength: "Pincode Must be 6 digit",
                maxlength: "Pincode Must be 6 digit",
            },
            "user_profile[company_name]": "Please enter MP's company name",
            "user_product[][product_id]": {
                required: "Please select atleast one product",
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(".pr");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#idd").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/contractor/mpEdit/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        // alert(data["message"]);
                        swal("Error!", "User details not updated!", "error");
                    } else {
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "User details Has been updated!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/contractor/mpListing";
                        });
                    }
                },
            });
            return false;
        },
    });

    //===================== select products to mp profile which product he provides ==================
    $(".choose").on("change", function () {
        var uid = $("#user").val();
        var id = $(this).val();
        $.ajax({
            url: "/admin/contractor/deteleProduct",
            type: "JSON",
            method: "get",
            data: { id: id, uid: uid },
            success: function (response) {
                if (response == 1) {
                    $(".choose").checked = false;
                }
            },
        });
        return false;
    });

    $(document).on("click", ".accept-request", function () {
        var csrfToken = $('meta[name="csrfToken"]').attr("content");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken, // this is defined in app.php as a js variable
            },
        });
        var postdata = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You want to accept this project!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".hide-spin").show();
                $.ajax({
                    url: "/admin/projects/accectOwnerProject/" + postdata,
                    data: postdata,
                    type: "JSON",
                    method: "post",
                    success: function (response) {
                        $(".approve-request").load(
                            location.href + " .approve-request"
                        );
                        $(".approve-sc").load(location.href + " .approve-sc");
                        swal(
                            "User is approved successfully and mail sent!",
                            "success!",
                            "success"
                        );
                    },
                });
            }
        });
    });
});

/*********************Dashboard Owner Date Filter******************* */
// $("#datepicker").datepicker('show');

$("#submitAction").on("click", function (e) {
    e.preventDefault();
    var csrfToken = $('meta[name="csrfToken"]').attr("content");
    var startdate = $("#startDate").val();
    var enddate = $("#endDate").val();
    if (startdate != "" && enddate != "") {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/admin/users/ownerDateFilter",
            type: "JSON",
            method: "GET",
            data: {
                startdate: startdate,
                enddate: enddate,
            },
            success: function (response) {
                // alert(response);
                var data = JSON.parse(response);
                if (data["status"] == 1) {
                    var response = data.results;
                    var len = response.length;
                    // $("#fffff").html("");

                    var tabel_html = "";
                    if (len == 0) {
                        tabel_html +=
                            "<tr class = 'table'><td><b>No records found</b></td></tr>";
                    } else {
                        for (var i = 0; i < len; i++) {
                            var first_name =
                                response[i]["user_profile"].first_name;
                            var last_name =
                                response[i]["user_profile"].last_name;
                            var id = response[i].id;
                            var email = response[i].email;
                            var phone = response[i]["user_profile"].phone;
                            var created_at = response[i].created_at;
                            j = i + 1;
                            tabel_html +=
                                "<tr class = 'table'><td>" +
                                j +
                                "</td><td>" +
                                first_name +
                                " " +
                                last_name +
                                "</td><td>" +
                                email +
                                "</td><td>" +
                                phone +
                                "</td><td>" +
                                created_at +
                                "</td><td><a href='/admin/users/ownerEdit/" +
                                id +
                                "' class='fa fa-eye text-navy' data-toggle='tooltip' title='view' id='" +
                                id +
                                "'></a></td></tr>";
                        }
                    }
                    $("#fffff").html(tabel_html);
                } else {
                    alert("error");
                }
                return false;
            },
        });
    }
});
/******************UnAssign Date Picker********************/
$("#submit").on("click", function (e) {
    e.preventDefault();
    var csrfToken = $('meta[name="csrfToken"]').attr("content");
    var startdate = $("#startDate").val();
    var enddate = $("#endDate").val();
    if (startdate != "" && enddate != "") {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/admin/projects/unAssignDateFilter",
            type: "JSON",
            method: "GET",
            data: {
                startdate: startdate,
                enddate: enddate,
            },
            success: function (response) {
                // alert(response);
                var data = JSON.parse(response);
                if (data["status"] == 1) {
                    var response = data.results;
                    var len = response.length;
                    // $("#fffff").html("");
                    var tabel_html = "";
                    if (len == 0) {
                        tabel_html +=
                            "<tr class = 'table'><td class='text-center' colspan = '5'>No records found</td></tr>";
                    } else {
                        for (var i = 0; i < len; i++) {
                            var project_name = response[i].project_name;
                            var first_name =
                                response[i]["user_profile"].first_name;
                            var last_name =
                                response[i]["user_profile"].last_name;
                            var id = response[i].id;
                            // var email = response[i].email;
                            // var phone = response[i]["user_profile"].phone;
                            var created_at = response[i].created_date;
                            j = i + 1;
                            tabel_html +=
                                "<tr class = 'table'><td>" +
                                j +
                                "</td><td>" +
                                project_name +
                                "</td><td>" +
                                first_name +
                                " " +
                                last_name +
                                "</td><td>" +
                                created_at +
                                "</td><td><a href='/admin/projects/projectView/" +
                                id +
                                "' class='fa fa-eye text-navy' data-toggle='tooltip' title='view' id='" +
                                id +
                                "'><a href='/admin/projects/unassignProjectDeleteRecover/" +
                                id +
                                "'class='fa fa-trash delete'" +
                                "></td></tr >";
                        }
                    }
                    $("#unassignProject").html(tabel_html);
                } else {
                    alert("error");
                }
                return false;
            },
        });
    }
});
/**************************************/
/***********sweet alert show******** */
// proxy swal

$(".proxy").attr("onclick", "").unbind("click");
$(".proxy").on("click", function (e) {
    e.preventDefault();
    let proxy_form = $(this).parent().find("form");
    swal({
        title: "proxylogin",
        text: "Are sure You want to login with  this user",
        icon: "warning",
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            proxy_form.submit();
        }
    });
});
// active swal
$(".active").attr("onclick", "").unbind("click");
$(".active").on("click", function (e) {
    e.preventDefault();
    let inactive_form = $(this).parent().find("form");
    swal({
        title: "Inactive",
        text: "Are sure You want to inactive this user",
        icon: "warning",
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(".hide-spin").show();
            inactive_form.submit();
        }
    });
});

$(".inactive").attr("onclick", "").unbind("click");
$(".inactive").on("click", function (e) {
    e.preventDefault();
    let active_form = $(this).parent().find("form");
    swal({
        title: "Active",
        text: "Are sure You want to active this user",
        icon: "warning",
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(".hide-spin").show();
            active_form.submit();
        }
    });
});

$(".delete").attr("onclick", "").unbind("click");
$(".delete").on("click", function (e) {
    // alert("hh");
    e.preventDefault();
    let delete_form = $(this).parent().find("form");
    swal({
        title: "Delete",
        text: "Are sure You want to delete",
        icon: "warning",
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(".hide-spin").show();
            delete_form.submit();
            swal("Deleted successfully!", "success!", "success");
        }
    });
});

$(".restore").attr("onclick", "").unbind("click");
$(".restore").on("click", function (e) {
    e.preventDefault();
    let restore_form = $(this).parent().find("form");
    swal({
        title: "Restore",
        text: "Are sure You want to restore",
        icon: "warning",
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(".hide-spin").show();
            restore_form.submit();
            swal("Restored successfully!", "success!", "success");
        }
    });
});

/****************Pagination on Dashboard And All*************** */
// Set the number of rows per page
var rowsPerPage = 5;

$(document).ready(function () {
    // Hide all rows except the first rowsPerPage rows
    $("#table tbody tr").hide();
    $("#table tbody tr").slice(0, rowsPerPage).show();

    // Add pagination links
    var numRows = $("#table tbody tr").length;
    var numPages = Math.ceil(numRows / rowsPerPage);
    for (var i = 1; i <= numPages; i++) {
        if (i == 1) {
            $("#pagination-list").append(
                "<li class='btn btn-white active' data-page='" +
                    i +
                    "'><a href='#'> <i class='fa fa-chevron-left'></a></li>"
            );
        }
        $("#pagination-list").append(
            "<li class='btn btn-white' data-page='" +
                i +
                "'><a href='#'>" +
                i +
                "</a></li>"
        );
        if (i == numPages) {
            $("#pagination-list").append(
                "<li class='btn btn-white' data-page='" +
                    i +
                    "'><a href='#'><i class='fa fa-chevron-right'></a></li>"
            );
        }
    }
    $("#pagination-list li:first-child").addClass("active");

    // Set up click event for pagination links
    $("#pagination-list li").click(function (event) {
        event.preventDefault();
        var pageNum = $(this).data("page");
        var startRow = (pageNum - 1) * rowsPerPage;
        var endRow = startRow + rowsPerPage;
        $("#table tbody tr").hide();
        $("#table tbody tr").slice(startRow, endRow).show();
        $("#pagination-list li").removeClass("active");
        $(this).addClass("active");
    });

    // Set up search button click event
    $("#search-input").keyup(function () {
        var searchText = $("#search-input").val().toLowerCase();
        $("#table tbody tr")
            .hide()
            .filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) != -1;
            })
            .slice(0, rowsPerPage)
            .show();
        $("#pagination-list li").removeClass("active");
        $("#pagination-list li:first-child").addClass("active");
    });

    // Sort table by column on header click
    $("#table th").click(function () {
        var table = $(this).parents("table").eq(0);
        var rows = table
            .find("tr:gt(0)")
            .toArray()
            .sort(comparer($(this).index()));
        this.asc = !this.asc;
        if (!this.asc) {
            rows = rows.reverse();
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        }
    });

    // Compare function for sorting
    function comparer(index) {
        return function (a, b) {
            var valA = getCellValue(a, index),
                valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB)
                ? valA - valB
                : valA.toString().localeCompare(valB);
        };
    }

    // Get cell value for sorting
    function getCellValue(row, index) {
        return $(row).children("td").eq(index).text();
    }
});

/*********************Pagination on DashBoard GC/SC************************ */
var rowsPerPage = 5;

$(document).ready(function () {
    // Hide all rows except the first rowsPerPage rows
    $("#gs-sc tbody tr").hide();
    $("#gs-sc tbody tr").slice(0, rowsPerPage).show();

    // Add pagination links
    var numRows = $("#gs-sc tbody tr").length;
    var numPages = Math.ceil(numRows / rowsPerPage);
    for (var i = 1; i <= numPages; i++) {
        if (i == 1) {
            $("#pagination-list-gc-sc").append(
                "<li class='btn btn-white active' data-page='" +
                    i +
                    "'><a href='#'> <i class='fa fa-chevron-left'></a></li>"
            );
        }
        $("#pagination-list-gc-sc").append(
            "<li class='btn btn-white' data-page='" +
                i +
                "'><a href='#'>" +
                i +
                "</a></li>"
        );
        if (i == numPages) {
            $("#pagination-list-gc-sc").append(
                "<li class='btn btn-white' data-page='" +
                    i +
                    "'><a href='#'><i class='fa fa-chevron-right'></a></li>"
            );
        }
    }
    $("#pagination-list-gc-sc li:first-child").addClass("active");

    // Set up click event for pagination links
    $("#pagination-list-gc-sc li").click(function (event) {
        event.preventDefault();
        var pageNum = $(this).data("page");
        var startRow = (pageNum - 1) * rowsPerPage;
        var endRow = startRow + rowsPerPage;
        $("#gs-sc tbody tr").hide();
        $("#gs-sc tbody tr").slice(startRow, endRow).show();
        $("#pagination-list-gc-sc li").removeClass("active");
        $(this).addClass("active");
    });

    // Set up search button click event
    $("#search-input").keyup(function () {
        var searchText = $("#search-input").val().toLowerCase();
        $("#gs-sc tbody tr")
            .hide()
            .filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) != -1;
            })
            .slice(0, rowsPerPage)
            .show();
        $("#pagination-list-gc-sc li").removeClass("active");
        $("#pagination-list-gc-sc li:first-child").addClass("active");
    });

    // Sort table by column on header click
    $("#gs-sc th").click(function () {
        var table = $(this).parents("table").eq(0);
        var rows = table
            .find("tr:gt(0)")
            .toArray()
            .sort(comparer($(this).index()));
        this.asc = !this.asc;
        if (!this.asc) {
            rows = rows.reverse();
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        }
    });

    // Compare function for sorting
    function comparer(index) {
        return function (a, b) {
            var valA = getCellValue(a, index),
                valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB)
                ? valA - valB
                : valA.toString().localeCompare(valB);
        };
    }

    // Get cell value for sorting
    function getCellValue(row, index) {
        return $(row).children("td").eq(index).text();
    }

    /*********************Search Bar DashBoard Owner Mangment********************** */
    /* $("#key").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });*/
});
