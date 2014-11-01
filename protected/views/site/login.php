<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="col-xs-12">
    <div class="center-dialog">
        <h3 class="text-center">Войти</h3>


        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'htmlOptions' => array('class' => 'form-horizontal'),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

            <div class="form-group">
                <?php echo $form->label($model,'username',array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'password',array('class'=>'col-sm-3 control-label'));?>
                <div class="col-sm-9">
                    <?php echo $form->passwordField($model,'password',array(
                        'class'=>'form-control',
                    )); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model,'rememberMe'); ?> Запомнить меня
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-actions text-center">
                <?php echo CHtml::tag(
                    'input',
                    array('class' => 'btn btn-primary','type'=>'submit','value'=>'Войти')
                ); ?>
            </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
