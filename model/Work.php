<?php

class Work extends Model
{
    /**
     * set table data name
     * @var string
     */
    private $tableName = 'works';

    /**
     * array status
     */
    public const ARR_STATUS = [
        'Planning',
        'Doing',
        'Complete'
    ];

    /**
     * get list works
     * @param array $data
     * @return array 
     */
    public function listWork($data)
    {
        $conditions = array();
        if (!empty($data['name'])) {
            $conditions[] = "name LIKE '%" . $data['name'] . "%'";
        }

        if (!empty($data['starting_date'])) {
            $conditions[] = "starting_date >= " . $data['starting_date'];
        }

        if (!empty($data['ending_date'])) {
            $conditions[] = "ending_date <= " . $data['ending_date'];
        }

        if (!empty($data['status'])) {
            $conditions[] = "status = '" . $data['status'] . "'";
        }

        $query = "SELECT id,name, DATE_FORMAT(starting_date,'%Y-%m-%d') AS starting_date,
        DATE_FORMAT(ending_date,'%Y-%m-%d') AS ending_date,status FROM " . $this->tableName;
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $result =  $this->query($query);
        return $result;
    }

    /**
     * add work
     * @param array $data
     * @return bool 
     */
    public function addWork($data)
    {
        $name = $data['name'];
        $startingDate = $data['starting_date'];
        $endingDate = $data['ending_date'];
        $status = $data['status'];
        $query = "INSERT INTO " . $this->tableName . " (
            name,
            starting_date,
            ending_date,
            status
            ) values (
            '$name',
            '$startingDate',
            '$endingDate',
            '$status'
            )";
        
        $this->query($query);
    }

    /**
     * delete work
     * @param integer $id
     * @return 
     */
    public function deleteWork($id)
    {
        $query = "DELETE from " . $this->tableName . " WHERE id =" . $id;
        $this->query($query);
    }

    /**
     * show work
     * @param integer $id 
     * @return array
     */
    public function findWork($id)
    {
        $query = "SELECT id,name, DATE_FORMAT(starting_date,'%Y-%m-%d') AS starting_date,
            DATE_FORMAT(ending_date,'%Y-%m-%d') AS ending_date,status
            FROM " . $this->tableName . " WHERE id =" . $id . " LIMIT 1";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
      
        return $result[0];
    }

    /**
     * update work
     * @param array $data 
     * @return array
     */
    public function updateWork($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $startingDate = $data['starting_date'];
        $endingDate = $data['ending_date'];
        $status = $data['status'];

        $query = "UPDATE " . $this->tableName . " SET 
        name = '$name',
        starting_date = '$startingDate',
        ending_date = '$endingDate',
        status = '$status'
        WHERE id = $id";

        $this->query($query);
    }
}
