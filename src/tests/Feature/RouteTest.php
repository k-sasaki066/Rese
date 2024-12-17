<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class RouteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // registerページに正常にアクセスできるか
    public function access_registration_screen()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
        ->assertViewIs('register');
    }

    // 会員登録後ホーム画面に移遷するか
    // データベースに値が存在するか
    public function test_user_register()
    {
        $data = [
            'name' => 'test',
            'email' => 'test@email.com',
            'password'  => 'test1234',
        ];

        $response = $this->post(('/register'), $data);

        // データベースに値が存在するか
        $this->assertDatabaseHas('users', [
            'name'    => 'test',
            'email'   => 'test@email.com',
            'email_verified_at' => null,
        ]);

        $this->assertDatabaseCount( 'users', 1 );

        $response->assertRedirect('/mypage')
        ->assertStatus(302);
    }

    // loginページに正常にアクセスできるか
    public function access_login_screen()
    {
        $response = $this->get('/login');
        $response->assertStatus(200)
        ->assertViewIs('login');
    }

    // ログインが成功するか
    public function test_users_login()
    {
        $user = User::factory()->create();

        $this->assertGuest(); //未ログイン状態であることをチェック

        $response = $this->post(('/login'), ['email' => $user->email, 'password' => 'password']);
        $response->assertStatus(302)
        ->assertRedirect('/mypage');
        $this->assertAuthenticatedAs($user);

        // ログインした状態で'/login'にアクセス
        $response = $this->get( '/login' );
        $response->assertStatus(302)
        ->assertRedirect('/mypage');
    }

    // 誤ったパスワードを入力した場合エラーメッセージが出るか
    public function test_users_invalid_password()
    {
        $user = User::factory()->create();

        $this->assertGuest(); //未ログイン状態であることをチェック

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors([
            'email' => '認証情報と一致するレコードがありません。'
        ]);

        $this->assertGuest();
    }

    // 誤ったメールアドレスを入力した場合エラーメッセージが出るか
    public function test_users_invalid_email()
    {
        $user = User::factory()->create();

        $this->assertGuest(); //未ログイン状態であることをチェック

        $response = $this->post('/login', [
            'email' => 'wrong@test.com',
            'password' => $user->password,
        ]);

        $response->assertSessionHasErrors([
            'email' => '認証情報と一致するレコードがありません。'
        ]);

        $this->assertGuest();
    }

    // ログアウト後ログイン画面に移遷するか
    public function test_users_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認

        $response = $this->post('/logout');

        $this->assertGuest(); //ログアウトしていることを確認

        $response->assertRedirect('/');
    }

    // topページに正常にアクセスできるか
    public function access_top_screen(): void
    {
        $this->assertGuest();
        $response = $this->get('/');
        $response->assertStatus(200)
        ->assertViewIs('index');
    }

    // ログイン状態でtopページに正常にアクセスできるか
    public function access_login_top_screen()
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    // detailページに正常にアクセスできるか
    public function access_detail_screen()
    {
        $this->assertGuest();
        $response = $this->get('/detail/1');
        $response->assertStatus(200)
        ->assertViewIs('detail');
    }

    // ログイン状態でdetailページに正常にアクセスできるか
    public function access_login_detail_screen()
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認
        
        $response = $this->get('/detail/1');
        $response->assertStatus(200)
        ->assertViewIs('detail');
    }

    // 未ログインでマイページにアクセスしたらloginページに移動するか
    public function access_mypage_screen()
    {
        $this->assertGuest();
        $response = $this->get('/mypage');
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    // ログイン状態でマイページに正常にアクセスできるか
    public function access_login_mypage_screen()
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認
        
        $response = $this->get('/mypage');
        $response->assertStatus(200)
        ->assertViewIs('user.mypage');
    }

    // 未ログインで来店履歴ページにアクセスしたらloginページに移動するか
    public function access_history_screen()
    {
        $this->assertGuest();
        $response = $this->get('/history');
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    // ログイン状態で来店履歴ページに正常にアクセスできるか
    public function access_login_history_screen()
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認
        
        $response = $this->get('/history');
        $response->assertStatus(200)
        ->assertViewIs('visit-history');
    }

    // 未ログインで決済ページにアクセスしたらloginページに移動するか
    public function access_payment_screen(): void
    {
        $this->assertGuest();
        $response = $this->get('/payment/1');
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    // ログイン状態で決済ページに正常にアクセスできるか
    public function access_login_payment_screen(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user); //$userを認証済み状態に

        $this->assertAuthenticated(); //ログインしていることを確認
        
        $response = $this->get('/payment/1');
        $response->assertStatus(200)
        ->assertViewIs('payment');
    }
}
