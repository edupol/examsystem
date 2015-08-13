// JavaScript Document
window.Setting = {
	testAPI 	: '//192.168.8.69/examsystem/api/',
	serverAPI 	: '//edupol.org/api/',
	isTest  	: true,
	isError     : false,
	userType    : 0,
	userID 		: 0,
	page 		: function(){
		if(typeof window.URL.getUriObject == "function"){
			var	urlData  = window.URL.getUriObject(window.self.location.href);
			return urlData.file;
		}
		return null;
	},
	exams : Array(),
	assignments : Array(),
	randomQuestion : Array()
};

window.Tiktok = {
	timeLoop 			: null,
	countTime 			: null,
	uTime 				: null,
	callback 			: null,
	start : function(){
		var self 		= window.Tiktok;
		self.countTime 	= self.countTime-1;
		self.uTime		= self.uTime+1; 
		jQuery('#StartClock').html(self.getTime(self.uTime));
		jQuery('#EndClock').html(self.getTime(self.countTime));
		
		if(self.countTime==0){ 
			clearInterval(self.timeLoop); 
			window.TestExam.submitAnswer();
			// if(typeof callback == 'function'){
			// 	window.location 
			// }
		}

	},
	stop : function(){
		clearInterval(self.timeLoop);
	},countDown : function(second,alltime){ 
		var self 		= this;
		self.countTime 	= second;  
		self.uTime		= alltime - self.countTime;
		self.timeLoop 	= setInterval(self.start,1000);
	},
	getTime : function(sTime){
		var hour,minute,second;
		hour=Math.floor(sTime/3600);
		if(hour<10) hour='0'+hour;
		minute=Math.floor((sTime%3600)/60);
		if(minute<10) minute='0'+minute;
		second=(sTime%3600)%60;
		if(second<10) second='0'+second;
		return hour+':'+minute+':'+second;		
	}
}

// jQuery.browser = {};
// jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit    /.test(navigator.userAgent.toLowerCase());
// jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
// jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
// jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());

Array.prototype.containsExam = function(obj) {
    var i = this.length;
    while (i--) {
        if (this[i].id === obj) {
            return true;
        }
    }
    return false;
}



Array.prototype.removeExam = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && window.Setting.exams.length) {
        what = a[--L];
        ax = window.Setting.exams.filter(function (el) {
                        return el.id !== what;
            });
    }
    return ax
}

jQuery.download = function(url, data, method){
	//url and data options required
	if( url && data ){ 
		//data can be string of parameters or array/object
		data = typeof data == 'string' ? data : jQuery.param(data);
		//split params into form inputs
		var inputs = '';
		jQuery.each(data.split('&'), function(){ 
			var pair = this.split('=');
			inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />'; 
		});
		//send request
		jQuery('<form action="'+ url +'" method="'+ (method||'post') +'">'+inputs+'</form>')
		.appendTo('body').submit().remove();
	};
};

window.MyTour = {
	init : function(){
	    //tour
	    if ($('.tour').length && typeof(tour) == 'undefined') {

	        var tour = new Tour({
	            storage : false
	        });

	        tour.addStep({
	            element: "#addExamBox", /* html element next to which the step popover should be shown */
	            placement: "top",
	            title: "ขั้นตอนที่ 1", /* title of the popover */
	            content: "เลือกหลักสูตร กลุ่มวิชา และ วิชาจากนั้นกดปุ่ม เพิ่มวิชาลงในข้อสอบ" /* content of the popover */
	        });
	        tour.addStep({
	            element: "#addNums",
	            placement: "top",
	            title: "ขั้นตอนที่ 2",
	            content: "ระบุจำนวนข้อสอบของแต่ละวิชา สามารถลบรายการวิชาข้อสอบได้โดยกดปุ่มลบวิชาด้านขวามือของแต่ละรายการ"
	        });
	        tour.addStep({
	            element: "#examBox",
	            placement: "top",
	            title: "ขั้นตอนที่ 3",
	            content: "ระบุชื่อแบบทดสอบ จากนั้นตรวจสอบข้อสอบ สามารถสุ่มข้อสอบซ้ำได้โดยการกดปุ่ม สุ่มข้อสอบ อีกครั้ง "
	        });
	        tour.addStep({
	            element: "#exportDocument",
	            placement: "top",
	            title: "ขั้นตอนที่ 4",
	            content: "กดปุ่มด้านล่างเพื่อดาว์นโหลดไฟล์ข้อสอบในรูปแบบเอกสาร word"
	        });

	        // Initialize method on the Tour class. Get's everything loaded up and ready to go.
	        tour.init();
	         
	        // This starts the tour itself
	        tour.start();
	    } 	
	}
};

