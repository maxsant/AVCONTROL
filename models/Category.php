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
    public function getCategoryById()
    {
        
    }
    /* TODO eliminar categoria por ID */
    public function deleteCategoryById()
    {
        
    }
    /* TODO insertar categoria */
    public function insertCategory()
    {
        
    }
    /* TODO actualizar categoria por ID */
    public function updateCategoryById()
    {
        
    }
}
?>