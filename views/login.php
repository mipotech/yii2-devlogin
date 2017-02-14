<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$logoPath = Yii::$app->devlogin->logoPath;
?>

<div class="container" id="content">
    <?php if ($logoPath): ?>
        <div class="page-header text-center">
            <img src="<?=$logoPath?>" alt="<?=Html::encode(Yii::$app->name)?>" />
        </div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?php if ($model->errors): ?>
                <!-- @@@ -->
            <?php endif; ?>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <?= $form->field($model, 'username')->textInput([
                    'required' => true,
                ]) ?>
                <?= $form->field($model, 'password')->passwordInput([
                    'required' => true,
                ]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h4 class="text-center">
                Powered by <a href="http://www.mipotech.co.il" target="_blank">Mipo Technologies</a>
            </h4>
        </div>
    </div>
</div>
