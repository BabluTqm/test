var csrfToken = $('meta[name="csrfToken"]').attr("content");
$("#modal-form").on("submit", function (e) {
    e.preventDefault();
    var data = $("#service").val();
    if (data != "") {
        if (!$.trim(data)) {
            $("#service-error").text("space not allowed").css("color", "red");
        } else {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/services/addServices",
                type: "JSON",
                method: "POST",
                data: { service: $.trim(data) },
                success: function (response) {
                    if (response == 1) {
                        $("#exampleModal").modal("hide");
                        $(".hide-spin").show();
                        swal(
                            "Success!",
                            "Service has been Added Successfully!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/services/serviceManagment";
                        });
                    } else {
                        $("#service-error")
                            .text("Aleardy exits")
                            .css("color", "red");
                        swal("Error!", "Service not added!", "error");
                    }
                },
            });
        }
    } else {
        $("#service-error")
            .text("Please Service field requiret")
            .css("color", "red");
    }

    return false;
});

//========================= add products using modal ===============================
jQuery.validator.addMethod(
    "noSpace",
    function (value, element) {
        return value == "" || value.trim().length != 0;
    },
    "No space please"
);
jQuery.validator.addMethod(
    "lettersonly",
    function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    },
    "Please enter valid product name"
);
$(document).ready(function () {
    $("#addProduct-form").validate({
        rules: {
            product_name: {
                required: true,
                noSpace: true,
                lettersonly: true,
            },
            service_id: {
                required: true,
                noSpace: true,
            },
        },
        messages: {
            product_name: {
                required: "Please enter product name",
            },
            service_id: {
                required: "Please select one",
            },
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/products/addProduct",
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        swal("Error", "Product is not saved", "error");
                    } else if (data["status"] == 2) {
                        // swal("Error", "Product is not saved", "error");
                        $("#exister").html("Product Name already exist");
                    } else {
                        $("#addProduct").modal("hide");
                        $("#product-list").load(
                            "/admin/products/productManagement #product-list"
                        );
                        $("#addProduct form")[0].reset();
                        swal(
                            "Success!",
                            "Product has been saved successfully!",
                            "success"
                        );
                    }
                },
            });
            return false;
        },
    });
});

$(".read").on("click", function () {
    var id = $(this).attr("data-id");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        url: "/users/readNotification/" + id,
        type: "JSON",
        method: "POST",
        success: function (response) {
            var data = JSON.parse(response);

            if (data["status"] == 1) {
                window.location.reload(true);
            } else {
                swal(
                    "Error!",
                    "There is some problem to read notification!",
                    "error"
                );
            }
        },
    });
    return false;
});

// service edit
$(".edit").on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    $.ajax({
        url: "/admin/services/editDataGet",
        type: "JSON",
        method: "get",
        data: { id: id },
        success: function (response) {
            var data = JSON.parse(response);

            $("#edit").modal("show");
            $("#service-id").val(data["id"]);
            $("#get-service").val(data["service"]);
            $("#table-hide").load(
                "/admin/services/serviceManagment #table-hide"
            );
        },
    });
    return false;
});

// service edit
$(".edit-form").on("click", function (e) {
    e.preventDefault();
    var data = $("#edit-form").serialize();
    var service = $("#get-service").val();
    if (service != "") {
        if (!$.trim(service)) {
            $("#service_error_edit")
                .text("space not allowed")
                .css("color", "red");
        } else {
            // alert(data);return false;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/services/editService",
                type: "JSON",
                method: "POST",
                data: data,
                success: function (response) {
                    if (response == 1) {
                        $("#edit").modal("hide");
                        $(".hide-spin").show();
                        swal(
                            "Success!",
                            "Service Details has been Updated Successfully!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/services/serviceManagment";
                        });
                    } else {
                        $("#service_error_edit")
                            .text("Aleardy exits")
                            .css("color", "red");
                        swal("Error!", "Service not updated!", "error");
                    }
                },
            });
        }
    } else {
        $("#service_error_edit")
            .text("Please Service field requiret")
            .css("color", "red");
    }
    return false;
});
//view service
$(".view").on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    $.ajax({
        url: "/admin/projects/serviceView",
        type: "JSON",
        method: "get",
        data: { id: id },
        success: function (response) {
            $("#edit").modal("show");
            $("#show").html(response);
        },
    });
    return false;
});
//Admin view Product
$(".product-view").on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    $.ajax({
        url: "/admin/projects/productView",
        type: "JSON",
        method: "get",
        data: { id: id },
        success: function (response) {
            $("#mp").modal("show");
            $("#proshow").html(response);
        },
    });
    return false;
});

