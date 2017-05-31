#
# Table structure for table 'tx_imageshop_domain_model_collection'
#
CREATE TABLE `tx_imageshop_domain_model_collection` (
  uid              INT(11) UNSIGNED                NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  fe_group         VARCHAR(100) DEFAULT '0'        NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l18n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l18n_diffsource  MEDIUMBLOB                      NOT NULL,

  name             VARCHAR(255)                    NOT NULL,
  location         VARCHAR(255),
  description      VARCHAR(255),
  products         INT(11),
  previewimage     INT(11),

  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_imageshop_domain_model_product'
#
CREATE TABLE `tx_imageshop_domain_model_product` (
  uid              INT(11) UNSIGNED                NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  fe_group         VARCHAR(100) DEFAULT '0'        NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l18n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l18n_diffsource  MEDIUMBLOB                      NOT NULL,

  price            DOUBLE(11, 2)                   NOT NULL,
  media            INT(11),
  name             VARCHAR(255)                    NOT NULL,
  collection       INT(11),

  PRIMARY KEY (uid),
  KEY parent (pid)
);