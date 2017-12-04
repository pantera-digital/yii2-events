<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m171204_105920_create_system_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('{{%system_event}}', true) === null) {
            $this->createTable('{{%system_event}}', [
                'id' => $this->primaryKey(),
                'model' => $this->string()->notNull(),
                'model_id' => $this->integer()->notNull(),
                'event' => $this->string()->notNull(),
                'user_id' => $this->integer()->null(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ]);

            $this->createIndex('idx-model', '{{%system_event}}', 'model');
            $this->createIndex('idx-model-model_id', '{{%system_event}}', [
                'model',
                'model_id',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_event}}');
    }
}