window.FixIE = {
	init : function(){
		var self = this;
		self.fixPlaceholder();
	},
	fixPlaceholder : function(){
	    if (/msie/.test(navigator.userAgent.toLowerCase())) {         //this is for only ie condition ( microsoft internet explore )

	        $('input[type="text"][placeholder], textarea[placeholder]').each(function () {
	            var obj = $(this);

	            if (obj.attr('placeholder') != '') {
	                obj.addClass('IePlaceHolder');

	                if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
	                    obj.val(obj.attr('placeholder'));
	                }
	            }
	        });

	        $('.IePlaceHolder').focus(function () {
	            var obj = $(this);
	            if (obj.val() == obj.attr('placeholder')) {
	                obj.val('');
	            }
	        });

	        $('.IePlaceHolder').blur(function () {
	            var obj = $(this);
	            if ($.trim(obj.val()) == '') {
	                obj.val(obj.attr('placeholder'));
	            }
	        });
	    }

	}

};


window.RegisterProxy = {
	getRanks : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'ranks',
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="rank"]'),
					option 	  = jQuery('<option>');

				jQuery.each(response,function(i,e){
					
					var currentOption = option.clone().attr('value',e.id).html( e.short_name );
					container.append(currentOption);

				});

				container.chosen().trigger("chosen:updated");
			}	
		});	
	},
	getDivisions : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'divisions',
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="division"]'),
					option 	  = jQuery('<option>');
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.full_name );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
			}	
		});	
	},
	AddressEvents : function(){
		
		window.RegisterProxy.getProvinces();
		
		var self = this;
		
		jQuery('select[name="province"]').on('change',function(){			
			var provinceID = jQuery(this).val();
			jQuery('select[name="district"]').empty();
			jQuery('select[name="subdistrict"]').empty();
			self.getDistricts(provinceID);			
		});
		
		jQuery('select[name="district"]').on('change',function(){			
			var districtID = jQuery(this).val();
			jQuery('select[name="subdistrict"]').empty();
			self.getSubDistricts(districtID);			
		});
		
		jQuery('select[name="division"]').trigger('change');		
	},
	getProvinces : function(divisionID){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'provinces';

		if(window.Setting.userType == 1 && divisionID != null){
				url += '/' +divisionID;
		}
		
		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="province"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.PROVINCE_ID).html( e.PROVINCE_NAME );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});					
	},
	getDistricts : function(id){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'districts/' + id,
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="district"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.AMPHUR_ID).html( e.AMPHUR_NAME );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});	
	},	
	getSubDistricts : function(id){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'subdistricts/' + id,
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="subdistrict"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.DISTRICT_ID).html( e.DISTRICT_NAME );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});	
	},
	getSections : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'sections',
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="sections"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
			}	
		});	
	},
	getSquads : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'squads',
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="squads"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
			}	
		});	
	},	
	getPositions : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		jQuery.ajax({
			url : url + 'positions',
			type: 'GET',
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="position"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response,function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.full_name );
					container.append(currentOption);	
				});
				container.chosen().trigger("chosen:updated");
			}	
		});			
	},
	save : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ,
			data 	=  jQuery('form#Register').serialize(),
			name 	= jQuery('input[name="first_name"]').val(),
			lastname 	= jQuery('input[name="last_name"]').val(),
			email 	= jQuery('input[name="email"]').val(),
			phone 	= jQuery('input[name="phone"]').val();
			data += '&iedupoll_type_id=4';
			
			if(name == ""){
				alert('กรุณากรอกข้อมูลชื่อ');
				return false;
			}
			if(lastname == ""){
				alert('กรุณากรอกข้อมูลนามสกุล');
				return false;
			}			
			if(phone == ""){
				alert('กรุณากรอกข้อมูลเบอร์โทรศัพท์');
				return false;
			}		
			if(email == ""){
				alert('กรุณากรอกข้อมูลอีเมล์');
				return false;
			}else{
			   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
			   if(!emailReg.test(email)) {  
					alert("รูปแบบของอีเมล์ไม่ถูกต้องกรุณากรอกใหม่");
					return false;
			   }  				
			}

			jQuery.ajax({
				url : url + 'examstore/regis',
				type: 'POST',
				data: data,
				dataType:"json",
				success: function(response){
					if(response == null)return false;
					if(!response.isError){
						alert(response.message);
						window.location = response.route;	
					}
				}	
			});	
	}
};

