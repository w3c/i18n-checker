// Author: Thomas GAMBET.
// (c) COPYRIGHT MIT, ERCIM and Keio, 2010.
var W3C = {
	
	start: function(){
		
		W3C.Tabs = $('tabset_tabs');
		W3C.TabLinks = W3C.Tabs.getChildren('li');
		W3C.LanguagesForm = $('lang_choice');
		W3C.LangParameter = $$('html').getProperty('lang')[0];
		W3C.Forms = $$('form.ucn_form');
		W3C.Action = W3C.Forms[0].getProperty('action');
		// index of selected tab
		W3C.SelectedTab = 0;
		// boolean: expand options
		W3C.WithOptions = false;
		W3C.prepareDocument();
		W3C.parseHash();
		//W3C.updateHash();
		W3C.showTab(W3C.SelectedTab, false);
		W3C.Loader = new Element('img', {'src': './images/ajax-loader.gif', 'class': 'loader'});
		//console.log(window.location);
	},
	
	prepareDocument: function(){
		
		$$('input#lang_change').setStyle('display', 'none');
		
		if (W3C.LanguagesForm != null)
			W3C.LanguagesForm.addEvent('change', function(event) {
				action = W3C.LanguagesForm.getProperty('action') ? W3C.LanguagesForm.getProperty('action') : "";
				window.location = action + "?" + this.toQueryString().replace('uri=http%3A%2F%2F', 'uri=') + window.location.hash;
			});
		
		W3C.TabLinks.each(function(link, i) {
			link.addEvent('click', function (event) {
				event.stop();
				event.preventDefault();
				W3C.showTab(i, true);
				W3C.updateHash();
			});
		});
		
		W3C.Forms.filter('form[method=get]').each(function (form) {
			/*form.getElement('input[type=submit]').addEvent('click', function(event) {
				event.preventDefault();
			});*/
			form.addEvent('submit', function(event) {
				event.preventDefault();
				//form.uri.value = form.uri.value.replace('http://', '');
				//form.submit();
				// ------- With ajax
				/*if ($('messages'))
					$('messages').dispose();
				if ($$('div.intro'))
					$$('div.intro').dispose();
				if ($$('body > div.section'))
					$$('body > div.section').dispose();
				// Generate the query string
				var queryString = form.toQueryString().replace('uri=http%3A%2F%2F', 'uri=');
				// Create the request and send
				var formRequest = new Request.HTML({
					url: W3C.Action + "?" + queryString,
					method: 'get',
					onRequest: function() {
						W3C.Loader.inject(W3C.Forms[W3C.SelectedTab].getElement('div.input'),'before');
					},
					onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) {
						$$('img.loader').dispose();
						//console.log(responseHTML);
						//responseTree.set('')
						//var t = new Element('div').set('html', responseHTML);//.inject($('frontforms'), 'after');
						//t.inject($('frontforms'), 'after');
						console.log(responseHTML);
						console.log($$(responseHTML));
						$$(responseTree).inject($('don_program'), 'before');
						// Load and start the result script
						var myScript = Asset.javascript('./scripts/w3c_unicorn_results.js', {
						    id: 'w3c_unicorn_results',
						    onLoad: function(){
						    	W3Cr.start();
						    }
						});
						return true;
					},
					onFailure: function() {
						// TODO
						$$('img.loader').dispose();
						return false;
					}
				});
				formRequest.send();*/
				// ------- Without ajax
				var queryString = form.toQueryString().replace('uri=http%3A%2F%2F', 'uri=');
				if ("?" + queryString == window.location.search) {
					window.location.reload(true);
				} else {
					window.location = W3C.Action + "?" + queryString + "#" + W3C.getHash();
				}
			});
			/*new FormValidator(form, {
				onFormValidate: function(passed, form, event) {
					if (passed) {
						event.preventDefault();
						//form.submit();
						var queryString = form.toQueryString().replace('uri=http%3A%2F%2F', 'uri=');
						if ("?" + queryString == window.location.search) {
							window.location.reload(true);
						} else {
							window.location = W3C.Action + "?" + queryString + "#" + W3C.getHash();
						}
					}
				}
			});*/
		});
		
		W3C.Forms.filter('form[method=post]').each(function (form) {
			form.addEvent('submit', function(event) {
				form.setProperty('action', form.getProperty('action') + '#' + W3C.getHash());
			})
			/*new FormValidator(form, {
				onFormValidate: function(passed, form, event) {
					if (passed) {
						form.setProperty('action', form.getProperty('action') + '#' + W3C.getHash());
					}
				}
			});*/
		});
		
	},
	
	showTab: function(tabIndex, withFX) {
		if (W3C.Tabs.getElements('li')[tabIndex] == W3C.Tabs.getElement('li.selected'))
			return;
		
		W3C.SelectedTab = tabIndex;
		W3C.Forms.each(function(form, i) {
			if (i != tabIndex) {
				form.setStyle('display', 'none');
			} else {
				if (withFX)
					form.setStyle('opacity', 0);
				form.setStyle('display', 'block');
			}
		});
		W3C.TabLinks.each(function(link, i) {
			if (i != tabIndex) {
				link.setProperty('class', '');
			} else {
				link.setProperty('class', 'selected');
			}
		});
		
		if (withFX) {
			W3C.Forms[tabIndex].set('tween', {'duration': 350});
			W3C.Forms[tabIndex].tween('opacity', 0, 1);
		}
	},
	
	parseHash: function(){
		
		var hash = window.location.hash;
		if (hash == "") {
			return;
		}
		
		var tab = hash.replace('#', '').split('+');
		var selectedTab = tab[0];
		var withOptions = tab[1];
		
		// get selected tab
		var index = W3C.Forms.getProperty('id').indexOf(selectedTab);
		if (index == -1) {
			//W3C.setHash('');
			return;
		}
		W3C.SelectedTab = index;
		
		// with_options ?
		if (!withOptions || !withOptions == "with_options") {
			//W3C.setHash(selectedTab);
			return;
		}
		W3C.WithOptions = true;
	},
	
	updateHash: function(){
		var tab = W3C.Forms[W3C.SelectedTab].getProperty('id');
		var withOptions = W3C.WithOptions ? '+with_options' : '';
				
		//W3C.setHash(tab + task + withOptions);
		W3C.setHash(tab + withOptions + '+');
	},
	
	getHash: function() {
		var tab = W3C.Forms[W3C.SelectedTab].getProperty('id');
		var withOptions = W3C.WithOptions ? '+with_options' : '+';
		
		return tab + withOptions;
	},
	
	setHash: function(hash){
		if (window.webkit419){
			W3C.FakeForm = W3C.FakeForm || new Element('form', {'method': 'get'}).injectInside(document.body);
			W3C.FakeForm.setProperty('action', '#' + hash).submit();
		} else {
			window.location.replace('#' + hash);
			//window.location.hash = '#' + hash;
		}
	}
	
};

//window.addEvent('domready', W3C.start);