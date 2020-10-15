<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppForm_validation extends CI_Form_validation {

	public function __construct($rules = array())
  {
    parent::__construct($rules);
    $this->_error_messages = array(
      'required' => $this->CI->lang->line('Campo obligatorio'),
      'isset' => $this->CI->lang->line('Campo obligatorio'),
      'valid_email' => $this->CI->lang->line('Introduce una dirección de correo electrónico válida'),
      'valid_emails' => $this->CI->lang->line('Introduce una dirección de correo electrónico válida'),
      'valid_url' => $this->CI->lang->line('Introduce una URL válida'),
      'valid_ip' => $this->CI->lang->line('Introduce una IP válida'),
      'min_length' => $this->CI->lang->line('Longitud inválida'),
      'max_length' => $this->CI->lang->line('Longitud inválida'),
      'exact_length' => $this->CI->lang->line('Longitud inválida'),
      'alpha' => $this->CI->lang->line('Debe contener sólo caracteres alfabéticos'),
      'alpha_numeric' => $this->CI->lang->line('Debe contener sólo caracteres alfa-numéricos'),
      'alpha_dash' => $this->CI->lang->line('Debe contener sólo caracteres alfa-numéricos, guiones bajos y guiones'),
      'numeric' => $this->CI->lang->line('Debe contener sólo números'),
      'is_numeric' => $this->CI->lang->line('Debe contener sólo caracteres numéricos'),
      'integer' => $this->CI->lang->line('Debe contener un número entero'),
      'matches' => $this->CI->lang->line('Campo inválido'),
      'is_natural' => $this->CI->lang->line('Sólo múmeros positivos'),
      'is_natural_no_zero' => $this->CI->lang->line('Debe contener un número mayor que cero')
     );
  }
  
	public function set_error($field = '', $error = '')
	{
		if ( ! isset($this->_field_data[$field]) )
		{
			return $this;
		}

    $this->_field_data[$field]['error'] = $error;    
		return $this;
	}
  
  public function error_class($field = '')
	{
		if ( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '' )
		{
			return count($_POST) ? 'state-success' : '';
		}
    
    return 'state-error';
  }
  
	public function error_array($prefix = '', $suffix = '')
	{
		// No errrors, validation passes!
		$array = array();
		if (count($this->_error_array) === 0)
		{
			return $array;
		}

		if ($prefix == '')
		{
			$prefix = $this->_error_prefix;
		}

		if ($suffix == '')
		{
			$suffix = $this->_error_suffix;
		}

		// Generate the error array
		foreach ($this->_error_array as $val)
		{
			if ($val != '')
			{
				$array[] = $prefix.$val.$suffix;
			}
		}

		return $array;
	}
  
}