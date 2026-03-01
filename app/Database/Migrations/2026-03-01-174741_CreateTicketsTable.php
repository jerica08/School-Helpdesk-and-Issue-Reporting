<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ticket_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'department_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pending', 'Assigned', 'In Progress', 'Resolved', 'Closed'],
                'default'    => 'Pending',
            ],
            'assigned_to' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // nullable if not yet assigned
            ],
            'created_at DATETIME default current_timestamp',
            'updated_at DATETIME default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);

        // Foreign Keys
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'departments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'CASCADE', 'SET NULL');

        $this->forge->createTable('tickets');
    }

    public function down()
    {
        $this->forge->dropTable('tickets');
    }
}