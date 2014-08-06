<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.06.14
 * Time: 12:13
 */
class User extends CUser {

    const YES = 'Yes';
    const NO = 'No';


    public function checkPassword($password) {
        return $this->password == $this->_encrypt($password);
    }

    public function setPassword($password) {
        $this->password = $this->_encrypt($password);
    }

    protected function _encrypt($password) {
        if ($this->isNewRecord) {
            $this->save(false);
        }
        return md5($this->id.$password.Yii::app()->params['salt']);
    }


    public function getAlbumProvider($progress = null) {
        $criteria = new CDbCriteria();
        $criteria->with = array('cartHasGood.cart');
        if ($progress=='Filling') {
            $criteria->addCondition('cartHasGood.cart_id is null');
        } else {
            $criteria->compare('cart.progress',$progress);
        }
        $criteria->compare('t.user_id',$this->id);
        return new CActiveDataProvider('Album',array(
            'criteria' => $criteria
        ));
    }
}