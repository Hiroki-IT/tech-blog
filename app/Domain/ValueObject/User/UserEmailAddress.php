<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\User;

use App\Domain\ValueObject\ValueObject;

/**
 * メールアドレスクラス
 */
final class UserEmailAddress extends ValueObject
{
    /**
     * メールアドレス
     *
     * @var string
     */
    private string $value;

    /**
     * コンストラクタインジェクション
     *
     * @param string $value
     */
    public function __constructor(string $value)
    {
        $this->value = $value;
    }
}
