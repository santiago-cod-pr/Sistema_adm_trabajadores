class UserAlerta {
    constructor(nombre) {
        this.nombre = nombre;
    }

    saludar() {
        console.log('Usuario:', this.nombre);
        alert('Hola ' + this.nombre);
    }

    confirmarEliminar() {
        return confirm('¿Deseas eliminar a ' + this.nombre + '?');
    }
}