//================== get product details to update ================
$(".update").on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    $.ajax({
        url: "/admin/products/getProduct",
        type: "JSON",
        method: "get",
        data: { id: id },
        success: function (response) {
            var data = JSON.parse(response);
            $("#edit").modal("show");
            $("#product-id").val(data["id"]);
            $("#get-product").val(data["product_name"]);
        },
    });
    return false;
});

//========================== update product details =================
$(document).ready(function () {
    $("#update-form").validate({
        rules: {
            product_name: {
                required: true,
                noSpace: true,
            },
        },

        messages: {
            product_name: {
                required: "Please enter product name",
            },
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            var id = $("#product-id").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: "/admin/products/updateProduct/" + id,
                type: "JSON",
                method: "POST",
                data: formData,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["status"] == 0) {
                        swal("Error!", "Product details not updated!", "error");
                    } else {
                        $("#edit").hide();
                        $(".hide-spin").show();
                        swal(
                            "Updated!",
                            "Product details has been updated!",
                            "success"
                        ).then(function () {
                            window.location.href =
                                "/admin/products/productManagement";
                        });
                    }
                },
            });
            return false;
        },
    });
});

// assign project to contractor

$("#assigned-form").submit(function (e) {
    e.preventDefault();
    var checked = $('input[type="checkbox"]:checked').length;
    // alert(checked); return false
    var debit = $(".credit").val();
    if (checked < 1) {
        swal("Canceled!", "Please check atleast one checkbox!", "error");
    } else if (debit == "") {
        swal("Canceled!", "Please enter the credit ammount!", "error");
    } else {
        $("#loader_assign").css({
            position: "fixed",
            left: "0px",
            top: "0px",
            opacity: "0.7",
            width: "100%",
            height: "100%",
            "z-index": "9999",
            background:
                'url("https://media.tenor.com/d0LM2F1ze8kAAAAC/smartparcel-mail.gif") 50% 50% no-repeat rgb(249,249,249)',
        });
        var owner_user_id = $("#owner_user_id").val();
        var project_id = $("#project_id").val();
        var owner_email = $("#owner_email").val();
        var uarr = [];
        var arr = [];
        $('input[type="checkbox"]:checked').each(function () {
            uarr.push($(this).val());
            var ctr = $(this).closest("td").siblings().find("input:text").val();
            arr.push(ctr);
        });
        // console.log(uarr);
        // return false;

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            url: "/admin/projects/assign",
            type: "JSON",
            method: "POST",
            data: {
                owner_user_id: owner_user_id,
                project_id: project_id,
                owner_email: owner_email,
                user_id: uarr,
                credit: arr,
            },
            success: function (response) {
                if (response == 1) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: "This Contractor have assigned.",
                        type: "success",
                    }).then(function () {
                        window.location.href =
                            "/admin/projects/projectView/" + project_id;
                    });

                    $("#loader_assign").css("visibility", "hidden");
                    // swal("Success!", "This Contractor have assigned!", "success");
                    // window.location.href = "/admin/projects/projectView/"+project_id;
                }
                if (response == 0) {
                    alert("This Contractor Already have assigne");
                }
            },
            beforeSend: function () {},
            complete: function () {
                $("#loader_assign").css("visibility", "hidden");
            },
        });
    }
});

//check it
$(".checkit").on("change", function () {
    var uid = $("#user").val();
    var id = $(this).val();
    $.ajax({
        url: "/admin/contractor/deteleServices",
        type: "JSON",
        method: "get",
        data: { id: id, uid: uid },
        success: function (response) {
            if (response == 1) {
                $(".checkit").checked = false;
            }
        },
    });
    return false;
});
$(".project_check").on("change", function () {
    var pid = $("#project_id").val();
    var id = $(this).val();
    // alert(pid+id);return false;
    $.ajax({
        url: "/projects/deteleServices",
        type: "JSON",
        method: "get",
        data: { id: id, pid: pid },
        success: function (response) {
            if (response == 1) {
                $(".checkit").checked = false;
            }
        },
    });
    return false;
});
$(".contractor").on("change", function () {
    var uid = $("#user_id").val();
    var id = $(this).val();
    // alert(pid+id);return false;
    $.ajax({
        url: "/contractors/deteleServices",
        type: "JSON",
        method: "get",
        data: { id: id, uid: uid },
        success: function (response) {
            if (response == 1) {
                $(".checkit").checked = false;
            }
        },
    });
    return false;
});

$(".mp").on("change", function () {
    var uid = $("#user_id").val();
    var id = $(this).val();
    // alert(pid+id);return false;
    $.ajax({
        url: "/materialProvider/deleteProduct",
        type: "JSON",
        method: "get",
        data: { id: id, uid: uid },
        success: function (response) {
            if (response == 1) {
                $(".checkit").checked = false;
            }
        },
    });
    return false;
});

// Sweet alert area//
