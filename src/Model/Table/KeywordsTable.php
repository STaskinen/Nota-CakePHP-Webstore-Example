<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Keywords Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\Keyword get($primaryKey, $options = [])
 * @method \App\Model\Entity\Keyword newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Keyword[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Keyword|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword findOrCreate($search, callable $callback = null, $options = [])
 */
class KeywordsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('keywords');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Products', [
            'foreignKey' => 'keyword_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'products_keywords'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 24)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        return $validator;
    }
}
