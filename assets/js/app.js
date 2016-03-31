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
	
	if (document.getElementById('page_member_love_lists') != null) {
		$('li#grand-member').addClass('nav-active');
	}
	
	if (document.getElementById('page_member_wishlist_lists') != null) {
		$('li#grand-member').addClass('nav-active');
	}
	
	if (document.getElementById('page_member_edit') != null) {
		$('li#grand-member').addClass('nav-active');
	}

}).apply(this, [jQuery]);