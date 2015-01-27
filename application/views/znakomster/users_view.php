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
<!-- Autocomplete -->
<h2 class="demoHeaders">Autocomplete</h2>
<div>
    <input id="autocomplete" title="type &quot;a&quot;">
</div>
<script>
    $(document).ready(function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#autocomplete" ).autocomplete({
//            minLength: 2,
//            source: availableTags
//            source: '/index.php/znakomster/autocomplete'
            source: function( request, response ) {
                $.ajax({
                    url: "/index.php/znakomster/autocomplete",
                    type:"POST",
                    data: {
                        q: request.term
                    },
//                    dataType: "jsonp",

                    success: function( data) {
                        /*$.each(data, function(key, value){
                            console.log(key + ":" + value)
                        })*/
                        console.log((data));
                        var jsonObj = $.parseJSON('[' + data + ']');
                        console.log((jsonObj));
                        console.log('length :',jsonObj[0].length);
//                        var myObject = eval('(' + data + ')');
//                        var d = $.parseJSON(data);
//                        console.log('d :',myObject);
//                        var arr = [];
                        /*for(var i=0;i<data.length;i++){
//                            arr[i] = data[i];
                            console.log(data.name[i]);
                        }*/
                        /*for (i in myObject)
                        {
                            alert(myObject[i]["name"]);
                        }*/
//                        console.log($.parseJSON('{"name":"John"}'));
//                        console.log(data);
//                        data = ["John"];
//                        data = ["Аграрное","Агрономичное","Агрономия"];
                        response( jsonObj[0] );
                    }
                });
            }
        });
    });

</script>
</body>
</html>