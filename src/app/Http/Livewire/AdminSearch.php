<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Shop;
use App\Models\Shop_representative;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class AdminSearch extends Component
{
    protected $users;
    public $shops;
    public $roles;
    public $wordSearch = '';
    public $roleSearch = '';
    public $storeSearch = '';
    public $showModal = false;
    public $user_id;
    public $delUser;
    public $delete_role;
    protected $query;

    public function mount() {
        $this->getAdminSearch();
    }

    public function render()
    {
        $this->shops = Shop::select(['id', 'name'])->get();
        $this->roles = Role::all();
        $this->getAdminSearch();

        return view('livewire.admin-search', [
            'users'=>$this->users]);
    }

    // 検索フォームの値が更新するたびにsearchアクションを呼び出す
    public function updatedRoleSearch()
    {
        $this->getAdminSearch();
    }

    public function updatedStoreSearch()
    {
        $this->getAdminSearch();
    }

    public function updatedWordSearch()
    {
        $this->getAdminSearch();
    }

    // 検索機能
    public function getAdminSearch()
    {
        $this->query = User::with('roles', 'shopRepresentative');
        $this->getRoleSearch();
        $this->getStoreSearch();
        $this->getWordSearch();
        $this->users = $this->query->get();
    }

    public function getRoleSearch() {
        $roleSearch = $this->roleSearch;
        if(!empty($roleSearch)) {
            if($roleSearch == 'user') {
                $this->query->doesntHave('roles');
            }else {
                $this->query->whereHas('roles', function ($q) use ($roleSearch) {
                    $q->where('roles.id', $roleSearch);
                });
            }
        }
    }

    public function getStoreSearch() {
        $storeSearch = $this->storeSearch;
        if(!empty($storeSearch)) {
            $this->query->whereHas('shopRepresentative', function ($q) use ($storeSearch) {
                $q->where('shop_Representatives.shop_id', $storeSearch);
            });
        }
    }

    public function getWordSearch() {
        $wordSearch = $this->wordSearch;
        if(!empty($wordSearch)) {
            $this->query->where(function($q) use ($wordSearch) {
                $q->orWhere('name', 'LIKE', '%' .$wordSearch .'%')->orWhere('email', 'LIKE', '%' .$wordSearch .'%');
            });
        }
    }


    // 検索ワードをurlに反映
    protected $queryString = [
        'roleSearch' => ['except' => ''],
        'storeSearch' => ['except' => ''],
        'wordSearch' => ['except' => '']
    ];

    // モーダル画面
    public function openModal($user_id)
    {
        $this->delUser = User::with('roles')->find($user_id);
        foreach($this->delUser->roles as $role) {
            $this->delete_role = $role->name;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function remove() {
        $this->delUser->removeRole($this->delete_role);
        $result = Shop_representative::where('user_id', $this->delUser->id)->delete();

        return redirect('admin/user/index')->with('result', '指定ユーザーの権限を削除しました');
    }
}
