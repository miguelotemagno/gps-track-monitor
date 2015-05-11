var demo_url = '/wordpress/wp-content/themes/emm-v3/demos/';
jQuery(function ($) {

	$('#basic-modal a.demo').click(function (e) {
		var src = "vista/gridAjax.php";
                
                $.modal('<iframe src="' + src + '" height="490" width="900" style="border:0">', {
	closeHTML:"",
	containerCss:{
                opacity:9,
		backgroundColor:"#fff",
		borderColor:"#fff",
		height:490,
		padding:0,
		width:900
                
	},
	overlayClose:true
        

});


	});



	// contact
	var contact = {
		message: null,
		init: function () {
			$('#contact-form a.demo').click(function (e) {
				e.preventDefault();
				// load the contact form using ajax
				$.get(demo_url + "contact.php", function(data){
					// create a modal dialog with the data
					$(data).modal({
						closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
						position: ["15%",],
						overlayId: 'contact-overlay',
						containerId: 'contact-container',
						onOpen: contact.open,
						onShow: contact.show,
						onClose: contact.close
					});
				});
			});

			// preload images
			var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
			$(img).each(function () {
				var i = new Image();
				i.src = demo_url + this;
			});
		},
		open: function (dialog) {
			// add padding to the buttons in firefox/mozilla
			if ($.browser.mozilla) {
				$('#contact-container .contact-button').css({
					'padding-bottom': '2px'
				});
			}
			// input field font size
			if ($.browser.safari) {
				$('#contact-container .contact-input').css({
					'font-size': '.9em'
				});
			}
	
			// dynamically determine height
			var h = 280;
			if ($('#contact-subject').length) {
				h += 26;
			}
			if ($('#contact-cc').length) {
				h += 22;
			}
	
			var title = $('#contact-container .contact-title').html();
			$('#contact-container .contact-title').html('Loading...');
			dialog.overlay.fadeIn(200, function () {
				dialog.container.fadeIn(200, function () {
					dialog.data.fadeIn(200, function () {
						$('#contact-container .contact-content').animate({
							height: h
						}, function () {
							$('#contact-container .contact-title').html(title);
							$('#contact-container form').fadeIn(200, function () {
								$('#contact-container #contact-name').focus();
	
								$('#contact-container .contact-cc').click(function () {
									var cc = $('#contact-container #contact-cc');
									cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
								});
	
								// fix png's for IE 6
								if ($.browser.msie && $.browser.version < 7) {
									$('#contact-container .contact-button').each(function () {
										if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
											var src = RegExp.$1;
											$(this).css({
												backgroundImage: 'none',
												filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
											});
										}
									});
								}
							});
						});
					});
				});
			});
		},
		show: function (dialog) {
			$('#contact-container .contact-send').click(function (e) {
				e.preventDefault();
				// validate form
				if (contact.validate()) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(function () {
						msg.removeClass('contact-error').empty();
					});
					$('#contact-container .contact-title').html('Sending...');
					$('#contact-container form').fadeOut(200);
					$('#contact-container .contact-content').animate({
						height: '80px'
					}, function () {
						$('#contact-container .contact-loading').fadeIn(200, function () {
							$.ajax({
								url: demo_url + 'contact.php',
								data: $('#contact-container form').serialize() + '&action=send',
								type: 'post',
								cache: false,
								dataType: 'html',
								success: function (data) {
									$('#contact-container .contact-loading').fadeOut(200, function () {
										$('#contact-container .contact-title').html('Thank you!');
										msg.html(data).fadeIn(200);
									});
								},
								error: contact.error
							});
						});
					});
				}
				else {
					if ($('#contact-container .contact-message:visible').length > 0) {
						var msg = $('#contact-container .contact-message div');
						msg.fadeOut(200, function () {
							msg.empty();
							contact.showError();
							msg.fadeIn(200);
						});
					}
					else {
						$('#contact-container .contact-message').animate({
							height: '30px'
						}, contact.showError);
					}
					
				}
			});
		},
		close: function (dialog) {
			$('#contact-container .contact-message').fadeOut();
			$('#contact-container .contact-title').html('Goodbye...');
			$('#contact-container form').fadeOut(200);
			$('#contact-container .contact-content').animate({
				height: 40
			}, function () {
				dialog.data.fadeOut(200, function () {
					dialog.container.fadeOut(200, function () {
						dialog.overlay.fadeOut(200, function () {
							$.modal.close();
						});
					});
				});
			});
		},
		error: function (xhr) {
			alert(xhr.statusText);
		},
		validate: function () {
			contact.message = '';
			if (!$('#contact-container #contact-name').val()) {
				contact.message += 'Name is required. ';
			}
	
			var email = $('#contact-container #contact-email').val();
			if (!email) {
				contact.message += 'Email is required. ';
			}
			else {
				if (!contact.validateEmail(email)) {
					contact.message += 'Email is invalid. ';
				}
			}
	
			if (!$('#contact-container #contact-message').val()) {
				contact.message += 'Message is required.';
			}
	
			if (contact.message.length > 0) {
				return false;
			}
			else {
				return true;
			}
		},
		validateEmail: function (email) {
			var at = email.lastIndexOf("@");
	
			// Make sure the at (@) sybmol exists and  
			// it is not the first or last character
			if (at < 1 || (at + 1) === email.length)
				return false;
	
			// Make sure there aren't multiple periods together
			if (/(\.{2,})/.test(email))
				return false;
	
			// Break up the local and domain portions
			var local = email.substring(0, at);
			var domain = email.substring(at + 1);
	
			// Check lengths
			if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
				return false;
	
			// Make sure local and domain don't start with or end with a period
			if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
				return false;
	
			// Check for quoted-string addresses
			// Since almost anything is allowed in a quoted-string address,
			// we're just going to let them go through
			if (!/^"(.+)"$/.test(local)) {
				// It's a dot-string address...check for valid characters
				if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
					return false;
			}
	
			// Make sure domain contains only valid characters and at least one period
			if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
				return false;	
	
			return true;
		},
		showError: function () {
			$('#contact-container .contact-message')
				.html($('<div class="contact-error"></div>').append(contact.message))
				.fadeIn(200);
		}
	};
	contact.init();
	
	var OSX = {
		container: null,
		init: function () {
			$('#basic-modalss a.demo').click(function (e) {
		var src = "loginV.php";
                $('#basic-modalss a.demo').modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
	closeHTML:"",
	containerCss:{
                opacity:10,
		backgroundColor:"#fff",
		borderColor:"#fff",
		height:450,
		padding:0,
		width:830,
                onClose:OSX.close
	},
	overlayClose:true

});

	})
		},
		open: function (d) {
	d.overlay.fadeIn('slow', function () {
		d.data.hide();
		d.container.fadeIn('slow', function () {
			dialog.data.slideDown('slow');
		});
	});}
