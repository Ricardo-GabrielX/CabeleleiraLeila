$('#delete-modal').on('show.bs.modal', function (event) {
  
    var button = $(event.relatedTarget);
    var id = button.data('agendamento');
    
    var modal = $(this);
    modal.find('.modal-title').text("Excluir Agendamento: " + id);
    modal.find('.modal-body').text("Deseja mesmo excluir o Agendamento: " + id + "?");
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

$('#delete-modal-user').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('usuario');
  
  var modal = $(this);
  modal.find('.modal-title').text("Excluir Usuário: " + id);
  modal.find('.modal-body').text("Deseja mesmo excluir o Usuário: " + id + "?");
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});