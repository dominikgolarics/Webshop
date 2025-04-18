<div>
    <?php
    require "database/db_connect.php";

    $sql = "SELECT termek.id, termek.nev, marka.ceg as marka, termek.ar, kosar_tetelek.mennyiseg as darab, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM `kosarak` INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id";
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

                <!-- <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                            <img src="https://via.placeholder.com/100x150" alt="Termék neve" class="img-fluid product-img">
                        </div>
                        <div class="col-5 col-md-6">
                            <h5 class="product-title">A könyv címe</h5>
                            <p class="product-author">Szerző neve</p>
                            <button class="btn btn-sm btn-outline-danger btn-remove"><i class="fas fa-trash me-1"></i>Törlés</button>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="quantity-control">
                                <button class="quantity-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="quantity-btn">+</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 text-md-end mt-2 mt-md-0">
                            <div class="price">4 990 Ft</div>
                            <div class="unit-price">4 990 Ft/db</div>
                        </div>
                    </div>
                </div> -->

                <?php
                if(!empty($result)){
                    foreach($result as $cipo){
                        echo '<div class="cart-item">';
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
                ?>
                

                <!-- <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                            <img src="https://via.placeholder.com/100x150" alt="Termék neve" class="img-fluid product-img">
                        </div>
                        <div class="col-5 col-md-6">
                            <h5 class="product-title">Másik könyv címe</h5>
                            <p class="product-author">Másik szerző</p>
                            <button class="btn btn-sm btn-outline-danger btn-remove"><i class="fas fa-trash me-1"></i>Törlés</button>
                        </div>
                        <div class="col-12 col-md-2 text-md-end mt-2 mt-md-0">
                            <div class="price">9 980 Ft</div>
                            <div class="unit-price">4 990 Ft/db</div>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Order Summary Column -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="summary-title">Rendelés összegzése</h5>
                    <div class="summary-row">
                        <span>Termékek összege:</span>
                        <span><?php 
                            $összeg = 0;
                            for ($i=0; $i < count($result); $i++) { 
                                $összeg+=$result[$i]['ar'];
                            }
                            echo $összeg;
                        ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Szállítás:</span>
                        <span>1 290 Ft</span>
                    </div>
                    <hr>
                    <div class="summary-row mb-3">
                        <span class="summary-total">Összesen:</span>
                        <span class="summary-total"><?php echo $összeg+1290; ?></span>
                    </div>
                    <button class="btn btn-checkout btn-lg mb-3">Tovább a fizetéshez</button>
                    <div class="text-center">
                        <small class="text-muted">A rendelésedet 30 napig vissza tudod mondani.</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Empty Cart State (hidden by default) -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart empty-cart-icon"></i>
                    <h3 class="empty-cart-title">A kosarad üres</h3>
                    <p class="empty-cart-text">Nincsenek termékek a kosaradban.</p>
                    <a href="/" class="btn btn-primary">Vásárlás folytatása</a>
                </div>
            </div>
        </div> -->
    </div>
</div>