window.Register = {
	init : function(){
		var self = this;
		window.RegisterProxy.getRanks();	
		window.RegisterProxy.getDivisions();	
		window.RegisterProxy.AddressEvents();
		window.RegisterProxy.getPositions();
		//window.RegisterProxy.getSquads();
		//window.RegisterProxy.getSections();
		self.setTypeahead();
		jQuery('button[type="submit"]').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			window.RegisterProxy.save();
			return false;
		});

		//checking username 
		jQuery("input#username").on('keyup',function (e) { //user types username on inputfiled
			e.preventDefault();
			e.stopPropagation();
			self.checkUsernameAvailability();
		});
	},
	checkUsernameAvailability : function(){
		   var username = jQuery("input#username").val(),//get the string typed by user
		   	   url 		= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI; 
		   $.post(url + 'examstore/username/check', {'username':username}, function(data) { //make ajax call
		   		//if(data.isError) alert(data.message);
		   		$("#user-result").html(data.image); //dump the data received from PHP page
		   		window.Setting.isError = data.isError;

		   });
	}, 
	setTypeahead : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI;

		var belongto = new Bloodhound({
		  datumTokenizer: Bloodhound.tokenizers.whitespace,
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  remote: {
		    url: url+'division/belongto?q=%QUERY',
		    wildcard: '%QUERY'
		  }

		});
		 
		// passing in `null` for the `options` arguments will result in the default
		// options being used
		$('.typeahead').typeahead(null, {
		  name: 'name',
		  display: 'name',
		  source: belongto
		});

	}
};

window.ChangePassword = {
	init : function(){
		var self = this;

		jQuery('.save').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			
			self.update();

		});
	},
	update : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ,
			data 	=  jQuery('form#Register').serialize(),		
			oldpass 		= jQuery('input[name="password"]').val(),	
			newpass 		= jQuery('input[name="new_password"]').val(),
			confirmpass 	= jQuery('input[name="confirm_password"]').val();
			
			
			if(oldpass == ""){
				alert('กรุณาระบุรหัสผ่านเดิม');
				return false;
			}			
			if(newpass == ""){
				alert('กรุณาระบุรหัสผ่านใหม่');
				return false;
			}			
			if(confirmpass == ""){
				alert('กรุณาระบุยืนยันรหัสผ่านใหม่');
				return false;
			}		
			if(newpass != confirmpass){
				alert('กรุณาตรวจสอบรหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ให้ถูกต้อง');
				return false;
			}
			if(window.Setting.isError){
				alert('กรุณาตรวจสอบความถูกต้องของแบบฟอร์มอีกครั้ง');
				return false;
			}
			jQuery.ajax({
				url : url + 'examstore/changepwd',
				type: 'POST',
				data: data,
				dataType:"json",
				success: function(response){
					if(response == null)return false;
					if(!response.isError){
						alert(response.message);
						window.location = response.route;
						return false;
					}
				}	
			});
	}
};

