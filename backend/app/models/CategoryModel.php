<?php

require 'BaseModel.php';

class CategoryModel extends BaseModel
{
    private $id;
    private $name;
    private $image;

    // Setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Setter for name
    public function setName($name)
    {
        $this->name = $name;
    }

    // Setter for description
    public function setImage($image)
    {
        $this->image = $image;
    }

    // Get all categories ordered by desc
    public static function latest()
    {
        return static::database()->query('SELECT * FROM categories ORDER BY category_id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get category by id
    public static function find($categoryId)
    {
        return static::database()->query("SELECT * FROM categories WHERE category_id = $categoryId")
            ->fetch(PDO::FETCH_ASSOC);
    }


    // get category by name
    // id passed only in update cases
    public static function findByName($categoryName, $id = null)
    {

        $query = "SELECT * FROM categories WHERE category_name = :categoryName";


        if ($id !== null) {
            $query .= " AND category_id != :id";
        }

        $stmt = static::database()->prepare($query);
        $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);

        if ($id !== null) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    // Create a new category
    public function create()
    {
        $sqlState = static::database()->prepare("INSERT INTO categories (category_name, image) VALUES (?, ?)");
        return $sqlState->execute([$this->name, $this->image]);
    }

    // Update category
    public function update()
    {
        // Pre SQL query
        $sql = "UPDATE categories SET ";
        $params = [];

        // If equal to null, that means won't update that column
        if ($this->name !== null) {
            $sql .= "category_name=?, ";
            $params[] = $this->name;
        }

        if ($this->image !== null) {
            $sql .= "image=?, ";
            $params[] = $this->image;
        }


        $sql = rtrim($sql, ", ");


        $sql .= " WHERE category_id=? ";
        $params[] = $this->id;

        $sqlState = static::database()->prepare($sql);

        return $sqlState->execute($params);
    }


    // Remove category
    public static function destroy($categoryId)
    {

        //remove all posts belong this Category
        $archivPosts = self::database()->prepare("DELETE FROM posts WHERE category_id = ?");
        $archivPosts->execute([$categoryId]);

        // Then, delete the category
        $sqlState = static::database()->prepare("DELETE FROM categories WHERE category_id = ?");
        return $sqlState->execute([$categoryId]);
    }
}
