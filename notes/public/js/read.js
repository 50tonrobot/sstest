$( "body" ).on( "click", "#delete-note", function() {
  var note = $(this);
  var note_id = note.attr("data-note-id");
  $.ajax({
            url: '/note/'+note_id,
            type:'DELETE',
            success: function(response) {
              if(response == 'true')
              {
                window.location.replace('/dashboard');
              }
            }
          });
});