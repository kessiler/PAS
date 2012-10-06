/**
 * Created with JetBrains PhpStorm.
 * User: KESSILER
 * Date: 17/09/12
 * Time: 01:00
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
    $("ul.sf-menu").sooperfish();
    $("#login .submit").click(function() {
        $("#login").validationEngine();
    })

});