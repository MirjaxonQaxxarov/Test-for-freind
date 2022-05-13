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
                                    <form id="form">
                                        <input style="margin:auto; margin-top:1vh;" name="name" type="text" class="form-control col-6" placeholder="To`liq Ism">
                                        <input style="margin:auto; margin-top:1vh;" name="login" type="text" class="form-control col-6" placeholder="Login">
                                        <input style="margin:auto; margin-top:1vh;" name="password" type="text" class="form-control col-6" placeholder="Password">
                                        <input type="hidden" name="_csrf"  value="<?=$_SESSION["_csrf"]?>">
                                        <button style="margin-top:1vh; margin-left:48%" id="ok1" type="submit" class="btn btn-success">Register</button> <a  href="login">Menda account mavjud</a>
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
      url: "addall.html?test1=<?=str_rot13("Remember me")?>&table=<?=str_rot13("users")?>&test2=<?=str_rot13("Login or  Password is wrong")?>&soni=<?=3*$keyuser?>",
      type: 'POST',
      processData: false,
      contentType: false,
      data: new FormData($("#form")[0]),
      success: function (data) {
        console.log(data);  
          var obj = jQuery.parseJSON(data);
        if (obj.xatolik==0) {
          alert("Muvaffaqiyatli");
          setTimeout(() => {
            location.href="login.html";
          }, 1000);
        } else {
          $('#_csrf').val(obj._csrf);
          alert("Tekshirishda xatolik!");
        }
      },
      error: function () {
        alert("Bog`lanishda Xatolik!");
      },
    });
  });

</script>
