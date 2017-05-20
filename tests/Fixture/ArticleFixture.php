<?php

class ArticleFixture extends TestFixture {

	public $name = 'Article';

	public $fields = array(
		'id' => ['type' => 'integer'],
		'user_id' => ['type' => 'integer', 'null' => false],
		'author_id' => ['type' => 'integer', 'null' => false],
		'title' => ['type' => 'string', 'null' => false],
		'body' => 'text',
		'published' => ['type' => 'string', 'length' => 1, 'default' => 'N'],
		'ignored_field' => ['type' => 'integer', 'length' => 1, 'default' => 0],
		'created' => 'datetime',
		'updated' => 'datetime',
		'_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array(
		array('user_id' => 1, 'author_id' => 1, 'title' => 'First Article', 'body' => 'First Article Body', 'published' => 'Y', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31'),
		array('user_id' => 3, 'author_id' => 3, 'title' => 'Second Article', 'body' => 'Second Article Body', 'published' => 'Y', 'created' => '2007-03-18 10:41:23', 'updated' => '2007-03-18 10:43:31'),
		array('user_id' => 1, 'author_id' => 1, 'title' => 'Third Article', 'body' => 'Third Article Body', 'published' => 'Y', 'created' => '2007-03-18 10:43:23', 'updated' => '2007-03-18 10:45:31')
	);

}
