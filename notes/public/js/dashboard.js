$( "body" ).on( "mouseenter", ".notes-list .list-group-item .glyphicon-trash", function() {
  $(this).closest("li").removeClass('editable');
});

$( "body" ).on( "mouseleave", ".notes-list .list-group-item .glyphicon-trash", function() {
  $(this).closest("li").addClass('editable');
});

$( "body" ).on( "click", ".notes-list .list-group-item .glyphicon-trash", function() {
  var note = $(this);
  var note_id = note.attr("data-note-id");
  $.ajax({
            url: '/note/'+note_id,
            type:'DELETE',
            success: function(response) {
              if(response == 'true')
              {
                note.closest("li").fadeOut("normal", function() {
                    $(this).remove();
                });
              }
            }
          });
});

$( "body" ).on( "click", ".notes-list .list-group-item.editable", function() {
  var note_id = $(this).attr("data-note-id");
  window.location.replace('/note/'+note_id);
});
