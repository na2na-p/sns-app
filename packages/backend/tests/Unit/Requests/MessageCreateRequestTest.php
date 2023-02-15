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

    /**
     * バリデーションテスト(異常系)
     *
     * @dataProvider signupUsersArgsValidationInvalidDataProvider
     */
    public function testSignupUsersArgsValidationFailed(array $data, array $errors): void
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
    public function signupUsersArgsValidationInvalidDataProvider(): array
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

    /**
     * バリデーションテスト(正常系)
     *
     * @dataProvider signupUsersArgsValidationValidDataProvider
     */
    public function testSignupUsersArgsValidationSuccess(array $data): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(true, $result);
    }

    /**
     * 正常系テストに渡すデータ
     */
    public function signupUsersArgsValidationValidDataProvider(): array
    {
        return [
            '正常系' => [
                'data' => [
                    'body' => 'test',
                ],
            ],
        ];
    }
}
