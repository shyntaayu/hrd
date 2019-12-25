$(function(){

	var save_and_close = false;

	// Original GroceryCRUD. currently do not know what this function do
	var reload_datagrid = function () {
		$('.refresh-data').trigger('click');
	};

	// Original GroceryCRUD. save and close button
	$('#save-and-go-back-button').click(function(){
		save_and_close = true;

		$('#crudForm').trigger('submit');
	});

	// Original GroceryCRUD. I change the notification to pnotify
	$('#crudForm').submit(function(){
		$(this).ajaxSubmit({
			url: validation_url,
			dataType: 'json',
			beforeSend: function(){
				new PNotify(message_loading);
			},
			cache: false,
			success: function(data){
				PNotify.removeAll();
				if(data.success){
					$('#crudForm').ajaxSubmit({
						dataType: 'text',
						cache: false,
						beforeSend: function(){
							new PNotify(message_loading);
						},
						success: function(result){
							console.log(result);
							console.log('bbb');
							PNotify.removeAll();
							data = $.parseJSON( result );
							//parse url to get id
							var id = null;
							if( data.success_list_url )
							{
								var URL = data.success_list_url;
								var elm = URL.split('/');
								id = elm[elm.length - 1];
								
								if( $('#tipe_jaminan').length > 0 )
								{
									if( confirm('Ingin cetak nota?') )
									{
										window.open('http://localhost/ewardrobe/master/cetak_nota/' + id,'_blank');
									}
								}
								
							}
							
							
							if(data.success){

								if(save_and_close){
									if ($('#save-and-go-back-button').closest('.ui-dialog').length === 0) {
										window.location = data.success_list_url;
									} else {
										$(".ui-dialog-content").dialog("close");
										new PNotify({
											title: 'Success!',
											text: data.success_message,
											type: 'success'
										});
									}

									return true;
								}

								$('.field_error').removeClass('field_error');
								new PNotify({
									title: 'Success!',
									text: data.success_message,
									type: 'success'
								});
							} else {
								new PNotify({
									title: 'Oh No!',
									text: data.error_message,
									type: 'error'
								});
							}
						},
						error: function(){
							var error_message = data.hasOwnProperty('error_message') ? data.error_message : message_insert_error;
							new PNotify({
								title: 'Oh No!',
								text: error_message, //data.error_message,
								type: 'error'
							});
						}
					});
				} else {
					$('.field_error').removeClass('field_error');
					new PNotify({
						title: 'Oh No!',
						text: data.error_message,
						type: 'error'
					});

					$.each(data.error_fields, function(index,value){
						$('#crudForm input[name='+index+']').addClass('field_error');
					});
				}
			}
		});
		return false;
	});

	// Original GroceryCRUD. Currently do not know what for, I think for changing button looks ?
	$('.ui-input-button').button();
	$('.gotoListButton').button({
        icons: {
        	primary: "ui-icon-triangle-1-w"
    	}
	});

	// Original GroceryCRUD. For cancel button. I change confirm message to pnotify confirm
	if( $('#cancel-button').closest('.ui-dialog').length === 0 ) {
		$('#cancel-button').click(function(){
			notice = new PNotify({
				title: 'Confirmation Needed',
				text: message_alert_edit_form,
				icon: 'glyphicon glyphicon-question-sign',
				hide: false,
				confirm: {
					confirm: true
				},
				buttons: {
					closer: false,
					sticker: false
				},
				history: {
					history: false
				},
				addclass: 'stack-modal',
				stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
			});

			notice.get().on('pnotify.confirm', function() {
				window.location = list_url;
			});

			return false;
		});
	}

});