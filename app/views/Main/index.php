<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->

<!--about-starts-->
<? if ($brands) {?>
<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <? foreach ($brands as $brand) {?>
                <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <img class="img-responsive" src="images/<?=$brand->img?>" alt=""/>
                    <figcaption>
                        <h2><?=$brand->title?></h2>
                        <p><?=$brand->description?></p>
                    </figcaption>
                </figure>
            </div>
            <?}?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?}?>
<!--about-end-->

<!--product-starts-->
<? if ($hits) {
    $curr = \ishop\App::$app->getProperty('currency');?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <? foreach ($hits as $hit) {?>
                <div class="product-one">
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="product/<?=$hit->alias;?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$hit->img?>" alt="" /></a>
                        <div class="product-bottom">
                            <h3><a href="product/<?=$hit->alias;?>"><?=$hit->title;?></a></h3>
                            <p>Explore Now</p>
                            <h4>
                                <a class="add-to-cart-link" data-id="<?=$hit->id;?>" href="cart/add?id=<?=$hit->id?>"><i></i></a> <span class="item_price"><?=$curr['symbol_left']?> <?=$hit->price * $curr['value'];?> <?=$curr['symbol_right']?></span>
                                <? if ($hit->old_price) {?>
                                    <small><del><?=$curr['symbol_left']?> <?=$hit->old_price * $curr['value'];?> <?=$curr['symbol_right']?></del></small>
                                <?}?>
                            </h4>
                        </div>
                        <? if ($hit->old_price) {
                            $countSalePercent = ($hit->price * 100 / $hit->old_price) - 100;?>
                            <div class="srch">
                                <span><?=round($countSalePercent)?>%</span>
                            </div>
                        <?}?>
                    </div>
                </div>

            </div>
            <?}?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?}?>
<!--product-end-->