window.ManagExamProxy = {
	getExamCourse : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'examstore/course';

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="examcourse"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				jQuery('#totalCourse').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});				
	},
	getExamGroups : function(courseID){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'examstore/groups/' + courseID;

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response[0] == null)return false;
				var container = jQuery('select[name="examgroup"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				jQuery('#totalGroup').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});		
	},
	getExams : function(groupID){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'examstore/exams/' + groupID;

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response[0] == null)return false;
				var container = jQuery('select[name="exams"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
					
				});
				jQuery('#totalExam').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});		
	}

};

window.ManagExam = {
	init : function(){

		var self = this;

		window.ManagExamProxy.getExamCourse();
		
		jQuery('select[name="examcourse"]').on('change',function(){			
			var courseID = jQuery(this).val();
			jQuery('select[name="examgroup"]').empty().trigger("chosen:updated");
			jQuery('#totalExam,#totalGroup').val(0);
			window.ManagExamProxy.getExamGroups(courseID);			
		});

		jQuery('select[name="examgroup"]').on('change',function(){			
			var groupID = jQuery(this).val();
			jQuery('select[name="exams"]').empty().trigger("chosen:updated");
			jQuery('#totalExam').val(0);
			window.ManagExamProxy.getExams(groupID);			
		});		

		jQuery('#addExam').on('click',function(){

			var examSelector  	= jQuery('select[name="exams"] option:selected'),
				examID 	 		= examSelector.val(),
				examinuteame 	= examSelector.text(),
				examsContainer  = jQuery('#ExamsContainer'),
				div 			= jQuery('<div>'),
				label 			= jQuery('<label>'),
				input			= jQuery('<input>'),
				link 			= jQuery('<a> ลบวิชา</a>'),
				icon 			= jQuery('<i>'),
				total 			= 0;

			if(window.Setting.exams.containsExam(examID) || examinuteame == null ||examID  == null) return false;
			window.Setting.exams.push( { 'id' : examID ,'name' : examinuteame ,'num' : 0  });

			div.clone().addClass('row').append(
				div.clone().addClass('col-md-7 col-sm-10').append(
					label.clone().text('ชื่อวิชา'),
					input.clone().addClass('form-control exam-name')
								 .attr({
								 		'disabled' : 'disabled'
								 }).val(examinuteame)
				),
				div.clone().addClass('col-md-3 col-sm-10').append(
					label.clone().text('จำนวนข้อสอบ'),
					input.clone().addClass('form-control exam-name')
									.val(0)
									.on('change',function(){
										var num = jQuery(this).val();
										window.Setting.exams = self.setExaminutenum(examID,num);	
										total = self.getTotalNums();	
										jQuery('#totalQuestions').html(total);								
									})
				),
				div.clone().addClass('col-md-2 col-sm-10 red padd-top-25').append(
					link.clone().addClass('btn btn-danger btn-md').prepend(
						icon.clone().addClass('glyphicon glyphicon-minus glyphicon-white')
					).on('click',function(){
						self.deleteExam(this,examID);
						total = self.getTotalNums();
						jQuery('#totalQuestions').html(total);
					})
				),				
				div.clone().addClass('col-md-2 col-sm-10')
			).appendTo(examsContainer);

		});


		jQuery('#randomExam').on('click',function(){
			self.randomExam();
		})

		jQuery('#exportDocument').on('click',function(){
			self.exportExam();
		})		

	    jQuery('input[name="exam_minute"]').keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A
	            (e.keyCode == 65 && e.ctrlKey === true) || 
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });		

	},deleteExam : function(deleteBtn,examID){

		jQuery(deleteBtn).parent().parent().remove();
		//remove			
		window.Setting.exams = window.Setting.exams.removeExam(examID);

	},setExaminutenum : function(obj,num) {

	    var data = window.Setting.exams,
	    	i 	 = data.length;
	    while (i--) {
	        if (data[i].id === obj) {
	            data[i].num = num;
	        }
	    }

	    return data;
	},randomExam : function(){
		var self 	= this,
			data 	= window.Setting.exams,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		url += 'examstore/random';

		jQuery.ajax({
			url : url,
			type: 'POST' ,
			data: 'data=' + JSON.stringify(data),
			dataType: "json",
			success: function(response){

				if(response != "undefined" && response != null){
					if(!response.isError){
						self.renderQuestions(response.exams);
					}
				}
			}	
		});		
	},getTotalNums : function(){
	    var data 	= window.Setting.exams,
	    	i 	 	= data.length,
	    	total 	= 0;
	    while (i--) {
	        total +=  parseInt(data[i].num);
	    }
	    return total;
	},renderQuestions : function(questions){
		var self = this,
			div  = jQuery('<div>'),
			br   = jQuery('<br/>'),
			questionsContainer = jQuery('#QuestionsContainer');
			questionsContainer.empty();
			
			if(questions != null && typeof questions != "undefined"){
				jQuery.each(questions,function(i,v){
					questionsContainer.append(
							div.clone().append( i + 1 +'. '+ v.qtn),
							div.clone().append('1.' +' '+ v.ans1),
							div.clone().append('2.' +' '+v.ans2),
							div.clone().append('3.' +' '+v.ans3),
							div.clone().append('4.' +' '+v.ans4),
							br.clone()
						);
				});
			}
	},exportExam : function(){
		var self = this;
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			url += 'examstore/export';

			jQuery.ajax({
				url : url,
				type: 'POST' ,
				dataType: "json",
				success: function(response){

					if(response != "undefined" && response != null){
						self.exportWord(response);
					}
				}	
			});		

	},exportWord : function(results){
		if(results.questions == null || results.user_id == null) return false;

		var name 	= jQuery('input[name="name"]').val(),
			minute  = jQuery('input[name="exam_minute"]').val(),
			randomQuestions = jQuery('input[name="random_questions"]').val();

		if(name == ""){
			alert('กรุณากรอกข้อมูลชื่อแบบทดสอบ');
			return false;
		}else if(minute == ""){
			alert('กรุณากรอกข้อมูลเวลาที่ใช่สำหรับทำแบบทดสอบ');
			return false;
		}

		jQuery('#questions_id').val(results.questions_id);
		jQuery('#randomQuestions').val(results.questions);
		jQuery('#uid').val(results.user_id);
		jQuery('#examSubmit').submit();
	}
};

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

