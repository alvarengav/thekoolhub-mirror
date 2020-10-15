
  $('.save-action', formGlobal).remove();
  $('.save-action-close', formGlobal).addClass('btn-success');
  formGlobal.validate({ 
    rules : {   
      'id_project': {
        required : function(){
          return ($('#id_categoryForm<?= $wgetId ?>').val() == 1);
        }
      }, 
      'title': 'required'
    },
    messages : {
    }
  });  