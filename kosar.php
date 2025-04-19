<?php
    require "database/db_connect.php";

    $sql = "SELECT termek.id AS termekId, termek.nev, marka.ceg AS marka, termek.ar, kosar_tetelek.mennyiseg AS darab, kosarak.id, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM `kosarak` INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<div class="container cart-container">
    <div class="row">
        <div class="col-12">
            <h2 class="cart-header"><i class="fas fa-shopping-cart me-2"></i>Kosár tartalma</h2>
        </div>
    </div>

    <div class="row">
        <!-- Cart Items Column -->
        <div class="col-lg-8">
            <?php
            if(isset($_SESSION['user_id'])){
                if(!empty($result)){
                    foreach($result as $cipo){
                        echo '<div class="cart-item" data-termek-kosar-id="'.$cipo['termekId'].'">';
                            echo '<input type="hidden" value="'.$cipo["termekId"].'" >';
                            echo '<div class="row align-items-center">';
                                echo '<div class="col-3 col-md-2">';
                                    echo '<img src="'.$cipo['elso_kep'].'" alt="Termék neve" class="img-fluid product-img">';
                                echo '</div>';
                                echo '<div class="col-5 col-md-6">';
                                    echo '<h5 class="product-title">'.$cipo['nev'].'</h5>';
                                    echo '<p class="product-author">'.$cipo['marka'].'</p>';
                                    echo '<button class="btn btn-sm btn-outline-danger btn-remove"><i class="fas fa-trash me-1"></i>Törlés</button>';
                                echo '</div>';
                                echo '<div class="col-12 col-md-2 text-md-end mt-2 mt-md-0">';
                                    echo '<div class="price">'.$cipo['ar']*$cipo['darab'].' FT</div>';
                                    echo '<div class="unit-price">'.$cipo['ar'].' FT/db</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                }else{
                    echo '<div class="row">';
                        echo '<div class="col-12">';
                            echo '<div class="empty-cart">';
                                echo '<i class="fas fa-shopping-cart empty-cart-icon"></i>';
                                echo '<h3 class="empty-cart-title">A kosarad üres</h3>';
                                echo '<p class="empty-cart-text">Nincsenek termékek a kosaradban.</p>';
                                echo '<a href="/" class="btn btn-primary">Vásárlás folytatása</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="row">';
                    echo '<div class="col-12">';
                        echo '<div class="empty-cart">';
                            echo '<i class="fas fa-shopping-cart empty-cart-icon"></i>';
                            echo '<h3 class="empty-cart-title">A kosarad üres</h3>';
                            echo '<p class="empty-cart-text">Nincsenek termékek a kosaradban.</p>';
                            echo '<button id="kosar-login" class="btn btn-primary" >Jelentkezz be!</button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Order Summary Column -->
        <div class="col-lg-4">
            <div class="summary-card">
                <h5 class="summary-title">Rendelés összegzése</h5>
                <div class="summary-row">
                    <span>Termékek összege:</span>
                    <span><?php 
                        if(isset($_SESSION['user_id'])){
                            $összeg = 0;
                            for ($i=0; $i < count($result); $i++) { 
                                $összeg+=($result[$i]['ar']*$result[$i]['darab']);
                            }
                            echo $összeg." FT";
                        }else{
                            echo "0 FT";
                        }
                        ?>
                    </span>
                </div>
                    <div class="summary-row">
                        <span>Szállítás:</span>
                        <span><?php if(!empty($result)){echo "1290 FT";}else{echo "0 FT";} ?></span>
                    </div>
                    <hr>
                    <div class="summary-row mb-3">
                        <span class="summary-total">Összesen:</span>
                        <span class="summary-total"><?php
                                                    if(isset($_SESSION['user_id'])){
                                                        if(!empty($result)){
                                                            echo ($összeg+1290)." FT";
                                                        }else{
                                                            echo "0 FT";
                                                        }
                                                    }else{
                                                        echo "0 FT";
                                                    }
                                                    ?>
                                                </span>
                    </div>
                    <?php
                        if(isset($_SESSION['user_id'])){
                            echo '<a href="/fizetes" style="text-decoration:none; color:white;"><button class=" btn-checkout btn-lg mb-3">Tovább a fizetéshez</button></a>';
                        }else{
                            echo '<button id="kosar-fizet-gomb" class=" btn-checkout btn-lg mb-3">Jelentkezz be!</button>';
                        }
                    ?>
                    <div class="text-center">
                        <small class="text-muted">A rendelésedet 30 napig vissza tudod mondani.</small>
                </div>
            </div>
        </div>
    </div>
</div> 

