<?php

namespace Application\Model\Product;

class CategoryTable extends \SamFramework\src\Model\TableAbstract
{

    const TABLE_NAME = 'category';

    const MODEL_CLASS_NAME = 'Application\\Model\\Product\\Category';

    public function fetchAll()
    {
        $resultSet = $this->getTableGateway()->select();
                return $resultSet;
    }

    public function getCategory()
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

    public function deleteCategory($id)
    {
        $this->tableGateway->delete(array(
                    'id' => (int) $id
                ));
    }

    public function saveCategory(Category $category)
    {
        $tableGateway = $this->getTableGateway();
                $data = $category->toArray();
                $id = (int) $category->id;
                if ($id == 0) {
                    $tableGateway->insert($data);
                } else {
                    if ($this->getCategory($id)) {
                        $tableGateway->update($data, array(
                            'id' => $id
                        ));
                    }
                }
    }


}

