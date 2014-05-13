<script type="text/javascript">
	
	jQuery(document).ready(function()
	{
		jQuery('#submit-myform').click(function(e)
		{
			e.preventDefault();
			var reg 		= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var name  		= jQuery('#rp_name').val(),
				email  		= jQuery('#rp_email').val(),
				subject  	= jQuery('#rp_subject').val(),
				message  	= jQuery('#rp_message').val(),
				data_html,
				success 	= jQuery('#success');
				
    		if(name == "" || name == '<?php echo lang('front.contacto_name_required'); ?>')
                jQuery('#rp_name').val('<?php echo lang('front.contacto_name_required'); ?>');
				
			if(subject == "" || subject == '<?php echo lang('front.contacto_asunto_required'); ?>')
                jQuery('#rp_subject').val('<?php echo lang('front.contacto_asunto_required'); ?>');

            if(email == "" || email == '<?php echo lang('front.contacto_email_required'); ?>')
			{
                jQuery('#rp_email').val('<?php echo lang('front.contacto_email_required'); ?>');
            }
            else if(reg.test(email) == false)
            {
                jQuery('#rp_email').val('<?php echo lang('front.contacto_email_invalido'); ?>');
            }
			
            if(message == "" || message == '<?php echo lang('front.contacto_mensaje_required'); ?>')
                jQuery('#rp_message').val('<?php echo lang('front.contacto_mensaje_required'); ?>');

			if(message != "" && name != "" && reg.test(email) != false)
			{
            	data_html = "nombre=" + name + "&email="+ email + "&mensaje=" + message + "&asunto="+ subject;
                jQuery.ajax({
                    type: 'POST',
                    url: 'contacto/contacto_front/ajax_enviar_mensaje',
                    data: data_html,
                    success: function(msg){
						
						if (msg == 'sent'){
                        	success.html('<div class="alert alert-success"><?php echo lang('front.contacto_sent'); ?></div>')  ;
                            jQuery('#rp_name').val('');
							jQuery('#rp_email').val('');
							jQuery('#rp_message').val('');
							jQuery('#rp_subject').val('');
                        }else{
                            success.html('<div class="alert alert-error"><?php echo lang('front.contacto_not_sent'); ?></div>')  ; 
                        }
                    }
                });
            }
            return false;
		});
		
		jQuery('#submit-testimonio').click(function(e)
		{
			e.preventDefault();
			var reg 		= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var name  		= jQuery('#test_name').val(),
				email  		= jQuery('#test_email').val(),
				subject  	= jQuery('#test_subject').val(),
				message  	= jQuery('#test_message').val(),
				data_html,
				success 	= jQuery('#success2');
				
    		if(name == "" || name == '<?php echo lang('front.contacto_name_required'); ?>')
                jQuery('#test_name').val('<?php echo lang('front.contacto_name_required'); ?>');
				
			if(subject == "" || subject == '<?php echo lang('front.contacto_asunto_required'); ?>')
                jQuery('#test_subject').val('<?php echo lang('front.contacto_asunto_required'); ?>');

            if(email == "" || email == '<?php echo lang('front.contacto_email_required'); ?>')
			{
                jQuery('#test_email').val('<?php echo lang('front.contacto_email_required'); ?>');
            }
            else if(reg.test(email) == false)
            {
                jQuery('#test_email').val('<?php echo lang('front.contacto_email_invalido'); ?>');
            }
			
            if(message == "" || message == '<?php echo lang('front.contacto_mensaje_required'); ?>')
                jQuery('#test_message').val('<?php echo lang('front.contacto_mensaje_required'); ?>');

			if(message != "" && name != "" && reg.test(email) != false)
			{
            	data_html = "nombre=" + name + "&email="+ email + "&mensaje=" + message + "&asunto="+ subject;
                jQuery.ajax({
                    type: 'POST',
                    url: 'contacto/contacto_front/ajax_guardar_testimonio',
                    data: data_html,
                    success: function(msg){
						
						if (msg == 'sent'){
                        	success.html('<div class="alert alert-success"><?php echo lang('front.contacto_sent'); ?></div>')  ;
                            jQuery('#test_name').val('');
							jQuery('#test_email').val('');
							jQuery('#test_message').val('');
							jQuery('#test_subject').val('');
                        }
                        else if(msg == 'failed_already_exists')
                        {
                            success.html('<div class="alert alert-error"><?php echo lang('front.contacto_not_sent2'); ?></div>')  ; 
                        }
                        else
                        {
                            success.html('<div class="alert alert-error"><?php echo lang('front.contacto_not_sent'); ?></div>')  ; 
                        }
                    }
                });
            }
            return false;
		});
	});
	
</script>