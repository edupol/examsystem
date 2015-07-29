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

class Pos extends Doctrine_Record {
  public function setTableDefinition() {
    $this->setTableName('pos');
    $this->hasColumn('pid', 'integer', 4, array(
        'type' => 'integer',
        'length' => 4,
        'unsigned' => false,
        'notnull' => true,
        'primary' => true, 
        'autoincrement' => true,
      )
    );
    $this->hasColumn('pname', 'string', 30, array(
        'type' => 'string',
        'length' => 30,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('pfull', 'string', 50, array(
        'type' => 'string',
        'length' => 50,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('p_eng', 'string', 50, array(
        'type' => 'string',
        'length' => 50,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('pospid', 'integer', 4, array(
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
        'local' => 'pid', 
        'foreign' => 'position'
      )
    );
  }
  
}

?>
