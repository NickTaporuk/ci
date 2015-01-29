<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/jquery-ui.js" type="text/javascript"></script>
<!--    <script src="/js/css.js" type="text/javascript"></script>
    <script src="/js/dataset.js" type="text/javascript"></script>
    <script src="/js/dropdown.js" type="text/javascript"></script>
    <script src="/js/event_bus.js" type="text/javascript"></script>
    <script src="/js/event_emitter.js" type="text/javascript"></script>
    <script src="/js/highlight.js" type="text/javascript"></script>
    <script src="/js/html.js" type="text/javascript"></script>
    <script src="/js/input.js" type="text/javascript"></script>
    <script src="/js/plugin.js" type="text/javascript"></script>
    <script src="/js/typeahead.js" type="text/javascript"></script>
    <script src="/js/handlebar.js" type="text/javascript"></script>
-->
    <link rel="stylesheet" href="/css/jquery-ui.css"/>
</head>
<body>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    html {height: 100%;}
    * html body {height: 100%;}
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
    #footer .item{
        background: #be0f06;
        float: left;
        height: 75px;
        width: 60%;
    }
    #footer .item2{
        background: #beebff;
        float: right;
        height: 75px;
        width: 40%;
    }
</style>
<!-- Autocomplete -->
<h2 class="demoHeaders">Autocomplete</h2>
<div>
    <input id="autocomplete" title="type &quot;a&quot;">
</div>
<script>
        $( "#autocomplete" ).autocomplete({
            minLength: 2,
            source: function( request, response ) {
                $.ajax({
                    url: "/index.php/znakomster/autocomplete",
                    type:"POST",
                    data: {
                        q: request.term
                    },
                    success: function(o) {
                        var jsonObj = $.parseJSON('[' + o + ']');
                        response( jsonObj[0] );
                    }
                });
            }
        });
</script>
<h2 class="content" style="min-height: 800px">Autocomplete</h2>
<div id="footer">
    <div class="item2">Chat :</div>
    <div class="item">111</div>
</div>
<div class="clear"></div>
</body>
</html>