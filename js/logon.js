window.Logon  = {
	init : function(){
		var self = this;
		jQuery('#loginButton').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			self.login();
			return false;
		});
	},
	login : function(){

		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ,
			data	= jQuery('form#login').serialize() ;
			url += 'examstore/login';

			jQuery.ajax({
				url : url,
				type: 'POST' ,
				data: data,
				dataType: "json",
				success: function(response){

					if(response != "undefined" && response != null){
						if(response.IsLoggedIn){
							window.location = response.route;
						}else{
							alert('ไม่สามารถเข้าสู่ระบบได้ กรุณาลองใหม่อีกครั้ง');
						}
					}
				}	
			});		

	},authen : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			url += 'examstore/authen';

			jQuery.ajax({
				url : url,
				type: 'POST' ,
				dataType: "json",
				success: function(response){

					if(response != "undefined" && response != null){
						if(response.info == null) {
							window.location = response.route;
						};
						if(!response.info.isLoggedIn){
							alert('ท่านไม่สามารถเข้าใช้งานได้ กรุณาล๊อกอินเข้าระบบอีกครั้ง');
						}
						jQuery('#username').html(response.info.username);
					}
				}	
			});		
	},
	authenCallback : function(){

	}
};
