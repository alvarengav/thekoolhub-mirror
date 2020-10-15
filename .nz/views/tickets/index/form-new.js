
  $('#id_categoryForm<?= $wgetId ?>').change(function(){
    var $this = $(this);
    if($this.val() > 1)
      $('#id_projectForm<?= $wgetId ?>').val('').prop('disabled', true);
    else
      $('#id_projectForm<?= $wgetId ?>').prop('disabled', false);
  }).change();

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
  
  App.changeMenu('tickets', 'report');