tinymce.init({
    selector: '#post ',
    setup:function(editor){
        editor.on('change', function(){
            tinymce.triggerSave();
        })
    }
});
