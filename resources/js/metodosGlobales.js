
export default {
    methods: {

      showToast(color, message) 
      {
          console.log(color,message)
            toastr.options = {
              closeButton: true,
              progressBar: true,
              positionClass: 'toast-bottom-right',
              showDuration: 300,
              hideDuration: 1000,
              timeOut: 5000,
              extendedTimeOut: 1000
            };
          
            toastr[color](message);
    }, //probaRut
    formatearRut(rut) {
      // Eliminar puntos y guiones del RUT
      rut = rut.replace(/[.-]/g, '');
      
      // Validar longitud mínima del RUT
      if (rut.length < 2) {
        return false;
      }
      
      // Separar dígito verificador del cuerpo del RUT
      const cuerpo = rut.slice(0, -1);
      const dv = rut.slice(-1).toUpperCase();
      
      // Validar que el cuerpo del RUT sea un número
      if (!/^\d+$/.test(cuerpo)) {
        return false;
      }
      
      // Calcular dígito verificador esperado
      let suma = 0;
      let factor = 2;
      
      for (let i = cuerpo.length - 1; i >= 0; i--) {
        suma += factor * parseInt(cuerpo.charAt(i), 10);
        factor = factor === 7 ? 2 : factor + 1;
      }
      
      const dvEsperado = 11 - (suma % 11);
      const dvCalculado = dvEsperado === 11 ? '0' : dvEsperado === 10 ? 'K' : dvEsperado.toString();
      
      // Comparar dígito verificador calculado con el proporcionado
      if (dv !== dvCalculado) {
        return false;
      }
      
      // Formatear el RUT con puntos y guión
      //const rutFormateado = cuerpo.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + dv;
      const rutFormateado = cuerpo + '-' + dv;
      
      return rutFormateado;
    }
    
    

    }
}