$("#showAddCategory").on('click', function() {
	$('#myModal .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal .error').html("");
	$("#myModal #category_name").val("");
	$("#myModal").modal();
});

$(".showEditCategory").on('click', function() {
	var category_id = $(this).attr('data-category-id');

	$.ajax({
		async : true,
		type : "POST",
		url : "category/get",
		data : {
			'category_id' : category_id
		},
		dataType : "json",
		success : function(data) {

			if (data == 0) {
				alert("Something Went Wrong,please reload and try");
			} else {

				$('#myModal1 .error').removeClass("bg-danger text-danger bg-success text-success");
				$('#myModal1 .error').html("");
				$("#myModal1 #category_name").val(data.category_name);
				$("#myModal1 #category_id").val(data.category_id);
				$("#myModal1").modal('show');

			}

		}
	});

});

$(".showDeleteCategory").on('click', function() {
	if (confirm("Are you sure to Delete Category ,deleting category will delete products under this category?")) {
		var category_id = $(this).attr('data-category-id');
		$.ajax({
			async : true,
			type : "POST",
			url : "category/delete",
			data : {
				'category_id' : category_id
			},
			dataType : "json",
			success : function(data) {

				if (data == 1) {

					$(".info").html("Category deleted sucsessfully");

					location.reload();

				} else {

					$(".info").html("Error deleting Category");

					location.reload();
				}

			}
		});
	}
});
$("#savecategory").on('click', function() {
	var formdata = $("#addcategory").serialize();

	$('#myModal .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal .error').html("Processing ,please wait....");
	$.ajax({
		async : true,
		type : "POST",
		url : "category/add",
		data : formdata,
		dataType : "json",
		success : function(data) {

			if (data == 1) {

				$("#myModal .error").addClass("bg-success text-success");
				$("#myModal .error").html("Category Saved Successfully");
				$("#myModal").modal('hide');
				location.reload();

			} else if (data == 0) {

				$("#myModal .error").addClass("bg-danger text-danger");
				$("#myModal .error").html("Category Saving Failed");
				$("#myModal").modal('hide');
				location.reload();
			} else {

				$("#myModal .error").addClass("bg-danger text-danger");
				$("#myModal .error").html(data);
			}

		}
	});

});
$("#updatecategory").on('click', function() {
	var formdata = $("#editcategory").serialize();

	$('#myModal1 .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal1 .error').html("Processing ,please wait....");
	$.ajax({
		async : true,
		type : "POST",
		url : "category/edit",
		data : formdata,
		dataType : "json",
		success : function(data) {

			if (data == 1) {

				$("#myModal1 .error").addClass("bg-success text-success");
				$("#myModal1  .error").html("Category update Successfully");
				$("#myModal1").modal('hide');
				location.reload();

			} else if (data == 0) {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html("Category updation Failed");
				$("#myModal1").modal('hide');
				location.reload();
			} else {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html(data);
			}

		}
	});

});
$("#showAddProduct").on('click', function() {
	$('#myModal .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal .error').html("");
	$("#addproduct")[0].reset();
	$("#myModal").modal();
});

$("#saveproduct").on('click', function() {
	var formdata = $("#addproduct").serialize();

	$('#myModal .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal .error').html("Processing ,please wait....");
	$.ajax({
		async : true,
		type : "POST",
		url : "product/add",
		data : formdata,
		dataType : "json",
		success : function(data) {

			if (data == 1) {

				$("#myModal .error").addClass("bg-success text-success");
				$("#myModal .error").html("Product Saved Successfully");
				$("#myModal").modal('hide');
				location.reload();

			} else if (data == 0) {

				$("#myModal .error").addClass("bg-danger text-danger");
				$("#myModal .error").html("Product Saving Failed");
				$("#myModal").modal('hide');
				location.reload();
			} else {

				$("#myModal .error").addClass("bg-danger text-danger");
				$("#myModal .error").html(data);
			}

		}
	});

});

$(".showEditProduct").on('click', function() {
	var product_id = $(this).attr('data-product-id');

	$.ajax({
		async : true,
		type : "POST",
		url : "product/get",
		data : {
			'product_id' : product_id
		},
		dataType : "json",
		success : function(data) {

			if (data == 0) {
				alert("Something Went Wrong,please reload and try");
			} else {

				$('#myModal1 .error').removeClass("bg-danger text-danger bg-success text-success");
				$('#myModal1 .error').html("");
				$("#editproduct #product_name").val(data.products_name);
				$("#editproduct #product_category").val(data.products_category_id);
				$("#editproduct #product_price").val(data.products_price);
				$("#editproduct #product_id").val(data.products_id);
				$("#myModal1").modal('show');

			}

		}
	});

});

