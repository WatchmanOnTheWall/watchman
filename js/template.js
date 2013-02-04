
$j(document).ready(function() {
	var form = $j('form[name=add_to_email_list]');
	var proc = form.find('div.processing');
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
			var inp = $j(this)
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
		    $j.ajax({
			url: "http://watchman.ca/email_manager/api/email_list/client_add",
				type: "post",
				dataType: "text",
				data: data,
			success: function(txt) {
				console.log(txt);
				if(txt=='true') {
				    alert('Thank you for subscribing to our eChronicle.');
				    inputs.attr("value", "");
				} else  {
				    alert('Sorry, we were unable to subscribe you at this time.')
				}
				proc.html('');
			}
		    })
		} else {
		    alert('Please fill in your first name, last name and email.')
		    inputs.each(function() {
			    $this = $j(this)
			    if($this.val()=="") {
				$this.css("border", "solid 1px #C00")
			    }
		    })
		}
		inputs.attr('disabled', null)
	})
})