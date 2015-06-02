<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;
use app\models\Roles;
use app\models\UsersRoles;

class m150601_040006_create_user_role_default extends Migration
{
    public function up()
    {
        $user = User::find();
        
        if ($user->count() == 0) {

            //create account to test
            $user = new User();
            $user->username = 'admin';
            $user->name = 'Administrator';
            $user->password = '123456';
            $user->password_repeat = '123456';
            $user->email = 'admin@targetmediamusic.com';
            $user->auth_key = \Yii::$app->security->generateRandomKey();
            $user->created_at = time();
            $user->updated_at = time();

            $user->save();

            $roleMaster = Roles::findOne(['is_master' => 1]);
            if (!$roleMaster) {
                $roleMaster = new Roles();
                $roleMaster->name = 'master';
                $roleMaster->level = 20;
                $roleMaster->is_master = 1;
                $roleMaster->is_default = 0;

                $roleMaster->save();
            }

            $roleUser = UsersRoles::findOne(['user_id' => $user->id, 'role_id' => $roleMaster->id]);
            if (!$roleUser) {
                $roleUser = new UsersRoles();
                $roleUser->user_id = $user->id;
                $roleUser->role_id = $roleMaster->id;

                $roleUser->save();
            }
        }
    }

    public function down()
    {
        echo "m150601_040006_create_user_role_default cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
