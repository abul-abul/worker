$(function () {
	setTimeout(function () {
    	$(window).resize();
    }, 300);
	setTimeout(function () {
    	crop();
    }, 200);

});

function crop()
{
	'use strict';
	var console = window.console || { log: function () {} },
	 	$alert = $('.docs-alert'),
	  	$message = $alert.find('.message'),
	  	showMessage = function (message, type) {
	    	$message.text(message);

		    if (type) {
		      	$message.addClass(type);
		    }

	    	$alert.fadeIn();

		    setTimeout(function () {
		    	$alert.fadeOut();
		    }, 3000);
	  	};

	(function () {
		var $image = $('.img-container > img'),
		    $dataHeight = $('#dataHeight'),
		    $dataWidth = $('#dataWidth'),
		    $dataRotate = $('#dataRotate'),
	    options = {
	    	aspectRatio: $dataWidth/$dataHeight,
	      	preview: '.img-preview',
	      	crop: function (data) {

	        	$dataHeight.val(Math.round(data.height));
	        	$dataWidth.val(Math.round(data.width));
	        	$dataRotate.val(Math.round(data.rotate));
	      	}
	    };
		$image.on({
	  		'build.cropper': function (e) {
	  		},
	  		'built.cropper': function (e) {
	  		},
		}).cropper(options);


	// Methods
		$(document.body).on('click', '[data-method]', function () {
	 		var data = $(this).data(),
	      	$target,
	      	result;

	  		if (!$image.data('cropper')) {
	    		return;
	  		}
	  		if (data.method) {
	    		data = $.extend({}, data); // Clone a new one

	    		if (typeof data.target !== 'undefined') {
	      			$target = $(data.target);

	      			if (typeof data.option === 'undefined') {
	        			try {
	          			data.option = JSON.parse($target.val());
	        			} catch (e) {
	        				}
	      			}
	    		}
	    		result = $image.cropper(data.method, data.option);
	    		if (data.method === 'getCroppedCanvas') {
	      			$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
	    		}

	    		if ($.isPlainObject(result) && $target) {
	      			try {
	        		$target.val(JSON.stringify(result));
	      			} catch (e) {
	      				}
	    		}
	  		}
		}).on('keydown', function (e) {});


		// Import image
		var $inputImage = $('#inputImage'),
	    URL = window.URL || window.webkitURL,
	    blobURL;

		if (URL) {
	  		$inputImage.change(function () {
	    		var files = this.files,
	        	file;

		    	if (!$image.data('cropper')) {
		      		return;
		    	}

		    	if (files && files.length) {
		      		file = files[0];

		      		if (/^image\/\w+$/.test(file.type)) {
		        		blobURL = URL.createObjectURL(file);
		        		$image.one('built.cropper', function () {
		          			URL.revokeObjectURL(blobURL); // Revoke when load complete
		        		}).cropper('reset').cropper('replace', blobURL);
		        		$inputImage.val('');
		      		} else {
		        		showMessage('Please choose an image file.');
		      		}
		    	}
	  		});
		} else {
	  		$inputImage.parent().remove();
		}


		// Options
		$('.docs-options :checkbox').on('change', function () {
		  var $this = $(this);

		  if (!$image.data('cropper')) {
		    return;
		  }

		  options[$this.val()] = $this.prop('checked');
		  $image.cropper('destroy').cropper(options);
		});


		// Tooltips
		$('[data-toggle="tooltip"]').tooltip();

	}());
}


