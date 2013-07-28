<html>
<head>
<title><?php echo $title;?></title>
</head>
<body>
	<h1><?php echo $heading;?></h1>
	<input type="button" value="button" id='btn'></button>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type='text/javascript' language='javascript'>
$('#btn').click(function(){
 var button = $(this);
 $(button).prop('value', 'button clicked');
    $.ajax({
            url: '<?php echo base_url("index.php/blog/ajax");?>',
            type:'POST',
            dataType: 'text',
            success: function(output_string){
                    $(button).prop('value', output_string);
                } // End of success function of ajax form
            }); // End of ajax call 
 
});
</script>
</body>
</html>