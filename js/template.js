
$(document).ready(function() {
    	var form = $('form[name=add_to_email_list]');
	var proc = form.find('div.processing');
	var success = form.find('div.success');
	var inputs = form.find('input[type=text]');
	var submit = form.find('input[type=submit]');

	form.css({
		'line-height': '25px',
		    'margin-bottom': '20px'
		    });
	proc.css({
		'text-align': 'center',
		    'font-size': '10px',
		    'clear': 'both'
		    });
	inputs.css({
		'float': 'right',
		    'width': '140px',
		    'margin': '3px 0 0',
		    'padding': '3px 10px',
		    'border-radius': '3px',
		    'border': 'solid 1px #CCC'
		    });
	submit.css({
		'float': 'right'
		    });
	form.find('input[type=submit]').click(function(e) {
		e.preventDefault();
		var data = {};
		var valid = true;
		inputs.attr('disabled', true)
		    .each(function() {
			var inp = $(this)
			var val = inp.val()
			var name = inp.attr('name')
			if(val=="") {
			    valid = false
			    return false
			}
			inp.css("border", "solid 1px #CCC")
			data[name] = val
		})

		console.log(data)
		if( valid ) {
		    proc.html('subscribing...')
		    $.ajax({
			url: "api/chronicle/email/add",
			dataType: "json",
			data: data,
			success: function( resp ) {
			    console.log(resp);
                            
			    if( resp.status == false ) {
			        alert(resp.error);
			        proc.html('Failed');
			    }
                            else {
			        inputs.val("");
                                proc.html('')
			        success
                                    .html('Thank you for subscribing')
                                    .show().fadeOut(3000)
                                
                            }
			},
			error: function( resp ) {
                            console.log(resp.responseText)
                        }
		    })
		} else {
		    alert('Please fill in your first name, last name and email.')
		    inputs.each(function() {
			    $this = $(this)
			    if($this.val()=="") {
				$this.css("border", "solid 1px #C00")
			    }
		    })
		}
		inputs.attr('disabled', null)
	})
})
