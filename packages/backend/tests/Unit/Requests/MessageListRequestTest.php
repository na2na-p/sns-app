<?php

namespace tests\Unit\Requests;

use App\Http\Requests\ListMessageRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class MessageListRequestTest extends TestCase
{
    use RefreshDatabase;

    protected ListMessageRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new ListMessageRequest();
    }

    /**
     * バリデーションテスト(異常系)
     *
     * @dataProvider messagesListArgsValidationInvalidDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testMessagesListArgsValidationFailed(array $data, array $errors): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * 異常系テストに渡すデータ
     */
    public function messagesListArgsValidationInvalidDataProvider(): array
    {
        return [
            'perPageの型が違う' => [
                'data' => [
                    'perPage' => 'a',
                ],
                'errors' => [
                    'perPage' => ['The per page must be an integer.'],
                ],
            ],
        ];
    }

    /**
     * バリデーションテスト(正常系)
     *
     * @dataProvider messagesListArgsValidationValidDataProvider
     *
     * @param  array  $data
     * @return void
     */
    public function testMessagesListArgsValidationSuccess(array $data): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(true, $result);
    }

    /**
     * 正常系テストに渡すデータ
     */
    public function messagesListArgsValidationValidDataProvider(): array
    {
        return [
            '正常系: すべて空' => [
                'data' => [],
            ],
            '正常系: lastMessageIdのみ' => [
                'data' => [
                    'lastMessageId' => 'messageId',
                ],
            ],
            '正常系: perPageのみ' => [
                'data' => [
                    'perPage' => '10',
                ],
            ],
            '正常系: lastMessageIdとperPage' => [
                'data' => [
                    'lastMessageId' => 'messageId',
                    'perPage' => '10',
                ],
            ],
        ];
    }
}
