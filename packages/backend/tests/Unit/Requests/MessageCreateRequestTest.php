<?php

namespace tests\Unit\Requests;

use App\Http\Requests\MessageCreateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class MessageCreateRequestTest extends TestCase
{
    use RefreshDatabase;

    protected MessageCreateRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new MessageCreateRequest();
    }

    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(MessageCreateRequest::class, $this->request);
    }

    /**
     * バリデーションテスト
     *
     * @dataProvider signupUsersArgsValidationDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testSignupUsersArgsValidation(array $data, array $errors): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * テストに渡すデータ
     */
    public function signupUsersArgsValidationDataProvider(): array
    {
        return [
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'body' => ['The body field is required.'],
                ],
            ],
            '文字数が多すぎる' => [
                'data' => [
                    'body' => str_repeat('a', 141),
                ],
                'errors' => [
                    'body' => ['The body must not be greater than 140 characters.'],
                ],
            ],
            //            'Edge: 絵文字でも正しくカウントできる' => [
            //                'data' => [
            //                    'body' => str_repeat('🏴󠁧󠁢󠁥󠁮󠁧󠁿', 20),
            //                ],
            //                'errors' => [
            //                    'body' => ['The body must not be greater than 140 characters.'],
            //                ],
            //            ],
        ];
    }
}
