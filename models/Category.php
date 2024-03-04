<?php
class Category extends Connect
{
    /* TODO traer categorias por surcursal */
    public function getCategoryByBranchId($branch_id)
    {
        $conectar = parent::connection();

        $sql = '
            SELECT 
              c.id, 
              b.id as idBranch,
              c.name,
              c.is_active,
              c.created
            FROM
                categories c
            INNER JOIN branches as b ON c.branch_id = b.id
            WHERE
                b.id = ? AND c.is_active = 1
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$branch_id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO obtener categoria por ID */
    public function getCategoryById($id)
    {
        $conectar = parent::connection();

        $sql = '
            SELECT 
                *
            FROM
                categories
            WHERE
                is_active = 1 AND id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);  
    }
    /* TODO eliminar categoria por ID */
    public function deleteCategoryById($id)
    {
        $conectar = parent::connection();

        $sql = '
            UPDATE
                categories
            SET
                is_active = 0
            WHERE
                id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);   
    }
    /* TODO insertar categoria */
    public function insertCategory($branch_id, $name)
    {
        $conectar = parent::connection();

        $sql = '
            INSERT INTO
                categories (name, branch_id, created)
            VALUES
                (?, ?, now())
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$branch_id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);   
    }
    /* TODO actualizar categoria por ID */
    public function updateCategoryById($id, $branch_id, $name)
    {
        $conectar = parent::connection();

        $sql = '
            UPDATE
                categories
            SET
                name = ?,
                branch_id = ?
            WHERE
                id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$branch_id);
        $query->bindValue(3,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);     
    }
}
?>