$("#updateproduct").on('click', function() {
	var formdata = $("#editproduct").serialize();

	$('#myModal1 .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal1 .error').html("Processing ,please wait....");
	$.ajax({
		async : true,
		type : "POST",
		url : "product/edit",
		data : formdata,
		dataType : "json",
		success : function(data) {

			if (data == 1) {

				$("#myModal1 .error").addClass("bg-success text-success");
				$("#myModal1  .error").html("Product update Successfully");
				$("#myModal1").modal('hide');
				location.reload();

			} else if (data == 0) {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html("Product updation Failed");
				$("#myModal1").modal('hide');
				location.reload();
			} else {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html(data);
			}

		}
	});

});

$(".showDeleteProduct").on('click', function() {
	if (confirm("Are you sure to Delete Product ,deleting Product will delete product images ?")) {
		var product_id = $(this).attr('data-product-id');
		$.ajax({
			async : true,
			type : "POST",
			url : "product/delete",
			data : {
				'product_id' : product_id
			},
			dataType : "json",
			success : function(data) {

				if (data == 1) {

					$(".info").html("Product deleted sucsessfully");

					location.reload();

				} else {

					$(".info").html("Error deleting Product");

					location.reload();
				}

			}
		});
	}
});

$(".showAddImages").on('click', function() {
	var product_id = $(this).attr('data-product-id');
	$("#imagesform")[0].reset();
	$('#imagesform').each(function() {
		this.reset();
	});
	$("#myModal2").modal('show');
	$("#myModal2 #product_id").val(product_id);
});

$('#myModal2').on('hidden.bs.modal', function() {
	location.reload();
});
$("#addimages").on('click', function() {
	$("#cloner").clone(true).css("display", '').attr('id', '').appendTo("#imagesform");
});

$(".deleteimages").on('click', function() {

	$(this).parent().parent().parent().parent().remove();
});
$("#saveimages").on('click', function() {
	var formdata = $("#imagesform").serialize();

	$('#myModal2 .error').removeClass("bg-danger text-danger bg-success text-success");
	$('#myModal2 .error').html("Processing ,please wait....");
	$.ajax({
		async : true,
		type : "POST",
		url : "product/uploadimages",
		data : formdata,
		dataType : "json",
		success : function(data) {

			if (data == 1) {

				$("#myModal1 .error").addClass("bg-success text-success");
				$("#myModal1  .error").html("Product update Successfully");
				$("#myModal1").modal('hide');
				location.reload();

			} else if (data == 0) {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html("Product updation Failed");
				$("#myModal1").modal('hide');
				location.reload();
			} else {

				$(".error").addClass("bg-danger text-danger");
				$(".error").html(data);
			}

		}
	});

});
$("#importproduct").on('click', function() {
	$('#myModal3 .error').removeClass("bg-danger text-danger bg-success text-success");
	$("#myModal3").modal('show');
});

$('#myModal3').on('hidden.bs.modal', function() {
	location.reload();
});

$(".showMoreImages").on('click', function() {
	$("#myModal .modal-body").html('');
	var product_id = $(this).attr('data-product-id');
	$.ajax({
		async : true,
		type : "POST",
		url : "product_list/getImages",
		data : {
			'product_id' : product_id
		},
		dataType : "json",
		success : function(data) {
			if (data == "") {
				alert("no Images Found");
			} else {
				var imghtml = '';
				$.each(data, function(index, value) {
					imghtml += '<img src="assets/' + value['products_image_path'] + '" width="75px" height="75px"> <br>';
				});
				$("#myModal .modal-body").html(imghtml);
				$("#myModal").modal('show');
			}

		}
	});

});
$(".addcart").on('click', function() {
	$(".info").removeClass("bg-success text-success bg-success text-success");
	$(".info").html("processing please wait...");
	var product_id = $(this).attr('data-product-id');

	var id = "quantity_" + product_id;

	var quantity = $("#" + id).val();
	console.log(quantity);
	$.ajax({
		async : true,
		type : "POST",
		url : "product_list/addtocart",
		data : {
			'product_id' : product_id,
			'quantity' : quantity
		},
		dataType : "json",
		success : function(data) {
			if (data == 1) {
				$(".info").addClass("bg-success text-success");
				$(".info").html("Product added to cart");
			} else {
				$(".info").addClass("bg-danger text-danger");
				$(".info").html("Product addition failed");
			}
		}
	});
});
