<?php
namespace modules\user\models;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\Html;

class UserInfo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_info}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex', 'qq','score','signin_time'], 'integer'],
            [['location','birthday','image','signature'], 'string', 'max' => 255]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('user', 'User Id'),
            'signin_time' => Yii::t('user','Signin Time'),
            'image' => Yii::t('user', 'Image'),
            'score' => Yii::t('user', 'Score'),
            'sex' => Yii::t('user', 'Sex'),
            'signature' => Yii::t('user', 'Signature'),
            'qq' => Yii::t('user', 'Qq'),
            'location' => Yii::t('user', 'Location'),
            'birthday' => Yii::t('user','Birthday'),
        ];
    }
    
    public function getSex($sex) {
        switch ($sex){
            case '0':
                return '男';
            break;
            case '1':
                return '女';
            break;
            case '2':
                return '保密';
            default:
                return NUll;
            break;
        }
    }
    
    public function saveImage($model)
    {
        //getInstance()实力化对象
        $image = UploadedFile::getInstance($model, 'image');
        //当用户未选择文件就点击更新按钮的时候，没有获取到文件，然后NUll
        if($image === NULL){
            return true;
        }
        $extensionName = $image->getExtension();
        if(!in_array($extensionName, ['jpg','png','jpeg'])){
            return false;
        }
        //随机生成的文件名称
        $randName = time().'.'.$extensionName;
        //按年份生成的路径
        $rootPath = 'images/'.date('Y',time()).'/';
        if (!file_exists($rootPath)) {
            mkdir($rootPath);
        }
        $image->saveAs($rootPath . $randName);
        //如果不是默认的头像，用户更新头像的时候删除之前更新过的头像，避免默认头像被删除
        if($model->image !== \Yii::$app->params['defaultUserImage']){
            unlink($model->image);
        }
        //更新用户的头像
        $model->image = $rootPath . $randName;
        return $model->save();
    }
    
    public static function showImage($model,$option=['width'=>40,'height'=>40]) {
        return Html::img('@web/'.$model->image,['width'=> $option['width'],'height'=>$option['height']]);
    }
}
