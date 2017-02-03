$( document ).ready(function() {

	$('.edit_user').attr('disabled','disabled');
	$('.edit_user img').hide();
	$('#active_editing').click(function(){
		$('.edit_user').attr('disabled',false);
		$(this).hide();
		$('#stop_editing').show();
		$('.edit_user img').show();
	})
	$('#stop_editing').click(function(){
		$('.save_edit').submit();
	})


	window.country_code = null;

	$('.sign_up_seeker').prop('disabled', true);
	$('.loader').hide();
	$('#checkbox3').click(function(){
    	if (this.checked) {
        	$('.sign_up_seeker').prop('disabled', false);
	    } else {
	    	$('.sign_up_seeker').prop('disabled', true);
	    }
	})

	$('.sign_up_provider').prop('disabled', true);
	$('#checkbox4').click(function(){
    	if (this.checked) {
        	$('.sign_up_provider').prop('disabled', false);
	    } else {
	    	$('.sign_up_provider').prop('disabled', true);
	    }
	})

	// select country
	$('.country-select').change(function(){
		window.country_code = $(this).val();
		var token = $('#csrf').attr('data');
		$.ajax({
	            url: '/users/city/'+country_code,
	            type: 'GET',
	            headers: {'X-CSRF-TOKEN': token},
	    		cache:false,
	            beforeSend: function() {
		            $("#select-city").innerHtml;
		        },
	            success:function(data){
	            	//console.log(data.shortcode)
	            	// console.log(data.arrCity)
					var htmlOptions = '';
					var shortcode = '';
					$.each(data.arrCity, function(index, value) {
				       	htmlOptions += "<option value="+data.arrCity[index]+">"+data.arrCity[index]+"</option>";
					});
					shortcode += data.shortcode
					$("#select-city").html("<option value='' disabled selected>Select your city*</option>"+htmlOptions);
					$('#sizing-addon2').html('+' + shortcode);
					$('#phone_code').val('+' + shortcode);
                    $('#pin').val(shortcode);
					$('#zip_code').val(shortcode);
	            }
		});
	});

    // select country
    $('.country-select-provider').change(function(){
        window.country_code = $(this).val();
        var token = $('#csrf-provider').attr('data');
        $.ajax({
            url: '/users/city/'+country_code,
            type: 'GET',
            headers: {'X-CSRF-TOKEN': token},
            cache:false,
            beforeSend: function() {
                $("#select-city-provider").innerHtml;
            },
            success:function(data){
                //console.log(data.shortcode)
                // console.log(data.arrCity)
                var htmlOptions = '';
                var shortcode = '';
                $.each(data.arrCity, function(index, value) {

                    htmlOptions += "<option value="+data.arrCity[index]+">"+data.arrCity[index]+"</option>";
                });
                shortcode += data.shortcode
                $("#select-city-provider").html("<option value='' disabled selected>Select your city*</option>"+htmlOptions);
                $('#sizing-addon2-provider').html('+' + shortcode);
                $('#phone_code_provider').val('+' + shortcode);
                $('#zip_code_provider').val(shortcode);
            }
        });
    });

	// select task
	$('.new-task-selects').change(function(){
		var country = $(this).val();
		var token = $('#csrf').attr('data');

		$.ajax({
	            url: 'task-city/'+country,
	            type: 'GET',
	            headers: {'X-CSRF-TOKEN': token},
	    		cache:false,
	            success:function(data){
	            	
					var htmlOptions = '';

					$.each(data, function(index, value) {
				       	htmlOptions += "<option value="+data[index]+">"+data[index]+"</option>";
					});
					$("#city").html("<option value='' disabled selected>Select your city</option>"+htmlOptions);
	            }
		});
	});

	// select category
	$('#select_category').change(function(){
		
		window.categoryCount = $('#category_count').val();
		if(categoryCount<5){
			$('.validator').hide();
			if($(this).val() != ''){
				categoryCount ++;
				var categoryId = $(this).val();
				var token = $('#csrf').attr('data');
				var categoryName = $("#select_category option:selected" ).text();
				$("#select_category option:selected" ).remove();
				$.ajax({
			            url: '/provider/add-category',
			            type: 'POST',
			    		cache:false,
			    		data: {category:categoryId},
			    		headers: {'X-CSRF-TOKEN': token},
			    		beforeSend: function() {
				            $('.profile').addClass('blurHtml');
				            $('.loader').show();
				        },
				        success:function(){
				        	$('#category_count').val(categoryCount);
			            	$('.profile').removeClass('blurHtml');
				            $('.loader').hide();
				            $("#categories_content").append("<div class='col-md-5 col-xs-12 col-ms-6 col-sm-6 toclose'><div class='category'><a href='#'>"+categoryName+"</a><img src='/assets/img/profile/Removecategory.png' alt="+categoryId+" class='remove'></div></div>");
			            }
					});
			}
		}else{
			if($(this).val() != ''){
				$('.validator').show();
			    $('.validator').html("<li><b>Oops, something went wrong.</b></li><li>You are limited to 5 categories</li>");
			}
		}
	});

	// change provider category
	$(document).on('click', '.remove' ,function(){
		$('.validator').hide();
		window.categoryCount = $('#category_count').val();
		categoryCount --;
		$('#category_count').val(categoryCount);
		var categoryId = $(this).attr('alt');
		var categoryName = $(this).parent().children('a').text();
		var token = $('#csrf').attr('data');
        $(this).parent().parent().remove();
        $.ajax({
	            url: '/provider/remove-category',
	            type: 'POST',
	    		cache:false,
	    		data: {category:categoryId},
	    		headers: {'X-CSRF-TOKEN': token},
	    		beforeSend: function() {
		            $('.profile').addClass('blurHtml');
		            $('.loader').show();
		        },
		        success:function(){
	            	$('.profile').removeClass('blurHtml');
		            $('.loader').hide();
		         $('#select_category')
		         .append($("<option></option>")
		         .attr("value",categoryId)
		         .text(categoryName));
	            }
			});
    });
    $('#category_questions').change(function(){
			var categoryId = $(this).val();
	    	 $.ajax({
		            url: '/seeker/new-task-category/'+categoryId,
		            type: 'GET',
		    		cache:false,
		    		beforeSend: function() {
			        },
			        success:function(data){
		            	var htmlOptions = '';
		            	var text = '';
		            	var text1 = '';
						$.each(data, function(i, v) {
					       	var question =  v.question;
					       	var answers = v.answers;
					       	var i = 0;
					       	if(v.type == 'radio' ){
						       	$.each(answers, function(x, y) {
							       	text +=  "<div class='radio'><input type='radio' name='radio_input"+v.id+"' id='radio"+y.id+"' data-type='radio' class='questions_check check"+v.id+" radion_input' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label for='radio"+y.id+"' class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									i = y.id+1;
								});
								//text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" name="radio_input" data-type="text" class="questions_check check'+v.id+' radio_text" data-val="val'+v.id+''+i+'" data-classname="classname'+v.id+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'text'){
								text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" style="display:none" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label class="text_label col-md-10"><textarea class="form-control val'+v.id+''+i+' text_content" data-tag-name="input" id="form-name" placeholder=""></textarea></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'checkbox'){
								$.each(answers, function(x, y) {
							       	text +=  "<div class='checkbox checkbox-success'><input type='checkbox' data-type='checkbox' class='questions_check check"+v.id+"' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									i = y.id+1;
								});
								text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'drop'){
								//text1 +="<option value=''></option>"
								$.each(answers, function(x, y) {
							       	text +=  "<div class='checkbox checkbox-success' style='display:none'><input type='checkbox' data-type='radio' class='questions_check check"+v.id+" check"+y.id+" drop_secelt' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									text1 += "<option data-id='check"+y.id+"' value='"+y.answer+"'>"+y.answer+"</option>"
									i = y.id+1;
								});
								//var xxx = '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"<select class='form-control' id='drop_content'>"+text1+"</select></div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}
						});
		            }
             });
    });

    var x = $('#category_id_static').val();
    if(typeof(x) != "undefined") {
	        $.ajax({
	                url: '/seeker/new-task-category/'+x,
	                type: 'GET',
	                cache:false,
	                beforeSend: function() {
	                },
	                success:function(data){
	                    var htmlOptions = '';
	                    var text = '';
	                    var text1 = '';
	                    $.each(data, function(i, v) {
					       	var question =  v.question;
					       	var answers = v.answers;
					       	var i = 0;
					       	if(v.type == 'radio' ){
						       	$.each(answers, function(x, y) {
							       	// text +=  "<div class='checkbox checkbox-success'><input type='radio' name='radio_input"+v.id+"' data-type='radio' class='questions_check check"+v.id+" radion_input' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label class='val"+v.id+""+y.id+" radio_content' data-tag-name='label'>"+y.answer+"</label></div>";
									text +=  "<div class='radio '><input type='radio' name='radio_input"+v.id+"' id='radio"+y.id+"' data-type='radio' class='questions_check check"+v.id+" radion_input' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label for='radio"+y.id+"' class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									i = y.id+1;
								});
								//text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" name="radio_input" data-type="text" class="questions_check check'+v.id+' radio_text" data-val="val'+v.id+''+i+'" data-classname="classname'+v.id+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'text'){
								text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" style="display:none" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label class="text_label col-md-10"><textarea class="form-control val'+v.id+''+i+' text_content" data-tag-name="input" id="form-name" placeholder="Other"></textarea></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'checkbox'){
								$.each(answers, function(x, y) {
							       	text +=  "<div class='checkbox checkbox-success'><input type='checkbox' data-type='checkbox' class='questions_check check"+v.id+"' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									i = y.id+1;
								});
								text += '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"</div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}else if(v.type == 'drop'){
								//text1 +="<option value=''></option>"
								$.each(answers, function(x, y) {
							       	text +=  "<div class='checkbox checkbox-success' style='display:none'><input type='checkbox' data-type='radio' class='questions_check check"+v.id+" check"+y.id+" drop_secelt' data-val='val"+v.id+""+y.id+"' data-class='check"+v.id+"' ><label class='val"+v.id+""+y.id+"' data-tag-name='label'>"+y.answer+"</label></div>";
									text1 += "<option data-id='check"+y.id+"' value='"+y.answer+"'>"+y.answer+"</option>"
									i = y.id+1;
								});
								//var xxx = '<div class="checkbox checkbox-success" style="margin-bottom:10px"><input type="checkbox" data-type="text" class="questions_check check'+v.id+'" data-val="val'+v.id+''+i+'" data-class="check'+v.id+'"><label><input class="form-control val'+v.id+''+i+'" data-tag-name="input" id="form-name" placeholder="Other"></label></div>';
								htmlOptions += "<div class='question question_div' data-class='check"+v.id+"' data-name="+v.id+"><p class='answer_content'>"+question+"</p>"+text+"<select class='form-control' id='drop_content'>"+text1+"</select></div>";
								$('#questions_content').html(htmlOptions);
								text = '';
							}
						});
	                }
            });
	}
	
	$(document).on('click','.questions_check',function(){
		if($(this).attr('data-type') =='radio'){
			var content = $(this);
			var dataClass = $(this).attr('data-class');
			$('.'+dataClass).each(function(){
				$(this).prop('checked',false);
				content.prop('checked',true);
			})
		}
	})
	// $(document).on('click','.radio_text',function(){
	// 	if($(this).prop('checked') == true){
	// 		var className = $(this).attr('data-classname');
	// 		$('.'+className).prop('checked',false);
	// 	}
	// })

	// select question answers
	$('.form_submit').click(function(){
		$('.text_content').each(function(){
			if($(this).val() != ''){
				$(this).parent().prev().prop('checked',true);
			}else{
				$(this).parent().prev().prop('checked',false);
			}
		})
		$('.drop_secelt').prop('checked',false);
		var valSelect = $("#drop_content").val();
		window.dropId = $("#drop_content option[value='"+valSelect+"']").attr('data-id');
		$('.'+dropId).prop('checked',true);
		$('.answer_content').removeClass('error_answer');
		window.error = 'no';
		window.dataQuestion = [];
		$('.question_div').each(function(){
			var dataClass = $(this).attr('data-class');
			var status = 0;
			window.dataAnswer = [];
			$('.'+dataClass).each(function(){
				if($(this).prop('checked') == true){
					var valClass = $(this).attr('data-val');
					var contentName =$('.'+valClass).attr('data-tag-name');
					if(contentName == 'input'){
						dataAnswer.push($('.'+valClass).val());
						if(dataAnswer != ''){
							status = 1;
						}
					}else{
						dataAnswer.push($('.'+valClass).html());
						status = 1;
					}
				}
			})
			dataQuestion.push({'question':$(this).attr('data-name'),'answer':dataAnswer});
			if (status == 0) {
				error = 'yes'
				$(this).children(":first").addClass('error_answer')
			}
		})
		if (error == 'no') {		
			dataQuestion = JSON.stringify(dataQuestion);
		
			$('#questionAnswer').val(dataQuestion);
			validation()
		}
	})

	// providers respond detail modal
	$(document).on('click','.userpic',function(){
		var providerId = $(this).attr('alt');
		$('#provider_id').val(providerId);
		$('#mymodal').hide();
		var money = $(this).attr('data-money');

		//var providerId = $(this).attr('alt');
		var taskId = $('#task_id').attr('data');
		console.log(taskId)
		var token = $('#csrf').attr('data');
		$.ajax({
            url: '/seeker/provider-respond-detail',
            type: 'POST',
            cache:false,
            data: {user_id:providerId, task_id:taskId},
            headers: {'X-CSRF-TOKEN': token},
            beforeSend: function() {
                $('.profile').addClass('blurHtml');
                $('.loader').show();
            },
            success:function(data){
            	console.log(data)
                var imgUrl = $('.provider_img').attr('content');
                var src = imgUrl+'/'+data.profile_img;
                $('#provider_mony').val(money);
                $('.provider_img').attr('src', src);
                $('#provider_username').html(data.username);
                $('#provider_phone').html(data.phone);
                $('#provider_id').val(providerId);
                $('#provider_description').html(data.description);
                $('.profile').removeClass('blurHtml');
                $('.loader').hide();
                $('#mymodal').show();
            }
		});
	})
	

	$('.new_task').on('change', submit);

	function submit(event)
    {
      	files = event.target.files;
     	event.stopPropagation(); 
        event.preventDefault(); 
        var data = new FormData();
        var token = $('#token_user').attr('data');
        data.append('file', files[0]);
        data.append('_token',token);
      	$.ajax({
       		url: '/users/ajax-add-photo',
            type: 'POST',
            data: data,
			cache: false,
			dataType: 'json',
			processData: false, 
			contentType: false,
            xhr:function() {
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                }
                return myXhr;
            },
			success: function(data)
			{                     
				if(data.errors){
					$('.error_content').html(data.errors.file);
					$('.error_content').show();
				}else{
					//$('#imagName').val(response);
					document.getElementById('crop_container').innerHTML = '';
					document.getElementById('crop_container').innerHTML += "<img src='/assets/uploads/"+data.name+"' id='crop_imag' alt='Picture'>";
					setTimeout(function () {
				    	makeCropping();
				    }, 200);
					$('#myModalCrop').modal('show');
					$('.error_content').html('');
					$('.error_content').hide();
					$('#imagName').val(data.name);
					// var img_name = data.name;
					// var img_path = "/assets/uploads/"+img_name+""
					// $('#user_img').attr('src',img_path);

	    //             $('#admin-user-photo').val(data.name);
	            }

		//$('#photo_name').val(img_name);
			}
        });
    }

    $('.img_prof').on('change',uploadImg);

    function progressHandlingFunction(evt) {
        if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total * 100;
            //console.log(percentComplete);
            //$('#box0').parent().parent().find('.dz-details .dz-progress .dz-upload').css('width', percentComplete);
            if(percentComplete == 100) {
                $('.progress').css('display', 'none');
            }
            else {
                $('.progress').css('display', 'block');
                $('.progress-bar').css('width', percentComplete+'%');
                $('.progress-bar').html(percentComplete.toFixed(0)+'%');
            }
        }else{
            // Unable to compute progress information since the total size is unknown
            //console.log('unable to complete');
        }
    }

    function uploadImg(event)
    {
    	files = event.target.files;
     	event.stopPropagation(); 
        event.preventDefault();
        var data = new FormData();
        var token = $('.tok').attr('data');
        data.append('file', files[0]);
        data.append('_token',token);
        $.ajax({
       		url: '/users/ajax-add-photo',
            type: 'POST',
            data: data,
            cache: false,
            //dataType: 'json',
            processData: false, 
            contentType: false,
			xhr:function() {
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                }
                return myXhr;
            },
			success: function(data) {
				if(data.errors){
					$('.error_content').html(data.errors.file);
					$('.error_content').show();
				}else{
					//$('#imagName').val(response);
					document.getElementById('crop_container').innerHTML = '';
					document.getElementById('crop_container').innerHTML += "<img src='/assets/uploads/"+data.name+"' id='crop_imag' alt='Picture'>";
					$('#myModalCrop').modal('show');
					setTimeout(function () {
				    	makeCropping();
				    }, 200);
					$('.error_content').html('');
					$('.error_content').hide();
					$('#imagName').val(data.name)
					// var img_name = data.name;
					// var img_path = "/assets/uploads/"+img_name+""
					// $('.prof').attr('src',img_path);
					// $('#photo_name').val(img_name);
				}
			}
        });
    }

    // providers respond detail modal
	$(document).on('click','#login',function() {
		var email = $('#form-username').val();
		var password = $('#form-password').val();
		var token = $('#csrf').attr('data');
		$.ajax({

            url: '/seeker/login-to-task',
            type: 'POST',
            cache:false,
            data: {email:email, password:password},
            headers: {'X-CSRF-TOKEN': token},
            success:function(data){
                if (data == true) {
                    window.error = 'no';
                    window.dataQuestion = [];
                    // $('.question_div').each(function(){
                    //     var dataClass = $(this).attr('data-class');
                    //     var status = 0;
                    //     window.dataAnswer = '';
                    //     $('.'+dataClass).each(function(){
                    //         if($(this).prop('checked') == true){
                    //             var valClass = $(this).attr('data-val');
                    //             var contentName =$('.'+valClass).attr('data-tag-name');
                    //             if(contentName == 'input'){
                    //                 dataAnswer = $('.'+valClass).val();
                    //                 if(dataAnswer != ''){
                    //                     status = 1;
                    //                 }
                    //             }else{
                    //                 dataAnswer = $('.'+valClass).html();
                    //                 status = 1;
                    //             }
                    //         }
                    //     })
                    //     dataQuestion.push({'question':$(this).attr('data-name'),'answer':dataAnswer});
                    //     if (status == 0) {
                    //         error = 'yes';
                    //     }
                    // })


                    $('.question_div').each(function(){
						var dataClass = $(this).attr('data-class');
						var status = 0;
						window.dataAnswer = [];
						$('.'+dataClass).each(function(){
							if($(this).prop('checked') == true){
								var valClass = $(this).attr('data-val');
								var contentName =$('.'+valClass).attr('data-tag-name');
								if(contentName == 'input'){
									dataAnswer.push($('.'+valClass).val());
									if(dataAnswer != ''){
										status = 1;
									}
								}else{
									dataAnswer.push($('.'+valClass).html());
									status = 1;
								}
							}
						})
						dataQuestion.push({'question':$(this).attr('data-name'),'answer':dataAnswer});
						if (status == 0) {
							error = 'yes'
							$(this).children(":first").addClass('error_answer')
						}
					})




                    if (error == 'no') {
                        dataQuestion = JSON.stringify(dataQuestion);
                        $('#questionAnswer').val(dataQuestion);
                        //$('.form-submit').submit();
						validation()
                    } else {
                        alert('please select all answer');
                    }
                    $('#mymodal').hide();
                    $('#book_now').removeAttr('data-toggle');
                    $('#book_now').removeAttr('data-target');
                    $('#book_now').addClass('form_submit').attr('type','submit').trigger('click');
                } else {
                    $('#errors').html(data);
                }
            }
        });
	});




    $(document).on('click', '#admin-user-all-check', function() {
        if (!this.checked) {
            $('.admin-user-table-row-checkbox').each(function (index, elem) {
                if (elem.checked) {
                    $(elem).prop('checked', false);
                    //elem.prop('checked', false);
                }
            });
        } else {
            $('.admin-user-table-row-checkbox').each(function (index, elem) {
                if (!elem.checked) {
                    $(elem).prop('checked', true);
                    //elem.prop('checked', true);
                }
            });
        }
    });

    $(document).on('click', '#admin-user-add-but', function() {
        var first_name = $('#admin-user-first-name').val();
        var last_name = $('#admin-user-last-name').val();
        var reemail = $('#admin-user-re-email').val();
        var username = $('#admin-user-username').val();
        var email = $('#admin-user-email').val();
        var password = $('#admin-user-password').val();
        var repassword = $('#admin-user-re-password').val();
        var location = $('#admin-user-location').val();
        var country = $('#select-country').val();
        var city = $('#select-city').val();
        var phone = $('#phone_code').val() + $('#form-mobile').val();
        var pin = $('#pin').val();
        var zip_code = $('#zip_code').val();
        var description = $('#admin-user-description').val();
        var role = $('#admin-user-role').val();
        var active = $('#admin-user-active').val();
        var company = $('#admin-user-company').val();
        var website = $('#admin-user-website').val();
        var photo = $('#admin-user-photo').val();

        // console.log(first_name + ',' + last_name + ',' + email + ',' + password + ',' + location + ',' + country + ',' + city + ',' + phone + ',' + pin + ',' + zip_code + ',' + role + ',' + active + ',' + description);

        if (email === reemail && password === repassword) {
            $.ajax({
                url: 'user-add',
                type: 'post',
                cache: false,
                data: { profile_img: photo, company: company, website: website, first_name: first_name, surname: last_name, email: email, password: password, username: username, location: location, country: country, city: city, zip_code: zip_code, pin: pin, phone: phone, description: description, role: role, active: active },
                success: function (data) {
                    alert('Added Successfully!');
                }
            });
        } else {
            alert('Please confirm your email or password');
        }
    });

    $(document).on('click', '#admin-user-delete', function() {
        var checkboxValues = [];
        $('.admin-user-table-row-checkbox').each( function(index, elem) {
            if (this.checked) {
                checkboxValues.push($(elem).val());
            }
        })

        $.ajax({
            url: 'user-delete',
            type: 'post',
            cache: false,
            data: { checked_values: checkboxValues },
            success: function (data) {
                if (data === 'success') {
                    alert('Deleted!');
                } else {
                    alert('Some Error happens!');
                }
            }
        });
    });

    //$('#admin-user-table tbody tr').on('dblclick', function(event) {
    //    //var selected_id = $(event.target).closest('tr').data('id');
    //    //var sel_check_id = '#selected-user-' + selected_id;
    //    //
    //    //$('#myAdminUserModal').modal('show');
    //});

    $('#admin-user-table tbody tr').on('click', function(event) {

        var selected_id = $(event.target).closest('tr').data('id');
        var sel_check_id = '#selected-user-' + selected_id;

        if ($(sel_check_id).is(':checked')) {
            $(sel_check_id).prop('checked', false);
        } else {
            $(sel_check_id).prop('checked', true);
        }
    });

    $('#crop').click(function(){
    	cropImage();    	
    })

});

	            //url: '/seeker/login-to-task',
	            //type: 'POST',
	    	//	cache:false,
	    	//	data: {email:email, password:password},
	    	//	headers: {'X-CSRF-TOKEN': token},
		  //      success:function(data){
		    //  		if (data == true) {
		      //			window.error = 'no';
			//			window.dataQuestion = [];
			//			$('.question_div').each(function(){
			//				var dataClass = $(this).attr('data-class');
			//				var status = 0;
			//				window.dataAnswer = '';
			//				$('.'+dataClass).each(function(){
			//					if($(this).prop('checked') == true){
			//						var valClass = $(this).attr('data-val');
			//						var contentName =$('.'+valClass).attr('data-tag-name');
			//						if(contentName == 'input'){
			//							dataAnswer = $('.'+valClass).val();
			//							if(dataAnswer != ''){
			//								status = 1;
			//							}
			//						}else{
			//							dataAnswer = $('.'+valClass).html();
			//							status = 1;
			//						}
			//					}
			//				})
			//				dataQuestion.push({'question':$(this).attr('data-name'),'answer':dataAnswer});
			//				if (status == 0) {
			//					error = 'yes'
			//				}
			//			})
			//			if (error == 'no') {		
			//				dataQuestion = JSON.stringify(dataQuestion);
			//				$('#questionAnswer').val(dataQuestion);
			//				//$('.form-submit').submit()
			//				validation()
			//			} else {
			//				alert('please select all answer')
			//			}
		      	//		$('#mymodal').hide(); 
		      	//		$('#book_now').removeAttr('data-toggle');
		      	//		$('#book_now').removeAttr('data-target');
			//	      	$('#book_now').addClass('form_submit').attr('type','submit').trigger('click');
