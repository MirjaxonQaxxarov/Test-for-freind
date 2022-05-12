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
                                    <h3 class=" pt-3" align="center">Reyting</h3> 
                                    <table class="table" style="background-color: rgba(87,147,167,0.7);">
                                        <thead >
                                            <tr>
                                                <th>Rank</th>
                                                <th>Username</th>
                                                <th>Ball</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fetch = Functions::MyQuery("SELECT login , ball, rol FROM users  order by ball desc;");
                                            $no=0;
                                            foreach($fetch as $value){
                                                if($value['rol']=="user"){
                                                    $no++;
                                                    echo('
                                                        <tr>
                                                            <td>'.$no.'</td>
                                                            <td><a style="color: #fff;" href="profile?uid='.$value['login'].'">@'.$value['login'].'</a></td>
                                                            <td>'.$value['ball'].'</td>
                                                        </tr>
                                                    ');
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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