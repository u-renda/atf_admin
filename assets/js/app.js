var winOrigin = window.location.origin;
var winPath = window.location.pathname.split('/');
var newPathname = winOrigin + "/" + winPath[1] + "/";

(function($) {
	
	// Navigation highlight
	var group_item = $('li.list-item');
	
	group_item.each(function() {
        var href = $(this).find('a').attr('href');
		var split = href.split('/');
		
		if (split[4] === winPath[2]) {
			var parent = $(this).closest("li.nav-parent");
			var grand = $(this).closest("li.nav-grand");
			parent.addClass('nav-expanded nav-active');
			grand.addClass('nav-expanded nav-active');
			$(this).addClass('nav-active');
        }
    });
	
	if (document.getElementById('page_member_love_lists') != null ||
		document.getElementById('page_member_wishlist_lists') != null ||
		document.getElementById('page_member_edit') != null) {
		$('li#grand-member').addClass('nav-active');
	}
	
	if (document.getElementById('page_movie_edit') != null) {
		$('li#grand-movie').addClass('nav-active');
	}
	
	if (document.getElementById('page_movie_cast_create') != null ||
		document.getElementById('page_movie_cast_edit') != null) {
		$('li#grand-movie').addClass('nav-active nav-expanded');
		$('li#parent-movie-cast').addClass('nav-active');
	}
	
	if (document.getElementById('page_product_category_edit') != null) {
		$('li#grand-product').addClass('nav-active nav-expanded');
		$('li#parent-product-category').addClass('nav-active');
	}
	
	if (document.getElementById('page_product_brand_edit') != null) {
		$('li#grand-product').addClass('nav-active nav-expanded');
		$('li#parent-product-brand').addClass('nav-active');
	}
	
	if (document.getElementById('page_product_create') != null ||
		document.getElementById('page_product_edit') != null) {
		$('li#grand-product').addClass('nav-active');
	}
	
	if (document.getElementById('page_admin_edit') != null) {
		$('li#grand-admin').addClass('nav-active');
	}

}).apply(this, [jQuery]);