//
//		      		} else {
//		      			$('#errors').html(data);
//		      		}
//	            }
//			});
//	}) 

//})

function validation()
{ 
	var data = [];
	var token = $('#csrf').attr('data');
	$('.validation_text').each(function () {
		data[$(this).attr('name')] = $(this).val()
	});
	console.log(data['choose_date']);
	$.ajax({
		url:'/seeker/task-validation',
		type: 'POST',
		data: { 'category': data['category'],'questions_content':data['questions_content'],'choose_date':data['choose_date'],'description':data['description'],'location':data['location'],'photo':data['photo'] },
	    headers: {'X-CSRF-TOKEN': token},
	    success:function(data){
	    	$('.validator').hide();
	    	$('.validator').html('');
	    	if(data.errors){
	    		var html_content = '';
	    		$.each(data.errors, function(i,v){
	    			html_content += "<li>"+v+"</li>" 
	    		})
	    		$('.validator').show();
	    		$('.validator').html("<li><b>Oops, something went wrong.</b></li>"+html_content);
	    	}
	    	if(data.modal == true){
	    		 $('#myModal').modal({
              			show: 'false'
          			});
	    	}else if(data.error_user){
	    		if( data.error_user == 'true'){
	    			$('#loginModal').modal('show');
	    		}else{
	    			$('.form-submit').submit();
	    		}
	    	}
	    }
	})
}

function makeCropping()
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
		    //$dataRotate = $('#dataRotate'),
	    options = {
	    	aspectRatio: 1/1,
	      	preview: '.img-preview',
	      	crop: function (data) {

	        	$dataHeight.val(Math.round(data.height));
	        	$dataWidth.val(Math.round(data.width));
	        	//$dataRotate.val(Math.round(data.rotate));
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

function cropImage()
{
	setTimeout(function () {
    	var token = $('#csrf').attr('data'),
			nameData = $('#imagName').val(),
			cropData = $('#putData').val();
		if(cropData != ''){
			$.ajax({	
				url: '/users/image-crop',
		        type: 'POST',
		        cache:false,
		        data: {name:nameData, crop:cropData},
		        headers: {'X-CSRF-TOKEN': token},
		        success:function(data){
		        	var img_name = data.name;
					var img_path = "/assets/uploads/"+img_name+""
					$('.prof').attr('src',img_path);
					$('#photo_name').val(img_name);
					$('#user_img').attr('src',img_path)
					$('#admin-user-photo').val(data.name);
		        }
		    })
		}
    }, 300);
	
}
