
	<script type="text/javascript">
		function associate_errors(errors, $form)
		{	 
		    //remove existing error classes and error messages from form groups
		    $form.find('.form-group').removeClass('has-error').find('.help-text').text('');
		   
		    $.each(errors, function(value, index){
		        //find each form group, which is given a unique id based on the form field's name  add the error class and set the error text
		        $('input#'+value).parent().addClass('has-error').find('.help-text').text(index);
		    });
		}
	</script>
</body>

</html>