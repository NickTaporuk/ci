<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="/js/jquery.js" type="text/javascript"></script>
<!--    <script src="/js/jquery-ui.js" type="text/javascript"></script>-->
<!--    <link rel="stylesheet" href="/css/jquery-ui.css"/>-->
</head>
<body>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
    }

    * html body {
        height: 100%;
    }

    body {
        min-height: 100%;
        position: relative;
    }

    #content {
        padding-bottom: 100px;
    }

    #footer {
        background: #bebebe;
        position: absolute;
        bottom: 0;
        height: 80px;
        width: 100%;
    }

    #footer .item {
        background: #be0f06;
        float: left;
        height: 75px;
        width: 60%;
    }

    #footer .item2 {
        background: #beebff;
        float: right;
        height: 75px;
        width: 40%;
    }
    body { font: 13px Helvetica, Arial; }
    form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
    form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
    form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
    #messages { list-style-type: none; margin: 0; padding: 0; }
    #messages li { padding: 5px 10px; }
    #messages li:nth-child(odd) { background: #eee; }
    #list {
        position: absolute;
        display: none;
        list-style-type:none;
        cursor: pointer;
    }

    #list:hover {
        display: block;
    }
    #list li{
        cursor: pointer;
        padding: 3px 4px;
    }
    #search {
        clear: both;
        top: 20px;
        position: relative;
        z-index: 9;
    }
    .full-search-click{
        background: cyan;
        width: 171px;
        padding: 5px;
        border-radius: 5px;
    }
    #search-full{
        display: none;
    }
    #search-full.active{
        display: block;
    }

    #mini-search{
        position:relative;
    }
    .result-mini-search{
        display: none;
        position: absolute;
        z-index: 10;
    }
    /*.actor{
        position: relative;
    }*/
    .result-actor{
        position: absolute;
        display: none ;
        z-index: 99;
    }
    .direct_by{
        position: relative;
    }
    .result-direct_by{
        position: absolute;
        display: none ;
    }
    /**/
    .producer{
        position: relative;
    }
    .result-producer{
        position: absolute;
        display: none ;
    }
    /**/
    .screenwriter{
        position: relative;
    }
    .result-screenwriter{
        position: absolute;
        display: none ;
    }
    /**/
    .operator{
        position: relative;
    }
    .result-operator{
        position: absolute;
        display: none ;
    }
    .slogan{
        position: relative;
    }
    .result-slogan{
        position: absolute;
        display: none ;
    }
    /**/
    .composer{
        position: relative;
    }
    .result-composer{
        position: absolute;
        display: none ;
    }
    .autocomplete-input{
        border: none;
        background: none;
    }
    .close-autocomplete{
        background: #3f7506;
        color: #ffffff;
        cursor: pointer;
        padding:0 3px;
        border-radius: 6px;
        margin-left: 3px;
    }
    .span-data {
        background: blue;
        border-radius: 3px;
        padding: 2px 6px;
        margin-left: 3px;
        color: #ffffff;
        text-decoration: none;
    }
    .span-data:hover {
        background: #ffffff;
        border-radius: 3px;
        padding: 2px 6px;
        margin-left: 3px;
        color: #000;
        text-decoration: none;
    }
    .span-data-close{
        float: left;
        text-decoration: none;
    }
    ul{
        text-decoration: none;
        list-style-type: none;
    }
    .mini-search-container{
        float: left;
    }
</style>
<!-- Autocomplete -->
<h2 class="demoHeaders">Autocomplete</h2>

<!--<div>
    <input id="autocomplete" title="type &quot;a&quot;">
</div>
-->
<!--<script>-->
<!--//    $("#autocomplete").autocomplete({-->
<!--////        minLength: 2,-->
<!--//        source: function (request, response) {-->
<!--//            $.ajax({-->
<!--//                url: "/index.php/znakomster/autocomplete",-->
<!--//                type: "POST",-->
<!--//                data: {-->
<!--//                    q: request.term-->
<!--//                },-->
<!--//                success: function (o) {-->
<!--//                    var jsonObj = $.parseJSON('[' + o + ']');-->
<!--////                    console.log(jsonObj[0]);-->
<!--//                    response(jsonObj[0]);-->
<!--//                }-->
<!--//            });-->
<!--//        }-->
<!--//    });-->
<!--</script>-->

<!--<div class="clear"></div>-->
<!--<ul id="messages"></ul>-->
<!--<form action="">-->
<!--    <input class="from" placeholder="from :" type="text"/>-->
<!--    <input class="to"  placeholder="to :" type="text"/>-->
<!--    <input id="m" placeholder="message :" autocomplete="off" />-->
<!--    <button>Send</button>-->
<!--</form>-->

<!--<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>-->
<!--<script src="http://code.jquery.com/jquery-1.11.1.js"></script>-->
<!--<script>-->
<!--    /*var socket = io.conn('http://localhost:3000/',function(){-->
<!---->
<!--    });-->
<!--    $('form').submit(function(){-->
<!--        var data = {};-->
<!--        data.from       = $('.from').val();-->
<!--        data.to         = $('.to').val();-->
<!--        data.message    = $('#m').val();-->
<!--        socket.emit('chat message',data);-->
<!--    $('#m').val('');-->
<!--    return false;-->
<!--    });-->
<!---->
<!--    socket.on('chat message', function(msg){-->
<!--//        console.log('json',$.parseJSON(msg));-->
<!--        console.log('msg->',msg.message);-->
<!--        var mess = msg.message;-->
<!--        $('#messages').append($('<li>').text(mess));-->
<!--    });*/-->
<!--//</script>-->

<div class="callback">
    <ul>
        <input class="actor" type="text" name="" id=""/>
    </ul>
</div>
<script type="text/javascript" src="/js/autocomplete/loadAutocomplete.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.actor').loadAutocomplete({
            defaultClass:'actor'
            ,url: "/znakomster/autocomplete"
            ,type:"POST"
            ,layout:'<li ref="<<<Obj.id>>>"><<<Obj.value>>></li>'

//            ,minChars:2
        });
    });
</script>
</body>
</html>