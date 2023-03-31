document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function darkMode(){

    const adaptacionColorSistema = window.matchMedia('(prefers-color-scheme: dark)');
    
    if (adaptacionColorSistema.matches) {
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    adaptacionColorSistema.addEventListener('change', function () {
        if (adaptacionColorSistema.matches) {
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });

}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarContacto) );



};

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
    
}

function mostrarContacto(evt) {
    const contactoDiv =  document.querySelector('#contacto');

    if (evt.target.value === 'telefono') {

        contactoDiv.innerHTML = 
        `<label for="telefono">Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

        <p>Digite la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">`;
    
    }else{
        contactoDiv.innerHTML = 
        `<label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" >`;
    }
}

