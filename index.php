<?php
include_once "menu/menu.php";

if (!isset($_SESSION["rol"])) {

    echo '<script>window.location.href = "login.php";</script>';
    exit();

}


if (isset($_GET['fanid'])) {
    $_SESSION['fanid'] = filter($_GET['fanid']);
}
?>


    
<main>
            <section class="top-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-11 col-12 m-auto">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <h3 class=" pt-3">Fanlar</h3> 
                                    <?php
                                        $fetch = Functions::getall("fan");
                                        $no=0;
                                        foreach($fetch as $value){
                                            $no++;
                                            echo ('
                                                <a style=" font-size: 20px;" href="index?fanid='.$keyuser*$value['id'].'">'.$value['name'].'</a><br>
                                            ');
                                        }
                                        if ($no == 0) {
                                            echo "Xozircha fanlar mavjud emas!";
                                        }
                                    ?>
                                    
                                </div>
                                <div class="col-md-8 col-12">
                                <?php
                                
                                    if (isset($_SESSION['fanid'])) {
                                        $fanid = intval($_SESSION['fanid']/$keyuser);
                                        
                                        $fetchf = Functions::getbyid("fan",$fanid);
                                        foreach($fetchf as $value)
                                        echo ('
                                            <h3 class=" pt-3">'.$value['name'].' fani bo`yicha testlar</h3> 
                                            <form  id="form" style="color:darkblue">
                                            ');
                                        $fetch = Functions::getbytable("test","fid=$fanid ORDER BY RAND() LIMIT 15");
                                        $no=0;
                                        foreach($fetch as $value){
                                            $no++;
                                            $keycha = 'test'.$no;
                                            $_SESSION[$keycha] = rand(1000,9999);
                                            $s11 = rand(1000,9999);
                                            $s12 = rand(1000,9999);
                                            $s13 = rand(1000,9999);
                                            $a=array('<label >
                                                    <input type="radio" name="test'.$no.'" value="'.$_SESSION[$keycha].'" > '.$value['tval'].' 
                                                </label><br>','<label >
                                                    <input type="radio" name="test'.$no.'" value="'.$s11.'" > '.$value['fval1'].' 
                                                </label><br>','<label >
                                                    <input type="radio" name="test'.$no.'" value="'.$s12.'"> '.$value['fval2'].' 
                                                </label><br>','<label >
                                                    <input type="radio" name="test'.$no.'" value="'.$s13.'" > '.$value['fval3'].' 
                                                </label><br>');
                                                $s=rand(0,3);
                                                           $ar1=$a[0];  $a[0]=$a[$s]; $a[$s]=$ar1;
                                                  $s=rand(0,3);          $ar1=$a[1];  $a[1]=$a[$s]; $a[$s]=$ar1;
                                                   $s=rand(0,3);         $ar1=$a[2];  $a[2]=$a[$s]; $a[$s]=$ar1;
                                                    $s=rand(0,3);        $ar1=$a[3];  $a[3]=$a[$s]; $a[$s]=$ar1;
                                            echo ('
                                                <p><b>'.$no.'.</b> '.$value['question'].'</p>
                                                '.$a[0].$a[1].$a[2].$a[3].'
                                                <br>
                                            ');
                                        }
                                        if ($no == 0) {
                                            echo '</form><h5 class=" pt-3">Xozircha fan bo`yicha test mavjud emas!</h5>';
                                        }
                                        else
                                        echo '
                                                <input type="hidden" name="_csrf" value="'.$_SESSION["_csrf"].'">
                                                <button class="btn btn-primary" style="" id="ok1" type="submit">Tekshirish</button>
                                            </form>';
                                    }
                                    else 
                                    echo ('
                                    <h3 class=" pt-3">Test boshlash uchun fanni tanlang</h3> ');
                                    ?>
                                </div>
                                <div class="col-md-2 col-12">
                                    <h3 class=" pt-3">So`ngi natijalar</h3> 
                                    <?php
                                    if (isset($_SESSION['fanid'])) {
                                        $fanid = intval($_SESSION['fanid']/$keyuser);
                                        
                                        $fetchf = Functions::getbyid("fan",$fanid);
                                        foreach($fetchf as $value)
                                        $fname = $value['name'];
                                        $userid = $_SESSION['userid'];
                                        $fetch = Functions::getbytable("result","fanid=$fanid and userid = $userid ORDER BY id desc LIMIT 5");
                                        $no=0;
                                        foreach($fetch as $value){
                                            $no++;
                                            echo ('
                                            <b>Fan:</b>'.$fname.' <br>
                                            <b>Vaqti:</b>'.$value['time'] .'<br>
                                            <b>Natija:</b>'.$value['ball'] .' Ball <br>
                                            <br>
                                            ');
                                        }
                                        if ($no == 0) {
                                            echo '<p class=" pt-3">Xozircha fan bo`yicha natijalar mavjud emas!</p>';
                                        }
                                    }
                                    else 
                                    echo ('
                                    <p class=" pt-3">Natijalar uchun fanni tanlang</p> ');
                                    ?> 
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
      url: "checkresult?test1=<?=str_rot13("Remember me")?>&test2=<?=str_rot13("Login or  Password is wrong")?><?=4*$keyuser?>",
      type: 'POST',
      processData: false,
      contentType: false,
      data: new FormData($("#form")[0]),
      success: function (data) {
        console.log(data);  
          var obj = jQuery.parseJSON(data);
        if (obj.xatolik==0) {
          alert("Sizning natijangiz :"+ obj.ball +"ball");
          setTimeout(() => {
            location.reload();
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
