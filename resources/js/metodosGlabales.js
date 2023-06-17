
export default {
    methods: {

      showToast(color, message) 
      {
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
    }

    }
}