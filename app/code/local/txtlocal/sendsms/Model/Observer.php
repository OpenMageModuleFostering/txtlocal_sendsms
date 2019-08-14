<?php
class txtlocal_sendsms_Model_Observer
{
	public function sendSmsOnOrderCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrdersEnabled()) {
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			if ($order instanceof Mage_Sales_Model_Order) {
				$host = "http://api.txtlocal.com/send/";
				$username = $this->getHelper()->getUsername();
				$password = $this->getHelper()->getPassword();
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsfrom = $this->getHelper()->getSender();
				$smsmsg = $this->getHelper()->getMessage($order);
				$data  = '?username=' . urlencode($username);
				$data .= '&hash=' . urlencode($password);
				$data .= '&numbers=' . urlencode($smsto);
				$data .= '&sender=' . urlencode($smsfrom);
				$data .= '&message=' . urlencode($smsmsg);
				$url = $host.$data;
				$sendSms = $this->getHelper()->sendSms($url);
                if($this->getHelper()->isGroupEnabled()){
                    $host = "http://api.txtlocal.com/create_contacts_bulk/";
                $newData  = '?username=' . urlencode($username);
                $newData .= '&hash=' . urlencode($password);
                $newData .= '&group_id=5';
                $names = $this->getHelper()->getNameForOrder($order);
                $firstName = $names['firstname'];
                $lastName = $names['lastname'];
                $contacts = urlencode(json_encode(array(array('number' => $smsto, 'first_name' => $firstName,  'last_name' => $lastName))));
                $newData .= '&contacts=' . $contacts;
                $url = $host.$newData;
                $this->getHelper()->sendSms($url);
                }
				try {
					Mage::getModel('sendsms/sendsms')
						->setOrderId($order->getIncrementId())
						->setFrom($smsfrom)
						->setTo($smsto)
						->setSmsMessage($smsmsg)
						->setStatus($sendSms['status'])
						->setStatusMessage($sendSms['status_message'])
						->setCreatedTime(now())
						->save();
				}
                catch (Exception $e) {}
				
				if($this->getHelper()->isOrdersNotify() and $this->getHelper()->getAdminTelephone()) {
					$smsto = $this->getHelper()->getAdminTelephone();
					$smsmsg = Mage::helper('sendsms')->__('A new order has been placed: %s',$order->getIncrementId());
					$data  = '?username=' . urlencode($username);
					$data .= '&hash=' . urlencode($password);
					$data .= '&numbers=' . urlencode($smsto);
					$data .= '&sender=' . urlencode($smsfrom);
					$data .= '&message=' . urlencode($smsmsg);
					$url = $host.$data;
					$sendSms = $this->getHelper()->sendSms($url);
					try {
						Mage::getModel('sendsms/sendsms')
							->setOrderId($order->getIncrementId())
							->setFrom($smsfrom)
							->setTo($smsto)
							->setSmsMessage($smsmsg)
							->setStatus($sendSms['status'])
							->setStatusMessage($sendSms['status_message'])
							->setCreatedTime(now())
							->save();
					}
					catch (Exception $e) {}
				}
			}
		}
	}
	
	public function sendSmsOnOrderHold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderHoldEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_HOLDED) {
                    $host = "http://api.txtlocal.com/send/";
					$username = $this->getHelper()->getUsername();
					$password = $this->getHelper()->getPassword();
					$smsto = $this->getHelper()->getTelephoneFromOrder($order);
					$smsfrom = $this->getHelper()->getSenderForOrderHold();
					$smsmsg = $this->getHelper()->getMessageForOrderHold($order);
					$data  = '?username=' . urlencode($username);
					$data .= '&hash=' . urlencode($password);
					$data .= '&numbers=' . urlencode($smsto);
					$data .= '&sender=' . urlencode($smsfrom);
					$data .= '&message=' . urlencode($smsmsg);
					$url = $host.$data;
					$sendSms = $this->getHelper()->sendSms($url);
					try {
						Mage::getModel('sendsms/sendsms')
							->setOrderId($order->getIncrementId())
							->setFrom($smsfrom)
							->setTo($smsto)
							->setSmsMessage($smsmsg)
							->setStatus($sendSms['status'])
							->setStatusMessage($sendSms['status_message'])
							->setCreatedTime(now())
							->save();
					}
					catch (Exception $e) {}
				}
			}
		}
	}
	
	public function sendSmsOnOrderUnhold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderUnholdEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getOrigData('state') === Mage_Sales_Model_Order::STATE_HOLDED) {
                    $host = "http://api.txtlocal.com/send/";
                    $username = $this->getHelper()->getUsername();
                    $password = $this->getHelper()->getPassword();
                    $smsto = $this->getHelper()->getTelephoneFromOrder($order);
                    $smsfrom = $this->getHelper()->getSenderForOrderHold();
                    $smsmsg = $this->getHelper()->getMessageForOrderHold($order);
                    $data  = '?username=' . urlencode($username);
                    $data .= '&hash=' . urlencode($password);
                    $data .= '&numbers=' . urlencode($smsto);
                    $data .= '&sender=' . urlencode($smsfrom);
                    $data .= '&message=' . urlencode($smsmsg);
                    $url = $host.$data;
                    $sendSms = $this->getHelper()->sendSms($url);
					try {
						Mage::getModel('sendsms/sendsms')
							->setOrderId($order->getIncrementId())
							->setFrom($smsfrom)
							->setTo($smsto)
							->setSmsMessage($smsmsg)
							->setStatus($sendSms['status'])
							->setStatusMessage($sendSms['status_message'])
							->setCreatedTime(now())
							->save();
					}
					catch (Exception $e) {}
				}
			}
		}
	}
	
	public function sendSmsOnOrderCanceled(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderCanceledEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_CANCELED) {
                    $host = "http://api.txtlocal.com/send/";
                    $username = $this->getHelper()->getUsername();
                    $password = $this->getHelper()->getPassword();
                    $smsto = $this->getHelper()->getTelephoneFromOrder($order);
                    $smsfrom = $this->getHelper()->getSenderForOrderHold();
                    $smsmsg = $this->getHelper()->getMessageForOrderHold($order);
                    $data  = '?username=' . urlencode($username);
                    $data .= '&hash=' . urlencode($password);
                    $data .= '&numbers=' . urlencode($smsto);
                    $data .= '&sender=' . urlencode($smsfrom);
                    $data .= '&message=' . urlencode($smsmsg);
                    $url = $host.$data;
                    $sendSms = $this->getHelper()->sendSms($url);
					try {
						Mage::getModel('sendsms/sendsms')
							->setOrderId($order->getIncrementId())
							->setFrom($smsfrom)
							->setTo($smsto)
							->setSmsMessage($smsmsg)
							->setStatus($sendSms['status'])
							->setStatusMessage($sendSms['status_message'])
							->setCreatedTime(now())
							->save();
					}
					catch (Exception $e) {}
				}
			}
		}
	}
	
	public function sendSmsOnShipmentCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isShipmentsEnabled()) {
			$shipment = $observer->getEvent()->getShipment();
			$order = $shipment->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
                $host = "http://api.txtlocal.com/send/";
                $username = $this->getHelper()->getUsername();
                $password = $this->getHelper()->getPassword();
                $smsto = $this->getHelper()->getTelephoneFromOrder($order);
                $smsfrom = $this->getHelper()->getSenderForOrderHold();
                $smsmsg = $this->getHelper()->getMessageForOrderHold($order);
                $data  = '?username=' . urlencode($username);
                $data .= '&hash=' . urlencode($password);
                $data .= '&numbers=' . urlencode($smsto);
                $data .= '&sender=' . urlencode($smsfrom);
                $data .= '&message=' . urlencode($smsmsg);
                $url = $host.$data;
                $sendSms = $this->getHelper()->sendSms($url);
				try {
					Mage::getModel('sendsms/sendsms')
						->setOrderId($order->getIncrementId())
						->setFrom($smsfrom)
						->setTo($smsto)
						->setSmsMessage($smsmsg)
						->setStatus($sendSms['status'])
						->setStatusMessage($sendSms['status_message'])
						->setCreatedTime(now())
						->save();
				}
                catch (Exception $e) {}
			}
		}
	}

	public function getHelper()
    {
        return Mage::helper('sendsms/Data');
    }
}