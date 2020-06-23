(function ($) {
    $.validator.addMethod("caracteres", function(value, element){
        return this.optional(element) || /^([A-Z]|[a-z]|[\.\s])+$/i.test(value);
    });

    $.validator.addMethod("controlsi", function(value, element){
        return  /^abc123$/g.test(value);
    })

    $("#edit-submit").on("click", function(e) {
      $("#myusers-form-new").validate({
          rules: {
              nombre: {
                  required: true,
                  minlength:3,
                  caracteres: true
              },
              controlajax: {
                controlsi: true
              }
          },

          messages: {
              nombre: {
                  required: "El campo es requerido",
                  minlength: "El minimo permitido son 3 caracteres",
                  caracteres: "Solo permite caracteres a-z, A-Z, punto y espacio",
              },
              controlajax: {
                required: "El campo es requerido",
                controlsi: "El Usuario ya existe !!!"
              }
          }
      })

    })

})(jQuery);
