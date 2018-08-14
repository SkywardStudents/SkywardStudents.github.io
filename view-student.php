<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    



<script>
$(document).ready(function(){
    $('#getUser').on('click',function(){
        var studentid = $('#studentid').val();
        $.ajax({
            type:'POST',
            url:'getData.php',
            dataType: "json",
            data:{studentid:studentid},
            success:function(data){
                if(data.status == 'ok'){
                    $('#partyname').text(data.result.name);
                    $('#firstname').text(data.result.email);
                   $('#lastname').text(data.result.phone);
                   // $('#userCreated').text(data.result.created);
                    $('.user-content').slideDown();
                }else{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
    });
});
</script>

<br>
<br>      
<h2 align="center">VIEW STUDENT DATA </h2>
   <h4 align="center">View Students Recommended for Intervention</h4> 
	
	<input type="text" id="studentid" />
<input type="button" id="getUser" value="Get Details"/>
<div class="user-content" style="display: none;">
    <h4>User Details</h4>
    <p>Name: <span id="partyname"></span></p>
    <p>Email: <span id="firstname"></span></p>
    <p>Phone: <span id="lastname"></span></p>
   
</div>
              