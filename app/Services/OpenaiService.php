<?php

namespace App\Services;

use Tectalic\OpenAi\Client;
use Tectalic\OpenAi\Models\ChatCompletions\CreateResponse;
use Tectalic\OpenAi\Models\ChatCompletions\CreateRequest;
use Tectalic\OpenAi\ClientException;

class OpenaiService
{
    /** @var \Tectalic\OpenAi\Client */
    protected $openaiClient;

    /**
     * @param Client $openaiClient
     */
    public function __construct(Client $openaiClient)
    {
        $this->openaiClient = $openaiClient;
    }

    /**
     * @param string $content
     * @return array
     * @throws ClientException
     */
    public function chat(string $content): array
    {
        try {
            /** @var CreateResponse $response */
            $response = $this->openaiClient->chatCompletions()->create(
                new CreateRequest([
                    'model' => config('openai.model'),
                    'messages' => [
                        [
                            'role' => config('openai.role'),
                            'content' => $content
                        ],
                    ],
                ])
            )->toModel();

            return $this->getContentToJson($response);
        } catch (ClientException $e) {
            throw new $e;
        }
    }

    private function getContentToJson(CreateResponse $response): array
    {
        $contents = [];
        $data = $response->jsonSerialize();
        foreach ($data->choices as $choice) {
            $contents[] = json_decode($choice->message->content);
        }

        return $contents;
    }
}
