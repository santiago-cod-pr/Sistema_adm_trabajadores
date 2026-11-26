class FormAlerta {
    constructor(correo, nombre) {
        this.correo = correo;
        this.nombre = nombre;
    }

    avisarEnvio() {
        console.log('Enviando formulario:', this.nombre, this.correo);
        alert('Datos listos para enviar.');
    }

    avisarError(mensaje) {
        console.log('Error:', mensaje);
        alert(mensaje);
    }
}