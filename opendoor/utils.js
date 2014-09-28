function getQueryString() {
	var href = window.location.href;
	return href.substring(href.lastIndexOf("?"), href.length);
}

function toggleAnimation(elem, event, attrs, onActivate, onDeactivate) {
	var active = false;
	var origAttrs = {};
	for(key in attrs) {
		origAttrs[key] = elem.css(key);
	}
	elem.on(event, function(e){
		if(!active) {
			elem.animate(attrs, {
				complete: function(){elem.addClass("active");}
			});

			if(onActivate != null) (onActivate(e, elem));
			active = true;
		} else {
			elem.animate(origAttrs, {
				complete: function(){elem.removeClass("active");}
			});
			if(onDeactivate != null) (onDeactivate(e, elem));
			active = false;
		}
	})
}
