$(function () {
    // Member - Lists
    if (document.getElementById('page_member_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "member_delete";
            var grid = "grid_member_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Member Love - Lists
    if (document.getElementById('page_member_love_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "member_love_delete";
            var grid = "grid_member_love_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Member Wishlist - Lists
    if (document.getElementById('page_member_wishlist_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "member_wishlist_delete";
            var grid = "grid_member_wishlist_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Movie Cast - Lists
    if (document.getElementById('page_movie_cast_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "movie_cast_delete";
            var grid = "grid_movie_cast_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Product Brand - Lists
    if (document.getElementById('page_product_brand_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "product_brand_delete";
            var grid = "grid_product_brand_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Product Category - Lists
    if (document.getElementById('page_product_category_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "product_category_delete";
            var grid = "grid_product_category_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Product - Lists
    if (document.getElementById('page_product_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "product_delete";
            var grid = "grid_product_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $(this).delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "product_view";
            var dataString = 'id='+ id +'&action='+ action;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-folder-open fontblue font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    // Admin - Lists
    if (document.getElementById('page_admin_lists') != null) {
        $(this).delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "admin_delete";
            var grid = "grid_admin_lists";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times fontred font18"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Confirm Delete');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $(this).delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "admin_view";
            var dataString = 'id='+ id +'&action='+ action;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString, 
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-folder-open fontblue font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
});