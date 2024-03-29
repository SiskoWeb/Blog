<?php



require 'BaseModel.php';



class UserModel extends BaseModel
{

    private $id;
    private $username;
    private $password;
    private $role;
    private $image;




    // Setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Setter for id
    public function setRole($role)
    {
        $this->role = $role;
    }

    // Setter for username
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }


    // Setter for password
    public function setPassword($password)
    {
        $this->password = $password;
    }



    // return all users order by desc
    public static function latest()
    {
        return static::database()->query('SELECT * FROM users order by user_id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // get user id by  id
    public static function find($userID)
    {
        return static::database()->query("SELECT * FROM users WHERE user_id =  $userID")
            ->fetch(PDO::FETCH_ASSOC);
    }



    public static function findWithPosts($userID)
    {
        return static::database()->query("SELECT
        posts.*,
        categories.category_name AS category,
        GROUP_CONCAT(tags.tag_name) AS tags,
         users.username,
         users.image AS image_author
    FROM
        posts
    LEFT JOIN
        categories ON categories.category_id = posts.category_id
    LEFT JOIN
        post_tags ON post_tags.post_id = posts.post_id
    LEFT JOIN
        tags ON tags.tag_id = post_tags.tag_id
        LEFT JOIN 
     users ON users.user_id = posts.user_id    
        WHERE posts.user_id = $userID
        
    ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    //update user
    public function update()
    {
        // pre sql query
        $sql = "UPDATE users SET ";
        $params = [];

        // if equal null that means won't update that column
        if ($this->username !== null) {
            $sql .= "username=?, ";
            $params[] = $this->username;
        }

        if ($this->password !== null) {
            $sql .= "password=?, ";
            $params[] = $this->password;
        }

        if ($this->role !== null) {
            $sql .= "role=?, ";
            $params[] = $this->role;
        }


        if ($this->image !== null) {
            $sql .= "image=?, ";
            $params[] = $this->image;
        }

        // Remove the trailing comma and space from the string
        $sql = rtrim($sql, ", ");

        $sql .= " WHERE user_id=? ";
        $params[] = $this->id;

        $sqlState = static::database()->prepare($sql);

        return $sqlState->execute($params);
    }






    // block user
    public static function  blockUser($userID)
    {

        $user = self::find($userID);

        if ($user['isActive'] == 1) {
            //archived all posts belong user admin wnats block 
            $archivPosts = self::database()->prepare("UPDATE posts SET archived = 0 WHERE user_id = ?");
            $archivPosts->execute([$userID]);

            //if archived his post  successfully  block him
            if ($archivPosts) {
                $sqlState = self::database()->prepare("UPDATE users SET isActive = 0 WHERE user_id = ?");
                return $sqlState->execute([$userID]);
            }
        } else {
            //archived all posts belong user admin wnats block 
            $archivPosts = self::database()->prepare("UPDATE posts SET archived = 1 WHERE user_id = ?");
            $archivPosts->execute([$userID]);

            //if archived his post  successfully  block him
            if ($archivPosts) {
                $sqlState = self::database()->prepare("UPDATE users SET isActive = 1 WHERE user_id = ?");
                return $sqlState->execute([$userID]);
            }
        }
    }


    // unblock user
    public static function  unBlockUser($userID)
    {

        //Unarchived all posts belong user admin wnats block 
        $archivPosts = self::database()->prepare("UPDATE posts SET archived = 1 WHERE user_id = ?");
        $archivPosts->execute([$userID]);

        //if unArchive his post  successfully  block him
        if ($archivPosts) {
            $sqlState = self::database()->prepare("UPDATE users SET isActive = 1 WHERE user_id = ?");
            return $sqlState->execute([$userID]);
        }
    }

    // remove user
    public static function  destroy($userID)
    {

        //remove all posts belong user admin wnats block 
        $archivPosts = self::database()->prepare("DELETE FROM posts WHERE user_id = ?");
        $archivPosts->execute([$userID]);

        //if removed his post  successfully  remove him
        if ($archivPosts) {
            $sqlState = self::database()->prepare("DELETE FROM users  WHERE user_id = ?");
            return $sqlState->execute([$userID]);
        }
    }
}
