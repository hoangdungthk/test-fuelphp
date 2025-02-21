<?php

class Model_User extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'username',
        'name',
        'email',
        'password',
        'is_admin',
        'group',
        'last_login',
        'login_hash',
        'profile_fields',
        'created_at',
        'updated_at',
    );

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false,
		),
        'Orm\\Observer_Validation' => [
            'events' => ['before_save']
        ],
    );

	protected static $_table_name = 'users';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

    protected static $_rules = [
        'name'     => ['required', 'max_length' => [50]],
        'email'    => ['required', 'valid_email', 'max_length' => [50]],
        'password' => ['required', 'min_length' => [8]],
    ];
}
