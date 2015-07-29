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

class Rank extends Doctrine_Record {
  public function setTableDefinition() {
    $this->setTableName('rank');
    $this->hasColumn('rid', 'integer', 4, array(
        'type' => 'integer',
        'length' => 4,
        'unsigned' => false,
        'notnull' => true,
        'primary' => true, 
        'autoincrement' => true,
      )
    );
    $this->hasColumn('rname', 'string', 25, array(
        'type' => 'string',
        'length' => 25,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('rfull', 'string', 50, array(
        'type' => 'string',
        'length' => 50,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('r_eng', 'string', 50, array(
        'type' => 'string',
        'length' => 50,
        'fixed' => false,
        'notnull' => true,
      )
    );
  }
  
  public function setUp() {
    parent::setUp();
    $this->hasOne('Ethical_awards as ethical_awards', array(
        'local' => 'rid', 
        'foreign' => 'rank'
      )
    );
  }
  
}

?>
