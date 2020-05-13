tinymce.init({
    selector: '#post ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});

tinymce.init({
    selector: '#description ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});
