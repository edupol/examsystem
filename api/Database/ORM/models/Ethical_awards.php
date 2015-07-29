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

class Ethical_awards extends Doctrine_Record {
  public function setTableDefinition() {
    $this->setTableName('ethical_awards');
    $this->hasColumn('ethical_id as eid', 'integer', 11, array(
        'type' => 'integer',
        'length' => 11,
        'unsigned' => false,
        'notnull' => true,
        'primary' => true, 
        'autoincrement' => true,
      )
    );
    $this->hasColumn('rank', 'integer', 4, array(
        'type' => 'integer',
        'length' => 4,
        'unsigned' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('first_name as firstName', 'string', 255, array(
        'type' => 'string',
        'length' => 255,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('last_name as lastName', 'string', 255, array(
        'type' => 'string',
        'length' => 255,
        'fixed' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('position', 'integer', 3, array(
        'type' => 'integer',
        'length' => 3,
        'unsigned' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('division', 'integer', 2, array(
        'type' => 'integer',
        'length' => 2,
        'unsigned' => false,
        'notnull' => true,
      )
    );
    $this->hasColumn('year', 'integer', 5, array(
        'type' => 'integer',
        'length' => 5,
        'unsigned' => false,
        'notnull' => true,
      )
    );
  }
  
  public function setUp() {
    parent::setUp();
    $this->hasOne('Rank as rank', array(
        'local' => 'rank', 
        'foreign' => 'rid'
      )
    );
    $this->hasOne('Pos as position', array(
        'local' => 'position', 
        'foreign' => 'pid'
      )
    );
    $this->hasOne('Division as division', array(
        'local' => 'division', 
        'foreign' => 'dvsid'
      )
    );
  }
  
}

?>
