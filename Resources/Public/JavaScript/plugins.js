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

(function ($){
	var AjaxForm = function (el, options){
		this.el = el;
		this.$el = $(el);
		this.options = $.extend(true, {}, $.fn.ajaxForm.defaultOptions, options);

		this.$el.on('submit', {ajaxForm: this}, function(event){
			event.preventDefault();
			console.log(event);
			$(this).ajaxForm('submit');
		});

		this.$buttons = $('input[data-loading-text]', this.$el).on('click', function (event){
			var $el = $(this);
			$el.data('mgn.dataLoadingText', $el.val());
			$el.val($el.attr('data-loading-text'));
		});

		//$('input[type="submit"]')
		console.log('new AjaxForm');
		console.log(this);
	}

	AjaxForm.prototype.submit = function (request){
		console.log('submit');

		var request = {
			url: this.$el.attr('data-action'),
			type: this.$el.attr('method'),
			dataType: this.options.format || 'html',
			data: this.$el.serialize(),
			context: this,
			complete: function(xhr, textStatus){
				this.unfreeze();
				this.$buttons.each(function (){
					var $el = $(this);
					$el.val($el.data('mgn.dataLoadingText'));
				});
				this.$el.removeClass('loading');
				this.$el.trigger('complete.mgn');
			},
			success: function(data, textStatus, xhr) {
				console.log('success');
				$(this.options.target).html(data);
				this.$el.trigger('success.mgn');
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log('error');
				console.log(errorThrown);
				this.$el.trigger('error.mgn');
			}
		};

		if (this.options.freeze){
			this.freeze();
		}

		//$('<div class="ajax-loader" />');


		this.$el.addClass('loading');
		this.xhr = jQuery.ajax(request);

		//this.$el.trigger('submit.mgn');
	}

	AjaxForm.prototype.freeze = function (){
		$(this.options.inputSelector, this.$el).prop('disabled', true);
	}

	AjaxForm.prototype.unfreeze = function (){
		$(this.options.inputSelector, this.$el).prop('disabled', false);
	}


	AjaxForm.VERSION  = '1.0.0';

	var Plugin = function (options) {
		return this.each(function () {
			var $this = $(this);
			var data  = $this.data('mgn.ajaxForm');

			if (!data) {
				$this.data('mgn.ajaxForm', (data = new AjaxForm(this, options)));
			}
			if (typeof options == 'string'){
				data[options]();
			}
		});
	}
	Plugin.defaultOptions = {
		format: 'html',
		inputSelector: 'input, textarea, select',
		freeze: true
	};

	$.fn.ajaxForm             = Plugin
	$.fn.ajaxForm.Constructor = AjaxForm



	// $.AjaxForm.defaultOptions = {
	// 	target: '#AjaxFormTarget'
	// };
/*
	$.fn.ajaxForm = function (options){
		return $(this).each(function (){
			var $el = $(this);
			var target = $el.attr('data-target') || null;
			var url = $el.attr('data-action');
			var method = $el.attr('method');

			var request = {
				url: url,
				type: method,
				dataType: options.format || 'html',

				success: function(data, textStatus, xhr) {
					console.log('success');
					//called when successful
					var $target = $(target);
					$target.html(data);
					$('a', $target).ajaxLink({target: target});
					//History.pushState({}, 'Test', '' + Date.now());
				},
				error: function(xhr, textStatus, errorThrown) {
					//called when there is an error
					console.log('error');
					console.log(textStatus);
				}
			};

			$el.on('submit', function (event){
				event.preventDefault();
				var $el = $(this);
				request.data = $el.serialize();
				jQuery.ajax(request);
			});
		});
	};

	$(document).ready(function() {
		//$('form[data-action]').ajaxForm();
	});
*/
}(jQuery));

(function ($, VS){

	var inputQuery = 'input[type=text], textarea, select';

	$.fn.form2vs = function (){
		return $(this).each(function (){
			var $form = $(this);
			var facetElementMap = {};
			var facetMatches = [];
			var valueMatches = {};

			$(inputQuery, $form).each(function (i, el){
				var facet = $(el).attr('title');
				if (facet){
					facetMatches.push(facet);
					facetElementMap[facet] = el;
				}
			});
			$('select', $form).each(function (i, el){
				var $el = $(el);
				var facet = $el.attr('title');
				var options = [];
				$el.find('option').each(function (i, el){
					var $el = $(el);
					options.push({
						value: $el.attr('value'),
						label: $el.text()
					});
				});

				valueMatches[facet] = options;
			});

			$form.append('<div class="visualsearch" />');

			var visualSearch = VS.init({
				container : $('.visualsearch'),
				query     : '',
				callbacks : {
					search       : function(query, searchCollection) {
						$(inputQuery, $form).val("");
						var facets = {};
						$(searchCollection.models).each(function (i, model){
							var facet = model.attributes.category;
							var value = model.attributes.value;
							if (!facets[facet]){
								facets[facet] = [];
							}
							facets[facet].push(value);
						});

						for (var facet in facets){
							var values = facets[facet];
							var $el = $(facetElementMap[facet]);
							if ($el.is('select')){
								$el.val(values);
							} else {
								$el.val(values.join(', '));
							}
						}

						$form.submit();
					},
					facetMatches : function(callback) {
						callback(facetMatches);

					},
					valueMatches : function(facet, searchTerm, callback) {
						if (valueMatches[facet]){
							callback(valueMatches[facet]);
						}
					}
				}
			});
		});
	};

	$(document).ready(function() {
		$('form[data-plugin="form2vs"]').form2vs();
	});
}(jQuery, VS));