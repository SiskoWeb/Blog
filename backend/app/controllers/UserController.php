<?php

require 'app/models/UserModel.php';
require 'app/lib/Utility.php';
require 'app/lib/uploadImage.php';






class UserController
{

    private static $utility;

    public function __construct()
    {
        // Create an instance of the Utility class
        self::$utility = new Utility();
    }




    // get all users
    public static function latestAction()
    {
        $latestUsers = UserModel::latest();

        if ($latestUsers) {
            echo json_encode($latestUsers);
            return;
        }
        Utility::sendResponse("there is no  users", 404);
    }

    // get user by id
    public static function findUserAction()
    {
        //Reception data from query id
        extract($_GET);
        $user = UserModel::find($user_id);


        // check if  there is a user
        if ($user) {

            echo json_encode($user);
            return;
        }
        Utility::sendResponse("there is no user under this $user_id", 404);
    }

    // get user by id
    public static function findUserWithPostAction()
    {
        //Reception data from query id
        extract($_GET);
        $posts = UserModel::findWithPosts($user_id);


        // check if  there is a user
        if ($posts) {

            echo json_encode($posts); //array
            return;
        }
        Utility::sendResponse("there is no user under this $user_id", 404);
    }


    // block user
    public static function blockUserAction()
    {
        //Reception data from query id
        extract($_GET);
        //1- Check if id sent
        if (!$user_id) return Utility::sendResponse("post_id is Required", 404);

        $user = UserModel::blockUser($user_id);


        // check if  user  blcoked
        if ($user) {

            Utility::sendResponse("user belong id:  $user_id Blocked", 200);
            return;
        }
        Utility::sendResponse("there is no user under this $user_id", 404);
    }

    // block user
    public static function unBlockUserAction()
    {
        //Reception data from query id
        extract($_GET);
        //1- Check if id sent
        if (!$user_id) return Utility::sendResponse("post_id is Required", 404);
        $user = UserModel::unBlockUser($user_id);


        // check if  user  unBlcoked
        if ($user) {

            Utility::sendResponse("user belong id:  $user_id unBlocked", 200);
            return;
        }
        Utility::sendResponse("there is no user under this $user_id", 404);
    }



    // delete user by id
    public static function destroyAction()
    {

        //Reception data from query id
        extract($_GET);
        //1- Check if id sent
        if (!$user_id) return Utility::sendResponse("post_id is Required", 404);
        $user = UserModel::destroy($user_id);


        // check if  user  blcoked
        if ($user) {

            Utility::sendResponse("user belong id:  $user_id Deleted", 200);
            return;
        }
        Utility::sendResponse("there is no user under this $user_id", 404);
    }


    public static function updateAction()
    {
        //Reception data from query id and save it
        // in variabl with same name data comes
        extract($_GET);
        //1- Check if id sent
        if (!$user_id) return Utility::sendResponse("post_id is Required", 404);

        //check if user_id sent
        if (!$user_id) return  Utility::sendResponse("user_id is Required", 404);


        // Check if data is sent in the POST request
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $role = isset($_POST['role']) ? $_POST['role'] : null;


        $image = isset($_FILES['image']) ? $_FILES['image'] : null;




        // Find a post by ID
        $isUserExist = UserModel::find($user_id);

        if (!$isUserExist) {
            Utility::sendResponse("there is no user under this $user_id", 404);
            return;
        }

        $user = new UserModel();

        // 4- check if user  wants to update the image also
        if ($image !== null) {
            // 4-1- upload image to path
            $targetDirectory = 'uploads/users/';
            $result = uploadImage('image', $targetDirectory);

            // 4-2 -check if image uploaded
            if (!$result->success) {
                Utility::sendResponse("Error: " . $result->message, 500);
                return;
            }

            $user->setImage($result->path);
        }

        $user->setId($user_id);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setRole($role);



        // excute function update 
        if ($user->update()) {
            Utility::sendResponse("User updated successfully", 200);
        } else {
            Utility::sendResponse("Failed to update User", 500);
        }
    }
}
