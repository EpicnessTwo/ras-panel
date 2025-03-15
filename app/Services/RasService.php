<?php

namespace App\Services;

use EpicKitty\Ras\Api\DefaultApi;
use EpicKitty\Ras\ApiException;
use EpicKitty\Ras\Configuration;
use EpicKitty\Ras\Model\ChatRoomPrivateGet200ResponseInner;
use EpicKitty\Ras\Model\SessionGet200Response;
use EpicKitty\Ras\Model\UserDeleteRequest;
use EpicKitty\Ras\Model\UserPasswordPutRequest;
use EpicKitty\Ras\Model\UserPostRequest;
use EpicKitty\Ras\Model\UserScreennameAccountGet200Response;
use EpicKitty\Ras\Model\VersionGet200Response;

class RasService
{
    public $ras;

    public function __construct(
        public bool $dereference = false
    ) {
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
    public function getUserSessions(string $screenName): SessionGet200Response|array|null
    {
        return $this->processResponse($this->ras->sessionScreennameGet($screenName));
    }

    /**
     * @throws ApiException
     */
    public function getPrivateChatRooms(): ChatRoomPrivateGet200ResponseInner|array|null
    {
        return $this->processResponse($this->ras->chatRoomPrivateGet());
    }

    /**
     * @throws ApiException
     */
    public function getPublicChatRooms(): ChatRoomPrivateGet200ResponseInner|array|null
    {
        return $this->processResponse($this->ras->chatRoomPublicGet());
    }

    /**
     * @throws ApiException
     */
    public function getVersion(): VersionGet200Response|array|null
    {
        return $this->processResponse($this->ras->versionGet());
    }

    private function processResponse($response)
    {
        if ($this->dereference) {
            return json_decode(json_encode($response), true);
        }
        return $response;
    }
}
