"use strict";
(function(){
	var app = {
		"init" : function(){
			$('form').on("submit", app.listen_event);
		},
		"listen_event" : function(data){
			data.preventDefault();
			var inputs = $(this).find('input[type != submit]');
			if (app.check_void(inputs)){
					var url = "/";
					if ((/\/reg\//.test(window.location.pathname) )) url = "/reg/add_account";
					else if ((/\//.test(window.location.search) )) url = "/auth_user";
					$.ajax({
					  url: '/',
					  data: [],
					  type: "POST",
					  success: function(){
						 window.location.reload();
					  }
					});
				}
					
		},
		"check_void" : function(inputs){
				var valid = true;
				$.each(inputs,function(index, val){
					var input = $(val);
					var value = input.val();
					var span_parent = input.parent().find('span');
					//console.log(span_parent)
					if (value.length === 0){
						// true
						input.addClass('check_void_false').removeClass('check_void_true');
						span_parent.addClass('check_void_false').removeClass('check_void_true');
						valid = false;
					}else {
						input.addClass('check_void_true').removeClass('check_void_false');
						span_parent.addClass('check_void_true').removeClass('check_void_false');
						// false
					}			
				});


				return valid;
			}

	};
	app.init();
}());