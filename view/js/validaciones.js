/**
 * Funcion Javascript:
 * Objetivo:
 *** deshabilitar el boton editar y el boton eliminar 
     cuando el cambo nombre este vacio (es requerido)
 *** Habilitar el modo escritura en los campos    
 */

function habilitarBotones(){
    //Obtiene el boton y los campos
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");
    const campoValor = document.getElementById("nombre");
    const campoClave = document.getElementById("pass");
    const campoEmail = document.getElementById("correo");
    // Agrega un evento de entrada al campo nombre
    // el evento se activa solo cuando escriben en el campo
    campoValor.addEventListener("input", () => {
        //Verifica si el campo esta vacio        
        if(campoValor.value === ""){
            //Deshabilita el boton                        
            botonEditar.disabled = true;
            botonEliminar.disabled = true;
        }else{
            //Habilita el boton
            botonEditar.disabled = false;
        }
    });
    // habilitar solo lectura en los campos si el nombre esta vacio
    if(campoValor.value === ""){                
        botonEditar.disabled =true;
        botonEliminar.disabled =true;
        campoValor.setAttribute("readonly", true);
        campoClave.setAttribute("readonly",true);
        campoEmail.setAttribute("readonly", true);
    }else{   
        //sino esta vacio quitar solo lectura en los campos
        botonEditar.disabled = false;
        botonEliminar.disabled = false;        
        campoValor.removeAttribute("readonly");
        campoClave.removeAttribute("readonly");
        campoEmail.removeAttribute("readonly");
    }
}

/**
 * Funcion Javascript:
 * Objetivo:
 *** Confirmar el proceso de editar o eliminar un usuario
 */
function confirmarOperacion(entidad){
    //obtenemos los botones
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");
    
    //Agregamos los eventos de clic en cada boton
    botonEditar.addEventListener("click", (event) => {
        mensaje = "¿Desea modificar los datos de este "+entidad+"?";
        return confirmar(mensaje, event);
    });

    botonEliminar.addEventListener("click", (event)=>{
        mensaje = "¿Desea eliminar los datos de este "+entidad+"?";
        //Invocamos la funcion confirmar
        confirmar(mensaje, event);  
    });
}

//----------------------------------
/**
 * Funcio javascript:
 * Objetivo:
 *** Recibe el mensaje y un evento, muestra una alerta de confirmacion 
     con el mensaje, si el usuario pulsa NO, entonces cancela el evento
     de enviar el formulario al controlador.     
 */
function confirmar(mensaje, evento){
    //Muestra una alerta de confirmacion (SI/NO)
    const respuesta = confirm(mensaje);
    //Si la respuesta es negativa
    if(!respuesta){
        //Cancelamos el envio del formualario
        evento.preventDefault();
    }
}


function habilitarBotonesGastos(){
    //Obtiene el boton y los campos
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");
    const campoUsuario = document.getElementById("usuario");
    const campoFecha = document.getElementById("fecha");
    const campoValor = document.getElementById("valor");
    const campoDetalles = document.getElementById("detalles");
    // Agrega un evento de entrada al campo nombre
    // el evento se activa solo cuando escriben en el campo
    campoValor.addEventListener("input", () => {
        //Verifica si el campo esta vacio        
        if(campoValor.value === ""){
            //Deshabilita el boton                        
            botonEditar.disabled = true;
            botonEliminar.disabled = true;
        }else{
            //Habilita el boton
            botonEditar.disabled = false;            
        }
    });
    // habilitar solo lectura en los campos si el nombre esta vacio
    if(campoValor.value === ""){                
        botonEditar.disabled =true;
        botonEliminar.disabled =true;
        campoValor.setAttribute("readonly", true);
        campoDetalles.setAttribute("readonly",true);
        campoFecha.setAttribute("readonly", true);
    }else{   
        //sino esta vacio quitar solo lectura en los campos
        botonEditar.disabled = false;
        botonEliminar.disabled = false;        
        campoValor.removeAttribute("readonly");
        campoDetalles.removeAttribute("readonly");
        campoFecha.removeAttribute("readonly");
    }
}