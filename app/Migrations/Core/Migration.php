<?php
/**
 * @uses base migration hooking phinx with Laravel Migration
 * @return schema builder library
 */
    namespace DealsWithGold\Migrations\Core;

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Phinx\Migration\AbstractMigration;

    class Migration extends AbstractMigration{


        protected $schema;

        public function init(){

            $this->schema = (new Capsule)->schema();
        }

    }

?>