,
		close: function (d) {
			var self = this;
			d.container.animate(
				{top:"-" + (d.container.height() + 20)},
				500,
				function () {
					self.close(); // or $.modal.close();
				}
			);
		}
	};
	OSX.init();

	var G = {
		active: false,
		/*
		 * Calls SimpleModal with appropriate options 
		 */
		init: function () {
			G.images = $('.flickr_badge_image a');
			G.images.click(function () {
				G.current_idx = G.images.index(this);
				$(G.create()).modal({
					closeHTML: '',
					overlayId: 'gallery-overlay',
					containerId: 'gallery-container',
					containerCss: {left:0, top:'10%', width:'100%'},
					opacity: 80,
					autoPosition: false,
					onOpen: G.open,
					onClose: G.close
				});

				return false;
			});
		},
		/*
		 * Creates the HTML for the viewer 
		 */
		create: function () {
			return $("<div id='gallery'> \
					<div id='gallery-image-container'> \
						<div id='gallery-controls'> \
							<div id='gallery-previous'> \
								<a href='#' id='gallery-previous-link'>&laquo; <u>P</u>rev</a> \
							</div> \
							<div id='gallery-next'> \
								<a href='#' id='gallery-next-link'><u>N</u>ext &raquo;</a> \
							</div> \
						</div> \
					</div> \
					<div id='gallery-meta-container'> \
						<div id='gallery-meta'> \
							<div id='gallery-info'><span id='gallery-title'></span><span id='gallery-pages'></span></div> \
							<div id='gallery-close'><a href='#' class='simplemodal-close'>X</a></div> \
						</div> \
					</div> \
				</div>");
		},
		/*
		 * SimpleModal callback to create the 
		 * viewer and open it with animations 
		 */
		open: function (d) {
			G.container = d.container[0];
			G.gallery = $('#gallery', G.container);
			G.image_container = $('#gallery-image-container', G.container);
			G.controls = $('#gallery-controls', G.container);
			G.next = $('#gallery-next-link', G.container);
			G.previous = $('#gallery-previous-link', G.container);
			G.meta_container = $('#gallery-meta-container', G.container);
			G.meta = $('#gallery-meta', G.container);
			G.title = $('#gallery-title', G.container);
			G.pages = $('#gallery-pages', G.container);

			d.overlay.slideDown(300, function () {
				d.container
					.css({height:0})
					.show(function () {
						d.data.slideDown(300, function () {
							// load the first image
							G.display();
						});
					});
			});
		},
		/*
		 * SimpleModal callback to close the 
		 * viewer with animations
		 */
		close: function (d) {
			var self = this;
			G.meta.slideUp(function () {
				G.image_container.fadeOut('fast', function () {
					d.data.slideUp(500, function () {
						d.container.fadeOut(500, function () {
							d.overlay.slideUp(500, function () {
								self.close(); // or $.modal.close();	
							});
						});
					});
					G.unbind();
				});
			});
		},
		/*
		 * Display the previous/next image 
		 */
		browse: function (link) {
			G.current_idx = $(link).parent().is('#gallery-next') ? (G.current_idx + 1) : (G.current_idx - 1);
			G.display();
		},
		/* display the requested image and animate the height/width of the container */
		display: function () {
			G.controls.hide();
			G.meta.slideUp(300, function () {
				G.meta_container.hide();
				G.image_container.fadeOut('fast', function () {
					$('#gallery-image', G.container).remove();

					var img = new Image();
					img.onload = function () {
						G.load(img);
					};
					img.src = G.images.eq(G.current_idx).find('img').attr('src').replace(/_(s|t|m)\.jpg$/, '.jpg');

					if (G.current_idx !== 0) {
						// pre-load prev img
						var p = new Image();
						p.src = G.images.eq(G.current_idx - 1).find('img').attr('src').replace(/_(s|t|m)\.jpg$/, '.jpg');
					}
					if (G.current_idx !== (G.images.length - 1)) {
						// pre-load next img
						var n = new Image();
						n.src = G.images.eq(G.current_idx + 1).find('img').attr('src').replace(/_(s|t|m)\.jpg$/, '.jpg');
					}
				});
			});
		},
		load: function (img) {
			var i = $(img);
			i.attr('id', 'gallery-image').hide().appendTo('body');
			var h = i.outerHeight(true),
				w = i.outerWidth(true);

			if (G.gallery.height() !== h || G.gallery.width() !== w) {
				G.gallery.animate(
					{height: h},
					300,
					function () {
						G.gallery.animate(
							{width: w},
							300,
							function () {
								G.show(i);
							}
						);
					}
				);
			}
			else {
				G.show(i);
			}
		},
		/* 
		 * Show the image and then the controls and meta 
		 */
		show: function (img) {
			img.show();
			G.image_container.prepend(img).fadeIn('slow', function () {
				G.showControls();
				G.showMeta();
			});
		},
		/*
		 * Show the image controls; previous and next 
		 */
		showControls: function () {
			G.next.hide().removeClass('disabled');
			G.previous.hide().removeClass('disabled');
			G.unbind();

			if (G.current_idx === 0) {
				G.previous.addClass('disabled');
			}
			if (G.current_idx === (G.images.length - 1)) {
				G.next.addClass('disabled');
			}
			G.controls.show();

			$('a', G.controls[0]).bind('click.gallery', function () {
				G.browse(this);
				return false;
			});
			$(document).bind('keydown.gallery', function (e) {
				if (!G.active) {
					if ((e.keyCode === 37 || e.keyCode === 80) && G.current_idx !== 0) {
						G.active = true;
						G.previous.trigger('click.gallery');
					}
					else if ((e.keyCode === 39 || e.keyCode === 78) && G.current_idx !== (G.images.length - 1)) {
						G.active = true;
						G.next.trigger('click.gallery');
					}
				}
			});
			$('div', G.controls[0]).hover(
				function () {
					var self = this,
						l = $(self).find('a:not(.disabled):not(:animated)');
					if (l.length > 0) {
						l.fadeIn();
					}
				},
				function () {
					$(this).find('a').fadeOut();
				}
			);
		},
		/*
		 * Show the image meta; title, image x of x and the close X 
		 */
		showMeta: function () {
			G.title.html(G.images.eq(G.current_idx).find('img').attr('title'));
			G.pages.html('Image ' + (G.current_idx + 1) + ' of ' + G.images.length);
			G.meta_container.show()
			G.meta.slideDown(function () {
				G.active = false;	
			});
		},
		/*
		 * Unbind gallery control events 
		 */
		unbind: function () {
			$('a', G.controls[0]).unbind('click.gallery');
			$(document).unbind('keydown.gallery');
			$('div', G.controls[0]).unbind('mouseenter mouseleave');
		}
	};
	G.init();

	// confirm
	$('#confirm-dialog a.demo').click(function (e) {
		e.preventDefault();

		// example of calling the confirm function
		// you must use a callback function to perform the "yes" action
		confirm("Continue to the SimpleModal Project page?", function () {
			window.location.href = 'http://www.ericmmartin.com/projects/simplemodal/';
		});
	});
});

function confirm(message, callback) {
	$('#confirm').modal({
		closeHTML:"<a href='#' title='Close' class='modal-close'>x</a>",
		position: ["20%",],
		overlayId:'confirm-overlay',
		containerId:'confirm-container', 
		onShow: function (dialog) {
			$('.message', dialog.data[0]).append(message);

			// if the user clicks "yes"
			$('.yes', dialog.data[0]).click(function () {
				// call the callback
				if ($.isFunction(callback)) {
					callback.apply();
				}
				// close the dialog
				$.modal.close();
			});
		}
	});
}