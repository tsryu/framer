( function( $ ) {
	'use strict';
	var rootUrl = 'http://framer.dothome.co.kr';
	var partials = '/wp-content/themes/framer/partials/';
	var myApp = angular.module('myApp',['ngSanitize']);

	//루프 거꾸로돌리기
	myApp.filter('reverse', function(){
		return function(items){
			return items.slice().reverse();
		};
	});
	//html 인증하기
	myApp.filter('html', ['$sce', function($sce){
		return function(item) {
			return $sce.trustAsHtml(item);
		};
	}]);
	//wp factory
	myApp.factory('wpFactory', ['$http', '$q', function ($http, $q) {
	  
	  var url = rootUrl+'/wp-json/wp/v2/';
	  
	  function getPosts(type) {
	  	type = typeof type !== 'undefined' ? type : 'posts';
	    return ($http.get(url+type)
	    .then(handleSuccess, handleError));
	  }

	  
	  function getMediaDataForId(id) {
	    return ($http.get(url+'media/' + id, {ignoreLoadingBar: true})
	    .then(handleSuccess, handleError));
	  }
	  
	  function handleSuccess(response) {
	    return response.data;
	  }
	  
	  function handleError(response) {
	    if (!angular.isObject(response.data) || !response.data.message) {
	      return($q.reject("An unknown error occurred."));
	    }
	    return($q.reject(response.data.message));
	  }
	  
	  return({
	    getPosts: getPosts,
	    getMediaDataForId: getMediaDataForId
	  });
	}]);

	//wp query
	// myApp.controller('MainCtrl', function ($scope, wpFactory) {
	myApp.controller('getStarted', ['$scope', 'wpFactory', function ($scope, wpFactory) {

		$scope.posts = [];
		wpFactory.getPosts('get_started').then(function (succ) {
			$scope.posts = succ;
		}, function error(err) {
			console.log('Errror: ', err);
		});
	}]);

} )( jQuery );