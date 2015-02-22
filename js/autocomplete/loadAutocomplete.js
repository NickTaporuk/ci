(function ($) {
    'use strict';
    var keys = {
        ESC: 27,
        TAB: 9,
        RETURN: 13,
        LEFT: 37,
        UP: 38,
        RIGHT: 39,
        DOWN: 40
    };

    function LoadAutocomplete(el, options) {
        //defaults
        var noop = function () {
            },
            defaults = {
                defaultClass: 'autocomplete-class',//при инициализации указать свой класс чтоб не перекрывались контейнеры
                defaultSpanClass: 'span-data',//при инициализации указать свой класс чтоб не перекрывались контейнеры
                ajaxSettings: {},
                hiddenData: [],
                autoSelectFirst: false,
                appendTo: document.body,
                serviceUrl: null,
                lookup: null,
                onSelect: null,
                width: 'auto',
                minChars: 1,
                maxHeight: 300,
                deferRequestBy: 0,
                //ajax start
                params: {},
                url: '',
                //end ajax
                //formatResult: Autocomplete.formatResult,
                delimiter: null,
                zIndex: 9999,
                type: 'GET',
                data: {},
                noCache: false,
                onSearchStart: noop,
                onSearchComplete: noop,
                onSearchError: noop,
                preserveInput: false,
                containerClass: 'autocomplete-suggestions',
                hiddenClass: 'autocomplete-hidden',
                tabDisabled: false,
                dataType: 'text',
                //layout: '<li class="$1-close" ref="$2">$3<span class="close-autocomplete">x</span></li>',
                layout:'<li class="<<<class>>>" ref="<<<Obj.id>>>"><<<Obj.value>>></li>',
                currentRequest: null,
                triggerSelectOnValidInput: true,
                preventBadQueries: true,
                debug: false,//доделать для отображения ошибок выполнения
                insertInput: false,//вставлять в input а не как в fb сбоку
                lookupFilter: function (suggestion, originalQuery, queryLowerCase) {
                    return suggestion.value.toLowerCase().indexOf(queryLowerCase) !== -1;
                },
                paramName: 'query',
                transformResult: function (response) {
                    return typeof response === 'string' ? $.parseJSON(response) : response;
                },
                showNoSuggestionNotice: false,
                noSuggestionNotice: 'No results',
                orientation: 'bottom',
                forceFixPosition: false,
                resultData: {}
            };

        this.config = $.extend({}, defaults, options);
        //console.log('this.config :',this.config.ajax());
        this.el = el;
        this.init();
    }

    //LoadAutocomplete.utils = utils

    LoadAutocomplete.prototype = {
        init: function () {
            //console.log('this :',this);

            var el = this,
                options = el.config,
                container,
                hidden;//скрытый елемент

            console.log('this :', el.config.layout);

            // Remove autocomplete attribute to prevent native suggestions:
            el.el.attr({'autocomplete': 'on'});
            //console.log(options.containerClass);
            el.config.noSuggestionsContainer = $('<div class="autocomplete-no-suggestion"></div>');
            //разнести для каждого отслеживаемого класса свой
            //сделать класс по умолчанию
            el.config.suggestionsContainer = this.createNode(options.defaultClass + ' ' + options.containerClass, '', 'div');
            el.config.hiddenContainer = this.createNode(options.defaultClass + '_hidden', options.defaultClass, 'input', 'hidden');
            //console.log(el.config.suggestionsContainer);
            //создаю контейнер на который буду вешать сорбытия
            container = $(el.config.suggestionsContainer);
            container.attr({'container': 'on'});

            //скрытый елемент
            hidden = $(el.config.hiddenContainer);
            el.el.parent().append(container);//добавляет по умолчанию к  елементу
            el.el.parent().append(hidden);//добавляет по умолчанию к елементу

            // Only set width if it was provided:
            //да простят меня гуру javascript
            if (options.width !== 'auto') {
                container.width(options.width);
            }
            //==============================================================
            $(document).on('click', function () {
                $('.autocomplete-suggestions').css({'display': 'none'});
            });

            $(document).on('click.container', '.' + el.config.defaultClass + '.' + el.config.defaultSpanClass, function (e) {
                container.css({'display': 'none'});
                if (el.config.insertInput) {
                    console.log(el.config.defaultClass)
                    //console.log(this);
                    var $this = $(this);
                    $('.' + el.config.defaultClass).val($this.text());
                } else {
                    var hiddenData = $(this),
                        li = $('.' + el.config.defaultClass + '.' + el.config.defaultSpanClass),
                        ref = hiddenData.attr('ref'),
                        data = [];
                    //el.config.hiddenData[ref]=ref;
                    //-----------------------------------
                    //взять в хидене сделать массив добавить
                    data = $('.' + options.defaultClass + '_hidden').val().split(',');
                    data.push(ref);
                    //console.log('split:',data);
                    data.join(',');
                    //-----------------------------------
                    $('.' + options.defaultClass + '_hidden').val(data);
                    hiddenData.parent().parent().prepend('<li class="' + el.config.defaultSpanClass + '-close" ref="' + ref + '">' + hiddenData.text() + '<span class="close-autocomplete">x</span></li>');
                }
                //console.log('el.config.hiddenData:',el.config.hiddenData);
                //console.log('options.defaultClass:',options.defaultClass+'_hidden');
            });
            //работа с контейнером визуализации искомых данных
            /*container.on({
             'click.container':function(){
             //console.log('.'+el.config.defaultClass+'.'+el.config.defaultSpanClass);
             //console.log(this);
             var $this = $(this);
             $this.css({'display':'none'});
             }
             });*/
            $(document).on('click', '.close-autocomplete', function () {
                var close = $(this),
                    rel = close.parent().attr('ref');
                var d = [];
                var req = [];
                var data = close.parent().parent().find('input[type="hidden"]').val();
                d = data.split(',')
                console.log('rel:', rel);
                //console.log('d:',d);
                for (var i = 0; i < d.length; i++) {
                    if (d[i] == rel) {
                        delete d[i];
                    }
                }
                var r = d.join(',');
                console.log(d);
                close.parent().parent().find('input[type="hidden"]').val(r);
                close.parent().hide();
            });
            //==============================================================
            el.el.parent().on('click', function () {
                el.el.focus();
            });

            el.el.on({
                'keydown.autocomplete': function (e) {
                    //console.log('keydown:',$(this).val());
                    //el.onKeyDown(e,container);
                },
                'mouseover.autocomplete': function (e) {
                    //console.log('mouseover:',$(this).val());
                    //el.onMouseOver(e,container);
                },
                'click.autocomplete': function (e) {
                    //console.log('click:',$(this).val());
                    //el.onKeyDown(e,container);
                },
                'keyup.autocomplete': function (e) {
                    //console.log('keyup:',$(this).val());
                    el.config.data.ch = $(this).val();
                    el.onKeyUp(e, container, $(this).val(), el);
                    var html = el.compile(el.config.resultData, el);
                    container.html(html).css({'display': 'block'});
                },

                /*'mouseout.autocomplete':function(e){
                 var relatedTarget = e.relatedTarget || e.fromElement
                 console.log('mouseout:',$(relatedTarget).attr('class'));
                 //if($(relatedTarget).attr('class') == 'actor span-data'){
                 //    $(relatedTarget).parent().hide();
                 //}
                 //if(relatedTarget=='')
                 //el.onKeyUp(e,container);
                 },*/
                'focus.autocomplete': function (e) {
                    //console.log('focus:',$(this).val());
                    //el.onFocus(e,container);
                },
                'change.autocomplete': function (e) {
                    //console.log('change:',$(this).val());
                    //el.onChange(e,container);
                },
                'input.autocomplete': function (e) {
                    //console.log('input:',$(this).val());
                    //el.onKeyUp(e,container);
                }

            });
        },
        compile: function (Obj, el) {
            //console.log('Obj:',Obj.length);
            var html = ''
                ,str = ''
                ,tmpl = el.config.layout;

            for (var i = 0; i < Obj.length; i++) {

                if(Obj[i].link){
                    //console.log('link:',Obj[i].link);
                    str = tmpl.replace(/<<<Obj\.id>>>/g,Obj[i].id);
                    str = str.replace(/<<<Obj\.value>>>/g,Obj[i].value);
                    str = str.replace(/<<<class>>>/g,el.config.defaultClass+' '+el.config.defaultSpanClass);
                    str = str.replace(/<<<link>>>/g,Obj[i].link);
                } else {
                    str = tmpl.replace(/<<<Obj\.id>>>/g,Obj[i].id);
                    str = str.replace(/<<<Obj\.value>>>/g,Obj[i].value);
                    str = str.replace(/<<<class>>>/g,el.config.defaultClass+' '+el.config.defaultSpanClass);
                    //html += '<li class="' + el.config.defaultClass + ' ' + el.config.defaultSpanClass + '" ref="' + Obj[i].id + '">' + Obj[i].value + '</li>';
                }
                html+=str;
            }

            return html;
        },
        str_replace: function (search, replace, subject) {
            return subject.replace(new RegExp(search, 'g'), replace);
        },
        render: function (template, params) {

//            console.log('params :',params);
            var arr = [];
            switch (template) {
                case 'search':
                    arr = [
                        '<div class="search-template" ref="', params.id, '">',
                        '<img src="/" alt=""/>',
                        '<span class="name">', params.name,
                        '</span><a href="#" class="name-film">', params.name,
                        '</a></span></div>'];
                    break;

                case 'add-ul':
                    arr = [
                        '<li>', params.name, '</li>'
                    ];
                    break;
                case 'span-search':
                    arr = [
                        '<span class="' + insert + '-span">' + params.j + '<span class="close-autocomplete">x</span></span>'
                    ];
                    break;
            }
            return arr.join('');
        },
        createNode: function (containerClass, name, el, type) {
            var div = document.createElement(el);
            div.className = containerClass;
            div.setAttribute('name', name);
            div.style.position = 'absolute';
            div.style.display = 'none';
            div.style.zIndex = '9999';
            if (el == 'input') {
                div.setAttribute('type', type);
                div.setAttribute('value', '0');
            }
            return div;
        },
        //выбор
        onChange: function (e) {

        },
        //onBlur:function(e){},
        onBlur: function (e, container) {
            container.css({'display': 'none'});

        },
        //загрузка данных аякс или данные
        onData: function () {

        },
        onAjax: function (data, el, value, container) {
            //console.log(el.config.data);
            var ajaxSettings = {
                url: el.config.url,
                data: el.config.data,
                type: el.config.type
            };
            $.extend(ajaxSettings, el.config.ajaxSettings);
            if (el.config.data.ch.length >= el.config.minChars) {
                $.ajax(ajaxSettings)
                    .done(function (d) {
                        //console.log(d);
                        try {
                            el.config.resultData = $.parseJSON(d);
                        }
                        catch (e) {
                            el.config.onSearchError.call('invalid json');
                        }

                        //console.log(el.config.resultData);
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        el.config.onSearchError.call(el.config.element, q, jqXHR, textStatus, errorThrown);
                    });
            }
        },
        onKeyDown: function (e) {
            //console.log('onKeyDown:::::->',e);
        },
        onKeyUp: function (e, container, value, el) {
            //console.log('onKeyUp:::::->',e);
            //container.css('display','block');
            el.onAjax(e, el, value, container);
        },
        onKeyPress: function (e) {
            console.log('eeee:::::->', e);
            var that = this;
            switch (e.which) {
                case keys.ESC:
                    //that.el.val(that.currentValue);
                    //that.hide();
                    break;
                case keys.RIGHT:
                    //if (that.hint && that.options.onHint && that.isCursorAtEnd()) {
                    //    that.selectHint();
                    break;
                    //}
                    return;
                case keys.TAB:
                    //if (that.hint && that.options.onHint) {
                    //    that.selectHint();
                    return;
                    //}
                    //if (that.selectedIndex === -1) {
                    //    that.hide();
                    //    return;
                    //}
                    //that.select(that.selectedIndex);
                    //if (that.options.tabDisabled === false) {
                    //    return;
                    //}
                    break;
                case keys.RETURN:
                    //if (that.selectedIndex === -1) {
                    //    that.hide();
                    //    return;
                    //}
                    //that.select(that.selectedIndex);
                    break;
                case keys.UP:
                    //that.moveUp();
                    break;
                case keys.DOWN:
                    //that.moveDown();
                    break;
                default:
                    return;
            }

            // Cancel event if function did not return:
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    }

    $.fn.loadAutocomplete = function (options) {
        new LoadAutocomplete(this.first(), options);
        //console.log('this:',this.first());
        //console.log('this:',this.attr('class'));
        return this.first();
    }
})(jQuery);