(function ($){
	$.fn.ajaxLink = function (options){
		return $(this).each(function (){
			var $el = $(this);
			var target = $el.attr('data-target') || options.target;
			var link = $el.attr('href');
			$el.on('click', function(event){
				event.preventDefault();
				$.get(link, function(data) {
					var $target = $(target);
					$target.html(data);
					$('a', $target).ajaxLink(options);
				}).fail(function (){
					console.log("error");
				});
			});
		});
	};
}(jQuery));