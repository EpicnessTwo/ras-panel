<?php

namespace App\Services;

use EpicKitty\Ras\Api\DefaultApi;
use EpicKitty\Ras\ApiException;
use EpicKitty\Ras\Configuration;
use EpicKitty\Ras\Model\UserDeleteRequest;
use EpicKitty\Ras\Model\UserPasswordPutRequest;
use EpicKitty\Ras\Model\UserPostRequest;
use EpicKitty\Ras\Model\UserScreennameAccountGet200Response;

class RasService
{
    public $ras;

    public function __construct()
    {
        $config = new Configuration();
        $config->setHost(config('ras.api_uri'));
        $this->ras = new DefaultApi(
            config: $config
        );
    }

    /**
     * @throws ApiException
     */
    public function getUsers(): array
    {
        return $this->ras->userGet();
    }

    /**
     * @throws ApiException
     */
    public function getUser(string $screenName): UserScreennameAccountGet200Response
    {
        return $this->ras->userScreennameAccountGet($screenName);
    }

    /**
     * @throws ApiException
     */
    public function addUser(string $screenName, string $password): void
    {
        $this->ras->userPost(
            new UserPostRequest([
                'screenName' => $screenName,
                'password' => $password
            ])
        );
    }

    /**
     * @throws ApiException
     */
    public function updateUserPassword(string $screenName, string $password): void
    {
        $this->ras->userPasswordPut(
            new UserPasswordPutRequest([
                'screenName' => $screenName,
                'password' => $password
            ])
        );
    }

    /**
     * @throws ApiException
     */
    public function deleteUser(string $screenName): void
    {
        $this->ras->userDelete(
            new UserDeleteRequest([
                'screenName' => $screenName
            ])
        );
    }

    /**
     * @throws ApiException
     */
    public function getPrivateChatRooms(): array
    {
        return $this->ras->chatRoomPrivateGet();
    }

    /**
     * @throws ApiException
     */
    public function getPublicChatRooms(): array
    {
        return $this->ras->chatRoomPublicGet();
    }
}
