<?php

namespace App\Services;

use EpicKitty\Ras\Api\DefaultApi;
use EpicKitty\Ras\ApiException;
use EpicKitty\Ras\Configuration;
use EpicKitty\Ras\Model\ChatRoomPrivateGet200ResponseInner;
use EpicKitty\Ras\Model\ChatRoomPublicPostRequest;
use EpicKitty\Ras\Model\DirectoryCategoryPostRequest;
use EpicKitty\Ras\Model\DirectoryKeywordPostRequest;
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
        return $this->processResponse($this->ras->userGet());
    }

    /**
     * @throws ApiException
     */
    public function getUser(string $screenName): UserScreennameAccountGet200Response
    {
        return $this->processResponse($this->ras->userScreennameAccountGet($screenName));
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
    public function getSessions(): SessionGet200Response|array|null
    {
        return $this->processResponse($this->ras->sessionGet());
    }

    /**
     * @throws ApiException
     */
    public function getUserSessions(string $screenName = null): SessionGet200Response|array|null
    {
        $screenName = $screenName ?? auth()->user()->name;

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
    public function createPublicChatRoom(string $name): void
    {
        $this->ras->chatRoomPublicPost(
            new ChatRoomPublicPostRequest([
                    'name' => $name
            ])
        );
    }

    public function getCategories(): array
    {
        return $this->processResponse($this->ras->directoryCategoryGet());
    }

    /**
     * @throws ApiException
     */
    public function createCategory(string $name): void
    {
        $this->ras->directoryCategoryPost(
            new DirectoryCategoryPostRequest([
                'name' => $name
            ])
        );
    }

    /**
     * @throws ApiException
     */
    public function deleteCategory(int $id): void
    {
        $this->ras->directoryCategoryIdDelete($id);
    }

    /**
     * @throws ApiException
     */
    public function getCategoryKeywords(int $id): array
    {
        return $this->processResponse($this->ras->directoryCategoryIdKeywordGet($id));
    }

    /**
     * @throws ApiException
     */
    public function addCategoryKeyword(int $id, string $name): void
    {
        $this->ras->directoryKeywordPost(
            new DirectoryKeywordPostRequest([
                'id' => $id,
                'name' => $name
            ])
        );
    }

    /**
     * @throws ApiException
     */
    public function getVersion(): VersionGet200Response|array|null
    {
        return $this->processResponse($this->ras->versionGet());
    }

    /**
     * Objects are often messy, so we can convert them to arrays.
     *
     * @param mixed $response
     * @return mixed
     */
    private function processResponse($response)
    {
        if ($this->dereference) {
            return json_decode(json_encode($response), true);
        }
        return $response;
    }
}
