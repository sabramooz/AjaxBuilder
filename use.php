<?php
    include 'AjaxBuilder.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AjaxBuilder</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>

<div class="container">

<h2>Ajax Builder
    <small>Multi Purpose use jQuery (or javascript ) Ajax With Ajax Builder</small>
</h2>
<p><small>Build Ajax apps Without Write Even one line jQuery (or javascript)</small></p>

<h3>Examples : </h3>
<hr>

<div class="row">
   <div class="col-sm-6">
        <h4>1- Basic Info</h4>

        <form method="get" class="form-horizontal col-sm-8">

            <label for="f_name">First Name : </label><input class="form-control" type="text" name="f_name">
            <label for="l_name">Last Name : </label><input class="form-control" type="text" id="l_name"><br>
            <div class="text-center">
                <input type="button" name="go" value="Submit" class="btn btn-success">
            </div>

        </form>
        <div class="col-sm-12" id="result"></div>

        <div class="col-sm-11">
            <h4>How to use</h4>
            <pre><code>
   &lt;?php

       $obj = new AjaxBuilder("POST","AjaxResponse.php");
       $obj->hasScript();
       $obj->hasReady();
       $obj->hasEvent("click","[name=go]");
       $obj->addParamWithName("f_name");
       $obj->addParamWithId("l_name");
       $obj->addLoading("[name=go]","disabled");
       $obj->debugMode();
       $obj->go("basic_info",false);

   ?&gt;
             </code></pre>
        </div>

        <?php
             $obj = new AjaxBuilder("POST","AjaxResponse.php");
             $obj->hasScript();
             $obj->hasReady();
             $obj->hasEvent("click","[name=go]");
             $obj->addParamWithName("f_name");
             $obj->addParamWithId("l_name");
             $obj->addLoading("[name=go]","disabled");
             $obj->debugMode();
             $obj->go("basic_info",false);
        ?>
   </div>
   <div class="col-sm-6">

        <h4>2- Server Clock</h4>
        <div id="result2" class="col-sm-12 text-success" style="font-size: 25px;margin: 30px"><?= date("Y/m/d - h:i:s",time()); ?></div>

        <div class="col-sm-10">
            <h4>How to use</h4>
            <pre><code>
   &lt;?php

        $obj = new AjaxBuilder("GET","AjaxResponse.php");
        $obj->addParamWithNameAndValue("getTime",1);
        $obj->go("clock_return",true);

   ?&gt;
            </code></pre>
        </div>

   </div>
   <div class="clearfix"></div>

   <h3>Features : </h3>

   <hr>
   <ul class="list-unstyled">
        <li><span class="glyphicon glyphicon-check"></span> 1. you can use both GET and POST method</li>
        <li><span class="glyphicon glyphicon-check"></span> 2. you can add trigger with any event and any selector</li>
        <li><span class="glyphicon glyphicon-check"></span> 3. you can add parameter with 4 ways : id,class,name and pair of name/value</li>
        <li><span class="glyphicon glyphicon-check"></span> 4. you can get result in function that you defined</li>
        <li><span class="glyphicon glyphicon-check"></span> 5. you can set loading options easily</li>
        <li><span class="glyphicon glyphicon-check"></span> 6. you can use debug mode to see all events in console log</li>
   </ul>


</div>

    <footer class="text-center text-primary" style="font-size: 12px;">
        2016 &copy; Pooya Sabramooz [pooya_alen1990@yahoo.com] <a target="_blank" href="https://github.com/pooya-alen1990">GitHub</a>
    </footer>

</div>
<script>
    

setInterval(function(){

<?php
    $obj = new AjaxBuilder("GET","AjaxResponse.php");
    $obj->addParamWithNameAndValue("getTime",1);
    $obj->go("clock_return",true);
?>

},1000);


function basic_info(data){
    $("#result").html(data);
}

function clock_return(data){
    $("#result2").html(data);
}
</script>

</body>
</html>