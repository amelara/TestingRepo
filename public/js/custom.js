//Get screen resolution from current device
var screenWidth = window.screen.width;
var screenHeight = window.innerHeight;

//Initialize slideout plugin
var slideout = new Slideout({
	'panel': document.getElementById('panel'),
	'menu': document.getElementById('menu'),
	'padding': screenWidth,
	'side': 'right'
});

//Add functionality to show main menu
document.querySelector('.menu-icon').addEventListener('click', function() {
	slideout.toggle();
});
//Add functionality to hide main menu
document.querySelector('.close').addEventListener('click', function() {
	slideout.close();
});
//Set navbar as fixed element
var fixed = document.querySelector('.navbar');
var footer = document.querySelector('footer');

//Set configuration for fixed menu
slideout.on('translate', function(translated) {
	fixed.style.transform = 'translateX(' + screenWidth + 'px)';
});

slideout.on('beforeopen', function () {
	fixed.style.transition = 'transform 300ms ease';
	fixed.style.transform = 'translateX(' + screenWidth + ')';
});

slideout.on('beforeclose', function () {
	fixed.style.transition = 'transform 300ms ease';
	fixed.style.transform = 'translateX(0px)';
});

slideout.on('open', function () {
	fixed.style.transition = '';
});

slideout.on('close', function () {
	fixed.style.transition = '';
});

if (screenWidth < 600) {
	slideout.enableTouch();
} else {
	slideout.disableTouch();
}

//Initialize to use JQuery library
$(document).ready(function() {
	//Smooth scroll
	var anchor = window.location.hash;
	anchor = anchor.length ? anchor : window.location.href.split("#")[1];
	if (typeof(anchor) != 'undefined' && anchor != null) {
		$('html, body').animate({
			scrollTop: $(anchor).offset().top - parseInt(95)
		}, 800);
	}

	$('a[href*="#cc-lookup"]:not([href="#cc-lookup"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - parseInt(95)
				}, 1000);
				target.focus(); // Setting focus
				if (target.is(":focus")){ // Checking if the target was focused
					return false;
				} else {
					target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
					target.focus(); // Setting focus
				};
				return false;
			}
		}
	});

	//Carousel
	$('.owl-carousel').owlCarousel({
		autoplay: true,
		autoplayTimeout: 6000,
		items: 1,
		dots: true,
		nav: false,
		loop: true,
	});

	$('.menu-icon').on('click', function(e) {
		$('footer').slideToggle();
	});

	//Add animation of symbols (+/-) inside each item of accordion
	$('.item h3 a').on('click', function(e) {
		var toggleState = $(this).data('toggle');
		
		if (!$(this).parent('h3').hasClass('active')) {
			$('.item h3').removeClass('active');
		}
		$(this).parent('h3').toggleClass('active');
	});

	//Define form in variables
	var currentForm, lookupForm, cancelForm, accountForm;
	lookupForm = $('.lookup-form');
	cancelForm = $('.cancel-form');
	accountForm = $('.acc-info');
	homeForm = $('.cc-lookup-form');

	//Get current form
	if (lookupForm.length > 0) {
		currentForm = lookupForm;
	} else if (cancelForm.length > 0) {
		currentForm = cancelForm;
	} else if (accountForm.length > 0) {
		currentForm = accountForm;
	}  else if (homeForm.length > 0) {
		currentForm = homeForm;
	}    

	//Show loader after press submit button
	if (typeof(currentForm) != 'undefined' && currentForm != null) {
		$(currentForm).on('submit', function(e) {            
			$('.action-btn-container').addClass('disp-none');
			$('.loader').removeClass('disp-none');
		});
	}

	//Set input mask plugin
	$('#cc_number').inputmask({'mask': '9999 99XX XXXX 9999'});

	//Define variables for cc lookup
	var cc_first, cc_last, count;
	cc_first = $('#first_digits');
	cc_last  = $('#last_digits');
	count = 0;

	//Don't load validations on mobile devices
    if (screenWidth > 768) {

		//Set input mask for first 6 digits & the last 4 digits
		cc_first.inputmask({'mask': '9999 99'});
		cc_last.inputmask({'mask': '9999'});

		//Go forward to last 4 digits input text when client finishes to fill out the first 6 digits
		cc_first.on("keydown", function(e) {
			var key = e.charCode || e.keyCode || 0;
			//Accept only digits
			if ( (key >= 96 && key <= 105) || (key >= 48 && key <= 57) ) { 
				if (count < 6) {
					count++;            
				} else {
					cc_last.focus();                            
				}
			} 

			if( (key == 8) && (count <= 6 && count > 0) ) {
				count--;
			}
		});

		//Go back to first 6 digits input text when client uses backspace to delete the last 4 digits
		cc_last.on("keydown", function(e) {
			var key = e.charCode || e.keyCode || 0;
			//Get first 6 digits input text value
			var first6Val = cc_first.val();
			var firstValArray = first6Val.split("");

			$.each(firstValArray, function(key, value) {
				
				if ($.isNumeric(value)) {
					if (count < 6) {                                        
						cc_first.focus();
					}
				}
				
			});
			
			if ( (key == 8) && (cc_last.val().length == 0) ) {            
				cc_first.focus();
			}        
		});

		cc_first.on("paste", function(e) {
			//Get first 6 digits input text value
			var pastedData = $(this).val();
			var newArray = pastedData.split("");
			
			$.each(newArray, function(key, value) {
				
				if ($.isNumeric(value)) {
					if (count < 6) {
						count++;                    
					} else {
						cc_last.focus();
					}
				}
				
			});
		});

		cc_last.on("paste", function(e) {
			// access the clipboard using the api
			var pastedData = $(this).val();
			var newArray = pastedData.split("");
			
			if (count < 7) {
				cc_first.focus();
			}
		});

		cc_last.on("click", function(e) {
			if (count < 7) {
				cc_first.focus();
			}
		});
	} else {
        //Set input mask for first 6 digits & the last 4 digits
        cc_first.inputmask({'mask': '999999'});
        cc_last.inputmask({'mask': '9999'});
    }

});