import Swal from 'sweetalert2'
window.confirmDelete = function (id) {
Swal.fire({
  title: "Tem certeza?",
  icon: "warning",
  text: "Essa ação não pode ser desfeita.",
  showCancelButton: true,
  confirmButtonColor: "#d33",
  cancelButtonColor: "#3085d6",
  confirmButtonText: "Sim, excluir!",
  cancelButtonText: "Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
    // Ação a ser realizada se o usuário confirmar
    document.getElementById("delete-form-" + id).submit();
  }
});
}
