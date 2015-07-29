/*HTTP GET&URL Helper*/
window.URL = {
	/***HTTP GET Helper**/
	get : function(arg){
		//get query params
		var self = this,
		    o = this.getUriObject(window.self.location.href);
		if(typeof o.query != "undefined"){
		    var q = $(this.getQueryObject(o.query)),      
		    m = decodeURIComponent(q[0][arg]);
		    return m;
		}else{
		  return false;
		}          
	},
	getQueryObject: function(q) {
		var vars = q.split(/[&;]/);
		var rs = {};    
		if (vars.length) 
		jQuery.each(vars,function(i,val) {
		  var keys = val.split('=');
		  if (keys.length && keys.length == 2) {
		      rs[encodeURIComponent(keys[0])] = encodeURIComponent(keys[1]);
		  }
		});
		return rs;
	},
	getUriObject: function(u){
		var bits = u.match(/^(?:([^:\/?#.]+):)?(?:\/\/)?(([^:\/?#]*)(?::(\d*))?)((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[\?#]|$)))*\/?)?([^?#\/]*))?(?:\?([^#]*))?(?:#(.*))?/);    
		return (bits)
		  ? { uri : bits[0], scheme : bits[1], authority : bits[2], 
		      domain : bits[3], port : bits[4], path : bits[5], 
		      directory : bits[6], file : bits[7], query : bits[8], fragment : bits[9]}
		  : null;
	}
};



//var	urlData  = window.URL.getUriObject(window.self.location.href);
//window.page 	 = urlData.file;