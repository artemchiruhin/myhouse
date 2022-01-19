<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function authorizeAdmin()
    {
        $this->post('/login', [
            'login' => 'admin',
            'password' => 'admin'
        ]);
    }

    public function testNotAdminCanNotEnter()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }

    public function testAdminCanEnter()
    {
        $this->authorizeAdmin();
        $response = $this->get('/admin');
        $response->assertOk();
    }

    public function testCanNotAuthorizeWithoutData()
    {
        $this->post('/login', []);
        $this->assertFalse(Auth::check());
    }

    public function testCanAuthorizeWithData()
    {
        $this->post('/login', ['login' => 'admin', 'password' => 'admin']);
        $this->assertTrue(Auth::check());
    }

    public function testCanNotRegisterWithoutData()
    {
        $this->post('/registration', []);
        $this->assertFalse(Auth::check());
    }

    public function testCanRegisterWithData()
    {
        $password = Str::random(10);
        $this->post('/registration', [
            'login' => preg_replace('/\d/', '', Str::random(20)),
            'password' => $password,
            'password_confirmation' => $password,
            'email' => Str::random(10) . '@gmail.com',
            'full_name' => 'Чирухин Артём Андреевич',
            'checkbox' => true
        ]);
        $this->assertTrue(Auth::check());
    }

    public function testCanNotCreateCategoryWithoutTitle()
    {
        $this->authorizeAdmin();
        $response = $this->post('/admin/categories/create', ['title' => '']);
        $response->assertStatus(302);
    }

    public function testCreateCategory()
    {
        $this->authorizeAdmin();
        $response = $this->post('/admin/categories/create', ['title' => Str::random(10)]);
        $response->assertSessionHas('categoryCreated', 'Категория успешно создана.');
    }

    public function testCanNotEditNotExistingCategory()
    {
        $this->authorizeAdmin();
        $response = $this->get('/admin/categories/not-existing-category/edit');
        $response->assertNotFound();
    }

    public function testDeleteCategory()
    {
        $this->authorizeAdmin();
        $category = Category::orderBy('id', 'desc')->first();
        $response = $this->json('delete', '/admin/categories/' . $category->slug . '/delete', []);
        $response->assertSessionHas('categoryDeleted', 'Категория удалена.');
    }

    public function testCanNotRentHouseWithoutData()
    {
        $this->authorizeAdmin();
        $response = $this->post('/rent/1', []);
        $response->assertStatus(302);
    }

    public function testCanNotRentNotExistingHouse()
    {
        $this->authorizeAdmin();
        $response = $this->get('/rent/not-existing-house');
        $response->assertNotFound();
    }

    public function testCanRentHouseWithData()
    {
        $this->authorizeAdmin();
        $response = $this->post('/rent/1', [
            'house_id' => 1,
            'user_id' => Auth::id(),
            'cost' => 1000,
            'date_from' => '2022-02-25',
            'date_to' => '2022-02-28'
        ]);
        $response->assertSessionHas('orderAccepted', 'Заказ принят.');
    }

    public function testCanNotRentHouseWithWrongDates()
    {
        $this->authorizeAdmin();
        $response = $this->post('/rent/1', [
            'house_id' => 1,
            'user_id' => Auth::id(),
            'cost' => 1000,
            'date_from' => '2022-02-28',
            'date_to' => '2022-02-25'
        ]);
        $response->assertSessionHasErrors([
            'date_to' => 'Конечная дата должна быть после начальной.'
        ]);
    }
}
