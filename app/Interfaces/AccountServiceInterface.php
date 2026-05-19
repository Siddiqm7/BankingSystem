<?php
namespace App\Interfaces;
interface AccountServiceInterface
{
    public function createNewAccount(array $data): bool;
    public function getAccountById(int $id): ?array;
    public function updateAccount(int $id, array $data): bool;
    public function renewOldAccount(int $id, array $data): bool;
    public function deleteAccount(int $id): bool;
    public function sendEmail(int $id):void;
    public function takeSmsCharge(int $id):void;
    public function deposit(int $id, float $amount): bool; 
    public function withdraw(int $id, float $amount): bool;
    public function getAllAccounts(): array;
}