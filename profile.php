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
                                    <?php
                                    
                                        if (isset($_GET['uid'])) {
                                            $kuser = $_GET['uid'];
                                        }elseif(isset($_SESSION['userid'])){
                                            $kuser = $_SESSION['userid'];
                                        }
                                        else {echo '<script>window.location.href = "login.html";</script>';
                                            exit();
                                        }
                                        $fetch = Functions::MyQuery("SELECT * FROM users order by ball desc;");
                                            $no=0;
                                            $ind = 0;
                                            foreach($fetch as $value){
                                                $no++;
                                                if ($value['login'] == $kuser){ 
                                                    echo('
                                                    <h3 class=" pt-3" align="center">Profile</h3> 
                                                    <h5 style="color: darkblue;" align="center">'.$value['name'].'</h5>
                                                    <h5 style="color: darkblue;" align="center">@'.$value['login'].'</h5>
                                                    <h5 style="color: darkblue;" align="center">'.$value['ball'].' Ball</h5>
                                                    <h5 style="color: darkblue;" align="center">'.$no.' O`rin</h5>');
                                                    $ind++;
                                                    break;
                                                }
                                                if ($ind == 0) {
                                                    echo '<script>window.location.href = "login.html";</script>';
                                                    exit();
                                                }
                                            }

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