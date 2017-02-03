$(document).ready(function(){
	window.categoryData = [];
	window.categoryCount = 0;
	$('#category').on('change',function(){

		if(categoryCount <5){
			$('.validator_seeker').hide();
			if($(this).val() != ''){
				categoryCount ++;
				$('#category_child_content').show()
				var val = $(this).val(),
					name = $("#category option[value='"+val+"']").text();
				categoryData.push(val)
				$(this).val('');
				$("#category option[value='"+val+"']").hide();
				$('#category_content').append("<div class='col-md-12'><div class='category'><a href='#'>"+name+"</a><img src='/assets/img/profile/Removecategory.png' alt="+val+" data-val="+name+" class='remove_category'></div></div>");
			}
		}else{
			if($(this).val() != ''){
				$('.validator_seeker').show();
		    	$('.validator_seeker').html("<li><b>Oops, something went wrong.</b></li><li>You are limited to 5 categories</li>");
			}
		}
	})

	$(document).on('click','.remove_category',function(){
		categoryCount --;
		$('.validator_seeker').hide();
		$(this).parent().parent().remove();
		var id = $(this).attr('alt'),
			name = $(this).prev().text();
		categoryData = categoryData.filter(function(elem){
            return elem != id;
        })
        $("#category option[value='"+id+"']").show();
        // var selectContent = $('#category').html(),
        // 	html = selectContent+'<option value="'+id+'">'+name+'</option>';
        // $('#category').html(html)
	})

	$('.sign_up_provider').click(function(){
		$('#categoryData').val(categoryData);
	})

	$('#tab_seeker').click(function(){
		$('.validator_provider').hide();
	    $('.validator_provider').html(''); 
	})
	$('#tab_provider').click(function(){
		$('.validator_seeker').hide();
	    $('.validator_seeker').html('');
	})
	$('.sign_up_seeker').click(function(){
		
		var data = [];
		var token = $('#token_user').attr('data');
		$('.seeker_validation').each(function () {
			data[$(this).attr('name')] = $(this).val()
		});
		$.ajax({
			url:'/users/registration-validation',
			type: 'POST',
			data: { 'username': data['username'],'email':data['email'],'password':data['password'],'password_confirmation':data['password_confirmation'],'phone':data['phone'],'zip_code':data['zip_code'],'country':data['country'],'city':data['city'],'role':data['role'],'phone_prefix':data['phone_prefix'] },
		    headers: {'X-CSRF-TOKEN': token},
		    success:function(data){
		    	$('.validator_seeker').hide();
	    		$('.validator_seeker').html('');
		    	if(data.errors){
		    		var html_content = '';
		    		$.each(data.errors, function(i,v){
		    			html_content += "<li>"+v+"</li>" 
		    		})
		    		
		    		$('.validator_seeker').show();
		    		$('.validator_seeker').html("<li><b>Oops, something went wrong.</b></li>"+html_content);
		    	}else if(data.error_danger){
		    		
		    		$('.validator_seeker').show();
		    		$('.validator_seeker').html("<li><b>Oops, something went wrong.</b></li><li>"+data.error_danger+"</li>");
		    	}else if(data.error_reg){
		    		
	    			$('#registration_seeker').submit();
	    		}
	    	}
		})
	})
	$('.sign_up_provider').click(function(){
		var data = [];
		var token = $('#token_user').attr('data');
		$('.provider_validation').each(function () {
			data[$(this).attr('name')] = $(this).val()
		});
		$.ajax({
			url:'/users/registration-validation',
			type: 'POST',
			data: { 'username': data['username'],'email':data['email'],'password':data['password'],'password_confirmation':data['password_confirmation'],'phone':data['phone'],'zip_code':data['zip_code'],'country':data['country'],'city':data['city'],'role':data['role'],'company':data['company'],'website':data['website'],'phone_prefix':data['phone_prefix'] },
		    headers: {'X-CSRF-TOKEN': token},
		    success:function(data){
		    	$('.validator_provider').hide();
	    		$('.validator_provider').html('');
		    	if(data.errors){
		    		var html_content = '';
		    		$.each(data.errors, function(i,v){
		    			html_content += "<li>"+v+"</li>" 
		    		})
		    		$('.validator_provider').show();
		    		$('.validator_provider').html("<li><b>Oops, something went wrong.</b></li>"+html_content);
		    	}else if(data.error_danger){
		    		$('.validator_provider').show();
		    		$('.validator_provider').html("<li><b>Oops, something went wrong.</b></li><li>"+data.error_danger+"</li>");
		    	}else if(data.error_reg){
	    			$('#registration_provider').submit();
	    		}
	    	}
		})
	})
})