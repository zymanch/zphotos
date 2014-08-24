<?php

class Robokassa extends CApplicationComponent {

    const SERVER_OUR = 'our';
    const SERVER_TEST = 'test';
    const SERVER_REAL = 'real';

    public $sMerchantLogin;
    public $sMerchantPass1;
    public $sMerchantPass2;
    public $sCulture = 'ru';

    public $resultMethod = 'post';
    public $sIncCurrLabel = 'QiwiR';
    public $orderModel;
    public $priceField;
    public $server = self::SERVER_REAL;

    public $params;

    protected $_order;

    public function pay($nOutSum, $nInvId, $sInvDesc, $sUserEmail)
    {
        $sign = $this->getPaySign($nOutSum, $nInvId, $sUserEmail);

        switch ($this->server) {
            case self::SERVER_OUR:
                $url = '/robokassa/index?';
                break;
            case self::SERVER_TEST:
                $url = 'http://test.robokassa.ru/Index.aspx?';
                break;
            case self::SERVER_REAL:
                $url = 'https://merchant.roboxchange.com/Index.aspx?';
                break;
        }

        $url .= "MrchLogin={$this->sMerchantLogin}&";
        $url .= "OutSum={$nOutSum}&";
        $url .= "InvId={$nInvId}&";
        $url .= "Desc={$sInvDesc}&";
        $url .= "SignatureValue={$sign}&";
        $url .= "IncCurrLabel={$this->sIncCurrLabel}&";
        $url .= "Email={$sUserEmail}&";
        $url .= "Culture={$this->sCulture}";

        Yii::app()->controller->redirect($url);
    }

    private function getPaySign($nOutSum, $nInvId)
    {
        $keys = array(
            $this->sMerchantLogin,
            $nOutSum,
            $nInvId,
            $this->sMerchantPass1,
        );
        return md5(implode(':', $keys));
    }

    public function result()
    {
        $var = $_GET + $_POST;
        extract($var);
        $event = new CEvent($this);

        $valid = true;

        if ($valid && !isset($OutSum, $InvId, $SignatureValue)) {
            $this->params = array('reason' => 'Dont set need value');
            $valid = false;
        }
        if ($valid && !$this->checkResultSignature($OutSum, $InvId, $SignatureValue)) {
            $this->params = array('reason' => 'Signature fail');
            $valid = false;
        }
        if ($valid && !$this->isOrderExists($InvId)) {
            $this->params = array('reason' => 'Order not exists');
            $valid = false;
        }

        if ($valid && $this->_order->{$this->priceField} != $OutSum) {
            $this->params = array('reason' => 'Order price error');
            $valid = false;
        }

        if ($valid) {
            if ($this->hasEventHandler('onSuccess')) {
                $this->params = array('order' => $this->_order);
                $this->onSuccess($event);
            }
        } else {
            if ($this->hasEventHandler('onFail')) {
                return $this->onFail($event);
            }
        }

        echo "OK{$InvId}\n";
    }

    private function isOrderExists($id)
    {
        $this->_order = CActiveRecord::model($this->orderModel)->findByPk((int)$id);
        if ($this->_order)
            return true;

        return false;
    }

    private function checkResultSignature($OutSum, $InvId, $SignatureValue) {

        $sign = $this->getResultSignature($OutSum, $InvId);
        if ($SignatureValue == $sign)
            return true;

        return false;
    }

    public function getResultSignature($OutSum, $InvId) {
        $keys = array(
            $OutSum,
            $InvId,
            $this->sMerchantPass2,
        );

        return strtoupper(md5(implode(':', $keys)));
    }

    public function onSuccess($event)
    {
        $this->raiseEvent('onSuccess', $event);
    }

    public function onFail($event)
    {
        $this->raiseEvent('onFail', $event);
    }
}