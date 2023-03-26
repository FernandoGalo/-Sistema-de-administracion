//Validaciones contraseña


function bloquearEspacio(event) {
    var tecla = event.keyCode || event.which;
    if (tecla == 32) {
        return false;
    }
    }

  function mostrarContrasena() {
    var contrasenaInput = document.getElementById("contraseña");
    var botonVerOcultar = document.getElementById("ver-ocultar");
    
    if (contrasenaInput.type === "password") {
      contrasenaInput.type = "text";
      botonVerOcultar.innerHTML = '<i class="zmdi zmdi-eye-off"></i>';
    } else {
      contrasenaInput.type = "password";
      botonVerOcultar.innerHTML = '<i class="zmdi zmdi-eye"></i>';
    }
  }

		function validarMayusculas(e) {
			var tecla = e.keyCode || e.which;
			var teclaFinal = String.fromCharCode(tecla).toUpperCase();
			var letras = /^[A-Z]+$/;

			if(!letras.test(teclaFinal)){
				e.preventDefault();
			}
		}


//Validar correo
function validarCorreo(event) {
  var correo = event.target.value;
  var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!regex.test(correo)) {
    event.target.setCustomValidity("Ingrese un correo electrónico válido");
  } else {
    event.target.setCustomValidity("");
  }
}


