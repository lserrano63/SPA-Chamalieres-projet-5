tinymce.init({
    selector: '#post ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});
tinymce.init({
    selector: '#bio ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});
tinymce.init({
    selector: '#contact ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});

