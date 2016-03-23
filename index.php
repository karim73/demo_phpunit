<!DOCTYPE html>
<html lang="en" ng-app="mgl846">
<head>
    <meta charset="utf-8">
    <title>MGL846 - Demo PHPUnit</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="web/css/bootstrap-3.3.6.min.css">
    <link rel="stylesheet" href="web/css/bootstrap-theme-3.3.6.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container" ng-controller="plainte">
    <div class="row">
        <h2 style="text-align:center">MGL846 - Démo PHPUnit - Système de plaines</h2>
        <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-lg-offset-2" style="padding-top: 50px;">
            <form name="plainte_form" class="form-horizontal" ng-submit="send_plainte(formData)">
                <div class="form-group">
                    <label for="nb_mois" class="col-lg-3 control-label">Client depuis (mois)</label>
                    <div class="col-lg-6">
                        <input type="text" ng-model="formData.nb_mois" class="form-control" name="nb_mois" id="nb_mois" placeholder="Nombre de mois">
                    </div>
                </div>
                <div class="form-group">
                    <label for="niveau_plainte" class="col-lg-3 control-label">Niveau Plainte</label>
                    <div class="col-lg-6">
                        <select name="niveau_plainte" ng-model="formData.niveau_plainte" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text_plainte" class="col-lg-3 control-label">Text</label>
                    <div class="col-lg-6">
                        <textarea class="form-control" rows="4" id="text_plainte" ng-model="formData.text_plainte" name="text_plainte" placeholder="Text de la Plaine"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="code_postal" class="col-lg-3 control-label">Code Postal</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="code_postal" ng-model="formData.code_postal" placeholder="Code Postal">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telephone" class="col-lg-3 control-label">Telephone</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="telephone" ng-model="formData.telephone" placeholder="Telephone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="email" ng-model="formData.email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-6">
                        <button type="submit" class="btn btn-default">Soumettre la plainte</button>
                    </div>
                </div>
                <div class="form-group" style="padding-top:20px;" ng-show="show_msg">
                    <div class="col-lg-12">
                        <span class="col-lg-12" ng-class="{'alert alert-danger':response==false,'alert alert-info':response==true}" >{{error_msg}}</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="web/js/jquery-1.12.2.min.js"></script>
<script src="web/js/bootstrap-3.3.6.min.js"></script>
<script src="web/js/angular-1.5.2.min.js"></script>
<script src="web/js/angular-route-1.5.2.min.js"></script>
<script src="web/js/demo.js"></script>
</body>
</html>