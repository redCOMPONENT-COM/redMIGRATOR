/**
 * @package     redMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */
 
Request.Multiple = new Class({
	Implements : [Options, Chain],
	
	options : {
		onRequest : false,
		onComplete : false
	},
	
	initialize : function(options) {
		this.setOptions(options);
		this.requests = new Hash();
	},
			
	runAll : function() {
		var chains = [];
		chains.include(this.request);
		
		Object.each(this.requests, function(request, k) {

			var req = function() {
				request.addEvent('complete', function() {
					this.callChain();
				}.bind(this));
				request.send();
			}.bind(this);
			
			chains.include(req);
			
			this.removeRequest(k);
		}, this);
		
		chains.include(this.complete);			
	
		this.chain(chains);
		this.callChain();
	},
		
	request : function() {
		this.options.onRequest();
		this.callChain();
	},

	complete : function() {
		this.options.onComplete();
	},
		
	addRequests : function(requests) {
		Object.each(requests, function(request, key) {
			this.addRequest(key, request);
		}, this);
	},
	
	addRequest : function(key, request) {			
		this.requests.set(key, request);
	},
	
	removeRequest : function(key) {
		this.requests.erase(key);
	},

	cleanRequests : function(requests) {
		Object.each(requests, function(request, key) {
			this.removeRequest(key);
		}, this);
	}
});
