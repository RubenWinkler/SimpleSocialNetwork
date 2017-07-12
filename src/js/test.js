<script type="text/javascript">
   $("form").submit(function(){
       var str = $(this).serialize();
       $.ajax('getResult.php', str, function(result){
           alert(result); // the result variable will contain any text echoed by getResult.php
       });
       return(false);
   });
</script>
