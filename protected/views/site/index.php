<?php
/* @var $this SiteController */
/* @var $model UploadForm */
/* @var $form CActiveForm */
?>
<h1>Печать фотографий в <span class="city">Набережных Челнах</span></h1>
<img src="images/gallery.png" width="128px" height="128px" style="float: left;" border="0">
<p>
    Как правило после выезда на природу, полета на отдых, свадьбы или рождения малыша
    у человека накапливаются фотографии в электронном виде, которые будучи закинутые
    на комьютер лежат там мертвым грузом.
</p>
<div style="height: 270px;width: 80px;float: right"></div>
<p>
    Теперь <span class="title"><span>z</span>Photos</span> предлагает вам возможность
    распечатать свои фотографии в <span class="city">Набережных челнах</span>
    по удивительно низкой цене, всего по
    <span class="money"><?php echo number_format(Yii::app()->params['price'],2);?></span> рубля
    за фотографию 10x15. Минимальный заказ
    <span class="photo-count">от <?php echo Yii::app()->params['min_count'];?> фотографий</span>.
</p>
    Столь низкая цена обусловлена автоматизацией печати:
    <ul>
        <li><span>Вы загружаете свои фотографии через сайт;</span></li>
        <li><span>При необходимости корректируете область, которая будет распечатана;</span></li>
        <li><span>И наши принтеры <b>автоматически</b> их распечатывают.</span></li>
    </ul>
<p>
    Поскольку в данном процессе минимизированы людские ресурсы, стоимость одной фотографии
    значительно уменьшается, а так же:
    <ul>
        <li><span>Увеличивается скорость обработки заказов: теперь вам <b>не надо ждать</b> очередей
            когда оператор выделит время для распечатки</span></li>
        <li><span>Уменьшается скорость обработки одного заказа, за счет ненадобностью оператору
            самому подготавливать фотографии</span></li>
        <li><span>Отсутствие ошибок человеческого фактора: программы точно и
            четко выполняют свои задачи</span></li>
    </ul>
</p>

<div class="chelny"></div>

<h1>Доставка и оплата</h1>
<img src="images/transport.png" width="128px" height="128px" style="float: right;" border="0">
На данный момент мы предлагаем вам один из следующих вариантов:
<ul>
    <li><span>Вы загружаете свои фотографии на сайт, приезжаете на пункт выдачи, оплачиваете заказ
        <b>наличными</b> и в течении часа забираете его</span></li>
    <li><span>Вы загружаете свои фотографии на сайт, оплачиваете заказ <b>картой VISA / MasterCard</b>
        и в течении дня забираете его</span></li>
    <li><span>При наличии купона, вы загружаете свои фотографии на сайт, вводите номер <b>купона</b>
        и в течении дня забираете заказ</span></li>
    <li><span><b>Постоянным клиентам</b>: вы загружаете свои фотографии на сайт,
        в течении дня забираете заказ, оплатив его на пункте приема</span></li>
</ul>