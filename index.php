<?php

class JSONPlaceholderAPI
{
    private $baseURL;

    public function __construct()
    {
        $this->baseURL = 'https://jsonplaceholder.typicode.com';
    }

    public function getUsers()
    {
        $url = $this->baseURL . '/users';
        return $this->sendRequest($url);
    }

    public function getUserPosts($userId)
    {
        $url = $this->baseURL . '/posts?userId=' . $userId;
        return $this->sendRequest($url);
    }

    public function getUserTodos($userId)
    {
        $url = $this->baseURL . '/todos?userId=' . $userId;
        return $this->sendRequest($url);
    }

    public function getPost($postId)
    {
        $url = $this->baseURL . '/posts/' . $postId;
        return $this->sendRequest($url);
    }

    public function addPost($data)
    {
        $url = $this->baseURL . '/posts';
        return $this->sendRequest($url, 'POST', $data);
    }

    public function updatePost($postId, $data)
    {
        $url = $this->baseURL . '/posts/' . $postId;
        return $this->sendRequest($url, 'PUT', $data);
    }

    public function deletePost($postId)
    {
        $url = $this->baseURL . '/posts/' . $postId;
        return $this->sendRequest($url, 'DELETE');
    }

    private function sendRequest($url, $method = 'GET', $data = null)
    {
        $options = array(
            'http' => array(
                'method' => $method,
                'header' => 'Content-type: application/json',
                'content' => json_encode($data)
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}

$api = new JSONPlaceholderAPI();

// $users = $api->getUsers();
// print_r($users);

// $userPosts = $api->getUserPosts(1);
// print_r($userPosts);

// $userTodos = $api->getUserTodos(1);
// print_r($userTodos);

// $post = $api->getPost(1);
// print_r($post);

// $newPost = array(
//     'title' => 'Новый пост',
//     'body' => 'Текст нового поста',
//     'userId' => 1
// );
// $addedPost = $api->addPost($newPost);
// print_r($addedPost);

// $updatedPost = array(
//     'title' => 'Обновленный пост',
//     'body' => 'Текст обновленного поста',
//     'userId' => 1
// );
// $updatedPost = $api->updatePost(1, $updatedPost);
// print_r($updatedPost);

// $api->deletePost(1);