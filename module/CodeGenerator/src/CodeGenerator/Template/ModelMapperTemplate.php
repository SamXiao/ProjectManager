<?php
namespace CodeGenerator\Template;

use SamFramework\src\Model\TableAbstract;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductTable extends TableAbstract
{

    const TABLE_NAME = 'product';
    const MODEL_CLASS_NAME = 'Application\Model\Product\Product';

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProduct()
    {
        $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
    }

    public function saveProduct(Product $product)
    {
        $data = $product->toArray();
         $id = (int) $product->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getProduct($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
    }

    public function deleteProduct()
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }



}

