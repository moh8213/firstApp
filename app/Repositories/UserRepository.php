<?php
 
namespace App\Repositories;
 
use App\User;
 
class UserRepository
{
    protected $user;
 
    public function __construct(User $user)
    {
        $this->user = $user;
    }
 
    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }
 
    public function store(Array $inputs)
    {
        $inputs['password'] = bcrypt($inputs['password']);
        return $this->user->create($inputs);
    }
 
    public function update(User $user, Array $inputs)
    {
        $user->update($inputs);
    }
 
    public function destroy(User $user)
    {
        $user->delete();
    }
}