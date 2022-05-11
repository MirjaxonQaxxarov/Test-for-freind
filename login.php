<?php
include_once "menu/menu.php";

?>


    
<main>
            <section class="top-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-11 col-12 m-auto">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <h3 class=" pt-3" align="center">Log in</h3>
                                    <form action="" id="form">
                                        <input style="margin:auto; margin-top:1vh;" type="text" class="form-control col-6" name="login" placeholder="Login">
                                        <input style="margin:auto; margin-top:1vh;" type="text" class="form-control col-6" name="parol" placeholder="Password">
                                        <input type="hidden" name="_csrf" value="<?=$_SESSION["_csrf"]?>">
                                        <button style="margin-top:1vh; margin-left:48%" type="submit" id="ok1" class="btn btn-success">Login</button> <a  href="register">Account Yaratish</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    
   
<?php
include_once "menu/footer.php";
?>

<script>

let submitBtn = document.getElementById('ok1');
  submitBtn.addEventListener("click", function submit(e) {
    e.preventDefault();
    $.ajax({
      url: "checklogin?password=<?=str_rot13("Remember me")?>&login=<?=str_rot13("Login or  Password is wrong")?><?=4*$keyuser?>",
      type: 'POST',
      processData: false,
      contentType: false,
      data: new FormData($("#form")[0]),
      success: function (data) {
        console.log(data);  
          var obj = jQuery.parseJSON(data);
        if (obj.xatolik==0) {
          alert("Kirishingiz mumkin!");
          setTimeout(() => {
            location.href = "index";
          }, 1000);
        } else {
          $('#_csrf').val(obj._csrf);
          alert("LOgin yoki parol xato!");
        }
      },
      error: function () {
        alert("Bog`lanishda Xatolik!");
      },
    });
  });

</script>
