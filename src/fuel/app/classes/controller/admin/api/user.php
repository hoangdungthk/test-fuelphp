<?php

use Fuel\Core\Validation;
use Fuel\Core\Controller_Rest;
use Fuel\Core\Input;

/**
 * Class Controller_Admin_Api_User
 *
 * API quản lý người dùng trong hệ thống.
 *
 * @package Controller_Admin_Api_User
 */
class Controller_Admin_Api_User extends Controller_Rest
{
    /** @var string Định dạng phản hồi mặc định */
    protected $format = 'json';

    /** @var repository_user Repository xử lý dữ liệu người dùng */
    private $repository_user;

    /**
     * Thiết lập trước khi thực hiện các phương thức API.
     *
     * @access public
     * @return void
     */
    public function before(): void
    {
        parent::before();
        $this->repository_user = new repository_user();
    }

    /**
     * Lấy danh sách tất cả người dùng.
     *
     * @access public
     * @return object Phản hồi API dưới dạng JSON.
     */
    public function get_index(): object
    {
        $data = array_values($this->repository_user->getAll());
        return $this->response([
            'status' => 'success',
            'message' => 'GET request received',
            'data' => $data
        ]);
    }

    /**
     * Tạo người dùng mới thông qua API.
     *
     * @access public
     * @return object Phản hồi API dưới dạng JSON.
     */
    public function post_store(): object
    {
        $input = Input::json();
        if (!$input) {
            return $this->response([
                'status' => 'error',
                'message' => 'Invalid JSON input',
                'data' => null
            ], 400);
        }

        $validation = Validation::forge();
        $validation->add_callable(new Rule_Db());
        $validation->add_field('name', 'User name', 'required|min_length[6]|max_length[50]');
        $validation->add_field('email', 'User email', 'required|valid_email|max_length[50]|unique[users.email]');
        $validation->add_field('password', 'User password', 'required|min_length[6]|max_length[50]');

        if ($validation->run($input)) {
            $input['is_admin'] = false;
            $data = $this->repository_user->store($input);
            return $this->response([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $data
            ], 201);
        }

        return $this->response([
            'status' => 'validation_fail',
            'message' => $this->getValidationErrors($validation),
            'data' => null
        ], 400);
    }

    /**
     * Cập nhật thông tin người dùng.
     *
     * @access public
     * @param int $user_id ID của người dùng cần cập nhật.
     * @return object Phản hồi API dưới dạng JSON.
     */
    public function post_update(int $user_id): object
    {
        $input = Input::json();
        if (!$input) {
            return $this->response([
                'status' => 'error',
                'message' => 'Invalid JSON input',
                'data' => null
            ], 400);
        }

        $input['user_id'] = $user_id;
        $validation = Validation::forge();
        $validation->add_callable(new Rule_Db());
        $validation->add_field('user_id', 'User id', 'required|exist[users.id]');
        $validation->add_field('name', 'User name', 'required|min_length[6]|max_length[50]');
        $validation->add_field('password', 'User password', 'min_length[6]|max_length[50]');

        if ($validation->run($input)) {
            unset($input['user_id']);
            $data = $this->repository_user->update($user_id, $input);
            return $this->response([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $data
            ], 201);
        }

        return $this->response([
            'status' => 'validation_fail',
            'message' => $this->getValidationErrors($validation),
            'data' => null
        ], 400);
    }

    /**
     * Xóa người dùng.
     *
     * @access public
     * @param int $user_id ID của người dùng cần xóa.
     * @return object Phản hồi API dưới dạng JSON.
     */
    public function post_destroy(int $user_id): object
    {
        $validation = Validation::forge();
        $validation->add_callable(new Rule_Db());
        $validation->add_field('user_id', 'User id', 'required|exist[users.id]');

        if ($validation->run(['user_id' => $user_id])) {
            $this->repository_user->destroy($user_id);
            return $this->response([
                'status' => 'success',
                'message' => 'User deleted successfully',
                'data' => null
            ], 200);
        }

        return $this->response([
            'status' => 'validation_fail',
            'message' => $this->getValidationErrors($validation),
            'data' => null
        ], 400);
    }

    /**
     * Lấy danh sách lỗi từ đối tượng Validation.
     *
     * @access private
     * @param Validation $validation Đối tượng validation.
     * @return array Mảng chứa danh sách lỗi.
     */
    private function getValidationErrors(Validation $validation): array
    {
        return array_map(function($error) {
            return $error->get_message();
        }, $validation->error());
    }
}
