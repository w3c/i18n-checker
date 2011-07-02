// Author: Thomas GAMBET.
// (c) COPYRIGHT MIT, ERCIM and Keio, 2010.
var W3Cr = {
	
	start: function() {
		var slideDuration = 500;
		var scroller = new Fx.Scroll(document);
		var instantScroller = new Fx.Scroll(document, {'duration': 500});
		if ($('messages') != null)
			instantScroller.toElement('messages');
		else if ($('results') != null)
			instantScroller.toElement('results');
		$$('.section').each(function(section) {
			var title = section.getElement('.title');
			var block = section.getElement('.block');
			title.addClass('pointer');
			var iconHolder = new Element('span', {'class': 'arrow'});
			iconHolder.inject(title, 'top');
			section.store('fxSlide', new Fx.Slide(block, {'duration': slideDuration, 'link': 'cancel'}));
			section.store('block', block);
			title.addEvent('click', function(event) {
				event.stop();
				scroller.toElement(title);
				W3Cr.toggle(section);
			});
			W3Cr.open(section);
		});
		$$('#report .section').each(function(section) {
			W3Cr.close(section);
		});
		// specific i18n checker
		/*$$('#infos strong[class]').each(function(value) {
			var className = value.getProperty('class');
			var code = $$('#infos code[class=' + className + ']')[0];
			if (code != null) {
				value.addEvent('mouseover', function(event) {
					code.addClass('emphasized');
					value.addClass('emphasized');
				});
				value.addEvent('mouseout', function(event) {
					code.removeClass('emphasized');
					value.removeClass('emphasized');
				});
				code.addEvent('mouseover', function(event) {
					code.addClass('emphasized');
					value.addClass('emphasized');
				});
				code.addEvent('mouseout', function(event) {
					code.removeClass('emphasized');
					value.removeClass('emphasized');
				});
			}
		});*/
		// Count the values in the non-ascii and non-nfc names and replace the values by the count
		$els = $$('#infos strong[class^="classId_non_ascii"]');
		if ($els.length >= 1) {
			$e = new Element('strong').set('text', $els.length);
			$e.inject($els.getLast(), 'after');
		}
		$els.each(function(value) {
			value.setStyle('display', 'none');
		});
		$els = $$('#infos strong[class^="classId_non_nfc"]');
		console.log($els.length);
		if ($els.length >= 1) {
			$e = new Element('strong').set('text', $els.length);
			$e.inject($els.getLast(), 'after');
		}
		$els.each(function(value) {
			value.setStyle('display', 'none');
		});
		// Hide BOM code line
		$bomCode = $$('code.charset_bom_0');
		if ($bomCode != null)
			$bomCode.setStyle('display', 'none');
	},
	
	toggle: function(section) {
		var title = section.getElement('.title');
		var slide = section.retrieve('fxSlide');
		if (section.retrieve('open')) {
			W3Cr.close(section, true);
		} else {
			W3Cr.open(section, true);
		}
	},
	
	close: function(section, withFx) {
		var opened = section.retrieve('open');
		var title = section.getElement('.title');
		var slide = section.retrieve('fxSlide');
		title.removeClass('toggled');
		section.store('open', false);
		if (withFx && opened) {
			slide.slideOut().chain(function(){
				section.getElement('div').setStyle('display', 'none');
				slide.callChain();
			});
		} else {
			slide.hide();
			section.getElement('div').setStyle('display', 'none');
		}
	},
	
	open: function(section, withFx) {
		var closed = !section.retrieve('open');
		var title = section.getElement('.title');
		var slide = section.retrieve('fxSlide');
		title.addClass('toggled');
		section.store('open', true);
		section.getElement('div').setStyle('display', '');
		if (withFx && closed) {
			slide.slideIn().chain(function(){
				section.getElement('div').setStyle('height', 'auto');
				slide.callChain();
			});
		} else {
			slide.show();
			section.getElement('div').setStyle('height', 'auto');
		}
	},
};

//window.addEvent('domready', W3Cr.start);