<?php

namespace Application\Model\Product;

use Zend\Db\TableGateway\AbstractTableGateway;
class ProductTable extends AbstractTableGateway
{
    public function __construct()
    {
        $this->table = 'my_table';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
    }

    const TABLE_NAME = 'product';

    const MODEL_CLASS_NAME = 'Application\\Model\\Product\\Product';

    public function fetchAll()
    {
        $resultSet = $this->getTableGateway()->select();
                return $resultSet;
    }

    public function getProduct()
    {
        $tableGateway = $this->getTableGateway();
                $id = (int) $id;
                $rowset = $tableGateway->select(array(
                    'id' => $id
                ));
                $row = $rowset->current();
                if (! $row) {
                    throw new \Exception("Could not find row $id");
                }
                return $row;
    }

    public function deleteProduct($id)
    {
        $this->tableGateway->delete(array(
                    'id' => (int) $id
                ));
    }

    public function saveProduct(Product $product)
    {
        $tableGateway = $this->getTableGateway();
                $data = $product->toArray();
                $id = (int) $product->id;
                if ($id == 0) {
                    $tableGateway->insert($data);
                } else {
                    if ($this->getProduct($id)) {
                        $tableGateway->update($data, array(
                            'id' => $id
                        ));
                    }
                }
    }


}

