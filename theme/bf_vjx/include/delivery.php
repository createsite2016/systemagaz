<?php ?>
<div class="half_hold">
                            <div class="half">
                                <div class="cart_choise_blk">
                                    <h3 class="h3">Доставка</h3>
                                    <?$i=0;?>
                                    <?foreach ($template["DELIVERY"] as $value){ ?>
                                    <label class="custom_check_lab">
                                        <input class="outtaHere" name="delivery1" value="" type="radio" <?if($i==0){echo'checked';}?>>
                                        <span class="custom_radio"></span>
                                        <?=$value["name"]?> <b><?=$value["chena"]?> Руб.</b> <?=$value["komment"]?>
                                    </label>
                                    <?$i++;}?>
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="delivery1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--Доставка курьером: <b>500 Р</b>-->
<!--                                    </label>-->
                                </div>
                            </div>

                            <div class="half">
                                <div class="cart_choise_blk">
                                    <h3 class="h3">Оплата</h3>

                                    <label class="custom_check_lab">
                                        <input class="outtaHere" name="payment1" value="" type="radio" checked>
                                        <span class="custom_radio"></span>
Банковской картой
</label>
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="payment1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--Наличный расчет-->
<!--</label>-->
                                </div>
                            </div>
                        </div>