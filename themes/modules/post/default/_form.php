<?php 
use yii\helpers\Html;
use modules\post\models\post;
use yii\bootstrap\ActiveForm;
?>
<div class='row'>
	<div class='col-md-9'>
		<div class='panel panel-default'>
            <div class='panel-body'>
            	<?php $form = ActiveForm::begin(['id'=>'UpdatePostForm']);?>
            		<?= $form->field($model,'title')->textInput()->label(Post::getPostType($model->type).Yii::t('post', 'Title'));?>
            		<?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions'=>['lang'=>'zh_cn']])?>
            		<div class="form-group">
        				<?= Html::submitButton($model->isNewRecord ? Yii::t('post', 'Create') : Yii::t('post', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    				</div>
            	<?php ActiveForm::end();?>	
            </div>
        </div>
    </div>
    <div class='col-md-3'>
     <div class='panel panel-default'>
        <div class='panel-heading'><?=Html::encode('注意事项')?></div>
            <div class='panel-body'>
            	<ul>
                	<li>请输入完整的标题和内容</li>
                	<li>标题必须要有实际意义</li>
                	<li>请不要发和本站无关的话题</li>
                	<li>禁止只发链接，没有实际内容</li>
                	<li>发帖会增加金钱和威望</li>
                	<li>如果被删帖，扣除双倍金钱和威望</li>
                	<li>详细积分规则，请点此查看</li>
            	</ul>	
            </div>
        </div>
    </div>
</div>
