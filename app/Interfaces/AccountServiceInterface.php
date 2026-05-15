<?php
namespace App\Interfaces;
interface AccountServiceInterface
{
    public function createNewAccount(array $data): bool;
    public function getAccountById($id): ?array;
    public function updateAccount($id, array $data): bool;
    public function renewOldAccount($id,array $data): bool;
    public function deleteAccount($id): bool;
    public function sendEmail($id):void;
    public function takeSmsCharge($id):void;
}