window.ListOfExams = {
	init : function(){
		var self = this;
		self.setDataTable();
	},getUser : function(cb){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			url 	+= 'examstore/user/id';

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType: "json",
			success: function(response){

				if(response != "undefined" && response != null){
					if(typeof cb =="function"){
						cb(response);	
					}
				}
			}	
		});		
	},setDataTable : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			url 	+= 'examstore/history';

		//datatable
		jQuery('.datatable').dataTable({
		    "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'i><'col-md-12 center-block'p>>",
		    "sPaginationType": "bootstrap",
		    "oLanguage": {
		        "sLengthMenu": "_MENU_ records per page"
		    },
		     "ajax": url,
		     "columns" : [{ "data": "exam_code" },{ "data": "name" },{ "data": "minute" },{ "data": "datetime" },
            {
                sortable: false,
                "render": function ( data, type, full, meta ) {
                	if(data == full) return false;
                    var buttonID = full.exam_id,
                    	btn = '<a id="'+buttonID+'" href="export_exam.php" class="word btn btn-success customFont fix-font1" role="button"><i class="glyphicon glyphicon-list-alt icon-white"></i>  ข้อสอบ</a>';
                    	btn += '   <a id="'+buttonID+'" href="export_excel.php" class="excel btn btn-info customFont " role="button"><i class="glyphicon glyphicon-th-large icon-white"></i>  เฉลย</a>';
                    	btn += '   <a id="'+buttonID+'" href="exam_assignment.php" class="assignment btn btn-warning customFont fix-font1" role="button"><i class="glyphicon glyphicon-list-alt icon-white"></i>  กำหนดการสอบ</a>';
                	return btn;
                }
            }            
            ],
          
		});		


		jQuery('.datatable').on('click','.word,.excel,.assignment',function(e){
			e.preventDefault();
			e.stopPropagation();
			var route = jQuery(this).attr('href'),
				exam_id = jQuery(this).attr('id');
			self.getUser(function(response){
				jQuery('input[name="user_id"]').val(response.user_id);	
				jQuery('input[name="exam_id"]').val(exam_id);				
				jQuery('#examSubmit').attr({'action':route}).submit();				
			});
		});

	}
};

