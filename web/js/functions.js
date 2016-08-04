function AjaxForm()
{
    $('body').on('submit', '.ajaxForm', function (e) {
 
        e.preventDefault();
		
		/*
		* Recuperamos los campos del formulario 
		*/
		
		id_form = $(this).attr('id');
		my_form=document.getElementById(id_form);	
		var values = {};
		for (i=0;i<my_form.elements.length;i++) {		
			try {
				id_field = my_form.elements[i].id;		
				value = document.getElementById(id_field).value;
				values[id_field] =value;
			}catch(err){
				continue;
			}				
		}
				 
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize()	
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
				$('.form_error').html('');
				$('.form_success').html(data.message);
				
				//Si el resultado es correcto limpiamos los campos del form
				for (i=0;i<my_form.elements.length;i++) {		
					try {
						id_field = my_form.elements[i].id;		
						document.getElementById(id_field).value = '';						
					}catch(err){
						continue;
					}				
				}
            }else 
				alert(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }
 
				$('.form_success').html('');
                $('.form_error').html(jqXHR.responseJSON.message);
 
            } else {
                alert(errorThrown);
            }
 
        });
    });
}
