<?php


namespace App\Model\Entity;

use CakeDC\Users\Model\Entity\User as CakeDCUserEntity;

class AppUser extends CakeDCUserEntity{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'secret' => true,
        'secret_verified' => true,
        'tos_date' => true,
        'active' => true,
        'is_superuser' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'additional_data' => true,
        'social_accounts' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
        'token_expires',
        'activation_date',
        'tos_date',
        'created',
        'modified',
        'secret',
        'secret_verified'
    ];
}