window.TestExam = {
	init : function(){
		var self = this;

		self.load();

		jQuery('#saveAnswer').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			self.submitAnswer();
		});
	},
	load : function(){
		if(window.URL.get('exam_id') !== false){

			var self 	= this,			
				id 		= window.URL.get('exam_id'),
				url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

			url += 'examstore/load/'+id;

			jQuery.ajax({
				url : url,
				type: 'POST' ,
				dataType: "json",
				success: function(response){
					if(response != "undefined" && response != null){
						if(!response.isError){
							
							self.renderQuestions(response);

						}
					}
				}	
			});			
		}
	},
	renderQuestions : function(response){
		var self 				= this,
			all_questions 		= response.random_questions,
			div  				= jQuery('<div>'),
			breakline   		= jQuery('<div class="clearfix">'),
			ans  				= jQuery('<input type="radio" >'),
			index 				= 1,
			fast_forward		= jQuery('<a href="#" class="scroll-to glyphicon glyphicon-circle-arrow-down back-to-bottom"></a>'),
			fast_backward 		= jQuery('<a href="#" class="scroll-to glyphicon glyphicon-circle-arrow-up back-to-bottom"></a>'),
			forward 			= jQuery('<a href="#" class="scroll-to glyphicon glyphicon-forward back-to-bottom"></a>'),
			backward 			= jQuery('<a href="#" class="scroll-to glyphicon glyphicon-backward back-to-bottom"></a>'),
			questionsContainer 	= jQuery('.box-content');
			questionsContainer.empty(),
			currentOffset  		= 0;

			if(response.name != null){
				jQuery('span#examText').html(response.name);	
			}

			if(response.exam_minute != null){
				var totalTime = parseInt(response.exam_minute) * 60;
				window.Tiktok.countDown(totalTime,totalTime);
				window.Tiktok.start();
			}

			if(typeof all_questions != "undefined" &&  all_questions != null ){
				var total = all_questions.length;
				jQuery('#totalExam').html(total);
				jQuery.each(all_questions,function(i,v){
					var color 		=  (index % 2 == 0)? 'exam-hilight':'',
						questionID 	= '#q' + index ;

						a = div.clone().attr({ 'id' : questionID }).addClass('question-box ' + color).append(
							div.clone().append(index +'. '+ v.qtn),
							div.clone().append(ans.clone().attr({'name':'ans['+index +']','value': 1 }),' 1.' +' '+ v.ans1),
							div.clone().append(ans.clone().attr({'name':'ans['+index +']','value': 2 }),' 2.' +' '+v.ans2),
							div.clone().append(ans.clone().attr({'name':'ans['+index +']','value': 3 }),' 3.' +' '+v.ans3),
							div.clone().append(ans.clone().attr({'name':'ans['+index +']','value': 4 }),' 4.' +' '+v.ans4),
							breakline.clone()
					);
					
					if( index % 5 == 0){
						var qid = index; 
						a.append(

							fast_backward.clone().on('click',function(e){ 
								e.preventDefault();
								e.stopPropagation();
								currentOffset -= 700;	
								//var targetOffset = jQuery(this).offset().top;								 
								jQuery('.box-content').animate({ scrollTop : currentOffset }, 700);								
								return false;
							}),
							//backward.clone(),
							//forward.clone(),
							fast_forward.clone().on('click',function(e){ 
								e.preventDefault();
								e.stopPropagation();
								currentOffset += 1100;	
								//var targetOffset = jQuery('.box-content')[0].scrollHeight;
								//var targetOffset = jQuery(this).offset().top;	
								jQuery('.box-content').animate({ scrollTop : currentOffset }, 700);	
								return false;
							})

						);
					}
					a.appendTo(questionsContainer);
					index++;
				});

			}		
	},
	submitAnswer : function(){

		var self 	= this,			
			data = jQuery('form#answers').serialize(),
			id 		= window.URL.get('exam_id'),
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		url += 'examstore/save/'+id;

		jQuery.ajax({
			url : url,
			type: 'POST' ,
			data: data,
			dataType: "json",
			success: function(response){
				if(response != "undefined" && response != null){
					alert(response.message);
					window.location = response.route;
				}
			},
			error : function(jqXHR,textStatus,errorThrown){
				alert(errorThrown);
				window.location = 'list_of_test.php';
			}
		});		
	}
};

