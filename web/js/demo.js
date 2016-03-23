/**
 * Created by karimsafraoui on 2016-03-19.
 */

var $jq = $.noConflict();

var mgl846 = angular.module("mgl846",[]);

mgl846 = angular.module('mgl846',['ngRoute']);

mgl846.controller('plainte', ['$scope','$http',function($scope,$http) {

    $scope.show_msg = false;
    $scope.response = true;
    $scope.error_msg = "";

    $scope.formData = {
        nb_mois: "",
        niveau_plainte: "",
        text_plainte: "",
        code_postal: "",
        telephone: "",
        email: ""
    };

    $scope.send_plainte = function(formData){

        $scope.show_msg = false;
        $scope.response = true;
        $scope.error_msg = "";

        $http({
            method: 'POST',
            header:{
                'Content-type':'application/x-www-form-urlencoded'
            },
            url: 'process_plainte.php',
            data:formData
        })
        .then(
            function(response) {
                $scope.show_msg = true;
                try{
                    $scope.response = response.data.statut;
                    $scope.error_msg = response.data.msg;
                }
                catch(e){
                    $scope.response = false;
                    $scope.error_msg = e.message();
                }
            },
            function(response){
                $scope.show_msg = true;
                $scope.response = false;
                $scope.error_msg = "Fail";
        });
    };
}]);
