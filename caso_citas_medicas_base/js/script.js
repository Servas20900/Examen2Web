$(function () {
    


});
   
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    const nombre = form.querySelector('[name="nombre"]').value.trim();
    const fecha = form.querySelector('[name="fecha"]').value;
    const hora = form.querySelector('[name="hora"]').value;

    if (!nombre || !fecha || !hora) {
      alert('Todos los campos son obligatorios');
      e.preventDefault();
    }
  });
});