window.ExamAssignment = {
	init : function(){
		var self = this;
		self.getTrainingPalce();

		jQuery('select[name="trainingplace"]').on('change',function(){		                                                                                                                                                                                                                                                                                                                                                                                                                                                                        	
			var courseID = jQuery(this).val();
			jQuery('select[name="trainingcourse"]').empty().trigger("chosen:updated");
			jQuery('#totalCourse,#totalNum').val(0);
			window.ExamAssignment.getTrainingCourse(courseID);			
		});

		jQuery('select[name="trainingcourse"]').on('change',function(){			
			var courseID = jQuery(this).val();
			jQuery('select[name="coursenumber"]').empty().trigger("chosen:updated");
			jQuery('#totalNum').val(0);
			window.ExamAssignment.getCourseNumber(courseID);			
		});	

		jQuery('#addExam').on('click',function(){

			var assignmentSelector  	= jQuery('select[name="coursenumber"] option:selected'),
				CourseName  	= jQuery('select[name="trainingcourse"] option:selected').text(),
				assignmentID 	 		= assignmentSelector.val(),
				coursenumber 	= assignmentSelector.text(),
				assignmentContainer  = jQuery('#AssignmentContainer'),
				div 			= jQuery('<div>'),
				label 			= jQuery('<label>'),
				input			= jQuery('<input>'),
				link 			= jQuery('<a> ลบหลักสูตร</a>'),
				icon 			= jQuery('<i>'),
				total 			= 0;

			if(window.Setting.exams.containsExam(assignmentID) || coursenumber == null ||assignmentID  == null) return false;
			window.Setting.exams.push( { 'student_course_id' : assignmentID ,'name' : coursenumber ,'num' : 0 , 'assign_by' : jQuery('input[name="assign_by"]').val() ,'exam_random_history_id' : jQuery('input[name="exam_random_history_id"]').val()  });
			total = self.getTotalNums();
			jQuery('#totalQuestions').html(total);
			div.clone().addClass('row').append(
				div.clone().addClass('col-md-9 col-sm-10').append(
					label.clone().text('ชื่อวิชา'),
					input.clone().addClass('form-control exam-name')
								 .attr({
								 		'disabled' : 'disabled'
								 }).val(CourseName +' รุ่นที่ '+ coursenumber)
				),
				div.clone().addClass('col-md-3 col-sm-10 red padd-top-25').append(
					link.clone().addClass('btn btn-danger btn-md').prepend(
						icon.clone().addClass('glyphicon glyphicon-minus glyphicon-white')
					).on('click',function(){
						self.deleteCourse(this,assignmentID);
						total = self.getTotalNums();
						jQuery('#totalQuestions').html(total);
					})
				),				
				div.clone().addClass('col-md-2 col-sm-10')
			).appendTo(assignmentContainer);

		});

		jQuery('#save').on('click',function(){
			self.save();
		});

		jQuery('.assignment-date').datepicker({
			 format: 'dd/mm/yyyy',
		});

	},deleteCourse : function(deleteBtn,examID){

		jQuery(deleteBtn).parent().parent().remove();
		//remove			
		window.Setting.exams = window.Setting.exams.removeExam(examID);

	},getTotalNums : function(){
	    var data 	= window.Setting.exams,
	    	i 	 	= data.length;
	    return i;
	},
	getTrainingPalce : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'course/place';

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response == null)return false;
				var container = jQuery('select[name="trainingplace"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				jQuery('#totalPlace').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});				
	},
	getTrainingCourse : function(courseID){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
		
		url += 'course/' + courseID;

		jQuery.ajax({
			url : url,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response[0] == null)return false;
				var container = jQuery('select[name="trainingcourse"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.name );
					container.append(currentOption);	
				});
				jQuery('#totalCourse').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});		
	},	
	getCourseNumber : function(courseID){
		var self 	= this,
			training_place_id = jQuery('select[name="trainingplace"]').val(),
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			
		url += 'course/number/' + courseID;

		jQuery.ajax({
			url : url + '?training_place_id='+training_place_id,
			type: 'GET' ,
			dataType:"json",
			success: function(response){
				if(response[0] == null)return false;
				var container = jQuery('select[name="coursenumber"]'),
					option 	  = jQuery('<option>');
				container.empty();
				jQuery.each(response[0],function(i,e){
					var currentOption = option.clone().attr('value',e.id).html( e.number );
					container.append(currentOption);	
					
				});
				jQuery('#totalNum').html(response[1][0].num);
				container.chosen().trigger("chosen:updated");
				container.first().trigger('change');
			}	
		});		
	},save : function(){
		if(window.Setting.exams[0] == null) return;
		window.Setting.exams[0].startAssignment = jQuery('#startAssignment').val();
		window.Setting.exams[0].endAssignment = jQuery('#endAssignment').val();

		var self 	= this,
			data 	= JSON.stringify(window.Setting.exams),
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;

		url += 'exam/assignment';

		jQuery.ajax({
			url : url,
			type: 'POST' ,
			data: 'data=' + data,
			dataType: "json",
			success: function(response){

				if(response != "undefined" && response != null){
					alert(response.message);
				}
			}	
		});		
	}
}

