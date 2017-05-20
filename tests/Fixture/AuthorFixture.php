<?php

class AuthorFixture extends TestFixture {

	public $name = 'Author';

	public $fields = array(
		'id' => ['type' => 'integer'],
		'first_name' => ['type' => 'string', 'null' => false],
		'last_name' => ['type' => 'string', 'null' => false],
		'created' => 'datetime',
		'updated' => 'datetime',
		'_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
	);

/**
 * records property
 *
 * @public array
 * @access public
 */
	public $records = array();

}
