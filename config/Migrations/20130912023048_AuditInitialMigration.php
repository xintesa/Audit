<?php

use Migrations\AbstractMigration;

class AuditInitialMigration extends AbstractMigration {

	public function up()
    {
        $this->table('audit_deltas', [
                'id' => false,
                'primary_key' => 'id',
            ])
            ->addColumn('id', 'uuid', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('audit_id', 'string', [
                'null' => false,
                'default' => null,
                'limit' => 36,
            ])
            ->addColumn('property_name', 'string', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('old_value', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('new_value', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addIndex([
                'audit_id',
            ], [
                'unique' => false,
                'name' => 'fk_audit_deltas',
            ])
            ->create();

        $this->table('audits', [
                'id' => false,
                'primary_key' => 'id',
            ])
            ->addColumn('id', 'uuid', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('session_id', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('event', 'string', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('model', 'string', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('entity_id', 'string', [
                'null' => false,
                'default' => null,
                'limit' => 36,
            ])
            ->addColumn('json_object', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('description', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('source_id', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('created', 'datetime', [
                'null' => true,
                'default' => null,
            ])
            ->addIndex([
                'session_id',
            ], [
                'unique' => false,
                'name' => 'fk_session_audits',
            ])
            ->create();

        $this->table('session_audits', [
                'id' => false,
                'primary_key' => 'id',
            ])
            ->addColumn('id', 'uuid', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('event', 'string', [
                'null' => false,
                'default' => null,
            ])
            ->addColumn('user_id', 'string', [
                'null' => false,
                'default' => null,
                'limit' => 36,
            ])
            ->addColumn('source_id', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('host', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
            ])
            ->addColumn('ua', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
            ])
            ->addColumn('referer', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
            ])
            ->addColumn('server_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
            ])
            ->addColumn('server_address', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
            ])
            ->addColumn('server_port', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
            ])
            ->addColumn('remote_addr', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
            ])
            ->addColumn('request_scheme', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('request_time', 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('description', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('session_id', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('created', 'datetime', [
                'null' => true,
                'default' => null,
            ])
            ->addIndex([
                'session_id',
            ], [
                'unique' => false,
                'name' => 'session_audits_session_id',
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('audit_deltas');
        $this->dropTable('audits');
        $this->dropTable('session_audits');
    }

}