window.ListOfTests = {
	init : function(){
		var self = this;
		self.setDataTable();
	},setDataTable : function(){
		var self 	= this,
			url 	= (window.Setting.isTest)? window.Setting.testAPI : window.Setting.serverAPI ;
			url 	+= 'exam/assignment/me';

		//datatable
		jQuery('.datatable').dataTable({
		    "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'i><'col-md-12 center-block'p>>",
		    "sPaginationType": "bootstrap",
		    "oLanguage": {
		        "sLengthMenu": "_MENU_ records per page"
		    },
		     "ajax": url,
		     "columns" : [{ "data": "exam_random_history_id" },{ "data": "name" },{ "data": "exam_minute" },{ "data": "datetime" },
            {
                sortable: false,
                "render": function ( data, type, full, meta ) {
                	if(data == full) return false;
                    var buttonID = full.id,
                    	btn = '<a id="'+buttonID+'" href="test.php?exam_id='+buttonID+'" class="word btn btn-success customFont0 fix-font1 " role="button"><i class="glyphicon glyphicon-list-alt icon-white"></i>  ทำข้อสอบ</a>';
                    	btn += '   <a id="'+buttonID+'" href="#result.php" class="excel btn btn-info customFont0 fix-font1" role="button"><i class="glyphicon glyphicon-th-large icon-white"></i>  ตรวจสอบผล</a>';
                	return btn;
                }
            }            
            ],
          
		});		


		jQuery('.datatable').on('click','.word,.excel,.assignment',function(e){
			e.preventDefault();
			e.stopPropagation();
			var route = jQuery(this).attr('href'),
				exam_id = jQuery(this).attr('id');

			jQuery('input[name="exam_id"]').val(exam_id);				
			jQuery('#examSubmit').attr({'action':route}).submit();		
		});

	}
};

$(document).ready(function(){

	var source = window.Setting.page();
	switch(source){
		case 'register.php' : 
			window.Register.init();
		break;
		case 'manageexam.php' : 
			window.ManagExam.init();
		break;
		case 'login.html':
			window.Logon.init();
		break;
		case 'list_of_exams.php':
			window.ListOfExams.init();
		break;
		case 'changepwd.php':
			window.ChangePassword.init();
		break;
		case 'test.php':
			window.TestExam.init();
		break;
		case 'exam_assignment.php':
			window.ExamAssignment.init();
		break;
		case 'list_of_test.php' :
			window.ListOfTests.init();
		break;
		default : 
		break;
	}

	if(source != 'login.html' && source != 'register.php'){
		window.Logon.authen();	
	}		
	
	//window.MyTour.init();
	window.FixIE.init();
});
