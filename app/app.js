var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Users',
      templateUrl: 'templates/users.html',
      controller: 'usersCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    