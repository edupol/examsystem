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