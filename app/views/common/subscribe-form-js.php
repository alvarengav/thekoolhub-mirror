<script>
    $(document).ready(function() {
        console.log('pagina cargada');

        //por si hay mas de un formulario
        var forms = $(".subscribe-form-container form");
        forms = forms.length > 0 ? forms : $("#mc-embedded-subscribe-form");

        $.each(forms, function(index, formItem) {
            $(formItem).on('change', '.input-check', function() {
                var $form = $(this);
                var btnInput = $form.find("input[type='submit']");
                var checkeds = $form.find('.input-check');
                var c1 = checkeds[0];
                var c2 = checkeds[1];

                if (c1.checked && c2.checked) {
                    btnInput.attr('disabled', false);
                } else {
                    btnInput.attr('disabled', true);
                }

            }.bind(formItem));

            $(formItem).submit(suscribeHandler);
        });

        function suscribeHandler() {
            $this = $(this);

            var inputs = $this.find(':input.required');

            //validando que los inputs no esten vacíos
            var emptyFiels = false;
            inputs.each(function(index, input) {
                if (!input.value) {
                    emptyFiels = true;
                    return false;
                }
            });

            if (emptyFiels) {
                console.log('campos vacios');
                return;
            };

            inputEmail = $this.find("#mce-EMAIL");

            if (!isValidEmail(inputEmail.val())) {
                console.log('correo invalido');
                return;
            }

            function isValidEmail(email) {
                return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email);
            }

            $.ajax({
                type: "POST",
                url: $this.attr('data-action'),
                data: $this.serialize(),
                dataType: 'JSON',
            }).done(function(response) {
                console.log('subscriptor registered in database');
            }).fail(function(error) {
                console.error(error);
            });
        }
    });
</script>