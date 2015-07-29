<?php
/**
 * "Visual Paradigm: DO NOT MODIFY THIS FILE!"
 * 
 * This is an automatic generated file. It will be regenerated every time 
 * you generate persistence class.
 * 
 * Modifying its content may cause the program not work, or your work may lost.
 */

/**
 * Licensee: DuKe TeAm
 * License Type: Purchased
 */

class Division extends Doctrine_Record {
  public function setTableDefinition() {
    $this->setTableName('division');
    $this->hasColumn('dvsid', 'integer', 4, array(
        'type' => 'integer',
        'length' => 4,
        'unsigned' => false,
        'notnull' => true,
        'primary' => true, 
        'autoincrement' => true,
      )
    );
    $this->hasColumn('dvsname', 'string', 20, array(
        'type' => 'string',
        'length' => 20,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('dvsfull', 'string', 50, array(
        'type' => 'string',
        'length' => 50,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('dvs_eng', 'string', 100, array(
        'type' => 'string',
        'length' => 100,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('divisiondvsid', 'integer', 4, array(
        'type' => 'integer',
        'length' => 4,
        'unsigned' => false,
        'notnull' => true,
      )
    );
  }
  
  public function setUp() {
    parent::setUp();
    $this->hasOne('Ethical_awards as ethical_awards', array(
        'local' => 'dvsid', 
        'foreign' => 'division'
      )
    );
  }
  
}

?>
