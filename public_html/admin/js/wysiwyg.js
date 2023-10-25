// Forms Demo
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){

    // WYSIWYG
    // ----------------------------------- 
    $('#summernote').summernote({
        height: 200,
        onChange: function(contents, $editable) {
            if (contents == '<p><br></p>') {
                $('#summernote + .note-editor .note-editable').empty();
            }
        }
    });



      $('#summernote2').summernote({
          height: 200,
          onChange: function(contents, $editable) {
              if (contents == '<p><br></p>') {
                  $('#summernote2 + .note-editor .note-editable').empty();
              }
          }
      });

      $('#summernote3').summernote({
          height: 200,
          onChange: function(contents, $editable) {
              if (contents == '<p><br></p>') {
                  $('#summernote3 + .note-editor .note-editable').empty();
              }
          }
      });

    // This is called by the onsubmit form function (in the actual view's form) when the form is submitted
    // It takes the data entered into the WYSIWIG editor and puts it into a textarea so it gets posted with the form
    var postForm = function() {
        var content = $('textarea[name="description"]').html($('#summernote').code());
    };

    // This will fill in the WYSIWIG editor with the previous page's textarea data after a failed form validation
    $('.summernote').code($('.summernote').html());

  });

})(window, document, window.jQuery);