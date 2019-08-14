<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('sendsms')};
CREATE TABLE {$this->getTable('sendsms')} (
  `sendsms_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL DEFAULT '',
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `sms_message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `status_message` varchar(255) NOT NULL DEFAULT '',
  `created_time` datetime DEFAULT NULL,
  PRIMARY KEY (`sendsms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 