<?php

require 'BaseModel.php';


class PostModel extends BaseModel
{
    private $post_id;
    private $user_id;
    private $category_id;
    private $title;
    private $content;
    private $image;
    private $views;
    private $archived;

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setViews($views)
    {
        $this->views = $views;
    }



    public function setArchived($archived)
    {
        $this->archived = $archived;
    }


    public static function latest()
    {


        return static::database()->query('SELECT
        posts.*,
         categories.category_name AS category,
         GROUP_CONCAT(tags.tag_name) AS tags
     FROM
         posts
     LEFT JOIN
         categories ON categories.category_id = posts.category_id
     LEFT JOIN
         post_tags ON post_tags.post_id = posts.post_id
     LEFT JOIN
         tags ON tags.tag_id = post_tags.tag_id
     GROUP BY
         posts.date_created DESC;
      ')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($post_id)
    {
        return static::database()->query("SELECT * FROM posts WHERE post_id =  $post_id")
            ->fetch(PDO::FETCH_ASSOC);
    }



    public function create($tags)
    {
        //1 insert post
        $sqlState = static::database()->prepare("INSERT INTO posts (user_id, category_id, title, content, image) VALUES (?, ?, ?, ?, ?)");
        $sqlState->execute([$this->user_id, $this->category_id, $this->title, $this->content, $this->image]);

        //2  Get the last inserted post_id
        $postId = static::database()->lastInsertId();

        //3 add tags to tags_post for post we created
        if ($postId) {
            return  $this->handleTags($postId, $tags);
        }
    }



    public function update($tags)
    {
        $sql = "UPDATE posts SET ";
        $params = [];

        // Handle each field individually
        if ($this->user_id !== null) {
            $sql .= "user_id=?, ";
            $params[] = $this->user_id;
        }

        if ($this->category_id !== null) {
            $sql .= "category_id=?, ";
            $params[] = $this->category_id;
        }

        if ($this->title !== null) {
            $sql .= "title=?, ";
            $params[] = $this->title;
        }

        if ($this->content !== null) {
            $sql .= "content=?, ";
            $params[] = $this->content;
        }

        if ($this->image !== null) {
            $sql .= "image=?, ";
            $params[] = $this->image;
        }

        // Remove the trailing comma and space from the SQL string
        $sql = rtrim($sql, ", ");

        $sql .= " WHERE post_id=?";
        $params[] = $this->post_id;

        // Prepare and execute the SQL query
        $sqlState = static::database()->prepare($sql);
        $sqlState->execute($params);

        // Update tags for the post
        if ($this->post_id) {
            return $this->handleTags($this->post_id, $tags);
        }
    }





    //archived all post
    public static function archived($post_id)
    {
        $post =  self::find($post_id);

        if ($post['archived'] == 1) {

            $archivPosts = self::database()->prepare("UPDATE posts SET archived = 0 WHERE post_id = ?");
            $archivPosts->execute([$post_id]);
        } else {
            $archivPosts = self::database()->prepare("UPDATE posts SET archived = 1 WHERE post_id = ?");
            $archivPosts->execute([$post_id]);
        }
    }


    //remove post 
    public static function destroy($post_id)
    {
        // Then, delete the post tag
        $sqlState = static::database()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        return $sqlState->execute([$post_id]);

        $sqlState = self::database()->prepare("DELETE FROM posts WHERE post_id = ?");
        return $sqlState->execute([$post_id]);
    }




    // this fuction for  save tags
    private function handleTags($postId, $tags)
    {
        $tagIds = []; // here we will store ids tags


        // 1 loop throught array tags
        foreach ($tags as $tagName) {

            $tagName = trim($tagName);

            //2  Check if the tag already exists in the tags table
            $stmt = static::database()->prepare("SELECT tag_id FROM tags WHERE tag_name = ?");
            $stmt->execute([$tagName]);

            //3 valiadtor
            if ($stmt->rowCount() > 0) {
                // If the tag exists, use its tag_id
                $tagId = $stmt->fetch(PDO::FETCH_ASSOC)['tag_id'];
            } else {
                // If the tag doesn't exist, insert it into the tags table
                $stmt = static::database()->prepare("INSERT INTO tags (tag_name) VALUES (?)");
                $stmt->execute([$tagName]);

                // Get the last inserted tag_id
                $tagId = static::database()->lastInsertId();
            }

            //4 Add  tag_id to the array
            $tagIds[] = $tagId;
        }

        // insert tag_id to post Tags
        foreach ($tagIds as $tagId) {
            $stmt = static::database()->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$postId, $tagId]);
        }
        return true;
    }
}
