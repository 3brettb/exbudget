(function(jQuery){

    jQuery.fn.makeForm = function(options){
        if($.validateArgs(options, [
            "token", "inputs",
        ])){
            var label_class = ("label_class" in options) ? options.label_class : "";
            var input_class = ("input_class" in options) ? options.input_class : "";
            $(this).each(function(i, form){
                var token = $("<input>", {type: "hidden", name: "_token", value:options.token}) 
                $(form).append(token);

                $.each(options.inputs, function(key, item){
                    var group = $("<div>", {class:item.group_class});

                    var label = $("<label>", {for: key, class:label_class}).html(item.label);

                    var input_div = $("<div>", {class: input_class});

                    var input = $("<input>", {id:key, type:item.type, class:item.class, name:key, value:item.value}).html(item.html);
                    $(input_div).append(input);

                    if(item.error){
                        var error = $("<span>", {class:"help-block"}).append($("<strong>").html(item.error));
                        $(input_div).append(error);    
                    }

                    $(group).append(label);
                    $(group).append(input_div);
                    $(form).append(group);
                });

            });
        }else{
            $.error("Jquery.fn.makeForm(args) does not contain the requred args.");
        }
    };

    jQuery.validateArgs = function(args, required){
        r = true;
        $.each(required, function(i, key){
            if(!(key in args)){
                r = false;
            }
        });
        return r;
    };

    jQuery.fn.serializeObject = function(insert=null){
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            add(o, this.name, this.value);
        });
        $.each(insert, function(key, value){
            add(o, key, value);
        });
        return o;

        function add(o, key, val){
            t1 = /([\w]+)\[([\d]+)\](.*)/;
            t2 = /([\w]+)\[([\w]+)\](.*)/;

            if(key.match(t1)){
                m = key.match(t1);
                
                if(o[m[1]] == undefined){
                    o[m[1]] = [];
                }
                add(o[m[1]], m[2]+m[3], val);
            }
            else if(key.match(t2)){
                m = key.match(t2);
                
                if(o[m[1]] == undefined){
                    o[m[1]] = {};
                }
                add(o[m[1]], m[2]+m[3], val);
            }
            else{
                r = /([\w]+)\[\]/;
                if(key.match(r) != null){
                    key = key.match(r)[1];
                }

                if (o[key] !== undefined) {
                    if(!o[key].push) {
                        o[key] = [o[key]];
                    }
                    o[key].push(val || '');
                } 
                else {
                    o[key] = val || '';
                }
            }
        };
    }

}(jQuery));
