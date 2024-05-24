document.getElementById('registroForm').addEventListener('submit', function(event) {
    const contrasena = document.getElementById('contrasena').value;
    if (contrasena.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres.');
        event.preventDefault();
    }
});
